<?php
include_once '../modelo/usuariosModelo.php';
if($_POST){
    if(
        isset($_POST['cedula']) && !empty($_POST['cedula']) && is_numeric($_POST['cedula']) &&
        isset($_POST['nombre']) && !empty($_POST['nombre']) &&
        isset($_POST['apellido']) && !empty($_POST['apellido']) &&
        isset($_POST['contrasena']) && !empty($_POST['contrasena'])&&
        isset($_POST['email'])
    ){
        
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $contrasena = $_POST['contrasena'];
        $email = $_POST['email'];
        
        $usuariosModelo = new usuariosModelo();
        $actualizar = $usuariosModelo ->modificarAdministrador($cedula, $nombre, $apellido, $contrasena, $email);
        if($actualizar == 1){
            ?>
            <script>alert("Modificación Exitosa");
            location = "administradores.php";
            </script> 
            <?php
        }else{
            ?>
            <script>alert("Error al modificar");</script> 
            <?php        
        }
    }else{
        ?>
        <script>alert("Verifique los datos ingresados");</script> 
        <?php        
    }
}
