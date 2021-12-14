<? 
ob_start(); 
require_once('../config/lang/eng.php');
require_once('../tcpdf.php');
$id_tonga=$_GET["id_tonga"];
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Software development');
$pdf->SetTitle('Nota de entrada');
$pdf->SetSubject('otro');
$pdf->SetKeywords('otro');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "EXPORTADORA DE GRANOS Y OLEAGINOSAS DEL SURESTE S.A. DE C.V.", "EGO-910528-HX9 \n CARRETERA A NVA. ALEMANIA, KM. 2.5, COL. BUROCRÁTICA, TAPACHULA, CHIAPAS.");

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


include("../../../../conexion.php");
$con=conectarse();
?>
REPORTE GENERAL DE NOTAS DE ENTRADA SEGUN NUMERO DE TONGA</p>
        <table width="692" border="1">
    <tr>
      <th width="48" height="44">Folio</th>
		<th width="204">Cliente</th>
	    <th width="71">Tipo de caf&eacute;</th>
        <th width="84">Fecha de Nota</th>
	    <th width="73">Kgs Netos</th>
		<th width="42">Tga</th>
		<th width="46">P. kg</th>
		<th width="72">Total</th>
	  </tr>  
        
    
        <?
	 
					$consulta_n="SET datestyle TO postgres, dmy; SELECT * FROM nota_entrada where id_tonga='$id_tonga'  ORDER BY folio_nota";
                     $res = pg_query($con,$consulta_n);
                    
	$total_gral=0;				
	 
	 while($fila=pg_fetch_array($res)) 
{ 
	
	$folio_nota=$fila["folio_nota"];			
						
	$id_cafe=$fila["id_cafe"];
	
	$idcliente=$fila["idcliente"];	
	$fecha_nota=$fila["fecha_nota"];		
	$total_kgs_brutos=$fila["kgs_netos"];
	$id_tonga=$fila["id_tonga"];
	$precio_cafe=$fila["precio_cafe"];			
	$total=$fila["total"];			
	$total_gral=$total_gral+$fila["total"];							   
					
						$consulta_c="SELECT * FROM tipo_cafe where id_cafe='$id_cafe' ORDER BY id_cafe";
                     $id_query_c= pg_query($con,$consulta_c);
                     while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						
                         $nom_cafe=$fila_c["nom_cafe"];        
                        }
						
						$consulta_ci="SELECT * FROM cc_clientes where idcliente='$idcliente' ";
                     $id_query_ci= pg_query($con,$consulta_ci);
                     while( $fila_ci= pg_fetch_array($id_query_ci) )
                        {  
						
                         $p=$fila_ci["ap_paterno"];        
						 $m=$fila_ci["ap_materno"];        
						 $nom=$fila_ci["nombre"];   
						 $nom="$nom $p $m";     
                        }
						
						$consulta_t="SELECT * FROM tonga where id_tonga='$id_tonga' ";
                     $id_query_t= pg_query($con,$consulta_t);
                     while( $fila_t= pg_fetch_array($id_query_t) )
                        {  
						
                         $nom_tonga=$fila_t["nom_tonga"];        
                        }
						
						
						
						
						
						?>
       <tr>
        <td align="center" style="font:small">
         
          
          <? 
		 
		 echo $folio_nota;
		  
		  ?>
   	    </td>


		   <td align="center">
          

          <? 
		 
echo $nom;
		  

		  
		  ?>



       	  </td>

        <td align="center">
        <? echo $nom_cafe; ?>						      
		</td>
        <td align="center">
        <? echo $fecha_nota; ?>						      </td>
						       
		<td align="center">
        <? echo $total_kgs_brutos; ?>						      </td>
						       
	
	<td align="center">
        <? echo $nom_tonga; ?>						      
		</td>
		<td>
        <? echo $precio_cafe; ?>						      
		</td>
						       
	<td align="right">
        <? echo number_format($total,2); ?>						      
		</td>
		
						
	  </tr>
    <?
	
					    }
?>							
</table>
	<br /></p>
	<p><b>Monto total de notas de entrada <? echo number_format($total_gral,2); ?>        </b></p>
  <?
$html=ob_get_contents(); 
ob_end_clean(); 

$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Nota_Tonga.pdf', 'D');
?>




