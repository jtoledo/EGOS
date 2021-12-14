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


?>
<p align="left"><strong>CARATULA ANEXA AL CONTRATO DE CR&Eacute;DITO DE HABILITACI&Oacute;N O AVIO EN FORMA DE APERTURA DE CR&Eacute;DITO SIMPLE</strong></p>

  <table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="8" align="center" bgcolor="#DFDFDF">CONDICIONES GENERALES</td>
    </tr>
  <tr>
    <td colspan="8" bgcolor="#DFDFDF">I.- DE LA ACREDITANTE</td>
    </tr>
  <tr>
    <td>NOMBRE</td>
    <td colspan="7">EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE, S.A DE C.V.</td>
    </tr>
  <tr>
    <td>CONSTITUTIVA</td>
    <td colspan="7" align="justify">ESCRITURA P&Uacute;BLICA N&Uacute;MERO 5651, VOLUMEN 83, DE FECHA 11 DE JUNIO DE 1991, PASADA ANTE LA FE DEL LICENCIADO JORGE CRUZ TOLEDO TRUJILLO, NOTERIO P&Uacute;BLICO N&Uacute;MERO 27 DEL ESTADO E INSCRITA BAJO EL N&Uacute;MERO 561 LIBRO 2</td>
    </tr>
  <tr>
    <td><font size="6">DATOS REGISTRALES</font></td>
    <td colspan="7">REG. NUM 561, LIBRO 2, SECCI&Oacute;N V, DEL 27 DE JUNIO DE 1991</td>
    </tr>
  <tr>
    <td colspan="2">REPRESENTANTE LEGAL</td>
    <td colspan="6">1.- C.P.A. JORGE ARTURO VARELA ROSALES</td>
    </tr>
  <tr>
    <td rowspan="2"><font size="6">DATOS DE EL PODER</font></td>
    <td colspan="7">1.- ESC. PUB. 5651, VOL 83, DE FECHA 11 DE JUNIO DE 1991, NOTARIO P&Uacute;BLICO 27, LIC JORGE CRUZ TOLEDO TRUJILLO.</td>
    </tr>
  <tr>
    <td colspan="7">2.- ESC. PUB. NUM 11, 466, VOL 350, DE FECHA 21 DE AGOSTO DE 2002, NOTARIO P&Uacute;BLICO NUM 56, LIC ANTONIO MELGAR</td>
    </tr>
  <tr>
    <td colspan="2" rowspan="2">DATOS REGISTRALES DEL PODER</td>
    <td colspan="6">1.- REG. NUM 561, LIBRO 2, SECCI&Oacute;N V, DEL 27 DE JUNIO DE 1991</td>
    </tr>
  <tr>
    <td colspan="6">2.- REG NUM 320, LIBRO 1, SECCI&Oacute;N V, DEL 27 DE AGOSTO DE 2002</td>
  </tr>
  	<tr>
    <td>DOMICILIO</td>
    <td colspan="7">CARRETERA A NVA. ALEMANIA KM 2.5, COL. BUROCR&Aacute;TICA</td>
    </tr>
  <tr>
    <td colspan="8" bgcolor="#DFDFDF">II.- DEL ACREDITADO</td>
  </tr>
  <tr>
    <td><strong>NOMBRE</strong></td>
    <td colspan="7">PEREZ BARTOLON ADAN</td>
  </tr>
  <tr>
    <td>DOMICILIO</td>
    <td colspan="7">EN LA LOCALIDAD MANACAL LLANO GRANDE DEL MUNICIPIO DE ESCUINTLA DEL ESTADO DE CHIAPAS</td>
  </tr>
  <tr>
    <td colspan="8" align="center" bgcolor="#DFDFDF"><strong>CLAUSULAS</strong></td>
    
  </tr>
  <tr>
    <td colspan="2"><strong>PRIMERA.-</strong> APERTURA DE CR&Eacute;DITO (MONTO)</td>
    <td colspan="6">$ 8,700 (OCHO MIL SETECIENTOS PESOS 00/100 M.N.)</td>
    </tr>
  <tr>
    <td colspan="2"><strong>SEGUNDA.-</strong> OBJETO DEL CR&Eacute;DITO</td>
    <td colspan="6" align="justify">CAPITAL DE TRABAJO PARA LABORES DE CORTE, ACARREO Y BENEFICIO DE 1.00 HECTAREAS DE CAFE EN EL PREDIO UBICADO EN LA LOCALIDAD MANACAL LLANO GRANDE, DEL MUNICIPIO DE ESCUINTLA</td>
    </tr>
  <tr>
    <td colspan="2"><strong>TERCERA.-</strong> PLAZO DEL CR&Eacute;DITO</td>
    <td colspan="6"><strong>180 CIENTO OCHENTA DIAS</strong></td>
    </tr>
  <tr>
    <td colspan="2" rowspan="2"><strong>SEPTIMA.-</strong> INTERESES ORDINARIOS</td>
    <td>TASA FIJA</td>
    <td colspan="5">3.02 % TRES PUNTO CERO DOS PORCIENTO MENSUAL</td>
    </tr>
  <tr>
    <td>TASA VARIABLE</td>
    <td colspan="5">N/A</td>
    </tr>
  <tr>
    <td colspan="2"><strong>NOVENA.-</strong> GARANT&Iacute;A ESPEC&Iacute;FICA</td>
    <td>DOMICILIO DEL DEP&Oacute;SITO</td>
    <td colspan="5" align="justify">9,000.00 KILOGRAMOS DE CAFE, EN EL DOMICILIO DEL ACREDITANTE UBICADO EN LA CARRETERA A NUEVA ALEMANIA KM 2.5, COL. BUROCR&Aacute;TICA; TAPACHULA CHIAPAS</td>
    </tr>
  <tr>
    <td colspan="2"><strong>D&Eacute;CIMA PRIMERA.-</strong> CONDICIONES <br />a) RECURSOS COMPLEMENTARIOS</td>
    <td colspan="6" align="justify">CON RECURSOS DEL ACREDITADO, LA CANTIDAD DE $ 10,853.80 (DIEZ MIL OCHOCIENTOS CINCUENTA Y TRES PESOS 80/100 M.N) DESTINADOS A COMPLEMENTAR EL CAPITAL DEL TRABAJO PARA LABORES DE CORTE, ACOPIO Y BENEFICIO DE 1.00 HECTAREAS DE CAFE</td>
    </tr>
  <tr>
    <td colspan="2"><strong>D&Eacute;CIMA S&Eacute;PTIMA.-</strong> JURISDICCI&Oacute;N Y COMPETENCIA</td>
    <td colspan="6">TRIBUNALES COMPETENTES DE LA CIUDAD DE TAPACHULA DE CORDOVA Y ORDO&Ntilde;EZ, CHIAPAS.</td>
    </tr>
  
