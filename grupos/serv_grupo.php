<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$grupo=$_POST["grupo"];
$email=$_POST["email"];
$domicilio=$_POST["domicilio"];
$idcliente=$_POST["idcliente"];
$idestado=$_POST["estado"];
$idmunicipio=$_POST["municipio"];
$idlocalidad=$_POST["localidad"];
$idcolonia=$_POST["colonia"];
$fecha_activacion=$_POST["fecha_activacion"];

$enviar=$_POST["enviar"];


$idgrupo=$_POST["idgrupo"];  //SOLO CUANDO SE VA MODIFICAR

$status=1;



$con=conectarse();

/*$errores = validar_campos_obligatorios(array($sucursal,$direccion,$telefono,$cp,$idsede,$idencargado,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}*/


if($enviar=="GUARDAR" /*and $band==1*/)
	{
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_grupo('$grupo','$idestado','$idmunicipio','$idlocalidad','$idcolonia','$domicilio','$email','$fecha_activacion','$idcliente','$id_usuario','$status')";

				$query = pg_query($con,$sql);	

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$idgrupo=substr($resultado,1,(strlen($resultado)));
		$idgrupo = substr($idgrupo, 0,-1);
		$idgrupo=trim($idgrupo);
		
		echo "<div align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		$fila=get_grupo_m($idgrupo);
		$modif=1;
		include("grupo_m.php");
	
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		
		include("grupo_new.php");
		
		}


	}
	
	if($enviar=="MODIFICAR")
	{
	

	$sql = "set datestyle to 'dmy'; UPDATE cc_grupos SET grupo='$grupo',idlocalidad='$idlocalidad',idmunicipio='$idmunicipio',idestado='$idestado',idcolonia='$idcolonia',domicilio='$domicilio',email='$email',fecha_activacion='$fecha_activacion',idrepresentante='$idcliente',usuario='$id_usuario',status='$status' WHERE idgrupo='$idgrupo'";

$consulta=pg_query($con, $sql); 
if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
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