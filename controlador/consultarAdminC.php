<?php 
require_once '../modelo/usuariosModelo.php';
$usuariosModelo = new usuariosModelo();
$datosAdmin = $usuariosModelo->consultarAdminstrador($_SESSION["cedula"]);
   

