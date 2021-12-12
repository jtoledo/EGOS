<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$idcliente=$_POST["idcliente"];
$idgrupo=$_POST["idgrupo"];  
$form=$_POST["form"];  
$id_rela=$_POST["id_rela"];  

$status=1;

$fecha_activacion=date("Y-m-d");


$con=conectarse();




if($idcliente>0 and $form==1 )
	{
	
	$img='<div align="center"><img src="../images/mas.png" alt="agrega produ" title="Agregar" style="WIDTH: 35px; HEIGHT: 35px">';

echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"agrega_pro_grupo('".$idgrupo."','".$idcliente."')\">"


.$img.


"</a></div>";


	}
	
	if($id_rela>0 and $form==2 )
	{
	
	$img='<div align="center"><img src="../images/menos.png" alt="elimina produ" title="Eliminar productor" style="WIDTH: 35px; HEIGHT: 35px">';

echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"del_pro_grupo('".$idgrupo."','".$id_rela."')\">"


.$img.


"</a></div>";


	}

	



?>