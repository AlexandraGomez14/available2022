<?php

class Registro
{
    private $id;
    private $usuario;
    private $correo;
	private $password;
	private $telefono;


    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __construc()
    {
        $this->id = 0;
        $this->usuario = "x";
        $this->password = "x";
		$this->correo = "x";
		$this->telefono = "x";
    }
}