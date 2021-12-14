<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();
	header('Content-type: application/vnd.ms-word');
	header("Content-Disposition: attachment; filename=clientes.doc");
	header("Pragma: no-cache");
	header("Expires: 0");

?>
<p align="center">REPORTE GENERAL DE CLIENTES</p>
<p align="left"><strong>1.- IDENTIFICACI&Oacute;N DEL CLIENTE</strong></p>

<?php
get_sol_clientes_pdf();
?>


