<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$nombre=$_POST["nombre"];
$direccion=$_POST["direccion"];  
$telefono=$_POST["telefono"];  
$enviar=$_POST["enviar"];  


// solo para eliminar referencias del arreglo
$indice=$_POST["indice"];  
$form=$_POST["form"];  
//fin de las eliminaciones





$con=conectarse();




if($enviar=="AGREGAR")
{
	

	if(isset($_SESSION["refe_per"]))
	{
	
	$referencia=array("nombre"=>$nombre,"direccion"=>$direccion,"telefono"=>$telefono);
	
	$referencias=$_SESSION["refe_per"];
	unset($_SESSION["refe_per"]);
	
	
$referencias[]=$referencia;
//array_push($referencias,$referencia);
	
array_values($referencias);
array_filter($referencias);//quita cedenas vacias

$_SESSION["refe_per"]=$referencias;

   consul_refe_per($referencias);

	}

	else
	{
$referencia=array("nombre"=>$nombre,"direccion"=>$direccion,"telefono"=>$telefono);
		
$referencias=array($referencia);
		
		$_SESSION["refe_per"]=$referencias;
	
array_values($referencias);
array_filter($referencias);//quita cedenas vacias
		
		//print_r($referencias);
		
		consul_refe_per($referencias);
	
		
	}


}
	
	
	if($form==1)//comienza la eliminacion dentro de la modal
	{	
	
		
   		$referencias=$_SESSION["refe_per"];
		unset($_SESSION["refe_per"]);
		$tam=count($referencias);
		for($i=0;$i<$tam;$i++)
		{
		if($i==$indice)
		unset($referencias[$i]);
		}
			
			$referencias=array_values($referencias);
		    $referencias=array_filter($referencias);
			
			$_SESSION["refe_per"]=$referencias;
		
		consul_refe_per($referencias);	
		
		
		
	}
	
	if($form==2)//comienza la eliminacion
	{
					//$_SESSION["refe"];
			
			consul_refe_per_sol($_SESSION["refe_per"]);	
		
	}
	
	
	if($form==3)//comienza la eliminacion pero dentro de form de solicitud
	{
		$referencias=$_SESSION["refe_per"];
		unset($_SESSION["refe_per"]);
		$tam=count($referencias);
		for($i=0;$i<$tam;$i++)
		{
		if($i==$indice)
		unset($referencias[$i]);
		}
			
			$referencias=array_values($referencias);
			$referencias=array_filter($referencias);//quita cedenas vacias
			$_SESSION["refe_per"]=$referencias;
			
		
		consul_refe_per_sol($referencias);	
		
	}



?>