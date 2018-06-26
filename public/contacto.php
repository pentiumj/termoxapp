<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>

<?php 
require_once "../controlador/tHActualC.php"; 
require_once "../controlador/mDatosC.php"; 
require_once '../controlador/tiempoSesionC.php';
?>

<?php include "./plantilla/metas.php"; ?>
           
        <title>TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        
        <link href="css/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.date.css" rel="stylesheet" type="text/css" />
        
        <script src="libs/amcharts/amcharts.js"></script>
        <script src="libs/amcharts/serial.js"></script>
        <script src="libs/amcharts/themes/light.js"></script>
        
        
        <script src="js/ajaxAsincrono.js"></script> 
        <script src="js/datosInicio.js"></script> 
        <link href="./css/formulario.min.css" rel="stylesheet" type="text/css" />
        
    </head>
    <body>
        <div id="contenedor">
                       
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

            <?php if($infoUsuario["tipoUsuario"]!=1){?>             
            <div id="contenedorSup">
                <div id="asincronos"></div>
            </div>            
            <?php }?>
            
            <div id="contenedorInf"> 
                
                
            </div>
            
            <div id="contenedorTexto">
                
                <div class="titulo1">Contacta con nosotros</div>
                
                <p>Si tiene dudas, sugerencias, comentarios o propuestas, por favor háganoslas saber llenando el siguiente formulario:</p>
                
                <div id="respuestaForm">
                    <form id="contacto" name="contacto" action="enviarForm.php" method="post">
                        <label>Nombre:</label><input type="text" id="nombre" name="nombre" size="35"  /><br><br>
                        <label>Email:</label><input type="text" id="correo" name="correo" size="35"  /><br><br>
                        <label>Sitio web:</label><input type="text" id="sitio" name="sitio" size="35"  /><br><br>
                        <label>Mensaje: </label><textarea id="mensaje" name="mensaje" rows="5" cols="30"></textarea><br><br>
                        <input type="submit" value="Enviar" id="enviarForm" name="enviarForm" /> 
                    </form>
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