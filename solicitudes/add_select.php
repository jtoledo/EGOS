<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$idcliente=$_POST["idcliente"];
$id_parcela=$_POST["id_parcela"];  


$con=conectarse();




if($idcliente>0 and $id_parcela>0)
{
	

	if(isset($_SESSION["idparcelas"]))
	{
		//unset($_SESSION['idparcelas']);  

		if($_SESSION["idparcelas"]==$id_parcela)//PRIMERA VEZ CHECA SI NO ESTA REPETIDA LA PARCELA
		{
		echo 0;
		exit;
		}

		$array_cmp = explode("-",$_SESSION["idparcelas"]); //SEGUNDA VEZ SE COMVIERTE LA SESSION EN ARREGLO Y SE BUSCA QUE NO EXISTA LA PARCELA
		if(in_array($id_parcela, $array_cmp)) 
		{
			echo 0;
			exit;
		}

		
		$id_parcelas=$_SESSION["idparcelas"]."-".$id_parcela;
		//$id_parcelas=implode("-",$array_cmp);
		
		//unset($_SESSION['idparcelas']);
		$_SESSION["idparcelas"]=$id_parcelas;

			//echo $_SESSION["idparcelas"]."<br>";

		$array = explode("-",$_SESSION["idparcelas"]); //convertimos en arreglo las parcelas
		$array=array_filter($array);//quita cedenas vacias, elementos vacios con sus posicion

		get_parcelas_add($array,$idcliente);
		
		
	//	print_r($array);
		
	}

	else
	{
		$_SESSION["idparcelas"]=$id_parcela;
		$id_parcelas=$id_parcela;
	get_parcelas_add_unic($id_parcela,$idcliente);
	
		
		//echo $id_parcelas;
	
	
		
	}


}
	
	

	



?>