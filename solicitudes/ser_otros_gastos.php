<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];
$otrosgastos=$_POST["otrosgastos"];
$otrosingresos=$_POST["otrosingresos"];
$ingre_bruto=$_POST["ingre_bruto"];  

$con=conectarse();
//servidor para buscar las siguientes variables:
//ingreso x cosecha
//costo de la cosecha
//ingreso bruto
//ingreso neto
if($ingre_bruto!="" )
{


$ingre_bruto = explode(",",$ingre_bruto); //se convierte en arreglo la session de parcelas

foreach($ingre_bruto as $valor)
{
$ingreso=$ingreso.$valor;	
}

$ingreso=floatval($ingreso);	


$ingreso=$ingreso-$otrosgastos;
$ingreso=$ingreso+$otrosingresos;




	echo '<input name="ingre_neto" type="text" class="itext" id="ingre_neto" onchange="conMayusculas(this)" value="'.number_format($ingreso,2).'" size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">';
		
		
		
		
}
else
{
	echo 0;
}
	
	



?>