<?php
$c1=$HTTP_POST_VARS['c'];

$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");
$consulta="delete from personal where clave=$c1";

$r=mysql_query($consulta);

if (mysql_affected_rows()>0){
echo ("Eliminacion exitosa<br>");
echo ("<a href=\"eliminar.html\">regresar</a>");
}
else{
echo ("No se logro eliminar el registro<br>Intentelo más tarde<br>");
echo ("<a href=\"eliminar.html\">regresar</a>");
}

mysql_close();
?>