<?php
    require_once '../modelo/usuariosModelo.php';
    
    
    function mostrarDatosTabla($cedula, $contrasena){
        
        $usuariosModelo = new usuariosModelo();
        $validar = $usuariosModelo->consultarUsuario($cedula, $contrasena);
        return $validar;
        
    }
    
    function consultarUsuarioAdmin($cedula, $contrasena){
        $usuariosModelo = new usuariosModelo();
        $validar = $usuariosModelo->consultarUsuarioAdmin($cedula, $contrasena);
        return $validar;
    }