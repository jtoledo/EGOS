<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];
$idcliente=$_POST["idcliente"];
$fecha_servicio=$_POST["fecha_servicio"];
$cantidad=$_POST["cantidad"];
$id_tipo_servicio=$_POST["id_tipo_servicio"];
$precio_u=$_POST["precio_u"];
$subtotal=$_POST["subtotal"];
$total=$_POST["total"];
$observaciones=$_POST["observaciones"];
$enviar=$_POST["enviar"];
$form=$_POST["form"];
$id_servicio=$_POST["id_servicio"];
$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente,$fecha_servicio,$cantidad,$id_tipo_servicio,$precio_u,$subtotal,$total));	
	
	if(empty($errores))
	{
		echo 0;
		exit;
	}



$cantidad = explode(",",$cantidad); 
foreach($cantidad as $valor)
{
$ingreso=$ingreso.$valor;	
}
$cantidad=floatval($ingreso);	

$precio_u = explode(",",$precio_u); 
foreach($precio_u as $valor)
{
$ingreso_u=$ingreso_u.$valor;	
}
$precio_u=floatval($ingreso_u);	

$subtotal=$cantidad*$precio_u;
$total=$subtotal;




if($enviar=="GUARDAR" and $form==2)
	{
$sql= "SET datestyle TO postgres, dmy; select se_new_servicios('$idcliente','$fecha_servicio','$cantidad','$id_tipo_servicio','$precio_u','$subtotal','$total','$observaciones','$id_usuario')";

				$query = pg_query($con,$sql);
				

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		$id_servicio=substr($resultado,1,(strlen($resultado)));
		$id_servicio = substr($id_servicio, 0,-1);
		$id_servicio=trim($id_servicio);//obtenemos el id de servicio

		echo "<div align='center'><strong><font color='#003300'>Servicio fue registrado correctamente</font></strong></div>";
		$fila=get_se_servicios($id_servicio);  //cuando no hay una consulta determinada se consulta la primera solicitud
		
			if($fila!=0)
			{
			$modif=1;
$id_servicio=$fila["id_servicio"];
$idcliente=$fila["idcliente"];
$fecha_servicio=$fila["fecha_servicio"];
$folio_servicio=$fila["folio_servicio"];
$cantidad=$fila["cantidad"];
$id_tipo_servicio=$fila["id_tipo_servicio"];
$precio_u=$fila["precio_u"];
$subtotal=$fila["subtotal"];
$total=$fila["total"];
$observaciones=$fila["observaciones"];

include("servicio_m.php");
			
			
			}
			else
			{
			include("servicio_new.php");
			}
	
	
	
		}


		else
		{
		echo 0;
		exit;
		
		}


	}
	
	if($enviar=="MODIFICAR" and $form==1)
	{



	

		$sql = "set datestyle to 'dmy'; UPDATE se_servicios SET idcliente='$idcliente',fecha_servicio='$fecha_servicio',cantidad='$cantidad',id_tipo_servicio='$id_tipo_servicio',precio_u='$precio_u',subtotal='$subtotal',total='$total',observaciones='$observaciones',id_usuario='$id_usuario' WHERE id_servicio='$id_servicio'";

$consulta=pg_query($con, $sql); 
	

		if($consulta>0)
		{
		
		echo "<div align='center'><strong><font color='#003300'>Servicio fue modificado correctamente</font></strong></div>";
		
		$fila=get_se_servicios($id_servicio);  //cuando no hay una consulta determinada se consulta la primera solicitud		
		
			if($fila!=0)
			{
			$modif=1;
$id_servicio=$fila["id_servicio"];
$idcliente=$fila["idcliente"];
$fecha_servicio=$fila["fecha_servicio"];
$folio_servicio=$fila["folio_servicio"];
$cantidad=$fila["cantidad"];
$id_tipo_servicio=$fila["id_tipo_servicio"];
$precio_u=$fila["precio_u"];
$subtotal=$fila["subtotal"];
$total=$fila["total"];
$observaciones=$fila["observaciones"];

include("servicio_m.php");
			
			
			}
			else
			{
			include("servicio_new.php");
			}
	
		
		
		}
		
		
	
	}

	



?>