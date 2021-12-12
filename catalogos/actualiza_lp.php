<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$con=conectarse();

$consulta_c="SELECT *,coalesce(precio1,0.00) as precio1 FROM 
al_cat_articulos order by descripcion";
								
$id_query_c = pg_query($con,$consulta_c);
echo "<table border=1 rules='rows' frame='BOX'><th>Producto</th><th>Precio</th><th>Ren.%</th><th>Man.%</th><th>Hum.%</th><th>M. Sec.%</th>";
while( $fila_c= pg_fetch_array($id_query_c) )
{  
	$producto=$fila_c["descripcion"];
	$precio=$fila_c["precio1"];
	$ren_max=$fila_c["ren_max_permitido"];
	$ren_min=$fila_c["ren_min_permitido"];
	$man_max=$fila_c["man_max_permitido"];
	$man_min=$fila_c["man_min_permitido"];
	$hum_max=$fila_c["hum_max_permitido"];
	$hum_min=$fila_c["hum_min_permitido"];
	$man_sec=$fila_c["man_secado"];
	echo "<tr><td><font size=1> $producto </font></td><td align='RIGHT'><font size=1>$precio</font></td><td align='RIGHT'><font size=1>$ren_min-$ren_max</font></td><td align='RIGHT'><font size=1>$man_min-$man_max</font></td><td align='RIGHT'><font size=1>$hum_min-$hum_max</font></td><td align='RIGHT'><font size=1>$man_sec</font></td>";
}
echo "</table>";	

?>