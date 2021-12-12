<?php 
ob_start(); 
$idsolicitud=$_GET["idsolicitud"];
require_once('../config/lang/eng.php');
require_once('../tcpdf.php');
include("../../../includes/constantes.php");
include("../../../includes/funciones.php");
include("../../../bd/conexion.php"); 
$con=conectarse();
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->setPageOrientation("l");

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Software development');
$pdf->SetTitle('REPORTE DE SOLICITUD DE CREDITO');
$pdf->SetSubject('otro');
$pdf->SetKeywords('otro');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE S.A. DE C.V.", "EGO-910528-HX9 \n CARRETERA A NVA. ALEMANIA, KM. 2.5, COL. ".utf8_encode("BUROCRÁTICA").", TAPACHULA, CHIAPAS.");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetMargins(8, PDF_MARGIN_TOP,8);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 7);

// add a page
$pdf->AddPage();

$fila_sol=get_solicitud_m($idsolicitud);
$fila=get_cliente($fila_sol["idcliente"]);

$estado=get_estado($fila["idestado"]);
$municipio=get_municipio($fila["idmunicipio"]);
$localidad=get_localidad($fila["idlocalidad"]);
$colonia=get_colonia($fila["idcolonia"]);

$masculino=$fila["masculino"];
if($masculino=='t')
{
$genero="Masculino";
}
else
{
$genero="Femenino";
}

$regimen_conyugal=get_regimen($fila["regimen_conyugal"]);
$grupo=get_grupo_sol($fila["idcliente"]);
$giro=get_nom_giro($fila_sol["idgiro"]);


$domicilio_unidad=get_domicilio_unidad($fila_sol["ids_parcelas"]);

$estado_parcela=get_estado($domicilio_unidad["idestado"]);
$muni_parcela=get_municipio($domicilio_unidad["idmunicipio"]);
$localidad_parcela=get_localidad($domicilio_unidad["idlocalidad"]);
$colonia_parcela=get_estado($domicilio_unidad["idcolonia"]);

$domicilio_parcela="".$domicilio_unidad["desc_predio"]." ubicada ".$colonia_parcela["colonia"]." ".$localidad_parcela["localidad"]." ".$muni_parcela["municipio"]." ".$estado_parcela["estado"]."";

$tipo_credito=get_tipo_credito_pdf($fila_sol["idproducto"]);

$concepto_inv=get_concepinv_pdf($fila_sol["idcon_inv"]);

$paquete=get_paquete_tec_pdf($fila_sol["id_paquete"]);

//comienza datos de capacidad y volumen punt 4
		$array_parcelas = explode("-",$fila_sol["ids_parcelas"]);
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

//fin del punto 4

		
		$sum_hipo_propias=get_gtia_hipo_p($fila_sol["ids_gara_hipotecarias"],$fila_sol["idcliente"]);
		$sum_hipo_aval=get_gtia_hipo_a($fila_sol["ids_gara_hipotecarias"],$fila_sol["idcliente"]);
		
		$sum_pren_propias=get_gtia_pren_p($fila_sol["ids_gara_prendarias"],$fila_sol["idcliente"]);
		$sum_pren_aval=get_gtia_pren_a($fila_sol["ids_gara_prendarias"],$fila_sol["idcliente"]);
		
		$sum_hipotecarias=$sum_hipo_aval+$sum_hipo_propias;
		$sum_prendarias=$sum_pren_aval+$sum_pren_propias;
		
		$sum_hipo_pren_propias=$sum_hipo_propias+$sum_pren_propias;
		$sum_hipo_pren_aval=$sum_hipo_aval+$sum_pren_aval;
		
		
		$sum_total=$sum_hipo_pren_propias+$sum_hipo_pren_aval;

		


