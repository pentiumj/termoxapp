<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>
<?php 
require_once '../controlador/verDatosAlarmasC.php';
require_once "../controlador/alarmasC.php";

?>

<?php include "./plantilla/metas.php"; ?>
           
        <title>DATOS ALARMAS - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        <?php include "./plantilla/tablas.php"; ?>
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
                       
            
            <div id="contenedorInf">
                <?php 
                if($_SESSION['tipo']==3){?>
                <div class="ubi">Alarmas</div>
                <?php }else{?>
                <div class="ubi">Datos >> Alarmas</div>
                <?php }?>
                <div class="titulo1">Tabla de ocurrencia de alarmas</div></br>
                
                <table class="footable table" data-filter-minimum="3" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
                    <thead>
                        <tr>
                            <th data-sort-ignore="true" data-type="numeric">#</th>
                            <th >Fecha y Hora (a-m-d)</th>
                            <th data-hide="phone" >Temperatura (°C)</th>
                            <th data-hide="phone">Humedad (%)</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $i=0;
                        
                        foreach ($listarAlarmas as $fila ) : 
                            
                            $fecha = new DateTime($fila['fecha']);
                        
                            //Mostrar eventos solo cada hora
                            if ( $i == 0) {
                                $fecha2 = new DateTime($fila['fecha']);
                                $fecha2->modify("+1 hours");
                                
                            }                            
                            //echo $fecha->format("Y-m-d H:i:s") . " <=" . $fecha2->format("Y-m-d H:i:s") . "<br>";
                                                 
                            if( $fecha <= $fecha2 ){
                                
                                $fecha2 = new DateTime($fila['fecha']);
                                $fecha2->modify("-1 hours");
                            

                        ?>

                        <tr>
                            <td><?=++$i;?></td>
                            <td><?php 
                                echo formatoFecha($fecha->format("Y-m-d "));
                                echo $fecha->format(" h:i A"); 
                            
                            ?></td>
                            <td><?php 
                            if($fila['temperatura']>=$datos[0][1]){
                                echo "<font color='red'>".$fila['temperatura']."</font";                                
                            }else{
                                echo $fila['temperatura'];
                            } 
                            ?></td>
                            <td><?php 
                            if($fila['humedad']>=$datos[0][2] || $fila['humedad']<=$datos[0][3]){
                                echo "<font color='red'>".$fila['humedad']."</font";                                
                            }else{
                                echo $fila['humedad'];
                            }
                            ?></td>
                        </tr>   

                            <?php } endforeach;?>
                        Se han encontrado <?=$i;?> registros<br><br>
                        <tfoot class="pie-tabla">

                            <tr>
                                <td colspan="23">
                                        <div data-page-navigation=".pagination" class="pagination pagination-centered hide-if-no-paging"></div>
                                </td>
                            </tr>

                        </tfoot>
                    </tbody>
                </table>
                
                <form id="frmFecha" name="frmFecha" method="POST" action="reporteAlarmas.php">
                    <input type="hidden" name="idFarmacia" id="idFarmacia" value="<?=$idFarmacia?>"/>                    
                    <input id="btn-rep" name="btn-rep" type="submit" title="Reporte Excel" value="Generar Reporte"/>
                </form>
                
            </div>
            <?php
            if($i== 0){
                ?>
            <script>$("#btn-rep").hide();</script>
            <?php
            }
            ?>

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


