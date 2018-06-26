<?php session_start(); ?>
<?php if(isset($_SESSION["cedula"])){ ?>

<?php 

require_once '../controlador/agregarRegenteC.php';
require_once '../controlador/listarUsuarios.php';
?>

<?php include "./plantilla/metas.php"; ?>
           
        <title>GESTIÓN REGENTES - TERMOX - SISTEMA DE CONTROL TERMOHIGROMÉTRICO PARA FARMACIAS</title>
        
        <?php include "./plantilla/scripts-css.php"; ?>
        <?php include "./plantilla/tablas.php"; ?>
        <script src="js/ajaxAsincrono.js"></script> 
        <script src="js/crud.js"></script>
        <script src="js/jquery-ui.min.js"></script> 
        <script>
            
            $(document).ready(function(){
                $('#cedula').validCampo('0123456789'); 
                $('#nombre').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
                $('#apellido').validCampo(' abcdefghijklmnñopqrstuvwxyzáéíóú');
                
                $('#llistar').click(function(){
                    $('#ubic').html("Gestión >> Regentes >> Listar");
                });
                
                $('#lagregar').click(function(){
                    $('#ubic').html("Gestión >> Regentes >> Agregar");
                });
                
                $("#form-agre-reg").validate({
                    rules: {
                        cedula:{
                            minlength: 5,
                            maxlength: 10
                        },
                        nombre:{
                            maxlength: 20
                        },
                        apellido:{
                            maxlength: 20
                        },
                        email :{
                            maxlength: 45
                        },
                        contrasena :{
                            minlength: 5,
                            maxlength: 25
                        }                          
                    }
                });
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
                    
                    $.ajax({
                        data:  'cedula='+cedula+'&nombre='+nombre+'&apellido='+apellido+'&email='+email,
                        url:   'modificarRegente.php',
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
        
        <link href="css/crud.css" rel="stylesheet" type="text/css" />
       
        <style>
    
            .ui-dialog { font-size: 12px; background-color: #FBF5F5; z-index:1000}
            .ui-dialog .ui-dialog-titlebar {font-size: 12px; background-color: #ADD8E6; border-color:#ADD8E6}
            .ui-dialog .ui-dialog-titlebar-close {display:none}

        </style>
    </head>
    <body onload="document.formAgreReg.cedula.focus()">
        <div id="contenedor">
                       
            <?php include "./plantilla/cabecera.php"; ?>
            <?php include "./plantilla/menu.php"; ?>

                  
            <div id="contenedorSup">
                <div id="asincronos"></div>
            </div>            
                 
            
            <br>
            
            <div id="contenedorInf">   
                <div class="ubi" id="ubic">Gestión >> Regentes >> Agregar</div>
                <div class="titulo1">Regentes de Farmacia</div></br>
                <div id="linksCrud">
                <a id="lagregar" href="#">Agregar</a> <a id="llistar" href="#">Listar</a>
                
                </div>
                
                <div id="agregar">
                    
                    <h2>Registrar regente</h2>
                    
                    <form method="POST" id="form-agre-reg" name="formAgreReg">
                        
                        <input type="text" name="cedula" id="cedula" placeholder="Cédula" required>
                        <input tupe="text" name="nombre" id="nombre" placeholder="Nombre" required>
                        <input type="text" name="apellido" id="apellido" placeholder="Apellido" required>
                        <input type="email" name="email" id="email" placeholder="Email" required>
                        <input type="password" name="contrasena" id="password" placeholder="Contraseña (5-25 caracteres) " required><br>
                        <button>Agregar</button>
                        
                    </form>
                    
                </div>
                <div id="listar">
                    
                    <input id="filter" type="text" size="35" style="width: 200px !important; height: 30px; padding:5px;float:left; margin-right:10px" placeholder="Buscar"> 
                    <input class="bus" type="button" value="Buscar" style="width: 100px !important; height: 30px; padding:5px;">
                    
                    Se han encontrado <?=count(listarRegentes());?> registros<br><br>
                    <table class="footable table" data-filter-minimum="5" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
                        <thead>
                            <tr>
                                <th data-type="numeric">#</th>
                                <th data-sort-ignore="true">Cedula</th>
                                <th data-hide="phone" >Nombre</th>
                                <th data-hide="phone">Apellido</th>
                                <th data-sort-ignore="true" data-hide="phone, medio">Email</th>
                                
                                <th data-sort-ignore="true" colspan="2" data-hide="phone, medio">Op</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php $i=0;
                          $regentes = listarRegentes();
                          foreach($regentes as $fila): ?>
                          
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $fila['cedula']; ?></td>
                            <td><?php echo $fila['nombre']; ?></td>
                            <td><?php echo $fila['apellido']; ?></td>
                            <td><?php echo $fila['email']; ?></td>
                            <td><a data-c="<?php echo $fila['cedula']; ?>" data-n="<?php echo $fila['nombre']; ?>" data-a="<?php echo $fila['apellido']; ?>" data-e="<?php echo $fila['email']; ?>" class="leditar" href="#"><img title="Editar" src="img/editar.png" width="15" height="15"></a></td>
                            <td><a data-c="<?php echo $fila['cedula']; ?>" data-n="<?php echo $fila['nombre']; ?>" data-a="<?php echo $fila['apellido']; ?>" data-e="<?php echo $fila['email']; ?>" class="leliminar" href="#"><img title="Eliminar" src="img/eliminar.png" width="15" height="15"></a></td>
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
                    <form id="frmFecha" name="frmFecha" method="POST" action="reporteRegentes.php">
                        <input type="hidden" name="idFarmacia" id="idFarmacia" value="<?=$idFarmacia?>"/>                    
                        <input id="btn-rep" name="btn-rep" type="submit" title="Reporte Excel" value="Generar Reporte"/>
                    </form>
                </div>
        
                <div id="agregarForm"></div>
                <div id="eliminarForm">¿Está seguro que desea eliminar este registro?</div>
            </div>
            <?php
            if(count(listarRegentes())== 0){
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