<?php
require_once '../PHPWord.php';

include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();


$idcredito=17003;
//$_GET["idcredito"];
$fila_credito=get_credito_m($idcredito);
$fila_sol=get_solicitud_m($fila_credito["idsolicitud"]);
$fila_cliente=get_cliente($fila_sol["idcliente"]);					
$nombre_cliente=$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]." ".$fila_cliente["nombre"];
$monto=$fila_credito["monto"];
$letra = explode(".",$monto);
$entero=$letra[0];
$decimal=$letra[1];
$resultado = convertir_letra($entero);
$monto_letra="(  $resultado PESOS $decimal/100 MONEDA NACIONAL  )";

$monto_credito=number_format($monto,2);


$idlocalidad=$fila_cliente["idlocalidad"];
$idmunicipio=$fila_cliente["idmunicipio"];
$idestado=$fila_cliente["idestado"];
$idcolonia=$fila_cliente["idcolonia"];

$fila_localidad=get_localidad($idlocalidad);
$fila_municipio=get_municipio($idmunicipio);
$fila_estado=get_estado($idestado);
$fila_colonia=get_colonia($idcolonia);

$localidad=$fila_localidad["localidad"];
$estado=$fila_estado["estado"];
$municipio=$fila_municipio["municipio"];

$ubicacion="$localidad del municipio de $municipio del estado de $estado";

$fecha1 = explode("-",date("Y-m-d")); 
$fecha2 = $fecha1[0].$fecha1[1].$fecha1[2]; 
$fecha = cambioFecha($fecha2); 

//$fila_producto=get_producto_m($fila_credito["idproducto"]);

$nombre_cafe=get_parcela_cafe($fila_cliente["idcliente"]);

	$fila_get_grupo=get_grupo_sol($fila_cliente["idcliente"]);
	if($fila_get_grupo!=0)
	$grupo=$fila_get_grupo["grupo"];
	else
	$grupo="SIN GRUPO";

$garantias=get_ghipotecarias($fila_cliente["idcliente"]);
$garantias.=get_gprendarias($fila_cliente["idcliente"]);


$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('contrato_plantilla.docx');

$document->setValue('nombre', $nombre_cliente);
$document->setValue('monto_credito', $monto_credito);
$document->setValue('monto_letra', $monto_letra);
$document->setValue('nombre_cafe', $nombre_cafe);
$document->setValue('get_ubicacion', $ubicacion);
$document->setValue('get_fecha', $fecha);
$document->setValue('grupo',$grupo);
$document->setValue('get_garantias',$garantias);
$document->save('contrato.docx');
$enlace = "contrato.docx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo
?>