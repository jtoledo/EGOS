<?php 
ob_start(); 
session_start();
$id_usuario=$_SESSION["usuario"];
$idcliente=$_GET["idcliente"];
$opcion=trim($_GET["opcion"]);
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();
$fila=get_cliente($idcliente);

$estado=get_estado($fila["idestado"]);
$municipio=get_municipio($fila["idmunicipio"]);
$localidad=get_localidad($fila["idlocalidad"]);
$colonia=get_colonia($fila["idcolonia"]);

$mun_estado=$municipio["municipio"]." ".$estado["estado"];

$masculino=$fila["masculino"];
if($masculino=='t')
{
$genero="Masculino";
}
else
{
$genero="Femenino";
}

$regimen_conyugal=get_regimen($fila["regimen_conyugal"]);

$fila_get_grupo=get_grupo_sol($fila["idcliente"]);
	if($fila_get_grupo!=0)
	$grupo=$fila_get_grupo["grupo"];
	else
	$grupo="SIN GRUPO";

	if($opcion==1)
	$tipo_reporte= "CON ADEUDO";
	else
	$tipo_reporte= "SIN ADEUDO";


set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("plantilla_servicios_cliente.xlsx");
$objPHPExcel->setActiveSheetIndex(0);

$fila_usuario=get_usuario($id_usuario);
$fila_sucursal=get_sucursal_m($fila_usuario["id_sucursal"]);



$objPHPExcel->getActiveSheet()->SetCellValue('B7',nom($fila_sucursal["sucursal"]." ".$fila_sucursal["direccion"]));	  
$objPHPExcel->getActiveSheet()->SetCellValue('H7', $tipo_reporte);
$objPHPExcel->getActiveSheet()->SetCellValue('B8', date("d-m-Y"));
$objPHPExcel->getActiveSheet()->SetCellValue('C11',nom("".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"].""));
$objPHPExcel->getActiveSheet()->SetCellValue('C12', nom($fila["curp"]));
$objPHPExcel->getActiveSheet()->SetCellValue('I11', nom($fila["rfc"]));
$objPHPExcel->getActiveSheet()->SetCellValue('I12', nom($genero));
$objPHPExcel->getActiveSheet()->SetCellValue('C13', nom($fila["domicilio"]));
$objPHPExcel->getActiveSheet()->SetCellValue('C14', nom($mun_estado));
$objPHPExcel->getActiveSheet()->SetCellValue('C15', nom($grupo));



if($opcion==1)  //CON ADEUDO
{

$sql="SELECT * FROM se_servicios as s WHERE (s.idcliente='$idcliente' and  s.total> (select sum(importe) from se_cobros as c where c.id_servicio=s.id_servicio and c.cancelado=false)) or (s.idcliente='$idcliente' and  s.id_servicio not in (select c.id_servicio from se_cobros as c where c.id_servicio=s.id_servicio)) order by s.folio_servicio";
}
if($opcion==0)//SIN ADEUDO
{
$sql="SELECT * FROM se_servicios as s WHERE s.idcliente='$idcliente'  and s.total = (select sum(importe) from se_cobros as c where c.id_servicio=s.id_servicio and c.cancelado=false) order by s.folio_servicio asc"; //CON ADEUDO
}







$a="A21";
$b="B21";
$c="C21";
$d="D21";
$e="E21";
$f="F21";
$g="G21";
$h="H21";
$i="I21";
$j="J21";
$k="K21";

	$abonos="Abonos";
	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
						
$id_servicio=$fila["id_servicio"];							
$servicio=get_tipo_servicio($fila["id_tipo_servicio"]);

//**PINTAMOS LOS BORDES/////

$borders = array('borders' => array('allborders' => array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => 'FF000000'),)),);
$ra=$a.":".$b;
$rb=$c.":".$c;
$rc=$d.":".$f;
$rd=$g.":".$i;
$re=$j.":".$k;

$objPHPExcel->getActiveSheet()->mergeCells($ra);
$objPHPExcel->getActiveSheet()->mergeCells($rb);
$objPHPExcel->getActiveSheet()->mergeCells($rc);
$objPHPExcel->getActiveSheet()->mergeCells($rd);
$objPHPExcel->getActiveSheet()->mergeCells($re);

$objPHPExcel->getActiveSheet()->getStyle($ra)->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getStyle($rb)->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getStyle($rc)->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getStyle($rd)->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getStyle($re)->applyFromArray($borders);

