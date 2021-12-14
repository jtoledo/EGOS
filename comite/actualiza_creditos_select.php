<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];
$valor = $_POST["valor"];
$form = $_POST["form"];
$idcredito = $_POST["idcredito"];
$idcliente = $_POST["idcliente"];
$f_entrega =trim($_POST["f_entrega"]);
$observaciones = $_POST["observaciones"];
$monto_auto = $_POST["monto_auto"];
$enviar = $_POST["enviar"];
$idgrupo = $_POST["idgrupo"];
$con=conectarse();


$errores_update_creditos = validar_campos_obligatorios(array($valor,$form));	
$errores_update_estatus = validar_campos_obligatorios(array($valor,$form,$idcredito));	

$valida_documentos = validar_campos_obligatorios(array($form,$idcredito));	

$valida_cliente = validar_campos_obligatorios(array($form,$idcliente));	

$valida_creditos_atorgar = validar_campos_obligatorios(array($form,$idcredito));	


$valida_creditos_cambia_estatus = validar_campos_obligatorios(array($form,$observaciones,$enviar,$form));	


$valida_auto_grupo = validar_campos_obligatorios(array($form,$idgrupo));	

	
	if(!empty($errores_update_creditos))
	{
		$band_credito=1;
	}
	if(!empty($errores_update_estatus))
	{
		$band_estatus=1;
	}

		if(!empty($valida_documentos))
	{
		$band_documentos=1;
	}

		if(!empty($valida_cliente))
	{
		$band_cliente=1;
	}

	if(!empty($valida_creditos_atorgar))
	{
		$band_credito_otorgar=1;
	}
	
	if(!empty($valida_creditos_cambia_estatus))
	{
		$band_credito_status=1;
	}
	
	if(!empty($valida_auto_grupo))
	{
		$band_grupo_status=1;
	}
	
	/*termina las validaciones */
	
	
	
	if($band_credito==1 and $form==1)
	{
	 
	 get_creditos_update($valor);
	  
	}
		if($band_estatus==1 and $form==2)//cambia el status del creditop
	{
		
	comprueba_estatus_credito($idcredito);	
		
	 $f_entrega=date("Y-m-d");
	$resultado_consulta= cc_cambia_estatus_credito($valor,$idcredito,$f_entrega);
	
	//registra logs
	$usuario=$_SESSION["nombre_u"];
	$sql="select registrar_logs(1,'{$idcredito}','cc_creditos','C','{$usuario}',
	'Credito entregado {$f_entrega} folio :'||(select folio from cc_creditos where idcredito={$idcredito}));";
	$querytmp = pg_query($con,$sql);
	 
	  if($resultado_consulta==1)
		  {
	 get_creditos_update($valor);
	  
		  }
		  else { echo 0;}


	}
	
