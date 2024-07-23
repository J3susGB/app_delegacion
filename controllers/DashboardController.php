<?php

namespace Controllers;

use MVC\Router;
use Model\Turno;
use Classes\Email;
use Model\Arbitro;
use Model\Usuario;
use Model\Categoria;
use Model\Modalidad;
use Model\Asistencia;

class DashboardController {
    public static function index(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // session_start();
        // debuguear($_SESSION);

        $usuario = new Usuario($_SESSION);
        // debuguear($usuario);
        
        // Render a la vista 
        $router->render('directivo/dashboard/index', [
            'titulo' => 'Elige modalidad',
            'usuario' => $usuario
        ]);
    }

    public static function index_colaborador(Router $router) {
        $alertas = [];

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Validar el id:
        $id = $_SESSION['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /colaborador/dashboard');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /colaborador/dashboard');
        }

        // debuguear($usuario);

        $miembros = Arbitro::allOrderByNombre('ASC');
        $categorias = Categoria::all('ASC');
        $modalidades = Modalidad::all('ASC');
        $turnos = Turno::all('ASC');

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

            //Asignos los miembros válidos al post:
            $_POST['miembros'] = $miembros_filtrados;

            // Recuperar la fecha de la solicitud POST y convertirla
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
            $fecha_convertida = $fecha ? date('d/m/y', strtotime($fecha)) : null;
            // debuguear($fecha);

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

            // //Creo objeto asistencia para almacenar los datos del post
            // $asistencias = new Asistencia($_POST);
            // // debuguear($asistencias);

            // //Sincronizo asistencia con el post
            // $asistencias->fecha = $_POST['fecha'];
            // $asistencias->fecha_formateada = $_POST['fecha_formateada'];
            // $asistencias->mes = $_POST['mes'];
            // $asistencias->id_turno = $_POST['turno'];
            // // $asistencias->id_arbitro = $_POST['miembros']['id'];
            // // $asistencias->asiste = $_POST['miembros']['asiste'];
            // // $asistencias->id_categoria = $_POST['miembros']['categoria_id'];
            // $asistencias->id_responsable = $_POST['id_responsable'];
            // $asistencias->observaciones = $_POST['observaciones'];

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
                
                // Añadir el objeto al array de asistencias
                $asistenciasArray[] = $asistencia;

