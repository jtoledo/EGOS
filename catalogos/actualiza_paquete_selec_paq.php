<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$id_conf_paq = $_POST["id_conf_paq"];

$form = $_POST["form"];

//$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($id_conf_paq));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		
		
		
		
		$modif=1;
		include("paq_add_reque.php");
		
		
		
	
	
	
		
	
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