<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$sucursal_id = $_POST["sucursal_id"];
$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($sucursal_id,$form));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1 and $form==1)
	{
	
		$c_sucursal="SELECT * FROM cc_sucursales WHERE id='$sucursal_id'";
		$query_c=pg_query($con,$c_sucursal);
			while($row_sucursal=pg_fetch_array($query_c))
			{
			$sucursal_id=$row_sucursal["id"];
			$sucursal=$row_sucursal["sucursal"];
			$direccion=$row_sucursal["direccion"];
			$telefono=$row_sucursal["telefono"];
			$cp=$row_sucursal["cp"];
			$idsede=$row_sucursal["idsede"];
			$idencargado=$row_sucursal["idencargado"];
			
			}
		$modif=1;  //valida que no se vuelva a consultar por defeto la tabla de usuarios
	
		include("f_m_s.php");
	
	}
	
	if($form==2)
	{
	include("f_new_s.php");
	$modif=0;
	}







?>