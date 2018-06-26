<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>
<?php
require_once "../controlador/guardarExcelC.php"; 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Termox</title>
        <link href="css/style.css" rel="stylesheet"> 
        <?php include "./plantilla/cabecera.php"; ?>
    </head>
    <?php
    if(isset($_GET['id'])){
        
        $idFarmacia = $_GET['id'];
        cargarExcel($idFarmacia);
        //guardarDatos(20, 70, "2016-02-02 00:00:00", $idFarmacia);
    }
    ?>
    <body>
        <form method="GET" action="cargarExcel.php">
            <input type="hidden" name="id" value="<?=$infoUsuario["idFarm"]?>"/>
            <input type="submit" value="Cargar Excel"/>
        </form>
    </body>
</html>
<?php
}else{
    
    echo "Usted no tiene acceso a esta zona";
    
} 
