<?php
require_once '../modelo/usuariosFarmaciaModelo.php';
function verDatosUsuario($sesion){
    $usuariosModelo = new usuariosFarmaciaModelo();
    $datosUsuario = $usuariosModelo->verUsuarioxFarmacia($sesion);
    return $datosUsuario;
}
function verDatosUsuarioAdmin($sesion){
    $usuariosModelo = new usuariosFarmaciaModelo();
    $datosUsuario = $usuariosModelo->verUsuarioAdmin($sesion);
    return $datosUsuario;
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

