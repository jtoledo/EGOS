<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$usuario_id = $_POST["usuario_id"];
$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($usuario_id,$form));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		$c_usu="SELECT * FROM u_usuarios where uid='$usuario_id'";
		$query_usu=pg_query($con,$c_usu);
		while($row_usu=pg_fetch_array($query_usu))
		{
		$usuario_id=$row_usu["uid"];
		$nom_usuario=$row_usu["nombre"];
		$iniciales=$row_usu["iniciales"];
		$perfil_id=$row_usu["id_perfil"];
		$usuario_nick=$row_usu["usuario"];
		$contra = sha1($row_usu["contra"]);
		}

		$modif=1;  //valida que no se vuelva a consultar por defeto la tabla de usuarios
	
		include("f_m_u.php");
	
	}
	
	if($form==2)
	{
	include("f_new_u.php");
	$modif=0;
	}







?>