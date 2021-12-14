<?php


$conexion=mysql_connect("localhost","root","");
mysql_select_db("almacenm");

while(list($key,$var)=each($HTTP_POST_VARS)){
	
	$consulta="delete from personal where clave=$var";
	$r=mysql_query($consulta);
	
	if (mysql_affected_rows()>0){
	echo ("Eliminacion de $var exitosa <br>");
	
	}
	else{
	echo ("Eliminacion de $var no exitosa <br>");
		}

} 
echo ("<a href=\"eliminar2.html\">regresar</a>");
mysql_close();
?>