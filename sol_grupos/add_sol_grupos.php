<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idsolicitud = $_POST["idsolicitud"];
$form = $_POST["form"];
$idsolgrupo = $_POST["idsolgrupo"];

$idrelasol = $_POST["idrelasol"];

session_start();
$id_usuario=$_SESSION["usuario"];

$fecha_add_sol=date("Y-m-d");
$estatus=1;



$con=conectarse();

$errores = validar_campos_obligatorios(array($idsolgrupo));	
	
	if(!empty($errores))
	{
		$band=1;
	}
	
	
if($band==1 and $form==1)  
{
	    
		
$sql="insert into rela_sol_grupo (idsolgrupo,idsolicitud,fecha_add_sol,estatus,usuario) values ('$idsolgrupo','$idsolicitud','$fecha_add_sol','$estatus','$id_usuario')";	
$consulta=pg_query($con,$sql);

				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idsolgrupo}','rela_sol_grupo','A','{$usuario}',
				'Alta de Relacion grupal');";
				$querytmp = pg_query($con,$sql);


if($consulta>0)
{
		echo "<div align='center'><strong><font color='#003300'>La solicitud ha sido agregada exitosamente</font></strong></div>";
		$fila=get_grupo_sol_modif($idsolgrupo);
		$modif=1;
		include("grupo_sol_m.php");
	}
	else
	{ include("grupo_sol_new.php"); }

		

	
}
	
if($form==2)  
{
	
	
$stock=get_exists_grupo_solicitud($idrelasol);    

if($stock==0)
{
echo 0;
exit;
}
		
$sql_del="delete from rela_sol_grupo where id_rela_sol='$idrelasol'";	
$consulta_del=pg_query($con,$sql_del);

//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idrelasol}','rela_sol_grupo','D','{$usuario}',
				'Elimina relacion grupal');";
				$querytmp = pg_query($con,$sql);	

if($consulta_del>0)
{
		echo "<div align='center'><strong><font color='#003300'>La solicitud ha sido eliminada exitosamente</font></strong></div>";
		$fila=get_grupo_sol_modif($idsolgrupo);
		$modif=1;
		include("grupo_sol_m.php");
	}
	else
	{ include("grupo_sol_new.php"); }

		

	
}
		


?>