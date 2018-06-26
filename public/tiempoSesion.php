<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>

<?php 

require_once "../controlador/mDatosC.php"; 
require_once '../controlador/tiempoSesionC.php';
?>

<?php include "./plantilla/metas.php"; ?>
           
        <title>CONFIGURACIÓN SESIÓN - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        
        <link href="css/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.date.css" rel="stylesheet" type="text/css" />
        
        <script src="libs/amcharts/amcharts.js"></script>
        <script src="libs/amcharts/serial.js"></script>
        <script src="libs/amcharts/themes/light.js"></script>
        
        
        <script src="js/ajaxAsincrono.js"></script> 
        <script src="js/datosInicio.js"></script> 
        <script> 
        window.onload = caducarSession(); 
        function caducarSession(){
            setTimeout("window.open('salir.php','_top');",900000);
        }
        </script>
    </head>
    <body>
        <div id="contenedor">
                       
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

            <?php if($infoUsuarioA["tipoUsuario"]!=1){?>             
            <div id="contenedorSup">
                
                <div id="asincronos"></div>
            </div>            
            <?php }?>
            
            <div id="contenedorInf">     
                
                <div class="ubi">Configuraciones >> Tiempo de sesión</div>
                <div class="titulo1">Configurar tiempo de sesión</div></br>
                <form method="POST">
                    <label for="sesion">Limite de sesión:</label>
                    <input type="hidden" name="idUsuario" value="<?=$infoUsuarioA["usuario"];?>"/>
                    <select id="sesion" name="sesion">
                        <option value="0" >Ninguno</option>
                        <option value="900000" <?php if($infoUsuarioA["sesion"]=="900000") echo "selected"; ?> >15 min</option>
                        <option value="1800000" <?php if($infoUsuarioA["sesion"]=="1800000") echo "selected"; ?>>30 min</option>
                        <option value="2700000" <?php if($infoUsuarioA["sesion"]=="2700000") echo "selected"; ?>>45 min</option> 
                        <option value="3600000" <?php if($infoUsuarioA["sesion"]=="3600000") echo "selected"; ?>>60 min</option>
                    </select>
                    <button class="verde">Guardar</button>
                </form>
                
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