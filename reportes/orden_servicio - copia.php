<?php 
ob_start(); 
session_start();
$id_usuario=$_SESSION["usuario"];
$id_servicio=$_GET["id_servicio"];
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();
$fila=get_se_servicios($id_servicio);  //cuando no hay una consulta determinada se consulta la primera solicitud
		
			if($fila!=0)
			{
		
$id_servicio=$fila["id_servicio"];
$fecha_servicio=$fila["fecha_servicio"];
$id_secadora=$fila["id_secadora"];
$idcliente=$fila["idcliente"];
$folio_servicio=$fila["folio_servicio"];
$id_catalogo=$fila["id_catalogo"];
$observaciones=$fila["observaciones"];
$hora_r=$fila["hora_r"];
$hora_s=$fila["hora_s"];
$hora_fs=$fila["horafs"];
$maduro=$fila["maduro"];
$smaduro=$fila["smaduro"];
$bayo=$fila["bayo"];
$verde=$fila["verde"];
$quemado=$fila["quemado"];
$tierno=$fila["tierno"];
$costo_kgsalida=$fila["costo_kgsalida"];

			
			
			}

$cafe=get_cafe_tipo($id_catalogo);
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
$objPHPExcel = $objReader->load("plantilla_servicios.xlsx");
$objPHPExcel->setActiveSheetIndex(0);
/*
$objPHPExcel->getActiveSheet()->SetCellValue('B4',$fecha_servicio);
$objPHPExcel->getActiveSheet()->SetCellValue('N4',$id_secadora);
$objPHPExcel->getActiveSheet()->SetCellValue('B5',nom($nom_clientes));

$objPHPExcel->getActiveSheet()->SetCellValue('N5',$folio_servicio);
$objPHPExcel->getActiveSheet()->SetCellValue('B6',nom($domicilio));
$objPHPExcel->getActiveSheet()->SetCellValue('N6',nom($cafe));
$objPHPExcel->getActiveSheet()->SetCellValue('I1',nom($fila_sucursal["direccion"]));	  
$objPHPExcel->getActiveSheet()->SetCellValue('A24',nom($fila_usuario["nombre"]));
$objPHPExcel->getActiveSheet()->SetCellValue('J24',nom($nom_clientes));
/*

 $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM se_pesadas where id_servicio='$id_servicio' ";
	   $id_query = pg_query($con,$consulta);
	
	$fi=9;
	$bloqueo=1;
		 while($fila= pg_fetch_array($id_query))
		   {
	 if($bloqueo>10)
	 break;
	 
	 $a="A".$fi;
	 $d="D".$fi;
	 $i="I".$fi;
	 $k="K".$fi;
	 $n="N".$fi;
	 
	 
	 $objPHPExcel->getActiveSheet()->SetCellValue($a,$fila["bolsa"]);
	 $objPHPExcel->getActiveSheet()->SetCellValue($d,$fila["kgs_brutos"]);
	 $objPHPExcel->getActiveSheet()->SetCellValue($i,$fila["tara"]);
	 $objPHPExcel->getActiveSheet()->SetCellValue($k,$fila["kgs_netos"]);
	 $objPHPExcel->getActiveSheet()->SetCellValue($n,$fila["cajas"]);
	 
		$a++;
		$d++;
		$i++;
		$k++;
		$n++;
			
			$bloqueo++;
			
			}	  

*/

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("recibo_servicio.xlsx");

$enlace = "recibo_servicios.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





