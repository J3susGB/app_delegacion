<?php

namespace Controllers;

use MVC\Router;
use Model\Arbitro;
use Model\Categoria;
use Model\Modalidad;
use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Drivers\Gd\Driver;


class ArbitroController {

    //FÚTBOL
    
    public static function añadir_futbol(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        $arbitro = new Arbitro();
        // debuguear($arbitro);

        //Me traigo todas las modalidades
        $modalidades = Modalidad::all('ASC');
        // debuguear($modalidades);

        //Me traigo todas las categorías
        $categorias = Categoria::all('ASC');

        $categorias = array_filter($categorias, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->id_modalidad === "1" || $tot->id_modalidad === null ;
        });
        // debuguear($categorias);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            $modalidad = "1";
            // debuguear($_POST);

            //Leer imagen:
            if( !empty($_FILES['foto']['tmp_name'])) {
                //Crear una carpeta para las imágenes
                $carpeta_imagenes = '../public/img/arbitros';

                //Si la carpeta no existe, la creará
                if( !is_dir($carpeta_imagenes) ) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                //Crea las imágenes
                $nombre_imagen =$_POST['nombre'] . " " . $_POST['apellido1'] . " " .$_POST['apellido2'];
                // $nombre_imagen = md5( uniqid( rand(), true ) );

                $manager = new ImageManager(new Driver());

                $imagen_png = $manager->read( $_FILES['foto']['tmp_name'] );
                $imagen_png->scale(800,800);
                
                $imagen_webp = $manager->read( $_FILES['foto']['tmp_name'] );
                $imagen_webp->scale(800,800);

                $imagen_avif = $manager->read( $_FILES['foto']['tmp_name'] );
                $imagen_avif->scale(800,800);

                //Agregar el nombre de la imagen al POST:
                $_POST['foto'] = $nombre_imagen;
            }

            // debuguear($arbitro);

            $arbitro->id_modalidad = $modalidad;
            $arbitro->id_categoria = $_POST['categoria'];
            $arbitro->femenino = $_POST['femenino'];
            $arbitro->playa = $_POST['playa'];

            // debuguear($arbitro);

            //Sincronizar con el post:
            $arbitro->sincronizar($_POST);
            // debuguear($_POST);

            // debuguear($arbitro);

            //Validar:
            $alertas = $arbitro->validar_arbitro();

            // debuguear($alertas);
            
