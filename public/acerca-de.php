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
                
                <div class="titulo1">Sistema TERMOX</div>
                
                <p>Nuestro equipo de desarrolladores cuenta con una amplia experiencia en el desarrollo de
                aplicaciones para la web y en la aplicación de parámetros de usabilidad que permitan un manejo intuitivo
                a sus usuarios</p>
                <h3>Equipo desarrollador</h3>
                <ul>
                    <center><img src="img/john.jpg" width="100" height="100"></center>
                    <li>Ing. John Orlando Rosero Bolaños: Desarrollador entusiasta de la innovación tecnológica y un apasionado de los lenguajes de la web</li><br>
                    <center><img src="img/pedro.jpg" width="100" height="100"></center>
                    <li>Ing. Pedro Camilo Males Rosero: Desarrollador apasionado por la codificación y ansioso por los nuevos retos TI</li>
                </ul></p>
                
                <p>Encuéntranos en la siguiente dirección: Cra 23 # 45 - 56 Ed. Gran C. San Juan de Pasto - Colombia</p>
                <p><b>Tel:</b> (+57 2) 7291641 - (+57) 3172555069</p>
                
                

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