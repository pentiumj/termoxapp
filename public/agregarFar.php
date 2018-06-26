<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>
<?php 

require_once "../controlador/mDatosC.php"; 
?>


<?php include "./plantilla/metas.php"; ?>
           
        <title>AGREGAR FARMACIA - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
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
          $('#telefono').validCampo('0123456789'); 
           $("#form-agre-farm").validate({
                rules: {
                    nombre:{
                        maxlength: 30
                    },
                    direccion:{
                        maxlength: 30
                    },
                    telefono:{
                        maxlength: 10
                    },
                    email :{
                        maxlength: 45
                    },
                    empresa :{
                       
                        maxlength: 30
                    }                          
                },
                submitHandler: function(form) {
                    nombre = $("#nombre").val();
                    direccion = $("#direccion").val();
                    telefono = $("#telefono").val();
                    email = $("#email").val();
                    empresa = $("#empresa").val();
                   
                    $.ajax({
                        data:  'nombre='+nombre+'&direccion='+direccion+'&telefono='+telefono+'&email='+email+'&empresa='+empresa,
                        url:   '../controlador/agregarFarmaciaC.php',
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
    <body onload="document.formAgreFarm.nombre.focus()">
        <div id="contenedor">
             
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

                    
            
                      
            
            <div id="div-tabla"></div>
            
            <div id="contenedorInf">
                <div class="ubi">Farmacias >> Agregar</div>
                <div class="titulo1">Agregar farmacia</div></br></br>
                <div id="agregar">
                    <h2>Registrar farmacia</h2>

                    <form method="POST" id="form-agre-farm" name="formAgreFarm">

                        <input type="text" name="nombre" id="nombre" required placeholder="Nombre">
                        <input tupe="text" name="direccion" id="direccion" required placeholder="Dirección">
                        <input type="text" name="telefono" id="telefono" required placeholder="Teléfono">
                        <input type="email" name="email" id="email" required placeholder="Email">
                        <input type="text" name="empresa" id="empresa" required placeholder="Empresa"><br>

                        <button type="submit">Agregar</button>

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