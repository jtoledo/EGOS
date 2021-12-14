<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idcliente = $_POST["idcliente"];
$form = $_POST["form"];
$fecha_corte = $_POST["fecha_corte"];
session_start();
$id_usuario=$_SESSION["usuario"];
$mov_sucursal=$_SESSION["mov_sucursal"];
$con=conectarse();
$errores_cuenta = validar_campos_obligatorios(array($idcliente,$fecha_corte,$form));	
	if(!empty($errores_cuenta))
	{
		$band_cuenta=1;
	}
	
	//form=1 es para poder generar nuestro estado de cuenta de nuestro clientes
	if($band_cuenta==1 and $form==1 )
	{
		$fila_sucursal=get_sucursal_m($mov_sucursal);
		$fila_usuario=get_usuario($fila_sucursal["idencargado"]);
		echo '<div align="left"><strong>BENEFICIO :</strong>'.$fila_sucursal["sucursal"].'<div>';
		echo '<div align="left"><strong>RESPONSABLE DEL ALMACEN :</strong> '.$fila_usuario["nombre"].'<div><br>';

		get_creditos_ministrados($idcliente,$fecha_corte);
		
		//get_servicios_cuenta($idcliente,$fecha_corte); //OBTIENE LOS SERVICIOS OTORGADOS DEL CLIENTE
		
		get_compras_cuenta($idcliente,$fecha_corte); //OBTIENE TODAS LAS COMPRAS DEL CLIENTE
		

	
	}
	




?>