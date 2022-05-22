<?php
require_once('../models/conection.php');
require_once('../models/usuarios.php');

function add($obj)
{
    $conn = new DataSource();
    if (!$conn->conectar()) {
        echo 'error';
        exit;
    } else {
        $cli = $obj;
        $sql = "INSERT INTO usuarios VALUES(null,?,?)";
        if ($stmt = $conn->conn->prepare($sql)) {
            $usuario = $cli->usuario;
            $password = $cli->password;
            $stmt->bind_param('ss', $usuario, $password);
            $resultado = $stmt->execute();
            $stmt->close();
            if ($resultado) echo json_encode(array('error' => false));
            else echo json_encode(array('error' => true));
        } else {
            echo json_encode(array('error' => true));
            $stmt->close();
            $conn->desconectar();
        }
    }
}


if ($_POST['action'] == 'add') {
    $datos = new Usuarios();
    $datos->usuario = $_POST['usuario'];
    $datos->password = $_POST['password'];
    add($datos);
}
