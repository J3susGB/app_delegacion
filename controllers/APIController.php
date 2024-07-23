<?php

namespace Controllers;

use Model\Turno;
use Model\Arbitro;
use Model\Usuario;
use Model\Categoria;
use Model\Modalidad;
use Model\Asistencia;

class APIController {

    public static function provinciales() {

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

        // debuguear($asistencias);

        //Septiembre
        $septiembre_provinciales = [
            "Categoria" => "Provinciales",
            "Mes" => "Septiembre",
            "Dias" => []
        ];

        foreach ($asistencias as $item) {
            // Filtrar por categoría y mes
            if ($item->id_categoria == "1" && $item->mes == "09") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($septiembre_provinciales["Dias"][$fecha])) {
                    $septiembre_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $septiembre_provinciales["Dias"][$fecha]["observaciones"])) {
                    $septiembre_provinciales["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($septiembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $septiembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $septiembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $septiembre_provinciales["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Octubre
        $octubre_provinciales = [
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($octubre_provinciales["Dias"][$fecha])) {
                    $octubre_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($noviembre_provinciales["Dias"][$fecha])) {
                    $noviembre_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($diciembre_provinciales["Dias"][$fecha])) {
                    $diciembre_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($enero_provinciales["Dias"][$fecha])) {
                    $enero_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($febrero_provinciales["Dias"][$fecha])) {
                    $febrero_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($marzo_provinciales["Dias"][$fecha])) {
                    $marzo_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($abril_provinciales["Dias"][$fecha])) {
                    $abril_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($mayo_provinciales["Dias"][$fecha])) {
                    $mayo_provinciales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        //Combino los arrays de todos los meses en uno solo
        $resultado = [
            "Categoria" => "Provinciales",
            "Meses" => [
                "Septiembre" => $septiembre_provinciales["Dias"],
                "Octubre" => $octubre_provinciales["Dias"],
                "Noviembre" => $noviembre_provinciales["Dias"],
                "Diciembre" => $diciembre_provinciales["Dias"],
                "Enero" => $enero_provinciales["Dias"],
                "Febrero" => $febrero_provinciales["Dias"],
                "Marzo" => $marzo_provinciales["Dias"],
                "Abril" => $abril_provinciales["Dias"],
                "Mayo" => $mayo_provinciales["Dias"]
            ]
        ];
    

    echo json_encode($resultado);
    }

    public static function oficiales() {

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

        // debuguear($asistencias);

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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($septiembre_oficiales["Dias"][$fecha])) {
                    $septiembre_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($octubre_oficiales["Dias"][$fecha])) {
                    $octubre_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($noviembre_oficiales["Dias"][$fecha])) {
                    $noviembre_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($diciembre_oficiales["Dias"][$fecha])) {
                    $diciembre_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($enero_oficiales["Dias"][$fecha])) {
                    $enero_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($febrero_oficiales["Dias"][$fecha])) {
                    $febrero_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($marzo_oficiales["Dias"][$fecha])) {
                    $marzo_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($abril_oficiales["Dias"][$fecha])) {
                    $abril_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($mayo_oficiales["Dias"][$fecha])) {
                    $mayo_oficiales["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        //Combino los arrays de todos los meses en uno solo
        $resultado = [
            "Categoria" => "Oficiales",
            "Meses" => [
                "Septiembre" => $septiembre_oficiales["Dias"],
                "Octubre" => $octubre_oficiales["Dias"],
                "Noviembre" => $noviembre_oficiales["Dias"],
                "Diciembre" => $diciembre_oficiales["Dias"],
                "Enero" => $enero_oficiales["Dias"],
                "Febrero" => $febrero_oficiales["Dias"],
                "Marzo" => $marzo_oficiales["Dias"],
                "Abril" => $abril_oficiales["Dias"],
                "Mayo" => $mayo_oficiales["Dias"]
            ]
        ];
    

    echo json_encode($resultado);
    }

    public static function auxiliares() {

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

        // debuguear($asistencias);

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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($septiembre_aux["Dias"][$fecha])) {
                    $septiembre_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($octubre_aux["Dias"][$fecha])) {
                    $octubre_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($noviembre_aux["Dias"][$fecha])) {
                    $noviembre_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($diciembre_aux["Dias"][$fecha])) {
                    $diciembre_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($enero_aux["Dias"][$fecha])) {
                    $enero_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($febrero_aux["Dias"][$fecha])) {
                    $febrero_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($marzo_aux["Dias"][$fecha])) {
                    $marzo_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($abril_aux["Dias"][$fecha])) {
                    $abril_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($mayo_aux["Dias"][$fecha])) {
                    $mayo_aux["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        //Combino los arrays de todos los meses en uno solo
        $resultado = [
            "Categoria" => "Auxiliares",
            "Meses" => [
                "Septiembre" => $septiembre_aux["Dias"],
                "Octubre" => $octubre_aux["Dias"],
                "Noviembre" => $noviembre_aux["Dias"],
                "Diciembre" => $diciembre_aux["Dias"],
                "Enero" => $enero_aux["Dias"],
                "Febrero" => $febrero_aux["Dias"],
                "Marzo" => $marzo_aux["Dias"],
                "Abril" => $abril_aux["Dias"],
                "Mayo" => $mayo_aux["Dias"]
            ]
        ];
    

    echo json_encode($resultado);
    }

    public static function futbol_base() {

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

        // debuguear($asistencias);

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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($septiembre_fb["Dias"][$fecha])) {
                    $septiembre_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            "Categoria" => "Fútbol Base",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($octubre_fb["Dias"][$fecha])) {
                    $octubre_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $octubre_fb["Dias"][$fecha]["observaciones"])) {
                    $octubre_fb["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($octubre_fb["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $octubre_fb["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $octubre_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $octubre_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Noviembre
        $noviembre_fb = [
            "Categoria" => "Fútbol Base",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($noviembre_fb["Dias"][$fecha])) {
                    $noviembre_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $noviembre_fb["Dias"][$fecha]["observaciones"])) {
                    $noviembre_fb["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($noviembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $noviembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $noviembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $noviembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Diciembre
        $diciembre_fb = [
            "Categoria" => "Fútbol Base",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($diciembre_fb["Dias"][$fecha])) {
                    $diciembre_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $diciembre_fb["Dias"][$fecha]["observaciones"])) {
                    $diciembre_fb["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($diciembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $diciembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $diciembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $diciembre_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Enero
        $enero_fb = [
            "Categoria" => "Fútbol Base",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($enero_fb["Dias"][$fecha])) {
                    $enero_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $enero_fb["Dias"][$fecha]["observaciones"])) {
                    $enero_fb["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($enero_fb["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $enero_fb["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $enero_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $enero_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Febrero
        $febrero_fb = [
            "Categoria" => "Fútbol Base",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($febrero_fb["Dias"][$fecha])) {
                    $febrero_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $febrero_fb["Dias"][$fecha]["observaciones"])) {
                    $febrero_fb["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($febrero_fb["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $febrero_fb["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $febrero_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $febrero_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Marzo
        $marzo_fb = [
            "Categoria" => "Fútbol Base",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($marzo_fb["Dias"][$fecha])) {
                    $marzo_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $marzo_fb["Dias"][$fecha]["observaciones"])) {
                    $marzo_fb["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($marzo_fb["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $marzo_fb["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $marzo_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $marzo_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Abril
        $abril_fb = [
            "Categoria" => "Fútbol Base",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($abril_fb["Dias"][$fecha])) {
                    $abril_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $abril_fb["Dias"][$fecha]["observaciones"])) {
                    $abril_fb["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($abril_fb["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $abril_fb["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $abril_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $abril_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Mayo
        $mayo_fb = [
            "Categoria" => "Fútbol Base",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($mayo_fb["Dias"][$fecha])) {
                    $mayo_fb["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
                        "observaciones" => [],
                        "arbitros" => []
                    ];
                }

                // Agregar observaciones si no existen ya
                if (!in_array($observaciones, $mayo_fb["Dias"][$fecha]["observaciones"])) {
                    $mayo_fb["Dias"][$fecha]["observaciones"][] = $observaciones;
                }

                // Agregar datos del árbitro
                if (!isset($mayo_fb["Dias"][$fecha]["arbitros"][$id_arbitro])) {
                    $mayo_fb["Dias"][$fecha]["arbitros"][$id_arbitro] = [
                        "nombre" => $item->nombre,
                        "apellido1" => $item->apellido1,
                        "apellido2" => $item->apellido2,
                        "asiste" => 0, // Inicializar la asistencia como 0
                        "id_categoria" => $id_categoria
                    ];
                }

                // Sumar asistencias
                if ($asiste == 1) {
                    $mayo_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] += 0.5;
                } elseif ($asiste == 2) {
                    $mayo_fb["Dias"][$fecha]["arbitros"][$id_arbitro]["asiste"] = 0;
                }
            }
        }

        //Combino los arrays de todos los meses en uno solo
        $resultado = [
            "Categoria" => "Fútbol Base",
            "Meses" => [
                "Septiembre" => $septiembre_fb["Dias"],
                "Octubre" => $octubre_fb["Dias"],
                "Noviembre" => $noviembre_fb["Dias"],
                "Diciembre" => $diciembre_fb["Dias"],
                "Enero" => $enero_fb["Dias"],
                "Febrero" => $febrero_fb["Dias"],
                "Marzo" => $marzo_fb["Dias"],
                "Abril" => $abril_fb["Dias"],
                "Mayo" => $mayo_fb["Dias"]
            ]
        ];
    

    echo json_encode($resultado);
    }

    public static function regional_futsal() {

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

        // debuguear($asistencias);

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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($septiembre_rg["Dias"][$fecha])) {
                    $septiembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($octubre_rg["Dias"][$fecha])) {
                    $octubre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($noviembre_rg["Dias"][$fecha])) {
                    $noviembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($diciembre_rg["Dias"][$fecha])) {
                    $diciembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($enero_rg["Dias"][$fecha])) {
                    $enero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($febrero_rg["Dias"][$fecha])) {
                    $febrero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($marzo_rg["Dias"][$fecha])) {
                    $marzo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            "Categoria" => "Regional Futsal",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($abril_rg["Dias"][$fecha])) {
                    $abril_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($mayo_rg["Dias"][$fecha])) {
                    $mayo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        //Combino los arrays de todos los meses en uno solo
        $resultado = [
            "Categoria" => "Regional Futsal",
            "Meses" => [
                "Septiembre" => $septiembre_rg["Dias"],
                "Octubre" => $octubre_rg["Dias"],
                "Noviembre" => $noviembre_rg["Dias"],
                "Diciembre" => $diciembre_rg["Dias"],
                "Enero" => $enero_rg["Dias"],
                "Febrero" => $febrero_rg["Dias"],
                "Marzo" => $marzo_rg["Dias"],
                "Abril" => $abril_rg["Dias"],
                "Mayo" => $mayo_rg["Dias"]
            ]
        ];
    

    echo json_encode($resultado);
    }

    public static function nacional_futsal() {

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

        // debuguear($asistencias);

        //Septiembre
        $septiembre_rg = [
            "Categoria" => "Regional Futsal",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($septiembre_rg["Dias"][$fecha])) {
                    $septiembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "6" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($octubre_rg["Dias"][$fecha])) {
                    $octubre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "6" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($noviembre_rg["Dias"][$fecha])) {
                    $noviembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "6" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($diciembre_rg["Dias"][$fecha])) {
                    $diciembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "6" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($enero_rg["Dias"][$fecha])) {
                    $enero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "6" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($febrero_rg["Dias"][$fecha])) {
                    $febrero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "6" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($marzo_rg["Dias"][$fecha])) {
                    $marzo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            "Categoria" => "Regional Futsal",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($abril_rg["Dias"][$fecha])) {
                    $abril_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "6" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($mayo_rg["Dias"][$fecha])) {
                    $mayo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        //Combino los arrays de todos los meses en uno solo
        $resultado = [
            "Categoria" => "Nacional Futsal",
            "Meses" => [
                "Septiembre" => $septiembre_rg["Dias"],
                "Octubre" => $octubre_rg["Dias"],
                "Noviembre" => $noviembre_rg["Dias"],
                "Diciembre" => $diciembre_rg["Dias"],
                "Enero" => $enero_rg["Dias"],
                "Febrero" => $febrero_rg["Dias"],
                "Marzo" => $marzo_rg["Dias"],
                "Abril" => $abril_rg["Dias"],
                "Mayo" => $mayo_rg["Dias"]
            ]
        ];
    

    echo json_encode($resultado);
    }

    public static function ni_futsal() {

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

        // debuguear($asistencias);

        //Septiembre
        $septiembre_rg = [
            "Categoria" => "Regional Futsal",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($septiembre_rg["Dias"][$fecha])) {
                    $septiembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "7" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($octubre_rg["Dias"][$fecha])) {
                    $octubre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "7" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($noviembre_rg["Dias"][$fecha])) {
                    $noviembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "7" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($diciembre_rg["Dias"][$fecha])) {
                    $diciembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "7" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($enero_rg["Dias"][$fecha])) {
                    $enero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "7" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($febrero_rg["Dias"][$fecha])) {
                    $febrero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "7" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($marzo_rg["Dias"][$fecha])) {
                    $marzo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            "Categoria" => "Regional Futsal",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($abril_rg["Dias"][$fecha])) {
                    $abril_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            if ($item->id_categoria == "7" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($mayo_rg["Dias"][$fecha])) {
                    $mayo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        //Combino los arrays de todos los meses en uno solo
        $resultado = [
            "Categoria" => "Nuevo Ingreso Futsal",
            "Meses" => [
                "Septiembre" => $septiembre_rg["Dias"],
                "Octubre" => $octubre_rg["Dias"],
                "Noviembre" => $noviembre_rg["Dias"],
                "Diciembre" => $diciembre_rg["Dias"],
                "Enero" => $enero_rg["Dias"],
                "Febrero" => $febrero_rg["Dias"],
                "Marzo" => $marzo_rg["Dias"],
                "Abril" => $abril_rg["Dias"],
                "Mayo" => $mayo_rg["Dias"]
            ]
        ];
    

    echo json_encode($resultado);
    }

    public static function femenino() {

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

        // debuguear($asistencias);

        //Septiembre
        $septiembre_rg = [
            "Categoria" => "Regional Futsal",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($septiembre_rg["Dias"][$fecha])) {
                    $septiembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($octubre_rg["Dias"][$fecha])) {
                    $octubre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($noviembre_rg["Dias"][$fecha])) {
                    $noviembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($diciembre_rg["Dias"][$fecha])) {
                    $diciembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($enero_rg["Dias"][$fecha])) {
                    $enero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($febrero_rg["Dias"][$fecha])) {
                    $febrero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($marzo_rg["Dias"][$fecha])) {
                    $marzo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            "Categoria" => "Regional Futsal",
            "Mes" => "Abril",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($abril_rg["Dias"][$fecha])) {
                    $abril_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_fem as $item) {
            // Filtrar por categoría y mes
            if ($item->femenino == "1" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($mayo_rg["Dias"][$fecha])) {
                    $mayo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        //Combino los arrays de todos los meses en uno solo
        $resultado = [
            "Categoria" => "Fútbol Femenino",
            "Meses" => [
                "Septiembre" => $septiembre_rg["Dias"],
                "Octubre" => $octubre_rg["Dias"],
                "Noviembre" => $noviembre_rg["Dias"],
                "Diciembre" => $diciembre_rg["Dias"],
                "Enero" => $enero_rg["Dias"],
                "Febrero" => $febrero_rg["Dias"],
                "Marzo" => $marzo_rg["Dias"],
                "Abril" => $abril_rg["Dias"],
                "Mayo" => $mayo_rg["Dias"]
            ]
        ];
    

    echo json_encode($resultado);
    }

    public static function playa() {

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

        // debuguear($asistencias);

        //Septiembre
        $septiembre_rg = [
            "Categoria" => "Regional Futsal",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($septiembre_rg["Dias"][$fecha])) {
                    $septiembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "10") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($octubre_rg["Dias"][$fecha])) {
                    $octubre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "11") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($noviembre_rg["Dias"][$fecha])) {
                    $noviembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "12") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($diciembre_rg["Dias"][$fecha])) {
                    $diciembre_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "01") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($enero_rg["Dias"][$fecha])) {
                    $enero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "02") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($febrero_rg["Dias"][$fecha])) {
                    $febrero_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "03") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($marzo_rg["Dias"][$fecha])) {
                    $marzo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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
            "Categoria" => "Regional Futsal",
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
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($abril_rg["Dias"][$fecha])) {
                    $abril_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        foreach ($asistencias_playa as $item) {
            // Filtrar por categoría y mes
            if ($item->playa == "1" && $item->mes == "05") {
                $fecha = $item->fecha_formateada;
                $id_arbitro = $item->id_arbitro;
                $asiste = $item->asiste;
                $observaciones = $item->observaciones;
                $nombre_responsable = $item->nombre_responsable;
                $id_categoria = $item->id_categoria;
                $turno = $item->nombre_turno;

                // Inicializar el día si no existe
                if (!isset($mayo_rg["Dias"][$fecha])) {
                    $mayo_rg["Dias"][$fecha] = [
                        "nombre_responsable" => $nombre_responsable,
                        "turno" => $turno,
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

        //Combino los arrays de todos los meses en uno solo
        $resultado = [
            "Categoria" => "Fútbol Playa",
            "Meses" => [
                "Septiembre" => $septiembre_rg["Dias"],
                "Octubre" => $octubre_rg["Dias"],
                "Noviembre" => $noviembre_rg["Dias"],
                "Diciembre" => $diciembre_rg["Dias"],
                "Enero" => $enero_rg["Dias"],
                "Febrero" => $febrero_rg["Dias"],
                "Marzo" => $marzo_rg["Dias"],
                "Abril" => $abril_rg["Dias"],
                "Mayo" => $mayo_rg["Dias"]
            ]
        ];
    

    echo json_encode($resultado);
    }
}
