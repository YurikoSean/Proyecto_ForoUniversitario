<?php
session_start();
require_once("config/Configuracion.php");
require_once("config/Enrutador.php");

$enru=new Enrutador();
$enru->getRuta();

?>