if($band_documentos==1 and $form==3)
	{
	comprueba_estatus_credito($idcredito);	 
	cc_get_documentos($idcredito);
	  
	}
		
		if($band_cliente==1 and $form==4)
	{
	 
	update_creditos_autorizados($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
	  
	}
		
	
	
	/*PROCESO DE CREDITOS*/
	
	
	
	
	
	
	
		if($band_credito_otorgar==1 and $form==5) //verificar si el credito esta entregado o no
	{
			comprueba_estatus_credito($idcredito);	
			$estado_credito=get_estado_credito($idcredito);
			 
				if($estado_credito==1)//quiere decir que el credito ya esta entregado
				{
					
					echo "<div id='bloque'>";
					$fila_credito=get_credito_m($idcredito);
					get_datos_cliente_credito($fila_credito["idsolicitud"],$idcredito);
					echo "</div>";
					get_detalle_credito_entregado($idcredito,$id_usuario);
					cc_get_documentos($idcredito);
					
				}
				if($estado_credito==0)//quiere decir que el credito no esta entregado
				{
					echo "<div id='bloque'>";
					$fila_credito=get_credito_m($idcredito);
					get_datos_cliente_credito($fila_credito["idsolicitud"],$idcredito);
					echo "</div>";
					get_detalle_credito_entregar($idcredito,$id_usuario);
				}
	
	
	
	  
	}




	if($band_credito_status==1 and $form==6 )  //operacion donde cambiarmos el estatus del credito a entregado
	{
	 comprueba_estatus_credito($idcredito);	
	 //tratamos el monto autorizado
	$monto_auto = explode(",",$monto_auto); 
	foreach($monto_auto as $valor)
	{
	$monto_a=$monto_a.$valor;	
	}
	$montos=floatval($monto_a);	
	 //and monto autorizado
	 
	 
		$valor=1;
		$resultado_consulta= cc_cambia_estatus_credito($valor,$idcredito,$f_entrega,$observaciones,$montos); //cambiamos el satus del credito a entregado
	  
			//registra logs
			$usuario=$_SESSION["nombre_u"];
			$sql="select registrar_logs(1,'{$idcredito}','cc_creditos','C','{$usuario}',
			'Credito entregado {$f_entrega}, folio :'||(select folio from cc_creditos where idcredito={$idcredito}));";
			$querytmp = pg_query($con,$sql);  
	  
	  if($resultado_consulta==1)  //presentamos la consulta del credito entregado
		  {
	echo "<div id='bloque'>";
	$fila_credito=get_credito_m($idcredito);
    get_datos_cliente_credito($fila_credito["idsolicitud"],$idcredito);
	echo "</div>";
			  
			  
			echo "<div  align='center'><strong><font color='#003300'>Estado de crédito cambiado exitosamente</font></strong></div>";

	 get_detalle_credito_entregado($idcredito,$id_usuario);
	 cc_get_documentos($idcredito);
	
	  
		  }
		  else { echo 0;}
	
	
	  
	}



	if($band_grupo_status==1 and $form==7) //FORM =7 PARA PODER FILTRAR SOLICITUDES X GRUPO
	{
	 
	include("f_auto_grupo.php");
	  
	}
	
	if($band_documentos==1 and $form==8) //FORM =8 EN ESTE MODULO CANCELAM0S EL CREDITO
	{
	$f_cancela=date("d-m-Y");
	
	/*COMPROBAMOS QUE EL CREDITO NO SE LE HALLA EMITIDO UN CHEQUE, EN EL CASO QUE SI TENGA CHEQUE NO PODRA SER CANCELADO*/
	$estado_credito=comprobar_credito_cheque($idcredito);   //ESTADO_CREDITO=1--->CHEQUE EN TRANSITO  0--->CHEQUE CANCELADO
	
	/*FIN DE LA COMPROBACION , ANTES DE CANCELAR EL CHEQUE**/
	if($estado_credito==1)
	{
		echo 0;
		exit;
	}
	if($estado_credito!=1) //ACA VALIDAMOS QUE EL CREDITO NO TENGA CHEQUES EN TRANSITOS
	{
	
					$sql= "SET datestyle TO postgres, dmy; select cc_cancela_credito('$idcredito','$f_cancela','$id_usuario')";
				
								$query = pg_query($con,$sql);
								
								//registra logs
								$usuario=$_SESSION["nombre_u"];
								$sql="select registrar_logs(1,'{$idcredito}','cc_creditos','C','{$usuario}',
								'Cancelacion de creditos folio :'||(select folio from cc_creditos where idcredito={$idcredito}));";
								$querytmp = pg_query($con,$sql);
				
								while($row = pg_fetch_row($query))
										{ 
										
										$consulta=1;
										
										}
					
					
						if($consulta>0)
						{
					echo "<div id='bloque'>";
					$fila_credito=get_credito_m($idcredito);
					get_datos_cliente_credito($fila_credito["idsolicitud"],$idcredito);
					echo "</div>";
				
				echo "<div align='center'><strong><font color='#003300'>El credito fue cancelado exitosamente</font></strong></div>";
				
					 get_detalle_credito_cancelado($idcredito,$id_usuario);//CONSULTA DE LA CANCELACION DEL CREDITO
					 
					 get_detalles_cancelacion($idcredito);
					 
							
						
						}
						
	}
	  
	}
		




?>
