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
$id_catalogo=$_POST["id_catalogo"];
$id_secadora=$_POST["id_secadora"];
$observaciones=$_POST["observaciones"];
$hora_r=$_POST["hora_r"];
$hora_s=$_POST["hora_s"];
$horafs=$_POST["horafs"];
$maduro=retorna_valornum($_POST["maduro"]);
$smaduro=retorna_valornum($_POST["smaduro"]);
$bayo=retorna_valornum($_POST["bayo"]);
$verde=retorna_valornum($_POST["verde"]);
$quemado=retorna_valornum($_POST["quemado"]);
$tierno=retorna_valornum($_POST["tierno"]);
$smata=retorna_valornum($_POST["smata"]);
$costo_kgsalida=retorna_valornum($_POST["costo_kgsalida"]);

$enviar=$_POST["enviar"];
$form=$_POST["form"];
$id_servicio=$_POST["id_servicio"];

/*ARREGLOS*/
$b=$_POST["b"];
$kbrutos=$_POST["kbrutos"];
$tar=$_POST["tar"];
$knetos=$_POST["knetos"];
$ca=$_POST["ca"];
/*FIN DE LOS ARREGLOS*/
$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente,$fecha_servicio,$id_catalogo,$id_secadora,$observaciones,$hora_r,$hora_s,$horafs,$maduro,$smaduro,$bayo,$verde,$quemado,$tierno,$costo_kgsalida));	
	
	if(empty($errores))
	{
		echo 0;
		exit;
	}



$bolsa="{".$b."}";
$kgs_brutos="{".$kbrutos."}";
$tara="{".$tar."}";
$kgs_netos="{".$knetos."}";
$cajas="{".$ca."}";




if($enviar=="GUARDAR" and $form==2)
	{
$sql= "SET datestyle TO postgres, dmy; select se_new_serviciosegos('$id_periodo','$idcliente','$fecha_servicio','$id_catalogo','$id_secadora','$bolsa','$kgs_brutos','$tara','$kgs_netos','$cajas','$observaciones','$hora_r','$hora_s','$horafs',$maduro,$smaduro,$bayo,$verde,$quemado,$tierno,$smata,'$id_usuario','$mov_sucursal','$costo_kgsalida')";

				$query = pg_query($con,$sql);
				
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('se_servicios_id_servicio_seq')::text,'se_servicios','A','{$usuario}',
				'Alta de servicios del cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
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
		$fila=get_se_servicios($id_servicio);  //cuando no hay una consulta determinada se consulta la primera solicitud
		
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


		else
		{
		echo 0;
		exit;
		
		}


	}
	
	if($enviar=="MODIFICAR")
	{

	

	$sql= "SET datestyle TO postgres, dmy; select se_modif_serviciosegos('$idcliente','$fecha_servicio','$id_catalogo','$id_secadora','$bolsa','$kgs_brutos','$tara','$kgs_netos','$cajas','$observaciones','$hora_r','$hora_s','$horafs',$maduro,$smaduro,$bayo,$verde,$quemado,$tierno,$smata,'$id_usuario','$mov_sucursal','$id_servicio','$costo_kgsalida')";

				$query = pg_query($con,$sql);	
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$id_servicio}','se_servicios','M','{$usuario}',
				'Modificacion de servicios del cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
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
		
				
		
		echo "<div align='center'><strong><font color='#003300'>Servicio fue modificado correctamente</font></strong></div>";
		$fila=get_se_servicios($id_servicio);  //se recupera la consulta de la nota de entrada
		
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


		else
		{
		echo 0;
		exit;
		
		}
	
	
	}

	



?>