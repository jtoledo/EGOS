<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$idcliente=$_POST["idcliente"];
$idgrupo=$_POST["idgrupo"];  


$status=1;

$fecha_activacion=date("Y-m-d");


$con=conectarse();




if($idcliente>0 and $idgrupo>0)
	{
	
	$consulta="insert into rela_grupo (idgrupo,idcliente,fecha_add,status,usuario) values ('$idgrupo','$idcliente','$fecha_activacion','$status','$id_usuario')";
	
	$query=pg_query($con,$consulta);
	
				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idgrupo}','rela_grupo','A','{$usuario}',
				'Alta de relacion grupal');";
				$querytmp = pg_query($con,$sql);	
	
		if($query>0)
			{
			echo "<div align='center'><strong><font color='#003300'>Productor agregado correctamente</font></strong></div>";
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