<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$perfil_id = $_POST["perfil_id"];
$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($perfil_id,$form));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		$c_perfil="SELECT * FROM perfiles where id_perfil='$perfil_id'";
	$query_c=pg_query($con,$c_perfil);
	while($row_perfil=pg_fetch_array($query_c))
	{
	$nom_perfil=$row_perfil["nombre_perfil"];
	$desc=$row_perfil["descripcion"];
	$perfil_id=$row_perfil["id_perfil"];
	}

		$modif=1;  //valida que no se vuelva a consultar por defeto la tabla de usuarios
	
		include("f_m_p.php");
	
	}
	
	if($form==2)
	{
	include("f_new_p.php");
	$modif=0;
	}







?>