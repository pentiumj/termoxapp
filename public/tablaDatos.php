<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>
<?php 

require_once "../controlador/mDatosC.php"; 
?>


<?php include "./plantilla/metas.php"; ?>
           
        <title>DATOS GENERALES - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        
        <link href="css/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.date.css" rel="stylesheet" type="text/css" />
        <script src="libs/pickadate/lib/picker.js"></script>
        <script src="libs/pickadate/lib/picker.date.js"></script>
        
        <script src="libs/amcharts/amcharts.js"></script>
        <script src="libs/amcharts/serial.js"></script>
        <script src="libs/amcharts/themes/light.js"></script>
        
        <script src="js/fechas.js"></script>
        <script src="js/sel-fecha.js"></script>
        <script src="js/moment.min.js"></script>
        <script src="js/jquery.daterangepicker.js"></script>
        <script src="js/ajaxAsincrono.js"></script>
        <script src="js/tablaDatos.js"></script>
        
    </head>
    <body onload="document.frmFecha.selPeriodo.focus()">
        <div id="contenedor">
             
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

                
            <div id="contenedorSup">
                <div id="asincronos"></div>
                
            </div>            
                  
            
            <br>
         <div id="contenedorInf">      
            <div class="ubi">Datos >> Generales</div>
            <div id="calendario">
                <form id="frmFecha" name="frmFecha" method="POST" action="graficasExcel.php">
                    <label>Periodo: </label>
                    <select id="sel-periodo" name="selPeriodo">
                        <option value="0">Personalizado</option>
                        <option value="1">Hoy</option>
                        <option value="2">Ayer</option>
                        <option value="3">La semana pasada</option>
                        <option value="4">El mes pasado</option>
                        <option value="5">Ultimos 30 dias</option>
                        <option value="6">Ultimos 7 dias</option>
                    </select>                
                        
                    &nbsp;&nbsp;Desde&nbsp;&nbsp;<span id="two-inputs"><input id="inicio" name="inicio" size="20" value="" placeholder="Fecha Inicio">&nbsp;hasta&nbsp; <input id="fin" name="fin" size="20" value="" placeholder="Fecha Fin"></span>
                    <span id="two-inputs2"><input id="inicio2" name="inicio2" size="20" value="" placeholder="Fecha Inicio">&nbsp;hasta&nbsp; <input id="fin2" name="fin2" size="20" value="" placeholder="Fecha Fin"></span>
                <input id="btn-rep" name="btn-rep" type="submit" title="Reporte Excel" value="Generar Reporte"/>
                </form>
            </div>
            
            
            <div id="div-tabla"></div>
            
            
                
      
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