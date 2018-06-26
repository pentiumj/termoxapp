<?php

?>
<script>
    
    $(document).ready(function(){
        $('#nombrem').validCampo(' abcdefghijklmnñopqrstuvwxyzáéiou');
        $('#apellidom').validCampo(' abcdefghijklmnñopqrstuvwxyzáéiou');
        $("#form-mod-reg").validate({
                rules: {
                    contrasena: {
                        required: true,
                        minlength: 5
                    }
                },
                submitHandler: function(form) {
                    cedula = $("#cedulam").val();
                    nombre = $("#nombrem").val()
                    apellido = $("#apellidom").val();
                    contrasena = $("#contrasenam").val();
                    email = $("#emailm").val();
                    
                    $.ajax({
                        data:  'cedula='+cedula+'&nombre='+nombre+'&apellido='+apellido+'&contrasena='+contrasena+'&email='+email,
                        url:   '../controlador/modificarRegentesC.php',
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
    isset($_POST['cedula']) && !empty($_POST['cedula']) && is_numeric($_POST['cedula']) &&
    isset($_POST['nombre']) && !empty($_POST['nombre']) &&
    isset($_POST['apellido']) && !empty($_POST['apellido']) &&
    isset($_POST['email']) && !empty($_POST['email'])
){
    
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
   
    ?>
    <h2>Modificar regente</h2>
    
    <form method="POST" id="form-mod-reg">
                        
        Cédula<input type="text" id="cedulam" name="cedula" value="<?php echo $cedula; ?>" disabled="disabled">
        Nombre<input tupe="text" id="nombrem" name="nombre" required value="<?php echo $nombre; ?>"><br>
        Apellido<input type="text" id="apellidom" name="apellido" required value="<?php echo $apellido; ?>"><br>
        Email<input type="email" id="emailm" name="email" required value="<?php echo $email; ?>"><br>
        Contraseña<input type="password" id="contrasenam" required name="contrasena" placeholder="Contraseña">
        <input type="submit" id="modificar" value="Modificar">
        <a href='#'onclick="$('#agregarForm').dialog('close');location.reload();">[Cerrar]</a>

    </form>
    
    <div id="divRespuesta"></div>


<?php
    
}



