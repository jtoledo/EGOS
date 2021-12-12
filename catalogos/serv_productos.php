<?php
session_start();
$id_usuario=$_SESSION["usuario"];
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idproducto=$_POST["idproducto"];
$producto=$_POST["producto"];
$id_tipo=$_POST["id_tipo"];
$idper=$_POST["idper"];
$plazo=$_POST["plazo"];
$id_pago=$_POST["id_pago"];
$interes_normal=$_POST["interes_normal"];
$interes_moratorio=$_POST["interes_moratorio"];
$enviar=$_POST["enviar"];

$interes_mensual=$_POST["interes_mensual"];


$con=conectarse();

// valores por defecto de la tabla de cc_productos de cia
$clave.=substr($producto,0,2); 
/*$clave.="-";
$cadena_credito=get_tipo_credito($id_tipo);
$clave.=substr($cadena_credito,0,2); 
*/ 
$plazo_var=0;
$idpaquete=0;
$monto_mil=0;
$idgpoproducto=0;
$monto_mil2=0;
$cuenta_iva=0;
$iva=0;
$iva_int_normal=0;
//termina valores por defecto






if($enviar=="GUARDAR" /*and $band==1*/)
	{
	
		$sql= "SET datestyle TO postgres, dmy; select nuevo_producto('$interes_normal','$interes_moratorio','$producto','$clave','$idper','$plazo','$plazo_var','$id_pago','$interes_mensual','$id_tipo','$idpaquete','$monto_mil','$idgpoproducto','$monto_mil2','$cuenta_iva','$iva','$iva_int_normal','$id_usuario')";

				$query = pg_query($con,$sql);
				
				//registrar logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('cc_productos_idproducto_seq')::text,'cc_productos','A','{$usuario}',
				'Alta de producto financieros : {$producto}');";
				$querytmp = pg_query($con,$sql);	

				while($row = pg_fetch_row($query))
                        { 
						$resultado=$row[0];
						$consulta=1;
						
						}
	
	
		if($consulta>0)
		{
		
		//echo $resultado;
		
		$idproducto=substr($resultado,1,(strlen($resultado)));
		$idproducto = substr($idproducto, 0,-1);
		$idproducto=trim($idproducto);
		
		echo "<div  align='center'><strong><font color='#003300'>Registro ingresado exitosamente</font></strong></div>";
		
		
		
		
		 $fila= consul_productos_m($idproducto);
//		echo $producto["idproducto"];
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
	//$tipo_credito=get_tipo_credito($id_tipo);
	if($interes_mensual=="t")
	$tasa_interes=1;
	else
	$tasa_interes=0;
	
	//$periodo=get_periodo($idper);
		
		
		
		
		$modif=1;
		include("f_recursos.php");
		
		
		
		
		
		
		
		
		}
		else
		{
		$modif=0;
		echo "Error en el registro intente de nuevo mas tarde";
		include("f_recursos_new.php");
		}


	}

if($enviar=="MODIFICAR")
	{
	

	$sql = "set datestyle to 'dmy'; UPDATE cc_productos SET producto='$producto',id_tipo='$id_tipo',idper='$idper',plazo='$plazo',id_pago='$id_pago',interes_normal='$interes_normal',interes_moratorio='$interes_moratorio',interes_mensual='$interes_mensual',usuario='$id_usuario' WHERE idproducto='$idproducto'";

$consulta=pg_query($con, $sql); 

//registrar logs
$usuario=$_SESSION["nombre_u"];
$sql="select registrar_logs(1,'{$idproducto}','cc_productos','M','{$usuario}',
'Modificacion de producto financieros : {$producto}');";
$querytmp = pg_query($con,$sql);	

if($consulta>0)
		{
		echo "<div align='center'><strong><font color='#003300'>Registro modificado exitosamente</font></strong></div>";
		
		
		
		 $fila= consul_productos_m($idproducto);
//		echo $producto["idproducto"];
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
	//$tipo_credito=get_tipo_credito($id_tipo);
	if($interes_mensual=="t")
	$tasa_interes=1;
	else
	$tasa_interes=0;
	
	//$periodo=get_periodo($idper);
		
		
		
		
		$modif=1;
		include("f_recursos.php");
		
		
		
		
		
		
		
		
		}
		else
		{
		$modif=0;
		echo "Error en el registro intente de nuevo mas tarde";
		include("f_recursos_new.php");
		}
		
		
		
	}





?>