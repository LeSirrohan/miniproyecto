<?php 
session_start();
include("../model/user.php");


$user    = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : "";
$result =[];
$conexion = new Conexion();
$usuario = new User();
$conex = $conexion->getConexion();
$usuario -> setEmail($user);
$usuario -> setPassword($password);
$result = $usuario ->loginUser();
if($result['email'] != ""){
    $_SESSION["_nombre"] = $result['nombre'];
    $_SESSION["_apellido"] = $result['apellido'];
    $_SESSION["_email"] = $result['email'];
    echo json_encode($result);
}
else{
    session_destroy();
    $return  = array('mensaje' =>   "Usuario o contraseña incorrectos");
    echo json_encode($return);
}