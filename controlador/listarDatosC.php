<?php

    require_once '../modelo/preestablecidosModelo.php';
    
    function listarDatosF(){
        $idFarmacia = $_SESSION['idFarmacia'];

        $preestablecidosModelo = new preestablecidosModelo();

        $datos = $preestablecidosModelo->listarDatos($idFarmacia);
        return $datos;
    }

