<?php

include_once '../modelo/farmaciasModelo.php';


function listarFarmacias(){
    
    $farmacias = new farmaciasModelo();
    $datosFarmacias = $farmacias->listarFarmacias(0);
    
    return $datosFarmacias;
   
}

function listarFarmaciaUsuario($idFarmacia){
    
    $farmacias = new farmaciasModelo();
    $datosFarmacias = $farmacias->listarFarmacias($idFarmacia);
    
    return $datosFarmacias;
   
}

