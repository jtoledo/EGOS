<?php
include("includes/constantes.php");
include("includes/funciones.php");
include("bd/conexion.php");

$form=$_POST["proceso"];

$con=conectarse();


if($form=="perfiles")
{
include("formularios/perfiles.php");
}
else
echo "Ha ocurrido un error intentelo mas tarde";



/*	$consulta="SELECT * from mnu_egos where id='$id_menu' ";
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
*/
	



?>