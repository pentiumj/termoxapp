<?php

    require_once '../modelo/datosModelo.php';

    function mostrarDatosTabla($inicio, $fin, $idFarmacia){
        
        $datosModel = new datosModelo();
        $datosFecha = $datosModel->mostrarDatosTabla($inicio, $fin, $idFarmacia);
        return $datosFecha[0];
        
    }
  

function formatoFecha($valor){    
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $fecha=$valor;
    $ano=substr($fecha,0,4); 
    $mes=substr($fecha,5,2);
    if(substr($mes, 0,1)=='0')substr($mes, 1,1);
    $dia=substr($fecha,8,2); 
    $fecha=$dia."-".$meses[$mes-1]."-".$ano;
    return $fecha;    
}

    
    function mostrarPromedioManana($inicio, $fin, $idFarmacia){
        $datosModel = new datosModelo();
        $datosManana= $datosModel->promedioDatosManana($inicio, $fin, $idFarmacia);
        
        if(count($datosManana)!= 1){
            
            if(count($datosManana)== 0){
                return 2;  
            }else{
                $c=0;
                $totalT=0;
                $totalH=0;
                
                foreach ($datosManana as $fila):
                    $totalT +=$fila['promTempMa'] ;
                    $totalH +=$fila['promHumeMa'] ;  
                    $c++; 
                endforeach;
                $totalT = round(($totalT/$c),1);
                $totalH = round(($totalH/$c),1);
                $arreglo = array($totalT,$totalH);
                
                return [$totalT,$totalH];
            }
        }else{
             
            foreach ($datosManana as $fila):
                    $promTemMa =$fila['promTempMa'] ;
                    $promHumeMa =$fila['promHumeMa'] ;  
                    
            endforeach;
            return [$promTemMa, $promHumeMa]; 
        }
                     
    }
    
    function mostrarPromedioTarde($inicio, $fin, $idFarmacia){
        $datosModel = new datosModelo();
        $datosTarde= $datosModel->promedioDatosTarde($inicio, $fin, $idFarmacia);
        
        if(count($datosTarde)!= 1){
            
            if(count($datosTarde)== 0){
                return 2;  
            }else{
                $c=0;
                $totalT=0;
                $totalH=0;
                
                foreach ($datosTarde as $fila):
                    $totalT +=$fila['promTempTa'] ;
                    $totalH +=$fila['promHumeTa'] ;  
                    $c++; 
                endforeach;
                $totalT = round(($totalT/$c),1);
                $totalH = round(($totalH/$c),1);
                $arreglo = array($totalT,$totalH);
                
                return [$totalT,$totalH];
            }
        }else{
             
            foreach ($datosTarde as $fila):
                    $promTemTa =$fila['promTempTa'] ;
                    $promHumeTa =$fila['promHumeTa'] ;  
                    
            endforeach;
            return [$promTemTa, $promHumeTa]; 
        }
                     
    }
    
    function ocultar($inicio, $fin, $idFarmacia){
        
        $datosModel = new datosModelo();
        $datosFecha = $datosModel->mostrarDatosTabla($inicio, $fin, $idFarmacia);
        return $datosFecha[1];
        
    }
    
    function datosParaEstadisticas($inicio, $fin, $idFarmacia){
        $datosModel = new datosModelo();
        $datosEstadisticos = $datosModel->consultarDatosEstadisticas($inicio, $fin, $idFarmacia);
        return $datosEstadisticos;                
    }
    function promedio($inicio, $fin, $tipo, $idFarmacia){
        
        $datosProm = datosParaEstadisticas($inicio, $fin, $idFarmacia);
        $c=0;
        $totalT=0;
        $totalH=0;
        foreach ($datosProm as $fila):
            $totalT +=$fila['promedioTemp'] ;
            $totalH +=$fila['promedioHume'] ;  
            $c++; 
        endforeach;
        if($tipo == 0){
            $totalT = round(($totalT/$c),1);
            return $totalT;    
        }
        else {
            $totalH = round(($totalH/$c),1);
            return $totalH;    
        }
        
    }
    
    function rango($inicio, $fin, $tipo, $idFarmacia){
        $datosRango = datosParaEstadisticas($inicio, $fin, $idFarmacia);
        $arrayT = array();
        $arrayH = array();
        foreach ($datosRango as $fila):
            $arrayT [] = $fila['promedioTemp'];
            $arrayH [] = $fila['promedioHume'];
        endforeach;
        
        
        if($tipo == 0){
            $maximo = max($arrayT);
            $minimo = min($arrayT);            
        }
        else {
            $maximo = max($arrayH);
            $minimo = min($arrayH);   
        }
        $arrayR = array($minimo, $maximo);
        $rango = $maximo - $minimo;
        return $arrayR;
    }
    
    function moda($inicio, $fin, $tipo, $idFarmacia){
        $datosModa = datosParaEstadisticas($inicio, $fin, $idFarmacia);
        $arrayT = array();
        $arrayH = array();
        foreach ($datosModa as $fila):
            $arrayT [] = $fila['promedioTemp'];
            $arrayH [] = $fila['promedioHume']; 
        endforeach;
        if($tipo == 0){
            return modaTipo($arrayT);         
        }
        else {
            return modaTipo($arrayH);   
        }
    }

    function modaTipo($tipoArray){
            $frecuencia = array_count_values($tipoArray);
            arsort($frecuencia);
            $cant = max($frecuencia);
            $modas = array();
            if($cant == 1){
                return "No hay moda";
            }else{
                foreach ($frecuencia as $fila => $ind):
                    if($ind == $cant){
                        $modas [] = $fila;                
                    }
                endforeach;                
            }
            return $modas;
    }

    function varianza($inicio, $fin, $tipo, $idFarmacia){
        $prom = promedio($inicio, $fin, $tipo, $idFarmacia);
        $datosVar = datosParaEstadisticas($inicio, $fin, $idFarmacia);
        $cantVar = count($datosVar) - 1;
        $varianzaT = 0;
        $varianzaH = 0;
        foreach ($datosVar as $fila):
            $varianzaT += pow(($fila['promedioTemp']-$prom),2);
            $varianzaH += pow(($fila['promedioHume']-$prom),2);
        endforeach;
        if($cantVar!==0){
            if($tipo == 0){
                $varianza = ($varianzaT/$cantVar);            
            }else{
                $varianza = ($varianzaH/$cantVar);            
            }
        }else{
            $varianza = 0;
        }
            
        return round($varianza,3);
    }
    
    function desviacionE($inicio, $fin, $tipo, $idFarmacia){
        $varianza = varianza($inicio, $fin, $tipo, $idFarmacia);
        $desviacion = sqrt($varianza);
        return round($desviacion,3);
    }