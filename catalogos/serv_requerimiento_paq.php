<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];


$idproceso=$_POST["idproceso"];
$requerimiento=$_POST["requerimiento"];
$iduni=$_POST["iduni"];
$cantidad=$_POST["cantidad"];
$ciclos=$_POST["ciclos"];
$total_ciclos=$_POST["total_ciclos"];
$un=$_POST["un"];
$total=$_POST["total"];
$porciento_produ=$_POST["porciento_produ"];
$cuota_credi=$_POST["cuota_credi"];
$aporta_produ=$_POST["aporta_produ"];

$enviar=$_POST["enviar"];


$idrequerimiento=$_POST["idrequerimiento"];
$id_paquete=$_POST["id_paquete"];  

$id_conf_paq=$_POST["id_conf_paq"];  //SOLO CUANDO SE VA MODIFICAR





$con=conectarse();

/*$errores = validar_campos_obligatorios(array($sucursal,$direccion,$telefono,$cp,$idsede,$idencargado,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}*/


if($enviar=="GUARDAR" /*and $band==1*/)
	{
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_requerimiento_paq('$id_paquete','$idrequerimiento','$id_usuario','$idproceso','$requerimiento','$iduni','$cantidad','$ciclos','$total_ciclos','$un','$total','$porciento_produ','$cuota_credi','$aporta_produ')";

				$query = pg_query($con,$sql);	
				
				
				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$id_paquete}','conf_paquete','A','{$usuario}',
				'Alta Configuracion de paquete: {$requerimiento}');";
				$querytmp = pg_query($con,$sql);

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$id_conf_paq=substr($resultado,1,(strlen($resultado)));
		$id_conf_paq = substr($id_conf_paq, 0,-1);
		$id_conf_paq=trim($id_conf_paq);
		
		echo "<div  align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		$modif=1;
		include("paq_add_reque.php");
	
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		include("paq_add_reque_new.php");
		
		}


	}
	
	if($enviar=="MODIFICAR")
	{
	

	$sql = "set datestyle to 'dmy'; UPDATE conf_paquete SET idproceso='$idproceso',requerimiento='$requerimiento',iduni='$iduni',cantidad='$cantidad',ciclos='$ciclos',total_ciclos='$total_ciclos',un='$un',total='$total',porciento_produ='$porciento_produ',cuota_credi='$cuota_credi',aporta_produ='$aporta_produ',usuario='$id_usuario',id_paquete='$id_paquete',idrequerimiento='$idrequerimiento' WHERE id_conf_paq='$id_conf_paq'";

$consulta=pg_query($con, $sql);

/registrar logs
$usuario=$_SESSION["nombre_u"];
$sql="select registrar_logs(1,'{$id_conf_paq}','conf_paquete','M','{$usuario}',
'Modificacion Configuracion de paquete: {$requerimiento}');";
$querytmp = pg_query($con,$sql);
 
if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		$modif=1;
		include("paq_add_reque.php");
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		include("paq_add_reque_new.php");
		}
	}

	



?>