<?php
// estos requires tomar en cuenta para localozar primero la coneccion de la base de datos
// luego busco donde estan las consultas ej:ProductoData.php
require_once "../core/controller/Database.php";
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
$activeWorksheet->setCellValue('C3', 'LISTA PRECIOS');

$titulosColumnas = array('Nro.', 'CODIGO', 'PRODUCTO', 'PRECIO');

$spreadsheet->setActiveSheetIndex(0)->mergeCells('C1:D1');

// Se agregan los títulos del reporte
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A4', $titulosColumnas[0])
    ->setCellValue('B4', $titulosColumnas[1])
    ->setCellValue('C4', $titulosColumnas[2])
    ->setCellValue('D4', $titulosColumnas[3]);

$productos = ProductoData::getAllProductos();
if ($productos != null) {
    $i = 5;
    $conta = 0;
    foreach ($productos as $index => $rowP) {
        $conta++;
        $spreadsheet->setActiveSheetIndex(0)
             ->setCellValue('A' . $i, $conta)
             ->setCellValue('B' . $i, $rowP['pro_id'])
             ->setCellValue('C' . $i, $rowP['pro_descripcion'])
             ->setCellValue('D' . $i, $rowP['pro_precio_v']);

        // Aplicar bordes a las celdas
        $spreadsheet->getActiveSheet()->getStyle('A' . $i . ':D' . $i)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $i++;
    }
}

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(50);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);

$spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$spreadsheet1->setName('Water_Level');
$spreadsheet1->setDescription('Water_Level');
$spreadsheet1->setPath('../img/escudo.png');
$spreadsheet1->setHeight(74);
$spreadsheet1->setCoordinates('G3');
$spreadsheet1->setWorksheet($spreadsheet->getActiveSheet());

$minombre = "holamundo";
$archivo = 'Vista_Precio_' . $minombre . '.xlsx';

// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $archivo . '"');
header('Cache-Control: max-age=0');

// IO FACTORY
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

// FIN CREACION Y DESCARGA DE ARCHIVO EXCEL