<?php

$c1=$HTTP_POST_VARS['c'];
$n1=$HTTP_POST_VARS['n'];
$d1=$HTTP_POST_VARS['d'];
$fa1=$HTTP_POST_VARS['anio'];
$fm1=$HTTP_POST_VARS['fecha'];
$fd1=$HTTP_POST_VARS['dia'];

$ft="$fa1/$fm1/$fd1";

$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="update personal set nombre=\"$n1\" ,direccion=\"$d1\" ,fecha=\"$ft\" where clave=$c1";

$r=mysql_query($consulta);

echo(mysql_error());
if (mysql_affected_rows()>0){
 echo("datos modificados");
 
}
else{
  echo("error al modificar datos");
 
}
echo(" <a href=\"buscam.html\"><img src=\"regresar.png\" width=100 heigth=50></a> ");
mysql_close();
?>