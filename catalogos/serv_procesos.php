<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

session_start();
$id_usuario=$_SESSION["usuario"];

$proceso=$_POST["proceso"];
$enviar=$_POST["enviar"];
$con=conectarse();



if($enviar=="GUARDAR" )
	{
	

 $sql="insert into cc_ptprocesos (proceso)  values('$proceso')";
	$consulta=pg_query($con,$sql);
	
	//registrar logs
	$usuario=$_SESSION["nombre_u"];
	$sql="select registrar_logs(1,currval('cc_ptprocesos_idproceso_seq')::text,'cc_ptprocesos','A','{$usuario}',
	'Alta de proceso para paquete : {$proceso}');";
	$querytmp = pg_query($con,$sql);
	
	
	if($consulta>0)
	{
	echo "<div align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
	include("alta_procesos.php");
	}
	else
	{
	echo "Error en el registro";
	}

	
	}




?>