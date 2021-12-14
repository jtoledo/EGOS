<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idcliente = trim($_POST["idcliente"]);
$form = trim($_POST["form"]);
$id_servicio = trim($_POST["id_servicio"]);
$id_cobro = trim($_POST["id_cobro"]);
$importe = trim($_POST["importe"]);
$fecha_cobro = trim($_POST["fecha_cobro"]);
$enviar = trim($_POST["enviar"]);


session_start();
$id_usuario=$_SESSION["usuario"];


$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente));	

$errores_ser = validar_campos_obligatorios(array($id_servicio));	

$errores_valida_ser = validar_campos_obligatorios(array($importe,$id_servicio,$form));	

$errores_cobro = validar_campos_obligatorios(array($importe,$fecha_cobro,$enviar,$id_servicio));
$errores_cancela = validar_campos_obligatorios(array($id_servicio,$id_cobro,$form));	

	
	if(!empty($errores))
	{
		$band=1;
	}
		if(!empty($errores_ser))
	{
		$band_servicio=1;
	}
	if(!empty($errores_cobro))
	{
		$band_cobro=1;
	}
	if(!empty($errores_valida_ser))
	{
		$band_valida_ser=1;
	}
	
	if(!empty($errores_cancela))
	{
		$band_cancela=1;
	}


	
	
	if($band==1 and $form==1 )
	{
	   

	$fila=get_se_servicios_cliente($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);  //cuando consultaqmos al cliente
		
			if($fila!=0)
			{
			$modif=1;
$id_servicio=$fila["id_servicio"];
$fecha_servicio=$fila["fecha_servicio"];
$id_secadora=$fila["id_secadora"];
$idcliente=$fila["idcliente"];
$folio_servicio=$fila["folio_servicio"];
$id_catalogo=$fila["id_catalogo"];
$observaciones=$fila["observaciones"];
$hora_r=$fila["hora_r"];
$hora_s=$fila["hora_s"];
$hora_fs=$fila["horafs"];
$maduro=$fila["maduro"];
$smaduro=$fila["smaduro"];
$bayo=$fila["bayo"];
$verde=$fila["verde"];
$quemado=$fila["quemado"];
$tierno=$fila["tierno"];
$smata=$fila["smata"];
$ptotal=$fila["maduro"]+$fila["smaduro"]+$fila["bayo"]+$fila["verde"]+$fila["quemado"]+$fila["tierno"]+$fila["smata"];
$costo_kgsalida=$fila["costo_kgsalida"];
include("servicio_m.php");

			
			}
			else
			{
			include("servicio_new.php");
			}
			
		

	
	}
	
	
	if($band_servicio==1 and $form==2)
	{
	  $fila=get_se_servicios($id_servicio,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);  //cuando no hay una consulta determinada se consulta la primera solicitud
		
			if($fila!=0)
			{
			$modif=1;
$id_servicio=$fila["id_servicio"];
$fecha_servicio=$fila["fecha_servicio"];
$id_secadora=$fila["id_secadora"];
$idcliente=$fila["idcliente"];
$folio_servicio=$fila["folio_servicio"];
$id_catalogo=$fila["id_catalogo"];
$observaciones=$fila["observaciones"];
$hora_r=$fila["hora_r"];
$hora_s=$fila["hora_s"];
$hora_fs=$fila["horafs"];
$maduro=$fila["maduro"];
$smaduro=$fila["smaduro"];
$bayo=$fila["bayo"];
$verde=$fila["verde"];
$quemado=$fila["quemado"];
$tierno=$fila["tierno"];
$smata=$fila["smata"];
$ptotal=$fila["maduro"]+$fila["smaduro"]+$fila["bayo"]+$fila["verde"]+$fila["quemado"]+$fila["tierno"]+$fila["smata"];
$costo_kgsalida=$fila["costo_kgsalida"];
include("servicio_m.php");

			
			}
			else
			{

			include("servicio_new.php");
			}
			
			
		

	
	}


	if($band==1 and $form==3)
	{
	   

	include("servicio_new.php");
			
		

	
	}
	
	if($band_servicio==1 and $form==4)
	{
	   

	include("form_cobros.php");
			
	
	}
	
	if($band_cobro==1 and $form==5 and $enviar=="COBRAR")//Cobrando o abonando al servicio
	{
		$importe=explode(',',$importe);
		foreach($importe as $valor)
		{
		$subtotal=$subtotal.$valor;	
		}
		$total=floatval($subtotal);	
		$fecha_captura=date("d-m-Y");
		
		/********VALIDAMOS EL SERVICIO*****/
		$fila=get_se_servicios($id_servicio,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
		$total_cobros=get_cobros($id_servicio);
		$total_servicio=$fila["total"];
		$total_servicio=$total_servicio-$total_cobros;
		if($total_servicio<$total)
		{
		echo 1;
		exit;
		}
		
		/*******TERMINAMOS DE VALIDARLO**/
		
		
		
		
	
	$sql= "SET datestyle TO postgres, dmy; select se_abono_servicio('$id_servicio','$total','$fecha_cobro','0','$id_usuario','$fecha_captura')";

				$query = pg_query($con,$sql);	

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		$id_cobro=substr($resultado,1,(strlen($resultado)));
		$id_cobro = substr($id_cobro, 0,-1);
		$id_cobro=trim($id_cobro);
		
		echo "<div align='center'><strong><font color='#003300'>Abono ingresado correctamente</font></strong></div>";
		
		get_cobros_consulta($id_servicio);
		
		
		}

	
	}
	
	
	
	if($band_cancela==1 and $form==6) //CANCELACION DE PAGOS DE LOS SERVICIOS
	{
	   

	$cmp=cancela_servicio($id_cobro);
	if($cmp==1)
	get_cobros_consulta($id_servicio);
	else
	echo 0;
			
	
	}
	

?>