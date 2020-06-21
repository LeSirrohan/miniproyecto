<?php 
session_start();
include("../class/conexion.php");
include("../model/user.php");


$user    = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : "";
$result =[];
$conexion = new Conexion();
$conex = $conexion->getConexion();
$result = $conex->query("SELECT email,password, nombre, apellido FROM users WHERE email = '{$user}' AND password = '{$password}'")->fetch();
if($result['email'] != ""){
    $_SESSION["_nombre"] = $result['nombre'];
    $_SESSION["_apellido"] = $result['apellido'];
    $_SESSION["_email"] = $result['email'];

}
else{
    session_destroy();
    $return  = array('mensaje' =>   "Usuario o contraseña incorrectos");
    return json_encode($return);
}