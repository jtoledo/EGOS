<?php
session_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

$sucursal = $_POST["sucursal"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$cp = $_POST["cp"];
$idsede = $_POST["idsede"];
$idencargado = $_POST["idencargado"];
$enviar = $_POST["enviar"];
$sucursal_id = $_POST["sucursal_id"];

//

//solo no validamos id_para modificar

$con=conectarse();

$errores = validar_campos_obligatorios(array($sucursal,$direccion,$telefono,$cp,$idsede,$idencargado,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}


if($enviar=="GUARDAR" and $band==1)
	{
	
	
	
	
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_sucursal('$sucursal','$direccion','$telefono','$cp','$idsede','$idencargado')";

				$query = pg_query($con,$sql);
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('cc_sucursales_id_seq')::TEXT,'cc_sucursales','A','{$usuario}',
				'Alta de Sucursal: {$sucursal}');";
				$querytmp = pg_query($con,$sql);				
					

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$sucursal_id=substr($resultado,1,(strlen($resultado)));
		$sucursal_id = substr($sucursal_id, 0,-1);
		$sucursal_id=trim($sucursal_id);
		
		echo "<div  align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		
		$c_sucursal="SELECT * FROM cc_sucursales WHERE id='$sucursal_id' ";
		$query_c=pg_query($con,$c_sucursal);
			while($row_sucursal=pg_fetch_array($query_c))
			{
			$sucursal_id=$row_sucursal["id"];
			$sucursal=$row_sucursal["sucursal"];
			$direccion=$row_sucursal["direccion"];
			$telefono=$row_sucursal["telefono"];
			$cp=$row_sucursal["cp"];
			$idsede=$row_sucursal["idsede"];
			$idencargado=$row_sucursal["idencargado"];
			
			}
		
		$modif=1;
		include("f_m_s.php");
		
		
		
		
		}
			
			
			else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_new_s.php");
		}
	
	
	
	
	}


	
	
	if($enviar=="MODIFICAR" and $band==1)
	{
	
	$sql="UPDATE cc_sucursales set sucursal='$sucursal',direccion='$direccion', telefono='$telefono', cp='$cp', idsede='$idsede', idencargado='$idencargado' where id='$sucursal_id' ";
	$consulta=pg_query($con,$sql);
	
	//registra logs
	$usuario=$_SESSION["nombre_u"];
	$sql="select registrar_logs(1,'{$sucursal_id}','cc_sucursales','M','{$usuario}',
	'Modificacion de Sucursal: {$sucursal}');";
	$querytmp = pg_query($con,$sql);		
	
if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		
		$c_sucursal="SELECT * FROM cc_sucursales WHERE id='$sucursal_id'";
		$query_c=pg_query($con,$c_sucursal);
			while($row_sucursal=pg_fetch_array($query_c))
			{
			$sucursal_id=$row_sucursal["id"];
			$sucursal=$row_sucursal["sucursal"];
			$direccion=$row_sucursal["direccion"];
			$telefono=$row_sucursal["telefono"];
			$cp=$row_sucursal["cp"];
			$idsede=$row_sucursal["idsede"];
			$idencargado=$row_sucursal["idencargado"];
			
			}
		
		
		$modif=1;
		include("f_m_s.php");
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_m_s.php");
		}
	}

	



?>