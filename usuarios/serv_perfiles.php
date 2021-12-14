<?php
session_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

$nom_perfil = $_POST["nom_perfil"];
$desc = $_POST["desc"];
$enviar = $_POST["enviar"];
$perfil_id = $_POST["perfil_id"];

//solo no validamos id_para modificar

$con=conectarse();

$errores = validar_campos_obligatorios(array($nom_perfil,$desc,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}


if($enviar=="GUARDAR" and $band==1)
	{
				//$id_usuario=1; ///  temporal recuperar usuario de la secion al estableserla 
				$sql= "SET datestyle TO postgres, dmy; select nuevo_perfil('$nom_perfil','$desc')";

				$query = pg_query($con,$sql);	
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('perfiles_id_perfil_seq')::TEXT,'perfiles','A','{$usuario}',
				'Alta de perfil : {$nom_perfil}');";
				$querytmp = pg_query($con,$sql);

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
	
			if($consulta>0)
		{
		
	//	echo $resultado;
		
		$perfil_id=substr($resultado,1,(strlen($resultado)));
		$perfil_id = substr($perfil_id, 0,-1);
		//style='padding:0px 0px 0px 400px'
		
		echo "<div align='left'  ><strong><font color='#003300'>Registro ingresado exitosamente </font></strong></div>";
		
			$c_perfil="SELECT * FROM perfiles where id_perfil='$perfil_id'";
			$query_c=pg_query($con,$c_perfil);
			while($row_perfil=pg_fetch_array($query_c))
			{
			$nom_perfil=$row_perfil["nombre_perfil"];
			$desc=$row_perfil["descripcion"];
			$perfil_id=$row_perfil["id_perfil"];
			}
		
		
		$modif=1;
		include("f_m_p.php");
		}
			
			
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_new_p.php");
		}
	}


	
	
	if($enviar=="MODIFICAR" and $band==1)
	{
	
	$sql="UPDATE perfiles set nombre_perfil='$nom_perfil',descripcion='$desc' where id_perfil='$perfil_id' ";
	$consulta=pg_query($con,$sql);
	
	//registra logs
	$usuario=$_SESSION["nombre_u"];
	$sql="select registrar_logs(1,'{$perfil_id}','perfiles','M','{$usuario}',
	'Modificacion de perfil a : {$nom_perfil}');";
	$querytmp = pg_query($con,$sql);	
	
	if($consulta>0)
		{
		echo "<div align='left' ><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		
			$c_perfil="SELECT * FROM perfiles where id_perfil='$perfil_id'";
			$query_c=pg_query($con,$c_perfil);
			while($row_perfil=pg_fetch_array($query_c))
			{
			$nom_perfil=$row_perfil["nombre_perfil"];
			$desc=$row_perfil["descripcion"];
			$perfil_id=$row_perfil["id_perfil"];
				
			}	
		$modif=1;
		include("f_m_p.php");
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		$modif=0;
		include("f_m_p.php");
		}

	}

	



?>