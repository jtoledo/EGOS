<form name="captura_cobro" action="" onSubmit="cobrar_servicio(); return false" class="formu">  
<input type="hidden" name="id_servicio" value="<?php echo $id_servicio; ?>" />
  <table border="0" cellspacing="5">
    <tr>
      <td>Importe</td>
      <td><input type="text" name="importe" size="15" maxlength="50"  id="importe" onkeypress="return acceptNum(event)" autocomplete="off" class="itext" onchange="convertir_numero()"  ></td>
    </tr>
    <tr>
      <td>Fecha</td>
      <td><input name="fecha_cobro" type="text" id="fecha_cobro" onclick="popUpCalendar(this, captura_cobro.fecha_cobro, 'dd-mm-yyyy');"  value="<?php echo date("d-m-Y"); ?>" readonly="readonly" class="itext" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="center">
        <input class="ibutton" type="submit" name="enviar" id="enviar" value="COBRAR" />
      </div></td>
    </tr>
  </table>
</form>
