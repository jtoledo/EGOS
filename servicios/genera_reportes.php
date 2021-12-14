<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idcliente = $_POST["idcliente"];
$form = $_POST["form"];
$opcion = $_POST["opcion"];
session_start();
$id_usuario=$_SESSION["usuario"];
$con=conectarse();
$errores_reporte = validar_campos_obligatorios(array($idcliente,$opcion,$form));	
	if(!empty($errores_reporte))
	{
		$band_reporte=1;
	}
	
	//form=1 es para poder generar reportes de los servicios
	if($band_reporte==1 and $form==1 )
	{
		
		$fila=get_cliente($idcliente);
		$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
	   
?>
<table border="0" width="50%">
  <tr>
    <th>CLIENTE:</th>
    <td><?php echo nom($nom_clientes); ?></td>
  </tr>
  <tr>
    <th>TIPO DE REPORTE</th>
    <td><?php 
	if($opcion==1)
	echo "CON ADEUDO";
	else
	echo "SIN ADEUDO";
	
	 ?></td>
  </tr>
</table>
<?php

$img='<img src="../images/excel.png" alt="Servicios"  title="Reporte de servicios" width="40px" height="40px">';

echo '<a href="../reportes/cliente_servicios.php?idcliente='.$idcliente.'&opcion='.$opcion.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';




	
	}
	else {echo 0;}
	




?>