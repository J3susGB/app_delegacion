<?php

namespace Model;

class Turno extends ActiveRecord {
    protected static $tabla = 'turnos';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

    public function validar_turno() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del turno es Obligatorio';
        }
        return self::$alertas;
    }
}