<?php 
ob_start(); 
$idcredito=$_GET["idcredito"];
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();

$fila_credito=get_credito_m($idcredito);

$fila_sol=get_solicitud_m($fila_credito["idsolicitud"]);
$fila=get_cliente($fila_sol["idcliente"]);

$estado=get_estado($fila["idestado"]);
$municipio=get_municipio($fila["idmunicipio"]);
$localidad=get_localidad($fila["idlocalidad"]);
$colonia=get_colonia($fila["idcolonia"]);

$par_cliente=get_parcela_cultivo($fila_sol["idcliente"]);
$heccultivable=$par_cliente["hectareacultivo"];
$cafe=$par_cliente["cafe"];
$mun_estado=$municipio["municipio"].",".$estado["estado"];



$regimen_conyugal=get_regimen($fila["regimen_conyugal"]);

$fila_get_grupo=get_grupo_sol($fila["idcliente"]);
	if($fila_get_grupo!=0)
	$grupo=$fila_get_grupo["grupo"];
	else
	$grupo="SIN GRUPO";


$giro=get_nom_giro($fila_sol["idgiro"]);

//obtiene superficie cultivada

$array_parcelas = explode("-",$fila_sol["ids_parcelas"]);
$array_parcelas=array_filter($array_parcelas);//quita cedenas vacias
$super_total=get_superficie_cultivada_total($array_parcelas);

$domicilio_unidad=get_domicilio_unidad($fila_sol["ids_parcelas"]);
$estado_parcela=get_estado($domicilio_unidad["idestado"]);
$muni_parcela=get_municipio($domicilio_unidad["idmunicipio"]);
$localidad_parcela=get_localidad($domicilio_unidad["idlocalidad"]);
$colonia_parcela=get_estado($domicilio_unidad["idcolonia"]);
$domicilio_parcela="".$colonia_parcela["colonia"]." ".$localidad_parcela["localidad"]." ".$muni_parcela["municipio"]." ".$estado_parcela["estado"]."";


$tipo_credito=get_tipo_credito_pdf($fila_sol["idproducto"]);

$concepto_inv=get_concepinv_pdf($fila_sol["idcon_inv"]);

$paquete=get_paquete_tec_pdf($fila_sol["id_paquete"]);

//comienza datos de capacidad y volumen punt 4

$stock_parcela=get_parcela_exist($fila_sol["idcliente"]);//verificar si tiene parcelas

if($stock_parcela==1 and $fila_sol["ids_parcelas"]!="")
{

//		$array_parcelas = explode("-",$fila_sol["ids_parcelas"]);
		
$array_parcelas = explode("-",$fila_sol["ids_parcelas"]);
$array_parcelas=array_filter($array_parcelas);//quita cedenas vacias

		
		$super_total=get_superficie_cultivada_total($array_parcelas);  
		$costo_cultivo_m2=get_costo_cultivo($fila_sol["id_paquete"]); //se obtiene la suma total de requerimientos por m2
		$suma_parcelas_m2=get_parcelas_m2($array_parcelas);// se obtiene las suma de todas las parcelas en  m2
		$costo_cultivo_total=$suma_parcelas_m2*$costo_cultivo_m2;
		$ingreso_por_hect=get_ingreso_xhec($fila_sol["id_paquete"]);  //inreso por hectaria recuperacion de la tabla de paquete-tec
		$ingreso_por_m2=$ingreso_por_hect/10000; //ingreso por en m2
		$super_total_cult=$suma_parcelas_m2*$ingreso_por_m2;
		$ingreso_bruto=$super_total_cult-$costo_cultivo_total;
		$porcentaje_liq=get_liquidez($fila_sol["idcliente"]);
		//$monto=($ingreso_bruto*$porcentaje_liq)/100;
		$ingreso_neto=$ingreso_bruto-$fila_sol["otrosgastos"];
		$ingreso_neto=$ingreso_neto+$fila_sol["otrosingresos"];
		
		//$cafe=get_cafe_cliente($array_parcelas);
}

//fin del punto 4

		$paquete=get_paquete_tec_m($fila_sol["id_paquete"]);
		
		$sum_hipo_propias=get_gtia_hipo_p($fila_sol["ids_gara_hipotecarias"],$fila_sol["idcliente"]);
		$sum_hipo_aval=get_gtia_hipo_a($fila_sol["ids_gara_hipotecarias"],$fila_sol["idcliente"]);
		
		$sum_pren_propias=get_gtia_pren_p($fila_sol["ids_gara_prendarias"],$fila_sol["idcliente"]);
		$sum_pren_aval=get_gtia_pren_a($fila_sol["ids_gara_prendarias"],$fila_sol["idcliente"]);
		
		$sum_hipotecarias=$sum_hipo_aval+$sum_hipo_propias;
		$sum_prendarias=$sum_pren_aval+$sum_pren_propias;
		
		$sum_hipo_pren_propias=$sum_hipo_propias+$sum_pren_propias;
		$sum_hipo_pren_aval=$sum_hipo_aval+$sum_pren_aval;
		
		
		$sum_total=$sum_hipo_pren_propias+$sum_hipo_pren_aval;
		
		
//obtener la cosecha actual
$consulta=pg_query($con,"SELECT * FROM co_pcosecha where activo");
$cosecha=pg_fetch_array($consulta);
		

set_include_path(get_include_path() . PATH_SEPARATOR . '../Php_excel/Classes');
require_once 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
//set_include_path(get_include_path() . PATH_SEPARATOR . 'reportes/'); //cambiamos el path
$objPHPExcel = $objReader->load("com_plantilla_supervision.xlsx");
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->SetCellValue('J9',$fila["idcliente"]);
$objPHPExcel->getActiveSheet()->SetCellValue('C9',nom("".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"].""));
$objPHPExcel->getActiveSheet()->SetCellValue('C10', nom($fila["domicilio"]).','.nom($mun_estado));
$objPHPExcel->getActiveSheet()->SetCellValue('I12', $cosecha["periodo"]);
//$objPHPExcel->getActiveSheet()->SetCellValue('J13', number_format($fila_credito["monto_parafinanciera"],2));
$objPHPExcel->getActiveSheet()->SetCellValue('C13',$domicilio_parcela);
$objPHPExcel->getActiveSheet()->SetCellValue('C12',$cafe);
//$objPHPExcel->getActiveSheet()->SetCellValue('C11',$super_total);
//$objPHPExcel->getActiveSheet()->SetCellValue('J11',$super_total);






$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("rep_supervision.xlsx");

$enlace = "rep_supervision.xlsx";
header ("Content-Disposition: attachment; filename=".$enlace."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
unlink($enlace);//eliminamos el archivo

?>





