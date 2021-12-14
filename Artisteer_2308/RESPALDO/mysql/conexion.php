<?php
include($_SERVER['DOCUMENT_ROOT']."/enter/includes/constantes.php");
$miconexion=mysql_connect(SERVIDOR,USUARIO,PASS);
if(!$miconexion)
	{
		die("No hemos podido conectarnos a la base de datos: " . mysql_error());
	}
	

 $bd_seleccionada = mysql_select_db(DB,$miconexion);

if(!$bd_seleccionada)
	{
		die("No hemos podido seleccionar la base de datos: " . mysql_error());
	}



?>
