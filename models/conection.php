<?php
class DataSource
{
    private $conn;
    private $host;
    private $usuario;
    private $password;
    private $db;

    public function __set($usuario, $value)
    {
        $this->$usuario = $value;
    }

    public function __get($usuario)
    {
        return $this->$usuario;
    }
    public function __construct()
    {
        $this->host = 'aleadminbd.mysql.database.azure.com';
		//$this->host = 'https://availableconection.azurewebsites.net';
        $this->usuario = 'aleadminBD';
        $this->password = 'Mascarilla2021$';
        $this->db = 'mission';
    }

    public function conectar()
    {
        $this->conn = new mysqli($this->host, $this->usuario, $this->password, $this->db);
        $this->conn->set_charset('utf8');
        if ($this->conn->connect_errno) {
            return false;
        } else {
            return true;
        }
    }

    public function preparar($sql)
    {
        return $this->conn->prepare($sql);
    }

    public function select($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function desconectar()
    {
        return $this->conn->close();
    }
}
