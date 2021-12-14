<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$idgrupo=$_POST["idgrupo"];
$fecha_activacion=$_POST["fecha_activacion"];
$idproducto=$_POST["idproducto"];
$enviar=$_POST["enviar"];


$idsolgrupo=$_POST["idsolgrupo"];  //SOLO CUANDO SE VA MODIFICAR

$idestatus=1;  //quiere decir que esta en tramite
$vigente=1; //bool q quiere decir q el grupo esta activo



$con=conectarse();

/*$errores = validar_campos_obligatorios(array($sucursal,$direccion,$telefono,$cp,$idsede,$idencargado,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}*/


if($enviar=="GUARDAR" /*and $band==1*/)
	{
	
//	echo $idgrupo;
	
	$fila_cliente=get_grupo_m($idgrupo);
	$idcliente=$fila_cliente["idrepresentante"];
	$misma_cantidad=0;//false
	$cantidad=0;
	$folio="";
	
	

	
	$sql= "SET datestyle TO postgres, dmy; select nuevo_sol_grupo('$idcliente','$fecha_activacion','$idgrupo','$misma_cantidad','$cantidad','$idproducto','$vigente','$folio','$idestatus')";

				$query = pg_query($con,$sql);
				
				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('cc_sol_grupos_idsolgrupo_seq')::text,'cc_sol_grupos','A','{$usuario}',
				'Alta de Solicitud Grupal');";
				$querytmp = pg_query($con,$sql);
					

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$idsolgrupo=substr($resultado,1,(strlen($resultado)));
		$idsolgrupo = substr($idsolgrupo, 0,-1);
		$idsolgrupo=trim($idsolgrupo);
		
		echo "<div align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		$fila=get_grupo_sol_modif($idsolgrupo);
		$modif=1;
		include("grupo_sol_m.php");
	
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		
		include("grupo_sol_new.php");
		
		}


	}
	
	if($enviar=="MODIFICAR")
	{
	$fila_cliente=get_grupo_m($idgrupo);
	$idcliente=$fila_cliente["idrepresentante"];

	$sql = "set datestyle to 'dmy'; UPDATE cc_sol_grupos SET idgrupo='$idgrupo',idcliente='$idcliente',fecha_solicitud='$fecha_activacion',idproducto='$idproducto' WHERE idsolgrupo='$idsolgrupo'";

$consulta=pg_query($con, $sql); 

				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idsolgrupo}','cc_sol_grupos','M','{$usuario}',
				'Modificacion de Solicitud Grupal del grupo');";
				$querytmp = pg_query($con,$sql);
				

if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		$fila=get_grupo_sol_modif($idsolgrupo);
		$modif=1;
		include("grupo_sol_m.php");
		
		}
		else
		{
		$modif=0;
		include("grupo_sol_m.php");
		}
	}

	



?>