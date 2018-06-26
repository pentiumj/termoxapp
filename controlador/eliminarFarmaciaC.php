<?php

include_once '../modelo/farmaciasModelo.php';

if(
        isset($_POST['idFarmacia']) 
        && !empty($_POST['idFarmacia'])
        && is_numeric($_POST['idFarmacia'])
   )
{
    $idFarmacia = $_POST['idFarmacia'];
    $farmaciasModelo = new farmaciasModelo();
    $resultado = $farmaciasModelo->eliminarFarmacia($idFarmacia);
    
    if($resultado==1){
        echo "<b>Registro eliminado<b>";
        ?>
<script>  
    $(document).ready(function(){
        $(".beliminar").hide();
    });
</script>
<?php
    }else{
        echo "<b>No se pudo eliminar el registro</b>";
    }
    
}