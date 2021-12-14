<?php
$c=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="select clave,nombre,direccion,fecha from personal";
$r=mysql_query($consulta);

$d=mysql_num_rows($r);
if($d>0){
	header('Content-type: application/vnd.ms-word');
	header("Content-Disposition: attachment; filename=archivo.doc");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	echo("<table border=1>");
	echo("<tr>");
	echo("<td> clave </td>");
	echo("<td> nombre </td>");
	echo("<td> direccion </td>");
	echo("<td> fecha </td>");
	echo("</tr>");

	while($registro=mysql_fetch_row($r)){
		echo ("<tr>");
		echo ("<td> $registro[0] </td>");
		echo ("<td> $registro[1] </td>");
		echo ("<td> $registro[2] </td>");
		echo ("<td> $registro[3] </td>");
		echo("</tr>");
	}
	echo("</table>");
}
else{
echo("No hay registros en la tabla");
}
mysql_close();
?>
