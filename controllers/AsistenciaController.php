<?php

namespace Controllers;

use MVC\Router;
use Model\Turno;
use Model\Arbitro;
use Model\Usuario;
use Model\Categoria;
use Model\Modalidad;
use Model\Asistencia;

class AsistenciaController
{

    public static function index(Router $router) {

        if (!is_directivo()) {
            header('Location: /');
        }

        $modalidades = Modalidad::all('ASC');
        $modalidades = array_filter($modalidades, function ($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->id !== "3";
        });
        // debuguear($modalidades);

        $categorias = Categoria::all('ASC');
        // debuguear($categorias);

        //Me traigo todas las asistencias
        $asistencias = Asistencia::all('ASC');
        //Quito las asistencias de femenino
        $asistencias = array_filter($asistencias, function ($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->femenino !== "1";
        });
        //Quito las asistencias de playa
        $asistencias = array_filter($asistencias, function ($tot) {
            // Devuelve true para conservar el elemento, false para eliminarlo
            return $tot->playa !== "1";
        });

        // debuguear($asistencias);

        //Me traigo asistencias de femenino
        $asistencias_fem = Asistencia::whereAll('femenino', "1");
        // debuguear($asistencias_fem);

        //Me traigo asistencias de playa
        $asistencias_playa = Asistencia::whereAll('playa', "1");
        // debuguear($asistencias_playa);

        //Me traigo todos los turnos
        $turnos = Turno::all('ASC');

        //Me traigo todos los árbitros
        $arbitros = Arbitro::all();

        //Me traigo todos los usuarios:
        $usuarios = Usuario::all();
        //    debuguear($usuarios);

        //Cruzo datos de asistencias femenino con arbitros para añadir el nombre y apellido a asistencia
        foreach ($asistencias_fem as $asistencia) {
            $asistencia->apellido1 = null;
            $asistencia->apellido2 = null;
            $asistencia->nombre = null;
            foreach ($arbitros as $arbitro) {
                if ($asistencia->id_arbitro == $arbitro->id) {
                    $asistencia->apellido1 = $arbitro->apellido1;
                    $asistencia->apellido2 = $arbitro->apellido2;
                    $asistencia->nombre = $arbitro->nombre;
                }
            }
        }

        //Cruzo datos de asistencia con arbitros para añadir el nombre y apellido a asistencia
        foreach ($asistencias as $asistencia) {
            $asistencia->apellido1 = null;
            $asistencia->apellido2 = null;
            $asistencia->nombre = null;
            foreach ($arbitros as $arbitro) {
                if ($asistencia->id_arbitro == $arbitro->id) {
                    $asistencia->apellido1 = $arbitro->apellido1;
                    $asistencia->apellido2 = $arbitro->apellido2;
                    $asistencia->nombre = $arbitro->nombre;
                }
            }
        }

        //Cruzo datos de asistencia playa con arbitros para añadir el nombre y apellido a asistencia
        foreach ($asistencias_playa as $asistencia) {
            $asistencia->apellido1 = null;
            $asistencia->apellido2 = null;
            $asistencia->nombre = null;
            foreach ($arbitros as $arbitro) {
                if ($asistencia->id_arbitro == $arbitro->id) {
                    $asistencia->apellido1 = $arbitro->apellido1;
                    $asistencia->apellido2 = $arbitro->apellido2;
                    $asistencia->nombre = $arbitro->nombre;
                }
            }
        }

        //Cruzo datos de asistencia con categorias para añadir el nombre categoría a asistencia
        foreach ($asistencias as $asistencia) {
            $asistencia->nombre_categoria = null;
            foreach ($categorias as $categoria) {
                if ($asistencia->id_categoria == $categoria->id) {
                    $asistencia->nombre_categoria = $categoria->nombre;
                }
            }
        }

        //Cruzo datos de asistencia_fem con categorias para añadir el nombre categoría a asistencia
        foreach ($asistencias_fem as $asistencia) {
            $asistencia->nombre_categoria = null;
            foreach ($categorias as $categoria) {
                if ($asistencia->id_categoria == $categoria->id) {
                    $asistencia->nombre_categoria = $categoria->nombre;
                }
            }
        }

        //Cruzo datos de asistencia_playa con categorias para añadir el nombre categoría a asistencia
        foreach ($asistencias_playa as $asistencia) {
            $asistencia->nombre_categoria = null;
            foreach ($categorias as $categoria) {
                if ($asistencia->id_categoria == $categoria->id) {
                    $asistencia->nombre_categoria = $categoria->nombre;
                }
            }
        }

        //Cruzo datos de asistencia con turnos para añadir el nombre del turno a asistencia
        foreach ($asistencias as $asistencia) {
            $asistencia->nombre_turno = null;
            foreach ($turnos as $turno) {
                if ($asistencia->id_turno == $turno->id) {
                    $asistencia->nombre_turno = $turno->nombre;
                }
            }
        }

        //Cruzo datos de asistencia_fem con turnos para añadir el nombre del turno a asistencia
        foreach ($asistencias_fem as $asistencia) {
            $asistencia->nombre_turno = null;
            foreach ($turnos as $turno) {
                if ($asistencia->id_turno == $turno->id) {
                    $asistencia->nombre_turno = $turno->nombre;
                }
            }
        }

        //Cruzo datos de asistencia_playa con turnos para añadir el nombre del turno a asistencia
        foreach ($asistencias_playa as $asistencia) {
            $asistencia->nombre_turno = null;
            foreach ($turnos as $turno) {
                if ($asistencia->id_turno == $turno->id) {
                    $asistencia->nombre_turno = $turno->nombre;
                }
            }
        }

        //Cruzo datos de asistencia con usuarios para añadir el nombre del responsable a asistencia
        foreach ($asistencias as $asistencia) {
            $asistencia->nombre_responsable = null;
            foreach ($usuarios as $user) {
                if ($asistencia->id_responsable == $user->id) {
                    $asistencia->nombre_responsable = $user->nombre . " " . $user->apellido1 . " " . $user->apellido2;
                }
            }
        }

        //Cruzo datos de asistencia_fem con usuarios para añadir el nombre del responsable a asistencia
        foreach ($asistencias_fem as $asistencia) {
            $asistencia->nombre_responsable = null;
            foreach ($usuarios as $user) {
                if ($asistencia->id_responsable == $user->id) {
                    $asistencia->nombre_responsable = $user->nombre . " " . $user->apellido1 . " " . $user->apellido2;
                }
            }
        }

        //Cruzo datos de asistencia_playa con usuarios para añadir el nombre del responsable a asistencia
        foreach ($asistencias_playa as $asistencia) {
            $asistencia->nombre_responsable = null;
            foreach ($usuarios as $user) {
                if ($asistencia->id_responsable == $user->id) {
                    $asistencia->nombre_responsable = $user->nombre . " " . $user->apellido1 . " " . $user->apellido2;
                }
            }
        }

        //ASISTENCIA PARA PROVINCIALES__________________________________________________________________________________
        //Septiembre
        $septiembre_fb = [
            "Categoria" => "Fútbol Base",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_fb["Dias"][$fecha])) {
                    $septiembre_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_fb["Dias"][$fecha]["observaciones"])) {
                    $septiembre_fb["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_fb = [
            "Categoria" => "Provinciales",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "1" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_provinciales["Dias"][$fecha])) {
                    $octubre_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_provinciales["Dias"][$fecha]["observaciones"])) {
                    $octubre_provinciales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_provinciales = [
            "Categoria" => "Provinciales",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "1" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_provinciales["Dias"][$fecha])) {
                    $noviembre_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_provinciales["Dias"][$fecha]["observaciones"])) {
                    $noviembre_provinciales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_provinciales = [
            "Categoria" => "Provinciales",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "1" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_provinciales["Dias"][$fecha])) {
                    $diciembre_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_provinciales["Dias"][$fecha]["observaciones"])) {
                    $diciembre_provinciales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_provinciales = [
            "Categoria" => "Provinciales",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "1" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_provinciales["Dias"][$fecha])) {
                    $enero_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_provinciales["Dias"][$fecha]["observaciones"])) {
                    $enero_provinciales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_provinciales = [
            "Categoria" => "Provinciales",
            "Mes" => "Febrero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "1" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_provinciales["Dias"][$fecha])) {
                    $febrero_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_provinciales["Dias"][$fecha]["observaciones"])) {
                    $febrero_provinciales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_provinciales = [
            "Categoria" => "Provinciales",
            "Mes" => "Marzo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "1" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_provinciales["Dias"][$fecha])) {
                    $marzo_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_provinciales["Dias"][$fecha]["observaciones"])) {
                    $marzo_provinciales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_provinciales = [
            "Categoria" => "Provinciales",
            "Mes" => "Abril",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "1" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_provinciales["Dias"][$fecha])) {
                    $abril_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_provinciales["Dias"][$fecha]["observaciones"])) {
                    $abril_provinciales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_provinciales = [
            "Categoria" => "Provinciales",
            "Mes" => "Mayo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "1" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_provinciales["Dias"][$fecha])) {
                    $mayo_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_provinciales["Dias"][$fecha]["observaciones"])) {
                    $mayo_provinciales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }
        //____________________________________________________________________________________________________________________________

        //ASISTENCIA PARA OFICIALES__________________________________________________________________________________
        //Septiembre
        $septiembre_oficiales = [
            "Categoria" => "Oficiales",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "2" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_oficiales["Dias"][$fecha])) {
                    $septiembre_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_oficiales["Dias"][$fecha]["observaciones"])) {
                    $septiembre_oficiales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_oficiales = [
            "Categoria" => "Oficiales",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "2" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_oficiales["Dias"][$fecha])) {
                    $octubre_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_oficiales["Dias"][$fecha]["observaciones"])) {
                    $octubre_oficiales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_oficiales = [
            "Categoria" => "Oficiales",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "2" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_oficiales["Dias"][$fecha])) {
                    $noviembre_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_oficiales["Dias"][$fecha]["observaciones"])) {
                    $noviembre_oficiales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_oficiales = [
            "Categoria" => "Oficiales",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "2" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_oficiales["Dias"][$fecha])) {
                    $diciembre_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_oficiales["Dias"][$fecha]["observaciones"])) {
                    $diciembre_oficiales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_oficiales = [
            "Categoria" => "Oficiales",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "2" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_oficiales["Dias"][$fecha])) {
                    $enero_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_oficiales["Dias"][$fecha]["observaciones"])) {
                    $enero_oficiales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_oficiales = [
            "Categoria" => "Oficiales",
            "Mes" => "Febrero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "2" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_oficiales["Dias"][$fecha])) {
                    $febrero_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_oficiales["Dias"][$fecha]["observaciones"])) {
                    $febrero_oficiales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_oficiales = [
            "Categoria" => "Oficiales",
            "Mes" => "Marzo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "2" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_oficiales["Dias"][$fecha])) {
                    $marzo_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_oficiales["Dias"][$fecha]["observaciones"])) {
                    $marzo_oficiales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_oficiales = [
            "Categoria" => "Oficiales",
            "Mes" => "Abril",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "2" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_oficiales["Dias"][$fecha])) {
                    $abril_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_oficiales["Dias"][$fecha]["observaciones"])) {
                    $abril_oficiales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_oficiales = [
            "Categoria" => "Oficiales",
            "Mes" => "Mayo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "2" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_oficiales["Dias"][$fecha])) {
                    $mayo_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_oficiales["Dias"][$fecha]["observaciones"])) {
                    $mayo_oficiales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_oficiales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }
        //____________________________________________________________________________________________________________________________

        //ASISTENCIA PARA AUXILIARES__________________________________________________________________________________
        //Septiembre
        $septiembre_aux = [
            "Categoria" => "Auxiliares",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "3" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_aux["Dias"][$fecha])) {
                    $septiembre_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_aux["Dias"][$fecha]["observaciones"])) {
                    $septiembre_aux["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_aux = [
            "Categoria" => "Auxiliares",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "3" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_aux["Dias"][$fecha])) {
                    $octubre_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_aux["Dias"][$fecha]["observaciones"])) {
                    $octubre_aux["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_aux["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_aux["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_aux = [
            "Categoria" => "Auxiliares",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "3" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_aux["Dias"][$fecha])) {
                    $noviembre_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_aux["Dias"][$fecha]["observaciones"])) {
                    $noviembre_aux["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_aux = [
            "Categoria" => "Auxiliares",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "3" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_aux["Dias"][$fecha])) {
                    $diciembre_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_aux["Dias"][$fecha]["observaciones"])) {
                    $diciembre_aux["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_aux = [
            "Categoria" => "Auxiliares",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "3" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_aux["Dias"][$fecha])) {
                    $enero_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_aux["Dias"][$fecha]["observaciones"])) {
                    $enero_aux["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_aux["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_aux["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_aux = [
            "Categoria" => "Auxiliares",
            "Mes" => "Febrero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "3" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_aux["Dias"][$fecha])) {
                    $febrero_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_aux["Dias"][$fecha]["observaciones"])) {
                    $febrero_aux["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_aux["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_aux["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_aux = [
            "Categoria" => "Auxiliares",
            "Mes" => "Marzo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "3" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_aux["Dias"][$fecha])) {
                    $marzo_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_aux["Dias"][$fecha]["observaciones"])) {
                    $marzo_aux["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_aux["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_aux["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_aux = [
            "Categoria" => "Auxiliares",
            "Mes" => "Abril",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "3" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_aux["Dias"][$fecha])) {
                    $abril_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_aux["Dias"][$fecha]["observaciones"])) {
                    $abril_aux["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_aux["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_aux["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_aux = [
            "Categoria" => "Auxiliares",
            "Mes" => "Mayo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "3" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_aux["Dias"][$fecha])) {
                    $mayo_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_aux["Dias"][$fecha]["observaciones"])) {
                    $mayo_aux["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_aux["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_aux["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_aux["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //ASISTENCIA PARA FÚTBOL BASE FÚTBOL__________________________________________________________________________________
        //Septiembre
        $septiembre_fbf = [
            "Categoria" => "Fútbol Base Fútbol",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_fbf["Dias"][$fecha])) {
                    $septiembre_fbf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_fbf["Dias"][$fecha]["observaciones"])) {
                    $septiembre_fbf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_fbf = [
            "Categoria" => "Fútbol Base Fútbol",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_fbf["Dias"][$fecha])) {
                    $octubre_fbf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_fbf["Dias"][$fecha]["observaciones"])) {
                    $octubre_fbf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_fbf = [
            "Categoria" => "Fútbol Base Fútbol",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_fbf["Dias"][$fecha])) {
                    $noviembre_fbf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_fbf["Dias"][$fecha]["observaciones"])) {
                    $noviembre_fbf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_fbf = [
            "Categoria" => "Fútbol Base Fútbol",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_fbf["Dias"][$fecha])) {
                    $diciembre_fbf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_fbf["Dias"][$fecha]["observaciones"])) {
                    $diciembre_fbf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_fbf = [
            "Categoria" => "Fútbol Base Fútbol",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_fbf["Dias"][$fecha])) {
                    $enero_fbf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_fbf["Dias"][$fecha]["observaciones"])) {
                    $enero_fbf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_fbf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_fbf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_fbf = [
            "Categoria" => "Fútbol Base Fútbol",
            "Mes" => "Febrero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_fbf["Dias"][$fecha])) {
                    $febrero_fbf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_fbf["Dias"][$fecha]["observaciones"])) {
                    $febrero_fbf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_fbf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_fbf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_fbf = [
            "Categoria" => "Fútbol Base Fútbol",
            "Mes" => "Marzo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_fbf["Dias"][$fecha])) {
                    $marzo_fbf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_fbf["Dias"][$fecha]["observaciones"])) {
                    $marzo_fbf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_fbf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_fbf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_fbf = [
            "Categoria" => "Fútbol Base Fútbol",
            "Mes" => "Abril",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_fbf["Dias"][$fecha])) {
                    $abril_fbf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_fbf["Dias"][$fecha]["observaciones"])) {
                    $abril_fbf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_fbf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_fbf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_fbf = [
            "Categoria" => "Fútbol Base Fútbol",
            "Mes" => "Mayo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "4" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_fbf["Dias"][$fecha])) {
                    $mayo_fbf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_fbf["Dias"][$fecha]["observaciones"])) {
                    $mayo_fbf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_fbf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_fbf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_fbf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //ASISTENCIA PARA REGIONAL FUTSAL__________________________________________________________________________________
        //Septiembre
        $septiembre_rg = [
            "Categoria" => "Regional Futsal",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "5" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_rg["Dias"][$fecha])) {
                    $septiembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_rg["Dias"][$fecha]["observaciones"])) {
                    $septiembre_rg["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_rg = [
            "Categoria" => "Regional Futsal",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "5" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_rg["Dias"][$fecha])) {
                    $octubre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_rg["Dias"][$fecha]["observaciones"])) {
                    $octubre_rg["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_rg["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_rg["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_rg = [
            "Categoria" => "Regional Futsal",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "5" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_rg["Dias"][$fecha])) {
                    $noviembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_rg["Dias"][$fecha]["observaciones"])) {
                    $noviembre_rg["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_rg = [
            "Categoria" => "Regional Futsal",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "5" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_rg["Dias"][$fecha])) {
                    $diciembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_rg["Dias"][$fecha]["observaciones"])) {
                    $diciembre_rg["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_rg = [
            "Categoria" => "Regional Futsal",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "5" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_rg["Dias"][$fecha])) {
                    $enero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_rg["Dias"][$fecha]["observaciones"])) {
                    $enero_rg["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_rg["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_rg["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_rg = [
            "Categoria" => "Regional Futsal",
            "Mes" => "Febrero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "5" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_rg["Dias"][$fecha])) {
                    $febrero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_rg["Dias"][$fecha]["observaciones"])) {
                    $febrero_rg["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_rg["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_rg["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_rg = [
            "Categoria" => "Regional Futsal",
            "Mes" => "Marzo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "5" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_rg["Dias"][$fecha])) {
                    $marzo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_rg["Dias"][$fecha]["observaciones"])) {
                    $marzo_rg["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_rg["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_rg["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_rg = [
            "Categoria" => "Regional _Futsal",
            "Mes" => "Abril",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "5" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_rg["Dias"][$fecha])) {
                    $abril_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_rg["Dias"][$fecha]["observaciones"])) {
                    $abril_rg["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_rg["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_rg["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_rg = [
            "Categoria" => "Regional Futsal",
            "Mes" => "Mayo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "5" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_rg["Dias"][$fecha])) {
                    $mayo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_rg["Dias"][$fecha]["observaciones"])) {
                    $mayo_rg["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_rg["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_rg["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_rg["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //ASISTENCIA PARA NACIONAL FUTSAL__________________________________________________________________________________
        //Septiembre
        $septiembre_nac = [
            "Categoria" => "Nacional Futsal",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "6" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_nac["Dias"][$fecha])) {
                    $septiembre_nac["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_nac["Dias"][$fecha]["observaciones"])) {
                    $septiembre_nac["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_nac = [
            "Categoria" => "Nacional Futsal",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "6" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_nac["Dias"][$fecha])) {
                    $octubre_nac["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_nac["Dias"][$fecha]["observaciones"])) {
                    $octubre_nac["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_nac["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_nac["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_nac = [
            "Categoria" => "Nacional Futsal",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "6" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_nac["Dias"][$fecha])) {
                    $noviembre_nac["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_nac["Dias"][$fecha]["observaciones"])) {
                    $noviembre_nac["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_nac = [
            "Categoria" => "Nacional Futsal",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "6" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_nac["Dias"][$fecha])) {
                    $diciembre_nac["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_nac["Dias"][$fecha]["observaciones"])) {
                    $diciembre_nac["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_nac = [
            "Categoria" => "Nacional Futsal",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "6" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_nac["Dias"][$fecha])) {
                    $enero_nac["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_nac["Dias"][$fecha]["observaciones"])) {
                    $enero_nac["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_nac["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_nac["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_nac = [
            "Categoria" => "Nacional Futsal",
            "Mes" => "Febrero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "6" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_nac["Dias"][$fecha])) {
                    $febrero_nac["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_nac["Dias"][$fecha]["observaciones"])) {
                    $febrero_nac["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_nac["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_nac["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_nac = [
            "Categoria" => "Nacional Futsal",
            "Mes" => "Marzo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "6" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_nac["Dias"][$fecha])) {
                    $marzo_nac["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_nac["Dias"][$fecha]["observaciones"])) {
                    $marzo_nac["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_nac["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_nac["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_nac = [
            "Categoria" => "Nacional _Futsal",
            "Mes" => "Abril",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "6" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_nac["Dias"][$fecha])) {
                    $abril_nac["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_nac["Dias"][$fecha]["observaciones"])) {
                    $abril_nac["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_nac["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_nac["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_nac = [
            "Categoria" => "Nacional Futsal",
            "Mes" => "Mayo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "6" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_nac["Dias"][$fecha])) {
                    $mayo_nac["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_nac["Dias"][$fecha]["observaciones"])) {
                    $mayo_nac["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_nac["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_nac["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_nac["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //ASISTENCIA PARA NUEVO INGRESO FUTSAL__________________________________________________________________________________
        //Septiembre
        $septiembre_ni = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "7" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_ni["Dias"][$fecha])) {
                    $septiembre_ni["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_ni["Dias"][$fecha]["observaciones"])) {
                    $septiembre_ni["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_ni = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "7" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_ni["Dias"][$fecha])) {
                    $octubre_ni["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_ni["Dias"][$fecha]["observaciones"])) {
                    $octubre_ni["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_ni["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_ni["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_ni = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "7" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_ni["Dias"][$fecha])) {
                    $noviembre_ni["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_ni["Dias"][$fecha]["observaciones"])) {
                    $noviembre_ni["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_ni = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "7" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_ni["Dias"][$fecha])) {
                    $diciembre_ni["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_ni["Dias"][$fecha]["observaciones"])) {
                    $diciembre_ni["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_ni = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "7" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_ni["Dias"][$fecha])) {
                    $enero_ni["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_ni["Dias"][$fecha]["observaciones"])) {
                    $enero_ni["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_ni["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_ni["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_ni = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Mes" => "Febrero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "7" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_ni["Dias"][$fecha])) {
                    $febrero_ni["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_ni["Dias"][$fecha]["observaciones"])) {
                    $febrero_ni["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_ni["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_ni["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_ni = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Mes" => "Marzo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "7" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_ni["Dias"][$fecha])) {
                    $marzo_ni["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_ni["Dias"][$fecha]["observaciones"])) {
                    $marzo_ni["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_ni["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_ni["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_ni = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Mes" => "Abril",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "7" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_ni["Dias"][$fecha])) {
                    $abril_ni["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_ni["Dias"][$fecha]["observaciones"])) {
                    $abril_ni["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_ni["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_ni["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_ni = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Mes" => "Mayo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "7" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_ni["Dias"][$fecha])) {
                    $mayo_ni["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_ni["Dias"][$fecha]["observaciones"])) {
                    $mayo_ni["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_ni["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_ni["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_ni["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //ASISTENCIA PARA INFORMADORES__________________________________________________________________________________
        //Septiembre
        $septiembre_inf = [
            "Categoria" => "Informadores",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "9" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_inf["Dias"][$fecha])) {
                    $septiembre_inf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_inf["Dias"][$fecha]["observaciones"])) {
                    $septiembre_inf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_inf = [
            "Categoria" => "Informadores",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "9" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_inf["Dias"][$fecha])) {
                    $octubre_inf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_inf["Dias"][$fecha]["observaciones"])) {
                    $octubre_inf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_inf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_inf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_inf = [
            "Categoria" => "Informadores",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "9" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_inf["Dias"][$fecha])) {
                    $noviembre_inf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_inf["Dias"][$fecha]["observaciones"])) {
                    $noviembre_inf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_inf = [
            "Categoria" => "Informadores",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "9" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_inf["Dias"][$fecha])) {
                    $diciembre_inf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_inf["Dias"][$fecha]["observaciones"])) {
                    $diciembre_inf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_inf = [
            "Categoria" => "Informadores",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "9" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_inf["Dias"][$fecha])) {
                    $enero_inf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_inf["Dias"][$fecha]["observaciones"])) {
                    $enero_inf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_inf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_inf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_inf = [
            "Categoria" => "Informadores",
            "Mes" => "Febrero",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "9" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_inf["Dias"][$fecha])) {
                    $febrero_inf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_inf["Dias"][$fecha]["observaciones"])) {
                    $febrero_inf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_inf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_inf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_inf = [
            "Categoria" => "Informadores",
            "Mes" => "Marzo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "9" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_inf["Dias"][$fecha])) {
                    $marzo_inf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_inf["Dias"][$fecha]["observaciones"])) {
                    $marzo_inf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_inf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_inf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_inf = [
            "Categoria" => "Informadores",
            "Mes" => "Abril",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "9" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_inf["Dias"][$fecha])) {
                    $abril_inf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_inf["Dias"][$fecha]["observaciones"])) {
                    $abril_inf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_inf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_inf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_inf = [
            "Categoria" => "Informadores",
            "Mes" => "Mayo",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "9" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_inf["Dias"][$fecha])) {
                    $mayo_inf["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_inf["Dias"][$fecha]["observaciones"])) {
                    $mayo_inf["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_inf["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_inf["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_inf["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //ASISTENCIA PARA FEMENINO__________________________________________________________________________________
        //Septiembre
        $septiembre_fem = [
            "Categoria" => "Femenino",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_fem["Dias"][$fecha])) {
                    $septiembre_fem["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_fem["Dias"][$fecha]["observaciones"])) {
                    $septiembre_fem["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        // debuguear($septiembre_fem);

        //Octubre
        $octubre_fem = [
            "Categoria" => "Femenino",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_fem["Dias"][$fecha])) {
                    $octubre_fem["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_fem["Dias"][$fecha]["observaciones"])) {
                    $octubre_fem["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_fem["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_fem["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_fem = [
            "Categoria" => "Femenino",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_fem["Dias"][$fecha])) {
                    $noviembre_fem["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_fem["Dias"][$fecha]["observaciones"])) {
                    $noviembre_fem["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($Noviembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_fem = [
            "Categoria" => "Femenino",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_fem["Dias"][$fecha])) {
                    $diciembre_fem["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_fem["Dias"][$fecha]["observaciones"])) {
                    $diciembre_fem["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_fem = [
            "Categoria" => "Femenino",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_fem["Dias"][$fecha])) {
                    $enero_fem["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_fem["Dias"][$fecha]["observaciones"])) {
                    $enero_fem["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_fem["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_fem["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_fem = [
            "Categoria" => "Febrero",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_fem["Dias"][$fecha])) {
                    $febrero_fem["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_fem["Dias"][$fecha]["observaciones"])) {
                    $febrero_fem["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_fem["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_fem["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_fem = [
            "Categoria" => "Marzo",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_fem["Dias"][$fecha])) {
                    $marzo_fem["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_fem["Dias"][$fecha]["observaciones"])) {
                    $marzo_fem["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_fem["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_fem["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_fem = [
            "Categoria" => "Abril",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_fem["Dias"][$fecha])) {
                    $abril_fem["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_fem["Dias"][$fecha]["observaciones"])) {
                    $abril_fem["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_fem["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_fem["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_fem = [
            "Categoria" => "Mayo",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_fem["Dias"][$fecha])) {
                    $mayo_fem["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_fem["Dias"][$fecha]["observaciones"])) {
                    $mayo_fem["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_fem["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_fem["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_fem["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //ASISTENCIA PARA PLAYA__________________________________________________________________________________
        //Septiembre
        $septiembre_playa = [
            "Categoria" => "Playa",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($septiembre_playa["Dias"][$fecha])) {
                    $septiembre_playa["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_playa["Dias"][$fecha]["observaciones"])) {
                    $septiembre_playa["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_playa = [
            "Categoria" => "Playa",
            "Mes" => "Octubre",
            "Dias" => []
        ];

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($octubre_playa["Dias"][$fecha])) {
                    $octubre_playa["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_playa["Dias"][$fecha]["observaciones"])) {
                    $octubre_playa["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_playa["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_playa["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_playa = [
            "Categoria" => "Playa",
            "Mes" => "Noviembre",
            "Dias" => []
        ];

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($noviembre_playa["Dias"][$fecha])) {
                    $noviembre_playa["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_playa["Dias"][$fecha]["observaciones"])) {
                    $noviembre_playa["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_playa = [
            "Categoria" => "Playa",
            "Mes" => "Diciembre",
            "Dias" => []
        ];

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($diciembre_playa["Dias"][$fecha])) {
                    $diciembre_playa["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_playa["Dias"][$fecha]["observaciones"])) {
                    $diciembre_playa["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_playa = [
            "Categoria" => "Playa",
            "Mes" => "Enero",
            "Dias" => []
        ];

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($enero_playa["Dias"][$fecha])) {
                    $enero_playa["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_playa["Dias"][$fecha]["observaciones"])) {
                    $enero_playa["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_playa["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_playa["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_playa = [
            "Categoria" => "Playa",
            "Mes" => "Febrero",
            "Dias" => []
        ];

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($febrero_playa["Dias"][$fecha])) {
                    $febrero_playa["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_playa["Dias"][$fecha]["observaciones"])) {
                    $febrero_playa["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_playa["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_playa["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_playa = [
            "Categoria" => "Playa",
            "Mes" => "Marzo",
            "Dias" => []
        ];

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($marzo_playa["Dias"][$fecha])) {
                    $marzo_playa["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_playa["Dias"][$fecha]["observaciones"])) {
                    $marzo_playa["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_playa["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_playa["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_playa = [
            "Categoria" => "Playa",
            "Mes" => "Abril",
            "Dias" => []
        ];

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "04") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($abril_playa["Dias"][$fecha])) {
                    $abril_playa["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_playa["Dias"][$fecha]["observaciones"])) {
                    $abril_playa["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_playa["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_playa["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_playa = [
            "Categoria" => "Playa",
            "Mes" => "Mayo",
            "Dias" => []
        ];

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;

                // Inicializar el día si no existe
                if (!isset($mayo_playa["Dias"][$fecha])) {
                    $mayo_playa["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_playa["Dias"][$fecha]["observaciones"])) {
                    $mayo_playa["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_playa["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_playa["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_playa["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        // debuguear($mayo_fem);

        // Render a la vista 
        $router->render('directivo/asistencia/index', [
            'titulo' => 'Asistencia',
            'modalidades' =>  $modalidades,
            'categorias' => $categorias,
            'septiembre_provinciales' => $septiembre_provinciales,
            'octubre_provinciales' => $octubre_provinciales,
            'noviembre_provinciales' => $noviembre_provinciales,
            'diciembre_provinciales' => $diciembre_provinciales,
            'enero_provinciales' => $enero_provinciales,
            'febrero_provinciales' => $febrero_provinciales,
            'marzo_provinciales' => $marzo_provinciales,
            'abril_provinciales' => $abril_provinciales,
            'mayo_provinciales' => $mayo_provinciales,
            'septiembre_oficiales' => $septiembre_oficiales,
            'octubre_oficiales' => $octubre_oficiales,
            'noviembre_oficiales' => $noviembre_oficiales,
            'diciembre_oficiales' => $diciembre_oficiales,
            'enero_oficiales' => $enero_oficiales,
            'febrero_oficiales' => $febrero_oficiales,
            'marzo_oficiales' => $marzo_oficiales,
            'abril_oficiales' => $abril_oficiales,
            'mayo_oficiales' => $mayo_oficiales,
            'septiembre_aux' => $septiembre_aux,
            'octubre_aux' => $octubre_aux,
            'noviembre_aux' => $noviembre_aux,
            'diciembre_aux' => $diciembre_aux,
            'enero_aux' => $enero_aux,
            'febrero_aux' => $febrero_aux,
            'marzo_aux' => $marzo_aux,
            'abril_aux' => $abril_aux,
            'mayo_aux' => $mayo_aux,
            'septiembre_fbf' => $septiembre_fbf,
            'octubre_fbf' => $octubre_fbf,
            'noviembre_fbf' => $noviembre_fbf,
            'diciembre_fbf' => $diciembre_fbf,
            'enero_fbf' => $enero_fbf,
            'febrero_fbf' => $febrero_fbf,
            'marzo_fbf' => $marzo_fbf,
            'abril_fbf' => $abril_fbf,
            'mayo_fbf' => $mayo_fbf,
            'septiembre_rg' => $septiembre_rg,
            'octubre_rg' => $octubre_rg,
            'noviembre_rg' => $noviembre_rg,
            'diciembre_rg' => $diciembre_rg,
            'enero_rg' => $enero_rg,
            'febrero_rg' => $febrero_rg,
            'marzo_rg' => $marzo_rg,
            'abril_rg' => $abril_rg,
            'mayo_rg' => $mayo_rg,
            'septiembre_nac' => $septiembre_nac,
            'octubre_nac' => $octubre_nac,
            'noviembre_nac' => $noviembre_nac,
            'diciembre_nac' => $diciembre_nac,
            'enero_nac' => $enero_nac,
            'febrero_nac' => $febrero_nac,
            'marzo_nac' => $marzo_nac,
            'abril_nac' => $abril_nac,
            'mayo_nac' => $mayo_nac,
            'septiembre_ni' => $septiembre_ni,
            'octubre_ni' => $octubre_ni,
            'noviembre_ni' => $noviembre_ni,
            'diciembre_ni' => $diciembre_ni,
            'enero_ni' => $enero_ni,
            'febrero_ni' => $febrero_ni,
            'marzo_ni' => $marzo_ni,
            'abril_ni' => $abril_ni,
            'mayo_ni' => $mayo_ni,
            'septiembre_inf' => $septiembre_inf,
            'octubre_inf' => $octubre_inf,
            'noviembre_inf' => $noviembre_inf,
            'diciembre_inf' => $diciembre_inf,
            'enero_inf' => $enero_inf,
            'febrero_inf' => $febrero_inf,
            'marzo_inf' => $marzo_inf,
            'abril_inf' => $abril_inf,
            'mayo_inf' => $mayo_inf,
            'septiembre_fem' => $septiembre_fem,
            'octubre_fem' => $octubre_fem,
            'noviembre_fem' => $noviembre_fem,
            'diciembre_fem' => $diciembre_fem,
            'enero_fem' => $enero_fem,
            'febrero_fem' => $febrero_fem,
            'marzo_fem' => $marzo_fem,
            'abril_fem' => $abril_fem,
            'mayo_fem' => $mayo_fem,
            'septiembre_playa' => $septiembre_playa,
            'octubre_playa' => $octubre_playa,
            'noviembre_playa' => $noviembre_playa,
            'diciembre_playa' => $diciembre_playa,
            'enero_playa' => $enero_playa,
            'febrero_playa' => $febrero_playa,
            'marzo_playa' => $marzo_playa,
            'abril_playa' => $abril_playa,
            'mayo_playa' => $mayo_playa
        ]);
    }
}