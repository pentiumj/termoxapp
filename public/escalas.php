<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>

<?php 
    
    require_once "../controlador/escalasC.php";
?>

<?php include "./plantilla/metas.php"; ?>
           
        <title>CONFIGURACIÓN ESCALAS - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        <script src="js/ajaxAsincrono.js"></script>        
        <link href="css/principal.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="contenedor">
                       
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

                      
            <div id="contenedorSup">
                <div id="asincronos"></div>
            </div>            
                 
            
            <br>
            
            <?php  $ver = (isset($_SESSION['escala']))? $_SESSION['escala']:""; ?>
            
            <div id="contenedorInf">
                <div class="ubi">Configuraciones >> Escalas</div>
                <div class="titulo1">Configurar escala</div></br>
                <form method="POST">
                    <label for="escalas">Escala de temperatura:</label>
                    <select id="escala" name="escala">
                        <option value="c" <?php if($ver=="c") echo "selected"; ?>>Celsius</option> 
                        <option value="f" <?php if($ver=="f") echo "selected"; ?>>Fahrenheit</option>
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