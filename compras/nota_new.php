<?php
$taras=get_taras($_SESSION['mov_sucursal']);

if(isset($idcliente))
{

$fecha_nota=date("d-m-Y");
$fila_cliente=get_cliente($idcliente);
$num_productor=$fila_cliente["num_productor"];
$produccion=$fila_cliente["produccion"];

?>

	<form name="captura" action="" onSubmit="guarda_nota(2); return false" class="formu">  

<input type="hidden" id="kgentrega" name="kgentrega" value="<?php echo get_kg_ent($idcliente,0); ?>"/>

<table width="100%" border="0">
  <tr>
    <td colspan="8"><li class="iheader">
		  <div id="carga"></div>
	<table border="0" width="100%"><tr><td width="70%">	
		<h2 class="art-logo-text">
	NOTA DE ENTRADA</h2>
	</td><td width="30%">
		<?php
			echo get_ultimos_folios($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
			echo get_kgsa_entregar($idcliente,0);
		?>			
		
	</td>
	</tr></table>
	</li></td>
  </tr>
  
  <tr>
    <td>Proveedor</td>
    <td colspan="2">
    		<span class="clientes_sol">
    	 <?php
    	 		
    			get_clientes_nota_m($idcliente);
    		?></span>
    </td>
    <td colspan="2">&nbsp;</td>
    <td><div align="center">Serie</div></td>
    <td colspan="2"> <div align="center">
    <?php
      serie_notas(' ',0);

    ?> </div>
    </td>
  </tr>
  <tr>
    <td>Productor</td>
    <td colspan="2">
    		<?php

    			get_productor_nota($idcliente);
    		?>
    
    </td>
    <td colspan="2">&nbsp;</td>
    <td><div align="center">Nota de entrada</div></td>
    <td colspan="2"> <div align="center">
      <?php

    get_notas_entrada($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
    ?>
    </div></td>
  </tr>
  <tr>
    <td>Producto</td>
    <td colspan="4">
      <?php
    		get_producto_nota();
    	?>
    </td>
    <td><div align="center">Folio</div></td>
    <td colspan="2"><div align="center">
      <input name="folio" type="text" class="peque" id="folio" onkeypress="return acceptNum(event)" value="" size="20" maxlength="255" readonly="readonly" />
      <input type="checkbox" onclick="if(this.checked){ document.getElementById('folio').readOnly=false } else { document.getElementById('folio').readOnly=true; document.getElementById('folio').value='' }"> Editar
    </div></td>
  </tr>
  <tr>
    <td>Producci??n</td>
    <td>
    		<select name="produccion" class="iselect">
      		<option value="">Seleccione</option>
      		<option value="trad">TRADICIONAL</option>
      		<option value="org">ORGANICA</option>
				<?php     			
					if($produccion=='4C') {     				
     					echo "<option value='4c' selected>4C</option>";
     				}else {
     					echo "<option value='4c'>4C</option>";
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
      <input name="fecha_actual" type="hidden" id="fecha_actual" value="<?php echo $fecha_nota; ?>"  />
    </div></td>
  </tr>
  <tr>
    <td>Veh??culo</td>
    <td colspan="7"><input name="vehiculo" type="text" id="vehiculo"  class="largo" onChange="conMayusculas(this)"></td>
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
      <input name="resto_alimentos" type="checkbox" id="resto_alimentos" value="1" />
    </div></td>
    <td>&nbsp;</td>
    <td>Manchas de combustibles</td>
    <td><input name="manchas_comb" type="checkbox" id="manchas_comb" value="1" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Desechos humanos o animales</td>
    <td><div align="center">
      <em>
      <input name="desechos_human" type="checkbox" id="desechos_human" value="1" />
      </em> </div></td>
    <td>&nbsp;</td>
    <td>Veh??culo sucio con qu??mico</td>
    <td><input name="vehiculo_sucio" type="checkbox" id="vehiculo_sucio" value="1" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Olores desagradables</td>
    <td><div align="center">
      <input name="olores_desa" type="checkbox" id="olores_desa" value="1" />
    </div></td>
    <td>&nbsp;</td>
    <td>Olor a detergentes o jabones</td>
    <td><input name="olor_detergente" type="checkbox" id="olor_detergente" value="1" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">Otros</td>
    <td><div align="center">
      <input name="otros_organicos" type="checkbox" id="otros_organicos" value="1" />
    </div></td>
    <td>&nbsp;</td>
    <td>Otros</td>
    <td><input name="otros_inorganicos" type="checkbox" id="otros_inorganicos" value="1" /></td>
    <td>&nbsp;</td>
  </tr>
  </table>
<table border="0" width="100%">
  <tr>
    <td>
    <div class="servicio"><?php get_secado($id_servicio,$idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']); ?></div></td>
	 <td>		
		<?php echo get_detalle_entregar($idcliente,0);?>    
    
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
  <tr>
    <td><div align="center">
      <input type="text" name="hene[]" size="15" maxlength="50"  id="hene" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" onchange="calcula_kgs_netos(this)" onkeyup="calcula_kgs_netos()">
    </div></td>
          <td><div align="center">
            <input type="text" name="yute[]" size="15" maxlength="50"  id="yute" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
          </div></td>
          <td><div align="center">
            <input type="text" name="bolsa[]" size="15" maxlength="50"  id="bolsa" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
          </div></td>
          <td><div align="center">
            <input type="text" name="kgs_brutos[]" size="15" maxlength="50" value=""  id="kgs_brutos" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque"  onchange="calcula_kgs_netos()" onkeyup="calcula_kgs_netos()">
          </div></td>
          <td><div align="center">
            <?php
				//mete las taras
			
				while($tar=pg_fetch_array($taras)) { 
					echo "<input type='hidden' name='tara_".$tar['nom_tara']."' id='tara_".$tar['nom_tara']."' value='".$tar["peso"]."'>";
				}            
            
    get_tonga_nota();
    ?>
          </div></td>
          <td align="center">
            <input type="button" onclick="deltonga(this)" value="Eliminar" />
</td>
  
  </tr>
  
  </table>
 
 
 
    <table border="0" width="40%">
 
  <tr>
  	<td width="40%"><div align="right">T. KGS BRUTOS</div></td>
    <td width="30%"><div align="left">
      <input name="total_kgs_brutos" type="text" class="totales_nota"  id="total_kgs_brutos" onkeypress="return acceptNum(event)" size="15" maxlength="50" readonly="readonly" autocomplete="off" value="<?php echo number_format($total_kgs_brutos,2); ?>">
    </div></td>
	<!--	<td valign="bottom"><div>MIEMBRO CMC</div></td>-->
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
          <input name="resultado_analisis" type="radio" id="resultado_analisis" value="1" />
        </div></td>
        <td rowspan="2"><div align="center">Rechazado</div></td>
      <td rowspan="2"><div align="center">
        <input name="resultado_analisis" type="radio" id="resultado_analisis" value="0" />
      </div></td>
    </tr>
  <tr>
    <td><div align="center">
      <input type="text" name="rendimiento" size="15"  onchange="obtener_precio();" maxlength="50" value="0"  id="rendimiento" onkeypress="return acceptNum(event);" autocomplete="off" class="peque" />
    </div></td>
    <td colspan="3"><div align="center">
      <input type="text" name="mancha" size="15" onchange="obtener_precio();" maxlength="50"  value="0"  id="mancha" onkeypress="return acceptNum(event);" autocomplete="off" class="peque" />
    </div></td>
    <td><div align="center">
      <input type="text" name="humedad" size="15" onchange="obtener_precio();" maxlength="50"  value="0"  id="humedad" onkeypress="return acceptNum(event);" autocomplete="off" class="peque" />
    </div></td>
    <td><div align="center">
      <input type="text" name="cerezo" size="15" maxlength="50" value="0"  id="cerezo" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" />
    </div></td>
    <td><div align="center">
      <input type="text" name="criba" size="15" maxlength="50" value="0"  id="criba" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" />
    </div></td>
    </tr>
  <tr>
    <td><div align="center">CONSTANCIA CMC</div></td>
    <td><div align="center">
      <input name="constancia_cmc" type="checkbox" id="constancia_cmc" value="1" />
    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center">NUM. DE PRODUCTOR</div></td>
    <td><div align="center">
      <input type="text" name="no_productor" size="15" maxlength="50"  id="no_productor"  autocomplete="off" class="peque" value="<?php echo $num_productor; ?>" />
    </div></td>
    <td><div align="center">KGS. NETOS</div></td>
    <td><div align="center">
      <input type="text" name="total_kgs_neto2" size="15" maxlength="50" value="0"  id="total_kgs_neto2" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" />
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
       <option value='1' >CHEQUE</option>
	   <option value='2' >EFECTIVO</option>
	   <option value='3' >PENDIENTE</option>
     </select></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td><div align="center">No.</div></td>
     <td><div align="center">
       <input type="text" name="no_cheque" size="15" maxlength="50"  id="no_cheque" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" />
     </div></td>
     <td><div align="center">Banco</div></td>
     <td><div align="center">
       <input type="text" name="banco_cheque" size="15" maxlength="50"  id="banco_cheque"  autocomplete="off" class="itext" onChange="conMayusculas(this)">
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
       <input name="costalera" type="radio" id="costalera" value="1" />
     </div></td>
     <td>Pendiente</td>
     <td><input name="estado_costalera" type="radio" id="estado_costalera" value="0" /></td>
     <td colspan="5" rowspan="3"><div align="center">
       <textarea class="itextarea" name="observaciones" id="observaciones" onChange="conMayusculas(this)"></textarea>
     </div></td>
   </tr>
   <tr>
     <td><div align="center">Regular</div></td>
     <td><div align="center">
       <input name="costalera" type="radio" id="costalera" value="2" />
     </div></td>
     <td>Devuelta</td>
     <td><input name="estado_costalera" type="radio" id="estado_costalera" value="1" /></td>
    </tr>
   <tr>
     <td><div align="center">Mala</div></td>
     <td><div align="center">
       <input name="costalera" type="radio" id="costalera" value="3" />
     </div></td>
     <td colspan="2">&nbsp;</td>
    </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td colspan="2">&nbsp;</td>
     <td>&nbsp;</td>
     <td colspan="5" align="right">
     <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" >
     
     </td>
   </tr>
 </table>
</form>


<?php
}
else
{
	include("inicia_nota.php");
}
?>