?>
<p align="center">SOLICITUD</p>
<p align="left"><strong>1.- IDENTIFICACI&Oacute;N DEL SOLICITANTE</strong></p>
<table width="100%" border="1" cellpadding="2">
  <tr>
    <td>Nombre</td>
    <td colspan="4" bgcolor="#DFDFDF"><?php echo nom("".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"].""); ?></td>
    <td >Rfc</td>
    <td bgcolor="#DFDFDF" ><?php echo nom($fila["rfc"]); ?></td>
  </tr>
  <tr>
    <td>Domicilio</td>
    <td colspan="4" bgcolor="#DFDFDF"><?php echo nom($fila["domicilio"]); ?></td>
    <td>Sexo</td>
    <td bgcolor="#DFDFDF"><?php echo nom($genero); ?></td>
  </tr>
  <tr>
    <td>Colonia</td>
    <td colspan="2" bgcolor="#DFDFDF"><?php echo nom($estado["estado"]); ?></td>
    <td>Localidad</td>
    <td bgcolor="#DFDFDF"><?php echo nom($localidad["localidad"]); ?></td>
    <td >Municipio</td>
    <td bgcolor="#DFDFDF" ><?php echo nom($municipio["municipio"]); ?></td>
  </tr>
  <tr>
    <td>Curp</td>
    <td colspan="2" bgcolor="#DFDFDF"><?php echo nom($fila["curp"]); ?></td>
    <td>Estado</td>
    <td bgcolor="#DFDFDF"><?php echo nom($estado["estado"]) ?></td>
    <td >Tel&eacute;fono</td>
    <td bgcolor="#DFDFDF"><?php echo nom($fila["telefono1"]); ?></td>
  </tr>
  <tr>
    <td colspan="2">Nombre del conyugue</td>
    <td colspan="2" bgcolor="#DFDFDF"><?php echo nom($fila["nombre_conyuge"]); ?></td>
    <td align="center" >R&eacute;gimen Conyugal</td>
    <td colspan="2" align="center" bgcolor="#DFDFDF"><?php echo nom($regimen_conyugal["regimen"]); ?></td>
  </tr>
  <tr>
    <td colspan="3">No de integrantes de la Familia</td>
    <td bgcolor="#DFDFDF"><?php echo nom($fila["integrantes_familia"]); ?></td>
    <td>Grupo</td>
    <td colspan="2" bgcolor="#DFDFDF"><?php echo nom($grupo["grupo"]); ?></td>
  </tr>
  <tr>
    <td colspan="3"></td>
    <td colspan="2">Beneficiario</td>
    <td colspan="2" bgcolor="#DFDFDF"><?php echo nom($fila["nombre_conyuge"]); ?></td>
  </tr>
</table>
<p align="left"><strong> 2.- ACTIVIDAD Y EXPERIENCIA</strong></p>
<table width="100%" border="1" cellpadding="2">
  <tr>
    <td colspan="3">Descripci&oacute;n de la actividad</td>
    <td colspan="6" bgcolor="#DFDFDF"><?php echo nom($giro); ?></td>
  </tr>
  <tr>
    <td colspan="3">Tiempo de experiencia de la actividad</td>
    <td bgcolor="#DFDFDF"><?php echo nom($fila_sol["experiencia"]); ?></td>
    <td>Giro</td>
    <td colspan="4" bgcolor="#DFDFDF"><?php echo nom($giro); ?></td>
  </tr>
  <tr>
    <td colspan="4">Domicilio y denominaci&oacute;n de la unidad econ&oacute;mica a financiar:</td>
    <td colspan="5" bgcolor="#DFDFDF"><?php echo nom($domicilio_parcela); ?></td>
  </tr>
</table>
<p align="left"><strong>3.- FINANCIAMIENTO SOLICITADO</strong></p>
<table width="100%" border="1" cellpadding="2">
  <tr>
    <td><strong>Destino:</strong></td>
    <td colspan="2" bgcolor="#DFDFDF"><?php echo nom($fila_sol["destino"]); ?></td>
  </tr>
  <tr>
    <td align="center">Tipo de Cr&eacute;dito</td>
    <td align="center">Concepto de inversi&oacute;n</td>
    <td align="center">Monto</td>
  </tr>
  <tr>
    <td bgcolor="#DFDFDF" align="center"><?php echo nom($tipo_credito); ?></td>
    <td bgcolor="#DFDFDF" align="center"><?php echo nom($concepto_inv["concepto_inversion"]); ?></td>
    <td bgcolor="#DFDFDF" align="center">$ <?php echo number_format($fila_sol["monto"],2); ?></td>
  </tr>
</table>
<p align="left"><strong>4.- CAPACIDAD, VOLUMEN DE PRODUCCI&Oacute;N E INGRESOS (Empresa Comercial y de Servicios)</strong></p>
<table width="100%" border="1" cellpadding="2">
  <tr>
    <td><strong>Superficie Productiva:</strong></td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($super_total,2); ?></td>
    <td align="center"><strong>Paquete tecnol&oacute;gico:</strong></td>
    <td colspan="2"><?php echo nom($paquete["nom_paquete"]); ?></td>
  </tr>
  <tr>
    <td align="center">Concepto</td>
    <td align="center">Monto</td>
    <td colspan="3" align="center">Descripci&oacute;n</td>
  </tr>
  <tr>
    <td><strong>(+) Ingreso por cosecha</strong></td>
    <td bgcolor="#DFDFDF" align="right"><?php echo number_format($super_total_cult,2); ?></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>(-) Costo de cosecha</strong></td>
    <td bgcolor="#DFDFDF" align="right"><?php echo number_format($costo_cultivo_total,2); ?></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Ingreso esperado</strong></td>
    <td bgcolor="#DFDFDF" align="right"><?php echo number_format($ingreso_bruto,2); ?></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>(+) Otros ingresos</strong></td>
    <td bgcolor="#DFDFDF" align="right"><?php echo number_format($fila_sol["otrosingresos"],2); ?></td>
    <td colspan="3" bgcolor="#DFDFDF" align="center"><?php echo $fila_sol["descripcionotrosing"]; ?></td>
  </tr>
  <tr>
    <td><strong>
   (-) Otros gastos</strong></td>
    <td bgcolor="#DFDFDF" align="right"><?php echo number_format($fila_sol["otrosgastos"],2); ?></td>
    <td colspan="3" bgcolor="#DFDFDF" align="center"><?php echo $fila_sol["descripcionotrosgts"]; ?></td>
  </tr>
  <tr>
    <td><strong>Ingreso neto o utilidad</strong></td>
    <td bgcolor="#DFDFDF" align="right"><?php echo number_format($ingreso_neto,2); ?></td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<p align="left"><strong>5.- GARANT&Iacute;AS</strong></p>
<table width="100%" border="1" cellpadding="2">
  <tr>
    <td>Categor&iacute;a</td>
    <td align="center">Propias</td>
    <td align="center">Aval</td>
    <td align="center">Total</td>
  </tr>
  <tr>
    <td>Hipotecarias</td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($sum_hipo_propias,2); ?></td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($sum_hipo_aval,2); ?></td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($sum_hipotecarias,2); ?></td>
  </tr>
  <tr>
    <td>Prendarias</td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($sum_pren_propias,2); ?></td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($sum_pren_aval,2); ?></td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($sum_prendarias,2); ?></td>
  </tr>
  <tr>
    <td>Sumas</td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($sum_hipo_pren_propias,2); ?></td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($sum_hipo_pren_aval,2); ?></td>
    <td bgcolor="#DFDFDF" align="center"><?php echo number_format($sum_total,2); ?></td>
  </tr>
</table>
<p align="left"><strong>6.- REFERENCIAS</strong></p>
<p align="left"><strong>Bancarias</strong></p>
<table width="100%" border="1" cellpadding="0">
  <tr>
    <td align="center" width="13%">Banco</td>
    <td align="center" width="14%">Sucursal</td>
    <td align="center" width="20%">Direcci&oacute;n</td>
    <td align="center" width="10%">Tel&eacute;fono</td>
    <td align="center" width="8%">Tipo</td>
    <td align="center" width="15%">Cuenta</td>
    <td align="center" width="20%">Contacto</td>
  </tr>
<?php 

$comprueba=verifica_ref_banco($idsolicitud);
if($comprueba==1)
get_referencias_bancarias_pdf($idsolicitud);

 ?>
</table>
<p align="left"><strong>Personales  (no familiares)</strong></p>
<table width="100%" border="1" cellpadding="2">
  <tr>
    <td align="center">Nombre</td>
    <td align="center">Direcci&oacute;n</td>
    <td align="center">Tel&eacute;fono</td>
  </tr>
  <?php 
$comprueba_p= verifica_ref_personal($idsolicitud);
if($comprueba_p==1)
get_referencias_personales_pdf($idsolicitud); 
  
  ?>
</table>
<table width="100%" border="0" cellpadding="2">
  <tr>
    <td align="justify"><font size="6">PARA LOS EFECTOS DE LOS ART&Iacute;CULOS 112 DE LA LEY DE INSTITUCIONES DE CR&Eacute;DITO Y 386 DEL C&Oacute;DIGO PENAL PARA EL DISTRITO FEDERAL Y SUS CORRELATIVOS PARA ESTE ESTADO, SE CONSIDERA COMO FRAUDE EL HECHO DE QUE UNA PERSONA F&Iacute;SICA O MORAL, PARA OBTENER UN PR&Eacute;STAMO POR PARTE DE UNA INSTITUCI&Oacute;N DE CR&Eacute;DITO, PROPORCIONE A &Eacute;STA DATOS FALSOS SOBRE EL MONTO DE SU ACTIVO O PASIVO. HAGO CONSTAR QUE LOS DATOS ASENTADOS EN LA PRESENTE SOLICITUD SON VER&Iacute;DICOS Y FACULTO AL PERSONAL DE EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE, S.A. DE C.V. PARA QUE INVESTIGUE SU AUTENTICIDAD. EN CASO DE CAMBIO DE DOMICILIO ME COMPROMETO A INFORMARLO POR ESCRITO.</font></td>
  </tr>
</table>

<table width="100%" border="1" cellpadding="1">
<tr>
<td>

<table width="100%" border="0" cellpadding="1">
  <tr>
    <td align="center">Nombre y firma del solicitante</td>
    <td align="center">Nombre y firma de quien recibe</td>
    <td align="center">Fecha de recepci&oacute;n formal</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><table width="100%" border="0"><tr><td>D&iacute;a</td><td>Mes</td><td>A&ntilde;o</td></tr></table></td>
  </tr>
</table>

</td>
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
$pdf->Output('Solicitud.pdf', 'D');

?>

