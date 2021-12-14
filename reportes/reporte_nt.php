<?php 
ob_start(); 
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
$con=conectarse();

$id_periodo=$_GET["id_periodo"];
$fecha_i=$_GET["fecha_i"];
$fecha_f=$_GET["fecha_f"];
$id_tong=$_GET["id_tonga"];
$id_almacen=$_GET["id_almacen"];
$id_producto=$_GET["id_producto"];

$consulta=pg_query($con,"SET datestyle TO postgres, dmy;");
$sql="SELECT id_compra,id_proveedor,id_catalogo,fecha_nota,trim(serie)||trim(folio) as folio,precio_kilo,retencion_peso,
coalesce((select total_kgs_brutos from co_compras_merma where id_compra=com.id_compra),com.total_kgs_brutos) as total_kgs_brutos,
coalesce((select total_kgs_netos from co_compras_merma where id_compra=com.id_compra),com.total_kgs_netos) as total_kgs_netos,
coalesce((select rendimiento from co_compras_merma where id_compra=com.id_compra),com.rendimiento) as rendimiento,
coalesce((select mancha from co_compras_merma where id_compra=com.id_compra),com.mancha) as mancha,
coalesce((select humedad from co_compras_merma where id_compra=com.id_compra),com.humedad) as humedad,
coalesce((select cerezo from co_compras_merma where id_compra=com.id_compra),com.cerezo) as cerezo,
coalesce((select criba from co_compras_merma where id_compra=com.id_compra),com.criba) as criba,
(select id_tonga from co_pesadas where id_compra=com.id_compra limit 1) as id_tonga ,
(select cf.idclasificacion from al_cat_articulos ct,al_clasificador_cafe cf where ct.idclasificacion=cf.idclasificacion and ct.id_catalogo=com.id_catalogo) as tipo_cafe,
(select descripcion from al_cat_articulos ct where  ct.id_catalogo=com.id_catalogo) as nom_cafe,
(select nom_tonga from al_tonga where id_tonga=(select id_tonga from co_pesadas where id_compra=com.id_compra limit 1)) as nom_tonga
FROM co_compras as com 
where com.estatus=true and 
com.id_almacen='$id_almacen' 
and 
com.id_periodo='$id_periodo'
and
com.id_catalogo='$id_producto' 
and 
trim(com.serie)!='A'
and 
com.fecha_nota between '$fecha_i' and '$fecha_f' order by com.folio";

//and trim(com.serie)=''
$consulta=pg_query($con,$sql);


set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("plantilla_nt.xlsx");
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4); 
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(1);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.2);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.3);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(1);
$objPHPExcel->getDefaultStyle()->getFont()->setSize(9.5);
$borders = array('borders' => array('allborders' => array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => 'FF000000'),)),);

$objPHPExcel->getActiveSheet()->SetCellValue("U3",$fecha_i);
$objPHPExcel->getActiveSheet()->SetCellValue("U4",$fecha_f);
/*PRODUCTO*/
/*$producto=get_catalogo_m($id_catalogo);	//arreglo de al-cat-articulos
$objPHPExcel->getActiveSheet()->SetCellValue("Y3",$producto["descripcion"]);*/
/*COSECHA*/
$cosecha=get_cosecha_r($id_periodo);
$objPHPExcel->getActiveSheet()->SetCellValue("X3",$cosecha);
/*TONGAS*/
if($id_tong==0) {
	$tonga="Todas";
}else {
	$tonga=get_tonga_nota_reporte($id_tong);
}	
$objPHPExcel->getActiveSheet()->SetCellValue("AA3",$tonga);

$fi=7;//filas generales

$numero_notas=0;

$sum_kilos=0.00;
$renpeso_total=0.00;
$manpeso_total=0.00;
$humpeso_total=0.00;
$cripeso_total=0.00;
$cerpeso_total=0.00;

