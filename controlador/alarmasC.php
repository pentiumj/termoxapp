<?php

require_once '../modelo/preestablecidosModelo.php';
$idFarmacia = $_SESSION['idFarmacia'];
$preestablecidosModelo = new preestablecidosModelo();

if($_POST){
    
    $val = array("temperatura", "humedad", "humedadMin");
    
    foreach ($val as $key){
        if(isset($_POST[$key]) && !empty($_POST[$key])){
            $exito = 1;
        }else{
            $exito = 0;
        }
    }
    
    if($exito == 1){
        extract($_POST, EXTR_PREFIX_SAME, "wddx");

        $preestablecidosModelo->actualizarAlarma($temperatura, $humedad, $humedadMin, $idFarmacia);
        
    }
}

$datos = $preestablecidosModelo->listarDatos($idFarmacia);



