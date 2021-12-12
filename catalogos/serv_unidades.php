<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

session_start();
$id_usuario=$_SESSION["usuario"];

$unidad=$_POST["unidad"];
$enviar=$_POST["enviar"];
$con=conectarse();



if($enviar=="GUARDAR" )
	{
	

 $sql="insert into cc_unidades (unidad)  values('$unidad')";
	$consulta=pg_query($con,$sql);
	
	//registrar logs
	$usuario=$_SESSION["nombre_u"];
	$sql="select registrar_logs(1,currval('cc_unidades_iduni_seq')::text,'cc_unidades','A','{$usuario}',
	'Alta de Unidad de medida: {$unidad}');";
	$querytmp = pg_query($con,$sql);
	
	if($consulta>0)
	{
	echo "<div align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
	include("alta_unidad.php");
	}
	else
	{
	echo "Error en el registro";
	}

	
	}




?>