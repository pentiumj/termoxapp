<?php
    
    require_once '../modelo/datosModelo.php';
    insertar(360);
    function insertar($VnumeroDias){
        
        $datosModelo = new datosModelo();
        
        for($i=1;$i<=$VnumeroDias;$i++){
        
            $Vtemp = rand(20,25);
            $Vhume = rand(50,55);
            $Vmesesitos = rand(1,12);
            $Vdia = rand(1,30);

            if($Vdia <= 9)
                $Vdia = '0'.$Vdia;            

            if($Vmesesitos <= 9)
                $Vmesesitos = '0'.$Vmesesitos;

            if($Vmesesitos=='02' && $Vdia>28)
                $Vdia = 28;

            $datosModelo->insertarAleatorios($Vtemp, $Vhume, $Vmesesitos, $Vdia);
        
        }
        
        echo "Se han insertado los datos satisfactoriamente";
        
    }

