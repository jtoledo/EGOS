<style type="text/css">
.formu table tr td {
	text-align: center;
}
</style>

<form name="captura" action="" onSubmit="cc_autoriza_solicitud(3); return false" class="formu">  
<input type="hidden" name="idsolicitud" value="<?php echo $idsolicitud; ?>" />
<input type="hidden" name="folio_sol" value="<?php echo $folio_sol; ?>" />

<table width="60%" border="0">
    <tr>
      <td><div align="center">Nombre</div></td>
      <td colspan="3"><div align="center">Grupo</div></td>
      <td colspan="2"><div align="center">Monto solicitado</div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="left">
        <input name="nombre" type="text" disabled="disabled" class="modif" id="nombre" onchange="conMayusculas(this)" value="<?php echo nom($nom_cliente); ?>" size="20" maxlength="255" />
      </div></td>
      <td colspan="3"><div align="center">
        <input name="grupo" type="text" disabled="disabled"  class="modif"  id="grupo"  onblur="conMayusculas(this)" value="<?php echo $grupo;  ?>" size="20" maxlength="200" />
      </div></td>
      <td colspan="2"><div align="center">
        <input name="monto" type="text" disabled="disabled"  class="itext"  id="monto"  onblur="conMayusculas(this)" value="<?php echo $monto;  ?>" size="20" maxlength="200" />
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td rowspan="2">Producto</td>
      <td rowspan="2">Periodo Pago</td>
      <td rowspan="2">Plazo</td>
      <td colspan="2">Tasa Anual</td>
     <!-- <td colspan="2">Tasa Anual</td>-->
    </tr>
    <tr>
      <td>Normal</td>
      <td>Moratoria</td>
     <!-- <td>Normal</td>
      <td>Moratoria</td>-->
    </tr>
    <tr>
      <td><input name="producto" type="text" disabled="disabled" class="modif"  id="producto" onchange="conMayusculas(this)" value="<? echo $producto; ?>" size="20" /></td>
      <td><?php
      
	  get_periodo_m_disabled($idper);
	  
	  ?></td>
      <td><input name="plazo" type="text" disabled="disabled" class="peque"  id="plazo" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)" value="<? echo $plazo; ?>" size="20" /></td>
      <td><input name="interes_normal" type="text" disabled="disabled" class="peque"  id="interes_normal" onchange="llenar_campo_recursos(); return false" onkeypress="return acceptNum(event)" value="<? echo number_format($interes_normal,4); ?>" size="20" /></td>
      <td><input name="interes_moratorio" type="text" disabled="disabled" class="peque"  id="interes_moratorio" onchange="llenar_campo_recursos(); return false"onkeypress="return acceptNum(event)" value="<? echo number_format($interes_moratorio,4); ?>" size="20" /></td>
     <!-- <td><input name="interes_normal_a" type="text" disabled="disabled" class="peque"  id="interes_normal_a" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)" value="<? echo number_format($interes_normal_m,4); ?>" size="20"  readonly="readonly" /></td>
      <td><input name="interes_moratorio_a" type="text" disabled="disabled" class="peque"  id="interes_moratorio_a" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)" value="<? echo number_format($interes_moratorio_m,4); ?>" size="20" readonly="readonly" /></td>
		-->    
    </tr>
    <tr>
      <td>Monto Aut. Rec. propio</td>
		 <td>Monto Aut. Parafinanciera</td>
      <td colspan="2">Fecha de comité</td>
     
      <td><input name="fecha_comite" type="text" id="fecha_comite" onclick="popUpCalendar(this, captura.fecha_comite, 'dd-mm-yyyy');"  value="<?php echo $fecha; ?>" readonly="readonly" class="itext" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
     
    </tr>
    <tr>
      <td><input name="monto_auto" type="text" class="itext" id="monto_auto" onchange="verificaMonto(this,this.form.monto_recpropio)"  onkeypress="return acceptNum(event)" value="<? echo $monto;  ?>" size="20" maxlength="255" />
  		 </td>
		 
		 <input name="monto_recpropio" type="hidden" class="itext" id="monto_recpropio" value="<? echo $monto;  ?>"  />
		 <input name="monto_recfinan" type="hidden" class="itext" id="monto_recfinan" value="<? echo $monto_finan;  ?>"  />       
      
       <td><div><input name="monto_finan" type="text" class="itext" id="monto_finan" onchange="verificaMonto(this,this.form.monto_recfinan)"  onkeypress="return acceptNum(event)" value="<? echo $monto_finan;  ?>" size="20" maxlength="255" />
       
		</div>
		<div>
			Dispociones		
		</div><div>
		<?php
			get_disposiciones("");
		?>
		</div>       
       </td>
      <td colspan="2">Fecha de ministración</td>
      <td><input name="fecha_ministracion" type="text" id="fecha_ministracion" onclick="popUpCalendar(this, captura.fecha_ministracion, 'dd-mm-yyyy');"  value="<?php echo $fecha; ?>" readonly="readonly" class="itext" /></td>
    </tr> 
    <tr> 
    <td></td>
    <td></td>     
     <td colspan="2">Fecha de ministración Parafinanciera</td>
      <td><input name="f_ministra_pfinan" type="text" id="f_ministra_pfinan" onclick="popUpCalendar(this, captura.f_ministra_pfinan, 'dd-mm-yyyy');"  value="<?php echo $fecha; ?>" readonly="readonly" class="itext" /></td>

     <td colspan="3"><input class="ibutton" type="submit" name="enviar" id="enviar" value="AUTORIZAR" /></td>
    </tr>
  </table>
</form>

<?php
 		echo "|0|";
?>