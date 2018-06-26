<?php
require_once "../controlador/listarFarmaciasC.php"; 
?>
<script>
    
    $(document).ready(function(){
        $('#telefonom').validCampo('0123456789'); 
        $("#form-mod-farm").validate({
                
                submitHandler: function(form) {
                    idFarmacia = $("#idFarmaciam").val();
                    nombre = $("#nombrem").val()
                    direccion = $("#direccionm").val();
                    telefono= $("#telefonom").val();
                    email = $("#emailm").val();
                    empresa = $("#empresam").val();
                    
                    $.ajax({
                        data:  'idFarmacia='+idFarmacia+'&nombre='+nombre+'&empresa='+empresa+'&direccion='+direccion+'&telefono='+telefono+'&email='+email,
                        url:   '../controlador/modificarFarmaciaC.php',
                        type:  'post',

                        success:  function (response) {
                                $("#divRespuesta").html(response);

                        }
                    }); 
                }
        });
        
        
    });
    
</script>

                


<?php


if(
    isset($_POST['idFarmacia']) && !empty($_POST['idFarmacia']) && is_numeric($_POST['idFarmacia']) &&
    isset($_POST['nombre']) && !empty($_POST['nombre']) &&
    isset($_POST['telefono']) && !empty($_POST['telefono']) && is_numeric($_POST['telefono']) &&
    isset($_POST['empresa']) && !empty($_POST['empresa']) &&
    isset($_POST['direccion']) && !empty($_POST['direccion']) &&
    isset($_POST['email']) && !empty($_POST['email'])
    
){
    $idFarmacia = $_POST['idFarmacia'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $empresa = $_POST['empresa'];
    ?>
    <h2>Modificar Farmacia</h2>
    
    <form method="POST" id="form-mod-farm">
        <input type="hidden" id="idFarmaciam" name="idFarmacia" value="<?php echo $idFarmacia; ?>">                
        Nombre<input tupe="text" id="nombrem" name="nombre" required value="<?php echo $nombre; ?>"><br>
        Dirección<input type="text" id="direccionm" name="direccion" required value="<?php echo $direccion; ?>"><br>
        Teléfono<input tupe="text" id="telefonom" name="telefono" required value="<?php echo $telefono; ?>"><br>
        Email<input type="email" id="emailm" name="email" required value="<?php echo $email; ?>"><br>
        Empresa<input type="text" id="empresam" required name="empresa" value="<?php echo $empresa; ?>"><br>
        
        <input type="submit" id="modificar" value="Modificar">
        <a href='#'onclick="$('#agregarForm').dialog('close');location.reload();">[Cerrar]</a>

    </form>
    
    <div id="divRespuesta"></div>


<?php
    
}else{
    echo "No se cargaron los datos (recargue la pagina)";
}



