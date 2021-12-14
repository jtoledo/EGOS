<?php 
ob_start(); 
require_once('../TCPDF/tcpdf/config/lang/eng.php');
require_once('../TCPDF/tcpdf/tcpdf.php');
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->setPageOrientation("l");

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Software development');
$pdf->SetTitle('CONTRATO DE CREDITO');
$pdf->SetSubject('otro');
$pdf->SetKeywords('otro');


//$pdf->setPrintHeader(false); //elimina header
//$pdf->setPrintFooter(false); //elimina footer


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE S.A. DE C.V.", "EGO-910528-HX9 \n CARRETERA A NVA. ALEMANIA, KM. 2.5, COL. ".utf8_encode("BUROCRÁTICA").", TAPACHULA, CHIAPAS.");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(2,2,2);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(7);

//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 2);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '',8);

// add a page
$pdf->AddPage();

$idcredito=$_GET["idcredito"];
$fila_credito=get_credito_mm($idcredito);
$fila_sol=get_solicitud_m($fila_credito["idsolicitud"]);
$fila_cliente=get_cliente($fila_sol["idcliente"]);					
$nombre_cliente=$fila_cliente["nombre"]." ".$fila_cliente["ap_paterno"]." ".$fila_cliente["ap_materno"];
$monto=$fila_credito["monto"];
$letra = explode(".",$monto);
$entero=$letra[0];
$decimal=$letra[1];
$resultado = convertir_letra($entero);
$monto_letra="(  $resultado PESOS $decimal/100 MONEDA NACIONAL  )";


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

$fecha=date("d-m-Y");

$producto=get_producto_m($fila_credito["idproducto"]);

?>

<p align="center">TABLA DE AMORTIZACI&Oacute;N</p>

<table width="100%" border="1" cellpadding="2">
<tr>
<td>
<table width="100%" border="0" cellpadding="2">
  <tr>
    <td>Nombre</td>
    <td colspan="4" bgcolor="#DFDFDF"><?php echo nom($nombre_cliente); ?></td>
    <td align="center">Folio del cr&eacute;dito</td>
    <td bgcolor="#DFDFDF" ><?php echo $fila_credito["folio"]; ?></td>
    <td align="center">Fecha</td>
    <td align="center" bgcolor="#DFDFDF"><?php echo $fecha; ?></td>
  </tr>
  <tr>
    <td>Monto</td>
    <td colspan="4" bgcolor="#DFDFDF"><?php echo number_format($fila_credito["monto"],2) ?></td>
    <td align="center">Plazo</td>
    <td bgcolor="#DFDFDF" align="center" ><?php echo $fila_credito["meses"]; ?> Meses</td>
    <td align="center">Tasa</td>
    <td align="center" bgcolor="#DFDFDF"><?php echo $producto["interes_normal"]; ?></td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
<table width="200" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="1">
  <tr>
    <td align="center">MONTO</td>
    <td align="center">FECHA DE MINISTRACI&Oacute;N</td>
    <td align="center">CORTE</td>
    <td align="center">D&Iacute;AS DEL PERIODO</td>
    <td align="center">INTERESES NORMALES</td>
  </tr>
<?php
/*ALGORITMO PARA DETERMINAR LA TABLA DE AMORTIZACION DE NUESTRO CREDITO*/
$meses=$fila_credito["meses"];
$plazo_dias=$meses*30;
$fecha_ministracion=$fila_credito["f_ministracion"];
$fecha_vencimiento=Suma_fecha_dias($fila_credito["f_ministracion"],$plazo_dias,"sumar");
$interes=$producto["interes_normal"]/100;

$corrida=0;


$periodos=meses($fecha_ministracion,$fecha_vencimiento);

do
{

if($corrida==0)//Condicionamos la primera corrida del credito
{
$monto=$fila_credito["monto"];
$ultimo_dia=get_dia_ultimo($fecha_ministracion); //ultimo dia del primer mes
$fecha_inicio=$fecha_ministracion;               //fecha de inicio de operacion
$fecha_fin=get_fecha_fin($fecha_inicio,$ultimo_dia); //fecha fun del primer periodo
$fecha_corte=$fecha_vencimiento;  //fecha final
$dias_periodo=n_dias($fecha_inicio,$fecha_fin)+1;
$sum_interes_normal=($monto*$interes/30)*$dias_periodo;
}

if($corrida==1)//Proceso de tabla de amortizacion
{
$monto=$monto+$sum_interes_normal;
$fecha_inicio=DiasFecha($fecha_fin,1,"sumar");//fecha de inicio de operacion
$ultimo_dia=get_dia_ultimo($fecha_inicio); //ultimo dia del primer mes
$fecha_fin=get_fecha_fin($fecha_inicio,$ultimo_dia); //fecha fun del primer periodo

$corte=check_in_range($fecha_inicio,$fecha_fin,$fecha_vencimiento);
if($corte==1)//averigua donde se va detener
{
$bandera=1;
$fecha_fin=$fecha_vencimiento;
}



$dias_periodo=n_dias($fecha_inicio,$fecha_fin)+1;
$sum_interes_normal=($monto*$interes/30)*$dias_periodo;
}

$sum_total_interes=$sum_total_interes+$sum_interes_normal;

$fecha_inicio_p=cambia_formato_fecha($fecha_inicio);
$fecha_fin_p=cambia_formato_fecha($fecha_fin);


?>
<tr>
<td><div align="center"><? echo number_format($monto,2); ?></div></td>
<td><div align="center"><? echo $fecha_inicio_p;  ?></div></td>
<td><div align="center"><? echo $fecha_fin_p; ?></div></td>
<td><div align="center"><? echo $dias_periodo; ?></div></td>
<td><div align="right"><? echo number_format($sum_interes_normal,2); ?></div></td>
</tr>

<?php


$corrida=1;
$suma_dias=$suma_dias+$dias_periodo;

}while($suma_dias<=$plazo_dias);

$capital_interes=$fila_credito["monto"]+$sum_total_interes;
?>
</table>
<table width="100%" border="0">
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right"><strong>INTERESES</strong></td>
  <td align="right">$ <?php echo number_format($sum_total_interes,2); ?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right"><strong>CAPITAL</strong></td>
  <td align="right">$ <?php echo number_format($fila_credito["monto"]); ?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="right"><strong>CAPITAL + INTERESES</strong></td>
  <td align="right">$ <?php echo number_format($capital_interes,2); ?></td>
</tr>
</table>



<?php
$html=ob_get_contents(); 
ob_end_clean(); 

$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Tabla_amortizacion.pdf', 'D');

?>

