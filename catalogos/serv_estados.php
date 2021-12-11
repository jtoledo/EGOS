<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$idestado=$_POST["estado"];
$idmunicipio=$_POST["municipio"];
$localidad=$_POST["localidad"];
$idlocalidad=$_POST["idlocalidad"];
$colonia=$_POST["colonia"];

$enviar=$_POST["enviar"];

$fecha=date("Y-m-d");

$con=conectarse();

if(isset($colonia))
{$band=1;}


if($enviar=="GUARDAR" and $band!=1)
	{
	

 $sql="insert into cc_localidades (idestado,idmunicipio,localidad,usuario,fecha_cambio)  values('$idestado','$idmunicipio','$localidad','$id_usuario','$fecha')";
	$consulta=pg_query($con,$sql);
	//registrar logs
	$usuario=$_SESSION["nombre_u"];
		$sql="select registrar_logs(1,currval('cc_localidades_idlocalidad_seq')::text,'cc_localidades','A','{$usuario}',
		'Alta de la localidad: {$localidad}');";
		$querytmp = pg_query($con,$sql);
	
	if($consulta>0)
	{
	echo "<div align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
	include("actualiza_localidades.php");
	}
	else
	{
	echo "Error en el registro";
	}

	
	}

	if($enviar=="GUARDAR" and $band==1)
	{
	

 $sql="insert into cc_colonias (idestado,idmunicipio,idlocalidad,colonia,usuario,fecha_cambia)  values('$idestado','$idmunicipio','$idlocalidad','$colonia','$id_usuario','$fecha')";
	$consulta=pg_query($con,$sql);

	//registrar logs
	$usuario=$_SESSION["nombre_u"];
	$sql="select registrar_logs(1,currval('cc_colonias_idcolonia_seq')::text,'cc_colonias','A','{$usuario}',
	'Alta de la colonia: {$colonia}');";
	$querytmp = pg_query($con,$sql);
		
	
	if($consulta>0)
	{
	echo "<div align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
	include("actualiza_colonias.php");
	}
	else
	{
	echo "Error en el registro";
	}

	
	}



?>