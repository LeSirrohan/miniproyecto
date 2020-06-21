<?php 
session_start(); 
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

header("Cache-Control: max-age=2592000");
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
if($result['nombre']!=""){
    $_SESSION["_nombre"] = $result['nombre'];
    $_SESSION["_apellido"] = $result['apellido'];
    $_SESSION["_email"] = $result['email'];
    $result  = array('error' => 0 );
    echo json_encode($result);
}
else{
    session_destroy();
    $return  = array('error' => 1,'mensaje' =>   "Usuario o contraseña incorrectos");
    echo json_encode($return);
}