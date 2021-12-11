<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU

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
		$errores = validar_campos_obligatorios(array($id_periodo,$fecha_i,$fecha_f));	
	
		if(!empty($errores))
		{
			$band=1;
		}
	
		if($band==1)
		{
?> 
     		 <table border="0">
      		<tr><td align="center">
	   	<?php
	   
	   		$img='<img src="'.$d.'images/excel.png" alt="nota"  width="40px" height="40px">';

				echo '<a href="'.$d.'reportes/reporte_nt.php?id_periodo='.$id_periodo.'&fecha_i='.$fecha_i.'&fecha_f='.$fecha_f.'&id_producto='.$id_producto.'&id_tonga='.$id_tonga.'&id_almacen='.$id_almacen.'" >  <strong><span class="Estilo1">

				'.$img.'</span></strong>  </a>';


			 ?>
			 </td>
   
    			</tr>
    			<tr>
    			<th align="center">Ver Reporte</th>
    			</tr>
    			</table>
<?php
		}
	
	}
	else
	{
echo $sql;		
		echo "<table border='0'><tr><td><font color='red'>No se encontraron registros para el reporte</font></td></tr></table>";
	}
?>
