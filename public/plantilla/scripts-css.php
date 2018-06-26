<?php 
$sCedula=$_SESSION["cedula"];
require_once '../controlador/verDatosUsuarioC.php';
$datosUsuario = verDatosUsuario($sCedula);?>
<script>
function caducarSession(){
    setTimeout("window.open('salir.php','_top');",<?=$datosUsuario["sesion"]?>);
}
</script>
<?php
if($datosUsuario["sesion"]!=0){
    echo "<script> window.onload = caducarSession(); </script>";
    ?>
<?php
}   
?>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/menu.js"></script>
<script src="js/jquery.validate.js"></script>
<script>
(function(a){a.fn.validCampo=function(b){a(this).on({keypress:function(a){var c=a.which,d=a.keyCode,e=String.fromCharCode(c).toLowerCase(),f=b;(-1!=f.indexOf(e)||9==d||37!=c&&37==d||39==d&&39!=c||8==d||46==d&&46!=c)&&161!=c||a.preventDefault()}})}})(jQuery);
</script>

<link href="./css/menu.css" rel="stylesheet" type="text/css" />
<link href="./css/principal.css" rel="stylesheet" type="text/css" />