<?php

$d2=$HTTP_POST_VARS['d'];

$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="select clave,nombre,direccion from personal where direccion=\"$d2\"";

$r=mysql_query($consulta);
$d=mysql_num_rows($r);
if ($d>=1){
	echo(" <form action=\"modifica2.php\" method=\"post\">    ");
	echo (" <table border=1> ");
	echo ("<tr>");
	echo ("<td> Clave </td>");
	echo ("<td> Nombre </td>");
	echo ("<td> Fecha </td>");
	echo ("<td> selección </td>");
	echo ("</tr>");
	$n=1;
	while($registro=mysql_fetch_row($r)){
		echo ("<tr>");

		echo ("<td> $registro[0] </td>");
		echo ("<td> $registro[1] </td>");
		echo ("<td> $registro[2] </td>");
		echo ("<td> <input type=\"radio\" name=\"s\" value=\"$registro[0]\" </td>");

		echo("</tr>");
		$n++;

}
echo (" </table> ");
echo("<input type=\"submit\" value=\"Modificar\"> <input type=\"button\" value=\"Cancelar\" onclick=\"history.back()\">");
echo("</form>");
}
else{
	echo("El registro no se encuentra");
	echo(" <a href=\"eliminar.html\">Regresar </a>   ");

}




?>