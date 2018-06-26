<?php
    session_start();

    require_once '../modelo/datosModelo.php';
    
    $resultadoDias = array();
    function mostrarDatosGraficas($inicio, $fin, $idFarmacia){
        $datosModel = new datosModelo();
        $datosFecha = $datosModel->mostrarDatosTabla($inicio, $fin, $idFarmacia);
    }
    function mostrarFechas($inicio, $fin){
         
        $datosModel = new datosModelo();
        $datosFecha = $datosModel->mostrarDatosFecha($inicio, $fin);
        if($datosFecha != 0){
            foreach ($datosFecha as $fila) :             
            $resultadoDias[] = $fila['fechaTomada'];
            endforeach;

            $resultadoDias = array_unique($resultadoDias);

            return $resultadoDias;
        }
        else{
            return $datosFecha;
        }
        
        
        
    }
    
    function mostrarDatos($inicio, $fin){
        
        $datosT = array();
        $datosH = array();
        $f = 0;
        
        //Verificar si existe una configuración de escala y si es grados Fahrenheit
        if(isset($_SESSION['escala'])){
        
            if($_SESSION['escala']=='f'){
                
                $f = 1;
            }

        }
        
        $datosModel = new datosModelo();
        $datosFecha = $datosModel->mostrarDatosFecha($inicio, $fin);
        
        if($datosFecha != 0){
            foreach ($datosFecha as $fila) :             
                $a = $fila['fechaTomada'];
                $temp = $fila['temperatura'];
                
                if($f==1){
                    $datosT[$a][] = round($temp*(9/5)+32,2);
                }
                else{
                    $datosT[$a][] = $temp;
                }
                
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
        else{
            return $datosFecha;
        }
        
    }
    
    

