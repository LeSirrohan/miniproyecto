<?php
 session_start(); 
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

header("Cache-Control: max-age=2592000");
include("../model/resumenDia.php");

$idLocal    = isset($_REQUEST['idLocal']) ? $_REQUEST['idLocal'] : "";

$result =[];
$resumen = new resumenDia();
$result = $resumen->getResumenDia($idLocal);
echo json_encode($result);