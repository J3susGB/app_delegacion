<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class UsuarioController {

    public static function añadir_usuario(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        $usuario = new Usuario();
        
        // debuguear($usuario);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($_POST);

            $usuario->user = $_POST['usuario'];
            $usuario->nombre = $_POST['nombre'];
            $usuario->apellido1 = $_POST['apellido1'];
            $usuario->apellido2 = $_POST['apellido2'];
            $usuario->email = $_POST['email'];
            $usuario->password = $_POST['password'];
            $usuario->password = $_POST['password'];
            if(!$usuario->password2) {
                $usuario->password2 = $_POST['password2'];
            }
            $usuario->colaborador = $_POST['colaborador'];
            $usuario->directivo = $_POST['directivo'];
            $usuario->informador = $_POST['informador'];

           
            //Sincronizar con el post:
            $usuario->sincronizar($_POST);
            // debuguear($_POST);

            // debuguear($usuario);

            //Validar:
            $alertas = $usuario->validar_cuenta();

            // debuguear($alertas);
            
            //Guardar el registro
            if(empty($alertas)) {

                //Comprobar si el usuario ya está registrado:
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2, password_actual y nuevo_password
                    unset($usuario->password2);
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    // Generar el Token
                    $usuario->crearToken();

                    // debuguear($usuario);
                    
                    //Guardar en la base de datos:
                    $resultado = $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    if( $resultado ) {
                        header('Location: /directivo/dashboard/usuarios');
                    }
                }
            }    
        }

        // Render a la vista 
        $router->render('directivo/usuarios/añadir', [
            'titulo' => 'Añadir usuario/a',
            'alertas' => $alertas,
            'usuario'=> $usuario
        ]);
    }

    public static function editar_usuario(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
    
        $alertas = [];
        $usuario = new Usuario;
    
        // Validar el id:
        $id = $_GET['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /directivo/dashboard/usuarios');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /directivo/dashboard/usuarios');
        }
    
        // debuguear($usuario);
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($usuario);

            // debuguear($_POST);
    
            if( $usuario->user !== $_POST['usuario'] ) {
                $usuario->user = $_POST['usuario'];
            }
            if( $usuario->directivo !== $_POST['directivo'] ) {
                $usuario->directivo = $_POST['directivo'];
            }
            if( $usuario->colaborador !== $_POST['colaborador'] ) {
                $usuario->colaborador = $_POST['colaborador'];
            }
    
            $usuario->sincronizar($_POST);

            // debuguear($usuario);
    
            $alertas = $usuario->validar_edicion();
            // debuguear($alertas);
    
            if(empty($alertas)) {
                $resultado = $usuario->guardar();
    
                if( $resultado ) {
                    sleep(1.5);
                    header('Location: /directivo/dashboard/usuarios');
                } 
            } 
        }

        $alertas = [];

        // Render a la vista 
        $router->render('directivo/usuarios/editar', [
            'titulo' => 'Editar usuario/a',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function eliminar_usuario() {

        if(!is_directivo()) {
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /login');
            }

            $id = $_POST['id'];
            $usuario = Usuario::find($id);

            if(!isset($usuario)) {
                header('Location: /directivo/dashboard/usuarios');
            }
            
            $resultado = $usuario->eliminar();

            if($resultado) {
                sleep(2);
                header('Location: /directivo/dashboard/usuarios');
            }
        }
    }
}