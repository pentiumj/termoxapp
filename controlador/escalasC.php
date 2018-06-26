<?php

    require_once '../modelo/preestablecidosModelo.php';
    

 if($_POST){
     
     if($_POST['escala'] == 'c'){
         $escala = 0;
     }else{
         $escala = 1;
     }
     
     $idFarmacia = $_SESSION['idFarmacia'];
     
     $preestablecidosModelo = new preestablecidosModelo();
    
     $preestablecidosModelo->actualizarDatos($escala, $idFarmacia);
     
     $preestablecidosModelo->listarDatos($idFarmacia);
     $datos = $preestablecidosModelo->listarDatos($idFarmacia);
     
     if($datos[0][4] == 0){
         $_SESSION['escala'] = 'c';
     }else{
         $_SESSION['escala'] = 'f';
     }
         
     
     
 }