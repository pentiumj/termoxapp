<?php
require_once '../modelo/usuariosModelo.php';
if($_POST){
    
    $sesion = $_POST['sesion']; 
    $idUsuario = $_POST['idUsuario']; 
    
    $usuariosModelo = new usuariosModelo();
    $tiempoSesion = $usuariosModelo->modificarSesionUsuario($idUsuario, $sesion);
    
    if($tiempoSesion==1){
        ?>
<script>alert("Configuración de sesion exitosa"); location = "tiempoSesion.php";</script>
            <?php
    }
}