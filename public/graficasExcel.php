<?php
session_start();
include_once 'libs/PHPExcel/Classes/PHPExcel.php';
include_once 'libs/PHPExcel/Classes/PHPExcel/Chart.php';
require_once 'libs/PHPExcel/Classes/PHPExcel/Worksheet/Drawing.php';
require_once '../controlador/mDatosTablaC.php';

$grados = "°C";
    if(isset($_SESSION['escala'])){
           if($_SESSION['escala']=='f'){
               $grados = "°F";
           }
    }
$idFarmacia = $_SESSION['idFarmacia'];
if( (isset($_POST['inicio'])) && (isset($_POST['fin']))){
    
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];
    $manana = mostrarPromedioManana($inicio, $fin, $idFarmacia);
    $tarde = mostrarPromedioTarde($inicio, $fin, $idFarmacia);
    $arrayDatos = mostrarDatosTabla($inicio, $fin, $idFarmacia);
    $promTemp = promedio($inicio, $fin, 0, $idFarmacia);
    $promHume = promedio($inicio, $fin, 1, $idFarmacia);
    $rangoTemp = rango($inicio, $fin, 0, $idFarmacia);
    $rangoHume = rango($inicio, $fin, 1, $idFarmacia);
    $modaTemp = moda($inicio, $fin, 0, $idFarmacia);
    
    $modaHume = moda($inicio, $fin, 1, $idFarmacia);
    if($modaTemp=="No hay moda" || $modaHume=="No hay moda"){ 
        $modaTemp = array();
        $modaHume = array();
        $modaTemp [] = 0;
        $modaHume [] = 0;
    }
    $variTemp = varianza($inicio, $fin, 0, $idFarmacia);
    $variHume = varianza($inicio, $fin, 1, $idFarmacia);
    $desvTemp = desviacionE($inicio, $fin, 0, $idFarmacia);
    $desvHume = desviacionE($inicio, $fin, 1, $idFarmacia);
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()
            ->setCreator("Termox")
            ->setLastModifiedBy("Termox")
            ->setTitle("Exportar datos TH")
            ->setSubject("Datos TH")
            ->setDescription("Datos de temperatura y humedad en excel")
            ->setKeywords("Datos temperatura humedad excel")
            ->setCategory("reportes ");
    
        $objPHPExcel->setActiveSheetIndex(0)
                       ->mergeCells('A4:C4');
    
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A4', 'Reporte de TH por sistema TERMOX')
                    ->setCellValue('A5', 'Temperatura '.$grados)
                    ->setCellValue('B5', 'Humedad %')
                    ->setCellValue('C5', 'Fecha');
        
        $objPHPExcel->setActiveSheetIndex(0)
                       ->mergeCells('E4:G4');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('E4', 'Estadisticas por sistema TERMOX')
                    ->setCellValue('E5', 'Valores Estadisticos')
                    ->setCellValue('F5', 'Temperatura '.$grados)
                    ->setCellValue('G5', 'Humedad %')
                    ->setCellValue('E6', 'Promedio')
                    ->setCellValue('E7', 'Promedio Mañana (9am-10am')
                    ->setCellValue('E8', 'Promedio Tarde (1pm-2pm)')
                    ->setCellValue('E9', 'Rango')
                    ->setCellValue('E10', 'Moda')
                    ->setCellValue('E11', 'Varianza')
                    ->setCellValue('E12', 'Desviación Estandar');
        
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('F6', $promTemp)
                    ->setCellValue('G6', $promHume)
                    ->setCellValue('F7', $manana[0])
                    ->setCellValue('G7', $manana[1])
                    ->setCellValue('F8', $tarde[0])
                    ->setCellValue('G8', $tarde[1])
                    ->setCellValue('F9', "(".join(" - ",$rangoTemp).")")
                    ->setCellValue('G9', "(".join(" - ",$rangoHume).")")
                    ->setCellValue('F10', join(" - ",$modaTemp))
                    ->setCellValue('G10', join(" - ",$modaHume))
                    ->setCellValue('F11', $variTemp)
                    ->setCellValue('G11', $variTemp)
                    ->setCellValue('F12', $desvTemp)
                    ->setCellValue('G12', $desvHume);
    if($arrayDatos!= 0){
        $i=6;
        foreach ($arrayDatos as $fila ) : 
          
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$i, $fila['promedioTemp']);
           
            $objPHPExcel->setActiveSheetIndex(0)                                
                        ->setCellValue('B'.$i, $fila['promedioHume']);
            
            if(substr($fila['fechaF'], 3, 3)=='Jan'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Jan", "Enero", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Feb'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Feb", "Febrero", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Mar'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Mar", "Marzo", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Apr'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Apr", "Abril", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='May'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("May", "Mayo", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Jun'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Jun", "Junio", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Jul'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Jul", "Julio", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Aug'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Aug", "Agosto", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Sep'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Sep", "Septiembre", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Oct'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Oct", "Octubre", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Nov'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Nov", "Noviembre", $fila['fechaF']) );}
            if(substr($fila['fechaF'], 3, 3)=='Dec'){$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, str_replace("Dec", "Diciembre", $fila['fechaF']) );}
                    
                        
            $i++;
        endforeach;
    }
    else{
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A7', 'No hay datos en esas fechas');

    }
    
       
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30); 

    $hoja = $objPHPExcel->getActiveSheet();

    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName('Logo')
                ->setDescription('Logo')
                ->setPath('./img/saber-mi-ip.PNG')
                ->setHeight(200)
                ->setWidth(200)
                ->setCoordinates('A1')
                ->setWorksheet($hoja);

    $objPHPExcel->getActiveSheet()->setTitle('Datos TH');
    $objPHPExcel->setActiveSheetIndex(0);
    
    $encTemp="Temperatura ".$grados;
    $encHume="Humedad %";
    
    $newObjPHPExcel = $objPHPExcel->getSheet(0);
    $newObjPHPExcel->setTitle('Data');
    
    $dataFechas='Data!$C$6:$C$'.($i-1).'';
    
    $dataDatosTemp='Data!$A$6:$A$'.($i-1).'';
    
    $dataDatosHume='Data!$B$6:$B$'.($i-1).'';
    
    
    $titTemp=array(
                new \PHPExcel_Chart_DataSeriesValues('String', 'Data!$A$5', NULL, 1),
                   
            );
    $titHume=array(
                new \PHPExcel_Chart_DataSeriesValues('String', 'Data!$B$5', NULL, 1),
                   
            );
    //aqui van las fechas
    $fechas=array(
                new \PHPExcel_Chart_DataSeriesValues('String', $dataFechas, NULL, (count($arrayDatos)-1)),
            );
    
    
    //aqui van los datos de temp o humedad
    $datTemp=array(
                new \PHPExcel_Chart_DataSeriesValues('Number', $dataDatosTemp, NULL, (count($arrayDatos)-1)),
               
            );
    $datHume=array(
                new \PHPExcel_Chart_DataSeriesValues('Number', $dataDatosHume, NULL, (count($arrayDatos)-1)),
               
            );
    
    $ds=new \PHPExcel_Chart_DataSeries(
                    \PHPExcel_Chart_DataSeries::TYPE_LINECHART,
                    \PHPExcel_Chart_DataSeries::GROUPING_STANDARD,
                    range(0, count($datTemp)-1),
                    $titTemp,
                    $fechas,
                    $datTemp
                    );
    
    $ds2=new \PHPExcel_Chart_DataSeries(
                    \PHPExcel_Chart_DataSeries::TYPE_LINECHART,
                    \PHPExcel_Chart_DataSeries::GROUPING_STANDARD,
                    range(0, count($datHume)-1),
                    $titHume,
                    $fechas,
                    $datHume
                    );
    
    
    $paTemp=new \PHPExcel_Chart_PlotArea(NULL, array($ds));
    $paHume=new \PHPExcel_Chart_PlotArea(NULL, array($ds2));
    $legendTemp=new \PHPExcel_Chart_Legend(\PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
    $titleTemp=new \PHPExcel_Chart_Title($encTemp);
    $titleHume=new \PHPExcel_Chart_Title($encHume);
    $chartTemp= new \PHPExcel_Chart(
                        'chart1',
                        $titleTemp,
                        $legendTemp,
                        $paTemp,
                        true,
                        0,
                        NULL, 
                        NULL
                        );

    $chartTemp->setTopLeftPosition('E15');
    $chartTemp->setBottomRightPosition('I36');
    $newObjPHPExcel->addChart($chartTemp);
    
    $chartHume= new \PHPExcel_Chart(
                        'chart2',
                        $titleHume,
                        $legendTemp,
                        $paHume,
                        true,
                        0,
                        NULL, 
                        NULL
                        );

    $chartHume->setTopLeftPosition('E38');
    $chartHume->setBottomRightPosition('I58');
    $newObjPHPExcel->addChart($chartHume);
    
        /* estilo para las celdas */
    $estiloTituloReporte = array(
        'font' => array(
            'name'      => 'Verdana',
            'bold'      => true,
            'italic'    => false,
            'strike'    => false,
            'size' =>16,
            'color'     => array(
                'rgb' => 'FFFFFF'
            )
        ),
        'fill' => array(
          'type'  => PHPExcel_Style_Fill::FILL_SOLID,
          'color' => array(
                'argb' => '1E8A90')
      ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'rotation' => 0,
            'wrap' => TRUE
        )
    );

    $estiloTituloColumnas = array(
        'font' => array(
            'name'  => 'Arial',
            'bold'  => true,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'fill' => array(
            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array(
                'rgb' => 'A1D3D5'
            )

        ),
        'borders' => array(
            'left' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN ,            
                'color' => array(
                        'rgb' => '000000'
                )
            ),
            'right' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN ,            
                'color' => array(
                        'rgb' => '000000'
                )
            ),
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN ,            
                'color' => array(
                        'rgb' => '000000'
                )
            )        
        ),
        'alignment' =>  array(
            'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap'      => TRUE
        )
    );

    $estiloInformacion = new PHPExcel_Style();
    $estiloInformacion->applyFromArray( array(
        'font' => array(
            'name'  => 'Arial',
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'alignment' =>  array(
            'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            'vertical'  => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            'wrap'      => TRUE
        ),
        'fill' => array(
            'type'  => PHPExcel_Style_Fill::FILL_SOLID
        ),
        'borders' => array(
            'left' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN ,            
                'color' => array(
                        'rgb' => '3a2a47'
                )
            ),
            'right' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN ,            
                'color' => array(
                        'rgb' => '3a2a47'
                )
            ),
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN ,            
                'color' => array(
                        'rgb' => '3a2a47'
                )
            )        
        )
    ));
    
    
    
    /*configuracion de celdas*/
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30); 
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20); 
    /*aplicar estilos a las celdas*/
    $objPHPExcel->getActiveSheet()->getStyle('A4:C4')->applyFromArray($estiloTituloReporte);    
    $objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($estiloTituloColumnas);
    $objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($estiloTituloColumnas);
    $objPHPExcel->getActiveSheet()->getStyle('C5')->applyFromArray($estiloTituloColumnas);    
    if($arrayDatos!=0)$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A6:C".($i-1));

    $objPHPExcel->getActiveSheet()->getStyle('E4:G4')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('E5')->applyFromArray($estiloTituloColumnas);
    $objPHPExcel->getActiveSheet()->getStyle('F5')->applyFromArray($estiloTituloColumnas);
    $objPHPExcel->getActiveSheet()->getStyle('G5')->applyFromArray($estiloTituloColumnas);
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "E6:G12");
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reporte.xlsx"');
    header('Cache-Control: max-age=0');


    $writer = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

    $writer->setIncludeCharts(true);
    $writer->save('php://output');
    
}
else{
    print "Error en envio de datos";
}


