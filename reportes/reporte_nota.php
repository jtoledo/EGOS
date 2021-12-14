<?php 
ob_start(); 
session_start();
$id_compra=$_GET["id_compra"];
$proveedor=$_GET["proveedor"];
$formato_blanco=$_GET["frm"];
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();
$fila=get_nota_arreglo($id_compra,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']); 
$id_compra=$fila["id_compra"];
$id_almacen=$fila["id_almacen"];
$idcliente=$fila["id_proveedor"];

$idproductor=$fila["id_productor"];
$id_catalogo=trim($fila["id_catalogo"]);
$produccion=trim($fila["produccion"]);
$fecha_nota=$fila["fecha_nota"];
$vehiculo=$fila["vehiculo"];
$folio=$fila["folio"];
$resto_alimentos=$fila["resto_alimentos"];
$desechos_human=$fila["desechos_human"];
$olores_desa=$fila["olores_desa"];
$otros_organicos=$fila["otros_organicos"];
$manchas_comb=$fila["manchas_comb"];
$vehiculo_sucio=$fila["vehiculo_sucio"];
$olor_detergente=$fila["olor_detergente"];
$otros_inorganicos=$fila["otros_inorganicos"];
$precio_kilo=$fila["precio_kilo"];
$rendimiento=$fila["rendimiento"];
$mancha=$fila["mancha"];
$humedad=$fila["humedad"];
$cerezo=$fila["cerezo"];
$criba=$fila["criba"];
$resultado_analisis=$fila["resultado_analisis"];
$constancia_cmc=$fila["constancia_cmc"];
$forma_pago=$fila["forma_pago"];
$no_cheque=$fila["no_cheque"];
$banco_cheque=$fila["banco_cheque"];
$costalera=$fila["costalera"];
$estado_costalera=$fila["estado_costalera"];
$observaciones=$fila["observaciones"];
$total_kgs_brutos=$fila["total_kgs_brutos"];
$total_kgs_netos=$fila["total_kgs_netos"];
$total_tara=$fila["total_tara"];
$total_kgs_neto2=$fila["total_kgs_neto2"];
$subtotal=$fila["subtotal"];
$fila_cliente=get_cliente($idcliente);
$fila_productor=get_cliente($idproductor);
$nom_clientes=" ".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."  ";
$nom_productor=" ".$fila_productor["nombre"]." ".$fila_productor["ap_paterno"]." ".$fila_productor["ap_materno"]."  ";
$domicilio=$fila_cliente["domicilio"];

set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
if ($formato_blanco==1)
{
		$objPHPExcel = $objReader->load("plantilla_nota_n.xlsx");
}else {
		$objPHPExcel = $objReader->load("plantilla_nota.xlsx");
}
$objPHPExcel->setActiveSheetIndex(0);

$id_usuario=$_SESSION["usuario"];


/***RECUPERACION DE USUARIO DEL SISTEMA**/
$fila_usuario=get_usuario($id_usuario);
$objPHPExcel->getActiveSheet()->SetCellValue('I51',nom($fila_usuario["nombre"]));
$objPHPExcel->getActiveSheet()->SetCellValue('K51',nom($nom_clientes));
/****/
//agregar proveedor

if($proveedor==1) 
{
	$objPHPExcel->getActiveSheet()->SetCellValue('A6','PROVEEDOR:');	
	$objPHPExcel->getActiveSheet()->SetCellValue('B6',nom($nom_clientes));
}

$objPHPExcel->getActiveSheet()->SetCellValue('L2',$folio);
$objPHPExcel->getActiveSheet()->SetCellValue('I6',$fecha_nota);
$objPHPExcel->getActiveSheet()->SetCellValue('B7',nom($nom_productor));
$objPHPExcel->getActiveSheet()->SetCellValue('B8',nom($domicilio));
$objPHPExcel->getActiveSheet()->SetCellValue('C9',nom($vehiculo));

//OBTENEMOS QUE TIPO DE CAFE
//deacuerdo a la tabla de clasificador
/*
1. PERGAMINO
2. CEREZO
3. ROBUSTA
4. ORO
*/

$tipo_cafe=get_clasifica_cafe($id_catalogo);


	
if($tipo_cafe==3)
{

	if(trim($produccion)=="trad")
	{ 
		$objPHPExcel->getActiveSheet()->SetCellValue('O9',"X");	  
	}
	if(trim($produccion)=="org")
	{ 
	  $objPHPExcel->getActiveSheet()->SetCellValue('P9',"X");	  
	}
	if(trim($produccion)=="4c")
	{ 
	  $objPHPExcel->getActiveSheet()->SetCellValue('N9',"X");	  
	}
}
if($tipo_cafe==1)
{
	if($produccion=="trad")
	{ 
		$objPHPExcel->getActiveSheet()->SetCellValue('O7',"X");	  
	}
	if($produccion=="org")
	{ 
	  $objPHPExcel->getActiveSheet()->SetCellValue('P7',"X");	  
	}
	if(trim($produccion)=="4c")
	{ 
	  $objPHPExcel->getActiveSheet()->SetCellValue('N7',"X");	  
	}
}

if($tipo_cafe==2)
{
	if($produccion=="trad")
	{ 
		$objPHPExcel->getActiveSheet()->SetCellValue('O8',"X");	  
	}
	if($produccion=="org")
	{ 
	  $objPHPExcel->getActiveSheet()->SetCellValue('P8',"X");	  
	}
	if(trim($produccion)=="4c")
	{ 
	  $objPHPExcel->getActiveSheet()->SetCellValue('N8',"X");	  
	}
}
if($tipo_cafe==4)
{
	  
	  $objPHPExcel->getActiveSheet()->SetCellValue('k10',"OTROS: $tipo_cafe");
	  
	 /* $objPHPExcel->getActiveSheet()->SetCellValue('07',"");
	  $objPHPExcel->getActiveSheet()->SetCellValue('08',"");
	  $objPHPExcel->getActiveSheet()->SetCellValue('09',"");*/
	  $objPHPExcel->getActiveSheet()->SetCellValue('P7',"");
	  $objPHPExcel->getActiveSheet()->SetCellValue('P8',"");
	  $objPHPExcel->getActiveSheet()->SetCellValue('P9',"");
	  $objPHPExcel->getActiveSheet()->SetCellValue('N7',"");
	  $objPHPExcel->getActiveSheet()->SetCellValue('N8',"");
	  $objPHPExcel->getActiveSheet()->SetCellValue('N9',"");

}



if($resto_alimentos=="t")
 $objPHPExcel->getActiveSheet()->SetCellValue('E13',"X");	  
	else
$objPHPExcel->getActiveSheet()->SetCellValue('G13',"X");

if($desechos_human=="t")
 $objPHPExcel->getActiveSheet()->SetCellValue('E14',"X");	  
	else
 $objPHPExcel->getActiveSheet()->SetCellValue('G14',"X");	  

if($olores_desa=="t")
 $objPHPExcel->getActiveSheet()->SetCellValue('E15',"X");	  
	else
 $objPHPExcel->getActiveSheet()->SetCellValue('G15',"X");	  
/*
if($otros_organicos=="t")
 $objPHPExcel->getActiveSheet()->SetCellValue('E16',"X");	  
	else
 $objPHPExcel->getActiveSheet()->SetCellValue('G16',"X");	  
*/


if($manchas_comb=="t")
 $objPHPExcel->getActiveSheet()->SetCellValue('L13',"X");	  
	else
 $objPHPExcel->getActiveSheet()->SetCellValue('O13',"X");	  

if($vehiculo_sucio=="t")
 $objPHPExcel->getActiveSheet()->SetCellValue('L14',"X");	  
	else
 $objPHPExcel->getActiveSheet()->SetCellValue('O14',"X");	  
	
if($olor_detergente=="t")
 $objPHPExcel->getActiveSheet()->SetCellValue('L15',"X");	  
	else
 $objPHPExcel->getActiveSheet()->SetCellValue('O15',"X");	  


/*	
if($otros_inorganicos=="t")
 $objPHPExcel->getActiveSheet()->SetCellValue('L16',"X");	  
	else
 $objPHPExcel->getActiveSheet()->SetCellValue('O16',"X");	  
*/



 $objPHPExcel->getActiveSheet()->SetCellValue('E29',number_format($total_kgs_brutos,2));	  
 $objPHPExcel->getActiveSheet()->SetCellValue('E30',number_format($total_tara,2));	  
 $objPHPExcel->getActiveSheet()->SetCellValue('E31',number_format($total_kgs_netos,2));	  
 $objPHPExcel->getActiveSheet()->SetCellValue('E32',"$ ".number_format($precio_kilo,2));	  
 $objPHPExcel->getActiveSheet()->SetCellValue('E33',"$ ".number_format($subtotal,2));	  
 
 $objPHPExcel->getActiveSheet()->SetCellValue('A36',number_format($rendimiento,2));	  
 $objPHPExcel->getActiveSheet()->SetCellValue('C36',number_format($mancha,2));
 $objPHPExcel->getActiveSheet()->SetCellValue('F36',number_format($humedad,2));
 $objPHPExcel->getActiveSheet()->SetCellValue('I36',number_format($cerezo,2));	  
 $objPHPExcel->getActiveSheet()->SetCellValue('J36',number_format($criba,2));
 
 
if($resultado_analisis=="t")
$objPHPExcel->getActiveSheet()->SetCellValue('L36',"X");
else
$objPHPExcel->getActiveSheet()->SetCellValue('P36',"X");


if($constancia_cmc=="t")
$objPHPExcel->getActiveSheet()->SetCellValue('C40',"X");
else
$objPHPExcel->getActiveSheet()->SetCellValue('G40',"X");


//$objPHPExcel->getActiveSheet()->SetCellValue('J40',);//RECUPERAR NUMERO DE PRODUCTOR DE CC_CLIENTES **************PENDIENTE



$objPHPExcel->getActiveSheet()->SetCellValue('O40',number_format($total_kgs_neto2,2));


if($forma_pago==1)
$objPHPExcel->getActiveSheet()->SetCellValue('G44',"X");
if($forma_pago==2)
$objPHPExcel->getActiveSheet()->SetCellValue('D44',"X");


$objPHPExcel->getActiveSheet()->SetCellValue('J44',$no_cheque);

$objPHPExcel->getActiveSheet()->SetCellValue('L44',$banco_cheque);


	if($costalera==1)
$objPHPExcel->getActiveSheet()->SetCellValue('C51',"X");
	if($costalera==2)
$objPHPExcel->getActiveSheet()->SetCellValue('C52',"X");
	if($costalera==3)
$objPHPExcel->getActiveSheet()->SetCellValue('C53',"X");


if($estado_costalera=="t")
{
$objPHPExcel->getActiveSheet()->SetCellValue('G52',"X");
}
else
{
$objPHPExcel->getActiveSheet()->SetCellValue('G51',"X");
}


$objPHPExcel->getActiveSheet()->SetCellValue('C54',trim(nom($observaciones)));

/*****************CALCULAMOS LAS PESADAS*******************/
//BLOQUE IZQUIEROD
$fi=20;
$ff=28;
$di=20;
$df=28;


	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM co_pesadas where id_compra='$id_compra' ";
	   $id_query = pg_query($con,$consulta);
	
	
		 while($fila_p= pg_fetch_array($id_query))
		   {
			 
			 if($fi<=$ff)
			 {
				$ini_izq="A".$fi;
				$posy="B".$fi;
				$posb="C".$fi;
				$posbr="E".$fi;
				$post="G".$fi;
					 
			 $objPHPExcel->getActiveSheet()->SetCellValue($ini_izq,$fila_p["henequen"]);
			 $objPHPExcel->getActiveSheet()->SetCellValue($posy,$fila_p["yute"]);
			 $objPHPExcel->getActiveSheet()->SetCellValue($posb,$fila_p["bolsa"]);
			 $objPHPExcel->getActiveSheet()->SetCellValue($posbr,number_format($fila_p["kgs_brutos"],2));
			 $tonga=get_tonga_nota_reporte($fila_p["id_tonga"]);
			 $objPHPExcel->getActiveSheet()->SetCellValue($post,$tonga);
			 }
			 if($fi>$ff)
			 {
				 
				
				$ini_der="I".$di; 
				$posy="J".$di;
				$posb="K".$di;
				$posbr="L".$di;
				$post="P".$di;
					 
			 $objPHPExcel->getActiveSheet()->SetCellValue($ini_der,$fila_p["henequen"]);
			 $objPHPExcel->getActiveSheet()->SetCellValue($posy,$fila_p["yute"]);
			 $objPHPExcel->getActiveSheet()->SetCellValue($posb,$fila_p["bolsa"]);
			 $objPHPExcel->getActiveSheet()->SetCellValue($posbr,$fila_p["kgs_brutos"]);
			 $tonga=get_tonga_nota_reporte($fila_p["id_tonga"]);
			 $objPHPExcel->getActiveSheet()->SetCellValue($post,$tonga);
			 $di++;
			 }
			 
			   
			   
			  $fi++; 
			  
		   }
	 




/*********************FIN DEL CALCULO DE LAS PESADAS*/







$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("nota_entrada.xlsx");

$enlace = "nota_entrada.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





