<?php
// estos requires tomar en cuenta para localozar primero la coneccion de la base de datos
// luego busco donde estan las consultas ej:ProductoData.php
require_once "../core/controller/Database.php";
require_once "../core/modules/index/model/ProductoData.php";


require_once '../core/modules/index/model/MarcaData.php';
require_once '../core/modules/index/model/CategoriaData.php';


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

// Establecer el título de la lista de productos en la celda B3
$activeWorksheet->setCellValue('C3', 'LISTA PRODUCTOS POR MARCAS');
$titleFont = [
    'bold' => true,
    'size' => 16,
    'name' => 'Georgia', // Cambia 'Arial' al tipo de letra elegante que desees
    'color' => ['rgb' => '000000'], // Cambia '000000' al color deseado en formato RGB
];
$activeWorksheet->getStyle('C3')->applyFromArray(['font' => $titleFont]);

// Títulos de columna
$titulosColumnas = array('Nro.', 'CODIGO', 'PRODUCTO', 'STOCK', 'PRECIO');

$spreadsheet->setActiveSheetIndex(0)->mergeCells('C1:D1');

// Agregar los títulos de columna en la fila 4
$styleTitulo = [
    'font' => ['bold' => true],
    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    'borders' => ['outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => '000000']]]
];

foreach ($titulosColumnas as $index => $titulo) {
    $columnLetter = chr(65 + $index); // ASCII 'A' is 65
    $activeWorksheet->setCellValue($columnLetter . '4', $titulo);
    $activeWorksheet->getStyle($columnLetter . '4')->applyFromArray($styleTitulo);
    $activeWorksheet->getColumnDimension($columnLetter)->setAutoSize(true); // Ajustar el ancho de la columna automáticamente
}

// Obtener los datos de los productos
$productos = ProductoData::getAllProductos();

// Agregar los datos de los productos en las filas
$row = 5; // Comenzar desde la fila 5
foreach ($productos as $indice => $producto) {
    $activeWorksheet->setCellValue('A' . $row, $indice + 1)
                    ->setCellValue('B' . $row, $producto['pro_id'])
                    ->setCellValue('C' . $row, $producto['pro_descripcion'])
                    ->setCellValue('E' . $row, $producto['pro_precio_v']);

    // Resaltar el recuadro en color rojo para productos con stock menor a 5
    

    $activeWorksheet->setCellValue('D' . $row, $producto['pro_stock']); // Colocar el valor de stock en cualquier caso
    $row++;
}

// Establecer dimensiones de las columnas
$activeWorksheet->getColumnDimension('A')->setWidth(5);
$activeWorksheet->getColumnDimension('B')->setWidth(10);
$activeWorksheet->getColumnDimension('C')->setWidth(50);
$activeWorksheet->getColumnDimension('D')->setWidth(15);
$activeWorksheet->getColumnDimension('E')->setWidth(15);



// Aplicar bordes a todas las celdas de la tabla
$lastColumn = $activeWorksheet->getHighestColumn();
$tableRange = 'A4:' . $lastColumn . $row;
$activeWorksheet->getStyle($tableRange)->applyFromArray(['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['rgb' => '000000']]]]);


$spreadsheet1 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$spreadsheet1->setName('Water_Level');
$spreadsheet1->setDescription('Water_Level');
$spreadsheet1->setPath('../img/LOGO.png');
$spreadsheet1->setHeight(74);
$spreadsheet1->setCoordinates('G3');
$spreadsheet1->setWorksheet($spreadsheet->getActiveSheet());

// Nombre del archivo y configuración para descarga
$minombre = "MARCAS";
$archivo = 'Reporte_' . $minombre . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $archivo . '"');
header('Cache-Control: max-age=0');

// Guardar el archivo en la salida
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');