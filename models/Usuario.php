<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'user', 'nombre', 'apellido1', 'apellido2', 'email', 'password', 'token', 'confirmado', 'colaborador', 'directivo', 'informador'];

    public $id;
    public $user;
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $email;
    public $password;
    public $token;
    public $confirmado;
    public $colaborador;
    public $directivo;
    public $informador;

    public $password2;
    public $password_actual;
    public $password_nuevo;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->user = $args['user'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido1 = $args['apellido1'] ?? '';
        $this->apellido2 = $args['apellido2'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->colaborador = $args['colaborador'] ?? null;
        $this->directivo = $args['directivo'] ?? 0;
        $this->directivo = $args['informador'] ?? 0;
    }

    // Validar el Login de Usuarios
    public function validarLogin() {
        if(!$this->user) {
            self::$alertas['error'][] = 'El Usuario es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'Debes introducir la contraseña';
        }
        return self::$alertas;

    }

    // Validación para cuentas nuevas
    public function validar_cuenta() {
        if(!$this->user) {
            self::$alertas['error'][] = 'El usuario es Obligatorio';
        }
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido1) {
            self::$alertas['error'][] = 'El primer apellido es Obligatorio';
        }
        if(!$this->apellido2) {
            self::$alertas['error'][] = 'El segundo apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es Obligatoria';
        }
        if(!$this->password2) {
            self::$alertas['error'][] = 'Debes confirmar la contraseña';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        if($this->password) {
            if($this->password !== $this->password2) {
                self::$alertas['error'][] = 'las contraseñas no coinciden';
            }
        }
        
        return self::$alertas;
    }

    public function validar_edicion() {
        if(!$this->user) {
            self::$alertas['error'][] = 'El usuario es Obligatorio';
        }
        return self::$alertas;
    }

    public function validar_edicion_perfil() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es Obligatorio';
        }
        if(!$this->apellido1) {
            self::$alertas['error'][] = 'El primer apellido es Obligatorio';
        }
        if(!$this->apellido2) {
            self::$alertas['error'][] = 'El segundo apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es Obligatorio';
        }
        return self::$alertas;
    }

    // Valida un email
    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Email no válido';
        }
        return self::$alertas;
    }

    // Valida el Password 
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function nuevo_password() : array {
        if(!$this->password_actual) {
            self::$alertas['error'][] = 'El Password Actual no puede ir vacio';
        }
        if(!$this->password_nuevo) {
            self::$alertas['error'][] = 'El Password Nuevo no puede ir vacio';
        }
        if(strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Comprobar el password
    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password );
    }

    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un Token
    public function crearToken() : void {
        $this->token = uniqid();
    }
}