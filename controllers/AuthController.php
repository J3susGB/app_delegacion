<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            // Traigo todos los usuarios registrados:
            $usuarios = Usuario::all();
            // debuguear($_POST);

            //Creo variable para almancenar el valor del post del usuario y contraseña:
            $user = $_POST['usuario'];
            $contraseña = $_POST['password'];

            //Compruebo que el usuario exista en la base de datos
            $usuario = Usuario::where('user', $user);
            // debuguear($usuario);

            // $alertas = $usuario->validarLogin();
            // debuguear($alertas);
            
            if(!$usuario) {
                Usuario::setAlerta('error', 'El usuario no existe');
                    
            } else {
                // El Usuario existe
                if( password_verify($contraseña, $usuario->password) ) {
                    // if( $contraseña == $usuario->password) {
                    // Iniciar la sesión
                    session_start();    
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['user'] = $usuario->user;
                    $_SESSION['nombre'] = $usuario->nombre;
                    $_SESSION['apellido1'] = $usuario->apellido1;
                    $_SESSION['apellido2'] = $usuario->apellido2;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['colaborador'] = $usuario->colaborador ?? null;
                    $_SESSION['directivo'] = $usuario->directivo ?? 0;
                    
                    if( $usuario->directivo ) {
                        header('Location: /directivo/dashboard');
                    } else if($usuario->colaborador ) {
                        header('Location: /colaborador/dashboard');
                    } else {
                        header('Location: /');
                    }

                } else {
                    Usuario::setAlerta('error', 'Contraseña incorrecta');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Render a la vista 
        $router->render('auth/login', [
            'titulo' => 'Iniciar sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
       
    }

    public static function registro(Router $router) {
        $alertas = [];
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->validar_cuenta();

            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2
                    unset($usuario->password2);

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    

                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        // Render a la vista
        $router->render('auth/registro', [
            'titulo' => 'Crea tu cuenta en DevWebcamp',
            'usuario' => $usuario, 
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router) {
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario) {
                    $usuario->token = null;
                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);
                    // debuguear($usuario);

                    // Actualizar el usuario
                    $usuario->guardar();

                    // Enviar el email
                    $email = new Email( $usuario->email, $usuario->nombre, $usuario->token );
                    // debuguear($email);
                    $email->enviarInstrucciones();


                    // Imprimir la alerta
                    // Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                    $alertas['exito'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                 
                    // Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');

                    $alertas['error'][] = 'El Usuario no existe o no esta confirmado';
                }
            }
        }

        // Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router) {

        $token = s($_GET['token']);

        $token_valido = true;
        $mostrar = true;

        if(!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token No Válido, intenta de nuevo');
            $token_valido = false;
            $mostrar = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // debuguear($_POST);
            // Añadir el nuevo password
            $usuario->sincronizar($_POST);
            // debuguear($usuario);

            // Validar el password
            $alertas = $usuario->validarPassword();
            // debuguear($alertas);

            if(empty($alertas)) {
                // Hashear el nuevo password
                $usuario->hashPassword();

                // Eliminar el Token
                $usuario->token = null;

                // debuguear($usuario);

                // Guardar el usuario en la BD
                $resultado = $usuario->guardar();

                // Redireccionar
                if($resultado) {
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        // Muestra la vista
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'token_valido' => $token_valido,
            'mostrar' => $mostrar
        ]);
    }

    public static function mensaje(Router $router) {

        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            // No se encontró un usuario con ese token
            Usuario::setAlerta('error', 'Token No Válido');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            if($usuario->password2) {
                unset($usuario->password2);
            }
            
            // Guardar en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $router->render('auth/confirmar', [
            'titulo' => 'Estado de tu cuenta',
            'alertas' => Usuario::getAlertas()
        ]);
    }
}