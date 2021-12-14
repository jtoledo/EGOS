<?php
session_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

$nombre = $_POST["nombre"];
$iniciales = $_POST["iniciales"];
$perfil = $_POST["perfil"];
$usuario = $_POST["usuario"];
$contra = $_POST["contra"];
$contra2 = $_POST["contra2"];
$enviar = $_POST["enviar"];
$usuario_id = $_POST["usuario_id"];
$id_sucursal = $_POST["id_sucursal"];

//solo no validamos id_para modificar



$idrol=16;
 $permisos_personalizados=1;
 $eliminado=1;
 $bloqueado=1;

$contra = sha1(trim($contra));
if($contra!=$contra2)
{
$bloq=1;
}

$con=conectarse();

/*$errores = validar_campos_obligatorios(array($nombre,$iniciales,$perfil,$usuario,$contra,$contra2,$enviar,$id_sucursal));	
	
	if(!empty($errores))
	{
		$band=1;
	}*/

$band=1;	


if($enviar=="GUARDAR" and $bloq==1 and $band==1)
	{

	


	$perfil=intval($perfil);
	
	$id_sucursal=intval($id_sucursal);
	
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_usuario('$nombre','$idrol','$usuario','$iniciales','$perfil','$contra','$id_sucursal')";

				$query = pg_query($con,$sql);	
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('u_usuarios_uid_seq')::text,'u_usuarios','A','{$usuario}',
				'Alta de usuario  : {$nombre}');";
				$querytmp = pg_query($con,$sql);	

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
	
	
			
			
			if($consulta>0)
		{
		
		//echo $resultado;
		
		$usuario_id=substr($resultado,1,(strlen($resultado)));
		$usuario_id = substr($usuario_id, 0,-1);
		
		echo "<div style='padding:0px 0px 0px 400px' id='msj'><strong><font color='#003300'>Registro ingresado exitosamente </font></strong></div>";
		
		$c_usu="SELECT * FROM u_usuarios where uid='$usuario_id'";
		$query_usu=pg_query($con,$c_usu);
		while($row_usu=pg_fetch_array($query_usu))
		{
		$usuario_id=$row_usu["uid"];
		$nom_usuario=$row_usu["nombre"];
		$iniciales=$row_usu["iniciales"];
		$perfil_id=$row_usu["id_perfil"];
		$usuario_nick=$row_usu["usuario"];
		}
		
		
		$modif=1;
		include("f_m_u.php");
		}
			
			
			else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_new_u.php");
		}
	}

/*if($bloq!=1)
{
echo "El password no coincidio intente de nuevo";
}*/
	
	
	if($enviar=="MODIFICAR")
	{
	

	$sql="UPDATE u_usuarios set nombre='$nombre',iniciales='$iniciales', id_perfil='$perfil', usuario='$usuario', contra='$contra' where uid='$usuario_id' ";
	$consulta = pg_query($con,$sql);

	//registra logs
	$usuario=$_SESSION["nombre_u"];
	$sql="select registrar_logs(1,'{$usuario_id}','u_usuarios','M','{$usuario}',
	'Modificacion de usuario  : {$nombre}');";
	$querytmp = pg_query($con,$sql);	
		
		if($consulta>0)
		{
		echo "<div style='padding:0px 0px 0px 400px' id='msj'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		
		$c_usu="SELECT * FROM u_usuarios where uid='$usuario_id'";
		$query_usu=pg_query($con,$c_usu);
		while($row_usu=pg_fetch_array($query_usu))
		{
		$usuario_id=$row_usu["uid"];
		$nom_usuario=$row_usu["nombre"];
		$iniciales=$row_usu["iniciales"];
		$perfil_id=$row_usu["id_perfil"];
		$usuario_nick=$row_usu["usuario"];
		}
		
		
		$modif=1;
		include("f_m_u.php");
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_m_u.php");
		}

	}

	



?>