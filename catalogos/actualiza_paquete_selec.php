<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$id_paquete = $_POST["id_paquete"];

$form = $_POST["form"];

//$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($id_paquete));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		
		
		
		
		
	     $fila=get_paquete_tec_m($id_paquete);
	   
	     $id_paquete=$fila["id_paquete"];
		 $nom_paquete=$fila["nom_paquete"];
		 $descripcion_paquete=$fila["descripcion_paquete"];
		 $fecha_paq=$fila["fecha_paq"];
		  $ingre_hec=$fila["ingre_hec"];
		 $iduni=$fila["iduni"];
		 $precio_hec=$fila["precio_hec"];
		$smg=$fila["smg"];
		
		$modif=1;
		include("paquete_m.php");
		
		
		
	
	
	
		
	
	}
	
	if($form==2)
	{
	
	    
		include("paquete_new.php");
	}

	if($form==3)
	{
	
	  
	
	
	  $stock = get_reque_status($id_paquete);
	      
	if($stock==1)
	include("paq_add_reque.php");
	else
	include("paq_add_reque_new.php");
	
	

	
	
	
	
	
	}






?>