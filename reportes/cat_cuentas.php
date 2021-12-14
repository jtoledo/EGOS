<?php 
ob_start(); 

include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
require("../includes/session.php");
$con=conectarse();


$idSucursal=$_SESSION['mov_sucursal'];
$idCosecha=$_SESSION['cosecha_sel'];

$consulta="SET datestyle TO postgres, dmy;";
$consulta.="select cb.idcuenta,nombre_banco::char(70) as banco,num_cuenta::char(50) as cuenta,saldo,cns_cheque,cb.descripcion_cuenta 
 from cuentas_bancarias cb,bancos b,cuentas cu where b.idbanco=cb.idbanco and cb.idcuenta=cu.idcuenta and 
 cb.idcuenta!=5338 ORDER BY nombre_banco,num_cuenta";
          	
          	
        $id_query = pg_query($con,$consulta);
		

set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("cat_cuentas_bancarias.xlsx");
$objPHPExcel->setActiveSheetIndex(0);

$row=6;

while($fila= pg_fetch_array($id_query))
{

	$objPHPExcel->getActiveSheet()->SetCellValue("B{$row}", trim($fila['banco']));
	$objPHPExcel->getActiveSheet()->SetCellValue("C{$row}", trim($fila['cuenta']));
	$objPHPExcel->getActiveSheet()->SetCellValue("D{$row}", trim($fila['saldo']));
	$objPHPExcel->getActiveSheet()->SetCellValue("E{$row}", trim($fila['cns_cheque']));
	$objPHPExcel->getActiveSheet()->SetCellValue("F{$row}", trim($fila['descripcion_cuenta']));
	
	//agrega una linea
	$objPHPExcel->getActiveSheet()->InsertNewRowBefore ($row+ 1, 1);
	$row+=1;
}

//eliminar las dos ultimas filas
$objPHPExcel->getActiveSheet()->RemoveRow($row);
//$objPHPExcel->getActiveSheet()->RemoveRow($row);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("cat_cuentas_bancarias_xe.xlsx");

$enlace = "cat_cuentas_bancarias_xe.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