$factor1=0.00;
$factor2=0.00;
$sum_retencion=0.00;
$sumfh1_humedad=0.00;
$sumfh2_humedad=0.00;
$sumfc1_criba=0.00;
$sumfc2_criba=0.00;
$sumtot_pergamino=0.00;
$entro=0;

	while($fila=pg_fetch_array($consulta))
	{
	
				$id_compra=$fila["id_compra"];
				$fila_cliente=get_cliente($fila["id_proveedor"]);
				$municipio=get_municipio($fila_cliente["idmunicipio"]);
				$estado=get_estado($fila_cliente["idestado"]);
				$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
				$nom_cliente= limitarPalabras($nom_cliente,35); 
				$producto=get_catalogo_m($fila["id_catalogo"]);	//arreglo de al-cat-articulos
				if($id_tong==0) {				
					$id_tonga=$fila["id_tonga"];
				}else {
					$id_tonga=$id_tong;				
				}
				
				
									
		
	
$stock=filtra_tonga($id_compra,$id_tonga);
if($stock==1)
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
							$k="K".$fi;	
							$l="L".$fi;	
							$m="M".$fi;	
							$n="N".$fi;	
							$o="O".$fi;	
							$p="P".$fi;	
							$q="Q".$fi;	
							$r="R".$fi;	
							$s="S".$fi;	
							$t="T".$fi;	
							$u="U".$fi;	
							$v="V".$fi;	
							$w="W".$fi;	
							$x="X".$fi;	
							$y="Y".$fi;	
							$z="Z".$fi;	
							$aa="AA".$fi;
							$ab="AB".$fi;
							$ac="AC".$fi;
							$ad="AD".$fi;
							$ae="AE".$fi;
							$af="AF".$fi;
										
					$total_henequen=get_total_pesadas_tonga($id_compra,"hene",$id_tonga);
					$total_yute=get_total_pesadas_tonga($id_compra,"yute",$id_tonga);
					$total_bolsa=get_total_pesadas_tonga($id_compra,"bolsa",$id_tonga);
		
		if($id_tong==0) {		
				$total_kgs_brutos=get_total_kg_brutos($id_compra);
		}else {
				$total_kgs_brutos=get_total_brutos($id_compra,$id_tonga);
		}		
		$peso_hene=get_peso_tara(1)*$total_henequen;//recuperamos el pesos de hene
		$peso_yute=get_peso_tara(2)*$total_yute;//recuperamos el pesos de yute
		$peso_bolsa=get_peso_tara(3)*$total_bolsa;//recuperamos el pesos de bolsa
		$total_kgs_netos=$total_kgs_brutos-($peso_hene+$peso_yute+$peso_bolsa);
		

//		$objPHPExcel->getActiveSheet()->SetCellValue($ab,$total_kgs_brutos);							
						

$sum_kilos=$sum_kilos+$total_kgs_netos;
$renpeso_total=$renpeso_total+(($total_kgs_netos*$fila["rendimiento"])/100);
$manpeso_total=$manpeso_total+(($total_kgs_netos*$fila["mancha"])/100);
$humpeso_total=$humpeso_total+(($total_kgs_netos*$fila["humedad"])/100);
$cripeso_total=$cripeso_total+(($total_kgs_netos*$fila["criba"])/100);
$cerpeso_total=$cerpeso_total+(($total_kgs_netos*$fila["cerezo"])/100);

$factor1=($total_kgs_netos*$fila["rendimiento"])/100;
$factor2=((($total_kgs_netos*$fila["rendimiento"])/100)*$fila["humedad"])/100;

$sumfh1_humedad+=$factor1;
$sumfh2_humedad+=$factor2;


$factor1=($total_kgs_netos*$fila["mancha"])/100;
$factor2=((($total_kgs_netos*$fila["mancha"])/100)*$fila["criba"])/100;

$sumfc1_criba+=$factor1;
$sumfc2_criba+=$factor2;


$sumtot_pergamino+=$total_kgs_netos;

/*FECHA**/
$cfecha=$a.":".$b;
$objPHPExcel->getActiveSheet()->mergeCells($cfecha);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cfecha)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($a,$fila["fecha_nota"]);

/*NOMBRE TONGA**/
$cnomtg=$c.":".$d;
$objPHPExcel->getActiveSheet()->mergeCells($cnomtg);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cnomtg)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila["nom_tonga"]);

