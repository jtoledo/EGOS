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

		

		$array = explode("-",$_SESSION["idparcelas"]); //SEGUNDA VEZ SE COMVIERTE LA SESSION EN ARREGLO Y SE BUSCA QUE NO EXISTA LA PARCELA
		
		for($i=0;$i<count($array);$i++)
		{
			if($array[$i]==$id_parcela)
			unset($array[$i]); //eliminamos la parcela del arreglo
			
		}
			$array=array_values($array);
			$array=array_filter($array);//quita cedenas vacias
		
		//	unset($_SESSION['idparcelas']); //eliminamos la session de las parcelas
		
		foreach($array as $valor)
		{
			$cadena=$cadena.$valor."-";
		}
		$_SESSION["idparcelas"]=$cadena;
		
		

	get_parcelas_add($array,$idcliente);
	
	
	//print_r($array);
		
		
	}
	else
	{
	echo 0;	
	}

	


}
	
	

	



?>