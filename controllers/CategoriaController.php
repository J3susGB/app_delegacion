<?php

namespace Controllers;

use MVC\Router;
use Model\Categoria;
use Model\Modalidad;

class CategoriaController {

    public static function añadir_categoria(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        $categoria = new Categoria();

        //Traigo todas las modalidades de la BD
        $modalidades = Modalidad::all('ASC');
        
        // debuguear($modalidad);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($_POST);

            $categoria->nombre = $_POST['nombre'];
            $categoria->id_modalidad = $_POST['modalidad'];
            
            //Sincronizar con el post:
            $categoria->sincronizar($_POST);
            // debuguear($_POST);

            // debuguear($categoria);

            //Validar:
            $alertas = $categoria->validar_categoria();

            // debuguear($alertas);
            
            //Guardar el registro
            if(empty($alertas)) {

                //Comprobar si el usuario ya está registrado:
                $existeModalidad = Categoria::where('nombre', $categoria->nombre);

                if($existeModalidad) {
                    Categoria::setAlerta('error', 'Esta categoría ya esta registrada');
                    $alertas = Categoria::getAlertas();
                } else {
                    //Guardar en la base de datos:
                    $resultado = $categoria->guardar();

                    if( $resultado ) {
                        header('Location: /directivo/dashboard/categorias');
                    }
                }
            }    
        }

        // Render a la vista 
        $router->render('directivo/categorias/añadir', [
            'titulo' => 'Añadir categoría',
            'alertas' => $alertas,
            'modalidades'=> $modalidades
        ]);
    }

    public static function editar_categoria(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
    
        $alertas = [];
        $modalidades = Modalidad::all('ASC');
        $categoria = new Categoria();
    
        // Validar el id:
        $id = $_GET['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /directivo/dashboard/categorias');
        }
    
        // Obtener el miembro a editar:
        $categoria = Categoria::find($id);
    
        if( !$categoria ) {
            header('Location: /directivo/dashboard/categorias');
        }
    
        // debuguear($usuario);
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if(!is_directivo()) {
                header('Location: /');
            }

            // debuguear($categoria);

            // debuguear($_POST);
    
            if( $categoria->nombre !== $_POST['nombre'] ) {
                $categoria->nombre = $_POST['nombre'];
            }
            if( $categoria->id_modalidad !== $_POST['modalidad'] ) {
                $categoria->id_modalidad = $_POST['modalidad'];
            }
    
            $categoria->sincronizar($_POST);

            // debuguear($categoria);
    
            $alertas = $categoria->validar_edicion_categoria();
            // debuguear($alertas);
    
             //Guardar el registro
             if(empty($alertas)) {

                //Comprobar si el usuario ya está registrado:
                $existeCategoria = Categoria::where('nombre', $categoria->nombre);

                if($existeCategoria) {
                    Modalidad::setAlerta('error', 'Esta categoria ya esta registrada');
                    $alertas = Modalidad::getAlertas();
                } else {
                    
                    //Guardar en la base de datos:
                    $resultado = $categoria->guardar();

                    if( $resultado ) {
                        header('Location: /directivo/dashboard/categorias');
                    }
                }
            }    
        }

        // $alertas = [];

        // Render a la vista 
        $router->render('directivo/categorias/editar', [
            'titulo' => 'Editar categoría',
            'alertas' => $alertas,
            'categoria' => $categoria,
            'modalidades' => $modalidades
        ]);
    }

    public static function eliminar_categoria() {

        if(!is_directivo()) {
            header('Location: /');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            $id = $_POST['id'];
            $categoria = Categoria::find($id);

            if(!isset($categoria)) {
                header('Location: /directivo/dashboard/categorias');
            }
            
            $resultado = $categoria->eliminar();

            if($resultado) {
                sleep(2);
                header('Location: /directivo/dashboard/categorias');
            }
        }
    }
}