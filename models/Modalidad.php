<?php

namespace Model;

class Modalidad extends ActiveRecord {
    protected static $tabla = 'modalidad';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

    public function validar_modalidad() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre de la modalidad es Obligatorio';
        }
        return self::$alertas;
    }
}