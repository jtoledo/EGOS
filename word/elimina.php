<?php

$c=$HTTP_POST_VARS['clave'];

$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="select nombre,direccion,fecha from personal where clave=$c";

$r=mysql_query($consulta);
$d=mysql_num_rows($r);
if ($d>1){

$registro=mysql_fetch_row($r);


echo(" <form action=\"confirma.php\" method=\"post\">    ");

echo("Clave <input type=\"text\" name=\"c\" value=\"$c\" maxlength=6 READONLY> <br><br>");

echo("Nombre <input type=\"text\" name=\"n\" value=\"$registro[0]\" size=40 DISABLED /> <br><br>");

echo("Direccion<input type=\"text\" name=\"d\" value=\"$registro[1]\" size=60 DISABLED /> <br><br>");

echo("Fecha<input type=\"text\" name=\"f\" value=\"$registro[2]\" size=10 DISABLED> <br><br>");

echo("<input type=\"submit\" value=\"confirmar\"> <input type=\"button\" value=\"Cancelar\" onclick=\"history.back()\">");

echo("</form>");
}
else{
	echo("El registro no se encuentra");
	echo(" <a href=\"eliminar.html\">Regresar </a>   ");

}




?>