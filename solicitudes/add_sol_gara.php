<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idcliente = $_POST["idcliente"];
$form = $_POST["form"];
$idgtia_p = $_POST["idgtia_p"];

session_start();
$id_usuario=$_SESSION["usuario"];


$con=conectarse();

$errores = validar_campos_obligatorios(array($idgtia_p));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
if($band==1 and $form==1)  //consulta garantias prendarias
{
	    
		
		if(isset($_SESSION["garantia_prendaria"]))
	{
		//unset($_SESSION['idparcelas']);  

		if($_SESSION["garantia_prendaria"]==$idgtia_p)//PRIMERA VEZ CHECA SI NO ESTA REPETIDA LA PARCELA
		{
		echo 0;
		exit;
		}

		$array_cmp = explode("-",$_SESSION["garantia_prendaria"]); //SEGUNDA VEZ SE COMVIERTE LA SESSION EN ARREGLO Y SE BUSCA QUE NO EXISTA LA PARCELA
		if(in_array($idgtia_p, $array_cmp)) 
		{
			echo 0;
			exit;
		}


		$idgtia_ps=$_SESSION["garantia_prendaria"]."-".$idgtia_p;
		$_SESSION["garantia_prendaria"]=$idgtia_ps;

			//echo $_SESSION["idparcelas"]."<br>";

		$array = explode("-",$idgtia_ps); //convertimos en arreglo las parcelas


		get_gara_p_selecc($array);
	}

	else
	{
		$_SESSION["garantia_prendaria"]=$idgtia_p;
		$idgtia_ps=$idgtia_p;
		add_select_gara_p($idgtia_p);
	}		
		
		
	//unset($_SESSION['garantia_prendaria']); 	
	
}
	

	


?>