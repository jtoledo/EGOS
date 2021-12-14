<?php 
$taras=get_taras($_SESSION['mov_sucursal']);

$idcliente=(isset($idcliente)?$idcliente:$_GET["idcliente"]);

 ?>
<form name="captura" action="" onSubmit="guarda_servicio(2); return false" class="formu">  
<table width="100%" border="0" align="center">
  <tr>
    <td colspan="5"><li class="iheader">
      <div id="carga"></div>
      <h2 class="art-logo-text">
        SERVICIOS</h2>
      </li></td>
  </tr>
  <tr>
    <td width="2%" rowspan="3">&nbsp;</td>
    <td width="2%" rowspan="2"><div align="right"></div></td>
    <td width="2%" rowspan="2"><div align="right"></div></td>
    <td width="80%"><div align="right">Servicios del cliente</div></td>
    <td width="14%"><div align="right">Folio</div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">
      <?php get_servicios_cliente_select($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']); ?>
    </div></td>
    <td><div align="right">
      <input name="folio_servicio" type="text" class="folio" id="folio_servicio" onchange="conMayusculas(this)" value="<?php echo $folio_servicio;  ?>" size="20" maxlength="255" readonly="readonly" />
    </div></td>
  </tr>
 
 </table>
 <fieldset>
 <legend>RECEPCI&Oacute;N DE CAF&Eacute; A PROCESO DE SECADO</legend>
 <table width="100%" border="0" >
  <tr>
    <td colspan="3"><div align="center">Nombre Productor(<a onclick="window.location.href='http://<?php echo $_SERVER['HTTP_HOST'];?>/EGOS/servicios/modif_servicios.php?modif=2'" >Activar busqueda</a>)</div></td>
    <td><div align="center">Fecha</div></td>
    <td><div align="center">Tipo de café</div></td>
    <td><div align="center">Secadora</div></td>
    </tr>
  <tr>
    <td colspan="3"><div align="center"><span class="clientes_sol">   
      
    	<?php
    		get_clientes_servicios_m($idcliente);
    
    	?>
     
    </span></div></td>
    <td><div align="center">
      <input name="fecha_servicio" type="text" id="fecha_servicio" onkeyup="format_fecha(this);" maxlength="10" value="<?php echo $fecha_servicio; ?>" class="itext" />
		<!-- onclick="popUpCalendar(this, captura.fecha_servicio, 'dd-mm-yyyy');" readonly="readonly" -->     
    </div></td>
    <td><div align="center">
      <?php
    get_tipo_servicios($id_catalogo);
    ?>
    </div></td>
    <td><div align="center">
     <?php
    get_secadora($id_secadora);
    ?>
    
    
    
    </div></td>
  </tr>
    </table>
  </fieldset>
  <fieldset>
  <legend>PESADAS</legend>  
  <table width="100%" border="0" style="border-collapse:collapse" id="tservicios">
    
  <tr>
    <td><div align="center">Bolsa</div></td>
    <td><div align="center">Kgs Brutos</div></td>
    <td><div align="center">Tara</div></td>
    <td><div align="center">Kgs Netos</div></td>
    <td><div align="center">Equivalente en cajas</div></td>
    <td align="center"><input type="button" onclick="add_fila_se()" value="Inserta pesada" /></td>
  </tr>
  <?php
  	
  		//mete las taras
		while($tar=pg_fetch_array($taras)) { 
			echo "<input type='hidden' name='tara_".$tar['nom_tara']."' id='tara_".$tar['nom_tara']."' value='".$tar["peso"]."'>";
	}  
  ?>
  <tr>
  <td>
<div align="center">
<input type="text" name="bolsa[]" size="15" maxlength="50"  id="bolsa" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque" onchange="calcula_kgs_netos_se()" onkeyup="calcula_kgs_netos_se()">
 </div>
 </td>
<td>
<div align="center">
<input type="text" name="kgs_brutos[]" size="15" maxlength="50" value=""  id="kgs_brutos" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque"  onchange="calcula_kgs_netos_se()" onkeyup="calcula_kgs_netos_se()">
</div>
</td>
<td><div align="center">
      <input name="tara[]" type="text"   id="tara" onkeypress="return acceptNum(event)" size="15" maxlength="50"  class="peque"  autocomplete="off" value="0" onchange="calcula_kgs_netos_se_tara()" onkeyup="calcula_kgs_netos_se_tara()">
    </div></td>
 <td>
<div align="center">
<input type="text" name="kgs_netos[]" size="15" maxlength="50" value="0"  id="kgs_netos" onKeyPress="return acceptNum(event)" autocomplete="off" class="peque"  readonly="readonly" >
</div>
</td>
<td><div align="center">
      <input name="cajas[]" type="text"   id="cajas" onkeypress="return acceptNum(event)" size="15" maxlength="50" readonly="readonly" autocomplete="off"  class="peque" value="0">
    </div></td>          

<td align="center">
      <input type="button" onclick="remove_tse(this)" value='Eliminar'>
</td>  
    
  </tr>
  </table>
</fieldset>
<fieldset>
<legend></legend>   
<table width="100%" border="0" style="border-collapse:collapse">  
  <tr>
    <td>Observaciones</td>
    <td><div align="center">
      <textarea class="itextarea" name="observaciones" id="observaciones" onchange="conMayusculas(this)"></textarea>
    </div></td>
    <td>&nbsp;</td>
    <td><div align="center">Hora de recepción</div></td>
    <td><div align="center">
      <input name="hora_r" type="text" class="peque"  onkeyup="format_hora(this);" maxlength="5" id="hora_r" onchange="conMayusculas(this)"  size="20" maxlength="255" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Hora de inicio de secado</td>
    <td><div align="center">
      <input name="hora_s" type="text" class="peque" id="hora_s" onkeyup="format_hora(this);" maxlength="5" onchange="conMayusculas(this)"  size="20" maxlength="255" />
    </div></td>
    <td>&nbsp;</td>
    <td><div align="center">Hora final de secado</div></td>
    <td><div align="center">
      <input name="horafs" type="text" class="peque" id="horafs" onkeyup="format_hora(this);" maxlength="5" onchange="conMayusculas(this)"  size="20" maxlength="255" />
    </div></td>
    <td>&nbsp;</td>
  </tr>
  </table>  
  </fieldset>

<fieldset>
<legend>CALIFICACI&Oacute;N DE CAF&Eacute; EN UVA / PERGAMINO-HUMEDO</legend>
<table border="0" width="100%">
  <tr>
    <td align="center">Maduro</td>
    <td align="center">S/maduro</td>
    <td align="center">Bayo</td>
    <td align="center">Verde</td>
    <td align="center">Quemado</td>
    <td align="center">Tierno</td>
    <td align="center">S/mata</td>
    <td align="center">% Total</td>
  </tr>
  <tr>
    <td align="center"><input type="text" onkeyup="por_secado(document.captura,this)" name="maduro" size="15" maxlength="50" value=""  id="maduro" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"  /></td>
    <td><div align="center">
      <input type="text" name="smaduro" onkeyup="por_secado(document.captura,this)" size="15" maxlength="50" value=""  id="smaduro" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"   />
    </div></td>
    <td align="center"><input type="text" name="bayo" onkeyup="por_secado(document.captura,this)" size="15" maxlength="50" value=""  id="bayo" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"   /></td>
    <td align="center"><input type="text" name="verde" onkeyup="por_secado(document.captura,this)" size="15" maxlength="50" value=""  id="verde" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"  /></td>
    <td align="center"><input type="text" name="quemado" onkeyup="por_secado(document.captura,this)" size="15" maxlength="50" value=""  id="quemado" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"   /></td>
    <td align="center"><input type="text" name="tierno" onkeyup="por_secado(document.captura,this)" size="15" maxlength="50" value=""  id="tierno" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"  /></td>
    <td align="center"><input type="text" name="smata" onkeyup="por_secado(document.captura,this)" size="15" maxlength="50" value=""  id="smata" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"  /></td>
	 <td align="center"><input type="text" name="totalp" size="15" maxlength="50" value=""  id="totalp" readonly="true" class="peque"  /></td>  
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td height="42" align="center">Costo del servicio por kilo de salida</td>
    <td><div align="center">
      <input name="costo_kgsalida" type="text"   id="costo_kgsalida" onkeypress="return acceptNum(event)" size="15" maxlength="50"  autocomplete="off"  class="itext" value="1" />
    </div></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
	 <!--
	 <td align="center"><div align="right">
      <input class="ibutton" type="button" name="nuevo2" id="nuevo" value="LIMPIAR CAPTURA"  onclick="window.location.href='http://<?php echo $_SERVER['HTTP_HOST'];?>/EGOS/servicios/modif_servicios.php?modif=2'" />
		!--update_nuevo_servicio(3); return false--    
    </div></td>-->  
    <td colspan="2" align="center"><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
    </div></td>
    </tr>
</table>
</fieldset>
</form>
