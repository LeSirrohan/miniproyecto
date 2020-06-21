<?php 
session_start();
include("../model/local.php");

$result =[];
$local = new Local();
$data = [];
$data = $local->getLocales();
echo json_encode($data);