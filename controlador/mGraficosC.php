<?php

    require_once '../modelo/datosModelo.php';
    
    $resultadoDias = array();
    
    function mostrarDias($mes){
         
        $datosModel = new datosModelo();
        $datosFecha = $datosModel->mostrarDatos($mes);
        
        foreach ($datosFecha as $fila) :             
            $resultadoDias[] = $fila['dia'];
        endforeach; 
                
        $resultadoDias = array_unique($resultadoDias);
        
        return $resultadoDias;
        
    }
    
    function mostrarDatos($mes){
        
        $datosT = array();
        $datosH = array();
        
        $datosModel = new datosModelo();
        $datosFecha = $datosModel->mostrarDatos($mes);
        
        foreach ($datosFecha as $fila) :             
            $a = $fila['dia'];
            $datosT[$a][] = $fila['temperatura'];
            $datosH[$a][] = $fila['humedad'];
        endforeach; 
        
        function promediar($datos){
            
            foreach($datos AS $item => $valor){ 
              $total = 0;
              $c = 0;
              for($i=0;$i<count($valor);$i++){
                  $total += $valor[$i];
                  $c++;
              }
             $totalArray[] = round($total/$c,1); 
            }
            
          return $totalArray;
        }
        
        return [promediar($datosT), promediar($datosH)];
    }
    
    

