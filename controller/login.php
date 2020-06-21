<?php
include("../class/conexion.class.php");
include("../class/user.class.php");
$conexion = new Conexion();
$conex = $conexion->getConexion();
$res = $conex->query("SELECT * from users");
while($row = $res->fetch()){
    $_REG[] = $row;
}
echo json_encode($_REG);