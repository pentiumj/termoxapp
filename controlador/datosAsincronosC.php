<?php
    
    require_once "../modelo/datosModelo.php";
    
    function fnAsincrona($fecha_a, $farmacia){
        $datosModelo = new datosModelo();
        $datosTH = $datosModelo->mostrarTHActual($farmacia);
        foreach ($datosTH as $fila):
            $fecha_bd = strtotime($fila['fecha']);     
            $temp = $fila['temperatura'];     
            $hume = $fila['humedad'];     
            while( $fecha_bd <= $fecha_a ){ 
                    
                    $fecha2 = $datosModelo->obtenerFecha($farmacia);

                    usleep(100000);//anteriormente 10000
                    clearstatcache();
                    $fecha_bd  = strtotime($fecha2['fecha']);
                    
            }
            return [$temp,$hume];
        endforeach;
    }
    


