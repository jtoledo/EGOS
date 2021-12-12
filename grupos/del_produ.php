<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 


$idgrupo = $_POST["idgrupo"];

$id_rela = $_POST["id_rela"];

//$form = $_POST["form"];

$con=conectarse();

$errores = validar_campos_obligatorios(array($idgrupo,$id_rela));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
	if($band==1)
	{
	
	
	$sql = "DELETE FROM rela_grupo WHERE id_rela = '$id_rela'";
	$consulta=pg_query($con,$sql);
	if($consulta>0)
	{
		echo "<div align='center'><strong><font color='#003300'>Productor eliminado correctamente</font></strong></div>";
		$fila=get_grupo_m($idgrupo);
		$modif=1;
		include("grupo_m.php");
		
		}
		else
		{
		$modif=0;
		include("grupo_m.php");
		}

	}
?>