/**FOLIO NOTA DE ENTRADA**/
$cfolio=$e.":".$f;
$objPHPExcel->getActiveSheet()->mergeCells($cfolio);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cfolio)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($e)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($e,$fila["folio"]);
/**NOMBRE DEL PRODUCTOR**/
$cprodu=$g.":".$k;
$objPHPExcel->getActiveSheet()->mergeCells($cprodu);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cprodu)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->SetCellValue($g,nom($nom_cliente));
/**POBLACION/ESTADO**/
$cpobla=$l.":".$m;
$objPHPExcel->getActiveSheet()->mergeCells($cpobla);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cpobla)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($l,$estado["estado"]);
/**POBLACION/MUNICIPIO**/
$cmuni=$n.":".$p;
$objPHPExcel->getActiveSheet()->mergeCells($cmuni);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cmuni)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($n,$municipio["municipio"]);
/**BULTOS**/
$bultos=$total_henequen+$total_yute+$total_bolsa;
$cmbultos=$q.":".$r;
$objPHPExcel->getActiveSheet()->mergeCells($cmbultos);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cmbultos)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($q)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($q)->getNumberFormat()->setFormatCode('#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($q,$bultos);
//$bultos
/**PESOS NETO**/
$cpeso=$s.":".$t;
$objPHPExcel->getActiveSheet()->mergeCells($cpeso);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cpeso)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($s)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($s)->getNumberFormat()->setFormatCode('#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($s,$total_kgs_netos);
/*RENDIMIENTO*/
$cren=$u.":".$u;
$objPHPExcel->getActiveSheet()->mergeCells($cren);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cren)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($u)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($u)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($u,($fila["rendimiento"]/100));
/*MANCHA*/



$cman=$v.":".$v;
$objPHPExcel->getActiveSheet()->mergeCells($cman);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cman)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($v)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($v)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($v,($fila["mancha"]/100));
/*HUMEDAD*/
$chum=$w.":".$w;
$objPHPExcel->getActiveSheet()->mergeCells($chum);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($chum)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($w)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($w)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($w,($fila["humedad"]/100));
/*CEREZO**/
$cer=$x.":".$x;
$objPHPExcel->getActiveSheet()->mergeCells($cer);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cer)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($x)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($x)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($x,($fila["cerezo"]/100));
/*CRIBA*/
$cri=$y.":".$y;
$objPHPExcel->getActiveSheet()->mergeCells($cri);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cri)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($y)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($y,($fila["criba"]/100));;
/**PRECIO UNITARIO**/
$cprecio=$z.":".$aa;
$objPHPExcel->getActiveSheet()->mergeCells($cprecio);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cprecio)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($z)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($z)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($z,$fila["precio_kilo"]);




/*VALOR DE INVENTARIO*/
$sub_total=$total_kgs_netos*$fila["precio_kilo"];
$csubtotal=$ab;
//.":".$aa;
//$objPHPExcel->getActiveSheet()->mergeCells($cinvetn);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($csubtotal)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($ab)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($ab)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($ab,$sub_total);

$total_ret=$fila["retencion_peso"];
$cret=$ac;
$objPHPExcel->getActiveSheet()->getStyle($cret)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($ac)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($ac)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($ac,$total_ret);

$total_inv=($total_kgs_netos*$fila["precio_kilo"])-$fila["retencion_peso"];
$cinvetn=$ad.":".$ae;

$objPHPExcel->getActiveSheet()->mergeCells($cinvetn);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cinvetn)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($ad)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($ad)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($ad,$total_inv);

/*
if($tonga=="Todas") {
	$objPHPExcel->getActiveSheet()->getStyle($ad)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($ad)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->SetCellValue($ad,$fila["nom_tonga"]);
}
if($tonga=="Todas") {
	$objPHPExcel->getActiveSheet()->getStyle($ae)->applyFromArray($borders); //PINTAMOS LOS BORDES
	$objPHPExcel->getActiveSheet()->getStyle($ae)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
	$objPHPExcel->getActiveSheet()->SetCellValue($ae,$fila["nom_cafe"]);
} else {*/

