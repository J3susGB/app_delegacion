<?php

namespace Model;

class Arbitro extends ActiveRecord {
    protected static $tabla = 'arbitros';
    protected static $columnasDB = ['id', 'nombre', 'apellido1', 'apellido2','foto', 'id_modalidad', 'id_categoria', 'femenino', 'playa'];

    public $id;
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $foto;
    public $id_modalidad;
    public $id_categoria;
    public $femenino;
    public $playa;
    

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido1 = $args['apellido1'] ?? '';
        $this->apellido2 = $args['apellido2'] ?? '';
        $this->foto = $args['foto'] ?? '';
        $this->id_modalidad = $args['id_modalidad'] ?? null;
        $this->id_categoria = $args['id_categoria'] ?? null;
        $this->femenino = $args['femenino'] ?? null;
        $this->playa = $args['playa'] ?? null;

    }

    public function validar_arbitro() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido1) {
            self::$alertas['error'][] = 'El primer apellido es obligatorio';
        }
        if(!$this->apellido2) {
            self::$alertas['error'][] = 'El segundo apellido es obligatorio';
        }
        if(!$this->foto) {
            self::$alertas['error'][] = 'La foto es obligatoria';
        }
        if(!$this->id_categoria) {
            self::$alertas['error'][] = 'La categoría es obligatoria';
        }
        if($this->femenino == null) {
            self::$alertas['error'][] = 'Tienes que indicar si añadir a fútbol femenino';
        }
        if($this->playa == null) {
            self::$alertas['error'][] = 'Tienes que indicar si añadir a fútbol playa';
        }
        return self::$alertas;
    }
    public function validar_edicion_arbitro() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido1) {
            self::$alertas['error'][] = 'El primer apellido es obligatorio';
        }
        if(!$this->apellido2) {
            self::$alertas['error'][] = 'El segundo apellido es obligatorio';
        }
        if(!$this->foto) {
            self::$alertas['error'][] = 'La foto es obligatoria';
        }
        if(!$this->id_modalidad) {
            self::$alertas['error'][] = 'La modalidad es obligatoria';
        }
        if(!$this->id_categoria) {
            self::$alertas['error'][] = 'La categoría es obligatoria';
        }
        if($this->femenino == null) {
            self::$alertas['error'][] = 'Tienes que indicar si añadir a fútbol femenino';
        }
        if($this->playa == null) {
            self::$alertas['error'][] = 'Tienes que indicar si añadir a fútbol playa';
        }
        return self::$alertas;
    }
}