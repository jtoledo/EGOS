<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$idrequerimiento = $_POST["idrequerimiento"];
$formu = $_POST["form"];

$idproceso = $_POST["idproceso"];

$id_paquete = $_POST["id_paquete"];


$con=conectarse();

$errores = validar_campos_obligatorios(array($idrequerimiento,$form));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $formu==1)
	{
	$modif=1;
	include("requerimiento_m.php");
	
	}
	
	if($band==1 and $formu==3)
	{
	$form=4;
	$stock=1;
	
//$form=$formu;
//$stock = get_reque_status($id_paquete);
		
	//echo $idrequerimiento.$id_paquete;
	include("paq_add_reque_new.php"); //ACA ES DONDE DAMOS DE ALTA UN NEW RQUERIMIENTO Y RESCATAMOS LOS VALORES ANTERIORES DEL REQUE EN EN CATALOGO
	
	}
	
	
	
	if($formu==4)
	{
	  $fila=get_paquete_tec_m($id_paquete);
	   
/*	     $id_paquete=$fila["id_paquete"];
		 $nom_paquete=$fila["nom_paquete"];
		 $descripcion_paquete=$fila["descripcion_paquete"];
		 $fecha_paq=$fila["fecha_paq"];
*/
	     $id_paquete=$fila["id_paquete"];
		 $nom_paquete=$fila["nom_paquete"];
		 $descripcion_paquete=$fila["descripcion_paquete"];
		 $fecha_paq=$fila["fecha_paq"];
		  $ingre_hec=$fila["ingre_hec"];
		 $iduni=$fila["iduni"];
		 $precio_hec=$fila["precio_hec"];

		
		$modif=1;
		include("paquete_m.php");
	
	}
	
	
	
	if($form==2 and $idrequerimiento=="")
	{
	$modif=1;
	include("requerimiento_new.php");
	}







?>