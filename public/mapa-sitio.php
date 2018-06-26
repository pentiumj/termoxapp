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
                
                <div class="titulo1">MAPA DE SITIO</div><br>
                
                <div style="text-align: center; margin-left:10px"><a target="_blank" href="img/mapa-sitio.png"><img src="img/mapa-sitio.png" width="100%" height="100%"></a></div>
                
                

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