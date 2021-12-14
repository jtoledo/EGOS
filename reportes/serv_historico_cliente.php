<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU

$id_cliente = $_POST["id_cliente"];
$id_periodo=$_POST["id_periodo"];
$id_almacen=$_POST["id_almacen"];

$con=conectarse();

/*$consulta=pg_query($con,"SET datestyle TO postgres, dmy;");
$sql="SELECT count(*)::integer as num_registro
FROM co_compras as com 
where 
com.id_almacen='$id_almacen' 
and com.id_proveedor='$id_cliente'";


$consulta=pg_query($con,$sql);
$fila=pg_fetch_array($consulta);

*/
//if($fila["num_registro"]>0) 
//{	
	
		
?> 
     		 <table border="0">
      		<tr><td align="center">
	   	
<?php
	   
	   		$img='<img src="'.$d.'images/excel.png" alt="nota"  width="40px" height="40px">';

				echo '<a href="'.$d.'reportes/reporte_historico.php?id_cliente='.$id_cliente.'&id_periodo='.$id_periodo.'&id_almacen='.$id_almacen.'>	<strong><span class="Estilo1">

				'.$img.'</span></strong>  </a>';
				


?>
			 </td>
   
    			</tr>
    			<tr>
    			<th align="center">Ver Historico</th>
    			</tr>
    			</table>
<?php
/*		}
	
else
{

	echo "<table border='0'><tr><td><font color='red'>No se encontraron registros para el reporte</font></td></tr></table>";
}*/
?>
