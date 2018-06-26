<?php
require_once "../modelo/datosModelo.php";
require_once 'libs/PHPExcel/Classes/PHPExcel/IOFactory.php';

function cargarExcel($idFarmacia){    
    $objPHPExcel = PHPExcel_IOFactory::load("../docs/total.xls");
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
    $objWriter->save('../docs/prueba.csv');
    $handle = fopen("../docs/prueba.csv", "r");
    $con = 0;
    while (($data = fgetcsv($handle)) !== FALSE){
        $con++;                 
        if($con>11){
            $lineas[] =$data[0];            
        }
    }
    foreach ($lineas as $indice=>$valor){
        $posI[] = strpos($valor, " ");
        $posU[] = strpos($valor, " F");
    }
    $nlineas = count($lineas);
    for($i=0; $i<$nlineas; $i++){
        $long = $posU[$i] - $posI[$i];
        $Vtemp[$i] = substr($lineas[$i], $posI[$i], $long);
    }
    unset($posI);
    unset($posU);
    foreach ($lineas as $indice=>$valor){
        $posI[] = strpos($valor, "F ")+2;
        $posU[] = strpos($valor, " %");
    }
    $nlineas = count($lineas);
    for($i=0; $i<$nlineas; $i++){
        $long = $posU[$i] - $posI[$i];
        $Vhume[$i] = substr($lineas[$i], $posI[$i], $long);        
    }
    unset($posI);
    unset($posU);
    foreach ($lineas as $indice=>$valor){
        $posI[] = strpos($valor, "%RH ")+3;       
    }
    $nlineas = count($lineas);
    for($i=0; $i<$nlineas; $i++){
        $fecha[$i] = substr($lineas[$i], $posI[$i]);
        $fecha[$i] = str_replace('/', '-', $fecha[$i]);
        $mes[$i] = substr($fecha[$i], 14, 2);      
        $dia[$i] = substr($fecha[$i],17, 2);
        $año[$i] = substr($fecha[$i],20, 2);
        $fecha[$i] = substr_replace($fecha[$i], $año[$i], 14, 2);
        $fecha[$i] = substr_replace($fecha[$i], $mes[$i], 17, 2);
        $fecha[$i] = substr_replace($fecha[$i], $dia[$i], 20, 2);
        $Vfecha[$i] = '20'.trim($fecha[$i]);
        guardarDatos($Vtemp[$i],$Vhume[$i],$Vfecha[$i], $idFarmacia);
    }
}

function guardarDatos($Vtemp, $Vhume, $Vfecha, $idFarmacia){
    $datosModelo = new datosModelo();
    
        
            $datosModelo->cargarDatos($Vtemp, $Vhume, $Vfecha, 1);
           
   
        
}
?>   
