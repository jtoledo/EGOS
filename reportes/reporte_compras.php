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

$pdf->setPageOrientation("l");

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
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(7, 30, 7);

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
$pdf->SetFont('helvetica', '', 8);

// add a page
$pdf->AddPage();


?>
<p align="left"><strong> Compras</strong></p>
<table width="100%" border="1" cellpadding="2">
<tr>
<td align="center" width="5%" bgcolor="#DFDFDF">Folio</td>
<td align="center" width="23%" bgcolor="#DFDFDF">Proveedor</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Producto</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Fecha</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Henequen</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Yute</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Bolsa</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Kgs Brutos</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Tara</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Kgs Netos</td>
<td align="center" width="7%" bgcolor="#DFDFDF">Precio kilo</td>
<td align="center" width="9%" bgcolor="#DFDFDF">Total</td>
</tr>
<?php

$compara=get_compras_cliente_pdf();
if($compara!=0)
get_notas_compras_pdf();




?>


</table>


<?php
$html=ob_get_contents(); 
ob_end_clean(); 

$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Compras.pdf', 'D');

?>

