<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class PerfilController {

    public static function editar_perfil_directivo(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
    
        $alertas = [];
        $usuario = new Usuario;
    
        // Validar el id:
        $id = $_GET['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /directivo/dashboard/perfil');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /directivo/dashboard/perfil');
        }
    
        // debuguear($usuario);
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($usuario);

            // debuguear($_POST);
    
            if( $usuario->nombre !== $_POST['nombre'] ) {
                $usuario->nombre = $_POST['nombre'];
            }
            if( $usuario->apellido1 !== $_POST['apellido1'] ) {
                $usuario->apellido1 = $_POST['apellido1'];
            }
            if( $usuario->apellido2 !== $_POST['apellido2'] ) {
                $usuario->apellido2 = $_POST['apellido2'];
            }
            if( $usuario->email !== $_POST['email'] ) {
                $usuario->email = $_POST['email'];
            }
    
            $usuario->sincronizar($_POST);

            // debuguear($usuario);
    
            $alertas = $usuario->validar_edicion_perfil();
            // debuguear($alertas);
    
            if(empty($alertas)) {
                $resultado = $usuario->guardar();
    
                if ($resultado) {
                    sleep(1.5);
                    header('Location: /directivo/dashboard/perfil?id=' . $usuario->id);
                    exit(); // Asegúrate de llamar a exit() después de header para detener la ejecución del script.
                }
                
            } 
        }

        // $alertas = [];

        // Render a la vista 
        $router->render('directivo/perfil/editar', [
            'titulo' => 'Editar datos del perfil',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }
    
    public static function cambiar_contraseña(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
    
        //Inicio sesión para que se traiga el dato de $_Session['id']
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $id = s($_GET['id']);
        // debuguear($_SESSION);

        if($id !== $_SESSION['id']) {
            header('Location: /');
        }

        $alertas = [];
        // Identificar el usuario con este id
        $usuario = Usuario::where('id', $id);
        // debuguear($usuario);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Se ha producido un error inesperado. Por favor, inténtalo de nuevo.');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($_POST);
            

            // $alertas = $usuario->contraseña_privada();
            // debuguear($alertas);

            //Comprobar si la contraseña plana es igual que la hasheada en la BD
            $contraseña_correcta = password_verify($_POST['password'], $usuario->password );
            // debuguear($contraseña_correcta);

            if($contraseña_correcta) {
                $usuario->sincronizar($_POST);
                // debuguear($usuario);

                $alertas = $usuario->validarPassword();
                // debuguear($alertas);

                if(empty($alertas)) {
                    $usuario->password = $usuario->password2;
                    $usuario->password2 = '';

                    $usuario->hashPassword();

                    // Guardar el usuario en la BD
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        sleep(1.5);
                        header('Location: /directivo/dashboard/perfil?id=' . $usuario->id);
                        exit(); // Asegúrate de llamar a exit() después de header para detener la ejecución del script.
                    }
                }
            }   
        }

        // Render a la vista 
        $router->render('directivo/perfil/cambiar_contraseña', [
            'titulo' => 'Cambiar contraseña',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function index_colaborador(Router $router) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $usuario = new Usuario;
    
        // Validar el id:
        $id = $_SESSION['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        // debuguear($id);
        if( !$id ) {
            header('Location: /colaborador/dashboard');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /colaborador/dashboard');
        }
    
        // debuguear($usuario);

        // Render a la vista 
        $router->render('colaborador/perfil/index', [
            'titulo' => 'Perfil',
            'usuario' => $usuario
        ]);
    }

    public static function editar_perfil_colaborador(Router $router) {
    
        $alertas = [];
        $usuario = new Usuario;
    
        // Validar el id:
        $id = $_GET['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /colaborador/perfil');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /colaborador/perfil');
        }
    
        // debuguear($usuario);
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        

            // debuguear($usuario);

            // debuguear($_POST);
    
            if( $usuario->nombre !== $_POST['nombre'] ) {
                $usuario->nombre = $_POST['nombre'];
            }
            if( $usuario->apellido1 !== $_POST['apellido1'] ) {
                $usuario->apellido1 = $_POST['apellido1'];
            }
            if( $usuario->apellido2 !== $_POST['apellido2'] ) {
                $usuario->apellido2 = $_POST['apellido2'];
            }
            if( $usuario->email !== $_POST['email'] ) {
                $usuario->email = $_POST['email'];
            }
    
            $usuario->sincronizar($_POST);

            // debuguear($usuario);
    
            $alertas = $usuario->validar_edicion_perfil();
            // debuguear($alertas);
    
            if(empty($alertas)) {
                $resultado = $usuario->guardar();
    
                if ($resultado) {
                    sleep(1);
                    header('Location: /colaborador/perfil?id=' . $usuario->id);
                    exit(); // Asegúrate de llamar a exit() después de header para detener la ejecución del script.
                }
                
            } 
        }

        // $alertas = [];

        // Render a la vista 
        $router->render('colaborador/perfil/editar', [
            'titulo' => 'Editar datos del perfil',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function cambiar_contraseña_colaborador(Router $router) {
    
        //Inicio sesión para que se traiga el dato de $_Session['id']
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $id = s($_GET['id']);
        // debuguear($_SESSION);

        if($id !== $_SESSION['id']) {
            header('Location: /');
        }

        $alertas = [];
        // Identificar el usuario con este id
        $usuario = Usuario::where('id', $id);
        // debuguear($usuario);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Se ha producido un error inesperado. Por favor, inténtalo de nuevo.');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // debuguear($_POST);
            

            // $alertas = $usuario->contraseña_privada();
            // debuguear($alertas);

            //Comprobar si la contraseña plana es igual que la hasheada en la BD
            $contraseña_correcta = password_verify($_POST['password'], $usuario->password );
            // debuguear($contraseña_correcta);

            if($contraseña_correcta) {
                $usuario->sincronizar($_POST);
                // debuguear($usuario);

                $alertas = $usuario->validarPassword();
                // debuguear($alertas);

                if(empty($alertas)) {
                    $usuario->password = $usuario->password2;
                    $usuario->password2 = '';

                    $usuario->hashPassword();

                    // Guardar el usuario en la BD
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        sleep(1.5);
                        header('Location: /colaborador/perfil?id=' . $usuario->id);
                        exit(); 
                    }
                }
            }   
        }

        // Render a la vista 
        $router->render('colaborador/perfil/cambiar_contraseña', [
            'titulo' => 'Cambiar contraseña',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }
    
}