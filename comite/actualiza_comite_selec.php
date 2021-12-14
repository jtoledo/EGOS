<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();

$form = $_POST["form"];
$idsolicitud = $_POST["idsolicitud"];
$monto_auto = $_POST["monto_auto"];
$monto_finan = $_POST["monto_finan"];

$fecha_comite = $_POST["fecha_comite"];
$fecha_ministracion = $_POST["fecha_ministracion"];
$f_ministra_pfinan=$_POST["f_ministra_pfinan"];
$iddispo=$_POST["iddispo"];
if(isset($_POST["interes_nor"])) {
		$interes_nor=$_POST["interes_nor"];
		$interes_mor=$_POST["interes_mor"];	
	}
$enviar = $_POST["enviar"];
$id_usuario=$_SESSION["usuario"];
$mov_sucursal=$_SESSION["mov_sucursal"];
$id_periodo=$_SESSION["cosecha_sel"];

$idcredito = $_POST["idcredito"];

$con=conectarse();

if($f_ministra_pfinan!='null') {
		$f_ministra_pfinan="'$f_ministra_pfinan'";
	}

$monto_auto = explode(",",$monto_auto); //se convierte en arreglo la session de parcelas
foreach($monto_auto as $valor)
{
$ingreso=$ingreso.$valor;	
}
$monto_auto=floatval($ingreso);	


$monto_finan = explode(",",$monto_finan); //se convierte en arreglo la session de parcelas
foreach($monto_finan as $valor2)
{
$ingreso2=$ingreso2.$valor2;	
}
$monto_finan=floatval($ingreso2);



$errores = validar_campos_obligatorios(array($idcliente));	
	
	if(!empty($errores))
	{
		$band=1;
	}

$errores_sol = validar_campos_obligatorios(array($idsolicitud,$monto_auto,$fecha_comite,$fecha_ministracion));	
	
	if(!empty($errores_sol))
	{
		$band_autoriza=1;
	}

	
	
	if($band==1 and $form==1)//CONSULTA LAS SOLICITUDES AGENDADAS POR PRIMERA VEZ
	{
	  // update_expediente_clientes($idcliente);
	  echo "<div align='center'>";
	 get_menu_comite($idsolicitud);
	 $fila_solicitud=get_solicitud_m($idsolicitud);
	 $fila_cliente=get_cliente($fila_solicitud["idcliente"]);
	 $folio_sol=$fila_solicitud["folio"];
	 $nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
	 $fila_get_grupo=get_grupo_sol($fila_solicitud["idcliente"]);
	 if($fila_get_grupo!=0)
	 $grupo=$fila_get_grupo["grupo"];
	 else
	 $grupo="SIN GRUPO";	
	 
	 $monto=number_format($fila_solicitud["monto"],2);	
	 $monto_finan=number_format($fila_solicitud["monto_parafinanciera"],2);
			
	$fila= consul_productos_m($fila_solicitud["idproducto"]);
	$idproducto=$fila["idproducto"];
	$producto=$fila["producto"];
	$id_tipo=$fila["id_tipo"];//obtener que tipo de credito es
	$interes_mensual=$fila["interes_mensual"];//boolenano
	$plazo=$fila["plazo"];
	$idper=$fila["idper"]; //periodo
	
	
	$interes_normal=$fila["interes_normal"];
	$interes_moratorio=$fila["interes_moratorio"];
	$id_pago=$fila["id_pago"];
	$interes_normal_m=$interes_normal*12;
	$interes_moratorio_m=$interes_moratorio*12;
	if($interes_mensual=="t")
	$tasa_interes=1;
	else
	$tasa_interes=0;
	$fecha=date("d-m-Y");
	
	include("formu_autoriza.php");
	 
	 
	 echo "</div>";
	  
	  
	}
	
	if($band_autoriza==1 and $form==3) //modifica solicitud y guarda credito
	{
	 
	//quitar coma de monto-auto 
	 

	 if($enviar=="AUTORIZAR")
	 {
	$f_aprobacion=$fecha_ministracion;
	$comision="null";
	$seguro="null";
	$folio="";
	$dias_gracia="null";
	$f_entrega="null";
	$entregado=0;
	
	$fila_solicitud=get_solicitud_m($idsolicitud);
	$fila= consul_productos_m($fila_solicitud["idproducto"]);
	$idproducto=$fila["idproducto"];
	$interes_normal=$fila["interes_normal"];
	$interes_moratorio=$fila["interes_moratorio"];
	$gar_liq_porcentaje=$fila_solicitud["gar_liq_porcentaje"];
	$meses=$fila["plazo"];
	$cancelado=0;
	$int_men="null";
	$pagado="null";
	
	$dias=$meses*30; //plazo de vencimiento del credito
	$fecha_pagar=suma_fechas($fecha_ministracion,$dias); //obtine la fecha de pagare q son 90 dias


	
	$sql= "SET datestyle TO postgres, dmy; select autoriza_transaccion_credito('$id_periodo',$iddispo,$f_ministra_pfinan,'$monto_finan','$idsolicitud','$monto_auto',$comision,$seguro,'$folio',$dias_gracia,'$f_aprobacion',$f_entrega,'$entregado','$idproducto','$interes_normal','$interes_moratorio','$gar_liq_porcentaje','$fecha_ministracion','$meses',$int_men,'$fecha_comite','$cancelado',$pagado,'$fecha_pagar','$mov_sucursal','$id_usuario')";
	
				$query = pg_query($con,$sql);	
				echo $sql;
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idsolicitud}','cc_solicitudes','A','{$usuario}',
				'Autorizacion de creditos folio :'||(select folio from cc_creditos where idsolicitud={$idsolicitud}));";
				$querytmp = pg_query($con,$sql);

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		$idcredito=substr($resultado,1,(strlen($resultado)));
		$idcredito = substr($idcredito, 0,-1);
		$idcredito=trim($idcredito);
		
		echo "<div align='center'><strong><font color='#003300'>La solicitud fue autorizada correctamente</font></strong></div>";
		
		
		
		 echo "<div align='center'>";
		 
	 $fila_credito=get_credito_m($idcredito); 
	 get_menu_comite($fila_credito["idsolicitud"]);
	 $fila_solicitud=get_solicitud_m($idsolicitud);
	 $fila_cliente=get_cliente($fila_solicitud["idcliente"]);
	 $folio_credito=$fila_credito["folio"];
	 $iddispo=$fila_credito["iddisposicion"];
	 $nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
	 $fila_get_grupo=get_grupo_sol($fila_solicitud["idcliente"]);
	 if($fila_get_grupo!=0)
	 $grupo=$fila_get_grupo["grupo"];
	 else
	 $grupo="SIN GRUPO";	
	 
	$monto_auto=number_format($fila_credito["monto"],2);
	$monto=number_format($fila_solicitud["monto"],2);				
	$monto_finan=number_format($fila_solicitud["monto_parafinanciera"],2);	
	$fila= consul_productos_m($fila_credito["idproducto"]);
	$idproducto=$fila["idproducto"];
	$producto=$fila["producto"];
	
	$id_tipo=$fila["id_tipo"];//obtener que tipo de credito es
	$interes_mensual=$fila["interes_mensual"];//boolenano
	
	//empieza datos del credito
	$plazo=$fila_credito["meses"];  //datos del credto
	$idper=$fila["idper"]; //periodo
	$interes_normal=$fila_credito["interes_normal"];
	$interes_moratorio=$fila_credito["interes_moratorio"];
	$id_pago=$fila["id_pago"];
	$interes_normal_m=$interes_normal*12;
	$interes_moratorio_m=$interes_moratorio*12;
	if($interes_mensual=="t")
	$tasa_interes=1;
	else
	$tasa_interes=0;
	$fecha_ministracion=$fila_credito["f_ministracion"];
	$f_ministra_pfinan=$fila_credito["f_ministracion_pfinanciera"];
	$fecha_comite=$fila_credito["f_comite"];
	
	
	require("formu_autoriza_modif.php");
	 
	 
	 echo "</div>";
	
