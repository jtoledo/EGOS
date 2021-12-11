<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$idcliente=$_POST["idcliente"];
$id_parcela=$_POST["id_parcela"];  
$form=$_POST["form"];  

//$id_rela=$_POST["id_rela"];  

//$status=1;

//$fecha_activacion=date("Y-m-d");


$con=conectarse();

	if($idcliente>0 and $form==1 )
	{
	
	$img='<div align="center"><img src="../images/mas.png" alt="agrega parcela" title="Agregar Parcela" style="WIDTH: 20px; HEIGHT: 20px">';

echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"agrega_parcela_sol('".$id_parcela."','".$idcliente."')\">"


.$img.


"</a></div>";


	}
	
	if($idcliente>0 and $form==2 )
	{
	
	$img='<div align="center"><img src="../images/menos.png" alt="elimina parcela" title="Eliminar Parcela" style="WIDTH: 20px; HEIGHT: 20px">';

echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"del_parcela_sol('".$id_parcela."','".$idcliente."')\">"


.$img.


"</a></div>";


	}
	



?>