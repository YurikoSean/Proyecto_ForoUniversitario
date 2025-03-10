<?php
session_start();
require_once("config/Configuracion.php");
require_once("config/Enrutador.php");
require_once("controladores/controlador.php");

$contro = new Controlador();

$contro->main();

/*
$enru=new Enrutador();
$enru->getRuta();*/
?>