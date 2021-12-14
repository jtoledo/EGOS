<?php 
ob_start(); 
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
$id_periodo=$_GET["id_periodo"];
$fecha_i=$_GET["fecha_i"];
$fecha_f=$_GET["fecha_f"];
$id_catalogo=$_GET["id_catalogo"];
$id_tonga=$_GET["id_tonga"];
$id_almacen=$_GET["id_almacen"];
 $con=conectarse();
set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("plantilla_compras.xlsx");
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4); 
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(1);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.2);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.3);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(1);
$objPHPExcel->getDefaultStyle()->getFont()->setSize(9.5);
$borders = array('borders' => array('allborders' => array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => 'FF000000'),)),);

$objPHPExcel->getActiveSheet()->SetCellValue("S3",$fecha_i);
$objPHPExcel->getActiveSheet()->SetCellValue("S4",$fecha_f);
/*PRODUCTO*/
$producto=get_catalogo_m($id_catalogo);	//arreglo de al-cat-articulos
$objPHPExcel->getActiveSheet()->SetCellValue("Y3",$producto["descripcion"]);
/*COSECHA*/
$cosecha=get_cosecha_r($id_periodo);
$objPHPExcel->getActiveSheet()->SetCellValue("V3",$cosecha);
/*TONGAS*/
$tonga=get_tonga_nota_reporte($id_tonga);
$objPHPExcel->getActiveSheet()->SetCellValue("AA3",$tonga);

$fi=7;//filas generales
$sql="SELECT * FROM 
co_compras as com 
where 
com.id_almacen='$id_almacen' 
and 
com.id_catalogo='$id_catalogo' 
and 
com.id_periodo='$id_periodo' 
and 
com.fecha_nota between '$fecha_i' and '$fecha_f' order by com.folio";
	$consulta=pg_query($con,$sql);
	while($fila=pg_fetch_array($consulta))
	{
	
				$id_compra=$fila["id_compra"];
				$fila_cliente=get_cliente($fila["id_proveedor"]);
				$municipio=get_municipio($fila_cliente["idmunicipio"]);
				$estado=get_estado($fila_cliente["idestado"]);
				$nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
				$nom_cliente= limitarPalabras($nom_cliente,35); 
				$producto=get_catalogo_m($fila["id_catalogo"]);	//arreglo de al-cat-articulos
				
				
				
				
					

									
		
	
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
				
										
					$total_henequen=get_total_pesadas_tonga($id_compra,"hene",$id_tonga);
					$total_yute=get_total_pesadas_tonga($id_compra,"yute",$id_tonga);
					$total_bolsa=get_total_pesadas_tonga($id_compra,"bolsa",$id_tonga);
		
		$total_kgs_brutos=get_total_brutos($id_compra,$id_tonga);
		$peso_hene=get_peso_tara(1)*$total_henequen;//recuperamos el pesos de hene
		$peso_yute=get_peso_tara(2)*$total_yute;//recuperamos el pesos de yute
		$peso_bolsa=get_peso_tara(3)*$total_bolsa;//recuperamos el pesos de bolsa
		$total_kgs_netos=$total_kgs_brutos-$peso_hene-$peso_yute-$peso_bolsa;
		

//		$objPHPExcel->getActiveSheet()->SetCellValue($ab,$total_kgs_brutos);							
						

/*FECHA**/
$cfecha=$a.":".$b;
$objPHPExcel->getActiveSheet()->mergeCells($cfecha);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cfecha)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($a)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($a,$fila["fecha_nota"]);

