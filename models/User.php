<?php


namespace Model;


class User extends ActiveRecord
{
    protected static $tabla = 'users';
    protected static $columnasDB = ['id', 'name', 'email', 'password', 'token', 'confirm'];

    public $id;
    public $name;
    public $email;
    public $password;
    public $token;
    public $confirm;
    public $verifyPassword;


    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->verifyPassword = $args['verifyPassword'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirm = $args['confirm'] ?? 0;
    }


    public function validationNewAccount()
    {
        if (!$this->name) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (!$this->verifyPassword) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password tiene que tener al menos 6 caracteres';
        }
        if ($this->password !== $this->verifyPassword) {
            self::$alertas['error'][] = 'Los password no son iguales';
        }
        if ($this->email) {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                self::$alertas['error'][] = 'El email no es valido';
            }
        }

        return self::$alertas;
    }


    public function validationEmail()
    {

        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email no es valido';
        }


        return self::$alertas;
    }


    public function validationPassword()
    {
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (!$this->verifyPassword) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password tiene que tener al menos 6 caracteres';
        }
        if ($this->password !== $this->verifyPassword) {
            self::$alertas['error'][] = 'Los password no son iguales';
        }

        return self::$alertas;
    }


    public function validationLogin(){

        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email no es valido';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        return self::$alertas;

    }


    

    public function hashPassword()
    {

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }



    public function generateToken()
    {
        $this->token = md5(uniqid());
    }
}
