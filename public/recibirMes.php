<?php

require_once '../controlador/mGraficosC.php';
    
    if( isset($_POST['meses']) ){
        
       $mes = $_POST['meses'];
       
       $resultadoDias = mostrarDias($mes);
       $totalArray = mostrarDatos($mes);
        
    }

