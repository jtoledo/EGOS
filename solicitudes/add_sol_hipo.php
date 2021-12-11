<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


//$idcliente = $_POST["idcliente"];


$form = $_POST["form"];
$idgtia_h = $_POST["idgtia_h"];

session_start();
$id_usuario=$_SESSION["usuario"];


$con=conectarse();

$errores = validar_campos_obligatorios(array($idgtia_h));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
if($band==1 and $form==1)  //consulta garantias Hipotecarias
{
	    
		
		if(isset($_SESSION["garantia_hipotecaria"]))
	{
		//unset($_SESSION['idparcelas']);  

		if($_SESSION["garantia_hipotecaria"]==$idgtia_h)//PRIMERA VEZ CHECA SI NO ESTA REPETIDA LA garantia
		{
		echo 0;
		exit;
		}

		$array_cmp = explode("-",$_SESSION["garantia_hipotecaria"]); //SEGUNDA VEZ SE COMVIERTE LA SESSION EN ARREGLO Y SE BUSCA QUE NO EXISTA LA gara hipo
		if(in_array($idgtia_h, $array_cmp)) 
		{
			echo 0;
			exit;
		}


		$idgtia_hs=$_SESSION["garantia_hipotecaria"]."-".$idgtia_h;
		$_SESSION["garantia_hipotecaria"]=$idgtia_hs;

			//echo $_SESSION["idparcelas"]."<br>";

		$array = explode("-",$idgtia_hs); //convertimos en arreglo las garantias hipotecarias


		get_gara_h_selecc($array);
	}

	else
	{
		$_SESSION["garantia_hipotecaria"]=$idgtia_h;
		$idgtia_hs=$idgtia_h;
		add_select_hipo_h($idgtia_h);
	}		
		
		
	//unset($_SESSION['garantia_prendaria']); 	
	
}
	

	


?>