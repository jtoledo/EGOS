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


$idrequerimiento=$_POST["idrequerimiento"];  //solo cuando va ser modificacion


/*function convertir($cheq_fecha){
    list($d,$m,$a)=explode("/",$cheq_fecha);
    return $a."-".$m."-".$d;
};
$f_registro= convertir($f_registro);
$fecha_nac= convertir($fecha_nac);*/


$con=conectarse();

/*$errores = validar_campos_obligatorios(array($sucursal,$direccion,$telefono,$cp,$idsede,$idencargado,$enviar));	
	
	if(!empty($errores))
	{
		$band=1;
	}*/


if($enviar=="GUARDAR" /*and $band==1*/)
	{
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_requerimiento('$idproceso','$requerimiento','$iduni','$cantidad','$ciclos','$total_ciclos','$un','$total','$porciento_produ','$cuota_credi','$aporta_produ','$id_usuario')";

				$query = pg_query($con,$sql);	
				
				
				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('cc_ptrequerimientos_idrequerimiento_seq')::text,'cc_ptrequerimientos','A','{$usuario}',
				'Alta de requerimento: {$requerimiento}');";
				$querytmp = pg_query($con,$sql);

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$idrequerimiento=substr($resultado,1,(strlen($resultado)));
		$idrequerimiento = substr($idrequerimiento, 0,-1);
		$idrequerimiento=trim($idrequerimiento);
		
		echo "<div  align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		$modif=1;
		include("requerimiento_m.php");
	
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		include("requerimiento_new.php");
		
		}


	}
	
	if($enviar=="MODIFICAR")
	{
	

	$sql = "set datestyle to 'dmy'; UPDATE cc_ptrequerimientos SET idproceso='$idproceso',requerimiento='$requerimiento',iduni='$iduni',cantidad='$cantidad',ciclos='$ciclos',total_ciclos='$total_ciclos',un='$un',total='$total',porciento_produ='$porciento_produ',cuota_credi='$cuota_credi',aporta_produ='$aporta_produ',usuario='$id_usuario' WHERE idrequerimiento='$idrequerimiento'";

$consulta=pg_query($con, $sql);

//registrar logs
$usuario=$_SESSION["nombre_u"];
$sql="select registrar_logs(1,'{$idrequerimiento}','cc_ptrequerimientos','M','{$usuario}',
'Alta de requerimento: {$requerimiento}');";
$querytmp = pg_query($con,$sql);
 
if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		$modif=1;
		include("requerimiento_m.php");
		}
		else
		{
		echo "Error en el registro intente de nuevo mas tarde";
		include("requerimiento_new.php");
		}
	}

	



?>