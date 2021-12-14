<?php 
ob_start(); 
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
$fecha_f=$_GET["fecha_f"];
$idgrupo=$_GET["idgrupo"];
$con=conectarse();
set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("plantilla_cuenta2.xlsx");
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL); 
//$borders = array('borders' => array('allborders' => array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => 'FF000000'),)),);
/*$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.4);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.2);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.2);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.4);
*/
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
$objPHPExcel->setActiveSheetIndex(0);
//$borders = array('borders' => array('allborders' => array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => 'FF000000'),)),);
$objPHPExcel->getActiveSheet()->SetCellValue('D5',$fecha_f);

/*NOMBRE DEL GRUPO*/
$fila_get_grupo=get_grupo_m($idgrupo);
if($fila_get_grupo!=0)
$grupo=$fila_get_grupo["grupo"];
else
$grupo="Individual";

$cg="J5:N5";
$objPHPExcel->getActiveSheet()->mergeCells($cg);//COMBINAMOS CELDAS
$style_negrita = array('font' => array('bold' => true,),);
$objPHPExcel->getActiveSheet()->getStyle("J5")->applyFromArray($style_negrita);
$objPHPExcel->getActiveSheet()->getStyle("J5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue("J5",nom($grupo));


/***BEGIN ESTADO DE CUENTA***/
$sql="SET datestyle TO postgres, dmy; SELECT s.idcliente,s.idestatus,s.t_sol,c.folio,c.f_aprobacion,c.monto,c.idcredito FROM cc_solicitudes as s, cc_creditos as c,rela_grupo as g  where s.idsolicitud=c.idsolicitud and s.idcliente=g.idcliente and g.idgrupo='$idgrupo'  and c.cancelado='false' and c.f_ministracion<='$fecha_f'  order by c.folio";
	$consulta=pg_query($con,$sql);
	$sum_monto=0;
	$sum_monto_m=0;
	$sum_inormal=0;
	$sum_saldo=0;
	$cont=0;
	$fi=9;//filas generales
	$fm=9;//filas de la ministracion
	$fa=9;//filas de Anticipos
while($fila=pg_fetch_array($consulta))
{
$a="A".$fi;
$b="B".$fi;
$c="C".$fi;
$d="D".$fi;
$e="E".$fi;
$f="F".$fi;
$g="G".$fi;
$h="H".$fi;
$i="I".$fi;
$j="J".$fi;
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

/*NOMBRE DEL CLIENTE*/
$ccliente=$a.":".$g;
$objPHPExcel->getActiveSheet()->mergeCells($ccliente);//COMBINAMOS CELDAS
//$objPHPExcel->getActiveSheet()->getStyle($ccliente)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($a,nom($nom_cliente));
/*FECHA DE APROBACION*/
//$objPHPExcel->getActiveSheet()->getStyle($h)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($h)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($h,nom($fila["f_aprobacion"]));
/*FOLIO DE CREDITO*/
//$objPHPExcel->getActiveSheet()->getStyle($i)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($i,nom($fila["folio"]));
/*MONTO AUTORIZADO*/
//$objPHPExcel->getActiveSheet()->getStyle($j)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto
$objPHPExcel->getActiveSheet()->SetCellValue($j,nom($fila["monto"]));

if($fila["idestatus"]!=5)	
$subtotal+=$fila["monto"];             
$cont++;


/*****************************************************************************MODULO DE MINISTRACIONES*/
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

	$k="K".$fm;
	$l="L".$fm;
	$m="M".$fm;
	$n="N".$fm;
	$o="O".$fm;
	$p="P".$fm;
	$q="Q".$fm;
	$r="R".$fm;
	$s="S".$fm;
	$t="T".$fm;

/*FECHA DE MINISTRACION*/
$cfminis=$k.":".$l;
$objPHPExcel->getActiveSheet()->mergeCells($cfminis);//COMBINAMOS CELDAS
//$objPHPExcel->getActiveSheet()->getStyle($cfminis)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($k,nom($filam["fecha"]));

/*REFERENCIA DE PAGO*/
if($filam["forma_pago"]=="CAJA")
$forma_pago="CA-".$filam["referencia"];
if($filam["forma_pago"]=="CHEQUE")
$forma_pago="CH-".$filam["referencia"];

//$objPHPExcel->getActiveSheet()->getStyle($m)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($m,nom($filam["fecha"]));
/*MONTO MINISTRADO*/
$cmontom=$n.":".$o;
$objPHPExcel->getActiveSheet()->mergeCells($cmontom);//COMBINAMOS CELDAS
//$objPHPExcel->getActiveSheet()->getStyle($cmontom)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($n)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto		
$objPHPExcel->getActiveSheet()->SetCellValue($n,$filam["monto"]);
/*DIAS DE CREDITO*/
//$objPHPExcel->getActiveSheet()->getStyle($p)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($p,nom($filam["dias_trans"]));
		
/**********************************CALCULAMOS EL INTERES NORMAL CON CORTE MENSUAL******************************************/
$fecha_ministracion=date_dmy_ymd($filam["fecha"]); //cambia a formato y-m-d			
$interes_normal=get_interes_normal($filam["dias_trans"],$fecha_ministracion,$filam["monto"],$filam["interes_normal"]);				
$cinormal=$q.":".$r;
$objPHPExcel->getActiveSheet()->mergeCells($cinormal);//COMBINAMOS CELDAS
//$objPHPExcel->getActiveSheet()->getStyle($cinormal)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($q)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto		
$objPHPExcel->getActiveSheet()->SetCellValue($q,$interes_normal);
			
$saldo=$filam["monto"]+$interes_normal;			
$csaldo=$s.":".$t;
$objPHPExcel->getActiveSheet()->mergeCells($csaldo);//COMBINAMOS CELDAS
//$objPHPExcel->getActiveSheet()->getStyle($csaldo)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($s)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto		
$objPHPExcel->getActiveSheet()->SetCellValue($s,$saldo);
			
			/******************************************FIN DEL CALCULO DE LOS INTERESES*****************************************************/

$fm++;//INCREMENTO DE LAS FILAS DE MINISTRACION		
			
$sum_monto_m+=$filam["monto"];
$sum_inormal+=$interes_normal;
$sum_saldo+=$saldo;	

				}
		 	                        

/*****************************************************************************FINNNNNN MODULO DE MINISTRACIONES*/

/*****************************************************************************MODULO DE ANTICIPOS*/
$sqla="SET datestyle TO postgres, dmy; 
SELECT c.fecha,c.ref_cheque,c.monto
FROM cc_cheques_anticipos as a, cheques as c
WHERE
a.idcliente='$idcliente' and a.idmov=c.idmov and c.ch_cancelado=false and c.en_transito=true
order by c.fecha
";

$consultaa=pg_query($con,$sqla);		
while($filaa=pg_fetch_array($consultaa))
	{

	$u="U".$fa;
	$v="V".$fa;
	$w="W".$fa;
	$x="X".$fa;
	$y="Y".$fa;
	$z="Z".$fa;

/*FECHA DEL CHEQUE DEL ANTICIPO*/
$cfanticipo=$u.":".$v;
$objPHPExcel->getActiveSheet()->mergeCells($cfanticipo);//COMBINAMOS CELDAS
//$objPHPExcel->getActiveSheet()->getStyle($cfanticipo)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($u)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($u,nom($filaa["fecha"]));
/*REFERENCIA DE PAGO*/
$careferencia=$w.":".$x;
$objPHPExcel->getActiveSheet()->mergeCells($careferencia);//COMBINAMOS CELDAS
//$objPHPExcel->getActiveSheet()->getStyle($careferencia)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($w)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($w,nom("CH-".$filaa["ref_cheque"]));
/*MONTO DEL ANTICIPO*/
$camontom=$y.":".$z;
$objPHPExcel->getActiveSheet()->mergeCells($camontom);//COMBINAMOS CELDAS
//$objPHPExcel->getActiveSheet()->getStyle($camontom)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($y)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros a la celda de monto		
$objPHPExcel->getActiveSheet()->SetCellValue($y,$filaa["monto"]);

$fa++;//INCREMENTO DE LAS FILAS DE MINISTRACION		
			
$sum_monto_a+=$filaa["monto"];

				}
		 	                        

/*****************************************************************************FINNNNNN MODULO DE ANTICIPOS*/
$a_mayor=array();
$a_mayor=array($fi,$fm,$fa);
$mayor=get_mayor($a_mayor);
$fi=$mayor+2;
$fm=$mayor+2;
$fa=$mayor+2;
unset($a_mayor);


}

