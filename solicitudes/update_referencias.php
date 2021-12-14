<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$idref=$_POST["idref"];
$form=$_POST["form"];  
$idcliente=$_POST["idcliente"];  
$con=conectarse();
if($form==1)  // RELLENADO DE FORMULARIO DE REFERENCIAS BANCARIAS
{
	$fila=get_ref_bancarias($idref);
    $banco=$fila["banco"];
	$sucursal=$fila["sucursal"];
	$direccion=$fila["direccion"];
	$telefono=$fila["telefono"];
	$tipo_cuenta=$fila["tipo_cuenta"];
	$no_cuenta=$fila["no_cuenta"];
	$contacto=$fila["contacto"];
	
	include("formulario_ref_bancaria.php");
}
if($form==2)  // RELLENADO DE FORMULARIO DE REFERENCIAS BANCARIAS
{
	$fila=get_ref_personales($idref);
    $nombre=$fila["nombre"];
	$direccion=$fila["direccion"];
	$telefono=$fila["telefono"];
	
	include("formulario_ref_personal.php");
}

?>