<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$con=conectarse();
	header('Content-type: application/vnd.ms-word');
	header("Content-Disposition: attachment; filename=Reporte_procesos.doc");
	header("Pragma: no-cache");
	header("Expires: 0");

?>
<p>REPORTE GENERAL DE PROCESOS</p>
    <table  border="1" cellpadding="2" width="100%">
      
         <tr>
       
          <td align="center" width="13%">
          <strong>
          Proceso  
		  </strong>
		  </td>
          <td align="center" width="15%">
          <strong>
          Requerimiento
          </strong>
		  </td>
          <td align="center"  width="7%">
          <strong>
          Medida  
		  </strong>
		  </td>
          <td align="center"  width="8%">
          <strong>
          Cantidad
		  </strong>
		  </td>
		  <td align="center"  width="7%">
          <strong>
          Ciclos  
		  </strong>
		  </td>
          <td align="left"  width="8%">
          <strong>
          Total Ciclos  
		  </strong>
		  </td>
          <td align="center"  width="8%">
          <strong>
          $/UN  
		  </strong>
		  </td>
          <td align="center"  width="9%">
          <strong>
          $ Total  
		  </strong>
		  </td>
          <td align="left"  width="8%">
          <strong>
          % Productor  
		  </strong>
		  </td>
          <td align="center"  width="10%">
          <strong>
          Cuota cr&eacute;dito  
		  </strong>
		  </td>
          <td align="left"  width="7%">
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

