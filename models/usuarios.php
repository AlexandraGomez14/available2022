<?php

class Datos
{
	private int id;
	private String usuario;
	private String password;
	
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
    }
}