<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idcliente = $_POST["idcliente"];
$form = $_POST["form"];
$idaval = $_POST["idaval"];

session_start();
$id_usuario=$_SESSION["usuario"];


$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)  //consulta garantias prendarias
	{
	    
		get_g_p_propia($idcliente);
	
	}
	if($band==1 and $form==2)
	{
	    
		get_g_p_aval($idcliente); //consulta avales prendarios
		
		
	
	}
	
	if($band==1 and $form==3) //consulta garantias hipotecarias
	{
	    
		get_g_p_propia($idaval);
	
	}

	if($band==1 and $form==4) //consulta garantias hipotecarias
	{
	    
		get_g_h_propia($idcliente);
	
	}
	
	if($band==1 and $form==5)
	{
	    
		get_g_h_aval($idcliente); //consulta avales hipotecarios
		
		
	
	}
	
	
	if($band==1 and $form==6) //consulta garantias hipotecarias
	{
	    
		get_g_h_propia($idaval);
	
	}

	


?>