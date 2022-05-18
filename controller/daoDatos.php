<?php
require_once('../models/conection.php');
require_once('../models/datos.php');

function add($obj)
{
    $conn = new DataSource();
    if (!$conn->conectar()) {
        echo 'error';
        exit;
    } else {
        $cli = $obj;
        $sql = "INSERT INTO datos VALUES(null,?,?,?,?,?,?,?,?)";
        if ($stmt = $conn->conn->prepare($sql)) {
            $ip = $cli->ip;
            //$hostname = $cli->hostname;
            $city = $cli->city;
            $region = $cli->region;
            $country = $cli->country;
            $loc = $cli->loc;
            $org = $cli->org;
            $timezone = $cli->timezone;
            $stmt->bind_param('ssssssss', $ip, 'hola', $city, $region, $country, $loc, $org, $timezone);
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
    $datos = new Datos();
    $datos->ip = $_POST['ip'];
    //$datos->hostname = $_POST['hostname'];
    $datos->city = $_POST['city'];
    $datos->region = $_POST['region'];
    $datos->country = $_POST['country'];
    $datos->loc = $_POST['loc'];
    $datos->org = $_POST['org'];
    $datos->timezone = $_POST['timezone'];
    add($datos);
}