echo "#separador";
get_solicitudes_agendadas($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
echo "#separador";
get_solicitudes_autorizadas($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
	
		
		
		} else { echo 0; }
		 
			 
		 
		 
		 
		 
	
	 }
	 
	 
	 
	 
	 
	 
	  
	  
	}
	
	


	if($form==4) //CONSULTA LA SOLICITUD AUTORIZADA 
	{
	 
	
		
		 echo "<div align='center'>";
	 $fila_credito=get_credito_sol($idsolicitud);
	 get_menu_comite($fila_credito["idsolicitud"]);
	 $fila_solicitud=get_solicitud_m($idsolicitud);
	 $fila_cliente=get_cliente($fila_solicitud["idcliente"]);
	 $folio_credito=$fila_credito["folio"];
	 $iddispo=$fila_credito["iddisposicion"];
	 $nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
	 $fila_get_grupo=get_grupo_sol($fila_solicitud["idcliente"]);
	 if($fila_get_grupo!=0)
	 $grupo=$fila_get_grupo["grupo"];
	 else
	 $grupo="SIN GRUPO";	
	 
	$monto_auto=number_format($fila_credito["monto"],2);
	$monto=number_format($fila_solicitud["monto"],2);	
	$monto_finan=number_format($fila_credito["monto_parafinanciera"],2);			
	$fila= consul_productos_m($fila_credito["idproducto"]);
	$idproducto=$fila["idproducto"];
	$producto=$fila["producto"];
	$id_tipo=$fila["id_tipo"];//obtener que tipo de credito es
	$interes_mensual=$fila["interes_mensual"];//boolenano
	
	//empieza datos del credito
	$plazo=$fila_credito["meses"];  //datos del credto
	$idper=$fila["idper"]; //periodo
	$interes_normal=$fila_credito["interes_normal"];
	$interes_moratorio=$fila_credito["interes_moratorio"];
	$id_pago=$fila["id_pago"];
	$interes_normal_m=$interes_normal*12;
	$interes_moratorio_m=$interes_moratorio*12;
	if($interes_mensual=="t")
	$tasa_interes=1;
	else
	$tasa_interes=0;
	$fecha_ministracion=$fila_credito["f_ministracion"];
	$f_ministra_pfinan=$fila_credito["f_ministracion_pfinanciera"];
	$fecha_comite=$fila_credito["f_comite"];
	$idcredito=$fila_credito["idcredito"];
	
	$estado_solicitud=get_estado_sol($idsolicitud);//verifica que el credito q apunta la solicitud no este entregado
	
	require("formu_autoriza_modif.php");
	 
	 
	 echo "</div>";
		
	  
	}



	if($band_autoriza==1 and $form==2) //MODIFICAMOS EL CREDITO QUE YA FUE AUTORIZADO
	{
	 
	//quitar coma de monto-auto 

	 if($enviar=="AUTORIZAR")
	 {
		 
	$f_aprobacion=$fecha_ministracion;
	$comision="null";
	$seguro="null";
	$folio="";
	$dias_gracia="null";
	$f_entrega="null";
	$entregado=0;
	
	$fila_solicitud=get_solicitud_m($idsolicitud);
	$fila= consul_productos_m($fila_solicitud["idproducto"]);
	$idproducto=$fila["idproducto"];
	$interes_normal=$fila["interes_normal"];
	$interes_moratorio=$fila["interes_moratorio"];
	$gar_liq_porcentaje=$fila_solicitud["gar_liq_porcentaje"];
	$meses=$fila["plazo"];
	$cancelado=0;
	$int_men="null";
	$pagado="null";
	
	

    $fila_credito=get_credito_m($idcredito);
	$meses=$fila_credito["meses"]; 	 
	$dias=$meses*30; //plazo de vencimiento del credito

	$fecha_pagar=suma_fechas($fecha_ministracion,$dias); //obtine la fecha de pagare q son 90 dias
	$sql= "SET datestyle TO postgres, dmy; select autoriza_credito_modif($iddispo,$f_ministra_pfinan,'$monto_finan','$monto_auto','$f_aprobacion','$fecha_ministracion','$fecha_comite','$idcredito','$fecha_pagar','$mov_sucursal','$id_usuario',$interes_nor,$interes_mor)";

				$query = pg_query($con,$sql);	
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,'{$idcredito}','cc_creditos','M','{$usuario}',
				'Modificacion de Autorizacion de creditos folio :'||(select folio from cc_creditos where idcredito={$idcredito}));";
				$querytmp = pg_query($con,$sql);
				

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		$idcredito=substr($resultado,1,(strlen($resultado)));
		$idcredito = substr($idcredito, 0,-1);
		$idcredito=trim($idcredito);
		
		echo "<div align='center'><strong><font color='#003300'>La solicitud fue modificada correctamente</font></strong></div>";
		
		
		
		 echo "<div align='center'>";
		 
	 $fila_credito=get_credito_m($idcredito); 
	 get_menu_comite($fila_credito["idsolicitud"]);
	 $fila_solicitud=get_solicitud_m($idsolicitud);
	 $fila_cliente=get_cliente($fila_solicitud["idcliente"]);
	 $folio_credito=$fila_credito["folio"];
	 $iddispo=$fila_credito["iddisposicion"];
	 $nom_cliente="".$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]."";
	 $fila_get_grupo=get_grupo_sol($fila_solicitud["idcliente"]);
	 if($fila_get_grupo!=0)
	 $grupo=$fila_get_grupo["grupo"];
	 else
	 $grupo="SIN GRUPO";	
	 
	$monto_auto=number_format($fila_credito["monto"],2);
	$monto_finan=number_format($fila_credito["monto_parafinanciera"],2);
	$monto=number_format($fila_solicitud["monto"],2);				
	$fila= consul_productos_m($fila_credito["idproducto"]);
	$idproducto=$fila["idproducto"];
	$producto=$fila["producto"];
	$id_tipo=$fila["id_tipo"];//obtener que tipo de credito es
	$interes_mensual=$fila["interes_mensual"];//boolenano
	
	//empieza datos del credito
	$plazo=$fila_credito["meses"];  //datos del credto
	$idper=$fila["idper"]; //periodo
	$interes_normal=$fila_credito["interes_normal"];
	$interes_moratorio=$fila_credito["interes_moratorio"];
	$id_pago=$fila["id_pago"];
	$interes_normal_m=$interes_normal*12;
	$interes_moratorio_m=$interes_moratorio*12;
	if($interes_mensual=="t")
	$tasa_interes=1;
	else
	$tasa_interes=0;
	$fecha_ministracion=$fila_credito["f_ministracion"];
	$f_ministra_pfinan=$fila_credito["f_ministracion_pfinanciera"];
	$fecha_comite=$fila_credito["f_comite"];
	
	
	require("formu_autoriza_modif.php");
	 
	 
	 echo "</div>";
		
		
		
echo "#separador";
get_solicitudes_agendadas($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
echo "#separador";
get_solicitudes_autorizadas($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
		
		
		
		
		
		}else { echo 0; }
		 
			 
		 
		 
		 
		 
	
	 }
	 
	 
	 
	 
	 
	 
	  
	  
	}













?>
