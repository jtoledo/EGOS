
<?php 

$taras=get_taras($_SESSION['mov_sucursal']);

if($modif!=1)
{
$fila=get_se_servicios_gral($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
$id_servicio=$fila["id_servicio"];
$fecha_servicio=$fila["fecha_servicio"];
$id_secadora=$fila["id_secadora"];
$idcliente=$fila["idcliente"];
$folio_servicio=$fila["folio_servicio"];
$id_catalogo=$fila["id_catalogo"];
$observaciones=$fila["observaciones"];
$hora_r=$fila["hora_r"];
$hora_s=$fila["hora_s"];
$hora_fs=$fila["horafs"];
$maduro=$fila["maduro"];
$smaduro=$fila["smaduro"];
$bayo=$fila["bayo"];
$verde=$fila["verde"];
$quemado=$fila["quemado"];
$tierno=$fila["tierno"];
$smata=$fila["smata"];
$ptotal=$fila["maduro"]+$fila["smaduro"]+$fila["bayo"]+$fila["verde"]+$fila["quemado"]+$fila["tierno"]+$fila["smata"];
$costo_kgsalida=$fila["costo_kgsalida"];
}

?>
<form name="captura" action="" onSubmit="guarda_servicio(1); return false" class="formu">  
<input type="hidden" name="id_servicio" value="<?php echo $id_servicio; ?>" />

<table width="100%" border="0" align="center">
  <tr>
    <td colspan="5"><li class="iheader">
      <div id="carga"></div>
      <h2 class="art-logo-text">
       EDICI&Oacute;N DE SERVICIOS</h2>
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
    <td colspan="3"><div align="center">Nombre Productor(<a onclick="window.location.href='http://<?php echo $_SERVER['HTTP_HOST'];?>/EGOS/servicios/modif_servicios.php?modif=1'" >Activar busqueda</a>)</div></td>
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
      <input name="fecha_servicio" type="text" id="fecha_servicio"   value="<?php echo $fecha_servicio; ?>" onkeyup="format_fecha(this);" maxlength="10"  class="itext" />
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
 
  
  <?php get_pesadas_servicios($id_servicio); 
  
	//mete las taras
	while($tar=pg_fetch_array($taras)) { 
		echo "<input type='hidden' name='tara_".$tar['nom_tara']."' id='tara_".$tar['nom_tara']."' value='".$tar["peso"]."'>";
	}  
  
  ?>
  
  </table>
</fieldset>
<fieldset>
<legend></legend>   
<table width="100%" border="0" style="border-collapse:collapse">  
  <tr>
    <td>Observaciones</td>
    <td><div align="center">
      <textarea class="itextarea" name="observaciones" id="observaciones" onchange="conMayusculas(this)"><?php echo nom($observaciones); ?></textarea>
    </div></td>
    <td>&nbsp;</td>
    <td><div align="center">Hora de recepción</div></td>
    <td><div align="center">
      <input name="hora_r" type="text" class="peque" onkeyup="format_hora(this);" maxlength="5" id="hora_r" onchange="conMayusculas(this)"  size="20" maxlength="255" value="<?php echo nom($hora_r); ?>">
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Hora de inicio de secado</td>
    <td><div align="center">
      <input name="hora_s" type="text" class="peque" onkeyup="format_hora(this);" maxlength="5" id="hora_s" onchange="conMayusculas(this)"  size="20" maxlength="255" value="<?php echo nom($hora_s); ?>">
    </div></td>
    <td>&nbsp;</td>
    <td><div align="center">Hora final de secado</div></td>
    <td><div align="center">
      <input name="horafs" type="text" class="peque" onkeyup="format_hora(this);" maxlength="5" id="horafs" onchange="conMayusculas(this)"  size="20" maxlength="255" value="<?php echo  nom($hora_fs); ?>">
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
    <td colspan="2" align="center">Bayo</td>
    <td align="center">Verde</td>
    <td align="center">Quemado</td>
    <td align="center">Tierno</td>
	 <td align="center">S/mata</td>
    <td align="center">% Total</td>
  </tr>
  <tr>
    <td align="center"><input type="text" name="maduro" onkeyup="por_secado(document.captura,this)" size="15" maxlength="50"  id="maduro" onkeypress="return acceptNum(event)" autocomplete="off" class="peque" value="<?php echo nom($maduro); ?>"></td>
    <td><div align="center">
      <input type="text" name="smaduro"  onkeyup="por_secado(document.captura,this)" size="15" maxlength="50"   id="smaduro" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"  value="<?php echo nom($smaduro); ?>">
    </div></td>
    <td colspan="2" align="center"><input type="text" name="bayo" size="15" onkeyup="por_secado(document.captura,this)" maxlength="50"   id="bayo" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"   value="<?php echo nom($bayo); ?>"></td>
    <td align="center"><input type="text" name="verde" size="15" onkeyup="por_secado(document.captura,this)"  maxlength="50"   id="verde" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"  value="<?php echo nom($verde); ?>"></td>
    <td align="center"><input type="text" name="quemado" size="15" onkeyup="por_secado(document.captura,this)" maxlength="50"   id="quemado" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"   value="<?php echo nom($quemado); ?>"></td>
    <td align="center"><input type="text" name="tierno" size="15" onkeyup="por_secado(document.captura,this)" maxlength="50"   id="tierno" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"  value="<?php echo nom($tierno); ?>"></td>
	 <td align="center"><input type="text" name="smata" size="15" onkeyup="por_secado(document.captura,this)" maxlength="50" id="smata" onkeypress="return acceptNum(event)" autocomplete="off" class="peque"   value="<?php echo nom($smata); ?>"></td>
	 <td align="center"><input type="text" name="totalp" size="15" maxlength="50" id="totalp" readonly="true" class="peque"  value="<?php echo nom($ptotal); ?>"></td>  
	  
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="2" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td height="42" align="center">Costo del servicio por kilo de salida</td>
    <td><div align="center">
      <input name="costo_kgsalida" type="text"   id="costo_kgsalida" onkeypress="return acceptNum(event)" size="15" maxlength="50"  autocomplete="off"  class="itext" value="<?php echo number_format($costo_kgsalida,2); ?>" />
    </div></td>
    <td align="center"></td>
    <td align="right">
      <?php 
/*$img='<img src="../dummies/pagar.jpg" alt="Pagar"  title="Cobrar" width="40px" height="40px">';
echo "<a onclick='get_pago_servicio(".$id_servicio.")'>  
".$img."
</a>";*/
	
	
	$img='<img src="../images/excel.png" alt="Recibo orden de servicio"  title="Recibo orden de servicio" width="40px" height="40px">';

echo '<a href="../reportes/orden_servicio.php?id_servicio='.$id_servicio.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';
	
		 ?>
   </td>
    <td align="center"><div align="right">
      <input class="ibutton" type="button" name="nuevo2" id="nuevo" value="NUEVO SERVICIO"  onclick="window.location.href='http://<?php echo $_SERVER['HTTP_HOST'];?>/EGOS/servicios/modif_servicios.php?modif=2&idcliente=<?php echo $idcliente;?>'" />
		<!--update_nuevo_servicio(3); return false-->    
    </div></td>
    <td colspan="2" align="center"><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
    </div></td>
    </tr>
</table>
</fieldset>
</form>
<!--<div id="carga"></div>
<div id="contenedor" style="width:100%; height:300px; overflow: scroll;">
<div id="div_cobros" >
</div>
<div id="consulta_abonos">-->
<?php 
/*
$cmp_cobros=get_cobros_m($id_servicio);
if($cmp_cobros!=0)
get_cobros_consulta($id_servicio); 
*/
?><!--</div>
</div>

-->
