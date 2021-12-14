<?php 
ob_start(); 
session_start();
$id_usuario=$_SESSION["usuario"];
$id_servicio=$_GET["id_servicio"];
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();
$fila=get_se_oservicios($id_servicio,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);  //cuando no hay una consulta determinada se consulta la primera solicitud
		
			if($fila!=0)
			{
		
$id_servicio=$fila["id_servicio"];
$idcliente=$fila["idcliente"];
$fecha_servicio=$fila["fecha_servicio"];
$folio_servicio=$fila["folio_servicio"];
$cantidad=$fila["cantidad"];
$id_tipo_servicio=$fila["id_tipo_servicio"];
$precio_u=$fila["precio_u"];
$subtotal=$fila["subtotal"];
$total=$fila["total"];
$observaciones=$fila["observaciones"];


$servicio=get_tipo_servicio($id_tipo_servicio);

			
			
			}

$fila_cliente=get_cliente($idcliente);
$nom_clientes=" ".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."  ";
$domicilio=$fila_cliente["domicilio"];

$fila_usuario=get_usuario($id_usuario);
$fila_sucursal=get_sucursal_m($fila_usuario["id_sucursal"]);

set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("plantilla_oservicios.xlsx");
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->SetCellValue('G7',$folio_servicio);
$objPHPExcel->getActiveSheet()->SetCellValue('G29',$folio_servicio);
$objPHPExcel->getActiveSheet()->SetCellValue('G8',$fecha_servicio);
$objPHPExcel->getActiveSheet()->SetCellValue('G30',$fecha_servicio);
$objPHPExcel->getActiveSheet()->SetCellValue('C7',nom($nom_clientes));
$objPHPExcel->getActiveSheet()->SetCellValue('C29',nom($nom_clientes));
$objPHPExcel->getActiveSheet()->SetCellValue('C8',nom($domicilio));
$objPHPExcel->getActiveSheet()->SetCellValue('C30',nom($domicilio));

$objPHPExcel->getActiveSheet()->SetCellValue('C11',nom($servicio));
$objPHPExcel->getActiveSheet()->SetCellValue('C33',nom($servicio));
$objPHPExcel->getActiveSheet()->SetCellValue('D11',number_format($cantidad,2));	  
$objPHPExcel->getActiveSheet()->SetCellValue('D33',number_format($cantidad,2));	  
$objPHPExcel->getActiveSheet()->SetCellValue('E11',number_format($precio_u,2));	  
$objPHPExcel->getActiveSheet()->SetCellValue('E33',number_format($precio_u,2));	  
$objPHPExcel->getActiveSheet()->SetCellValue('F11',number_format($total,2));	  
$objPHPExcel->getActiveSheet()->SetCellValue('F33',number_format($total,2));

$objPHPExcel->getActiveSheet()->SetCellValue('B17',nom($fila_usuario["nombre"]));	  
$objPHPExcel->getActiveSheet()->SetCellValue('B39',nom($fila_usuario["nombre"]));	  

$objPHPExcel->getActiveSheet()->SetCellValue('A4',nom($fila_sucursal["direccion"]));	  
$objPHPExcel->getActiveSheet()->SetCellValue('A26',nom($fila_sucursal["direccion"]));	  
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"Telefono: ".nom($fila_sucursal["telefono"]));	  
$objPHPExcel->getActiveSheet()->SetCellValue('A27',"Telefono: ".nom($fila_sucursal["telefono"]));	  



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("otros_servicios.xlsx");

$enlace = "otros_servicios.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





