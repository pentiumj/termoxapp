<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>

<?php 

require_once "../controlador/mDatosC.php"; 
require_once "../controlador/listarFarmaciasC.php"; 
require_once '../controlador/mDatosTablaC.php';
?>

<?php include "./plantilla/metas.php"; ?>
           
        <title>INICIO - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        
        <link href="css/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.css" rel="stylesheet" type="text/css" />
        <link href="libs/pickadate/lib/themes/classic.date.css" rel="stylesheet" type="text/css" />
        
        <script src="libs/amcharts/amcharts.js"></script>
        <script src="libs/amcharts/serial.js"></script>
        <script src="libs/amcharts/themes/light.js"></script>
        
        
        <script src="js/ajaxAsincrono.js"></script> 
        <script src="js/datosInicio.js"></script> 
        <?php include "./plantilla/tablas.php"; ?>
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
            
            <br>
        <div id="contenedorInf">  
            
            <?php if($_SESSION['tipo'] != 1){ ?>
            <div class="ubi">Inicio</div>
            <div id="div-tabla"></div>
            <?php }else{
                

            ?>
            <div id="estadFarmaciasAdmin">
                <div class="ubi">Inicio</div>
                <div class="titulo1">Farmacias</div></br>
                <table class="footable table" data-filter-minimum="3" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
                        <thead>
                            <tr>
                                    <th data-type="numeric">#</th>
                                    <th>Farmacia</th>
                                    <th data-hide="phone" >Estadisticas</th>



                            </tr>
                        </thead>
                        <tbody>
                         <?php $i=0;
                          $farmacias = listarFarmacias();
                          
                          foreach($farmacias as $fila): 
                          $farmacia = listarFarmaciaUsuario($fila['idFarmacia']);
                    ?>
                          
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $fila['nombre']; ?></td>
                            <td><a href="inicio.php?id=<?=$fila['idFarmacia'];?>">ver estadisticas</a></td>
                        </tr>
                                        
                        <?php endforeach;?>
                        

                        
                        </tbody>
                </table>
            </div>
            <?php
            } ?>
            <?php
        
        ?>
      
        
            <?php
            if($_GET){
                setlocale(LC_TIME,"es_CO");
                //$date=date('Y-m-d');
                //echo $date;
                $hoy = date('Y-m-d');
                $hayDatos = count(mostrarDatosTabla($hoy, $hoy, $_GET['id']));
                if($hayDatos==0){

                     $hayDatos = count(mostrarDatosTabla('2016-05-30', '2016-05-30', $_GET['id']));
                ?>
        <script>alert('No hay datos estadisticos para esta farmacia'); location = "inicio.php";</script>
                    <?php
                    }
                    ?>
                
                <script>
                $('#estadFarmaciasAdmin').hide();
                </script>
                <a href="inicio.php">Volver</a><br><br>
                <div class="titulo1">Estadisticas del dia de hoy</div></br>
                <table id="footableEst" class="footable table" data-filter-minimum="3" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
                    <thead>
                        <tr >
                            <th colspan="3">
                    <center><?php $farm=listarFarmaciaUsuario($_GET['id']); echo $farm[0]['nombre']?></center>
                            </th>
                            
                        </tr>
                        
                        <tr>

                            <th data-sort-ignore="true">Valores Estadisticos</th>
                            <th data-hide="phone" >Temperatura </th>
                            <th data-hide="phone">Humedad (%)</th>


                        </tr>
                    </thead>

                    <tbody>
                        
                    <?php 
                    
                    ?>
                        
                        <tr>
                            <td >Promedio <span data-info="El promedio se obtiene al dividir la suma de varias cantidades por el número de sumandos" class="tooltip">(?)</span></td>
                            <td><?=promedio($hoy, $hoy, 0, $_GET['id'])?></td>
                            <td><?=promedio($hoy, $hoy, 1, $_GET['id'])?></td>
                        </tr>
                        <tr>
                            <td >Promedio Mañana (9am-10am) <span data-info="Se promedian los datos capturados en las horas de 9 a 10 de la mañana." class="tooltip">(?)</span></td>
                            <td><?php $pM= mostrarPromedioManana($hoy, $hoy, $_GET['id']); echo $pM[0]?></td>
                            <td><?php echo $pM[1]?></td>

                        </tr>
                        <tr>
                            <td >Promedio Tarde (1pm-2pm) <span data-info="Se promedian los datos capturados en las horas de 1 a 2 de la tarde." class="tooltip">(?)</span></td>
                            <td><?php $pT= mostrarPromedioTarde($hoy, $hoy, $_GET['id']); echo $pT[0]?></td>
                            <td><?php echo $pT[1]?></td>

                        </tr>
                        <tr>
                            <td>Rango <span data-info="El rango es el intervalo de datos establecido por su dato menor y mayor respectivamente " class="tooltip"> (?)</span></td>
                            <td><?= "(".join(" - ",rango($hoy, $hoy, 0, $_GET['id'])).")";?></td>
                            <td><?= "(".join(" - ",rango($hoy, $hoy, 1, $_GET['id'])).")";?></td>
                        </tr>
                        <tr>
                            <td>Moda <span  data-info="La moda hace referencia al dato que mas se repite " class="tooltip"> (?)</span></td>
                            <td><?php $modaTemp = moda($hoy, $hoy, 0, $_GET['id']); 
                            if($modaTemp!=="No hay moda"){ print (join(" - ",$modaTemp));}else{print($modaTemp);};
                            ?></td>
                            <td><?php $modaHume = moda($hoy, $hoy, 1, $_GET['id']); 
                            if($modaTemp!=="No hay moda"){ print (join(" - ",$modaHume));}else{print($modaHume);};
                            ?></td>
                        </tr>
                        <tr>
                            <td>Varianza <span data-info="La varianza es la media de las diferencias elevadas al cuadrado(desviación estandar al cuadrado)" class="tooltip"> (?)</span></td>
                            <td><?=  varianza($hoy, $hoy, 0, $_GET['id'])?></td>
                             <td><?=  varianza($hoy, $hoy, 1, $_GET['id'])?></td>
                        </tr>
                        <tr>
                            <td>Desviación Estandar <span data-info="La desviacion estandar mide la dispersión de los datos" class="tooltip"> (?)</span></td>
                            <td><?=  desviacionE($hoy, $hoy, 0, $_GET['id'])?></td>
                            <td><?=  desviacionE($hoy, $hoy, 1, $_GET['id'])?></td>
                        </tr>
                        
                </tbody>
                <tfoot class="pie-tabla">
                    <tr>
                        <td colspan="23">
                                <div data-page-navigation=".pagination" class="pagination pagination-centered hide-if-no-paging"></div>
                        </td>
                    </tr>
                </tfoot>
                </table>
            <?php
            }   
            ?>
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
