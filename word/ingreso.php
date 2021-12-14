<?php

$c1=$HTTP_POST_VARS['c'];
$n1=$HTTP_POST_VARS['n'];
$d1=$HTTP_POST_VARS['d'];
$f1=$HTTP_POST_VARS['f'];

$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="insert into personal(clave,nombre,direccion,fecha) values($c1,\"$n1\",\"$d1\",\"$f1\" )";

$r=mysql_query($consulta);
if ($r){
 echo("datos guardados");
 echo(" <a href=\"index.html\"><img src=\"regresar.png\" width=100 heigth=50></a> ");
}
else{
  echo("error al guardar");
}

mysql_close();
?>