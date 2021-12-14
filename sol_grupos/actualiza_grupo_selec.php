<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$idgrupo = $_POST["idgrupo"];

$form = $_POST["form"];

//$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($idgrupo));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	    $fila=get_grupo_m($idgrupo);
		$modif=1;
		include("grupo_m.php");
		
	
	}
	
	if($form==2)
	{
	   
			
			 $fila_g=get_grupo_m($idgrupo);
			 $grupo=$fila_g["grupo"];
			 include("grupo_sol_new.php");
		
	
	}
	
	if($band==1 and $form==3)
	{
	$fila=get_grupo_m($idgrupo); 
	
	 
$id_tipo=get_tipo_cliente($fila["idrepresentante"]);
$tipo_cliente=get_cliente_tipo($id_tipo);
	  
		include("add_to_grup.php");
		
	
	}





?>