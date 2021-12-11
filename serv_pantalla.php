<?php
include("includes/constantes.php");
include("includes/funciones.php");
include("bd/conexion.php");
$id_menu=$_POST["id_menu"];
$d=$_POST["d"];

$con=conectarse();

	$consulta="SELECT * from mnu_egos where id='$id_menu' ";
                     	$id_query = pg_query($con,$consulta);
                     	while( $fila= pg_fetch_array($id_query) )
                        {  
							
						$link=$fila["link"];
						
						}
	
	
	
	if($link!="")
	{
	
	include("$link");

	}
	else
	{
	echo "Ha ocurrido un error intentelo mas tarde";
	}

	



?>