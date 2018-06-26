<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>
<?php 

require_once "../controlador/listarFarmaciasC.php"; 
?>


<?php include "./plantilla/metas.php"; ?>
           
        <title>AGREGAR ADMINISTRADOR - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        
        <script src="js/crud.js"></script>
        <script src="js/jquery-ui.min.js"></script> 
        <link href="css/crud.css" rel="stylesheet" type="text/css" />
       
        <style>
    
            .ui-dialog { font-size: 12px; background-color: #FBF5F5; z-index:1000}
            .ui-dialog .ui-dialog-titlebar {font-size: 12px; background-color: #ADD8E6; border-color:#ADD8E6}
            .ui-dialog .ui-dialog-titlebar-close {display:none}

        </style>
        <script>
        $(document).ready(function(){
           $('#cedula').validCampo('0123456789'); 
           $('#nombre').validCampo(' abcdefghijklmnñopqrstuvwxyzáéiou');
           $('#apellido').validCampo(' abcdefghijklmnñopqrstuvwxyzáéiou');
           $("#form-agre-admin").validate({
                rules: {
                    cedula:{
                            minlength: 5,
                            maxlength: 10
                    },
                    nombre:{
                        maxlength: 20
                    },
                    apellido:{
                        maxlength: 20
                    },
                    email :{
                        maxlength: 45
                    },
                    contrasena: {
                        required: true,
                        minlength: 5,
                        maxlength: 25
                    },
                    password_confirm: {
                        required: true,
                        minlength: 5,
                        equalTo: "#contrasena"
                    }
                },
                submitHandler: function(form) {
                    cedula = $("#cedula").val();
                    nombre = $("#nombre").val();
                    apellido = $("#apellido").val();
                    email = $("#email").val();
                    contrasena = $("#contrasena").val();
                    farmacia = $("#farmacia").val();
                    $.ajax({
                        data:  'cedula='+cedula+'&nombre='+nombre+'&apellido='+apellido+'&contrasena='+contrasena+'&email='+email+'&farmacia='+farmacia,
                        url:   '../controlador/agregarAdminC.php',
                        type:  'post',

                        success:  function (response) {
                                $("#ajax").html(response);

                        }
                    });
                }
        });
           
        });
    </script>
    </head>
    <body onload="document.formAgreAdmin.cedula.focus()">
        <div id="contenedor">
             
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

            
            <div id="contenedorInf">
                
                <div class="ubi">Administradores >> Agregar</div>
                <div class="titulo1">Agregar un administrador de farmacia</div></br><br>
                <div id="agregar">
                <h2>Registrar administrador</h2>
                    
                <form method="POST" name="formAgreAdmin" id="form-agre-admin">
                        
                    <input type="text" name="cedula" id="cedula" placeholder="Cédula" required>
                    <input tupe="text" name="nombre" id="nombre" placeholder="Nombre" required>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña (5-25 caracteres)" required/>
                    <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirme Contraseña (5-25 caracteres)" required/>
                    <select id="farmacia" name="farmacia" required>
                        <option disabled selected>Escoga una farmacia</option> 
                        <?php $datosFarmacia = listarFarmacias(); ?>
                        <?php foreach ($datosFarmacia as $fila): ?>

                        <option value="<?= $fila['idFarmacia'] ?>"><?= $fila['nombre'] ?></option>

                        <?php endforeach; ?>
                    </select><br>
                    <button type="submit">Agregar</button>
                        
                    </form>
                </div>
                <div id="ajax"></div>
                
                
            </div>


        <?php include './plantilla/pie.php'; ?>
            
        </div>
            <?php include './plantilla/analytics.php'; ?>
    </body>
    
</html>
<?php 

} else{
    
    echo "Usted no tiene acceso a esta zona";
    
} 
?>