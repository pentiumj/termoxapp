<?php 
require_once '../modelo/farmaciasModelo.php';
if($_POST){
    if(
        
        isset($_POST['nombre']) && !empty($_POST['nombre']) &&
        isset($_POST['direccion']) && !empty($_POST['direccion']) &&
        isset($_POST['telefono']) && !empty($_POST['telefono'])&& is_numeric($_POST['telefono']) &&
        isset($_POST['email'])&& !empty($_POST['email'])&&
        isset($_POST['empresa'])&& !empty($_POST['empresa'])    
    ){
        
       
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $empresa = $_POST['empresa'];
        
        $farmaciasModelo = new farmaciasModelo();
        $agregarFarmacia = $farmaciasModelo ->agregarFarmacias($nombre, $direccion, $telefono, $email, $empresa);
        if($agregarFarmacia[0] == 1){
            $carp = mkdir("../docs/".$agregarFarmacia[1], 0700);
            ?>
            <script>alert("Farmacia creada con exito");
            location = "listarFar.php";
            </script> 
            <?php
        }else{
            ?>
            <script>alert("Error al agregar");</script> 
            <?php        
        }
    }else{
        ?>
        <script>alert("Verifique los datos ingresados");</script> 
        <?php        
    }
}
   

