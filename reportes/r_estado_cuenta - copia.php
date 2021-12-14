<?php 
ob_start(); 
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

//$fecha_i=$_GET["fecha_i"];
$fecha_f=$_GET["fecha_f"];

 
$con=conectarse();
set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("plantilla_stado_cta.xlsx");
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$borders = array('borders' => array('allborders' => array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => 'FF000000'),)),);
$objPHPExcel->getActiveSheet()->SetCellValue('D5',$fecha_f);

$sql="SET datestyle TO postgres, dmy; SELECT s.idcliente,s.idestatus,s.t_sol,c.folio,c.f_aprobacion,c.monto,c.idcredito FROM cc_solicitudes as s, cc_creditos as c    where s.idsolicitud=c.idsolicitud and c.cancelado='false' and c.f_ministracion<='$fecha_f'  order by c.folio";
	$consulta=pg_query($con,$sql);
	$sum_monto=0;
	$sum_monto_m=0;
	$sum_inormal=0;
	$sum_saldo=0;
	$cont=0;
	$fi=9;//filas generales
	$fm=9;//filas de la ministracion


	$objPHPExcel->getDefaultStyle()->getFont()->setSize(8);
	
	
	
	while($fila=pg_fetch_array($consulta))
	{
	

	

	$a="A".$fi;
	$d="D".$fi;
	$e="E".$fi;
	$f="F".$fi;	
	
	
		 
	
	$sum_monto+=$fila["monto"];
	
	
	
	
						$idcredito=$fila["idcredito"];	
	
						$idcliente=$fila["idcliente"];
						$fila_cliente=get_cliente($idcliente);
						$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
						$nom_cliente= limitarPalabras($nom_cliente,35); 
						$estatus=get_estatus($fila["idestatus"]);
						
			
			$fila_get_grupo=get_grupo_sol($idcliente);
						if($fila_get_grupo!=0)
						$grupo="Grupo";
						else
						$grupo="Individual";	
						
				
		
		
$objPHPExcel->getActiveSheet()->SetCellValue($a,nom($nom_cliente));
$objPHPExcel->getActiveSheet()->getStyle($d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($d,$fila["f_aprobacion"]);
$objPHPExcel->getActiveSheet()->getStyle($e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($e,$fila["folio"]);
$objPHPExcel->getActiveSheet()->getStyle($f)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto
$objPHPExcel->getActiveSheet()->SetCellValue($f,$fila["monto"]);



		
		
				
					if($fila["idestatus"]!=5)	
                    $subtotal+=$fila["monto"];             
					
         $cont++;
		
		
$sqlm="SET datestyle TO postgres, dmy; 
SELECT
ca.fecha,
ca.ref_recibo as referencia,
ca.monto,
 '$fecha_f'::date-ca.fecha as dias_trans,
c.interes_normal as interes_normal,
0 as i_moratorio,
0 as pagos ,
'CAJA'::varchar as forma_pago
FROM cc_solicitudes as s, cc_creditos as c, cajas as ca, cc_cajas_ministracion as cam  where  s.idcliente='$idcliente' and  s.idsolicitud=c.idsolicitud  and c.idcredito=cam.idcredito  and cam.idmov=ca.idmov and ca.fecha<='$fecha_f'
UNION ALL
SELECT 
ch.fecha,
ch.ref_cheque as referencia,
ch.monto,
 '$fecha_f'::date-ch.fecha as dias_trans, 
c.interes_normal as interes_normal,
0 as i_moratorio,
0 as pagos,
'CHEQUE'::varchar as forma_pago
FROM cc_solicitudes as s, cc_creditos as c, cheques as ch, cc_cheques_ministracion as chm where  s.idcliente='$idcliente' and  s.idsolicitud=c.idsolicitud  and c.idcredito=chm.idcredito  and chm.idmov=ch.idmov and ch.fecha<='$fecha_f'
ORDER BY fecha

";

	$consultam=pg_query($con,$sqlm);		
		
			while($filam=pg_fetch_array($consultam))
				{
			
				$g="G".$fm;
				$h="H".$fm;
				$i="I".$fm;
				$j="J".$fm;
				$k="K".$fm;
				$l="L".$fm;			
				
$objPHPExcel->getActiveSheet()->getStyle($g)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro			
			$objPHPExcel->getActiveSheet()->SetCellValue($g,$filam["fecha"]);
			if($filam["forma_pago"]=="CAJA")
			$forma_pago="CA-".$filam["referencia"];
			if($filam["forma_pago"]=="CHEQUE")
			$forma_pago="CH-".$filam["referencia"];
$objPHPExcel->getActiveSheet()->getStyle($h)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro			
			$objPHPExcel->getActiveSheet()->SetCellValue($h,$forma_pago);
			$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto		
			$objPHPExcel->getActiveSheet()->SetCellValue($i,$filam["monto"]);
			$objPHPExcel->getActiveSheet()->SetCellValue($j,$filam["dias_trans"]);
			$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto

			/**********************************CALCULAMOS EL INTERES NORMAL CON CORTE MENSUAL******************************************/
				
			$fecha_ministracion=date_dmy_ymd($filam["fecha"]); //cambia a formato y-m-d
			$interes_normal=get_interes_normal($filam["dias_trans"],$fecha_ministracion,$filam["monto"],$filam["interes_normal"]);	
			
			$objPHPExcel->getActiveSheet()->SetCellValue($k,$interes_normal);
			$saldo=$filam["monto"]+$interes_normal;
			$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto
			$objPHPExcel->getActiveSheet()->SetCellValue($l,$saldo);

			
			/******************************************FIN DEL CALCULO DE LOS INTERESES*****************************************************/
			
			
			
/*RECUPERACION DEL MODULO DE ANTICIPOS**/
/*
$banticipo=$g.":".$l;
$objPHPExcel->getActiveSheet()->mergeCells($banticipo);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($banticipo)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($g)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($g,"ANTICIPOS");
*/
/*FIN DE RECUPERACION DEL MODULO DE ANTICIPOS*/

			
			


			
			
			$fi++;//filas generales
			$fm++;//filas de la ministracion		

				
			$sum_monto_m+=$filam["monto"];
			$sum_inormal+=$interes_normal;
			$sum_saldo+=$saldo;	
			
			
				
				}
		 	                        
$fi++;
$fm++;

/*$objPHPExcel->getActiveSheet()->SetCellValue($g,"ANTICIPOS");
$fi++;//filas generales
$fm++;//filas de la ministracion*/





	
	
	}

$fi+1;
$fm+1;
$f="F".$fi;
$i="I".$fm;
$k="K".$fm;
$l="L".$fm;	





		
$objPHPExcel->getActiveSheet()->getStyle($f)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto
$objPHPExcel->getActiveSheet()->SetCellValue($f,$sum_monto);
$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto
$objPHPExcel->getActiveSheet()->SetCellValue($i,$sum_monto_m);
$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto
$objPHPExcel->getActiveSheet()->SetCellValue($k,$sum_inormal);
$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto
$objPHPExcel->getActiveSheet()->SetCellValue($l,$sum_saldo);







$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("estado_cuenta.xlsx");
$enlace = "estado_cuenta.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





