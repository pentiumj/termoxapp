<?php 

require_once '../controlador/mDatosTablaC.php';

    if( (isset($_POST['inicio'])) && (isset($_POST['fin']))){
        
        $inicio = $_POST['inicio'];
        $fin = $_POST['fin'];
        $idFarmacia = $_SESSION['idFarmacia'];
        $arrayDatos = mostrarDatosTabla($inicio, $fin, $idFarmacia);        
        $ocultar = ocultar($inicio, $fin, $idFarmacia);
        if($arrayDatos!= 0){              
            $datos = 1;
            
            $manana = mostrarPromedioManana($inicio, $fin, $idFarmacia);
            $tarde = mostrarPromedioTarde($inicio, $fin, $idFarmacia);
          
            
            $promTemp = promedio($inicio, $fin, 0, $idFarmacia);
            $promHume = promedio($inicio, $fin, 1, $idFarmacia);
            $rangoTemp = rango($inicio, $fin, 0, $idFarmacia);
            $rangoHume = rango($inicio, $fin, 1, $idFarmacia);
            $modaTemp = moda($inicio, $fin, 0, $idFarmacia);
            $modaHume = moda($inicio, $fin, 1, $idFarmacia);
            $variTemp = varianza($inicio, $fin, 0, $idFarmacia);
            $variHume = varianza($inicio, $fin, 1, $idFarmacia);
            $desvTemp = desviacionE($inicio, $fin, 0, $idFarmacia);
            $desvHume = desviacionE($inicio, $fin, 1, $idFarmacia);
                        
        }
        else{
           $datos = 0; 
           
        }
             
    }
    