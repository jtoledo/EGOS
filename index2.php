<h1> HOLA MUNDO</h1>
<?php
phpinfo();
if (!($conexion = pg_connect("host=localhost dbname=egos port=5432 user=postgres password=751973")))
{
echo "No pudo conectarse al servidor";
exit();
}
echo "conectado";
}


?>
