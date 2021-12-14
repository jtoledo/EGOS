<?php
// Camino a los include
set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
// PHPExcel
require_once 'PHPExcel.php';
// PHPExcel_IOFactory
include 'PHPExcel/IOFactory.php';
// Creamos un objeto PHPExcel
$objPHPExcel = new PHPExcel();
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path

$objPHPExcel = $objReader->load("plantilla_solicitud.xlsx");

// Indicamos que se pare en la hoja uno del libro
$objPHPExcel->setActiveSheetIndex(0);

//Escribimos en la hoja en la celda B1
$objPHPExcel->getActiveSheet()->SetCellValue('I7', 'C00001986ASDHKJH');

// Color rojo al texto
//$objPHPExcel->getActiveSheet()->getStyle('B2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
// Texto alineado a la derecha
//$objPHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
// Damos un borde a la celda
//$objPHPExcel->getActiveSheet()->getStyle('B2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
//$objPHPExcel->getActiveSheet()->getStyle('B2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
//$objPHPExcel->getActiveSheet()->getStyle('B2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);

//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007′ por 'Excel5′ y el nombre del archivo de salida cambiar su formato por '.xls'
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("solicitud.xlsx");

?>