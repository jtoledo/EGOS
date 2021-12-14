<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];
$mov_sucursal=$_SESSION["mov_sucursal"];
$id_periodo=$_SESSION["cosecha_sel"];
$fecha_registro=$_POST["fecha_registro"];
$idcliente=$_POST["idcliente"];
$experiencia=$_POST["experiencia"];
$idgiro=$_POST["idgiro"];
$destino=$_POST["destino"];
$idproducto=$_POST["idproducto"];
$idcon_inv=$_POST["idcon_inv"];
$monto=$_POST["monto"];
$monto_finan=$_POST["monto_finan"];
$id_paquete=$_POST["id_paquete"];
$otrosgastos=$_POST["otrosgastos"];
$descripcionotrosgts=$_POST["descripcionotrosgts"];
$otrosingresos=$_POST["otrosingresos"];
$descripcionotrosing=$_POST["descripcionotrosing"];
$gar_liq_porcentaje=$_POST["gar_liq_porcentaje"];
$t_sol=$_POST["t_sol"];

$enviar=$_POST["enviar"];


$idsolicitud=$_POST["idsolicitud"];  //SOLO CUANDO SE VA MODIFICAR


$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente,$id_paquete,$monto,$enviar));	
	
	if(empty($errores))
	{
		echo 0;
		exit;
	}



$monto = explode(",",$monto); //se convierte en arreglo la session de parcelas
foreach($monto as $valor)
{
$ingreso=$ingreso.$valor;	
}
$monto=floatval($ingreso);	


$monto_finan = explode(",",$monto_finan); //se convierte en arreglo la session de parcelas
foreach($monto_finan as $valor)
{
$ingfin=$ingfin.$valor;	
}
$monto_finan=floatval($ingfin);	

$otrosgastos = explode(",",$otrosgastos); //se convierte en arreglo la session de parcelas
foreach($otrosgastos as $valor_gts)
{
$ingreso_gts=$ingreso_gts.$valor_gts;	
}
$otrosgastos=floatval($ingreso_gts);	


$otrosingresos = explode(",",$otrosingresos); //se convierte en arreglo la session de parcelas
foreach($otrosingresos as $valor_ing)
{
$ingreso_ing=$ingreso_ing.$valor_ing;	
}
$otrosingresos=floatval($ingreso_ing);	




$idpromotor=get_promotor_usua($id_usuario);		
$idtipo_credito=get_tipo_credito_producto($idproducto);
//echo "averrrrrrrrrrrr";
//if(is_null($idpromotor)) {
	
	//echo "script languaje='javascript'>alert('El usuario que esta usando no es un Asesor, debe contar con una cuenta de Asesor.')</script>";	
//}


// se obtiene el tipo de credito solo porque nos va servir para unas vistas del sitema de credito fox, es informativo porque ya se sabe dentro de producto viene el tipo de credito
$folio="0";//informativo porque el folio se genera con el disparador de la base de datos
$sol_grupo=0; //como es solicitud individual se va en false

$idestatus=1; //significa q esta en tramite

$idsolgrupo="null";//CHECAR POQUE NO ACEPTA NULOS

$domicilio="null";
$telefono="null";
$desc_actividad="null";
$domicilio_unidad="null";

$emp_perm="null";
$emp_even="null";


if(isset($_SESSION["idparcelas"]))
$ids_parcelas=$_SESSION["idparcelas"];
else
$ids_parcelas="";	
if(isset($_SESSION["garantia_prendaria"]))
$ids_gara_prendarias=$_SESSION["garantia_prendaria"];
else
$ids_gara_prendarias="";
if(isset($_SESSION["garantia_hipotecaria"]))
$ids_gara_hipotecarias=$_SESSION["garantia_hipotecaria"];
else
$ids_gara_hipotecarias="";	





