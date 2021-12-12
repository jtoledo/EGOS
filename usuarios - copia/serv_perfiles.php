<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

$nom_perfil = $_POST["nom_perfil"];
$desc = $_POST["desc"];
$enviar = $_POST["enviar"];
$perfil_id = $_POST["perfil_id"];

//solo no validamos id_para modificar

$con=conectarse();

$errores = validar_campos_obligatorios(array($nom_perfil,$desc,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}


if($enviar=="GUARDAR" and $band==1)
	{
	//$id_usuario=1; ///  temporal recuperar usuario de la secion al estableserla 
	$sql="INSERT INTO perfiles (nombre_perfil,descripcion) values('{$nom_perfil}','{$desc}')";
	$consulta=pg_query($con,$sql);
	if($consulta>0)
	include("consul_perfiles.php");
	else
	echo "Error en el registro intente de nuevo mas tarde";
	}


	
	
	if($enviar=="MODIFICAR" and $band==1)
	{
	
	$sql="UPDATE perfiles set nombre_perfil='$nom_perfil',descripcion='$desc' where id_perfil='$perfil_id' ";
	$consulta=pg_query($con,$sql);
	if($consulta>0)
	include("consul_perfiles.php");
	else
	echo "Error en el registro intente de nuevo mas tarde";

	}

	



?>