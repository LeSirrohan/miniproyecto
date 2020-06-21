<?php
session_start();
include("../model/resumenDia.php");

$idLocal    = isset($_REQUEST['idLocal']) ? $_REQUEST['idLocal'] : "";

$result =[];
$resumen = new resumenDia();
$result = $resumen->getResumenDia($idLocal);
echo json_encode($result);