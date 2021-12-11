<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$banco=$_POST["banco"];
$sucursal=$_POST["sucursal"];  
$direccion=$_POST["direccion"];  
$telefono=$_POST["telefono"];  
$tipo_cuenta=$_POST["tipo_cuenta"];  
$no_cuenta=$_POST["no_cuenta"];  
$contacto=$_POST["contacto"];  
$enviar=$_POST["enviar"];  


// solo para eliminar referencias del arreglo
$indice=$_POST["indice"];  
$form=$_POST["form"];  
//fin de las eliminaciones





$con=conectarse();




if($enviar=="AGREGAR")
{
	

	if(isset($_SESSION["refe"]))
	{
	
	$referencia=array("banco"=>$banco,"sucursal"=>$sucursal,"direccion"=>$direccion,"telefono"=>$telefono,"tipo_cuenta"=>$tipo_cuenta,"no_cuenta"=>$no_cuenta,"contacto"=>$contacto);
	
	$referencias=$_SESSION["refe"];
	unset($_SESSION["refe"]);
	
	
$referencias[]=$referencia;
//array_push($referencias,$referencia);
	
array_values($referencias);
array_filter($referencias);//quita cedenas vacias

$_SESSION["refe"]=$referencias;

   consul_refe($referencias);

	}

	else
	{
$referencia=array("banco"=>$banco,"sucursal"=>$sucursal,"direccion"=>$direccion,"telefono"=>$telefono,"tipo_cuenta"=>$tipo_cuenta,"no_cuenta"=>$no_cuenta,"contacto"=>$contacto);
		
		$referencias=array($referencia);
		
		$_SESSION["refe"]=$referencias;
	
array_values($referencias);
array_filter($referencias);//quita cedenas vacias
		
		//print_r($referencias);
		
		consul_refe($referencias);
	
		
	}


}
	
	
	if($form==1)//comienza la eliminacion dentro de la modal
	{	
	
		
   		$referencias=$_SESSION["refe"];
		unset($_SESSION["refe"]);
		$tam=count($referencias);
		for($i=0;$i<$tam;$i++)
		{
		if($i==$indice)
		unset($referencias[$i]);
		}
			
			$referencias=array_values($referencias);
		    $referencias=array_filter($referencias);
			
			$_SESSION["refe"]=$referencias;
		
		consul_refe($referencias);	
		
		
		
	}
	
	if($form==2)//comienza la eliminacion
	{
					//$_SESSION["refe"];
			
			consul_refe_sol($_SESSION["refe"]);	
		
	}
	
	
	if($form==3)//comienza la eliminacion pero dentro de form de solicitud
	{
		$referencias=$_SESSION["refe"];
		unset($_SESSION["refe"]);
		$tam=count($referencias);
		for($i=0;$i<$tam;$i++)
		{
		if($i==$indice)
		unset($referencias[$i]);
		}
			
			$referencias=array_values($referencias);
			$referencias=array_filter($referencias);//quita cedenas vacias
			$_SESSION["refe"]=$referencias;
			
		
		consul_refe_sol($referencias);	
		
	}



?>