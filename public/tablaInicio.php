<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>

<?php require_once 'fechasTabla.php';?>
<?php include "./plantilla/tablas.php"; ?>
<script src="js/graficasTHInicio.js"></script>

<br>

<?php  
if($datos == 1){ 
    
    $grados = "°C";
    if(isset($_SESSION['escala'])){
           if($_SESSION['escala']=='f'){
               $grados = "°F";
           }
    }
 ?>
<div class="div-bot">
    
    <button class="btn-graf" id="btn-vEsta">Ver Estadisticas</button>
    <button class="btn-graf" id="btn-oEsta">Ocultar Estadisticas</button>
    
    
</div>
<div id="estadisticas"> 
    
    <table class="footable table" data-filter-minimum="3" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
        <thead>
            <tr>
                
                <th data-sort-ignore="true">Valores Estadisticos</th>
                <th data-hide="phone" >Temperatura (<?=$grados?>)</th>
                <th data-hide="phone">Humedad (%)</th>


            </tr>
        </thead>

        <tbody>
            <tr>
                <td >Promedio <span data-info="El promedio se obtiene al dividir la suma de varias cantidades por el número de sumandos" class="tooltip">(?)</span></td>
                    <td ><?=$promTemp;?></td>
                    <td><?=$promHume;?></td>
            </tr>
            <tr>
                <td >Promedio Mañana (9am-10am) <span data-info="Se promedian los datos capturados en las horas de 9 a 10 de la mañana." class="tooltip">(?)</span></td>
                <?php
                if($manana==2){?>
                    <td><?="No se registraron datos a esas horas";?></td>
                    <td><?="No se registraron datos a esas horas";?></td>
                <?php    
                }else{
                    foreach ($manana as $fila):?>
                        
                        <td><?=$fila;?></td>
                <?php
                    endforeach;
                }
                ?>
                
            </tr>
            <tr>
                <td >Promedio Tarde (1pm-2pm) <span data-info="Se promedian los datos capturados en las horas de 1 a 2 de la tarde." class="tooltip">(?)</span></td>
                <?php
                if($tarde==2){?>
                    <td><?="No se registraron datos a esas horas";?></td>
                    <td><?="No se registraron datos a esas horas";?></td>
                <?php    
                }else{
                    foreach ($tarde as $fila):?>
                        
                        <td><?=$fila;?></td>
                <?php
                    endforeach;
                }
                ?>
                
            </tr>
            <tr>
                <td>Rango <span data-info="El rango es el intervalo de datos establecido por su dato menor y mayor respectivamente " class="tooltip"> (?)</span></td>
                <td><?="(".join(" - ",$rangoTemp).")";?></td>
                <td><?="(".join(" - ",$rangoHume).")";?></td>
            </tr>
            <tr>
                <td>Moda <span  data-info="La moda hace referencia al dato que mas se repite " class="tooltip"> (?)</span></td>
                <td><?php if($modaTemp!=="No hay moda"){ print (join($grados." - ",$modaTemp).$grados);}else{print($modaTemp);};?></td>
                <td><?php if($modaHume!=="No hay moda"){ print (join(" - ",$modaHume));}else{print($modaHume);};?></td>
            </tr>
            <tr>
                <td>Varianza <span data-info="La varianza es la media de las diferencias elevadas al cuadrado(desviación estandar al cuadrado)" class="tooltip"> (?)</span></td>
                <td><?=$variTemp;?></td>
                 <td><?=$variHume;?></td>
            </tr>
            <tr>
                <td>Desviación Estandar <span data-info="La desviacion estandar mide la dispersión de los datos" class="tooltip"> (?)</span></td>
                <td><?=$desvTemp;?></td>
                <td><?=$desvHume;?></td>
            </tr>
            <tfoot class="pie-tabla">

                <tr>
                    <td colspan="23">
                            <div data-page-navigation=".pagination" class="pagination pagination-centered hide-if-no-paging"></div>
                    </td>
                </tr>

            </tfoot>
        </tbody>
    </table><br><br>
</div>
<div id="divcontent">
    <div class="titulo1">Datos de hoy</div></br>
    <table class="footable table" data-filter-minimum="3" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
        <thead>
            <tr>
                <th  data-type="numeric">#</th>
                <th data-sort-ignore="true">Hora</th>
                <th data-hide="phone" >Temperatura (<?=$grados?>)</th>
                <th data-hide="phone">Humedad (%)</th>


            </tr>
        </thead>

        <tbody>
            <?php $i=0;
            foreach ($arrayDatos as $fila ) : 
                  $temp = str_replace(".0", " ", $fila['promedioTemp']);
                  $hume = str_replace(".0", " ", $fila['promedioHume']);
            ?>

            <tr>
                <td><?=++$i;?></td>
                <td><?php echo substr($fila['fechaF'], 11, 16); ?></td>
                <td><?php echo $temp; ?></td>
                <td><?php echo $hume; ?></td>                            

            </tr>   

        <?php endforeach;?>

            <tfoot class="pie-tabla">

                <tr>
                    <td colspan="23">
                            <div data-page-navigation=".pagination" class="pagination pagination-centered hide-if-no-paging"></div>
                    </td>
                </tr>

            </tfoot>
        </tbody>
    </table>
</div>




<?php
}else{
    print "</br><font color='red'>No hay datos en esas fechas</font>";
    ?>
<script>
    $('#btn-rep').hide();
</script>
    
<?php
}
?>

<?php 

} else{
    
    echo "Usted no tiene acceso a esta zona";
    
} 
?>