if($enviar=="GUARDAR")
	{
		

	


	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_solicitud('$id_periodo','$monto_finan','$idcliente','$idtipo_credito','$idgiro','$idproducto','$folio','$fecha_registro','$monto','$sol_grupo',$idsolgrupo,'$idestatus',$domicilio,$telefono,$desc_actividad,'$experiencia',$emp_perm,$emp_even,$domicilio_unidad,'$destino','$idpromotor','$gar_liq_porcentaje','$idcon_inv','$id_paquete','$id_usuario','$otrosgastos','$descripcionotrosgts','$otrosingresos','$descripcionotrosing','$ids_parcelas','$ids_gara_prendarias','$ids_gara_hipotecarias','$mov_sucursal','$t_sol')";

				
				$query = pg_query($con,$sql);
				//echo $sql;
				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('cc_solicitudes_idsolicitud_seq')::text,'cc_solicitudes','A','{$usuario}',
				'Alta de Solicitud de credito para el cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
				$querytmp = pg_query($con,$sql);
					

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		$idsolicitud=substr($resultado,1,(strlen($resultado)));
		$idsolicitud = substr($idsolicitud, 0,-1);
		$idsolicitud=trim($idsolicitud);
		
		
		
		//GUARDAMOS LAS REFERENCIAS BANCARIAS
		
		if(isset($_SESSION["refe"]))
		{
			inserta_refe_banco($_SESSION["refe"],$idsolicitud);
		}
		if(isset($_SESSION["refe_per"]))
		{
			inserta_refe_personal($_SESSION["refe_per"],$idsolicitud);
		}

		//FIN DEL GUARDADO DE LAS REFERENCIAS
		
						
unset($_SESSION["refe"]);
unset($_SESSION["refe_per"]);	
unset($_SESSION["idparcelas"]);	
unset($_SESSION["garantia_prendaria"]);	
unset($_SESSION["garantia_hipotecaria"]);	
			
			
		
		echo "<div align='center'><strong><font color='#003300'>La solicitud fue registrada correctamente</font></strong></div>";
		$fila=get_solicitud_m($idsolicitud);  //cuando no hay una consulta determinada se consulta la primera solicitud
		$modif=1;
		include("solicitud_m.php");
	
		}
		else
		{
		echo 0;
		exit;
		
		}


	}
	
	if($enviar=="MODIFICAR")
	{
	
	//idpromotor='$idpromotor',
	$sql = "set datestyle to 'dmy'; UPDATE cc_solicitudes SET monto_parafinanciera='$monto_finan',idcliente='$idcliente',idtipo_credito='$idtipo_credito',idgiro='$idgiro',idproducto='$idproducto',fecha_registro='$fecha_registro',monto='$monto',experiencia='$experiencia',destino='$destino',gar_liq_porcentaje='$gar_liq_porcentaje',idcon_inv='$idcon_inv',id_paquete='$id_paquete',usuario='$id_usuario',otrosgastos='$otrosgastos',descripcionotrosgts='$descripcionotrosgts',otrosingresos='$otrosingresos', descripcionotrosing='$descripcionotrosing',ids_parcelas='$ids_parcelas',ids_gara_prendarias='$ids_gara_prendarias',ids_gara_hipotecarias='$ids_gara_hipotecarias',t_sol='$t_sol' WHERE idsolicitud='$idsolicitud'";

$consulta=pg_query($con, $sql); 

//registrar logs
$usuario=$_SESSION["nombre_u"];
$sql="select registrar_logs(1,'{$idsolicitud}','cc_solicitudes','M','{$usuario}',
'Modificacion de Solicitud de credito del cliente:'||(select nombre||' '||ap_paterno||' '||ap_materno from cc_clientes where idcliente={$idcliente}));";
$querytmp = pg_query($con,$sql);
				

if($consulta>0)
		{
			
			
			
			
			
			//GUARDAMOS LAS REFERENCIAS BANCARIAS
			
			//primero eliminamos las referencias que tenemos actualmente por las sessiones
		
		if(isset($_SESSION["refe"]))
		{
			$band_reb=comprueba_si_hay_refe($idsolicitud);
			if($band_reb==1){ elimina_referencias_banco($idsolicitud); }
			inserta_refe_banco($_SESSION["refe"],$idsolicitud);
		}
		if(isset($_SESSION["refe_per"]))
		{	
		$band_rep=comprueba_si_hay_refeper($idsolicitud);
		if($band_rep==1){ elimina_referencias_personales($idsolicitud); }
		inserta_refe_personal($_SESSION["refe_per"],$idsolicitud);
		}

		//FIN DEL GUARDADO DE LAS REFERENCIAS
			
unset($_SESSION["refe"]);
unset($_SESSION["refe_per"]);	
unset($_SESSION["idparcelas"]);	
unset($_SESSION["garantia_prendaria"]);	
unset($_SESSION["garantia_hipotecaria"]);	
	
			
			
			
			
			
			
			
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		$fila=get_solicitud_m($idsolicitud);  //cuando no hay una consulta determinada se consulta la primera solicitud
		$modif=1;
		include("solicitud_m.php");
		


		
		
		}
		else
		{
					
		$modif=0;
		include("inicia_solicitud.php");
		}
	
	
	
	
	
	//echo $idcliente."<br>".$idtipo_credito."<br>".$idgiro."<br>".$idproducto."<br>".$folio."<br>".$fecha_registro."<br>".$monto."<br>".$sol_grupo."<br>".$idsolgrupo."<br>".$idestatus."<br>".$domicilio."<br>".$telefono."<br>".$desc_actividad."<br>".$experiencia."<br>".$emp_perm."<br>".$emp_even."<br>".$domicilio_unidad."<br>".$destino."<br>".$idpromotor."<br>".$gar_liq_porcentaje."<br>".$idcon_inv."<br>".$id_paquete."<br>".$id_usuario."<br>".$otrosgastos."<br>".$descripcionotrosgts."<br>".$otrosingresos."<br>".$descripcionotrosing."<br>".$ids_parcelas."<br>".$ids_gara_prendarias."<br>".$ids_gara_hipotecarias;
	
	
												
	
	
	
	}

	



?>