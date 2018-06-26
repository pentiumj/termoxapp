<?php
    
    require_once "../modelo/datosModelo.php";
    
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      
    $datosModelo = new datosModelo();
    $mostrarTHA = $datosModelo->mostrarTHActual($_SESSION['idFarmacia']);


