<?php 
$taras=get_taras($_SESSION['mov_sucursal']);

if($modif!=1)
{
$fila=get_nota_arreglo_gral_merma($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
$id_compra=$fila["id_compra"];
$id_almacen=$fila["id_almacen"];
$id_periodo=$fila["id_periodo"];
$idcliente=$fila["id_proveedor"];
$idproductor=$fila["id_productor"];
$id_catalogo=$fila["id_catalogo"];
$produccion=$fila["produccion"];
$fecha_nota=$fila["fecha_nota"];
$vehiculo=$fila["vehiculo"];
$folio=$fila["folio"];
$resto_alimentos=$fila["resto_alimentos"];
$desechos_human=$fila["desechos_human"];
$olores_desa=$fila["olores_desa"];
$otros_organicos=$fila["otros_organicos"];
$manchas_comb=$fila["manchas_comb"];
$vehiculo_sucio=$fila["vehiculo_sucio"];
$olor_detergente=$fila["olor_detergente"];
$otros_inorganicos=$fila["otros_inorganicos"];
$precio_kilo=$fila["precio_kilo"];
$rendimiento=$fila["rendimiento"];
$mancha=$fila["mancha"];
$humedad=$fila["humedad"];
$cerezo=$fila["cerezo"];
$criba=$fila["criba"];
$resultado_analisis=$fila["resultado_analisis"];
$constancia_cmc=$fila["constancia_cmc"];
$forma_pago=$fila["forma_pago"];
$no_cheque=$fila["no_cheque"];
$banco_cheque=$fila["banco_cheque"];
$costalera=$fila["costalera"];
$estado_costalera=$fila["estado_costalera"];
$observaciones=$fila["observaciones"];
$total_kgs_brutos=$fila["total_kgs_brutos"];
$total_kgs_netos=$fila["total_kgs_netos"];
$total_tara=$fila["total_tara"];
$total_kgs_neto2=$fila["total_kgs_neto2"];
$subtotal=$fila["subtotal"];
$retencion_p=$fila["retencion_p"];
$retencion_peso=$fila["retencion_peso"];
$miembro_c=$fila["miembro_cmc"];

$id_servicio=$fila["id_servicio"];

$deshabilita=(get_ntcompra_used($id_compra)>0 and $precio_kilo>0?"disabled title='No se modifica porque ya tiene movimientos aplicados'":"2");
$nserie=$fila["serie"];

}
$fila_cliente=get_cliente($idcliente);
$num_productor=$fila_cliente["num_productor"];

?>
<style type="text/css">
strong {
	font-weight: bold;
}
strong {
	font-weight: bold;
}
</style>

<form name="captura" action="" onSubmit="guarda_nota(1); return false" class="formu">  
    <input type="hidden" name="id_compra" value="<?php echo $id_compra; ?>" />
 	 <input type="hidden" id="kgentrega" name="kgentrega" value="<?php echo get_kg_ent($idcliente,$id_catalogo); ?>"/>   
<table width="100%" border="0">
  <tr>
    <td colspan="8"><li class="iheader">
		  <div id="carga"></div>
		<table border="0" width="100%"><tr><td width="70%">		
		<h2 class="art-logo-text">
	MERMAS DE NOTA DE ENTRADA</h2>
	</td><td width="30%">
		<?php
			echo get_ultimos_folios($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
			echo get_kgsa_entregar($idcliente,$id_catalogo);
		?>			
		
	</td>
	</tr></table>
	</li>

			
	</td>
  </tr>
  
  <tr>
    <td>Proveedor</td>
    <td colspan="2">
    <span class="clientes_sol">
    <?php
    get_clientes_nota_m($idcliente);
    ?>
     </span>
    </td>
    <td colspan="2">&nbsp;</td>
    <td><div align="center">Serie</div></td>
    <td colspan="2">
    <div align="center">
    <?php
      serie_notas((trim($nserie)!=''?$nserie:' '),1);

    ?> </div>
    
    </td>
    
  </tr>
  <tr>
    <td>Productor</td>
    <td colspan="2">
    <?php
    get_productor_nota($idproductor);
    ?>
    
    </td>
    <td colspan="2">&nbsp;</td>
    <td><div align="center">Notas de entrada</div></td>
    <td colspan="2"><div align="center">
      <?php
    get_notas_entrada($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
    ?>
    </div></td>
  </tr>
  <tr>
    <td>Producto</td>
    <td colspan="4">
      <?php
    get_producto_nota_m($id_catalogo);
    ?>
      
      
      
   </td>
    <td><div align="center">Folio</div></td>
    <td colspan="2"><div align="center">
      <input name="folio" type="text" class="folio" id="folio" onchange="conMayusculas(this)" value="<?php echo $folio;  ?>" size="20" maxlength="255" readonly="readonly" />
    </div></td>
  </tr>
  <tr>
    <td>Producci??n</td>
    <td>
		 <select name="produccion" class="iselect">
      <option value="">Seleccione</option>
      <?php 
	  if($produccion=="trad")
	  { 
	  echo "<option value='trad' selected='selected'>TRADICIONAL</option>";
	  echo "<option value='org' >ORGANICA</option>";
	  echo "<option value='4c' >4C</option>";
	  }
	   if($produccion=="org")
	  { 
	  echo "<option value='org' selected='selected'>ORGANICA</option>";
	  echo "<option value='trad' >TRADICIONAL</option>";
	  echo "<option value='4c' >4C</option>";
	  }
	  if($produccion=="4c")
	  {
      echo "<option value='4c' selected='selected' >4C</option>";	   
	  echo "<option value='org'>ORGANICA</option>";
	  echo "<option value='trad' >TRADICIONAL</option>";
	  }
	  ?>
      
     
    </select>
	
	</td>
    <td></td>
    <td colspan="2">
    
    
   
    </td>
    <td><div align="center">Fecha</div></td>
    <td colspan="2"><div align="center">
      <input name="fecha_nota" type="text" id="fecha_nota" onclick="popUpCalendar(this, captura.fecha_nota, 'dd-mm-yyyy');"  value="<?php echo $fecha_nota; ?>" readonly="readonly" class="itext" />
    </div></td>
  </tr>
  <tr>
    <td>Veh??culo</td>
    <td colspan="7"><input name="vehiculo" type="text" id="vehiculo"  class="largo" onChange="conMayusculas(this)" value="<?php echo $vehiculo; ?>"></td>
    </tr>
  <tr>
    <td colspan="8"><div align="center">CONDICIONES DE INACEPTABILIDAD Y DETECCI??N DE CONTAMINANTES</div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">ELEMENTOS ORG??NICOS</td>
    <td><div align="center"></div></td>
    <td>&nbsp;</td>
    <td>ELEMENTOS INORG??NICOS</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Restos de alimentos</td>
    <td><div align="center">
    
    <?php 
	if($resto_alimentos=="t")
echo "<input name='resto_alimentos' type='checkbox' id='resto_alimentos' value='1' checked='checked'>";
	else
echo "<input name='resto_alimentos' type='checkbox' id='resto_alimentos' value='1' >";
	?>
      
      
    </div></td>
    <td>&nbsp;</td>
    <td>Manchas de combustibles</td>
    <td>
    
        <?php 
	if($manchas_comb=="t")
echo "<input name='manchas_comb' type='checkbox' id='manchas_comb' value='1' checked='checked'>";
	else
echo "<input name='manchas_comb' type='checkbox' id='manchas_comb' value='1' >";
	?>

    
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Desechos humanos o animales</td>
    <td><div align="center">
      
        <?php 
	if($desechos_human=="t")
echo "<input name='desechos_human' type='checkbox' id='desechos_human' value='1' checked='checked'>";
	else
echo "<input name='desechos_human' type='checkbox' id='desechos_human' value='1' >";
	?>
      
      </div></td>
    <td>&nbsp;</td>
    <td>Veh??culo sucio con qu??mico</td>
    <td>
    
     <?php 
	if($vehiculo_sucio=="t")
echo "<input name='vehiculo_sucio' type='checkbox' id='vehiculo_sucio' value='1' checked='checked'>";
	else
echo "<input name='vehiculo_sucio' type='checkbox' id='vehiculo_sucio' value='1' >";
	?>
    
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Olores desagradables</td>
    <td><div align="center">
     <?php 
	if($olores_desa=="t")
echo "<input name='olores_desa' type='checkbox' id='olores_desa' value='1' checked='checked'>";
	else
echo "<input name='olores_desa' type='checkbox' id='olores_desa' value='1' >";
	?>
    </div></td>
    <td>&nbsp;</td>
    <td>Olor a detergentes o jabones</td>
    <td>
     <?php 
	if($olor_detergente=="t")
echo "<input name='olor_detergente' type='checkbox' id='olor_detergente' value='1' checked='checked'>";
	else
echo "<input name='olor_detergente' type='checkbox' id='olor_detergente' value='1' >";
	?>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Otros</td>
    <td><div align="center">
        <?php 
	if($otros_organicos=="t")
echo "<input name='otros_organicos' type='checkbox' id='otros_organicos' value='1' checked='checked'>";
	else
echo "<input name='otros_organicos' type='checkbox' id='otros_organicos' value='1' >";
	?>
    </div></td>
    <td>&nbsp;</td>
    <td>Otros</td>
    <td>
       <?php 
	if($otros_inorganicos=="t")
echo "<input name='otros_inorganicos' type='checkbox' id='otros_inorganicos' value='1' checked='checked'>";
	else
echo "<input name='otros_inorganicos' type='checkbox' id='otros_inorganicos' value='1' >";
	?>
    
    </td>
    <td>&nbsp;</td>
  </tr>
 
</table>
<table border="0" width="100%">
  <tr>
    <td><div class="servicio"><?php get_secado($id_servicio,$idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']); ?></div></td>
	 <td>		
		<?php echo get_detalle_entregar($idcliente,$id_catalogo);?>    
    </td>
    <td align="center">PROCEDIMIENTO EN B&Aacute;SCULA</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="1" style="border-collapse:collapse">
  <tr>
    <td width="80%">
      <div align="center"><strong>COSTALERAS</strong></div></td>
    <td align="center"><input type="button" onclick="displayResult()" value="Inserta pesada" /></td>
  </tr>
</table>
<table width="100%" border="1" style="border-collapse:collapse" id="myTable">
    
  <tr>
    <td><div align="center">Henequ??n</div></td>
    <td><div align="center">Yute</div></td>
    <td><div align="center">Bolsa</div></td>
    <td><div align="center">Kilogramos Brutos</div></td>
    <td><div align="center">No. Tonga</div></td>
    <td><div align="center">Del</div></td>
  </tr>
 
 <?php 
 get_pesadas_compra_merma($id_compra); 
 
//mete las taras
while($tar=pg_fetch_array($taras)) { 
	echo "<input type='hidden' name='tara_".$tar['nom_tara']."' id='tara_".$tar['nom_tara']."' value='".$tar["peso"]."'>";
}
 ?>
  
  </table>
   <table border="0" width="40%">
 
  <tr>
  	<td width="40%"><div align="right">T. KGS BRUTOS</div></td>
    <td width="30%"><div align="left">
      <input name="total_kgs_brutos" type="text" class="totales_nota"  id="total_kgs_brutos" onkeypress="return acceptNum(event)" size="15" maxlength="50" readonly="readonly" autocomplete="off" value="<?php echo number_format($total_kgs_brutos,2); ?>">
    </div></td>
    <!--<td valign="bottom"><div>MIEMBRO CMC</div></td>-->
    </tr>
  <tr>
  	<td><div align="right">TARA</div></td>
    <td><div align="left">
      <input name="total_tara" type="text" class="totales_nota"  id="total_tara" onkeypress="return acceptNum(event)" size="15" maxlength="50" readonly="readonly" autocomplete="off" value="<?php echo  number_format($total_tara,2); ?>">
    </div></td>
	<!--    
    <td><input name="miembro_cmc" type="checkbox" <?php if($miembro_c==1) echo 'checked';?> id="miembro_cmc" onchange="fmiembro_cmc();"></td>
-->    
    </tr>
  <tr>
  	<td height="30"><div align="right">KGS. NETOS</div></td>
    <td><div align="left">
      <input name="total_kgs_netos" type="text" class="totales_nota"  id="total_kgs_netos" onkeypress="return acceptNum(event)" size="15" maxlength="50" readonly="readonly" autocomplete="off" value="<?php echo number_format($total_kgs_netos,2); ?>">
    </div></td>
    <td valign="bottom"><div>RET. CMC</div></td>
    </tr>
  <tr>
  	<td><div align="right">PRECIO X KILO</div></td>
    <td><div align="left">
      <input type="text" name="precio_kilo" size="15" maxlength="50"  id="precio_kilo" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($precio_kilo,2); ?>" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
    </div></td>
    <td>			
		<input type="hidden" name="ret_porc" id="ret_porc" value="<?php echo $retencion_p;?>">		
		<div>
				
		<input type="text" name="retencion_peso" size="15" maxlength="50"  id="retencion_peso" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($retencion_peso,2); ?>" onchange="calculo_retencion(true);" onkeyup="calculo_retencion(true);">		
		<input name="retencion_si" type="checkbox" id="retencion_si" <?php if($retencion_peso>0) echo 'checked'; ?> onchange="calculo_retencion(this.checked);">
				
		</div>	
	</td>
    </tr>
  <tr>
	 <td><div align="right">TOTAL</div></td>
    <td><div align="left">
      <input name="subtotal" type="text" class="totales_nota"  id="subtotal" onkeypress="return acceptNum(event)" size="15" maxlength="50" readonly="readonly" autocomplete="off" value="<?php echo number_format($subtotal,2); ?>">
    </div></td>
    </tr>

</table>
<table width="100%" border="0" >
  <tr>
    <td>RESULTADOS DE AN??LISIS F??SICOS</td>
    <td align="right">RESULTADOS DE AN??LISIS SENSORIAL</td>
  </tr>
</table>

<table width="100%" border="1" style="border-collapse:collapse">
  <tr>
    <td><div align="center">Rendimientos</div></td>
    <td colspan="3"><div align="center">Mancha %</div></td>
    <td><div align="center">Humedad %</div></td>
    <td><div align="center">Cerezo %</div></td>
    <td><div align="center">Criba %</div></td>
   <td rowspan="2"><div align="center">Aceptado</div></td>
        <td rowspan="2"><div align="center">
           <?php 

	if($resultado_analisis=="t")
	{
		echo "<input name='resultado_analisis' type='radio' id='resultado_analisis' value='1' checked='checked'>";
	} else {
		echo "<input name='resultado_analisis' type='radio' id='resultado_analisis' value='1'>";
	}
	?>
        </div></td>
        <td rowspan="2"><div align="center">Rechazado</div></td>
      <td rowspan="2"><div align="center">
        <?php 
	if($resultado_analisis=="f")
	{
		echo "<input name='resultado_analisis' type='radio' id='resultado_analisis' value='0' checked='checked'>";
	} else {
		echo "<input name='resultado_analisis' type='radio' id='resultado_analisis' value='0'>";
	}
	?>
      </div></td>
    </tr>
  <tr>
    <td><div align="center">
      <input type="text" name="rendimiento" size="15" maxlength="50" id="rendimiento" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" value=" <?php echo number_format($rendimiento,2); ?>">
    </div></td>
    <td colspan="3"><div align="center">
      <input type="text" name="mancha" size="15" maxlength="50"   id="mancha" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" value=" <?php echo number_format($mancha,2); ?>">
    </div></td>
    <td><div align="center">
      <input type="text" name="humedad" size="15" maxlength="50"  id="humedad" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" value=" <?php echo number_format($humedad,2); ?>">
    </div></td>
    <td><div align="center">
      <input type="text" name="cerezo" size="15" maxlength="50"   id="cerezo" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" value=" <?php echo number_format($cerezo,2); ?>">
    </div></td>
    <td><div align="center">
      <input type="text" name="criba" size="15" maxlength="50"   id="criba" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" value=" <?php echo number_format($criba,2); ?>">
    </div></td>
    </tr>
  <tr>
    <td><div align="center">CONSTANCIA CMC</div></td>
    <td><div align="center">
       <?php 
	if($constancia_cmc=="t")
echo "<input name='constancia_cmc' type='checkbox' id='constancia_cmc' value='1' checked='checked'>";
	else
echo "<input name='constancia_cmc' type='checkbox' id='constancia_cmc' value='1' >";
	?>
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center">NUM. DE PRODUCTOR</div></td>
    <td><div align="center">
      <input type="text" name="no_productor" size="15" maxlength="50"  id="no_productor"  autocomplete="off" class="peque" value="<?php echo $num_productor; ?>">
    </div></td>
    <td><div align="center">KGS. NETOS</div></td>
    <td><div align="center">
      <input type="text" name="total_kgs_neto2" size="15" maxlength="50"   id="total_kgs_neto2" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo number_format($total_kgs_neto2,2); ?>">
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 </table>
 <table border="0" width="100%">
   <tr>
     <td colspan="2"><div align="center">FORMA DE PAGO</div></td>
     <td><select name="forma_pago" class="iselect">
       <option value="">Seleccione forma de pago</option>
       <?php 
	  if($forma_pago==1)
	  { 
	  echo "<option value='1' selected='selected'>CHEQUE</option>";
	  echo "<option value='2' >EFECTIVO</option>";
	  echo "<option value='3' >PENDIENTE</option>";
	  }
	   if($forma_pago==2)
	  { 
	  echo "<option value='2' selected='selected'>EFECTIVO</option>";
	  echo "<option value='1' >CHEQUE</option>";
	  echo "<option value='3' >PENDIENTE</option>";
	  }
	  if($forma_pago==3)
	  { 
	  echo "<option value='3' selected='selected'>PENDIENTE</option>";
	  echo "<option value='1' >CHEQUE</option>";
	  echo "<option value='2' >EFECTIVO</option>";
	  }
	  ?>
     </select></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td></td>
     <td><div align="center">No.</div></td>
     <td><div align="center">
       <input type="text" name="no_cheque" size="15" maxlength="50"  id="no_cheque" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" / value="<?php echo nom($no_cheque); ?>">
     </div></td>
     <td><div align="center">Banco</div></td>
     <td><div align="center">
       <input type="text" name="banco_cheque" size="15" maxlength="50"  id="banco_cheque"  autocomplete="off" class="itext" onChange="conMayusculas(this)"  value="<?php echo nom($banco_cheque); ?>">
     </div></td>
   </tr>
   <tr>
     <td>&nbsp;</td>
     <td>COSTALERA</td>
     <td colspan="2">&nbsp;</td>
     <td rowspan="4">&nbsp;</td>
     <td colspan="5"><div align="center">OBSERVACIONES</div></td>
    </tr>
   <tr>
     <td><div align="center">Buena</div></td>
     <td><div align="center">
        <?php 
	if($costalera==1)
echo "<input name='costalera' type='radio' id='costalera' value='1' checked='checked'>";
	else
echo "<input name='costalera' type='radio' id='costalera' value='1' >";
	?>
     </div></td>
     <td>Pendiente</td>
     <td>
     
      <?php 
	if($estado_costalera=="f")
echo "<input name='estado_costalera' type='radio' id='estado_costalera' value='0' checked='checked'>";
	else
echo "<input name='estado_costalera' type='radio' id='estado_costalera' value='0' >";
	?>
     
     </td>
     <td colspan="5" rowspan="3"><div align="center">
       <textarea class="itextarea" name="observaciones" id="observaciones" onChange="conMayusculas(this)">
       <?php echo nom($observaciones); ?>
       </textarea>
     </div></td>
   </tr>
   <tr>
     <td><div align="center">Regular</div></td>
     <td><div align="center">
      <?php 
	if($costalera==2)
echo "<input name='costalera' type='radio' id='costalera' value='2' checked='checked'>";
	else
echo "<input name='costalera' type='radio' id='costalera' value='2' >";
	?>
     </div></td>
     <td>Devuelta</td>
     <td>
     
     <?php 
	if($estado_costalera=="t")
echo "<input name='estado_costalera' type='radio' id='estado_costalera' value='1' checked='checked'>";
	else
echo "<input name='estado_costalera' type='radio' id='estado_costalera' value='1' >";
	?>
     
     </td>
    </tr>
   <tr>
     <td><div align="center">Mala</div></td>
     <td><div align="center">
            <?php 
	if($costalera==3)
echo "<input name='costalera' type='radio' id='costalera' value='3' checked='checked'>";
	else
echo "<input name='costalera' type='radio' id='costalera' value='3' >";
	?>

     </div></td>
     <td colspan="2">&nbsp;</td>
    </tr>
<tr>
</tr>	
	<tr><td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
     <td align="right"><div align="center">
       <input type='submit' name='enviar' id='enviar' value='MODIFICAR'/> 
     </div></td>
    </tr>
 </table>
</form>
