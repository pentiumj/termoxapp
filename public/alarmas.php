<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>

<?php 
    
    require_once "../controlador/alarmasC.php";
?>

<?php include "./plantilla/metas.php"; ?>
           
        <title>CONFIGURACIÓN ALARMAS - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
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
                <div class="ubi">Configuraciones >> Alarmas</div>
                <div class="titulo1">Configurar alarmas</div></br>
                <h3>Establezca los valores máximos</h3>
                <form method="POST">
                    <label for="temperatura">Temperatura</label>
                    <select name="temperatura" id="temperatura">   
                        <?php for($i=30;$i<=50;$i++){ ?>        
                        <option value="<?= $i; ?>" <?php if($datos[0][1] == $i) echo "selected"; ?>><?= $i; ?></option>
                        <?php } ?>
                    </select><br /><br />
                    <label for="humedad">Humedad</label>
                    <select name="humedad" id="humedad">  
                        <?php for($i=70;$i<100;$i++){ ?>        
                        <option value="<?= $i; ?>" <?php if($datos[0][2] == $i) echo "selected"; ?> ><?= $i; ?></option>
                        <?php } ?>
                    </select>
                    <hr>
                    <h3>Establezca los valores mínimos</h3>
                    <label for="humedad">Humedad</label>
                    <select name="humedadMin" id="humedadMin">  
                        <?php for($i=10;$i<=50;$i++){ ?>        
                        <option value="<?= $i; ?>" <?php if($datos[0][3] == $i) echo "selected"; ?> ><?= $i; ?></option>
                        <?php } ?>
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