<?php 
session_start();
include("../class/conexion.php");
include("../model/local.php");

$result =[];
$conexion = new Conexion();
$conex = $conexion->getConexion();
$result = $conex->query("SELECT * FROM local ");
$data = [];
while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $data[] = $row;
}
echo json_encode($data);