//**FIN DE  LOS BORDES/////


$objPHPExcel->getActiveSheet()->getStyle($ra)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($a,$fila["folio_servicio"]);
$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila["cantidad"]);
$objPHPExcel->getActiveSheet()->getStyle($rc)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($d,$servicio);


$objPHPExcel->getActiveSheet()->getStyle($g)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($g,$fila["total"]);



$objPHPExcel->getActiveSheet()->getStyle($re)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($j,$fila["fecha_servicio"]);








$sql_c="SET datestyle TO postgres, dmy; SELECT * FROM se_cobros where id_servicio='$id_servicio' order by fecha_cobro asc ";
$consulta_c=pg_query($con,$sql_c);
$total=0;
$renglon=1;
	while($fila_c=pg_fetch_array($consulta_c))
	{


		
$a++;
$b++;
$c++;
$d++;
$e++;
$f++;
$g++;
$h++;
$i++;
$j++;
$k++;

		
	/**encabezado de los pagos*/
if($renglon==1)
{
$m_p=$a.":".$k;
$objPHPExcel->getActiveSheet()->mergeCells($m_p);
$objPHPExcel->getActiveSheet()->getStyle($m_p)->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getStyle($m_p)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro


$style_relleno = array('font' => array('bold' => true,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,'rotation' => 90,'startcolor' => array('argb' => 'FFA0A0A0',),'endcolor' => array('argb' => 'FFFFFFFF',),),);
$objPHPExcel->getActiveSheet()->getStyle($m_p)->applyFromArray($style_relleno);//le metemos relleno a la celda de pagos
$objPHPExcel->getActiveSheet()->SetCellValue($a,"PAGOS");
$a++;
$b++;
$c++;
$d++;
$e++;
$f++;
$g++;
$h++;
$i++;
$j++;
$k++;




$objPHPExcel->getActiveSheet()->mergeCells($a.":".$b);//combinamos celda
$objPHPExcel->getActiveSheet()->getStyle($a.":".$b)->applyFromArray($borders);//bordes
$objPHPExcel->getActiveSheet()->getStyle($a.":".$b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
//$style_relleno = array('font' => array('bold' => true,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,'rotation' => 90,'startcolor' => array('argb' => 'FFA0A0A0',),'endcolor' => array('argb' => 'FFFFFFFF',),),);
$objPHPExcel->getActiveSheet()->getStyle($a.":".$b)->applyFromArray($style_relleno);//le metemos relleno a la celda de id
$objPHPExcel->getActiveSheet()->SetCellValue($a,"ID");
$objPHPExcel->getActiveSheet()->getStyle($c)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros

$objPHPExcel->getActiveSheet()->mergeCells($c.":".$d);//combinamos celda
$objPHPExcel->getActiveSheet()->getStyle($c.":".$d)->applyFromArray($borders);//bordes
$objPHPExcel->getActiveSheet()->getStyle($c.":".$d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
//$style_relleno = array('font' => array('bold' => true,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,'rotation' => 90,'startcolor' => array('argb' => 'FFA0A0A0',),'endcolor' => array('argb' => 'FFFFFFFF',),),);
$objPHPExcel->getActiveSheet()->getStyle($c.":".$d)->applyFromArray($style_relleno);//le metemos relleno a la celda de id
$objPHPExcel->getActiveSheet()->SetCellValue($c,"IMPORTE");


$objPHPExcel->getActiveSheet()->mergeCells($e.":".$f);//combinamos celda
$objPHPExcel->getActiveSheet()->getStyle($e.":".$f)->applyFromArray($borders);//bordes
$objPHPExcel->getActiveSheet()->getStyle($e.":".$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
//$style_relleno = array('font' => array('bold' => true,),'fill' => array('type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,'rotation' => 90,'startcolor' => array('argb' => 'FFA0A0A0',),'endcolor' => array('argb' => 'FFFFFFFF',),),);
$objPHPExcel->getActiveSheet()->getStyle($e.":".$f)->applyFromArray($style_relleno);//le metemos relleno a la celda de id
$objPHPExcel->getActiveSheet()->SetCellValue($e,"FECHA COBRO");


$objPHPExcel->getActiveSheet()->mergeCells($g.":".$i);//combinamos celda
$objPHPExcel->getActiveSheet()->getStyle($g.":".$i)->applyFromArray($borders);//bordes
$objPHPExcel->getActiveSheet()->getStyle($g.":".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($g.":".$i)->applyFromArray($style_relleno);//le metemos relleno a la celda de id
$objPHPExcel->getActiveSheet()->SetCellValue($g,"CONDONADO");

$objPHPExcel->getActiveSheet()->mergeCells($j.":".$k);//combinamos celda
$objPHPExcel->getActiveSheet()->getStyle($j.":".$k)->applyFromArray($borders);//bordes
$objPHPExcel->getActiveSheet()->getStyle($j.":".$k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($j.":".$k)->applyFromArray($style_relleno);//le metemos relleno a la celda de id
$objPHPExcel->getActiveSheet()->SetCellValue($j,"CANCELADO");
$a++;
$b++;
$c++;
$d++;
$e++;
$f++;
$g++;
$h++;
$i++;
$j++;
$k++;

}



				$importe=$fila_c["importe"];
				$fecha_cobro=$fila_c['fecha_cobro'];
				$id_cobro=$fila_c["id_cobro"];
				$total=$fila_c["total"];
				
				
		
		
$objPHPExcel->getActiveSheet()->mergeCells($a.":".$b);//combinamos celda
$objPHPExcel->getActiveSheet()->getStyle($a.":".$b)->applyFromArray($borders);//bordes
$objPHPExcel->getActiveSheet()->getStyle($a.":".$b)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($a,$renglon);
		
		
$objPHPExcel->getActiveSheet()->mergeCells($c.":".$d);//combinamos celda
$objPHPExcel->getActiveSheet()->getStyle($c.":".$d)->applyFromArray($borders);//bordes
$objPHPExcel->getActiveSheet()->getStyle($c.":".$d)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($c.":".$d)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($c,$importe);
	
$objPHPExcel->getActiveSheet()->mergeCells($e.":".$f);//combinamos celda
$objPHPExcel->getActiveSheet()->getStyle($e.":".$f)->applyFromArray($borders);//bordes
$objPHPExcel->getActiveSheet()->getStyle($e.":".$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($e,$fecha_cobro);


	
	if($fila_c["condonado"]=="true"){ $condo= "Condonado"; } else { $condo= "No"; }
	
$objPHPExcel->getActiveSheet()->mergeCells($g.":".$i);//combinamos celda
$objPHPExcel->getActiveSheet()->getStyle($g.":".$i)->applyFromArray($borders);//bordes
$objPHPExcel->getActiveSheet()->getStyle($g.":".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($g,$condo);

		
				if($fila_c["cancelado"]=="f")
				{ 	
				$total=$total+$fila_c["importe"];
				}
				
				if($fila_c["cancelado"]=="t")
				{ 
				$objPHPExcel->getActiveSheet()->mergeCells($j.":".$k);//combinamos celda
				$objPHPExcel->getActiveSheet()->getStyle($j.":".$k)->applyFromArray($borders);//bordes
				$objPHPExcel->getActiveSheet()->getStyle($j.":".$k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->SetCellValue($j,"X");
				}
				if($fila_c["cancelado"]=="f")
				{ 
				$objPHPExcel->getActiveSheet()->mergeCells($j.":".$k);//combinamos celda
				$objPHPExcel->getActiveSheet()->getStyle($j.":".$k)->applyFromArray($borders);//bordes
				$objPHPExcel->getActiveSheet()->getStyle($j.":".$k)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
				$objPHPExcel->getActiveSheet()->SetCellValue($j,"Cobrado");
				}
				
				

				

				$renglon++;
		
	}


/*
				$saldo_i=number_format(get_monto_servicio($id_servicio,$con),2);
				$total_cobros=number_format(get_saldo_servicio($id_servicio,$con),2);
				$saldo_f=number_format(get_monto_servicio($id_servicio,$con)-get_saldo_servicio($id_servicio,$con),2);
				
				$objPHPExcel->getActiveSheet()->SetCellValue($f,"SALDO INICIAL = ".$saldo_i);
				$objPHPExcel->getActiveSheet()->SetCellValue($t,"TOTAL COBROS = ".$total_cobros);
				$objPHPExcel->getActiveSheet()->SetCellValue($to,"SALDO FINAL = ".$saldo_f);
				
				*/

	
	
$a++;
$b++;
$c++;
$d++;
$e++;
$f++;
$g++;
$h++;
$i++;
$j++;
$k++;


	
	}





$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("Reporte_servicios.xlsx");

$enlace = "Reporte_servicios.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





