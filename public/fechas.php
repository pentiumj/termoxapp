<?php 

require_once '../controlador/fechasC.php';

    if( (isset($_POST['inicio'])) && (isset($_POST['fin']))){
        
        $inicio = $_POST['inicio'];
        $fin = $_POST['fin'];
        
        $totalArray = mostrarDatos($inicio, $fin);
        $resultadoFecha = mostrarFechas($inicio, $fin);
        
        if($totalArray != 0 || $resultadoFecha != 0){
            foreach ($resultadoFecha as $fila) :          
            
            $fecha[] = str_replace('-', ',', $fila);
        
            endforeach; 

            $jsonFechas= json_encode($fecha);
            $jsonTemp= json_encode($totalArray[0]);
            $jsonHume= json_encode($totalArray[1]);
            $datos = 1;
            $jsonDatos = json_encode($datos);
        }
        else{
           $datos = 0; 
           $jsonDatos = json_encode($datos);
        }
        
       
        
    }