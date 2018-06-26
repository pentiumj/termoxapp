<?php 
    require_once '../modelo/usuariosModelo.php';
      
    function listarRegentes(){
        
        $tipoUsuario=3;
        $idFarmacia = $_SESSION['idFarmacia'];
        $usuariosModelo = new usuariosModelo();

        $regentes = $usuariosModelo->listarUsuarios($tipoUsuario, $idFarmacia);
        return $regentes;
    }
    
    function listarAdmin(){
        
        $tipoUsuario = 2;
        $idFarmacia = 0; //todas las farmacias
        $usuariosModelo = new usuariosModelo();

        $admins = $usuariosModelo->listarUsuarios($tipoUsuario, $idFarmacia);
        return $admins;
    }
       