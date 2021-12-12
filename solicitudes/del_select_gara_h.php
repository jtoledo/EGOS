<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$form=$_POST["form"];
$idgtia_h=$_POST["idgtia_h"];  


$con=conectarse();




if($form>0 and $idgtia_h>0)
{
	

	if(isset($_SESSION["garantia_hipotecaria"]))
	{
		//unset($_SESSION['idparcelas']);  

		

		$array_cmp = explode("-",$_SESSION["garantia_hipotecaria"]); //SEGUNDA VEZ SE COMVIERTE LA SESSION EN ARREGLO Y SE BUSCA QUE NO EXISTA LA garantia

		$borrar = array($idgtia_h); 

		$array_cmp_new = array_diff($array_cmp, $borrar); 
		
		foreach($array_cmp_new as $valor)
		{
			
			
			$cadena=$cadena.$valor."-";
		}
		
		$_SESSION["garantia_hipotecaria"]=$cadena;
		
		$array = explode("-",$cadena); //convertimos en arreglo las garantias hipotecarias


		get_gara_h_selecc($array);
		
		
	}
	else
	{
	echo 0;	
	}

	


}
	
	

	



?>