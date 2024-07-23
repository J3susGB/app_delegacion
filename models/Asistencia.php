<?php

namespace Model;

class Asistencia extends ActiveRecord {
    protected static $tabla = 'asistencias';
    protected static $columnasDB = ['id', 'fecha', 'fecha_formateada', 'mes', 'id_turno', 'id_arbitro', 'asiste', 'id_categoria', 'femenino', 'playa', 'id_responsable', 'observaciones'];

    public $id;
    public $fecha;
    public $fecha_formateada;
    public $mes;
    public $id_turno;
    public $id_arbitro;
    public $asiste;
    public $id_categoria;
    public $femenino;
    public $playa;
    public $id_responsable;
    public $observaciones;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? null;
        $this->fecha_formateada = $args['fecha_formateada'] ?? '';
        $this->mes = $args['mes'] ?? '';
        $this->id_turno = $args['id_turno'] ?? null;
        $this->id_arbitro = $args['id_arbitro'] ?? null;
        $this->asiste = $args['asiste'] ?? 0;
        $this->id_categoria = $args['id_categoria'] ?? null;
        $this->femenino = $args['femenino'] ?? 0;
        $this->playa = $args['playa'] ?? 0;
        $this->id_responsable = $args['id_responsable'] ?? null;
        $this->observaciones = $args['observaciones'] ?? '';
    }

    public function validar_asistencia() {
        if(!$this->fecha) {
            self::$alertas['error'][] = 'Tienes que elegir una fecha';
        }
        if(!$this->id_categoria) {
            self::$alertas['error'][] = 'Tienes que seleccionar una categoría';
        }
        if(!$this->id_turno) {
            self::$alertas['error'][] = 'Tienes que indicar si es teórica o práctica';
        }
        return self::$alertas;
    }
}