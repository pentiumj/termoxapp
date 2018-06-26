<?php
session_start();
include_once 'libs/PHPExcel/Classes/PHPExcel.php';
include_once 'libs/PHPExcel/Classes/PHPExcel/Chart.php';
require_once 'libs/PHPExcel/Classes/PHPExcel/Worksheet/Drawing.php';
require_once '../controlador/mDatosTablaC.php';


if( (isset($_POST['inicio'])) && (isset($_POST['fin']))){
        
        $inicio = $_POST['inicio'];
        $fin = $_POST['fin'];
        
        $arrayDatos = mostrarDatosTabla($inicio, $fin);
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
                    ->setCellValue('A5', 'Temperatura')
                    ->setCellValue('B5', 'Humedad')
                    ->setCellValue('C5', 'Fecha y Hora');
        if($arrayDatos!= 0){
            $i=6;
            foreach ($arrayDatos as $fila ) : 

                 $objPHPExcel->setActiveSheetIndex(0)
                             ->setCellValue('A'.$i, $fila['promedioTemp'])
                             ->setCellValue('B'.$i, $fila['promedioHume'])
                             ->setCellValue('C'.$i, $fila['fechaTomada']);
                 $i++;
            endforeach;
        }
        else{
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A7', 'No hay datos en esas fechas');
           
        }
             
    }
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
/*aplicar estilos a las celdas*/
$objPHPExcel->getActiveSheet()->getStyle('A4:C4')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->getStyle('C5')->applyFromArray($estiloTituloColumnas);
if($arrayDatos!=0)$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A6:C".($i-1));


/*graficas - prueba
 
 */

$hoja = $objPHPExcel->getActiveSheet();

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo')
            ->setDescription('Logo')
            ->setPath('./img/saber-mi-ip.PNG')
            ->setHeight(200)
            ->setWidth(200)
            ->setCoordinates('B1')
            ->setWorksheet($hoja);

/*configuracion del archivo excel*/
$objPHPExcel->getActiveSheet()->setTitle('Datos TH');
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReportedeTH.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

