<?php
session_start();
include("../class/conexion.php");
include("../model/user.php");

$idLocal    = isset($_REQUEST['idLocal']) ? $_REQUEST['idLocal'] : "";

$result =[];
$conexion = new Conexion();
$conex = $conexion->getConexion();
$consulta = "SELECT DATE_FORMAT(dia,'%d-%m-%Y') dia_venta,monto,cantMesas from resumendia";
if($idLocal != ""){
    $consulta .= " WHERE idLocal = '{$idLocal}'";
}
$result = $conex->query("$consulta");

$data = [];
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $data[] = $row;
}
echo json_encode($data);