                // debuguear($asistencia);
            }

            // Aquí puedes guardar cada asistencia en la base de datos
            foreach($asistenciasArray as $asistencia) {
                // Guarda el objeto asistencia en la base de datos
                $alertas = $asistencia->validar_asistencia();
                // debuguear($alertas);

                if(empty($alertas)) {
                    $asistencia->guardar();
                    sleep(1.5);
                    header('Location: /colaborador/dashboard');
                }
            }
        }
        
        // Render a la vista 
        $router->render('colaborador/dashboard/index', [
            'titulo' => 'Lista',
            'miembros' => $miembros,
            'categorias' => $categorias,
            'modalidades' => $modalidades,
            'usuario' => $usuario,
            'turnos' => $turnos
        ]);
    }

    public static function futbol(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        //Traigo todos los árbitros:
        $arbitros = Arbitro::allOrderByNombre('ASC');
        // debuguear($arbitros);

        $arbitros = array_filter($arbitros, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->id_modalidad === "1";
        });

        //Traigo todas las categorías:
        $categorias = Categoria::all('ASC');
        // debuguear($categorias);

        //Traigo todas las modalidades:
        $modalidades = Modalidad::all('ASC');
        // debuguear($modalidades);

        //Cruzo los datos entre árbitros y modalidades para añadir el nombre de la modalidad al arbitro
        foreach($arbitros as $arbitro) {
            $arbitro->nombre_modalidad = null;
            foreach($modalidades as $modalidad) {
                if($arbitro->id_modalidad === $modalidad->id) {
                    $arbitro->nombre_modalidad = $modalidad->nombre;
                }
            }
        }

        // debuguear($arbitros);
        
        // Render a la vista 
        $router->render('directivo/dashboard/futbol', [
            'titulo' => 'Fútbol',
            'alertas' => $alertas,
            'arbitros' => $arbitros,
            'categorias' => $categorias
        ]);
    }

    public static function futsal(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        //Traigo todos los árbitros:
        $arbitros = Arbitro::allOrderByNombre('ASC');
        // debuguear($arbitros);

        $arbitros = array_filter($arbitros, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->id_modalidad === "2";
        });

        //Traigo todas las categorías:
        $categorias = Categoria::all('ASC');
        // debuguear($categorias);

        //Traigo todas las modalidades:
        $modalidades = Modalidad::all('ASC');
        // debuguear($modalidades);

        //Cruzo los datos entre árbitros y modalidades para añadir el nombre de la modalidad al arbitro
        foreach($arbitros as $arbitro) {
            $arbitro->nombre_modalidad = null;
            foreach($modalidades as $modalidad) {
                if($arbitro->id_modalidad === $modalidad->id) {
                    $arbitro->nombre_modalidad = $modalidad->nombre;
                }
            }
        }

        // debuguear($arbitros);
        
        // Render a la vista 
        $router->render('directivo/dashboard/futsal', [
            'titulo' => 'Fútbol Sala',
            'alertas' => $alertas,
            'arbitros' => $arbitros,
            'categorias' => $categorias
        ]);
    }

    public static function futfem(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        //Traigo todos los árbitros:
        $arbitros = Arbitro::allOrderByNombre('ASC');
        // debuguear($arbitros);

        $arbitros = array_filter($arbitros, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->femenino === "1";
        });

        //Traigo todas las categorías:
        $categorias = Categoria::all('ASC');
        // debuguear($categorias);

        //Traigo todas las modalidades:
        $modalidades = Modalidad::all('ASC');
        // debuguear($modalidades);

        //Cruzo los datos entre árbitros y modalidades para añadir el nombre de la modalidad al arbitro
        foreach($arbitros as $arbitro) {
            $arbitro->nombre_modalidad = null;
            foreach($modalidades as $modalidad) {
                if($arbitro->id_modalidad === $modalidad->id) {
                    $arbitro->nombre_modalidad = $modalidad->nombre;
                }
            }
        }

        // debuguear($arbitros);
        
        // Render a la vista 
        $router->render('directivo/dashboard/futfem', [
            'titulo' => 'Fútbol Femenino',
            'alertas' => $alertas,
            'arbitros' => $arbitros,
            'categorias' => $categorias
        ]);
    }

    public static function playa(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        $alertas = [];

        //Traigo todos los árbitros:
        $arbitros = Arbitro::allOrderByNombre('ASC');
        // debuguear($arbitros);

        $arbitros = array_filter($arbitros, function($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->playa === "1";
        });

        //Traigo todas las categorías:
        $categorias = Categoria::all('ASC');
        // debuguear($categorias);

        //Traigo todas las modalidades:
        $modalidades = Modalidad::all('ASC');
        // debuguear($modalidades);

        //Cruzo los datos entre árbitros y modalidades para añadir el nombre de la modalidad al arbitro
        foreach($arbitros as $arbitro) {
            $arbitro->nombre_modalidad = null;
            foreach($modalidades as $modalidad) {
                if($arbitro->id_modalidad === $modalidad->id) {
                    $arbitro->nombre_modalidad = $modalidad->nombre;
                }
            }
        }

        // debuguear($arbitros);
        
        // Render a la vista 
        $router->render('directivo/dashboard/playa', [
            'titulo' => 'Fútbol Playa',
            'alertas' => $alertas,
            'arbitros' => $arbitros,
            'categorias' => $categorias
        ]);
    }

    public static function usuarios(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        //Traigo todos los árbitros:
        $usuarios = Usuario::allOrderByNombre('ASC');
        // debuguear($usuarios);

        // Render a la vista 
        $router->render('directivo/dashboard/usuarios', [
            'titulo' => 'Usuarios',
            'usuarios' => $usuarios
        ]);
    }

    public static function modalidades(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        //Traigo todos los árbitros:
        $modalidades = Modalidad::all('ASC');
        // debuguear($usuarios);

        // Render a la vista 
        $router->render('directivo/dashboard/modalidades', [
            'titulo' => 'Modalidades',
            'modalidades' => $modalidades
        ]);
    }

    public static function categorias(Router $router) {

        if(!is_directivo()) {
            header('Location: /');
        }

        //Traigo todos los árbitros:
        $categorias = Categoria::all('ASC');
        // debuguear($usuarios);

        // Render a la vista 
        $router->render('directivo/dashboard/categorias', [
            'titulo' => 'Categorías',
            'categorias' => $categorias
        ]);
    }

    public static function turnos(Router $router) {
        if(!is_directivo()) {
            header('Location: /');
        }

        //Traigo todos los árbitros:
        $turnos = Turno::all('ASC');
        // debuguear($turnos);

        // Render a la vista 
        $router->render('directivo/dashboard/turnos', [
            'titulo' => 'Turnos',
            'turnos' => $turnos
        ]);
    }

    public static function perfil(Router $router) {

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

        // Render a la vista 
        $router->render('directivo/dashboard/perfil', [
            'titulo' => 'Perfil',
            'usuario' => $usuario
        ]);
    }

    public static function lista_fem(Router $router) {
    
        $alertas = [];
        $usuario = new Usuario;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Validar el id:
        $id = $_SESSION['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /colaborador/dashboard');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /colaborador/dashboard');
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
                    header('Location: /colaborador/dashboard');
                }
            }
        }

        // Render a la vista 
        $router->render('colaborador/dashboard/lista_fem', [
            'titulo' => 'Lista Fútbol femenino', 
            'miembros' => $miembros,
            'categorias' => $categorias,
            'modalidades' => $modalidades,
            'usuario' => $usuario,
            'turnos' => $turnos
        ]);
    }

    public static function lista_playa(Router $router) {
    
        $alertas = [];
        $usuario = new Usuario;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Validar el id:
        $id = $_SESSION['id']; // Leer el id de la url
        $id = filter_var($id, FILTER_VALIDATE_INT); // Validar que este id siempre sea un número entero
    
        if( !$id ) {
            header('Location: /colaborador/dashboard');
        }
    
        // Obtener el miembro a editar:
        $usuario = Usuario::find($id);
    
        if( !$usuario ) {
            header('Location: /colaborador/dashboard');
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
                    header('Location: /colaborador/dashboard');
                }
            }
        }

        // Render a la vista 
        $router->render('colaborador/dashboard/lista_playa', [
            'titulo' => 'Lista Fútbol playa', 
            'miembros' => $miembros,
            'categorias' => $categorias,
            'modalidades' => $modalidades,
            'usuario' => $usuario,
            'turnos' => $turnos
        ]);
    }

}