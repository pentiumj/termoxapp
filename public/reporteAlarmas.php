<?php session_start();
require_once '../controlador/reporteAlarmasC.php';
include_once 'libs/PHPExcel/Classes/PHPExcel.php';
require_once 'libs/PHPExcel/Classes/PHPExcel/Worksheet/Drawing.php';

if($_POST){
    if(isset($_POST['idFarmacia']) && !empty($_POST['idFarmacia'])){
        $idFarmacia = $_POST['idFarmacia'];
          
        $alarmas = verAlarmas($idFarmacia);
        
            
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
                ->setCreator("Termox")
                ->setLastModifiedBy("Termox")
                ->setTitle("Exportar datos alarmas")
                ->setSubject("Datos alarmas")
                ->setDescription("alarmas en excel")
                ->setKeywords("Datos alarmas excel")
                ->setCategory("reporte alarmas ");

        $objPHPExcel->setActiveSheetIndex(0)
                       ->mergeCells('A4:C4');

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A4', 'Reporte de alarmas por sistema TERMOX')
                    ->setCellValue('A5', 'Temperatura')
                    ->setCellValue('B5', 'Humedad')
                    ->setCellValue('C5', 'Fecha y Hora (a-m-d)');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $hoja = $objPHPExcel->getActiveSheet();

        if(count($alarmas)!=0){
            $i=0;
            $j=6;
            foreach ($alarmas as $fila ) : 

                $fecha = new DateTime($fila['fecha']);

                if ( $i == 0) {
                    $fecha2 = new DateTime($fila['fecha']);
                    $fecha2->modify("+1 hours");

                }                            


                if( $fecha <= $fecha2 ){

                    $fecha2 = new DateTime($fila['fecha']);
                    $fecha2->modify("-1 hours");

                    ++$i;
                    //echo $fecha->format("Y-m-d H:i"); 
                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('C'.$j, formatoFecha($fecha->format("Y-m-d ")).$fecha->format(" h:i A"));

                    $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$j, $fila['temperatura']);
                    //echo $fila['temperatura'];

                    //echo $fila['humedad']."<br>";
                    $objPHPExcel->setActiveSheetIndex(0)                                
                            ->setCellValue('B'.$j, $fila['humedad']);
                    $j++;
                }
            
            
            endforeach;
        }else{
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A7', 'No hay alarmas');
        }
    
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo')
                    ->setDescription('Logo')
                    ->setPath('./img/saber-mi-ip.PNG')
                    ->setHeight(200)
                    ->setWidth(200)
                    ->setCoordinates('A1')
                    ->setWorksheet($hoja);

        $objPHPExcel->getActiveSheet()->setTitle('Reporte de alarmas');
        $objPHPExcel->setActiveSheetIndex(0);
    
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
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A6:C".($j-1));

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Reporte alarmas.xlsx"');
        header('Cache-Control: max-age=0');


        $writer = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        $writer->setIncludeCharts(true);
        $writer->save('php://output');
        
    }else{
        echo "Ocurrio un error";
    }
        
}

