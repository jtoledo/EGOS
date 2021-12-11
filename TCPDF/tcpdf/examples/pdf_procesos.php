<?php 
ob_start(); 
require_once('../config/lang/eng.php');
require_once('../tcpdf.php');
include("../../../includes/constantes.php");
include("../../../includes/funciones.php");
include("../../../bd/conexion.php"); 


$con=conectarse();



// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPageOrientation("l");

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Software development');
$pdf->SetTitle('Procesos y requerimientos');
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
<br /><p>REPORTE GENERAL DE PROCESOS</p>
    <table  border="1" cellpadding="2">
      
         <tr>
       
          <td align="center" width="9%">
          <strong>
          Proceso  
		  </strong>
		  </td>
          <td align="center" width="11%">
          <strong>
          Requerimiento
          </strong>
		  </td>
          <td align="center"  width="9%">
          <strong>
          Medida  
		  </strong>
		  </td>
          <td align="center"  width="9%">
          <strong>
          Cantidad
		  </strong>
		  </td>
		  <td align="center"  width="7%">
          <strong>
          Ciclos  
		  </strong>
		  </td>
          <td align="left"  width="9%">
          <strong>
          Total Ciclos  
		  </strong>
		  </td>
          <td align="center"  width="6%">
          <strong>
          $/UN  
		  </strong>
		  </td>
          <td align="center"  width="9%">
          <strong>
          $ Total  
		  </strong>
		  </td>
          <td align="left"  width="9%">
          <strong>
          % Productor  
		  </strong>
		  </td>
          <td align="center"  width="9%">
          <strong>
          Cuota cr&eacute;dito  
		  </strong>
		  </td>
          <td align="left"  width="12%">
          <strong>
          Aporta productor
		  </strong>
		  </td>
		  
	  </tr>
      
    
    <?php
	 
$consulta_n="SET datestyle TO postgres, dmy; SELECT * FROM cc_ptprocesos,cc_ptrequerimientos,cc_unidades where cc_ptprocesos.idproceso=cc_ptrequerimientos.idproceso and cc_unidades.iduni=cc_ptrequerimientos.iduni  ORDER BY cc_ptprocesos.idproceso";
$res = pg_query($con,$consulta_n);
                    
	
$conta_p=1;	
$p=0;
//$id_procesos=array();	 
	 while($fila=pg_fetch_array($res)) 
{ 
	
$idrequerimiento=$fila["idrequerimiento"];
$idproceso=$fila["idproceso"];
$requerimiento=$fila["requerimiento"];
$iduni=$fila["iduni"];
$cantidad=$fila["cantidad"];
$ciclos=$fila["ciclos"];
$total_ciclos=$fila["total_ciclos"];
$un=$fila["un"];
$total=$fila["total"];
$porciento_produ=$fila["porciento_produ"];
$cuota_credi=$fila["cuota_credi"];
$proceso=$fila["proceso"];

$aporta_produ=$fila["aporta_produ"];

						
	if($conta_p>1)			
	$p=in_array($idproceso,$id_procesos);
						
	if($p!=1)					
	$color="#CCCCCC";				
						
						
						?>
      
	  
	  
	  <tr>
       
	    <td align="center" bgcolor="<?php echo $color; ?>">
          
          <strong>
          <div align="center">
            <? 
		if($p!=1)
		 echo $conta_p." . ".trim($proceso);
		// echo in_array($idproceso,$id_procesos);			
		  
		  ?>   	    
          </div>
		  
		  </strong>
		  </td>
		  
		  <td colspan="10"></td>
		  </tr>
		 
		  <tr>
		  <td></td>
		   <td align="left">
          
          
             <div align="center">
               <? 
		 
		 echo $requerimiento;
		  
		  ?>       	  
          </div></td>
           <td align="center" >
             <div align="center"><? echo get_unidad_p($iduni); ?>		
             </div></td>
       <td align="right">
         <div align="center"><? echo number_format($cantidad,2); ?>		</div></td>
						       
		<td align="right">
          <div align="center"><? echo number_format($ciclos,2); ?>		</div></td>
						       
	
	<td align="right">
        <div align="center"><? echo number_format($total_ciclos,2); ?>		</div></td>
		
						       
	<td align="right">
        <div align="center"><? echo number_format($un,2); ?>		</div></td>
		<td align="right">
          <div align="center"><? echo number_format($total,2); ?>		</div></td>
		<td align="right">
          <div align="center"><? echo number_format($porciento_produ,2); ?>		</div></td>
		
		<td align="right">
          <div align="center"><? echo number_format($cuota_credi,2); ?>		</div></td>
		<td align="right">
          <div align="center"><? echo number_format($aporta_produ,2);
		  
		  	
		  
		   ?>		</div></td>
	  </tr>
    <?php
	if($p!=1)
	$conta_p++;
	
	
	$id_procesos[]=$idproceso;
	$p=0;
	
$color="fff";
	
	
	
	}
?>	
   
       						
</table>

  <?
  
  

$html=ob_get_contents(); 
ob_end_clean(); 

$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Procesos.pdf', 'D');

?>

