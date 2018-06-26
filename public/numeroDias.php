<?php

    require_once '../controlador/iAleatoriosC.php';
    
    if( isset($_POST['numeroDias']) ){
        
        $numeroDias = $_POST['numeroDias'];
        
        insertar($numeroDias);
        
    }