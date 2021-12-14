<?php 
ob_start(); 
$tipo_min=$_GET["tipo_min"];
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
require("../includes/session.php");
$con=conectarse();

$vtipo_ministracion=($tipo_min=3 ? '' : " and pa.tipo_movimiento={$tipo_min}");

$idSucursal=$_SESSION['mov_sucursal'];
$idCosecha=$_SESSION['cosecha_sel'];

$consulta=" SET datestyle TO postgres, dmy;";
$consulta.="SELECT sum(pa.capital) as credito_cap,cl.idcliente,

         	 (select case when sum(monto_cobrado) is null then 0.00 else sum(monto_cobrado) end from re_cobros_realizados where cns_pagare=pa.cns_pagare and id_cargo_pagare=0 and estatus=TRUE) as pago_capital,    

          	(select case when sum(monto_cobrado) is null then 0.00 else sum(monto_cobrado) end from re_cobros_realizados where cns_pagare=pa.cns_pagare and id_cargo_pagare=1 and estatus=TRUE) as pago_interes,   

	  		(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente=cl.idcliente)::char(50) as cliente,
	  		
	  		case when (select tipo_movimiento from cc_pagares p,cc_cheques_ministracion cm where p.idmov=cm.idmov and p.cns_pagare=pa.cns_pagare) is not null then
		  	( select ref_cheque from cheques where idmov=pa.idmov )
		  	else
		  	(select ref_recibo from cajas where idmov=pa.idmov)
		  	end::varchar(10) as num_ref,
		  	
			case when (select tipo_movimiento from cc_pagares p,cc_cheques_ministracion cm where p.idmov=cm.idmov and p.cns_pagare=pa.cns_pagare) is not null then
		  	( select fecha from cheques where idmov=pa.idmov )
		  	else
		  	(select fecha from cajas where idmov=pa.idmov)
		  	end as fecha_exp,
		  	
		  	case when (select tipo_movimiento from cc_pagares p,cc_cheques_ministracion cm where p.idmov=cm.idmov and p.cns_pagare=pa.cns_pagare) is not null then
			  (select nombre_banco from cuentas_bancarias cb,bancos b,cheques c where cb.idcuenta=c.idcuenta and cb.idbanco=b.idbanco and c.idmov=pa.idmov)
		  	else
		  	  'CAJA'
		  	end::varchar(25) as banco,
		  	case when (select tipo_movimiento from cc_pagares p,cc_cheques_ministracion cm where p.idmov=cm.idmov and p.cns_pagare=pa.cns_pagare) is not null then
			  (select cb.num_cuenta from cuentas_bancarias cb,bancos b,cheques c where cb.idcuenta=c.idcuenta and cb.idbanco=b.idbanco and c.idmov=pa.idmov)
		  	else
		  	  '0000000000'
		  	end::varchar(25) as cuenta,
		  	
		  	case when (select tipo_movimiento from cc_pagares p,cc_cheques_ministracion cm where p.idmov=cm.idmov and p.cns_pagare=pa.cns_pagare) is not null then
		  		''
	  		ELSE
	  			(select grupo from cc_grupos g,rela_grupo r where g.idgrupo=r.idgrupo and r.idcliente=cl.idcliente)
	  		END::varchar(50) as grupo
	  	
          	from cc_pagares pa,cc_creditos cr,cc_solicitudes so,cc_clientes cl

         	 where pa.idcredito=cr.idcredito and cr.idsolicitud=so.idsolicitud 

          	and so.idcliente=cl.idcliente and cr.cancelado=FALSE and pa.cancelado=false and cr.id_sucursal={$idSucursal} 
          	and cr.id_periodo=$idCosecha $vtipo_ministracion group by cl.idcliente,pa.cns_pagare,pa.idmov  
          	order by cl.idcliente;";
          	
          	
        $id_query = pg_query($con,$consulta);
		

set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("cre_plantilla_glomin.xlsx");
$objPHPExcel->setActiveSheetIndex(0);

$row=5;

while($fila= pg_fetch_array($id_query))
{
	$objPHPExcel->getActiveSheet()->SetCellValue("B{$row}", $fila['fecha_exp']);
	$objPHPExcel->getActiveSheet()->SetCellValue("C{$row}", $fila['num_ref']);
	$objPHPExcel->getActiveSheet()->SetCellValue("D{$row}", $fila['cuenta']);
	$objPHPExcel->getActiveSheet()->SetCellValue("E{$row}", $fila['banco']);
	$objPHPExcel->getActiveSheet()->SetCellValue("F{$row}", $fila['grupo']);
	$objPHPExcel->getActiveSheet()->SetCellValue("G{$row}", $fila['cliente']);
	$objPHPExcel->getActiveSheet()->SetCellValue("H{$row}", $fila['credito_cap']);
	$objPHPExcel->getActiveSheet()->SetCellValue("I{$row}", 0.00);
	$objPHPExcel->getActiveSheet()->SetCellValue("J{$row}", $fila['pago_capital']);
	$objPHPExcel->getActiveSheet()->SetCellValue("K{$row}", $fila['pago_interes']);
	$objPHPExcel->getActiveSheet()->SetCellValue("L{$row}", 0.00);
	
	$row+=1;
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("global_ministra.xlsx");

$enlace = "global_ministra.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





