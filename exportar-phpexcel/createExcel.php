<?php 
require_once 'functions/excel.php';

activeErrorReporting();
noCli();

// require_once '../PHPEXCEL/Classes/PHPExcel.php';
require_once '../public/Classes/PHPExcel.php';
// require_once 'functions/conexion.php';
require_once '../conexionDB/Conexion.php';
require_once 'functions/datos_oficina.php';

$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("")
               ->setLastModifiedBy("")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(12);   
$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setName('Calibri')->setSize(18);
 
//combinar columnas
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1');
$objPHPExcel->setActiveSheetIndex(0)
           
            ->setCellValue('A1', 'REPORTE DE OFICINA')
            
            //nombre columna
            ->setCellValue('A2', 'OFICINA')
            ->setCellValue('B2', 'DIRECCION')
            ->setCellValue('C2', 'TELEFONO')
            ->setCellValue('D2', 'CIUDAD')
            ->setCellValue('E2', 'FECHA APERTURA');

$objPHPExcel->getActiveSheet()->getStyle("A1:E2")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
			
// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

$objPHPExcel->getActiveSheet()->getStyle('A1:E2')->applyFromArray($boldArray);

$informe = datos_oficina();
$i = 3;

while($row = sqlsrv_fetch_array($informe, SQLSRV_FETCH_ASSOC))
{
                //formato de fecha
                $fecha=$row['FcApertura'];
                $fecha=$fecha->format('d/m/Y');
                $row['FcApertura']=$fecha;

$objPHPExcel->setActiveSheetIndex(0)
// $i= nro de columnas
            ->setCellValue("A$i", $row['NmOficina'])
            ->setCellValue("B$i", $row['Direccion'])
            ->setCellValue("C$i", $row['Telefono'])
            ->setCellValue("D$i", $row['NmCiudad'])
            ->setCellValue("E$i", $row['FcApertura']);
$objPHPExcel->getActiveSheet()->getStyle("A$i:E$i")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN); 
           
$i++;
}

$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(54);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17);

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Informe');

$gdImage = imagecreatefromjpeg('images/lg1.jpg');
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Sample image');
$objDrawing->setDescription('TEST');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(71);
// $drawing->setWidth(100);  
// $drawing->setHeight(50);
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

getHeaders();
// ob_clean();
// flush(); 

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean(); 
$objWriter->save('php://output');
exit;