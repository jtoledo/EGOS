<form name="captura" action="" onSubmit="productos_alta_egos(2); return false" class="formu">  
<table width="629" border="0">
  <tr>
    <td colspan="10"><li class="iheader"><h2 class="art-logo-text">PRODUCTOS FINANCIEROS</h2></li></td>
  </tr>
  <tr>
    <td colspan="10"><span class="hipote">
    <select name="idproductos" class="consultor2" onchange="actualiza_productos_selec(1); return false">
                 <option value="">Seleccione Producto Financiero</option>
      
      <?php
		  
		  
		  $consulta_c="SELECT * FROM cc_productos  order by producto ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
					
					  $desc= limitarPalabras($fila_c["producto"],15);
						
						?>	
      
      <option value="<?php echo $fila_c["idproducto"]?>"><?php echo nom(utf8_decode($desc)); ?></option>	
      
      <?php
						
						}
		  
		  
	  ?>      
    </select> 
</span></td>
  </tr>
  <tr>
    <td colspan="10">Descripci&oacute;n</td>
  </tr>
  <tr>
    <td colspan="10"><input type="text" name="producto" size="20"  id="producto" value="" class="modif" onchange="conMayusculas(this)" /></td>
  </tr>
  <tr>
    <td colspan="5">Tipo de cr&eacute;dito </td>
    <td colspan="3"><div align="center">Periodo de Pago</div></td>
    <td>Plazo<b> meses</b></td>
    <td><div align="center">Modalidad</div></td>
  </tr>
  <tr>
    <td colspan="5">
	<?php
      
	  get_tipo();
	  
	  ?></td>
    <td colspan="3">
      <div align="center">
        <?php
      
	  get_periodo_a();
	  
	  ?>
      </div></td>
    <td><input type="text" name="plazo" size="20"  id="plazo" value="" class="peque" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)" /></td>
    <td><div align="center">
      <?php
      
	  get_modalidad();
	  
	  ?>
    </div></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="120" colspan="2">Tasa de Inter&eacute;s </td>
    <td width="120" colspan="3" rowspan="2">&nbsp;</td>
    <td width="120" colspan="2"><div align="center">Mensual</div></td>
    <td width="120" colspan="2"><div align="center">Anual</div></td>
    <td width="127" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="59">Mensual</td>
    <td width="59">Anual</td>
    <td>Normal</td>
    <td>Moratorio</td>
    <td width="59"><div align="center">Normal</div></td>
    <td width="59"><div align="center">Moratorio</div></td>
  </tr>
  <tr>
    <td>
	
	
	<input type="radio" name="interes_mensual" value="1" checked="checked" >
	
	
	</td>
    <td>
	
	
	<input type="radio" name="interes_mensual" value="0"  ></td>
    
	
	<td width="120" colspan="3">&nbsp;</td>
    <td width="58"><input type="text" name="interes_normal" size="20"  id="interes_normal" class="peque"   onkeypress="return acceptNum(event)" onchange="llenar_campo_recursos(); return false" ></td>
    <td width="60"><input type="text" name="interes_moratorio" size="20"  id="interes_moratorio" class="peque"  onkeypress="return acceptNum(event)" onchange="llenar_campo_recursos(); return false"></td>
    <td width="59"><input type="text" name="interes_normal_a" size="20"  id="interes_normal_a" class="peque" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)"  readonly="readonly"></td>
    <td width="59"><input type="text" name="interes_moratorio_a" size="20"  id="interes_moratorio_a" class="peque" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)" readonly="readonly"></td>
    <td width="127">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9">&nbsp;</td>
    <td><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
    </div></td>
  </tr>
</table>
</form>


 