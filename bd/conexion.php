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


function nom($var)
{
//$nom=ucwords(strtolower($var));  //para caracterres iso989

$nom=mb_strtolower($var, 'UTF-8'); //convierte a minusculas
//$nom=mb_convert_case($nom, MB_CASE_TITLE, "UTF-8"); //convierte la primer letra en mayusculas
$nom=mb_convert_case($nom,MB_CASE_UPPER, "UTF-8"); //convierte A MAYUSCULAS


return $nom;



}


?>
