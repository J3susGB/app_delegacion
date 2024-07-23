<?php

namespace Controllers;

use MVC\Router;
use Model\Modalidad;

class ModalidadController {

    public static function añadir_modalidad(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        $modalidad = new Modalidad();
        
        // debuguear($modalidad);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($_POST);

            $modalidad->nombre = $_POST['nombre'];
            
            //Sincronizar con el post:
            $modalidad->sincronizar($_POST);
            // debuguear($_POST);

            // debuguear($modalidad);

            //Validar:
            $alertas = $modalidad->validar_modalidad();

            // debuguear($alertas);
            
            //Guardar el registro
            if(empty($alertas)) {

                //Comprobar si el usuario ya está registrado:
                $existeModalidad = Modalidad::where('nombre', $modalidad->nombre);

                if($existeModalidad) {
                    Modalidad::setAlerta('error', 'Esta modalidad ya esta registrada');
                    $alertas = Modalidad::getAlertas();
                } else {
                    
                    //Guardar en la base de datos:
                    $resultado = $modalidad->guardar();

                    if( $resultado ) {
                        header('Location: /directivo/dashboard/modalidades');
                    }
                }
            }    
        }

        // Render a la vista 
        $router->render('directivo/modalidades/añadir', [
            'titulo' => 'Añadir modalidad',
            'alertas' => $alertas,
            'modalidad'=> $modalidad
        ]);
    }

    public static function editar_modalidad(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
    
        $alertas = [];
        $modalidad = new Modalidad();
    
        // Validar el id:
        $id = $_GET['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /directivo/dashboard/modalidades');
        }
    
        // Obtener el miembro a editar:
        $modalidad = Modalidad::find($id);
    
        if( !$modalidad ) {
            header('Location: /directivo/dashboard/modalidades');
        }
    
        // debuguear($usuario);
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($usuario);

            // debuguear($_POST);
    
            if( $modalidad->nombre !== $_POST['nombre'] ) {
                $modalidad->nombre = $_POST['nombre'];
            }
    
            $modalidad->sincronizar($_POST);

            // debuguear($usuario);
    
            $alertas = $modalidad->validar_modalidad();
            // debuguear($alertas);
    
             //Guardar el registro
             if(empty($alertas)) {

                //Comprobar si el usuario ya está registrado:
                $existeModalidad = Modalidad::where('nombre', $modalidad->nombre);

                if($existeModalidad) {
                    Modalidad::setAlerta('error', 'Esta modalidad ya esta registrada');
                    $alertas = Modalidad::getAlertas();
                } else {
                    
                    //Guardar en la base de datos:
                    $resultado = $modalidad->guardar();

                    if( $resultado ) {
                        header('Location: /directivo/dashboard/modalidades');
                    }
                }
            }    
        }

        // $alertas = [];

        // Render a la vista 
        $router->render('directivo/modalidades/editar', [
            'titulo' => 'Editar modalidad',
            'alertas' => $alertas,
            'modalidad' => $modalidad
        ]);
    }

    public static function eliminar_modalidad() {

        if(!is_directivo()) {
            header('Location: /');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            $id = $_POST['id'];
            $modalidad = Modalidad::find($id);

            if(!isset($modalidad)) {
                header('Location: /directivo/dashboard/modalidades');
            }
            
            $resultado = $modalidad->eliminar();

            if($resultado) {
                sleep(2);
                header('Location: /directivo/dashboard/modalidades');
            }
        }
    }
}