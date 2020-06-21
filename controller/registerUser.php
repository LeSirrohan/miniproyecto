<?php 
include("../class/conexion.php");
include("../model/user.php");

$nombre   = isset($_REQUEST['Nombre']) ? $_REQUEST['Nombre'] : "";
$apellido = isset($_REQUEST['Apellido']) ? $_REQUEST['Apellido'] : "";
$email    = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : "";
$rpassword = isset($_REQUEST['rpassword']) ? $_REQUEST['rpassword'] : "";
$agree = isset($_REQUEST['agree']) ? $_REQUEST['agree'] : "";
if($agree == "off")
{
    $return  = array('mensaje' =>  "Debe estar de acuerdo con los términos y condiciones");
    return json_encode($return);

}
$usuario = new Users();
$conexion = new Conexion();
$conex = $conexion->getConexion();
$usuario->setNombre($nombre);
$usuario->setApellido($apellido);
$usuario->setEmail($email);
$usuario->setPassword($password);
$id = [];
$id = $conex->query("SELECT UUID() uuid")->fetch();
$consul = $conex->prepare("INSERT INTO users (id, nombre, apellido, email,password) values (:id,:nombre,:apellido,:email,:password);");
$consul->bindParam(':id',$id[0]);
$consul->bindParam(':nombre',$usuario->getNombre());
$consul->bindParam(':apellido',$usuario->getApellido());
$consul->bindParam(':email',$usuario->getEmail());
$consul->bindParam(':password',$usuario->getPassword());
try {
    $consul->execute();
    return header("Location:../view/login.php?mensaje=1");
} catch (PDOException $e) {
    
    $return  = array('mensaje' =>   $e->getMessage());
    return json_encode($return);
}
