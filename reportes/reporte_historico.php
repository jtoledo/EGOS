<?php 
ob_start(); 
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
$con=conectarse();

$id_cliente=$_GET["id_cliente"];
$id_periodo=$_GET["id_periodo"];
$id_sucursal=$_GET["id_almacen"];



$consulta=pg_query($con,"SET datestyle TO postgres, dmy;");

set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("plantilla_historico.xlsx");
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4); 
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(1);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.2);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.3);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(1);
$objPHPExcel->getDefaultStyle()->getFont()->setSize(9.5);
$borders = array('borders' => array('allborders' => array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => 'FF000000'),)),);


//$objPHPExcel->getActiveSheet()->SetCellValue("V3",$cosecha);

$fi=2;//filas generales

$query_cosecha=pg_query($con,"SELECT * FROM co_pcosecha order by id_periodo desc");

//variables globales
$fi_liquida=0;

$total_deuda_global=0.00;
$deuda_cosecha_actual=0.00;

$nota_sin_precio="";
$control=1;

while($fila_cosecha=pg_fetch_array($query_cosecha))
{

	$id_periodo=$fila_cosecha["id_periodo"];
	$cosecha=get_cosecha_r($id_periodo);

	$cosecha_col="B".$fi.":J".$fi;
	$cosecha_cel="B".$fi;
	$objPHPExcel->getActiveSheet()->mergeCells($cosecha_col);//COMBINAMOS CELDAS
	$objPHPExcel->getActiveSheet()->getStyle($cosecha_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cosecha_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cosecha_cel)->getFont()->setSize(20);
	$objPHPExcel->getActiveSheet()->SetCellValue($cosecha_cel,$cosecha);

	$fila_cliente=get_cliente($id_cliente);


	if($control==1) {	
		$fi++;

		$cliente_col="B".$fi.":H".$fi;
		$cliente_cel="B".$fi;
		$objPHPExcel->getActiveSheet()->mergeCells($cliente_col);
		$objPHPExcel->getActiveSheet()->getStyle($cliente_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
		$objPHPExcel->getActiveSheet()->getStyle($cliente_cel)->applyFromArray(array('font' => array('bold' => true)));
		$objPHPExcel->getActiveSheet()->getStyle($cliente_cel)->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->SetCellValue($cliente_cel,'CLIENTE: '.$fila_cliente["nombre"].' '.$fila_cliente["ap_paterno"].' '.$fila_cliente["ap_materno"]);

	
		$auxiliar_col="I".$fi.":M".$fi;
		$auxiliar_cel="I".$fi;
		$objPHPExcel->getActiveSheet()->mergeCells($auxiliar_col);
		$objPHPExcel->getActiveSheet()->getStyle($auxiliar_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
		$objPHPExcel->getActiveSheet()->getStyle($auxiliar_cel)->applyFromArray(array('font' => array('bold' => true)));
		$objPHPExcel->getActiveSheet()->getStyle($auxiliar_cel)->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->SetCellValue($auxiliar_cel,'AUXILIAR AL '.date('j \d\e F Y'));
	}
	$fi++;

	$public_saldo=0.00;
	$kgs_saldo=0.00;
	$importe_saldo=0.00;
	$pago_saldo=0.00;
	$saldo_ne=0.00;

	if($control==1) {

		$sql="select com.id_compra,com.id_periodo,serie||folio::varchar(20) as folio,com.fecha_nota,'COMPRA DE CAFÉ N.E. '||serie||folio::varchar(20) as nota,(total_kgs_netos*precio_kilo) as subtotal,
			
				(select case when sum(pr.monto_pagado) is null then 0.00 else sum(pr.monto_pagado) end
 			 	from re_pagos_realizados pr,co_ctasxpagar cxp,co_compras cm,re_aplicaciones ap where ap.idaplicacion=pr.idaplicacion and pr.estatus=true and pr.idcta_xpagar=cxp.idcta_xpagar and 
				cxp.id_compra=cm.id_compra and cm.id_compra=com.id_compra) as pagos,
			
				(total_kgs_netos*precio_kilo)-((select case when sum(monto_aplicado) is null then 0.00 else sum(monto_aplicado) end from re_aplicaciones where tipo_aplicacion='C' and tipo_movimiento='C' and estatus=true and id_compra=com.id_compra)
				+(select case when sum(monto_pagado) is null then 0.00 else sum(monto_pagado) end from re_pagos_realizados pr,co_ctasxpagar cxp,co_compras cm where pr.estatus=true and pr.idcta_xpagar=cxp.idcta_xpagar 
				and cxp.id_compra=cm.id_compra and cm.id_compra=com.id_compra)) as saldo,

				(select id_tonga from co_pesadas where id_compra=com.id_compra limit 1) as tonga,
				(select sum(bolsa)+sum(yute)+sum(henequen) from co_pesadas where id_compra=com.id_compra) as bolsas,
				serie||folio::varchar(20) as folio,total_kgs_netos,rendimiento,mancha,humedad,criba,precio_kilo,retencion_peso,
				
				(SELECT TRIM(nombre)||' '||TRIM(ap_paterno)||' '||TRIM(ap_materno) FROM cc_clientes WHERE idcliente=com.id_productor)::varchar(60) as productor,
				
				(select SUM(cr.monto_cobrado) as monto_cobrado from se_oservicios ose,re_cobros_realizados cr 
				 where ose.id_servicio=cr.id_servicio and ose.nota_asociada=com.folio and ose.id_tipo_servicio=1)::numeric(12,2) as flete,
				 
				 (select SUM(cr.monto_cobrado) as monto_cobrado from se_oservicios ose,re_cobros_realizados cr 
				 where ose.id_servicio=cr.id_servicio and ose.nota_asociada=com.folio and ose.id_tipo_servicio=2)::numeric(12,2) as maniobra,

				(select SUM(cr.monto_cobrado) as monto_cobrado from re_cobros_realizados cr,re_aplicaciones rea
				where cr.idaplicacion=rea.idaplicacion and cr.estatus=true and cr.id_secado=com.id_servicio and rea.id_compra=com.id_compra) as secado


 			from co_compras com where com.estatus=true and com.id_proveedor=' $id_cliente ' and com.id_almacen=1 and com.id_periodo='$id_periodo'
 			order by fecha_nota;";


			$consulta=pg_query($con,$sql);

		
	if(pg_num_rows($consulta)>0) {
	//____________________________________________________________________________________
	$cuenta_cel="B".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($cuenta_cel,'CUENTA');


	$fecha_cel="C".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($fecha_cel,'FECHA');



	$cheque_cel="D".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($cheque_cel,'CHEQUE');



	$concepto_col="E".$fi.":H".$fi;
	$concepto_cel="E".$fi;
	$objPHPExcel->getActiveSheet()->mergeCells($concepto_col);
	$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($concepto_col)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($concepto_col)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($concepto_col)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($concepto_cel,'CONCEPTO');

	$kgs_cel="I".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($kgs_cel,'KGS NETOS');


	$pu_cel="J".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($pu_cel,'P.U.');

	$importe_cel="K".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($importe_cel,'IMPORTE');


	$pagos_cel="L".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($pagos_cel,'PAGOS');

	$saldo_cel="M".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,'SALDOS');
	//------------------
	$cn_col="N".($fi-1).":R".($fi-1);
	$cn_cel="N".($fi-1);
	$objPHPExcel->getActiveSheet()->mergeCells($cn_col);
	$objPHPExcel->getActiveSheet()->getStyle($cn_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cn_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cn_col)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($cn_col)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($cn_col)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($cn_cel,'PAGOS EN EFECTIVOS O CON OTROS DOCUMENTOS');


	$flete_cel="N".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($flete_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($flete_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($flete_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($flete_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($flete_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($flete_cel,'FLETES');


	$maniobra_cel="O".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($maniobra_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($maniobra_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($maniobra_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($maniobra_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($maniobra_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($maniobra_cel,'MANIOBRAS');


	$secado_cel="P".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($secado_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($secado_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($secado_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($secado_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($secado_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($secado_cel,'SECADO');

	$sgag_cel="Q".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($sgag_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($sgag_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($sgag_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($sgag_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($sgag_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($sgag_cel,'SEG. AG.');


	$gtoadmin_cel="R".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($gtoadmin_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($gtoadmin_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($gtoadmin_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($gtoadmin_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($gtoadmin_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($gtoadmin_cel,'GTO. ADMVO');



	$fi++;//filas generales

	
	while($fila=pg_fetch_array($consulta))
	{
				
				$b="B".$fi;
				$c="C".$fi;
				$d="D".$fi;							
				$e="E".$fi;
				$e_merge="E".$fi.":H".$fi;
				$f="F".$fi;
				$f_merge="F".$fi.":H".$fi;
				$i="I".$fi;
				$j="J".$fi;
				$k="K".$fi;
				$l="L".$fi;
				$m="M".$fi;
				$n="N".$fi;
				$o="O".$fi;
				$p="P".$fi;
				$q="Q".$fi;
				$r="R".$fi;
				$s="S".$fi;
				$s_merge="S".$fi.":U".$fi;
				
				
				$kgs_saldo=$kgs_saldo+$fila["total_kgs_netos"];				
				$importe_saldo=$importe_saldo+round($fila["subtotal"],2);				
				
				$public_saldo=$public_saldo+round($fila["subtotal"],2);
				
				$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila["fecha_nota"]);
				
				$objPHPExcel->getActiveSheet()->mergeCells($e_merge);
				$objPHPExcel->getActiveSheet()->getStyle($e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->SetCellValue($e,$fila["nota"]);

				$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($i,$fila["total_kgs_netos"]);

				$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($j,$fila["precio_kilo"]);
				
				if($fila["precio_kilo"]==0 and $control==1) {
					$nota_sin_precio.=$fila["folio"].",";
				}
				
				$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($k,round($fila["subtotal"],2));
				
				$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($l,0.00);
				
				$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
				
				$objPHPExcel->getActiveSheet()->getStyle($n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($n)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($n,$fila["flete"]);
				
				$objPHPExcel->getActiveSheet()->getStyle($o)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($o)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($o,$fila["maniobra"]);
				
				$objPHPExcel->getActiveSheet()->getStyle($p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($p)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($p,$fila["secado"]);

				$objPHPExcel->getActiveSheet()->mergeCells($s_merge);
				$objPHPExcel->getActiveSheet()->getStyle($s)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->SetCellValue($s,$fila["productor"]);
				
				//-------------------METEREMOS LOS  PAGOS A LAS NOTAS PAGOS EN ESPECIE -----------------------------
				$id_compra=$fila["id_compra"];
				
				$objPHPExcel->getActiveSheet()->getStyle($b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->SetCellValue($b,$id_compra);
								
				
				$sql_aplica_fin="select cr.cns_pagare,'Aplicación Financiamiento '||' '||
				case when cr.cns_pagare>0 then
					(select fecha_inicio_periodo from cc_pagares where cns_pagare=cr.cns_pagare) 
					when cr.idctaxcobrar>0 then
					(select fecha from co_ctasxcobrar where idctaxcobrar=cr.idctaxcobrar)
				     when cr.id_servicio>0 then
					(select fecha_servicio from se_oservicios where id_servicio=cr.id_servicio)	
				end  as concepto,
		 	 
			
				case when
					(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,cuentas_bancarias cb,cc_pagares pg 
					where cb.idcuenta=c.idcuenta and c.idmov=pg.idmov and cns_pagare=cr.cns_pagare) is null then
					(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cajas c ,cuentas_bancarias cb,cc_pagares pg 
				where cb.idcuenta=c.idcuenta and c.idmov=pg.idmov and cns_pagare=cr.cns_pagare)
				else
					(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b,cc_pagares pg where c.idmov=pg.idmov 
					and cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
					and cns_pagare=cr.cns_pagare)||'/'||(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) 
					from cheques c ,cuentas_bancarias cb,cc_pagares pg 
					where cb.idcuenta=c.idcuenta and c.idmov=pg.idmov and cns_pagare=cr.cns_pagare)
				end as cta_fin,

		 	 
				case when 
					(select ref_cheque from cheques c,cc_pagares pg  where c.idmov=pg.idmov and cns_pagare=cr.cns_pagare) is null then
					(select ref_recibo from cajas c,cc_pagares pg  where c.idmov=pg.idmov and cns_pagare=cr.cns_pagare)
				else
					(select ref_cheque from cheques c,cc_pagares pg  where c.idmov=pg.idmov and cns_pagare=cr.cns_pagare)
				end::char(6) as cheque_fin,
			
				case when cr.cns_pagare>0 then
					(select fecha_inicio_periodo from cc_pagares where cns_pagare=cr.cns_pagare) 
			     when cr.idctaxcobrar>0 then
					(select fecha from co_ctasxcobrar where idctaxcobrar=cr.idctaxcobrar)
			     when cr.id_servicio>0 then
					(select fecha_servicio from se_oservicios where id_servicio=cr.id_servicio)	
				end as fecha_fin,
			
			
 				cr.fecha_aplicacion, sum(cr.monto_cobrado) as monto_cobrado
 			
 		        from re_aplicaciones ap,co_compras com,re_cobros_realizados cr,cc_clientes cl  
 				where cr.estatus=true and cr.idaplicacion=ap.idaplicacion and ap.estatus=true and ap.id_compra=com.id_compra 
 				and com.estatus=true and ap.tipo_movimiento='C' and com.id_compra='$id_compra' and cr.cns_pagare>0 
 				and com.id_proveedor=cl.idcliente 
 				group by com.id_compra,cns_pagare,cr.idctaxcobrar,cr.id_servicio,cr.fecha_aplicacion  order by cr.fecha_aplicacion";				
				
				$consulta_ap_fin=pg_query($con,$sql_aplica_fin);
				while($fila_ap_fin=pg_fetch_array($consulta_ap_fin))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						$n="N".$fi;
						$o="O".$fi;
						$p="P".$fi;
						$q="Q".$fi;
						$r="R".$fi;
						$s="S".$fi;
						$s_merge="S".$fi.":U".$fi;	
						
						$public_saldo=$public_saldo-$fila_ap_fin["monto_cobrado"];
						$pago_saldo=$pago_saldo+$fila_ap_fin["monto_cobrado"];						
						
						$objPHPExcel->getActiveSheet()->getStyle($b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($b,$fila_ap_fin["cta_fin"]);
						

						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_ap_fin["fecha_aplicacion"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($d,$fila_ap_fin["cheque_fin"]);
				
						$objPHPExcel->getActiveSheet()->mergeCells($f_merge);
						$objPHPExcel->getActiveSheet()->getStyle($f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($f,$fila_ap_fin["concepto"]);
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,0.00);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,$fila_ap_fin["monto_cobrado"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						
											
				}
				
				
				$sql_aplica_ant="select cr.idctaxcobrar,'Aplicación Anticipo '||(select fecha from co_ctasxcobrar where idctaxcobrar=cr.idctaxcobrar) as concepto,
		 	 
		 	 		case when
						(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,cuentas_bancarias cb,co_ctasxcobrar cxc 
						where cb.idcuenta=c.idcuenta and c.idmov=cxc.idmov and idctaxcobrar=cr.idctaxcobrar) is null then
						(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cajas c ,cuentas_bancarias cb,co_ctasxcobrar cxc 
						where cb.idcuenta=c.idcuenta and c.idmov=cxc.idmov and idctaxcobrar=cr.idctaxcobrar)
					else
						(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b,co_ctasxcobrar cxc where c.idmov=cxc.idmov and cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
						and idctaxcobrar=cr.idctaxcobrar)||'/'||(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,cuentas_bancarias cb,co_ctasxcobrar cxc 
						where cb.idcuenta=c.idcuenta and c.idmov=cxc.idmov and idctaxcobrar=cr.idctaxcobrar)	
					end as cta_ant,

					case when 	
						(select ref_cheque from cheques c,co_ctasxcobrar cxc  where c.idmov=cxc.idmov and cxc.idctaxcobrar=cr.idctaxcobrar) is null then
						(select ref_recibo from cajas c,co_ctasxcobrar cxc  where c.idmov=cxc.idmov and cxc.idctaxcobrar=cr.idctaxcobrar)
					else
						(select ref_cheque from cheques c,co_ctasxcobrar cxc  where c.idmov=cxc.idmov and cxc.idctaxcobrar=cr.idctaxcobrar)
					end::char(6) as cheque_ant,
			
					cr.fecha_aplicacion, cr.monto_cobrado,com.id_periodo,cl.deuda_cero,ap.tipo_movimiento
 		        	from re_aplicaciones ap,co_compras com,re_cobros_realizados cr,cc_clientes cl  
 					where cr.estatus=true and cr.idaplicacion=ap.idaplicacion and ap.estatus=true and ap.id_compra=com.id_compra 
 					and com.estatus=true and ap.tipo_movimiento='C' and com.id_compra='$id_compra' and  cr.idctaxcobrar>0 
 					and com.id_proveedor=cl.idcliente order by cr.fecha_aplicacion";
				
				$consulta_ap_ant=pg_query($con,$sql_aplica_ant);

				while($fila_ap_ant=pg_fetch_array($consulta_ap_ant))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						$n="N".$fi;
						$o="O".$fi;
						$p="P".$fi;
						$q="Q".$fi;
						$r="R".$fi;
						$s="S".$fi;
						$s_merge="S".$fi.":U".$fi;	
						
						$public_saldo=$public_saldo-$fila_ap_ant["monto_cobrado"];
						$pago_saldo=$pago_saldo+$fila_ap_ant["monto_cobrado"];						
						
						$objPHPExcel->getActiveSheet()->getStyle($b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($b,$fila_ap_ant["cta_ant"]);
						

						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_ap_ant["fecha_aplicacion"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($d,$fila_ap_ant["cheque_ant"]);
				
						$objPHPExcel->getActiveSheet()->mergeCells($f_merge);
						$objPHPExcel->getActiveSheet()->getStyle($f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($f,$fila_ap_ant["concepto"]);
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,0.00);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,$fila_ap_ant["monto_cobrado"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						
											
				}
			
				$sql_aplica_serv="select cr.id_servicio,'Aplicación Servicio - '|| 
		 	 	case when (select upper(nom_servicio) from se_oservicios oc,se_nombre_servicios ns where ns.id_tipo_servicio=oc.id_tipo_servicio 
					and oc.id_servicio=cr.id_servicio) is null then 'SS' else
					(select upper(nom_servicio) from se_oservicios oc,se_nombre_servicios ns where ns.id_tipo_servicio=oc.id_tipo_servicio 
					and oc.id_servicio=cr.id_servicio) end::varchar(10)||' '||
				case when cr.cns_pagare>0 then
					(select fecha_inicio_periodo from cc_pagares where cns_pagare=cr.cns_pagare) 
					when cr.idctaxcobrar>0 then
					(select fecha from co_ctasxcobrar where idctaxcobrar=cr.idctaxcobrar)
					when cr.id_servicio>0 then
					(select fecha_servicio from se_oservicios where id_servicio=cr.id_servicio)	
				end as concepto,

				cr.id_secado,cr.id_retencion,cr.fecha_aplicacion, cr.monto_cobrado,com.id_periodo,cl.deuda_cero,ap.tipo_movimiento
 		        from re_aplicaciones ap,co_compras com,re_cobros_realizados cr,cc_clientes cl  
 				where cr.estatus=true and cr.idaplicacion=ap.idaplicacion and ap.estatus=true and ap.id_compra=com.id_compra 
 				and com.estatus=true and ap.tipo_movimiento='C' and com.id_compra='$id_compra' and cr.id_servicio>0 
 				and com.id_proveedor=cl.idcliente order by cr.fecha_aplicacion ";
				
				$consulta_ap_serv=pg_query($con,$sql_aplica_serv);

				while($fila_ap_serv=pg_fetch_array($consulta_ap_serv))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						$n="N".$fi;
						$o="O".$fi;
						$p="P".$fi;
						$q="Q".$fi;
						$r="R".$fi;
						$s="S".$fi;
						$s_merge="S".$fi.":U".$fi;	
						
						$public_saldo=$public_saldo-$fila_ap_serv["monto_cobrado"];
						$pago_saldo=$pago_saldo+$fila_ap_serv["monto_cobrado"];
						
						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_ap_serv["fecha_aplicacion"]);
						
						$objPHPExcel->getActiveSheet()->mergeCells($f_merge);
						$objPHPExcel->getActiveSheet()->getStyle($f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($f,$fila_ap_serv["concepto"]);
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,0.00);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,$fila_ap_serv["monto_cobrado"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						
											
				}
			
				$sql_aplica_sec="select cr.id_servicio,'Aplicación Secado ' as concepto,

				cr.id_secado,cr.id_retencion,cr.fecha_aplicacion, cr.monto_cobrado,com.id_periodo,cl.deuda_cero,ap.tipo_movimiento
 		        from re_aplicaciones ap,co_compras com,re_cobros_realizados cr,cc_clientes cl  
 				where cr.estatus=true and cr.idaplicacion=ap.idaplicacion and ap.estatus=true and ap.id_compra=com.id_compra 
 				and com.estatus=true and ap.tipo_movimiento='C' and com.id_compra='$id_compra' and cr.id_secado>0 
 				and com.id_proveedor=cl.idcliente order by cr.fecha_aplicacion ";
				
				$consulta_ap_sec=pg_query($con,$sql_aplica_sec);

				while($fila_ap_sec=pg_fetch_array($consulta_ap_sec))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						$n="N".$fi;
						$o="O".$fi;
						$p="P".$fi;
						$q="Q".$fi;
						$r="R".$fi;
						$s="S".$fi;
						$s_merge="S".$fi.":U".$fi;	
						
						$public_saldo=$public_saldo-$fila_ap_sec["monto_cobrado"];
						$pago_saldo=$pago_saldo+$fila_ap_sec["monto_cobrado"];
						
						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_ap_sec["fecha_aplicacion"]);
						
						$objPHPExcel->getActiveSheet()->mergeCells($f_merge);
						$objPHPExcel->getActiveSheet()->getStyle($f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($f,$fila_ap_sec["concepto"]);
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,0.00);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,$fila_ap_sec["monto_cobrado"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						
											
				}
				
				$sql_aplica_ret="select cr.id_servicio,'Aplicación Retención ' as concepto,

				cr.id_secado,cr.id_retencion,cr.fecha_aplicacion, cr.monto_cobrado,com.id_periodo,cl.deuda_cero,ap.tipo_movimiento
 		        from re_aplicaciones ap,co_compras com,re_cobros_realizados cr,cc_clientes cl  
 				where cr.estatus=true and cr.idaplicacion=ap.idaplicacion and ap.estatus=true and ap.id_compra=com.id_compra 
 				and com.estatus=true and ap.tipo_movimiento='C' and com.id_compra='$id_compra' and cr.id_retencion>0   
 				and com.id_proveedor=cl.idcliente order by cr.fecha_aplicacion ";
				
				$consulta_ap_ret=pg_query($con,$sql_aplica_ret);

				while($fila_ap_ret=pg_fetch_array($consulta_ap_ret))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						$n="N".$fi;
						$o="O".$fi;
						$p="P".$fi;
						$q="Q".$fi;
						$r="R".$fi;
						$s="S".$fi;
						$s_merge="S".$fi.":U".$fi;	
						
						$public_saldo=$public_saldo-$fila_ap_ret["monto_cobrado"];
						$pago_saldo=$pago_saldo+$fila_ap_ret["monto_cobrado"];						
						
						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_ap_ret["fecha_aplicacion"]);
						
						$objPHPExcel->getActiveSheet()->mergeCells($f_merge);
						$objPHPExcel->getActiveSheet()->getStyle($f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($f,$fila_ap_ret["concepto"]);
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,0.00);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,$fila_ap_ret["monto_cobrado"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						
											
				}				
				
				
				$sql_pago_nota="select cm.id_compra,ap.fecha_aplicacion,case tipo_movimiento when 'H' then 'PAGO CON CHEQUE' when 'E' then 'PAGO EN EFECTIVO' 
				when 'T' then 'PAGO CON TRANSFERENCIA' END as concepto,
		 	
		 		case tipo_movimiento when 'E' then
					(select substr(num_cuenta,1,5) from cajas c ,cuentas_bancarias cb 
					where cb.idcuenta=c.idcuenta and c.idmov=ap.referencia::integer)
				else
					(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b where cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
					and c.idmov=ap.referencia::integer)||'/'||(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,
					cuentas_bancarias cb 
					where cb.idcuenta=c.idcuenta and c.idmov=ap.referencia::integer)
		 		end  as cuenta,
			
				case tipo_movimiento when 'E' then
					(select ref_recibo from cajas c  where c.idmov=ap.referencia::integer)::char(6) 
				else
					(select ref_cheque from cheques c  where c.idmov=ap.referencia::integer)::char(6) 
				end as cheque,
				pr.monto_pagado
				from re_aplicaciones ap,re_pagos_realizados pr,co_ctasxpagar cxp,co_compras cm
				where pr.estatus=true and cm.estatus=true and ap.idaplicacion=pr.idaplicacion and pr.idcta_xpagar=cxp.idcta_xpagar 
				and cxp.id_compra=cm.id_compra and cm.id_compra='$id_compra' order by ap.fecha_aplicacion";
				
				$consulta_pago_nota=pg_query($con,$sql_pago_nota);

				while($fila_pago_nota=pg_fetch_array($consulta_pago_nota))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						$n="N".$fi;
						$o="O".$fi;
						$p="P".$fi;
						$q="Q".$fi;
						$r="R".$fi;
						$s="S".$fi;
						$s_merge="S".$fi.":U".$fi;	
						
						$public_saldo=$public_saldo-$fila_pago_nota["monto_pagado"];
						$pago_saldo=$pago_saldo+$fila_pago_nota["monto_pagado"];						
						
						$objPHPExcel->getActiveSheet()->getStyle($b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($b,$fila_pago_nota["cuenta"]);
						

						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_pago_nota["fecha_aplicacion"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($d,$fila_pago_nota["cheque"]);
						
						$objPHPExcel->getActiveSheet()->mergeCells($f_merge);
						$objPHPExcel->getActiveSheet()->getStyle($f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($f,$fila_pago_nota["concepto"]);
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,0.00);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,$fila_pago_nota["monto_pagado"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						
											
				}		
			
				$fi++;//filas generales	
			
	

	
	}

	
	
	//OBTERNER SALDOS
	$saldo_col="E".$fi.":H".$fi;
	$saldo_cel="E".$fi;
	$objPHPExcel->getActiveSheet()->mergeCells($saldo_col);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,'SALDOS ===>');
				
	$saldo_kgs="I".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$kgs_saldo);		
	
	$saldo_kgs="K".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$importe_saldo);					

	$saldo_kgs="L".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$pago_saldo);		
	
	$saldo_kgs="M".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$importe_saldo-$pago_saldo);		

	$saldo_ne=$importe_saldo-$pago_saldo;
//	AGREGAR FINANCIAMIENTOS,ANTICIPOS,FLETES Y SECADO

  } //fin de validra si tiene registros de aplicacion de notas	
} //fin del if que valida que solo presente nota del periodo activo
$fi+=2; 
	//____________________________________________________________________________________
	//AQUI ENCONTRARAS TODOS LOS SQL DE FINANCIAMIENTO,ANTICIPOS,SECADO,SERVICIO
	if($control==1) {
			$sql_financiamiento="select pg.cns_pagare,
		 	
		 		case when 
					(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,cuentas_bancarias cb where cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov) is null then
					(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cajas c ,cuentas_bancarias cb where cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov)
				else
					(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,cuentas_bancarias cb where cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov) 
				end::varchar(5) as cuenta,
				
				case when 
					(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b where cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov) is null then
					'CAJA'
				else
					(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b where cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov)
				end::varchar(5) as banco,
			
				case when (select ref_cheque from cheques c  where c.idmov=pg.idmov) is null then 
					(select ref_recibo from cajas c  where c.idmov=pg.idmov) 
				else
					(select ref_cheque from cheques c  where c.idmov=pg.idmov) 
				end::varchar(10) as cheque,
				
		 	pg.fecha_inicio_periodo as fecha,pg.capital as monto,
		 	
		 		(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end from re_cobros_realizados cbr 
				where cbr.estatus=true and cbr.cns_pagare=pg.cns_pagare) as monto_cobrado,
			
				(select case when sum(case when id_cargo_pagare=1 then cbr.monto_cobrado else 0 end) is null then 0.00 else
				sum(case when id_cargo_pagare=1 then cbr.monto_cobrado else 0 end) end
				 
				from re_cobros_realizados cbr 
				where cbr.estatus=true and cbr.cns_pagare=pg.cns_pagare) as interes_cobrado,

				(select sum(interes) from calculo_interes_especial(cl.idcliente,now()::date,cr.id_sucursal,cr.id_periodo) AS 
				(fecha_disposicion date,fecha_corte date,fecha_vencimiento date,cns_pagare integer,idcredito integer,
				pago_realizado numeric(16,2),capital_financiado numeric(16,2),interes numeric(16,2),pago numeric(16,2),taza_interes numeric(6,2),
				dias_periodo int,idcargo integer) where cns_pagare=pg.cns_pagare) as interes_generado
			
			from cc_pagares pg,cc_creditos cr,cc_solicitudes s,cc_clientes cl 
			where not pg.cancelado and pg.idcredito=cr.idcredito and cr.idsolicitud=s.idsolicitud and s.idcliente=cl.idcliente 
			and cl.idcliente='$id_cliente' and cr.id_periodo='$id_periodo'
			order by fecha;";
			
			$sql_anticipo="select cxc.idctaxcobrar,(select  case when folio is null then ' ' else ' N:'||folio end::varchar(10) 
					from co_compras where id_compra=ca.id_compra) as nota,
		 			(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,cuentas_bancarias cb 
		 			 where cb.idcuenta=c.idcuenta and c.idmov=cxc.idmov) as cuenta,
		 			 
		 			 case when 
						(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b where cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
						and c.idmov=cxc.idmov) is null then
						'CAJA'
					else
						(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b where cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
						and c.idmov=cxc.idmov)
					end::varchar(5) as banco,
			
					(select ref_cheque from cheques c  where c.idmov=cxc.idmov)::char(6) as cheque,cxc.fecha,cxc.monto,
			
					(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end as pago
					from re_cobros_realizados cbr,co_ctasxcobrar cxcb,cc_cheques_anticipos ca 
					where cbr.estatus=true and cbr.idctaxcobrar=cxcb.idctaxcobrar and cxcb.idmov=ca.idmov and cxcb.idctaxcobrar=cxc.idctaxcobrar) 
					as pago,
 			
 					cxc.monto-(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end as pago
					from re_cobros_realizados cbr,co_ctasxcobrar cxcb,cc_cheques_anticipos ca where cbr.estatus=true and cbr.idctaxcobrar=cxcb.idctaxcobrar 
 					and cxcb.idmov=ca.idmov and cxcb.idctaxcobrar=cxc.idctaxcobrar) as saldo,
 					
 					(SELECT TRIM(nombre)||' '||TRIM(ap_paterno)||' '||TRIM(ap_materno) FROM cc_clientes WHERE idcliente=ca.idproductor)::varchar(60) as productor
 					
 				from co_ctasxcobrar cxc,cc_cheques_anticipos ca,cheques ch where not ch.ch_cancelado and ch.idmov=ca.idmov 
 				and cxc.idmov=ca.idmov and ca.idcliente='$id_cliente' and  cxc.id_periodo='$id_periodo'
 				order by cxc.fecha;";
 				
 				$sql_servicio="select sv.id_servicio,sv.fecha_servicio,(select case when nota_asociada is null then '' else ' '||nota_asociada end::varchar(10) 
				from se_oservicios where id_servicio=sv.id_servicio) as nota,
		 		(select UPPER(nom_servicio) from se_nombre_servicios where id_tipo_servicio=ns.id_tipo_servicio)::char(20) as descripcion,
		 		
		 		total as monto,
		 	
		 		(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end
				from se_oservicios svb,re_cobros_realizados cbr 
				where cbr.estatus=true and svb.id_servicio=cbr.id_servicio and svb.id_servicio=sv.id_servicio) as pago
			 
		 		from se_oservicios sv, se_nombre_servicios ns 
				where sv.id_tipo_servicio=ns.id_tipo_servicio and sv.idcliente='$id_cliente' and sv.id_periodo='$id_periodo'
				order by sv.fecha_servicio;";
				
				$sql_secado="select S.id_servicio,fecha_servicio,'SECADO'::varchar(20) as concepto,costo_kgsalida*total_kgs_netos as monto,
		 		(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end
				from se_servicios sc,re_cobros_realizados cbr,re_aplicaciones ap where ap.idaplicacion=cbr.idaplicacion 
				and cbr.estatus=true and sc.id_servicio=cbr.id_secado and sc.id_servicio=s.id_servicio  and ap.id_compra=cm.id_compra) as pagos,
		 		' N:'||cm.folio::char(10) as nota  
				from co_compras cm,se_servicios s 
				where cm.estatus=true and cm.id_servicio=s.id_servicio and cm.id_proveedor='$id_cliente' and cm.id_periodo='$id_periodo'  order by fecha_servicio";

	}else {
			$sql_financiamiento="select pg.cns_pagare,
		 	
		 		case when 
					(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,cuentas_bancarias cb where cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov) is null then
					(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cajas c ,cuentas_bancarias cb where cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov)
				else
					(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,cuentas_bancarias cb where cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov) 
				end::varchar(5) as cuenta,
				
				case when 
					(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b where cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov) is null then
					'CAJA'
				else
					(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b where cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
					and c.idmov=pg.idmov)
				end::varchar(5) as banco,
			
				case when (select ref_cheque from cheques c  where c.idmov=pg.idmov) is null then 
					(select ref_recibo from cajas c  where c.idmov=pg.idmov) 
				else
					(select ref_cheque from cheques c  where c.idmov=pg.idmov) 
				end::varchar(10) as cheque,
				
		 	pg.fecha_inicio_periodo as fecha,pg.capital as monto,
		 	
		 		(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end from re_cobros_realizados cbr 
				where cbr.estatus=true and cbr.cns_pagare=pg.cns_pagare) as monto_cobrado,
			
				(select case when sum(case when id_cargo_pagare=1 then cbr.monto_cobrado else 0 end) is null then 0.00 else
				sum(case when id_cargo_pagare=1 then cbr.monto_cobrado else 0 end) end
				 
				from re_cobros_realizados cbr 
				where cbr.estatus=true and cbr.cns_pagare=pg.cns_pagare) as interes_cobrado,

				(select sum(interes) from calculo_interes_especial(cl.idcliente,now()::date,cr.id_sucursal,cr.id_periodo) AS 
				(fecha_disposicion date,fecha_corte date,fecha_vencimiento date,cns_pagare integer,idcredito integer,
				pago_realizado numeric(16,2),capital_financiado numeric(16,2),interes numeric(16,2),pago numeric(16,2),taza_interes numeric(6,2),
				dias_periodo int,idcargo integer) where cns_pagare=pg.cns_pagare) as interes_generado
			
			from cc_pagares pg,cc_creditos cr,cc_solicitudes s,cc_clientes cl 
			where not pg.cancelado and pg.idcredito=cr.idcredito and cr.idsolicitud=s.idsolicitud and s.idcliente=cl.idcliente 
			and cl.idcliente='$id_cliente' and cr.id_periodo='$id_periodo' and (select deuda_cero from cc_clientes where idcliente=cl.idcliente)=false and
			(
				(pg.capital
				+
				(select sum(interes) from calculo_interes_especial(cl.idcliente,now()::date,cr.id_sucursal,cr.id_periodo) AS 
				(fecha_disposicion date,fecha_corte date,fecha_vencimiento date,cns_pagare integer,idcredito integer,
				pago_realizado numeric(16,2),capital_financiado numeric(16,2),interes numeric(16,2),pago numeric(16,2),taza_interes numeric(6,2),
				dias_periodo int,idcargo integer) where cns_pagare=pg.cns_pagare)
				)-
				((select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end from re_cobros_realizados cbr 
				where cbr.estatus=true and cbr.cns_pagare=pg.cns_pagare)+
			
				(select case when sum(case when id_cargo_pagare=1 then cbr.monto_cobrado else 0 end) is null then 0.00 else
				sum(case when id_cargo_pagare=1 then cbr.monto_cobrado else 0 end) end
				 
				from re_cobros_realizados cbr 
				where cbr.estatus=true and cbr.cns_pagare=pg.cns_pagare)) 	
			) >0.50
			order by fecha;";
			
			$sql_anticipo="select cxc.idctaxcobrar,(select  case when folio is null then ' ' else ' N:'||folio end::varchar(10) 
					from co_compras where id_compra=ca.id_compra) as nota,
		 			(select substr(cb.num_cuenta,length(trim(cb.num_cuenta))-3,4) from cheques c ,cuentas_bancarias cb 
		 			 where cb.idcuenta=c.idcuenta and c.idmov=cxc.idmov) as cuenta,
		 			 
		 			 case when 
						(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b where cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
						and c.idmov=cxc.idmov) is null then
						'CAJA'
					else
						(select substr(b.nombre_banco,1,4) from cheques c ,cuentas_bancarias cb,bancos b where cb.idbanco=b.idbanco and cb.idcuenta=c.idcuenta 
						and c.idmov=cxc.idmov)
					end::varchar(5) as banco,
			
					(select ref_cheque from cheques c  where c.idmov=cxc.idmov)::char(6) as cheque,cxc.fecha,cxc.monto,
			
					(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end as pago
					from re_cobros_realizados cbr,co_ctasxcobrar cxcb,cc_cheques_anticipos ca 
					where cbr.estatus=true and cbr.idctaxcobrar=cxcb.idctaxcobrar and cxcb.idmov=ca.idmov and cxcb.idctaxcobrar=cxc.idctaxcobrar) 
					as pago,
 			
 					cxc.monto-(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end as pago
					from re_cobros_realizados cbr,co_ctasxcobrar cxcb,cc_cheques_anticipos ca where cbr.estatus=true and cbr.idctaxcobrar=cxcb.idctaxcobrar 
 					and cxcb.idmov=ca.idmov and cxcb.idctaxcobrar=cxc.idctaxcobrar) as saldo,
 					
 					(SELECT TRIM(nombre)||' '||TRIM(ap_paterno)||' '||TRIM(ap_materno) FROM cc_clientes WHERE idcliente=ca.idproductor)::varchar(60) as productor
 					
 				from co_ctasxcobrar cxc,cc_cheques_anticipos ca,cheques ch where not ch.ch_cancelado and ch.idmov=ca.idmov 
 				and cxc.idmov=ca.idmov and ca.idcliente='$id_cliente' and  cxc.id_periodo='$id_periodo'
 				and (select deuda_cero from cc_clientes where idcliente=ca.idcliente)=false and
 				cxc.monto-(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end as pago
				from re_cobros_realizados cbr,co_ctasxcobrar cxcb,cc_cheques_anticipos ca where cbr.estatus=true and cbr.idctaxcobrar=cxcb.idctaxcobrar 
 				and cxcb.idmov=ca.idmov and cxcb.idctaxcobrar=cxc.idctaxcobrar)>0.50
 				order by cxc.fecha;";
 				
 				$sql_servicio="select sv.id_servicio,sv.fecha_servicio,(select case when nota_asociada is null then '' else ' '||nota_asociada end::varchar(10) 
				from se_oservicios where id_servicio=sv.id_servicio) as nota,
		 		(select UPPER(nom_servicio) from se_nombre_servicios where id_tipo_servicio=ns.id_tipo_servicio)::char(20) as descripcion,
		 		
		 		total as monto,
		 	
		 		(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end
				from se_oservicios svb,re_cobros_realizados cbr 
				where cbr.estatus=true and svb.id_servicio=cbr.id_servicio and svb.id_servicio=sv.id_servicio) as pago
			 
		 		from se_oservicios sv, se_nombre_servicios ns 
				where sv.id_tipo_servicio=ns.id_tipo_servicio and sv.idcliente='$id_cliente' and sv.id_periodo='$id_periodo'
					
				and (select deuda_cero from cc_clientes where idcliente=sv.idcliente)=false and
				(total-(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end
				from se_oservicios svb,re_cobros_realizados cbr 
				where cbr.estatus=true and svb.id_servicio=cbr.id_servicio and svb.id_servicio=sv.id_servicio))>0.50
				
				order by sv.fecha_servicio;";
				
				$sql_secado="select S.id_servicio,fecha_servicio,'SECADO'::varchar(20) as concepto,costo_kgsalida*total_kgs_netos as monto,
		 		(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end
				from se_servicios sc,re_cobros_realizados cbr,re_aplicaciones ap where ap.idaplicacion=cbr.idaplicacion 
				and cbr.estatus=true and sc.id_servicio=cbr.id_secado and sc.id_servicio=s.id_servicio  and ap.id_compra=cm.id_compra) as pagos,
		 		' N:'||cm.folio::char(10) as nota  
				from co_compras cm,se_servicios s 
				where cm.estatus=true and cm.id_servicio=s.id_servicio and cm.id_proveedor='$id_cliente' and cm.id_periodo='$id_periodo'  
				
				and (select deuda_cero from cc_clientes where idcliente=cm.id_proveedor)=false and
				(costo_kgsalida*total_kgs_netos)-
				(select case when sum(cbr.monto_cobrado) is null then 0.00 else sum(cbr.monto_cobrado) end
				from se_servicios sc,re_cobros_realizados cbr,re_aplicaciones ap where ap.idaplicacion=cbr.idaplicacion 
				and cbr.estatus=true and sc.id_servicio=cbr.id_secado and sc.id_servicio=s.id_servicio  and ap.id_compra=cm.id_compra)>0.50
				
				order by fecha_servicio";

	
	}

//inicializa variable de financiamiento,anticipo,secado y servicio es esta parte porque si no hay registro no entrara 
$public_saldo=0.00;			
$intcob_saldo=0.00;
$intpen_saldo=0.00;
$total_saldo=0.00;
$pagos_saldo=0.00;
$monto_saldo=0.00;

if(pg_num_rows(pg_query($con,$sql_financiamiento))>0 or pg_num_rows(pg_query($con,$sql_anticipos))>0 or pg_num_rows(pg_query($con,$sql_servicio))>0 or pg_num_rows(pg_query($con,$sql_secado))>0 ) {

	$cuenta_cel="B".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($cuenta_cel,'CUENTA');


	$fecha_cel="C".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($fecha_cel,'FECHA');



	$cheque_cel="D".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($cheque_cel,'CHEQUE');



	$concepto_col="E".$fi.":H".$fi;
	$concepto_cel="E".$fi;
	$objPHPExcel->getActiveSheet()->mergeCells($concepto_col);
	$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($concepto_col)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($concepto_col)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($concepto_col)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($concepto_cel,'CONCEPTO');

	$kgs_cel="I".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($kgs_cel,'IMPORTE');


	$pu_cel="J".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($pu_cel,'INT. COBRADO');

	$importe_cel="K".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($importe_cel,'PAGOS');


	$pagos_cel="L".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($pagos_cel,'INT. PEN.');

	$saldo_cel="M".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,'SALDO');

		
			$consulta_fin=pg_query($con,$sql_financiamiento);

				while($fila_fin=pg_fetch_array($consulta_fin))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						
						$public_saldo=$fila_fin["monto"]+$fila_fin["interes_generado"]-$fila_fin["monto_cobrado"];
						
						$monto_saldo=$monto_saldo+$fila_fin["monto"];		
						$total_saldo=$total_saldo+$public_saldo;
						$pagos_saldo=$pagos_saldo+$fila_fin["monto_cobrado"];					
						
						$objPHPExcel->getActiveSheet()->getStyle($b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($b,$fila_fin["banco"].'/'.$fila_fin["cuenta"]);
						

						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_fin["fecha"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($d,$fila_fin["cheque"]);
						
						$objPHPExcel->getActiveSheet()->mergeCells($e_merge);
						$objPHPExcel->getActiveSheet()->getStyle($e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($e,"Financiamiento");
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,$fila_fin["monto"]);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,$fila_fin["interes_cobrado"]);
						
						$intcob_saldo=$intcob_saldo+$fila_fin["interes_cobrado"];
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,$fila_fin["monto_cobrado"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,$fila_fin["interes_generado"]);
						
						$intpen_saldo=$intpen_saldo+($fila_fin["interes_generado"]-$fila_fin["interes_cobrado"]);
			
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						
					
											
				}		
			
				
				
				$consulta_ant=pg_query($con,$sql_anticipo);

				while($fila_ant=pg_fetch_array($consulta_ant))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						$n="N".$fi;
						$n_merge="N".$fi.":P".$fi;
						$public_saldo=$fila_ant["monto"]-$fila_ant["pago"];
						
						$monto_saldo=$monto_saldo+$fila_ant["monto"];
						$total_saldo=$total_saldo+$public_saldo;						
						$pagos_saldo=$pagos_saldo+$fila_ant["pago"];							
						
						$objPHPExcel->getActiveSheet()->getStyle($b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($b,$fila_ant["banco"].'/'.$fila_ant["cuenta"]);
						

						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_ant["fecha"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($d,$fila_ant["cheque"]);
						
						$objPHPExcel->getActiveSheet()->mergeCells($e_merge);
						$objPHPExcel->getActiveSheet()->getStyle($e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($e,"ANTICIPO ".$fila_ant["nota"]);
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,$fila_ant["monto"]);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,$fila_ant["pago"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,0.00);
			
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						$objPHPExcel->getActiveSheet()->mergeCells($n_merge);
						$objPHPExcel->getActiveSheet()->getStyle($n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($n,empty($fila_ant["productor"])?$fila_cliente["nombre"].' '.$fila_cliente["ap_paterno"].' '.$fila_cliente["ap_materno"]:$fila_ant["productor"]);
						
											
				}

				
				
				$consulta_serv=pg_query($con,$sql_servicio);

				while($fila_ser=pg_fetch_array($consulta_serv))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						
						$public_saldo=$fila_ser["monto"]-$fila_ser["pago"];
						
						$monto_saldo=$monto_saldo+$fila_ser["monto"];
						$total_saldo=$total_saldo+$public_saldo;						
						$pagos_saldo=$pagos_saldo+$fila_ser["pago"];							
						
						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_ser["fecha_servicio"]);
						
						$objPHPExcel->getActiveSheet()->mergeCells($e_merge);
						$objPHPExcel->getActiveSheet()->getStyle($e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($e,$fila_ser["descripcion"]." ".$fila_ser["nota"]);
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,$fila_ser["monto"]);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,$fila_ser["pago"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,0.00);
			
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						
											
				}


				$consulta_secado=pg_query($con,$sql_secado);

				while($fila_sec=pg_fetch_array($consulta_secado))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$e_merge="E".$fi.":H".$fi;
						$f="F".$fi;
						$f_merge="F".$fi.":H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						
						$public_saldo=$fila_sec["monto"]-$fila_sec["pagos"];
						
						$monto_saldo=$monto_saldo+$fila_sec["monto"];
						$total_saldo=$total_saldo+$public_saldo;
						$pagos_saldo=$pagos_saldo+$fila_sec["pagos"];						
						
						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_sec["fecha_servicio"]);
						
						$objPHPExcel->getActiveSheet()->mergeCells($e_merge);
						$objPHPExcel->getActiveSheet()->getStyle($e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($e,$fila_sec["concepto"]." ".$fila_sec["nota"]);
	
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,$fila_sec["monto"]);

						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,0.00);
				
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,$fila_sec["pagos"]);
				
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,0.00);
			
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$public_saldo);
						
						
											
				}
			
			
	$fi++;
				
	//OBTERNER SALDOS
	$saldo_col="E".$fi.":H".$fi;
	$saldo_cel="E".$fi;
	$objPHPExcel->getActiveSheet()->mergeCells($saldo_col);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,'SALDOS ===>');
				
	$saldo_kgs="I".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$monto_saldo);		
		
	$saldo_kgs="J".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$intcob_saldo);		
	
	$saldo_kgs="K".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$pagos_saldo);					

	$saldo_kgs="L".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$intpen_saldo);		
	
	$saldo_kgs="M".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$total_saldo);
	
	
		
	
	
	
	//**********************************************************************
	//		TABLA  DE COMPRAS
} //fin del if si tiene filas
	
	//  AQUI VA TODA EL SALDO
	
	//aQUI VAMOS A VALIDAR SI NO HAY SALDO DE NOTAS QUE NO SALGA
	if($saldo_ne>0 or $control==1) {
		$fi++;
		
		$saldo_col="E".$fi.":L".$fi;	
		$saldo_kgs="E".$fi;
		$objPHPExcel->getActiveSheet()->mergeCells($saldo_col);	
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
		$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->applyFromArray($borders); //PINTAMOS LOS BORDES
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,"(-) MENOS NOTA(S) DE ENTRADA CON VALOR DE: $ ============>");	
		
		$saldo_kgs="M".$fi;
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$saldo_ne);
	
		$fi++;
	
		$saldo_col="E".$fi.":L".$fi;	
		$saldo_kgs="E".$fi;
		$objPHPExcel->getActiveSheet()->mergeCells($saldo_col);	
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
		$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->applyFromArray($borders); //PINTAMOS LOS BORDES
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,"DEUDA DEL CLIENTE, COSECHA ACTUAL ==>");

	
		$saldo_kgs="M".$fi;
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$total_saldo-$saldo_ne);
	}

	if($fila_cosecha["activo"]=='t') {
		//grabar posicion para hacer la liquidacion
		$fi_liquida=$fi;
		$deuda_cosecha_actual=$total_saldo-$saldo_ne;	
		
		
	}else {
		//llevar registro de deuda
		$total_deuda_global=$total_deuda_global+($total_saldo-$saldo_ne);	
	}

	$fi+=11;
	if($control==1) {
			$sql_compras="select com.id_compra,com.id_periodo,com.fecha_nota,'COMPRA DE CAFÉ N.E. '||serie||folio::varchar(20) as nota,(total_kgs_netos*precio_kilo) as subtotal,
			
				(select case when sum(pr.monto_pagado) is null then 0.00 else sum(pr.monto_pagado) end
 			 	from re_pagos_realizados pr,co_ctasxpagar cxp,co_compras cm,re_aplicaciones ap where ap.idaplicacion=pr.idaplicacion and pr.estatus=true and pr.idcta_xpagar=cxp.idcta_xpagar and 
				cxp.id_compra=cm.id_compra and cm.id_compra=com.id_compra) as pagos,
			
				(total_kgs_netos*precio_kilo)-((select case when sum(monto_aplicado) is null then 0.00 else sum(monto_aplicado) end from re_aplicaciones where tipo_aplicacion='C' and tipo_movimiento='C' and estatus=true and id_compra=com.id_compra)
				+(select case when sum(monto_pagado) is null then 0.00 else sum(monto_pagado) end from re_pagos_realizados pr,co_ctasxpagar cxp,co_compras cm where pr.estatus=true and pr.idcta_xpagar=cxp.idcta_xpagar 
				and cxp.id_compra=cm.id_compra and cm.id_compra=com.id_compra)) as saldo,

				(select id_tonga from co_pesadas where id_compra=com.id_compra limit 1) as tonga,
				(select sum(bolsa)+sum(yute)+sum(henequen) from co_pesadas where id_compra=com.id_compra) as bolsas,
				serie||folio::varchar(20) as folio,total_kgs_netos,rendimiento,mancha,humedad,criba,precio_kilo,retencion_peso,
				
				(SELECT TRIM(nombre)||' '||TRIM(ap_paterno)||' '||TRIM(ap_materno) FROM cc_clientes WHERE idcliente=com.id_productor)::varchar(60) as productor
				,(total_kgs_netos*rendimiento)/100 as p1,(((total_kgs_netos*rendimiento)/100)*humedad)/100 as p2,
				(total_kgs_netos*mancha)/100 as pm1,(((total_kgs_netos*mancha)/100)*criba)/100 as pm2
 			from co_compras com where com.estatus=true and com.id_proveedor='$id_cliente' and com.id_periodo='$id_periodo'
 			order by fecha_nota;";
	/* }else {
			$sql_compras="select com.id_compra,com.id_periodo,com.fecha_nota,'COMPRA DE CAFÉ N.E. '||serie||folio::varchar(20) as nota,(total_kgs_netos*precio_kilo) as subtotal,
			
				(select case when sum(pr.monto_pagado) is null then 0.00 else sum(pr.monto_pagado) end
 			 	from re_pagos_realizados pr,co_ctasxpagar cxp,co_compras cm,re_aplicaciones ap where ap.idaplicacion=pr.idaplicacion and pr.estatus=true and pr.idcta_xpagar=cxp.idcta_xpagar and 
				cxp.id_compra=cm.id_compra and cm.id_compra=com.id_compra) as pagos,
			
				(total_kgs_netos*precio_kilo)-((select case when sum(monto_aplicado) is null then 0.00 else sum(monto_aplicado) end from re_aplicaciones where tipo_aplicacion='C' and tipo_movimiento='C' and estatus=true and id_compra=com.id_compra)
				+(select case when sum(monto_pagado) is null then 0.00 else sum(monto_pagado) end from re_pagos_realizados pr,co_ctasxpagar cxp,co_compras cm where pr.estatus=true and pr.idcta_xpagar=cxp.idcta_xpagar 
				and cxp.id_compra=cm.id_compra and cm.id_compra=com.id_compra)) as saldo,

				(select id_tonga from co_pesadas where id_compra=com.id_compra limit 1) as tonga,
				(select sum(bolsa)+sum(yute)+sum(henequen) from co_pesadas where id_compra=com.id_compra) as bolsas,
				serie||folio::varchar(20) as folio,total_kgs_netos,rendimiento,mancha,humedad,criba,precio_kilo,retencion_peso,
				
				(SELECT TRIM(nombre)||' '||TRIM(ap_paterno)||' '||TRIM(ap_materno) FROM cc_clientes WHERE idcliente=com.id_productor)::varchar(60) as productor
				,(total_kgs_netos*rendimiento)/100 as p1,(((total_kgs_netos*rendimiento)/100)*humedad)/100 as p2,
				(total_kgs_netos*mancha)/100 as pm1,(((total_kgs_netos*mancha)/100)*criba)/100 as pm2
 			from co_compras com where com.estatus=true and com.id_proveedor='$id_cliente' and com.id_periodo='$id_periodo'

			and (select deuda_cero from cc_clientes where idcliente=com.id_proveedor)=false	
						
			and (total_kgs_netos*precio_kilo)-((select case when sum(monto_aplicado) is null then 0.00 else sum(monto_aplicado) end from re_aplicaciones where tipo_aplicacion='C' and tipo_movimiento='C' and estatus=true and id_compra=com.id_compra)
			    +(select case when sum(monto_pagado) is null then 0.00 else sum(monto_pagado) end from re_pagos_realizados pr,co_ctasxpagar cxp,co_compras cm where pr.estatus=true and pr.idcta_xpagar=cxp.idcta_xpagar 
			    and cxp.id_compra=cm.id_compra and cm.id_compra=com.id_compra))>0.50 			
 			
 			order by fecha_nota;";
	
	}*/			
	
	$consulta_compras=pg_query($con,$sql_compras);
	
	if(pg_num_rows($consulta_compras)>0) {
			
	$cuenta_cel="B".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($cuenta_cel,'TONGA');
	
	$cuenta_cel="C".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($cuenta_cel,'FECHA');
	
	$cuenta_cel="D".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($cuenta_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($cuenta_cel,'N.E.');


	$fecha_cel="E".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($fecha_cel,'BULTOS');



	$cheque_cel="F".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->SetCellValue($cheque_cel,'PESO NETO');




	$concepto_cel="G".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($concepto_cel,'REND.');

	$kgs_cel="H".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($kgs_cel,'MAN.');


	$pu_cel="I".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($pu_cel,'HUM.');

	$importe_cel="J".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($importe_cel,'CRIBA');


	$pagos_cel="K".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($pagos_cel,'P.U.');

	$saldo_cel="L".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,'IMPORTE');

	$saldo_cel="M".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,'RET. C.M.');

	$saldo_cel="N".$fi;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,'NETO A PAGAR');
	
	
	
			$total_bulto=0.00;
			$total_peso_neto=0.00;
			$total_importe=0.00;
			$total_retencion=0.00;
			$total_neto_pagar=0.00;
			$nnotas=0;
			$total_precio=0.00;
			$total_rendimiento=0.00;
			$total_mancha=0.00;
			$total_humedad=0.00;
			$total_criba=0.00;
			
			$sum_p1=0.00;
			$sum_p2=0.00;
			$sum_pm1=0.00;
			$sum_pm2=0.00;

				while($fila_com=pg_fetch_array($consulta_compras))
				{
						$fi++;
						$b="B".$fi;
						$c="C".$fi;
						$d="D".$fi;							
						$e="E".$fi;
						$f="F".$fi;
						$g="G".$fi;
						$h="H".$fi;
						$i="I".$fi;
						$j="J".$fi;
						$k="K".$fi;
						$l="L".$fi;
						$m="M".$fi;
						$n="N".$fi;
						$o="O".$fi;
						$o_merge="O".$fi.":P".$fi;
						
						$nnotas++;						
						
						$objPHPExcel->getActiveSheet()->getStyle($b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($b,$fila_com["tonga"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila_com["fecha_nota"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($d,$fila_com["folio"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($e)->getNumberFormat()->setFormatCode('#,##0');										
						$objPHPExcel->getActiveSheet()->SetCellValue($e,$fila_com["bolsas"]);
						
						$total_bulto=$total_bulto+$fila_com["bolsas"];
						$total_peso_neto=$total_peso_neto+$fila_com["total_kgs_netos"];
						$total_importe=$total_importe+$fila_com["subtotal"];
						$total_retencion=$total_retencion+$fila_com["retencion_peso"];
						$total_neto_pagar=$total_neto_pagar+$fila_com["saldo"];
						$total_precio=$total_precio+$fila_com["precio_kilo"];
						
						$total_rendimiento=$total_rendimiento+(($fila_com["total_kgs_netos"]*$fila_com["rendimiento"])/100);
						$total_mancha=$total_mancha+(($fila_com["total_kgs_netos"]*$fila_com["mancha"])/100);
						$total_humedad=$total_humedad+(($fila_com["total_kgs_netos"]*$fila_com["humedad"])/100);
						$total_criba=$total_criba+(($fila_com["total_kgs_netos"]*$fila_com["criba"])/100);
						$sum_p1=$sum_p1+$fila_com["p1"];
						$sum_p2=$sum_p2+$fila_com["p2"];
						$sum_pm1=$sum_pm1+$fila_com["pm1"];
						$sum_pm2=$sum_pm2+$fila_com["pm2"];					
						
						$objPHPExcel->getActiveSheet()->getStyle($f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($f)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($f,$fila_com["total_kgs_netos"]);

						$objPHPExcel->getActiveSheet()->getStyle($g)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($g)->getNumberFormat()->setFormatCode('#,##0.00%');				
						$objPHPExcel->getActiveSheet()->SetCellValue($g,$fila_com["rendimiento"]/100);
				
						$objPHPExcel->getActiveSheet()->getStyle($h)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($h)->getNumberFormat()->setFormatCode('#,##0.00%');				
						$objPHPExcel->getActiveSheet()->SetCellValue($h,$fila_com["mancha"]/100);
				
						$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($i)->getNumberFormat()->setFormatCode('#,##0.00%');				
						$objPHPExcel->getActiveSheet()->SetCellValue($i,$fila_com["humedad"]/100);
			
						$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($j)->getNumberFormat()->setFormatCode('#,##0.00%');				
						$objPHPExcel->getActiveSheet()->SetCellValue($j,$fila_com["criba"]/100);
						
						$objPHPExcel->getActiveSheet()->getStyle($k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($k)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($k,$fila_com["precio_kilo"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($l)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($l,$fila_com["subtotal"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($m)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($m)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($m,$fila_com["retencion_peso"]);
						
						$objPHPExcel->getActiveSheet()->getStyle($n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->getStyle($n)->getNumberFormat()->setFormatCode('#,##0.00');				
						$objPHPExcel->getActiveSheet()->SetCellValue($n,$fila_com["saldo"]);
						
						$objPHPExcel->getActiveSheet()->mergeCells($o_merge);						
						$objPHPExcel->getActiveSheet()->getStyle($o_merge)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
						$objPHPExcel->getActiveSheet()->SetCellValue($o,$fila_com["productor"]);
											
				}

				
				$fi++;

				

				$fecha_cel="E".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($fecha_cel)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($fecha_cel,$total_bulto);



				$cheque_cel="F".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($cheque_cel)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($cheque_cel,$total_peso_neto);




				$concepto_cel="G".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($concepto_cel)->getNumberFormat()->setFormatCode('#,##0.00%');				
				$objPHPExcel->getActiveSheet()->SetCellValue($concepto_cel,($total_rendimiento/$total_peso_neto));

				$kgs_cel="H".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($kgs_cel)->getNumberFormat()->setFormatCode('#,##0.00%');				
				$objPHPExcel->getActiveSheet()->SetCellValue($kgs_cel,($total_mancha/$total_peso_neto));


				$pu_cel="I".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($pu_cel)->getNumberFormat()->setFormatCode('#,##0.00%');				
				$objPHPExcel->getActiveSheet()->SetCellValue($pu_cel,($total_humedad/$total_peso_neto));

				$importe_cel="J".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($importe_cel)->getNumberFormat()->setFormatCode('#,##0.00%');				
				$objPHPExcel->getActiveSheet()->SetCellValue($importe_cel,($total_criba/$total_peso_neto));


				$pagos_cel="K".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($pagos_cel)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($pagos_cel,$total_precio/$nnotas);

				$saldo_cel="L".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES				
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,$total_importe);

				$saldo_cel="M".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES				
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,$total_retencion);

				$saldo_cel="N".$fi;
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray(array('font' => array('bold' => true)));
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getFill()->getStartColor()->setRGB('CCCCFF');
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->applyFromArray($borders); //PINTAMOS LOS BORDES				
				$objPHPExcel->getActiveSheet()->getStyle($saldo_cel)->getNumberFormat()->setFormatCode('#,##0.00');				
				$objPHPExcel->getActiveSheet()->SetCellValue($saldo_cel,$total_neto_pagar);

	} //fin de condicion si cuenta con registro de notas de entrada
}	// fin de condicion de control para que aparesca solo ne de la cosecha actual

	$fi+=3;
	
	$control++;

} //fin del cliclo de cosecha	


	//agregar al final corte
   $fi_liquida++;
	
	$saldo_col="E".$fi_liquida.":L".$fi_liquida;	
	$saldo_kgs="E".$fi_liquida;
	$objPHPExcel->getActiveSheet()->mergeCells($saldo_col);	
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,"(+) MAS DEUDA CONSECHA(S) ANTERIORE(S) CAPITAL+INTERES $");

	
	$saldo_kgs="M".$fi_liquida;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->getColor()->setRGB('FF0000');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$total_deuda_global);	
	
	$fi_liquida++;
	
	$saldo_col="E".$fi_liquida.":L".$fi_liquida;	
	$saldo_kgs="E".$fi_liquida;
	$objPHPExcel->getActiveSheet()->mergeCells($saldo_col);	
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_col)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,"DEUDA TOTAL DEL CLIENTE AL CORTE ==>");

	
	$saldo_kgs="M".$fi_liquida;
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getNumberFormat()->setFormatCode('#,##0.00');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFill()->getStartColor()->setRGB('CCCCFF');
	$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(12);
	$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,$deuda_cosecha_actual+$total_deuda_global);	
	
	if(!empty($nota_sin_precio)) {
	
		$saldo_col="C".($fi_liquida+2).":O".($fi_liquida+2);	
		$saldo_kgs="C".($fi_liquida+2);
		$objPHPExcel->getActiveSheet()->mergeCells($saldo_col);	
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //alinjeamos al centro
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->applyFromArray(array('font' => array('bold' => true)));
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->setSize(13);
		$objPHPExcel->getActiveSheet()->getStyle($saldo_kgs)->getFont()->getColor()->setRGB('FF0000');
		$objPHPExcel->getActiveSheet()->SetCellValue($saldo_kgs,"Obs: Considerar la(s) sig. nota(s) sin precio:  ".$nota_sin_precio);
 	}
 

$objPHPExcel->setActiveSheetIndex(0);
	
	
	


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("historico_cliente.xlsx");
$enlace = "historico_cliente.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





