<?php
require_once '../modelo/alarmasModelo.php';
$idFarmacia = $_SESSION['idFarmacia'];

$alarmasModelo = new alarmasModelo();

$listarAlarmas = $alarmasModelo->listarAlarmas($idFarmacia);

function formatoFecha($valor){    
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $fecha=$valor;
    $ano=substr($fecha,0,4); 
    $mes=substr($fecha,5,2);
    if(substr($mes, 0,1)=='0')substr($mes, 1,1);
    $dia=substr($fecha,8,2); 
    $fecha=$dia."-".$meses[$mes-1]."-".$ano;
    return $fecha;    
}