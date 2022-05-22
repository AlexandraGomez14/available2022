<?php
require_once('../models/conection.php');
require_once('../models/registro.php');

function addRegistro($obj)
{
    $conn = new DataSource();
    if (!$conn->conectar()) {
        echo 'error';
        exit;
    } else {
        $cli = $obj;
        $sql = "INSERT INTO registro VALUES(null,?,?,?,?)";
        if ($stmt = $conn->conn->prepare($sql)) {
            $usuario = $cli->usuario;
            $correo = $cli->correo;
			$password = $cli->password;
            $telefono = $cli->telefono;
            $stmt->bind_param('ssss', $usuario, $correo, $password, $telefono);
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
    $datos = new Registro();
    $datos->usuario = $_POST['usuario'];
    $datos->correo = $_POST['correo'];
	$datos->password = $_POST['contra'];
    $datos->telefono = $_POST['telefono'];
    addRegistro($datos);
}
