<?php

include_once '../modelo/usuariosModelo.php';

if(
        isset($_POST['cedula']) 
        && !empty($_POST['cedula'])
        && is_numeric($_POST['cedula'])
   )
{
    $cedula = $_POST['cedula'];
    $usuariosModelo = new usuariosModelo();
    $resultado = $usuariosModelo->eliminarUsuarios($cedula);
    
    if($resultado==1){
        echo "<b>Registro eliminado<b>";
        ?>
<script>  
    $(document).ready(function(){
        $(".beliminar").hide();
    });
</script>
<?php
    }
    
}