<?php
require_once '../PHPWord.php';

include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();


$idcredito=$_GET["idcredito"];

$meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

$fila_credito=get_credito_m($idcredito);
$fila_sol=get_solicitud_m($fila_credito["idsolicitud"]);
$fila_cliente=get_cliente($fila_sol["idcliente"]);					
$nombre_cliente=$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"]." ".$fila_cliente["nombre"];
$monto=$fila_credito["monto_parafinanciera"];
$fechaven=$fila_credito["fechaven"];
$letra = explode(".",$monto);
$entero=$letra[0];
$decimal=$letra[1];
$resultado = convertir_letra($entero);
$monto_letra="(  $resultado PESOS $decimal/100 MONEDA NACIONAL  )";
$idcliente=$fila_cliente["idcliente"];
$plazo=$fila_credito["meses"]*30;
$plazoletra=convertir_letra($fila_credito["meses"]*30);

$interes=$fila_credito["interes_normal"]/12;
$letrai = explode(".",$interes);
$entero=$letrai[0];
$decimal=$letrai[1];
$resultadoi = convertir_letra($entero);
$interesletra="  $resultadoi PUNTO $decimal ";



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

$fechav1 = explode("-",$fechaven); 
$fechav2 = $fechav1[2].$fechav1[1].$fechav1[0]; 
$fechaven =cambioFecha($fechav2); 


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



//obtiene superficie cultivada
$fila_solicitud=get_solicitud_m($fila_credito["idsolicitud"]);
$ids_parcelas=$fila_solicitud["ids_parcelas"];
$array_parcelas = explode("-",$ids_parcelas);
$array_parcelas=array_filter($array_parcelas);//quita cedenas vacias
$super_total=get_superficie_cultivada_total($array_parcelas);

$fila_producto=get_producto_m($fila_credito["idproducto"]);



	$fila_get_grupo=get_grupo_sol($fila_cliente["idcliente"]);
	if($fila_get_grupo!=0)
	$grupo=$fila_get_grupo["grupo"];
	else
	$grupo="SIN GRUPO";

$garantias=get_ghipotecarias($fila_cliente["idcliente"]);
$garantias.=get_gprendarias($fila_cliente["idcliente"]);


$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('com_plantilla_anexo.docx');

$document->setValue('nomcli', $nombre_cliente);
$document->setValue('domcli', $ubicacion);


$document->setValue('montocre', $monto_credito);
//$document->setValue('montocre', "                ");
$document->setValue('moncrelet', $monto_letra);
//$document->setValue('moncrelet', "                                     ");

$document->setValue('plazocre', $plazo);
$document->setValue('plazocrelet', $plazoletra);

$document->setValue('interes', $interes);
$document->setValue('intereslet', $interesletra);

$document->setValue('tot_hectarea', $super_total);
//$document->setValue('tot_hectarea', "             "); 
$document->setValue('loc_predio', $ubicacion);  

//obtener parametros para cauculo de datos
$parcelas=get_parcela_cultivo($idcliente);

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


//termina el calculo
$document->setValue('kiloprenda', $prendakilo);
//$document->setValue('kiloprenda', "        ");
$document->setValue('aportaproductor', $aportaproductor);
//$document->setValue('aportaproductor', "           ");
$document->setValue('aportaprolet', $aporta_letra);
//$document->setValue('aportaprolet', "                                        ");
$document->setValue('hectcultivo', $super_total);
//$document->setValue('hectcultivo', "             ");

$document->setValue('fechaven', $fechaven);
//$document->setValue('fechaven', "                    ");

$document->setValue('diaactual', $fecha1[2]);
//$document->setValue('diaactual', "    ");

$nmes=(int) $fecha1[1];
$document->setValue('mesactual', $meses[$nmes-1]);
//$document->setValue('mesactual', "           ");

$document->setValue('anioactual', $fecha1[0]);
//$document->setValue('anioactual', "      ");



$document->save('anexo.docx');
$enlace = "anexo.docx";


header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo
?>