/**FOLIO NOTA DE ENTRADA**/
$cfolio=$c.":".$d;
$objPHPExcel->getActiveSheet()->mergeCells($cfolio);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cfolio)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($c,$fila["folio"]);
/**NOMBRE DEL PRODUCTOR**/
$cprodu=$e.":".$i;
$objPHPExcel->getActiveSheet()->mergeCells($cprodu);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cprodu)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->SetCellValue($e,nom($nom_cliente));
/**POBLACION/ESTADO**/
$cpobla=$j.":".$k;
$objPHPExcel->getActiveSheet()->mergeCells($cpobla);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cpobla)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($j,$estado["estado"]);
/**POBLACION/MUNICIPIO**/
$cmuni=$l.":".$n;
$objPHPExcel->getActiveSheet()->mergeCells($cmuni);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cmuni)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($l)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($l,$municipio["municipio"]);
/**BULTOS**/
$bultos=$total_henequen+$total_yute+$total_bolsa;
$cmbultos=$o.":".$p;
$objPHPExcel->getActiveSheet()->mergeCells($cmbultos);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cmbultos)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($o)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($o)->getNumberFormat()->setFormatCode('#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($o,$bultos);
/**PESOS NETO**/
$cpeso=$q.":".$r;
$objPHPExcel->getActiveSheet()->mergeCells($cpeso);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cpeso)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($q)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($q)->getNumberFormat()->setFormatCode('#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($q,$total_kgs_netos);
/*RENDIMIENTO*/
$cren=$s.":".$s;
$objPHPExcel->getActiveSheet()->mergeCells($cren);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cren)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($s)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($s,$fila["rendimiento"]);
/*MANCHA*/
$cman=$t.":".$t;
$objPHPExcel->getActiveSheet()->mergeCells($cman);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cman)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($t)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($t,$fila["mancha"]);
/*HUMEDAD*/
$chum=$u.":".$u;
$objPHPExcel->getActiveSheet()->mergeCells($chum);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($chum)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($u)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($u,$fila["humedad"]);
/*CEREZO**/
$cer=$v.":".$v;
$objPHPExcel->getActiveSheet()->mergeCells($cer);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cer)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($v)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($v,$fila["cerezo"]);
/*CRIBA*/
$cri=$w.":".$w;
$objPHPExcel->getActiveSheet()->mergeCells($cri);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cri)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($w)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->SetCellValue($w,$fila["criba"]);;
/**PRECIO UNITARIO**/
$cprecio=$x.":".$y;
$objPHPExcel->getActiveSheet()->mergeCells($cprecio);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cprecio)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($x)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($x)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($x,$fila["precio_kilo"]);
/*VALOR DE INVENTARIO*/
$total_inv=$total_kgs_netos*$fila["precio_kilo"];
$cinvetn=$z.":".$aa;
$objPHPExcel->getActiveSheet()->mergeCells($cinvetn);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($cinvetn)->applyFromArray($borders); //PINTAMOS LOS BORDES
$objPHPExcel->getActiveSheet()->getStyle($z)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //alinjeamos al centro
$objPHPExcel->getActiveSheet()->getStyle($z)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($z,$total_inv);
				
				
			$sum_bultos+=$bultos;
			$sum_netos+=$total_kgs_netos;
			$sum_inv+=$total_inv;	
			
			
				
		 	                        
				$fi++;//filas generales	
			

			
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


$cmbultos=$o.":".$p;
$objPHPExcel->getActiveSheet()->mergeCells($cmbultos);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($o)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle($cmbultos)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($cmbultos)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
$objPHPExcel->getActiveSheet()->getStyle($o)->getNumberFormat()->setFormatCode('#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($o,$sum_bultos);


$cpeso=$q.":".$r;
$objPHPExcel->getActiveSheet()->mergeCells($cpeso);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($q)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle($cpeso)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($cpeso)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
$objPHPExcel->getActiveSheet()->getStyle($q)->getNumberFormat()->setFormatCode('#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($q,$sum_netos);

$cinvetn=$z.":".$aa;
$objPHPExcel->getActiveSheet()->mergeCells($cinvetn);//COMBINAMOS CELDAS
$objPHPExcel->getActiveSheet()->getStyle($z)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle($cinvetn)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle($cinvetn)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);
$objPHPExcel->getActiveSheet()->getStyle($z)->getNumberFormat()->setFormatCode('$#,##0.00'); //fromato de nuemros
$objPHPExcel->getActiveSheet()->SetCellValue($z,$sum_inv);
$style_negrita = array('font' => array('bold' => true,),);
$objPHPExcel->getActiveSheet()->getStyle($l)->applyFromArray($style_negrita);
$objPHPExcel->getActiveSheet()->SetCellValue($l,"SUMAS TOTALES");






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





