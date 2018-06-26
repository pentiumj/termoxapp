<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>
<?php 

require_once "../controlador/listarUsuarios.php"; 
require_once "../controlador/listarFarmaciasC.php"; 
?>


<?php include "./plantilla/metas.php"; ?>
           
        <title>ADMINISTRADORES DE FARMACIA - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
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
                    cedula = obs.data("c");
                    nombre = obs.data("n");
                    apellido = obs.data("a");
                    email = obs.data("e");
                    farmacia = obs.data("f");
                    idUsuario = obs.data("i");
                    
                    $.ajax({
                        data:  'cedula='+cedula+'&nombre='+nombre+'&apellido='+apellido+'&email='+email+'&farmacia='+farmacia+'&idUsuario='+idUsuario,
                        url:   'modificarAdministrador.php',
                        type:  'post',

                        success:  function (response) {
                                $("#agregarForm").html(response);

                                
                        }
                    }); 
                            
                });
                
                $(".leliminar").click(function(){
                    
                    $("#eliminarForm").show();
                    
                    obs = $(this);
                    cedula = obs.data("c");
                    
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
                                        data:  'cedula='+cedula,
                                        url:   '../controlador/eliminarRegenteC.php',
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

              
            
            <br>
            
            <div id="contenedorInf">
                
                <div class="ubi">Administradores >> Listar</div>
                
                <div id="listar">
                    
                    <div class="titulo1">Administradores de farmacias</div></br>
                    <input id="filter" type="text" size="35" style="width: 200px !important; height: 30px; padding:5px;float:left; margin-right:10px" placeholder="Buscar"> 
                    <input class="bus" type="button" value="Buscar" style="width: 100px !important; height: 30px; padding:5px;">
                    
                    <!--<div style="margin-top:-20px "><small><a href="#">Búsqueda avanzada</a></small></div><br>   -->
                    <table class="footable" data-filter-minimum="5" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
                        <thead>
                            <tr>
                                <th data-type="numeric">#</th>
                                <th data-sort-ignore="true">Cedula</th>
                                <th data-hide="phone" >Nombre</th>
                                <th data-hide="phone">Apellido</th>
                                <th data-sort-ignore="true" data-hide="phone, medio">Email</th>
                                <th data-sort-ignore="true" data-hide="phone, medio">Farmacia</th>
                                <th data-sort-ignore="true" colspan="2" data-hide="phone, medio">Op</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php $i=0;
                          $admins = listarAdmin();

                          foreach($admins as $fila): 
                          $farmacia = listarFarmaciaUsuario($fila['idFarmacia']);
                    ?>

                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td><?php echo $fila['cedula']; ?></td>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['apellido']; ?></td>
                                <td><?php echo $fila['email']; ?></td>
                                <td><?php echo $farmacia[0]['nombre']; ?></td>
                                <td><a data-c="<?php echo $fila['cedula']; ?>" data-n="<?php echo $fila['nombre']; ?>" data-a="<?php echo $fila['apellido']; ?>" data-e="<?php echo $fila['email']; ?>" data-f="<?php echo $farmacia[0]['idFarmacia']; ?>" data-i="<?php echo $fila['idUsuario']; ?>" class="leditar" href="#"><img src="img/editar.png" width="15" height="15" title="Editar"></a></td>
                                <td><a data-c="<?php echo $fila['cedula']; ?>" data-n="<?php echo $fila['nombre']; ?>" data-a="<?php echo $fila['apellido']; ?>" data-e="<?php echo $fila['email']; ?>" class="leliminar" href="#"><img src="img/eliminar.png" width="15" height="15" title="Eliminar"></a></td>
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