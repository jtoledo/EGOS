<?php
if($modif!=1)
	{
	  $fila= consul_productos_i();
//		echo $producto["idproducto"];
	$idproducto=$fila["idproducto"];
	$producto=$fila["producto"];
	$id_tipo=$fila["id_tipo"];//obtener que tipo de credito es
	$interes_mensual=$fila["interes_mensual"];//boolenano
	$plazo=$fila["plazo"];
	$idper=$fila["idper"]; //periodo
	$interes_normal=$fila["interes_normal"];
	$interes_moratorio=$fila["interes_moratorio"];
	$id_pago=$fila["id_pago"];
	
	
	$interes_normal_m=$interes_normal*12;
	$interes_moratorio_m=$interes_moratorio*12;
	//$tipo_credito=get_tipo_credito($id_tipo);
	if($interes_mensual=="t")
	$tasa_interes=1;
	else
	$tasa_interes=0;
	
	//$periodo=get_periodo($idper);
	}


?>
<form name="captura" action="" onSubmit="productos_alta_egos(1); return false" class="formu">  
<input type="hidden" name="idproducto" value="<? echo $idproducto; ?>" />
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
    <td colspan="10"><input type="text" name="producto" size="20"  id="producto" value="<? echo $producto; ?>" class="modif" onchange="conMayusculas(this)" /></td>
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
      
	  get_tipo_m($id_tipo);
	  
	  ?></td>
    <td colspan="3">
      <div align="center">
        <?php
      
	  get_periodo_m($idper);
	  
	  ?>
      </div></td>
    <td><input type="text" name="plazo" size="20"  id="plazo" value="<? echo $plazo; ?>" class="peque" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)" /></td>
    <td><div align="center">
      <?php
      
	  get_modalidad_m($id_pago);
	  
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
	<?php
	if($tasa_interes==1)
	$var="checked";
	?>
	
	<input type="radio" name="interes_mensual" value="1" <?php echo $var; ?>>
	
	
	</td>
    <td>
	<?php
	if($tasa_interes==0)
	$var_s="checked";
	?>
	
	<input type="radio" name="interes_mensual" value="0"  <?php echo $var_s; ?>></td>
    
	
	<td width="120" colspan="3">&nbsp;</td>
    <td width="58"><input type="text" name="interes_normal" size="20"  id="interes_normal" value="<? echo number_format($interes_normal,4); ?>" class="peque" onchange="llenar_campo_recursos(); return false" onkeypress="return acceptNum(event)" /></td>
    <td width="60"><input type="text" name="interes_moratorio" size="20"  id="interes_moratorio" value="<? echo number_format($interes_moratorio,4); ?>" class="peque" onchange="llenar_campo_recursos(); return false"onkeypress="return acceptNum(event)" /></td>
    <td width="59"><input type="text" name="interes_normal_a" size="20"  id="interes_normal_a" value="<? echo number_format($interes_normal_m,4); ?>" class="peque" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)"  readonly="readonly"></td>
    <td width="59"><input type="text" name="interes_moratorio_a" size="20"  id="interes_moratorio_a" value="<? echo number_format($interes_moratorio_m,4); ?>" class="peque" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)" readonly="readonly"></td>
    <td width="127">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9"><div align="right">
      <input class="ibutton" type="button" name="nuevo" id="enviare" value="AGREGAR"  onclick="nuevo_producto('2'); return false" />
    </div></td>
    <td><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
    </div></td>
  </tr>
</table>
</form>


 