<?php

namespace Controllers;

use MVC\Router;
use Model\Turno;

class TurnoController {

    public static function añadir_turno(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        $turno = new Turno();
        
        // debuguear($modalidad);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($_POST);

            $turno->nombre = $_POST['nombre'];
            
            //Sincronizar con el post:
            $turno->sincronizar($_POST);
            // debuguear($_POST);

            // debuguear($modalidad);

            //Validar:
            $alertas = $turno->validar_turno();

            // debuguear($alertas);
            
            //Guardar el registro
            if(empty($alertas)) {

                //Comprobar si el usuario ya está registrado:
                $existeTurno = Turno::where('nombre', $turno->nombre);

                if($existeTurno) {
                    Turno::setAlerta('error', 'Esta turno ya esta registrado');
                    $alertas = Turno::getAlertas();
                } else {
                    
                    //Guardar en la base de datos:
                    $resultado = $turno->guardar();

                    if( $resultado ) {
                        header('Location: /directivo/dashboard/turnos');
                    }
                }
            }    
        }

        // Render a la vista 
        $router->render('directivo/turnos/añadir', [
            'titulo' => 'Añadir Turno',
            'alertas' => $alertas,
            'turno'=> $turno
        ]);
    }

    public static function editar_turno(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
    
        $alertas = [];
        $turno = new Turno();
    
        // Validar el id:
        $id = $_GET['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /directivo/dashboard/turnos');
        }
    
        // Obtener el miembro a editar:
        $turno = Turno::find($id);
    
        if( !$turno ) {
            header('Location: /directivo/dashboard/turnos');
        }
    
        // debuguear($usuario);
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($usuario);

            // debuguear($_POST);
    
            if( $turno->nombre !== $_POST['nombre'] ) {
                $turno->nombre = $_POST['nombre'];
            }
    
            $turno->sincronizar($_POST);

            // debuguear($usuario);
    
            $alertas = $turno->validar_turno();
            // debuguear($alertas);
    
             //Guardar el registro
             if(empty($alertas)) {

                //Comprobar si el usuario ya está registrado:
                $existeTruno = Turno::where('nombre', $turno->nombre);

                if($existeTruno) {
                    Turno::setAlerta('error', 'Este turno ya esta registrado');
                    $alertas = Turno::getAlertas();
                } else {
                    
                    //Guardar en la base de datos:
                    $resultado = $turno->guardar();

                    if( $resultado ) {
                        header('Location: /directivo/dashboard/turnos');
                    }
                }
            }    
        }

        // $alertas = [];

        // Render a la vista 
        $router->render('directivo/turnos/editar', [
            'titulo' => 'Editar Turno',
            'alertas' => $alertas,
            'turno' => $turno
        ]);
    }

    public static function eliminar_turno() {

        if(!is_directivo()) {
            header('Location: /');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            $id = $_POST['id'];
            $turno = Turno::find($id);

            if(!isset($turno)) {
                header('Location: /directivo/dashboard/turnos');
            }
            
            $resultado = $turno->eliminar();

            if($resultado) {
                sleep(2);
                header('Location: /directivo/dashboard/turnos');
            }
        }
    }
}