<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>

<?php 

require_once "../controlador/consultarAdminC.php";
?>

<?php include "./plantilla/metas.php"; ?>
           
        <title>GESTIÓN ADMINISTRACIÓN - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        <link href="css/crud.css" rel="stylesheet" type="text/css" />
       
        <?php include "./plantilla/scripts-css.php"; ?>
        <script src="js/ajaxAsincrono.js"></script>               
    </head>
    <script>
        $(document).ready(function(){
           
           $("#form-admin").validate({
               rules: {
                    nombre:{
                        maxlength: 20
                    },
                    apellido:{
                        maxlength: 20
                    },
                    email :{
                        maxlength: 45
                    },
                    contrasena :{
                        minlength: 5,
                        maxlength: 25
                    }                          
               },
               submitHandler: function(form) {
                    cedula = $("#cedula").val();
                    nombre = $("#nombre").val();
                    apellido = $("#apellido").val();
                    email = $("#email").val();
                    contrasena = $("#contrasena").val();
                    if (cedula.indexOf(':') > -1 )cedula= cedula.split(': ')[1];
                    if (nombre.indexOf(':') > -1 )nombre= nombre.split(': ')[1];                
                    if (apellido.indexOf(':') > -1 )apellido= apellido.split(': ')[1];
                    if (email.indexOf(':') > -1 )email= email.split(': ')[1];    
                    $.ajax({
                        data:  'cedula='+cedula+'&nombre='+nombre+'&apellido='+apellido+'&contrasena='+contrasena+'&email='+email,
                        url:   '../controlador/modificarAdminC.php',
                        type:  'post',

                        success:  function (response) {
                                $("#ajax").html(response);

                        }
                    }); 
                }
        });
           
        });
    </script>
    <body onload="document.formAdmin.nombre.focus()">
        <div id="contenedor">
                       
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

                 
            <div id="contenedorSup">
                <div id="asincronos"></div>
            </div>            
                  
            
            <br>
            
            <div id="contenedorInf">
                <div class="ubi">Gestión >> Administración</div>
                <div class="titulo1">Datos personales administrador</div></br><br>
                <div id="agregar">
                    
                    <h2>Modificar Datos</h2>
                    
                    <form method="POST" id="form-admin" name="formAdmin">
                        <?php
                        foreach ($datosAdmin as $fila):

                        ?>
                        <input type="hidden" name="cedula" id="cedula"  value="<?=$fila['cedula'];?>">
                        <input type="text" disabled  name="cedula2" id="cedula2" placeholder="Cédula" value="<?="Cédula: ".$fila['cedula'];?>">
                        <input required type="text" class="datos-admin" name="nombre" id="nombre" placeholder="Nombre" value="<?=$fila['nombre'];?>">
                        <input  required type="text" class="datos-admin" name="apellido" id="apellido" placeholder="Apellido" value="<?=$fila['apellido'];?>">
                        <input type="email" class="datos-admin" name="email" id="email" placeholder="Correo" required value="<?=$fila['email'];?>"/>
                        <input type="password" required name="contrasena" id="contrasena" placeholder="Contraseña (5-25 caracteres)" >
                        <?php
                        endforeach;
                        ?><br>
                        <button id="mod-admin" type="submit">Modificar</button>
                        
                    </form>
                    <div id="ajax"></div>
                </div>
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