<?php

include_once '../modelo/preestablecidosModelo.php';


date_default_timezone_set("America/Bogota");
$fechaHora = date('Y-m-d H:i:s', time());
$idFarmacia = 1;

$modelo = new preestablecidosModelo();
$datos = $modelo->listarDatos($idFarmacia);

$envio = $datos[0][4];


function actualizarFH(){   
    date_default_timezone_set("America/Bogota");
    $fechaHora = date('Y-m-d H:i:s', time()+60*5); //Enviar cada 5 minutos alarmas de correo
    $idFarmacia = $_SESSION['idFarmacia'];
    
    $modelo = new preestablecidosModelo();
    $datos2 = $modelo->actualizarHora($idFarmacia, $fechaHora);
}


