<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$bandera=$_POST["bandera"];

$con=conectarse();




if($bandera>0)
{
	
get_tonga_nota();


}
else
{
echo 0;
}
	
	

	



?>