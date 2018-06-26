<?php
 //require_once './PHPExcel/Classes/PHPExcel.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Termox</title>
        <link href="css/style.css" rel="stylesheet">        
    </head>
    <body>
<?php

  
if (file_exists("../docs/datos5.xls")) {
    require_once 'libs/PHPExcel/Classes/PHPExcel.php';
    require_once 'libs/PHPExcel/Classes/PHPExcel/Reader/Excel5.php';
    require_once 'libs/PHPExcel/Classes/PHPExcel/IOFactory.php';
    //$objReader = new PHPExcel_Reader_Excel5();
    $archivo = "../docs/datos5.xls";
    $inputFileType = PHPExcel_IOFactory::identify($archivo);
    //$objReader = PHPExcel_IOFactory::createReader($inputFileType);
    
    //$objPHPExcel = $objReader->load("../docs/datos5.xls");
    $objPHPExcel = PHPExcel_IOFactory::load($archivo);
    
    //$objPHPExcel = PHPExcel_IOFactory::load($archivo);
    /*
    $objPHPExcel->setActiveSheetIndex(0);    
    foreach ($objPHPExcel->getWorksheetIterator() as $hoja) {
        $filas = $hoja->getHighestRow(); 
    } 
    $con = mysql_connect("localhost", "root", "") or die("ERROR EN LA CONEXION");
    $db = mysql_select_db("termox", $con) or die("ERROR AL CONECTAR A LA BD");

    for ($i = 12; $i <= $filas; $i++) {
        $_DATOS_EXCEL[$i]['temperatura'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getValue();  
        $_DATOS_EXCEL[$i]['temperatura']= substr($_DATOS_EXCEL[$i]['temperatura'], 0, 8); 
        $_DATOS_EXCEL[$i]['humedad'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getValue();
        $_DATOS_EXCEL[$i]['humedad']= substr($_DATOS_EXCEL[$i]['humedad'], 0, 8);
        $_DATOS_EXCEL[$i]['fecha'] = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getValue();
        $_DATOS_EXCEL[$i]['fecha'] = trim(str_replace('/', '-', $_DATOS_EXCEL[$i]['fecha']));
        $mes[$i]['fecha'] = substr($_DATOS_EXCEL[$i]['fecha'],0, 2);       
        $dia[$i]['fecha'] = substr($_DATOS_EXCEL[$i]['fecha'],3, 2);
        $año[$i]['fecha'] = substr($_DATOS_EXCEL[$i]['fecha'],6, 2);
        $_DATOS_EXCEL[$i]['fecha'] = substr_replace($_DATOS_EXCEL[$i]['fecha'], $año[$i]['fecha'], 0, 2);
        $_DATOS_EXCEL[$i]['fecha'] = substr_replace($_DATOS_EXCEL[$i]['fecha'], $mes[$i]['fecha'], 3, 2);
        $_DATOS_EXCEL[$i]['fecha'] = substr_replace($_DATOS_EXCEL[$i]['fecha'], $dia[$i]['fecha'], 6, 2);
    }
     * 
     *
     */
    
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    
    $nrColumns = ord($highestColumn) - 64;
    echo "<br>The worksheet ".$worksheetTitle." has ";
    echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
    echo ' and ' . $highestRow . ' row.';
    echo '<br>Data: <table border="1"><tr>';
    for ($row = 1; $row <= $highestRow; ++ $row) {
        echo '<tr>';
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}
}
else {
    echo "No existe el archivo de excel";
}
/*
foreach ($_DATOS_EXCEL as $campo => $valor) {
    $sql = "INSERT INTO datos VALUES ('','";
    foreach ($valor as $campo2 => $valor2) {
        $campo2 == "fecha" ? $sql.='20'.$valor2."',1);" : $sql.=$valor2. "','";
    }
    echo $sql;?><br><?php
 
    //$result = mysql_query($sql);
}*/
/*
$objPHPExcel = PHPExcel_IOFactory::load("datos.xls");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('prueba.xlsx');

/*
//$objPHPExcel = new PHPExcel();
require_once './PHPExcel/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("datos3.xlsx");
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;

    echo '<br>Datos: <table border="1"><tr>';
    for ($row = 1; $row <= $highestRow; ++ $row) {
        echo '<tr>';
        for ($col = 0; $col < $highestColumnIndex-2; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col+1, $row);
            $val = $cell->getValue();
            
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            if($val!=''){
                
                $val2 = substr($val, 0, 8);
                echo '<td>' . $val2 . '</td>';
            }
        }
         for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col+4, $row);
            $val = $cell->getValue();
            
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            if($val!=''){
               
               $val2=' TIME';
               
               if($val2 == $val){
                   echo 'son iguales';
               }
                //echo '<td>' .$val.'=='.$val2. '</td>';
                /* 
               if($val=='TIME'){
                   $val='fecha';
                    echo '<td>' . $val. '</td>';   
               }
               else{
                echo '<td>' . $val. '</td>';
               } aqui cerraba comentario
            }
        }
        echo '</tr>';
    }
    
}*/
?>


    </body>
</html>
