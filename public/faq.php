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
                <div class="titulo1">Preguntas Frecuentes</div></br>
                <ol>
                    <li>¿Qué navegador es el más óptimo para usar TERMOX?<br>
                    R/ Chrome y Firefox para equipos de escritorio y Chrome para versiones móviles. Todos en sus últimas versiones</li>                    
                    <li>¿Qué sistemas operativos son soportados por TERMOX?<br>
                    R/ El sistema TERMOX ha sido probado en Chrome y Firefox corriendo en Windows 10, Mac OSX El Capitán y Ubuntu Linux</li>
                    <li>¿Qué especificaciones de hardware son recomendadas para usar TERMOX?<br>
                    R/ Se recomienda mínimo un equipo con procesador i3 y 2GB RAM. En caso de equipos móviles se recomiendan equipos con procesador quad core con 2GB de RAM </li>
                    <li>¿Cómo puedo recibir asistencia técnica para el uso de TERMOX?<br>
                    R/ Puede contactarnos en la dirección y teléfonos especificados en el apartado "Acerca de" del pie de página o en el formulario del apartado "Contáctenos"</li>
                    <li>¿Puedo enviar sugerencias para mejorar TERMOX?<br>
                    R/ Sí, puede contactarnos como se espeficó en la respuesta anterior.</li>
                    <li>¿Recibiré actualizaciones de software sin pagos adicionales?<br>
                    R/ Las actualizaciones no tienen cargos adicionales</li>
                    <li>¿Cuántos regentes de farmacia puedo tener registrados?<br>
                    R/ Puede registrar el número de regentes que crea conveniente.</li>
                    <li>¿Cómo puedo darme de baja del servicio TERMOX?<br>
                    R/ Puede contactarnos en los números de teléfono especificados en el apartado "Acerca de"</li>
                    <li>¿TERMOX es completamente compatible para ser utilizado en dispositivos móviles?<br>
                    R/ Hemos probado el sistema TERMOX en cierta variedad de dispositivos móviles con excelentes resultados</li>
                    <li>¿Necesito software adicional para el uso de TERMOX?<br>
                    R/ Solamente requiere un navegador web, de preferencia Chrome o Firefox en sus últimas versiones</li>
                    
                </ol>
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