<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$id_catalogo=trim($_POST["id_catalogo"]);
$form=$_POST["form"];  

$con=conectarse();




		if($form==1)//actualizacion o recuperacion de precio de cafe
			{
				$consulta=pg_query($con,"SELECT * FROM al_cat_articulos where id_catalogo='$id_catalogo'");
				if($fila=pg_fetch_array($consulta))	
				{
					$precio_cafe=$fila["precio1"];
					echo $precio_cafe;

				}
				else
				{
					echo "";
				}
				
			}



?>