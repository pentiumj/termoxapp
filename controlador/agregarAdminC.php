<?php 
require_once '../modelo/usuariosModelo.php';
if($_POST){
    if(
        isset($_POST['cedula']) && !empty($_POST['cedula']) && is_numeric($_POST['cedula']) &&
        isset($_POST['nombre']) && !empty($_POST['nombre']) &&
        isset($_POST['apellido']) && !empty($_POST['apellido']) &&
        isset($_POST['contrasena']) && !empty($_POST['contrasena'])&&
        isset($_POST['email'])&& !empty($_POST['email'])&&
        isset($_POST['farmacia'])&& !empty($_POST['farmacia'])    
    ){
        
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $contrasena = $_POST['contrasena'];
        $email = $_POST['email'];
        $idFarmacia = $_POST['farmacia'];
        
        $usuariosModelo = new usuariosModelo();
        $agregarAdmin = $usuariosModelo ->agregarUsuarios($cedula, $nombre, $apellido, $contrasena, $email, 2, $idFarmacia);
        if($agregarAdmin == 1){
            ?>
            <script>alert("Administrador creado con exito");
            location = "listarAdm.php";
            </script> 
            <?php
        }else{
            ?>
            <script>alert("Error al agregar. Verique sus datos");</script> 
            <?php        
        }
    }else{
        ?>
        <script>alert("Verifique los datos ingresados");</script> 
        <?php        
    }
}
   

