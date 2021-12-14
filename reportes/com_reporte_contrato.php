<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

require_once '../PHPWord.php';

include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$con=conectarse();


$idcredito=$_GET["idcredito"];
$fila_credito=get_credito_m($idcredito);
$fila_sol=get_solicitud_m($fila_credito["idsolicitud"]);
$fila_cliente=get_cliente($fila_sol["idcliente"]);					
$nombre_cliente=$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]." ".$fila_cliente["nombre"];
$monto=$fila_credito["monto_parafinanciera"];
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

$fila_producto=get_producto_m($fila_credito["idproducto"]);

$nombre_cafe=get_parcela_cafe($fila_cliente["idcliente"]);

	$fila_get_grupo=get_grupo_sol($fila_cliente["idcliente"]);
	if($fila_get_grupo!=0)
	$grupo=$fila_get_grupo["grupo"];
	else
	$grupo="SIN GRUPO";

$garantias=get_ghipotecarias($fila_cliente["idcliente"]);
$garantias.=get_gprendarias($fila_cliente["idcliente"]);


$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('com_plantilla_contrato.docx');

$document->setValue('nombre', $nombre_cliente);
$document->setValue('monto_cre', $monto_credito);
$document->setValue('monto_letra', $monto_letra);
$document->setValue('nombre_cafe', $nombre_cafe);
$document->setValue('localidad', $localidad);
$document->setValue('municipio', $municipio);
$document->setValue('estado', $estado);

$document->setValue('get_fecha', $fecha);
$document->setValue('grupo',$grupo);

/*
echo $nombre_cliente;
echo $monto_credito;
echo $monto_letra;
echo $nombre_cafe;
echo $localidad;
echo $municipio;
echo $estado;
echo $fecha;
echo $grupo;
*/
//obtener parametros para cauculo de datos
$parcelas=get_parcela_cultivo($fila_sol["idcliente"]);

$heccultivable=$parcelas["hectareacultivo"];
$kgxhectarea=$parcelas["kgxhectarea"];
$precioxhectarea=$parcelas["precioxhectarea"];
$cuotacredito=$parcelas["cuotacredito"];
$cuotaproductor=$parcelas["cuotaproductor"];
$prendakilo=round($heccultivable*$kgxhectarea,2);
$prendakilo=number_format($prendakilo,2);
$aportaproductor=round($heccultivable*$cuotaproductor,2);
$letra = explode(".",$aportaproductor);



$aportaproductor=number_format($aportaproductor,2);

$entero=$letra[0];
$decimal=$letra[1];
$resultado = convertir_letra($entero);
$aporta_letra="(  $resultado PESOS $decimal/100 MONEDA NACIONAL  )";

$nivelprecio=round($fila_credito["monto_parafinanciera"]/($heccultivable*$precioxhectarea),2);
$letra = explode(".",$nivelprecio);
$nivelprecio=number_format($nivelprecio,2);
$entero=$letra[0];
$decimal=$letra[1];
$resultado = convertir_letra($entero);
$nivelpreciolet="(  $resultado PESOS $decimal/100 MONEDA NACIONAL  )";

$nivelprex=number_format(round(($heccultivable*$kgxhectarea),2),2);

//termina el calculo de datos de aportacion del productor

$document->setValue('aportacionprod',  $aportaproductor);
$document->setValue('aportacionprodletra',  $aporta_letra);
$document->setValue('nivelprecio',  $nivelprecio);
$document->setValue('nivelprecioletra',  $nivelpreciolet);
$document->setValue('get_garantias',$nivelprex);
//termina llenado de dato del calculo

$nmes=(int) $fecha1[1];

/*
echo $aportaproductor;
echo $aporta_letra;
echo $monto_credito;
echo $nivelprecio;
echo $nivelpreciolet;
echo $nivelprex;
echo $meses[$nmes-1];
echo $fecha1[2];
echo $fecha1[0];
echo $fila_sol["idcliente"];
*/

$document->setValue('mes', $meses[$nmes-1]);
$document->setValue('dia',  $fecha1[2]);
$document->setValue('aactual',  $fecha1[0]);
$document->setValue('codigocl', $fila_sol["idcliente"]);


$document->save('contrato.docx');
$enlace = "contrato.docx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>
