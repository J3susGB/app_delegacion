<?php

namespace Controllers;

use MVC\Router;
use Model\Arbitro;
use Model\Asistencia;
use Model\Usuario;
use Model\Categoria;
use Model\Modalidad;
use Model\Turno;

class ListaController {

    public static function index(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
    
        $alertas = [];
        $usuario = new Usuario;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Validar el id:
        $id = $_SESSION['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /directivo/lista');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /directivo/lista');
        }

        // debuguear($usuario);

        $miembros = Arbitro::allOrderByNombre('ASC');
        $categorias = Categoria::all('ASC');
        $modalidades = Modalidad::all('ASC');
        $turnos = Turno::all('ASC');

        $modalidades = array_filter($modalidades, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->id !== "3";
        });

        // debuguear($modalidades);

        // debuguear($miembros);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // debuguear($_POST);

            //Asigno la categoría a la que pertecence la asistencia:
            $id_categoria = $_POST['filtroCategoria'];
            // debuguear($id_categoria);

            // Filtrar miembros por id_categoria
            $miembros_filtrados = array_filter($_POST['miembros'], function($miembro) use ($id_categoria) {
                return $miembro['categoria_id'] == $id_categoria;
            });

            // debuguear($miembros_filtrados);

            // foreach($miembros_filtrados as $filtrados) {
            //     $filtrados['femenino'] = null;
            //     $filtrados['playa'] = null;

            //     foreach($miembros as $miembro) {
            //         if($filtrados['id'] == $miembro->id) {
            //             $filtrados['femenino'] = $miembro->femenino;
            //             $filtrados['playa'] = $miembro->playa;
            //         }
            //     }
            // }

            // debuguear($miembros_filtrados);

            //Asignos los miembros válidos al post:
            $_POST['miembros'] = $miembros_filtrados;

            // Recuperar la fecha de la solicitud POST y convertirla
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
            $fecha_convertida = $fecha ? date('d/m/y', strtotime($fecha)) : null;
            // debuguear($fecha);

            // Inicializar el índice 'fecha formateada' como null
            if (!isset($_POST['fecha_formateada'])) {
                $_POST['fecha_formateada'] = null;
            }

            //Añadir la fecha convertida al post:
            if( !$_POST['fecha_formateada'] ) {
                $_POST['fecha_formateada'] = $fecha_convertida;
            }

            //Añadir una columna mes al post:
            // Dividir la fecha en partes (día, mes, año)
            $partes_fecha = explode('-', $fecha);

            // Obtener el mes
            $mes = $partes_fecha[1];
            // debuguear($mes);

            // Inicializar el índice 'mes' como null
            if (!isset($_POST['mes'])) {
                $_POST['mes'] = null;
            }

            // Añadir el mes al post si está vacío o es null
            if (!$_POST['mes']) {
                $_POST['mes'] = $mes;
            }

            // debuguear($_POST);

            // Recuperar el array de miembros de la solicitud POST
            $miembrosPost = isset($_POST['miembros']) ? $_POST['miembros'] : null;
            
            // Verificar que el array de miembros sea válido
            if (!is_array($miembrosPost)) {
                // Manejar el error según tus necesidades (por ejemplo, enviar un mensaje de error)
                return;
            }

            // debuguear($miembrosPost);

            // Array para almacenar los objetos de asistencia
            $asistenciasArray = [];

            // Recorro los miembros y creo un nuevo objeto asistencia para cada uno
            foreach($miembrosPost as $miembro) {
                // Crear una nueva instancia para cada miembro
                $asistencia = new Asistencia();
                
                // Asignar los datos comunes
                $asistencia->fecha = $_POST['fecha'];
                $asistencia->fecha_formateada = $_POST['fecha_formateada'];
                $asistencia->mes = $_POST['mes'];
                $asistencia->id_turno = $_POST['turno'];
                $asistencia->id_responsable = $_POST['id_responsable'];
                $asistencia->observaciones = $_POST['observaciones'];
                
                // Asignar los datos específicos del miembro
                $asistencia->id_arbitro = $miembro['id'];
                $asistencia->asiste = $miembro['asiste'];
                $asistencia->id_categoria = $miembro['categoria_id'];

                // foreach($miembros as $arbi) {
                //     $asistencia->femenino = null;
                //     $asistencia->playa = null;
                //     if($asistencia->id_arbitro == $arbi->id) {
                //         $asistencia->femenino = $arbi->femenino;
                //         $asistencia->playa = $arbi->playa;
                //     }
                // }
                
                // Añadir el objeto al array de asistencias
                $asistenciasArray[] = $asistencia;

                // debuguear($asistenciasArray);
            }

            // Aquí puedes guardar cada asistencia en la base de datos
            foreach($asistenciasArray as $asistencia) {
                // Guarda el objeto asistencia en la base de datos
                $alertas = $asistencia->validar_asistencia();
                // debuguear($alertas);

                if(empty($alertas)) {
                    $asistencia->guardar();
                    sleep(1.5);
                    header('Location: /directivo/dashboard');
                }
            }
        }

        // Render a la vista 
        $router->render('directivo/lista/index', [
            'titulo' => 'Lista', 
            'miembros' => $miembros,
            'categorias' => $categorias,
            'modalidades' => $modalidades,
            'usuario' => $usuario,
            'turnos' => $turnos
        ]);
    }

    public static function lista_fem(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
    
        $alertas = [];
        $usuario = new Usuario;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Validar el id:
        $id = $_SESSION['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /directivo/lista');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /directivo/lista');
        }

        // debuguear($usuario);

        $miembros = Arbitro::allOrderByNombre('ASC');
        $categorias = Categoria::all('ASC');
        $modalidades = Modalidad::all('ASC');
        $turnos = Turno::all('ASC');

        $miembros = array_filter($miembros, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->femenino === "1";
        });
        $miembros = array_filter($miembros, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->id_modalidad === "1";
        });

        $modalidades = array_filter($modalidades, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->id !== "3";
        });

        // debuguear($modalidades);

        // debuguear($miembros);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // debuguear($_POST);

            //Asigno la categoría a la que pertecence la asistencia:
            $id_categoria = 'Femenino';
            // debuguear($id_categoria);
            // debuguear($_POST);

            // Recuperar la fecha de la solicitud POST y convertirla
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
            $fecha_convertida = $fecha ? date('d/m/y', strtotime($fecha)) : null;
            // debuguear($fecha);

            // Inicializar el índice 'fecha formateada' como null
            if (!isset($_POST['fecha_formateada'])) {
                $_POST['fecha_formateada'] = null;
            }

            //Añadir la fecha convertida al post:
            if( !$_POST['fecha_formateada'] ) {
                $_POST['fecha_formateada'] = $fecha_convertida;
            }

            //Añadir una columna mes al post:
            // Dividir la fecha en partes (día, mes, año)
            $partes_fecha = explode('-', $fecha);

            // Obtener el mes
            $mes = $partes_fecha[1];
            // debuguear($mes);

            // Inicializar el índice 'mes' como null
            if (!isset($_POST['mes'])) {
                $_POST['mes'] = null;
            }

            //Añadir el mes al post:
            if( !$_POST['mes'] ) {
                $_POST['mes'] = $mes;
            }

            // debuguear($_POST);

            // Recuperar el array de miembros de la solicitud POST
            $miembrosPost = isset($_POST['miembros']) ? $_POST['miembros'] : null;
            
            // Verificar que el array de miembros sea válido
            if (!is_array($miembrosPost)) {
                // Manejar el error según tus necesidades (por ejemplo, enviar un mensaje de error)
                return;
            }

            // debuguear($miembrosPost);

            // Array para almacenar los objetos de asistencia
            $asistenciasArray = [];

            // Recorro los miembros y creo un nuevo objeto asistencia para cada uno
            foreach($miembrosPost as $miembro) {
                // Crear una nueva instancia para cada miembro
                $asistencia = new Asistencia();
                
                // Asignar los datos comunes
                $asistencia->fecha = $_POST['fecha'];
                $asistencia->fecha_formateada = $_POST['fecha_formateada'];
                $asistencia->mes = $_POST['mes'];
                $asistencia->id_turno = $_POST['turno'];
                $asistencia->id_responsable = $_POST['id_responsable'];
                $asistencia->observaciones = $_POST['observaciones'];
                
                // Asignar los datos específicos del miembro
                $asistencia->id_arbitro = $miembro['id'];
                $asistencia->asiste = $miembro['asiste'];
                $asistencia->id_categoria = $miembro['categoria_id'];
                $asistencia->femenino = "1";
                $asistencia->playa = "0";
                
                // Añadir el objeto al array de asistencias
                $asistenciasArray[] = $asistencia;

                // debuguear($asistenciasArray);
            }

            // Aquí puedes guardar cada asistencia en la base de datos
            foreach($asistenciasArray as $asistencia) {
                // Guarda el objeto asistencia en la base de datos
                $alertas = $asistencia->validar_asistencia();
                // debuguear($alertas);

                if(empty($alertas)) {
                    $asistencia->guardar();
                    sleep(1.5);
                    header('Location: /directivo/dashboard');
                }
            }
        }

        // Render a la vista 
        $router->render('directivo/lista/lista_fem', [
            'titulo' => 'Lista Fútbol femenino', 
            'miembros' => $miembros,
            'categorias' => $categorias,
            'modalidades' => $modalidades,
            'usuario' => $usuario,
            'turnos' => $turnos
        ]);
    }

    public static function lista_playa(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
    
        $alertas = [];
        $usuario = new Usuario;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Validar el id:
        $id = $_SESSION['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /directivo/lista');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /directivo/lista');
        }

        // debuguear($usuario);

        $miembros = Arbitro::allOrderByNombre('ASC');
        $categorias = Categoria::all('ASC');
        $modalidades = Modalidad::all('ASC');
        $turnos = Turno::all('ASC');

        $miembros = array_filter($miembros, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->playa === "1";
        });

        $modalidades = array_filter($modalidades, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->id !== "3";
        });

        // debuguear($modalidades);

        // debuguear($miembros);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // debuguear($_POST);

            //Asigno la categoría a la que pertecence la asistencia:
            $id_categoria = 'Playa';
            // debuguear($id_categoria);
            // debuguear($_POST);

            // Recuperar la fecha de la solicitud POST y convertirla
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
            $fecha_convertida = $fecha ? date('d/m/y', strtotime($fecha)) : null;
            // debuguear($fecha);

            // Inicializar el índice 'fecha formateada' como null
            if (!isset($_POST['fecha_formateada'])) {
                $_POST['fecha_formateada'] = null;
            }

            //Añadir la fecha convertida al post:
            if( !$_POST['fecha_formateada'] ) {
                $_POST['fecha_formateada'] = $fecha_convertida;
            }

            //Añadir una columna mes al post:
            // Dividir la fecha en partes (día, mes, año)
            $partes_fecha = explode('-', $fecha);

            // Obtener el mes
            $mes = $partes_fecha[1];
            // debuguear($mes);

            // Inicializar el índice 'mes' como null
            if (!isset($_POST['mes'])) {
                $_POST['mes'] = null;
            }

            //Añadir el mes al post:
            if( !$_POST['mes'] ) {
                $_POST['mes'] = $mes;
            }

            // debuguear($_POST);

            // Recuperar el array de miembros de la solicitud POST
            $miembrosPost = isset($_POST['miembros']) ? $_POST['miembros'] : null;
            
            // Verificar que el array de miembros sea válido
            if (!is_array($miembrosPost)) {
                // Manejar el error según tus necesidades (por ejemplo, enviar un mensaje de error)
                return;
            }

            // debuguear($miembrosPost);

            // Array para almacenar los objetos de asistencia
            $asistenciasArray = [];

            // Recorro los miembros y creo un nuevo objeto asistencia para cada uno
            foreach($miembrosPost as $miembro) {
                // Crear una nueva instancia para cada miembro
                $asistencia = new Asistencia();
                
                // Asignar los datos comunes
                $asistencia->fecha = $_POST['fecha'];
                $asistencia->fecha_formateada = $_POST['fecha_formateada'];
                $asistencia->mes = $_POST['mes'];
                $asistencia->id_turno = $_POST['turno'];
                $asistencia->id_responsable = $_POST['id_responsable'];
                $asistencia->observaciones = $_POST['observaciones'];
                
                // Asignar los datos específicos del miembro
                $asistencia->id_arbitro = $miembro['id'];
                $asistencia->asiste = $miembro['asiste'];
                $asistencia->id_categoria = $miembro['categoria_id'];
                $asistencia->femenino = "0";
                $asistencia->playa = "1";
                
                // Añadir el objeto al array de asistencias
                $asistenciasArray[] = $asistencia;

                // debuguear($asistenciasArray);
            }

            // Aquí puedes guardar cada asistencia en la base de datos
            foreach($asistenciasArray as $asistencia) {
                // Guarda el objeto asistencia en la base de datos
                $alertas = $asistencia->validar_asistencia();
                // debuguear($alertas);

                if(empty($alertas)) {
                    $asistencia->guardar();
                    sleep(1.5);
                    header('Location: /directivo/dashboard');
                }
            }
        }

        // Render a la vista 
        $router->render('directivo/lista/lista_playa', [
            'titulo' => 'Lista Fútbol playa', 
            'miembros' => $miembros,
            'categorias' => $categorias,
            'modalidades' => $modalidades,
            'usuario' => $usuario,
            'turnos' => $turnos
        ]);
    }
}