$objPHPExcel->getActiveSheet()->getStyle($ad)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($ad)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($af,$fila["nom_cafe"]);				
				
			$sum_bultos+=$bultos;
			$sum_netos+=$total_kgs_netos;
			$sum_inv+=$sub_total;
			$sum_retencion+=$total_ret;	
			$numero_notas++;
			
				
		 	                        
			$fi++;//filas generales	
			
			$entro=1;
			
	}

	
}
							$fi+=1;	
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
							$k="K".$fi;	
							$l="L".$fi;	
							$m="M".$fi;	
							$n="N".$fi;	
							$o="O".$fi;	
							$p="P".$fi;	
							$q="Q".$fi;	
							$r="R".$fi;	
							$s="S".$fi;	
							$t="T".$fi;	
							$u="U".$fi;	
							$v="V".$fi;	
							$w="W".$fi;	
							$x="X".$fi;	
							$y="Y".$fi;	
							$z="Z".$fi;	
							$aa="AA".$fi;
							$ab="AB".$fi;
							$ac="AC".$fi;
							$ad="AD".$fi;
							$ae="AE".$fi;							
							
if($entro==1)
{							
	$cmbultos=$q.":".$r;
	$objPHPExcel->getActiveSheet()->mergeCells($cmbultos);//COMBINAMOS CELDAS
	$objPHPExcel->getActiveSheet()->getStyle($q)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($cmbultos)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($cmbultos)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($q)->getNumberFormat()->setFormatCode('#,##0.00'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($q,$sum_bultos);


	//porcentajes de rendimiento,mancha,humedad,cerezo,criba

	$objPHPExcel->getActiveSheet()->getStyle($u)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($u)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($u)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($u)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($u,(($renpeso_total/$sum_kilos)));


	$objPHPExcel->getActiveSheet()->getStyle($v)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($v)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($v)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($v)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($v,(($manpeso_total/$sum_kilos)));

	$objPHPExcel->getActiveSheet()->getStyle($w)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($w)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($w)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($w)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($w,($humpeso_total/$sum_kilos));

	$objPHPExcel->getActiveSheet()->getStyle($x)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($x)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($x)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($x)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($x,($cerpeso_total/$sum_kilos));


	$objPHPExcel->getActiveSheet()->getStyle($y)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($y)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($y)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($y)->getNumberFormat()->setFormatCode('##0.00%'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($y,($cripeso_total/$sum_kilos));



	$cpeso=$s.":".$t;
	$objPHPExcel->getActiveSheet()->mergeCells($cpeso);//COMBINAMOS CELDAS
	$objPHPExcel->getActiveSheet()->getStyle($s)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($cpeso)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($cpeso)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($s)->getNumberFormat()->setFormatCode('#,##0.00'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($s,$sum_netos);

	$cinvetn=$ab;
	//.":".$aa;
	//$objPHPExcel->getActiveSheet()->mergeCells($cinvetn);//COMBINAMOS CELDAS

	$objPHPExcel->getActiveSheet()->getStyle($ab)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($cinvetn)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($cinvetn)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($ab)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($ab,$sum_inv);

	$cret=$ac;
	//$objPHPExcel->getActiveSheet()->mergeCells($cinvetn);//COMBINAMOS CELDAS

	$objPHPExcel->getActiveSheet()->getStyle($ac)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($cret)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($cret)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($ac)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($ac,$sum_retencion);
			
	
	$cinven=$ad.":".$ae;
	$objPHPExcel->getActiveSheet()->mergeCells($cinven);//COMBINAMOS CELDAS
	$objPHPExcel->getActiveSheet()->getStyle($ad)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle($cinven)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($cinven)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
	$objPHPExcel->getActiveSheet()->getStyle($ad)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
	$objPHPExcel->getActiveSheet()->SetCellValue($ad,$sum_inv-$sum_retencion);

	$style_negrita = array('font' => array('bold' => true,),);
	$objPHPExcel->getActiveSheet()->getStyle($l)->applyFromArray($style_negrita);
	$objPHPExcel->getActiveSheet()->SetCellValue($l,"SUMAS TOTALES");


}







$objPHPExcel->setActiveSheetIndex(0);
	
	
	


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("compras.xlsx");
$enlace = "compras.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





