<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];
$mov_sucursal=$_SESSION["mov_sucursal"];
$id_periodo=$_SESSION["cosecha_sel"];

$idcliente=$_POST["idcliente"];
$fecha_servicio=$_POST["fecha_servicio"];
$cantidad=$_POST["cantidad"];
$id_tipo_servicio=$_POST["id_tipo_servicio"];
$precio_u=$_POST["precio_u"];
$subtotal=$_POST["subtotal"];
$total=$_POST["total"];
$observaciones=$_POST["observaciones"];
$nota_asociada=$_POST["nota_asociada"];
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
$sql= "SET datestyle TO postgres, dmy; select se_new_oservicios('$id_periodo','$idcliente','$fecha_servicio','$cantidad','$id_tipo_servicio','$precio_u','$subtotal','$total','$observaciones','$id_usuario','$mov_sucursal','$nota_asociada')";

				$query = pg_query($con,$sql);
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('se_oservicios_id_servicio_seq')::text,'se_oservicios','A','{$usuario}',
				'Alta de Otros servicios asociada a la nota #{$nota_asociada} del cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
				$querytmp = pg_query($con,$sql);
				
				

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
		$fila=get_se_oservicios($id_servicio,$_SESSION["mov_sucursal"],$_SESSION["cosecha_sel"]);  //cuando no hay una consulta determinada se consulta la primera solicitud
		
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
$nota_asociada=$fila["nota_asociada"];
include("oservicio_m.php");
			
			
			}
			else
			{
			include("oservicio_new.php");
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



	

		$sql = "set datestyle to 'dmy'; UPDATE se_oservicios SET idcliente='$idcliente',nota_asociada='$nota_asociada',fecha_servicio='$fecha_servicio',cantidad='$cantidad',id_tipo_servicio='$id_tipo_servicio',precio_u='$precio_u',subtotal='$subtotal',total='$total',observaciones='$observaciones',id_usuario='$id_usuario',id_sucursal='$mov_sucursal' WHERE id_servicio='$id_servicio'";

$consulta=pg_query($con, $sql); 
	
	//registra logs
	$usuario=$_SESSION["nombre_u"];
	$sql="select registrar_logs(1,'{$id_servicio}','se_oservicios','M','{$usuario}',
	'Modificacion Otros servicios asociada a la nota #{$nota_asociada} del cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
	$querytmp = pg_query($con,$sql);

		if($consulta>0)
		{
		
		echo "<div align='center'><strong><font color='#003300'>Servicio fue modificado correctamente</font></strong></div>";
		
		$fila=get_se_oservicios($id_servicio,$_SESSION["mov_sucursal"],$_SESSION["cosecha_sel"]);  //cuando no hay una consulta determinada se consulta la primera solicitud		
		
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
$nota_asociada=$fila["nota_asociada"];

include("oservicio_m.php");
			
			
			}
			else
			{
			include("oservicio_new.php");
			}
	
		
		
		}
		
		
	
	}

	



?>