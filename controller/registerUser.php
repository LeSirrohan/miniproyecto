<?php 
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
$usuario = new User();
$usuario->setNombre($nombre);
$usuario->setApellido($apellido);
$usuario->setEmail($email);
$usuario->setPassword($password);
$result = $usuario->registerUser();
if ($result) {
    return header("Location:../view/inicio.php");
} else {
    return json_encode($return);
}
