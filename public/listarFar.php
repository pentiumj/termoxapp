<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>
<?php 

require_once "../controlador/listarFarmaciasC.php"; 
?>


<?php include "./plantilla/metas.php"; ?>
           
        <title>FARMACIAS - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        <?php include "./plantilla/tablas.php"; ?>
        
        
        <script src="js/jquery-ui.min.js"></script> 
        <link href="css/crud.css" rel="stylesheet" type="text/css" />
        
        <style>
    
            .ui-dialog { font-size: 12px; background-color: #FBF5F5; z-index:1000}
            .ui-dialog .ui-dialog-titlebar {font-size: 12px; background-color: #ADD8E6; border-color:#ADD8E6}
            .ui-dialog .ui-dialog-titlebar-close {display:none}

        </style>
        <script>
            
            $(document).ready(function(){
               
                $("#eliminarForm").hide();
                
                $(".leditar").click(function(){
                    
                    $("#agregarForm").dialog({

                        width: 250,
                        maxWidth: 600,
                        height: 'auto',
                        maxHeight: 500,
                        modal: true,
                        draggable: true,
                        resizable: true,
                        closeText: 'Cerrar'

                    });
                    
                    obs = $(this);
                    idFarmacia = obs.data("i");
                    nombre = obs.data("n");
                    empresa = obs.data("e");
                    direccion = obs.data("d");
                    telefono = obs.data("t");
                    email = obs.data("m");
                    
                    
                    $.ajax({
                        data:  'idFarmacia='+idFarmacia+'&nombre='+nombre+'&empresa='+empresa+'&direccion='+direccion+'&telefono='+telefono+'&email='+email,
                        url:   'modificarFarmacia.php',
                        type:  'post',

                        success:  function (response) {
                                $("#agregarForm").html(response);

                                
                        }
                    }); 
                            
                });
                
                $(".leliminar").click(function(){
                    
                    $("#eliminarForm").show();
                    
                    obs = $(this);
                    idFarmacia = obs.data("i");
                    
                    $("#eliminarForm").dialog({

                        width: 250,
                        maxWidth: 600,
                        height: 'auto',
                        maxHeight: 500,
                        modal: true,
                        draggable: true,
                        resizable: true,
                        closeText: 'Cerrar',

                        buttons: {
                            
                            'Eliminar': {
                                class: 'beliminar',
                                text: 'Eliminar',
                                
                                click: function(){
                                    
                                    $.ajax({
                                        data:  'idFarmacia='+idFarmacia,
                                        url:   '../controlador/eliminarFarmaciaC.php',
                                        type:  'post',

                                        success:  function (response) {
                                                $("#eliminarForm").html(response);


                                        }
                                    }); 
                                
                                
                                
                                 }
                            },
                            
                            'Cerrar' : function() {
                                $("#eliminarForm").hide();
                                $(this).dialog('close');
                                location.reload();
                            }
                            
                        } 

                    });
                });
            });
        </script>
        
    </head>
    <body>
        <div id="contenedor">
             
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

               
            
            
            <div id="contenedorInf">
                <div class="ubi">Farmacias >> Listar</div>
                <div id="listar">
                    
                    <div class="titulo1">Farmacias</div></br>
                    
                    <input id="filter" type="text" size="35" style="width: 200px !important; height: 30px; padding:5px;float:left; margin-right:10px" placeholder="Buscar"> 
                    <input class="bus" type="button" value="Buscar" style="width: 100px !important; height: 30px; padding:5px;">
                    <br>   
                    
                    <table class="footable table" data-filter-minimum="5" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
                        <thead>
                        <tr>
                                <th data-type="numeric">#</th>
                                <th >Nombre</th>
                                <th data-hide="phone" >Empresa</th>

                                <th data-sort-ignore="true" data-hide="phone">Dirección</th>
                                <th data-sort-ignore="true" data-hide="phone, medio">Teléfono</th>
                                <th data-sort-ignore="true" data-hide="phone, medio">Email</th>
                                <th data-sort-ignore="true" colspan="2" data-hide="phone, medio">Op</th>

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
                            <td><?php echo $fila['empresa']; ?></td>
                            <td><?php echo $fila['direccion']; ?></td>
                            <td><?php echo $fila['telefono']; ?></td>
                            <td><?php echo $fila['email']; ?></td>
                            <td><a data-i="<?php echo $fila['idFarmacia']; ?>" data-n="<?php echo $fila['nombre']; ?>" data-e="<?php echo $fila['empresa']; ?>" data-d="<?php echo $fila['direccion']; ?>" data-t="<?php echo $fila['telefono']; ?>" data-m="<?php echo $fila['email']; ?>" class="leditar" href="#"><img title="Editar" src="img/editar.png" width="15" height="15"></a></td>
                            <td><a data-i="<?php echo $fila['idFarmacia']; ?>" class="leliminar" href="#"><img title="Eliminar" src="img/eliminar.png" width="15" height="15"></a></td>
                        </tr>
                                        
                    <?php endforeach;?>
                                
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
                    
                    
                </div>
                <div id="agregarForm"></div>
                <div id="eliminarForm">¿Está seguro que desea eliminar este registro?</div>
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