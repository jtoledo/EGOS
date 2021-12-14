<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idcliente = $_POST["idcliente"];

$idsolicitud = $_POST["idsolicitud"];

$form = $_POST["form"];

session_start();
$id_usuario=$_SESSION["usuario"];


$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form!=1)
	{
	    
		$nom_asesor=get_asesor($id_usuario);
		include("solicitud_new.php");
		
	
	}
	
	if($idsolicitud > 0 and $form==1 )
	{
	   
		$fila=get_solicitud_m($idsolicitud);  //cuando no hay una consulta determinada se consulta la primera solicitud
		$modif=1;
		include("solicitud_m.php");
		
	
	}
		




?>