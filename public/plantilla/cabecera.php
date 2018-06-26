<?php 
$sesion=$_SESSION["cedula"];

require_once '../controlador/verDatosUsuarioC.php';
$infoUsuario = verDatosUsuario($sesion);
$infoUsuarioA = verDatosUsuarioAdmin($sesion);
if(count($infoUsuario) != 0){
?>

<div id="cabecera">
    <div id="identificacion">
        <span class="info-usuario"><img title="Usuario" src="./img/usuario.png" width="30" height="30">
            Bienvenido <?=$infoUsuario["nombreU"]." ".$infoUsuario["apellido"]?></span>
        <?php if($infoUsuario["tipoUsuario"] != 1){?>
        <span class="info-usuario"><img title="Farmacia" src="./img/farmacia.png" width="30" height="30">
            &nbsp;Farmacia <?=$infoUsuario["farmacia"]?>
        </span>
        <?php } else {?>
        <span class="info-usuario"><img title="Farmacia" src="./img/farmacia.png" width="30" height="30">
            &nbsp;Administrador del sistema
        </span>     
        <?php } ?>
    </div>
    <a href="index.php" id="imgCabecera" title="Sistema de control termohigrométrico para farmacias"></a>
    
    <h3>Sistema de control termohigrométrico para farmacias</h3>
</div>  

<?php 
}else{
?>
<div id="cabecera">
    <div id="identificacion">
        <span class="info-usuario"><img title="Usuario" src="./img/usuario.png" width="30" height="30">
            Bienvenido <?=$infoUsuarioA["nombreU"]." ".$infoUsuarioA["apellido"]?></span>
        <?php if($infoUsuarioA["tipoUsuario"] != 1){?>
        <span class="info-usuario"><img title="Farmacia" src="./img/farmacia.png" width="30" height="30">
            &nbsp;Farmacia <?=$infoUsuarioA["farmacia"]?>
        </span>
        <?php } else {?>
        <span class="info-usuario"><img title="Farmacia" src="./img/farmacia.png" width="30" height="30">
            &nbsp;Administrador del sistema
        </span>     
        <?php } ?>
    </div>
    <a href="index.php" id="imgCabecera" title="Sistema de control termohigrométrico para farmacias"></a>
    
    <h3>Sistema de control termohigrométrico para farmacias</h3>
</div>
<?php } ?>
