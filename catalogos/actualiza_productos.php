<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$idproducto = $_POST["idproducto"];
$form = $_POST["form"];

//$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($idproducto));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		 $fila= consul_productos_m($idproducto);
//		echo $producto["idproducto"];
	$idproducto=$fila["idproducto"];
	$producto=$fila["producto"];
	$id_tipo=$fila["id_tipo"];//obtener que tipo de credito es
	$interes_mensual=$fila["interes_mensual"];//boolenano
	$plazo=$fila["plazo"];
	$idper=$fila["idper"]; //periodo
	$interes_normal=$fila["interes_normal"];
	$interes_moratorio=$fila["interes_moratorio"];
	$id_pago=$fila["id_pago"];
	
	
	$interes_normal_m=$interes_normal*12;
	$interes_moratorio_m=$interes_moratorio*12;
	//$tipo_credito=get_tipo_credito($id_tipo);
	if($interes_mensual=="t")
	$tasa_interes=1;
	else
	$tasa_interes=0;
	
	//$periodo=get_periodo($idper);
		
		
		
		
		$modif=1;
		include("f_recursos.php");
	
	}
	
	if($form==2)
	{
	
	
	
	include("f_recursos_new.php");
	$modif=0;
	}







?>