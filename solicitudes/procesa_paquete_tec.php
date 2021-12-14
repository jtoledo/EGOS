<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];
$idcliente=$_POST["idcliente"];
$form=$_POST["form"];  
$id_paquete=$_POST["id_paquete"];  
$con=conectarse();
//servidor para buscar las siguientes variables:
//ingreso x cosecha
//costo de la cosecha
//ingreso bruto
//ingreso neto
if($idcliente>0 and $id_paquete>0)
{
	

	if(isset($_SESSION["idparcelas"]))
	{
		
		$costo_cultivo_m2=get_costo_cultivo($id_paquete); //se obtiene la suma total de requerimientos por m2
		
		$array_parcelas = explode("-",$_SESSION["idparcelas"]); //se convierte en arreglo la session de parcelas
		$array_parcelas=array_filter($array_parcelas); //se quita cualquier cadena vacia que tenga las parcelas
		
		$suma_parcelas_m2=get_parcelas_m2($array_parcelas);// se obtiene las suma de todas las parcelas en  m2
		
		$costo_cultivo_total=$suma_parcelas_m2*$costo_cultivo_m2;
		
		$ingreso_por_hect=get_ingreso_xhec($id_paquete);  //inreso por hectaria recuperacion de la tabla de paquete-tec
		
		$ingreso_por_m2=$ingreso_por_hect/10000; //ingreso por en m2
		
		$super_total_cult=$suma_parcelas_m2*$ingreso_por_m2;
		
		$ingreso_bruto=$super_total_cult-$costo_cultivo_total;
		
		$porcentaje_liq=get_liquidez($idcliente);
		
		$monto=($ingreso_bruto*$porcentaje_liq)/100;
		
		
		//$mont=$ingreso_bruto/2;
		
//		echo $super_total_cult;
		
		 echo '<input name="ingre_cosecha" type="text" class="itext" id="ingre_cosecha" onchange="conMayusculas(this)" value='.number_format($super_total_cult,2).' size="20" maxlength="255" onkeypress="return acceptNum(event)"  readonly="readonly">';
		
		
		echo "#";
		
//		echo $costo_cultivo_total;
		
echo '<input name="costo_cosecha" type="text" class="itext" id="costo_cosecha" onchange="conMayusculas(this)" value='.number_format($costo_cultivo_total,2).' size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">';
		
		echo "#";

//		echo $ingreso_bruto;

echo '<input name="ingre_bruto" type="text" class="itext" id="ingre_bruto" onchange="conMayusculas(this)" value='.number_format($ingreso_bruto,2).' size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">';

		echo "#";
		
		
		//echo $ingreso_bruto;
		
		echo '<input name="ingre_neto" type="text" class="itext" id="ingre_neto" onchange="conMayusculas(this)" value='.number_format($ingreso_bruto,2).' size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">';
		
	echo "#";
		
		
		echo '<input name="monto" type="text" class="itext" id="monto" onchange="conMayusculas(this)" value="'.number_format($monto,2).'" size="20" maxlength="255"  onkeypress="return acceptNum(event)" />';
		
		
		
		
	}

	else
	{
		echo 0;  //posiblemente no ha seleccionado las parcelas por lo tanto ponemos en cero al paquete tecnologico
	
		
		
	
	
		
	}


}
	
	

	



?>