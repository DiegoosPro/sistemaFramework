<?php
 
 require_once "../core/Controller/DataBase.php";
 require_once "../core/modules/index/model/ProductoData.php";


require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

$activeWorksheet->setCellValue('C3', 'LISTA DE PRECIOS !');
$titulosColumnas = array('Nro.', 'CODIGO', 'PRODUCTO', 'PRECIO');

        $spreadsheet->setActiveSheetIndex(0)->mergeCells('C1:D1');


        // Se agregan los titulos del reporte
        $spreadsheet->setActiveSheetIndex(0)
             ->setCellValue('B5', $titulosColumnas[0])
             ->setCellValue('C5', $titulosColumnas[1])
             ->setCellValue('D5', $titulosColumnas[2]);


             $productos=ProductoData::getAllProductos();
            
             if($productos!=null){
                $i = 5;
                $conta=0;
                     foreach($productos as $index => $rowp){
                             $conta++;
                             $spreadsheet->setActiveSheetIndex(0)
                                ->setCellValue('A', $i ,$conta)
                                ->setCellValue('B', $i ,$rowp['pro_id'])
                                ->setCellValue('C', $i ,$rowp['pro_descripcion'])
                                ->setCellValue('D', $i ,$rowp['pro_precio_v']);

                                $i++;
                     }
             }
             $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
             $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
             $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
             $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);

//*************CODIGO PARA IMAGEN*************************** */

$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $objDrawing->setName('Water_Level');
        $objDrawing->setDescription('Water_Level');
        $objDrawing->setPath('../img/escudo.png');
        $objDrawing->setHeight(74);
        $objDrawing->setCoordinates('G1');
        $objDrawing->setWorksheet($spreadsheet->getActiveSheet());


//*********CODIGO PARA IMPRIMIR EXCEL************************** */
$minombre="holamundo";
        $archivo='PromedioFinalMSV_'.$minombre.'.xlsx';
        // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
       header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $archivo . '"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');