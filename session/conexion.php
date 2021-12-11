<?php
include($_SERVER['DOCUMENT_ROOT']."/EGOS/includes/constantes.php");
@header("Cache-Control: no-store, no-cache, must -revalidate");

function conectarse()
{
$servidor=SERVIDOR;
$usuarioo=USUARIO;
$clavee=PASS;
$base=DB;

if (!($conexion = pg_connect("host=$servidor dbname=$base port=5432 user=$usuarioo password=$clavee")))
{
echo "No pudo conectarse al servidor";
exit();
}
return $conexion;
//Conectarse();
}


session_start();


?>