</table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&quot;EL ACREDITADO&quot;</td>
    <td align="center">&quot;LA ACREDITANTE&quot;</td>
    <td align="center">EL OBLIGADO SOLIDARIO Y AVALISTA</td>
  </tr>
  <tr>
    <td align="center">PEREZ BARTOLON ADAN</td>
    <td align="center">1.- C.P.A. JORGE ARTURO VARELA ROSALES</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">2.- C.P- ALVARO PUIG COTA</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">________________________________________</td>
    <td align="center">________________________________________</td>
    <td align="center">________________________________________</td>
  </tr>
  <tr>
    <td align="center">Nombre y Frima</td>
    <td align="center">Nombre y Frima</td>
    <td align="center">Nombre y Frima</td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td align="center">TESTIGO</td>
    <td align="center">TESTIGO</td>
  </tr>
  <tr>
    <td align="center">C.P. JEANELLE DOMINGUEZ CARBOT</td>
    <td align="center">T.C. NORMA LILIA ARREVILLAGA MALDONADO</td>
  </tr>
  <tr>
    <td align="center">________________________________________</td>
    <td align="center">________________________________________</td>
  </tr>
  <tr>
    <td align="center">Nombre y Firma</td>
    <td align="center">Nombre y Firma</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
  <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center"><strong>PAGAR&Eacute;</strong></td>
  </tr>
  <tr>
    <td align="justify"><font size="6">Por este pagar&eacute; prometo (emos) y me (nos) obligo (amos) a pagar incondicionalmente a la orden de EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE, S.A DE C.V., en sus oficinas ubicadas en CARRETERA A NUEVA ALEMANIA KM 2.5, COL. BUROCR&Aacute;TICA; TAPACHUALA CHIAPAS, precisamente el d&iacute;a 23 de junio de 2012, la cantidad de $ 8,700.00 (OCHO MIL SETECIENTOS PESOS 00/100 M.N) la cual causar&aacute; intereses ordinarios sobre saldos insolutos a raz&oacute;n de : La tasa fija mensual del 3.02% mismo que ser&aacute; pagadero el &uacute;ltimo d&iacute;a de cada mes. Si el importe total o la parte proporcional corredpondiente a este pagar&eacute; no fuera pagado a su vencimiento, causar&aacute; intereses moratorios a raz&oacute;n de la tasa que se resulte de multiplicar por 2 dos la Tasa de inter&eacute;s Ordinaria. Dichos intereses se causar&aacute;n desde la fecha en que incurra en el incumplimiento hasta la regularizaci&oacute;n de los pagos. El (los) suscriptor (res) y su (s) avalista (s), se someten expresamente para el caso de controversia judicial, a la competencia de los tribunales de la ciudad de Tapachula, Estado de Chiapas. En la ciudad de Tapachula a los 27 d&iacute;as del mes de Diciembre de 2011.</font></td>
  </tr>
</table>
  
<table width="100%" border="0" cellpadding="3" cellspacing="0" align="center">
  <tr>
    <td colspan="3" width="100%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" width="70%" >Suscriptor (es) :</td>
    <td align="center" width="30%" >FIRMAS</td>
  </tr>
  <tr>
    <td align="left" width="15%">Nombre: </td>
    <td align="left" width="55%">PEREZ BARTOLON ADAN</td>
    <td align="center" width="30%">____________________________________</td>
  </tr>
  <tr>
    <td align="left" width="15%">Domicilio:</td>
    <td align="left" width="55%">EN LA LOCALIDAD MANACAL LLANO GRANDE DEL MUNICIPIO DE </td>
    <td align="center" width="30%">____________________________________</td>
  </tr>
  <tr>
    <td align="left" width="15%">Apoderado (s):</td>
    <td align="left" width="55%">&nbsp;</td>
    <td align="center" width="30%">____________________________________</td>
  </tr>
  <tr>
    <td align="left" width="15%">Aval (es):</td>
    <td align="left" width="55%">&nbsp;</td>
    <td width="30%">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" width="15%">Nombre:</td>
    <td align="left" width="55%">&nbsp;</td>
    <td align="center" width="30%">____________________________________</td>
  </tr>
  <tr>
    <td align="left" width="15%">Domicilio:</td>
    <td align="left" width="55%">&nbsp;</td>
    <td align="center" width="30%">____________________________________</td>
  </tr>
  <tr>
    <td align="left" width="15%">Apoderado (s):</td>
    <td align="left" width="55%">&nbsp;</td>
    <td align="center" width="30%">____________________________________</td>
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
$pdf->Output('Contrato_credito.pdf', 'D');

?>

