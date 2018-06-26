<?php

require_once '../modelo/datosModelo.php';
require_once '../modelo/preestablecidosModelo.php';
require_once '../modelo/alarmasModelo.php';

if(
        isset($_POST["temp1"]) && !empty($_POST["temp1"]) &&
        isset($_POST["hum1"]) && !empty($_POST["hum1"]) &&
        isset($_POST["farm"]) && !empty($_POST["farm"])
        ){
    
    $temp=$_POST["temp1"];
    $hume=$_POST["hum1"];
    $farm=$_POST["farm"];
    
    $modeloDatos = new datosModelo();
    $guardarDatos =  $modeloDatos -> cargarDatos($temp,$hume,$farm);
    
    $modeloPreestrablecidos = new preestablecidosModelo();
    $datosPrestablecido = $modeloPreestrablecidos->listarDatos($farm);
    
    if($temp >= $datosPrestablecido[0][1] || $hume >= $datosPrestablecido[0][2] || $hume <= $datosPrestablecido[0][3]){
        
        $modeloAlarmas = new alarmasModelo();
        $guardarAlarma = $modeloAlarmas->agregarAlarma($guardarDatos);
        
    }
    
}