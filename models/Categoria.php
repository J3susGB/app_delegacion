<?php

namespace Model;

class Categoria extends ActiveRecord {
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'nombre', 'id_modalidad'];

    public $id;
    public $nombre;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->id_modalidad = $args['id_modalidad'] ?? null;
    }

    public function validar_categoria() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre de la modalidad es Obligatorio';
        }
        if(!$this->id_modalidad) {
            self::$alertas['error'][] = 'La modalidad es Obligatoria';
        }
        return self::$alertas;
    }
    public function validar_edicion_categoria() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre de la categoría es Obligatorio';
        }
        return self::$alertas;
    }
}