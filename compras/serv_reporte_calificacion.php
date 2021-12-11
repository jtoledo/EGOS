<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU

error_reporting(E_ALL);
ini_set('display_errors', '1');

$id_periodo = $_POST["id_periodo"];
$fecha_i = $_POST["fecha_i"];
$fecha_f = $_POST["fecha_f"];
$id_almacen=$_POST["id_almacen"];
$id_tonga = $_POST["id_tonga"];
$id_producto=$_POST["id_producto"];
$con=conectarse();

$consulta=pg_query($con,"SET datestyle TO postgres, dmy;");
$sql="SELECT count(*)::integer as num_registro
FROM co_compras as com 
where 
com.id_almacen='$id_almacen' 
and 
com.id_periodo='$id_periodo'
and
com.id_catalogo='$id_producto' 
and 
com.fecha_nota between '$fecha_i' and '$fecha_f'";


$consulta=pg_query($con,$sql);
$fila=pg_fetch_array($consulta);
if($fila["num_registro"]>0) 
{
		echo "1";	
}
else
{

	echo "<table border='0'><tr><td><font color='red'>No se encontraron registros para el reporte</font></td></tr></table>";
}
?>
