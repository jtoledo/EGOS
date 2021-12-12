<?php
session_start();

include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$id_conf_paq = $_POST["id_conf_paq"];

$id_paquete = $_POST["id_paquete"];

//$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($id_conf_paq,$id_paquete));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1)
	{
	
	
	$sql = "DELETE FROM conf_paquete WHERE id_conf_paq = '$id_conf_paq'";
	$consulta=pg_query($con,$sql);
	
	//registrar logs
	$usuario=$_SESSION["nombre_u"];
	$sql="select registrar_logs(1,'{$id_conf_paq}','conf_paquete','D','{$usuario}',
	'Borrar configuracion de paquete con Id : {$id_conf_paq}');";
	$querytmp = pg_query($con,$sql);	
	
	
	if($consulta>0)
	{
		
		echo "<div align='center'><strong><font color='#003300'>Registro eliminado exitosamente</font></strong></div>";
		
		
		$form=3;
		$stock = get_reque_status($id_paquete);
			  
		if($stock==1)
		include("paq_add_reque.php");
		else
		include("paq_add_reque_new.php");
	
	}

	}
?>