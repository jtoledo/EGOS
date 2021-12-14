<?php
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
$permisos_personalizados=0;
$eliminado=0;
$bloqueado=0;

$contra = sha1(trim($contra));
if($contra!=$contra2)
{
$bloq=1;
}

$con=conectarse();

$errores = validar_campos_obligatorios(array($nombre,$iniciales,$perfil,$usuario,$contra,$contra2,$enviar,$id_sucursal));	
	
	if(!empty($errores))
	{
		$band=1;
	}




if($enviar=="GUARDAR" and $bloq==1 and $band==1)
	{
$sql = "INSERT INTO u_usuarios (nombre,idrol,usuario,permisos_personalizados,eliminado,bloqueado,iniciales,id_perfil,contra, id_sucursal			) VALUES (						'{$nombre}','{$idrol}','{$usuario}','{$permisos_personalizados}','{$eliminado}','{$bloqueado}','{$iniciales}','{$perfil}','{$contra}','{$id_sucursal}'          )";
	$consulta = pg_query($con,$sql);	
	if($consulta>0)
	include("consul_usuarios.php");
	else
	echo "Error en el registro intente de nuevo mas tarde";
	}

if($bloq!=1)
{
echo "El password no coincidio intente de nuevo";
}
	
	
	if($enviar=="MODIFICAR")
	{
	
	$sql="UPDATE u_usuarios set nombre='$nombre',iniciales='$iniciales', id_perfil='$perfil', usuario='$usuario' where uid='$usuario_id' ";
	$consulta = pg_query($con,$sql);	
	if($consulta>0)
	include("consul_usuarios.php");
	else
	echo "Error en el registro intente de nuevo mas tarde";

	}

	



?>