            //Guardar el registro
            if(empty($alertas)) {
                //Guardar las imágenes:
                $imagen_png->toPng()->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->toWebp()->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                $imagen_avif->toAvif()->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif');

                $resultado = $arbitro->guardar();
                if( $resultado ) {
                    header('Location: /directivo/dashboard/futbol');
                }
            }    
        }

        // Render a la vista 
        $router->render('directivo/futbol/añadir', [
            'titulo' => 'Añadir árbitro/a de Fútbol',
            'alertas' => $alertas,
            'modalidades' => $modalidades,
            'categorias' => $categorias
        ]);
    }

    public static function editar_futbol(Router $router)
    {
        if (!is_directivo()) {
            header('Location: /');
        }

        $contador_ediciones = 1;
        $alertas = [];
        $categoria = Categoria::all('ASC');
        $modalidad = Modalidad::all('ASC');
        $arbitro = new Arbitro();

        // Validar el id:
        $id = $_GET['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero

        // debuguear($id);

        if (!$id) {
            header('Location: /dashboard/futbol');
        }

        // Obtener el miembro a editar:
        $arbitro = Arbitro::find($id);
        // debuguear($arbitro);

        // debuguear($modalidad);

        if (!$arbitro) {
            header('Location: /dashboard/futbol');
        }

        $arbitro->foto_actual = null;
        if (!$arbitro->foto_actual) {
            $arbitro->foto_actual = $arbitro->foto;
        }

        // debuguear($arbitro);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contador_ediciones++;
            // debuguear($arbitro);

            if (!is_directivo()) {
                header('Location: /');
            }

            $modalidad = "1";
            // debuguear($_POST);

            //Leer imagen:
            if (!empty($_FILES['foto']['tmp_name'])) {

                //Crear una carpeta para las imágenes
                $carpeta_imagenes = '../public/img/arbitros';

                //Si la carpeta no existe, la creará
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                //Crea las imágenes

                $nombre_imagen = $_POST['nombre'] . " " . $_POST['apellido1'] . " " . $_POST['apellido2'] . "-edit" . $contador_ediciones;

                // $nombre_imagen = md5( uniqid( rand(), true ) );

                $manager = new ImageManager(new Driver());

                $imagen_png = $manager->read($_FILES['foto']['tmp_name']);
                $imagen_png->scale(800, 800);

                $imagen_webp = $manager->read($_FILES['foto']['tmp_name']);
                $imagen_webp->scale(800, 800);

                $imagen_avif = $manager->read($_FILES['foto']['tmp_name']);
                $imagen_avif->scale(800, 800);

                // Eliminar la foto antigua del servidor
                if ($arbitro->foto_actual) {
                    $foto_actual = $arbitro->foto_actual;
                    $formatos = ['png', 'webp', 'avif'];
                    foreach ($formatos as $formato) {
                        $archivo = $carpeta_imagenes . '/' . $foto_actual . '.' . $formato;
                        if (file_exists($archivo)) {
                            unlink($archivo);
                        }
                    }
                }

                // Agregar el nombre de la imagen al POST
                $_POST['foto'] = $nombre_imagen;
            } else {
                $_POST['foto'] = $arbitro->foto_actual;
            }

            // debuguear($_POST);

            if ($arbitro->nombre !== $_POST['nombre']) {
                $arbitro->nombre = $_POST['nombre'];
            }
            if ($arbitro->apellido1 !== $_POST['apellido1']) {
                $arbitro->apellido1 = $_POST['apellido1'];
            }
            if ($arbitro->apellido2 !== $_POST['apellido2']) {
                $arbitro->apellido2 = $_POST['apellido2'];
            }
            if ($arbitro->id_modalidad !== $_POST['modalidad']) {
                $arbitro->id_modalidad = $_POST['modalidad'];
            }
            if ($arbitro->id_categoria !== $_POST["categoria"]) {
                $arbitro->id_categoria = $_POST["categoria"];
            }
            if ($arbitro->femenino !== $_POST["femenino"]) {
                $arbitro->femenino = $_POST["femenino"];
            }
            if ($arbitro->playa !== $_POST["playa"]) {
                $arbitro->playa = $_POST["playa"];
            }
            if ($arbitro->foto !== $_POST["foto"]) {
                $arbitro->foto = $_POST["foto"];
            }

            $arbitro->sincronizar($_POST);

            // debuguear($arbitro);

            $alertas = $arbitro->validar_edicion_arbitro();
            // debuguear($alertas);

            if (empty($alertas)) {

                if (isset($nombre_imagen)) {
                    // Guardar las imágenes
                    $imagen_png->toPng()->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->toWebp()->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                    $imagen_avif->toAvif()->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif');
                }

                // debuguear($_POST);

                $resultado = $arbitro->guardar();

                if ($resultado) {
                    sleep(1.5);
                    header('Location: /directivo/dashboard/futbol');
                }
            }
        }

        // Render a la vista 
        $router->render('directivo/futbol/editar', [
            'titulo' => 'Editar árbitro/a de Fútbol',
            'alertas' => $alertas,
            'arbitro' => $arbitro,
            'modalidad' => $modalidad,
            'categoria' => $categoria
        ]);
    }

    public static function eliminar_futbol() {

        if(!is_directivo()) {
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /login');
            }

            $id = $_POST['id'];
            $arbitro = Arbitro::find($id);

            if(!isset($arbitro)) {
                header('Location: /directivo/dashboard/futbol');
            }
            
            $resultado = $arbitro->eliminar();

            // Eliminar la foto del servidor
            $carpeta_imagenes = '../public/img/arbitros';
            if ($arbitro->foto) {
                $foto= $arbitro->foto;
                $formatos = ['png', 'webp', 'avif'];
                foreach ($formatos as $formato) {
                    $archivo = $carpeta_imagenes . '/' . $foto . '.' . $formato;
                    if (file_exists($archivo)) {
                        unlink($archivo);
                    }
                }
            }

            if($resultado) {
                sleep(2);
                header('Location: /directivo/dashboard/futbol');
            }
        }
    }
    
    //FÚTBOL SALA
    
    public static function añadir_futsal(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        $arbitro = new Arbitro();
        // debuguear($arbitro);

        //Me traigo todas las modalidades
        $modalidades = Modalidad::all('ASC');
        // debuguear($modalidades);

        //Me traigo todas las categorías
        $categorias = Categoria::all('ASC');

        $categorias = array_filter($categorias, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->id_modalidad === "2" || $tot->id_modalidad === null ;
        });
        // debuguear($categorias);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /');
            }

            $modalidad = "2";
            // debuguear($_POST);

            //Leer imagen:
            if( !empty($_FILES['foto']['tmp_name'])) {
                //Crear una carpeta para las imágenes
                $carpeta_imagenes = '../public/img/arbitros';

                //Si la carpeta no existe, la creará
                if( !is_dir($carpeta_imagenes) ) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                //Crea las imágenes
                $nombre_imagen =$_POST['nombre'] . " " . $_POST['apellido1'] . " " .$_POST['apellido2'];
                // $nombre_imagen = md5( uniqid( rand(), true ) );

                $manager = new ImageManager(new Driver());

                $imagen_png = $manager->read( $_FILES['foto']['tmp_name'] );
                $imagen_png->scale(800,800);
                
                $imagen_webp = $manager->read( $_FILES['foto']['tmp_name'] );
                $imagen_webp->scale(800,800);

                $imagen_avif = $manager->read( $_FILES['foto']['tmp_name'] );
                $imagen_avif->scale(800,800);

                //Agregar el nombre de la imagen al POST:
                $_POST['foto'] = $nombre_imagen;
            }

            $arbitro->id_modalidad = $modalidad;
            $arbitro->id_categoria = $_POST['categoria'];
            $arbitro->femenino = $_POST['femenino'];
            $arbitro->playa = $_POST['playa'];

            //Sincronizar con el post:
            $arbitro->sincronizar($_POST);
            // debuguear($_POST);

            // debuguear($arbitro);

            //Validar:
            $alertas = $arbitro->validar_arbitro();

            // debuguear($alertas);
            
            //Guardar el registro
            if(empty($alertas)) {
                //Guardar las imágenes:
                $imagen_png->toPng()->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->toWebp()->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                $imagen_avif->toAvif()->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif');

                $resultado = $arbitro->guardar();
                if( $resultado ) {
                    header('Location: /directivo/dashboard/futsal');
                }
            }    
        }

        // Render a la vista 
        $router->render('directivo/futsal/añadir', [
            'titulo' => 'Añadir árbitro/a de Fútbol Sala',
            'alertas' => $alertas,
            'modalidades' => $modalidades,
            'categorias' => $categorias
        ]);
    }

    public static function editar_futsal(Router $router)
    {

        if (!is_directivo()) {
            header('Location: /');
        }

        $contador_ediciones = 1;
        $alertas = [];
        $categoria = Categoria::all('ASC');
        $modalidad = Modalidad::all('ASC');
        $arbitro = new Arbitro();

        // Validar el id:
        $id = $_GET['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero

        // debuguear($id);

        if (!$id) {
            header('Location: /dashboard/futsal');
        }

        // Obtener el miembro a editar:
        $arbitro = Arbitro::find($id);
        // debuguear($arbitro);

        // debuguear($modalidad);

        if (!$arbitro) {
            header('Location: /dashboard/futsal');
        }

        $arbitro->foto_actual = null;
        if (!$arbitro->foto_actual) {
            $arbitro->foto_actual = $arbitro->foto;
        }

        // debuguear($arbitro);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contador_ediciones++;
            // debuguear($arbitro);

            if (!is_directivo()) {
                header('Location: /');
            }

            $modalidad = "2";
            // debuguear($_POST);

            //Leer imagen:
            if (!empty($_FILES['foto']['tmp_name'])) {

                //Crear una carpeta para las imágenes
                $carpeta_imagenes = '../public/img/arbitros';

                //Si la carpeta no existe, la creará
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                //Crea las imágenes

                $nombre_imagen = $_POST['nombre'] . " " . $_POST['apellido1'] . " " . $_POST['apellido2'] . "-edit" . $contador_ediciones;

                // $nombre_imagen = md5( uniqid( rand(), true ) );

                $manager = new ImageManager(new Driver());

                $imagen_png = $manager->read($_FILES['foto']['tmp_name']);
                $imagen_png->scale(800, 800);

                $imagen_webp = $manager->read($_FILES['foto']['tmp_name']);
                $imagen_webp->scale(800, 800);

                $imagen_avif = $manager->read($_FILES['foto']['tmp_name']);
                $imagen_avif->scale(800, 800);

                // Eliminar la foto antigua del servidor
                if ($arbitro->foto_actual) {
                    $foto_actual = $arbitro->foto_actual;
                    $formatos = ['png', 'webp', 'avif'];
                    foreach ($formatos as $formato) {
                        $archivo = $carpeta_imagenes . '/' . $foto_actual . '.' . $formato;
                        if (file_exists($archivo)) {
                            unlink($archivo);
                        }
                    }
                }

                // Agregar el nombre de la imagen al POST
                $_POST['foto'] = $nombre_imagen;
            } else {
                $_POST['foto'] = $arbitro->foto_actual;
            }

            // debuguear($_POST);

            if ($arbitro->nombre !== $_POST['nombre']) {
                $arbitro->nombre = $_POST['nombre'];
            }
            if ($arbitro->apellido1 !== $_POST['apellido1']) {
                $arbitro->apellido1 = $_POST['apellido1'];
            }
            if ($arbitro->apellido2 !== $_POST['apellido2']) {
                $arbitro->apellido2 = $_POST['apellido2'];
            }
            if ($arbitro->id_modalidad !== $_POST['modalidad']) {
                $arbitro->id_modalidad = $_POST['modalidad'];
            }
            if ($arbitro->id_categoria !== $_POST["categoria"]) {
                $arbitro->id_categoria = $_POST["categoria"];
            }
            if ($arbitro->femenino !== $_POST["femenino"]) {
                $arbitro->femenino = $_POST["femenino"];
            }
            if ($arbitro->playa !== $_POST["playa"]) {
                $arbitro->playa = $_POST["playa"];
            }
            if ($arbitro->foto !== $_POST["foto"]) {
                $arbitro->foto = $_POST["foto"];
            }

            $arbitro->sincronizar($_POST);

            // debuguear($arbitro);

            $alertas = $arbitro->validar_edicion_arbitro();
            // debuguear($alertas);

            if (empty($alertas)) {

                if (isset($nombre_imagen)) {
                    // Guardar las imágenes
                    $imagen_png->toPng()->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->toWebp()->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                    $imagen_avif->toAvif()->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif');
                }

                // debuguear($_POST);

                $resultado = $arbitro->guardar();

                if ($resultado) {
                    sleep(1.5);
                    header('Location: /directivo/dashboard/futsal');
                }
            }
        }

        // Render a la vista 
        $router->render('directivo/futsal/editar', [
            'titulo' => 'Editar árbitro/a de Fútbol Sala',
            'alertas' => $alertas,
            'arbitro' => $arbitro,
            'modalidad' => $modalidad,
            'categoria' => $categoria
        ]);
    }

    public static function eliminar_futsal() {

        if(!is_directivo()) {
            header('Location: /login');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!is_directivo()) {
                header('Location: /login');
            }

            $id = $_POST['id'];
            $arbitro = Arbitro::find($id);

            if(!isset($arbitro)) {
                header('Location: /directivo/dashboard/futbol');
            }
            
            $resultado = $arbitro->eliminar();

            // Eliminar la foto del servidor
            $carpeta_imagenes = '../public/img/arbitros';
            if ($arbitro->foto) {
                $foto= $arbitro->foto;
                $formatos = ['png', 'webp', 'avif'];
                foreach ($formatos as $formato) {
                    $archivo = $carpeta_imagenes . '/' . $foto . '.' . $formato;
                    if (file_exists($archivo)) {
                        unlink($archivo);
                    }
                }
            }

            if($resultado) {
                sleep(2);
                header('Location: /directivo/dashboard/futsal');
            }
        }
    }

}