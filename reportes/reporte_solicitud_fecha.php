<?php 
ob_start(); 
require_once('../TCPDF/tcpdf/config/lang/eng.php');
require_once('../TCPDF/tcpdf/tcpdf.php');
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

$idgrupo=$_GET["idgrupo"];
$fecha_i=$_GET["fecha_i"];
$fecha_f=$_GET["fecha_f"];
$con=conectarse();
$fila_grupo=get_grupo_m($idgrupo);
if($fila_grupo!=0)
$grupo=$fila_grupo["grupo"];
else
$grupo="INDIVIDUALES";



// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->setPageOrientation("l");

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Software development');
$pdf->SetTitle('REPORTE SOLICITUDES X GRUPO');
$pdf->SetSubject('otro');
$pdf->SetKeywords('otro');


// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE S.A. DE C.V.", "EGO-910528-HX9 \n CARRETERA A NVA. ALEMANIA, KM. 2.5, COL. ".utf8_encode("BUROCRÁTICA").", TAPACHULA, CHIAPAS.");

/*COMIENZA LA MODIFICACION DEL ENCABEZADO**/


class MYPDF extends TCPDF 
{
	public function Header() 
	{
        // Logo
        $image_file = K_PATH_IMAGES.'tcpdf_logo.jpg';
       $this->Image($image_file, 10, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 8);
        // Title  //ancho,altura,texto,marco,alineaion
        /*ponemos color al texto y a las lineas */
        $this->SetTextColor(0,0,0);
        $this->SetDrawColor(0,0,0);
        /* definimos variables con titulo y subtitulo */
        $titulo="EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE S.A. DE C.V., EGO-910528-HX9 ";
        $subtitulo="CARRETERA A NVA. ALEMANIA, KM. 2.5, ".utf8_encode("BUROCRÁTICA").", TAPACHULA, CHIAPAS";
		
		
        /* posicionamos el puto de insercion 2mm. debajo
           del borde del papel */
        $this->SetY(8);
        /* escribimos el titulo con la fuente que se establezca
        por el método opcion SetHeaderFont */
        $this->Cell(0, 5,$titulo,0,1,'C');
         /* modificamos tipografia para el subtitulo
          e insertamos este */
        $this->SetFont('helvetica', 'I', 7);
        $this->Cell(0, 2,$subtitulo,0,1,'C');
		 /*trazamos una linea roja debajo del encabezado */
   
		global $grupo;
		$this->SetFont('helvetica', 'B', 8);
		$this->Cell(0, 2,"SOLICITUDES ".$grupo,0,1,'C');
		$this->SetFont('helvetica', 'I', 7);
		global $fecha_i;
		global $fecha_f;
		$this->Cell(0, 2,"PERIODO DEL ".$fecha_i." AL ".$fecha_f,0,0,'R');
		
		
		
		$this->Line(15,24,195,23); 
      

		
    }

}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
/*TERMINA LA MODIFICACION DEL ENCABEZADO**/


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
$pdf->SetFont('helvetica', '', 8);

// add a page
$pdf->AddPage();
?>

<table width="100%" border="1" cellpadding="2">
<tr>
<td align="left" width="38%" bgcolor="#DFDFDF">Cliente</td>
<td align="center" width="5%" bgcolor="#DFDFDF">Tipo</td>
<td align="center" width="13%" bgcolor="#DFDFDF">Folio</td>
<td align="center" width="13%" bgcolor="#DFDFDF">Fecha</td>
<td align="right" width="15%" bgcolor="#DFDFDF">Importe</td>
<td align="center" width="16%" bgcolor="#DFDFDF">Estatus</td>
</tr>
<?php

$compara=get_sol_grupo_pdf($idgrupo,$fecha_i,$fecha_f);
if($compara!=0)
$total=get_solicitud_grupo_pdf($idgrupo,$fecha_i,$fecha_f);
?>
</table>
<table width="100%" border="0" cellpadding="1">
<tr>
<td align="left" width="38%" ></td>
<td align="left" width="5%" ></td>
<td align="center" width="13%"></td>
<td align="right" width="13%">Total</td>
<td align="right" width="15%" ><?php echo number_format($total,2); ?></td>
<td align="center" width="16%"></td>
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
$pdf->Output('Sol_xGrupo.pdf', 'D');

?>