$fi+1;
$fm+1;
$fa+1;
$a="A".$fi;
$b="B".$fi;
$c="C".$fi;
$d="D".$fi;
$e="E".$fi;
$f="F".$fi;
$g="G".$fi;
$h="H".$fi;
$i="I".$fi;
$j="J".$fi;
$k="K".$fm;
$l="L".$fm;
$m="M".$fm;
$n="N".$fm;
$o="O".$fm;
$p="P".$fm;
$q="Q".$fm;
$r="R".$fm;
$s="S".$fm;
$t="T".$fm;
$u="U".$fa;
$v="V".$fa;
$w="W".$fa;
$x="X".$fa;
$y="Y".$fa;
$z="Z".$fa;
/****************************************SUMAS TOTALES*****************************************/
/*monto autorizado*/
$objPHPExcel->getActiveSheet()->getStyle($j)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($j)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($j,$sum_monto);
/*monto ministrado*/
$mmm=$n.":".$o;
$objPHPExcel->getActiveSheet()->mergeCells($mmm);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($mmm)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($mmm)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
$objPHPExcel->getActiveSheet()->getStyle($n)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($n,$sum_monto_m);
/*suma de intereses normales*/
$si=$q.":".$r;
$objPHPExcel->getActiveSheet()->mergeCells($si);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($si)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($si)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
$objPHPExcel->getActiveSheet()->getStyle($q)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($q,$sum_inormal);
/*Suma de saldos actuales*/
$ss=$s.":".$t;
$objPHPExcel->getActiveSheet()->mergeCells($ss);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($ss)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($ss)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
$objPHPExcel->getActiveSheet()->getStyle($s)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($s,$sum_saldo);
 /*Suma monto de anticipos*/
$sa=$y.":".$z;
$objPHPExcel->getActiveSheet()->mergeCells($sa);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($sa)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($sa)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
$objPHPExcel->getActiveSheet()->getStyle($y)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($y,$sum_monto_a);



$style_negrita = array('font' => array('bold' => true,),);
$objPHPExcel->getActiveSheet()->getStyle($g)->applyFromArray($style_negrita);
$objPHPExcel->getActiveSheet()->SetCellValue($g,"SUMAS TOTALES");


/**END ESTADO DE CUENTA*/








$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("estado_cuenta.xlsx");
$enlace = "estado_cuenta.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





