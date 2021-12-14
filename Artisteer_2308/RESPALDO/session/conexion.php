<?php
@header("Cache-Control: no-store, no-cache, must -revalidate");
function conectarse()
{

if (!($conexion = pg_connect(SERVIDOR,USUARIO,PASS)))
{
echo "No pudo conectarse al servidor";
exit();
}
return $conexion;
//Conectarse();
}


function nom($var)
{
$nom=ucwords(strtolower($var));
return $nom;
}


session_start();
?>




?>
