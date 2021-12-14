<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$idgrupo = $_POST["idgrupo"];

$form = $_POST["form"];

$idsolgrupo = $_POST["idsolgrupo"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($idgrupo));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
		
		//verificar si hay solicitudes grupales
		
		 $fila=get_grupo_sol_consulta_sol($idgrupo);
		 
		 if($fila!=0)//quiere decir q si tiene solicitudes grupales
		 {
		$idsolgrupo=$fila["idsolgrupo"];
	    $fila=get_grupo_sol_modif($idsolgrupo,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
		$modif=1;
		include("grupo_sol_m.php");
	  
	  
	   }
		 else //no hay solicitudes grupales mandar a nueva solicitud
		 {
			 include("grupo_sol_new.php");
		 }
		 
		
	   
	
	}
	
	if($form==2)
	{
	   
		include("grupo_new.php");
		
	
	}
	
	if($band==1 and $form==3)
	{
		
		 $fila=get_grupo_sol_consulta_sol($idgrupo);
		 
		 if($fila!=0)//quiere decir q si tiene solicitudes grupales
		 {
		$idsolgrupo=$fila["idsolgrupo"];
	    $fila=get_grupo_sol_modif($idsolgrupo,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
		$modif=1;
		include("grupo_sol_m.php");
	  
	  
	   }
		 else //no hay solicitudes grupales mandar a nueva solicitud
		 {
			 $fila_g=get_grupo_m($idgrupo);
			 $grupo=$fila_g["grupo"];
			 include("grupo_sol_new.php");
		 }
		 
	  

	
	}
	
	if($form==4)
	{
		$fila=get_grupo_sol_modif($idsolgrupo,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
		$modif=1;
		include("grupo_sol_m.php");
		
	}





?>