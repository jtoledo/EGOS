<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idcliente = $_POST["idcliente"];
$form = $_POST["form"];
$id_compra = $_POST["id_compra"];

session_start();
$id_usuario=$_SESSION["usuario"];


$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente));	

		include("nueva_nota.php");
	



?>