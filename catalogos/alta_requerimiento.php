<form name="captura" action="" onSubmit="add_proceso(); return false"  class="formu">
<table width="808" border="0">
  <tr>
    <td><li class="iheader"><h2 class="art-logo-text">Requerimiento de procesos del paquete tecnol&oacute;gico</h2></li></td>
    </tr>
  <tr>
    <td><div align="center">Procesos existentes</div></td>
    </tr>
  <tr>
    <td><div align="center">
      <?php proceso_actualiza(); ?>
    </div></td>
    </tr>
  <tr>
    <td><div align="center">Requerimientos
    </div></td>
    </tr>
  <tr>
    <td> <div id="reque">
      <div align="center">
        <select name="idrequerimiento" id="idrequerimiento" class='iselect' >
          <option value=''>Elige requerimiento</option>
          </select>
      </div>
    </div></td>
    </tr>
  </table>
  </form>



<div id="form_reque">

  <form name="requerimiento" action="" onSubmit="add_reque(); return false"  class="formu">

  <table width="808"  border="0">

  
  <tr>
    <td width="140"><div align="center"><strong>U de medida / Servicio </strong></div></td>
    <td width="87"><div align="center"><strong>Cantidad</strong></div></td>
    <td width="55"><div align="center"><strong>Ciclos</strong></div></td>
    <td width="86"><div align="center"><strong>Total ciclos </strong></div></td>
    <td width="52"><div align="center"><strong>$/UN</strong></div></td>
    <td width="58"><div align="center"><strong>$ Total </strong></div></td>
    <td width="70"><div align="center"><strong>Porciento Productor </strong></div></td>
    <td width="100"><div align="center"><strong>Cuota Cr&eacute;dito </strong></div></td>
    <td width="122"><div align="center"><strong>Aportaci&oacute;n Productor </strong></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <select name="iduni" id="select" class='peque' disabled="disabled" >
        <option value=''>Elige </option>
      </select>
    </div></td>
    <td><input type="text" name="cantidad" size="20" maxlength="200" id="cantidad" class="peque" onkeypress="return acceptNum(event)"  disabled="disabled" /></td>
    <td><input type="text" name="ciclos" size="20" maxlength="200" id="ciclos" class="peque" onkeypress="return acceptNum(event)"  disabled="disabled" ></td>
    <td><input type="text" name="total_ciclos" size="20" maxlength="200" id="total_ciclos" class="peque" onkeypress="return acceptNum(event)"  disabled="disabled" ></td>
    <td><input type="text" name="un" size="20" maxlength="200" id="un" class="peque" onkeypress="return acceptNum(event)" disabled="disabled" ></td>
    <td><input type="text" name="total" size="20" maxlength="200" id="total" class="peque" onkeypress="return acceptNum(event)"  disabled="disabled" ></td>
    <td><input type="text" name="porciento_produ" size="20" maxlength="200" id="porciento_produ" class="peque" onkeypress="return acceptNum(event)"  disabled="disabled"></td>
    <td><input type="text" name="cuota_credi" size="20" maxlength="200" id="cuota_credi" class="peque" onkeypress="return acceptNum(event)"  disabled="disabled"></td>
    <td><input type="text" name="aporta_produ" size="20" maxlength="200" id="aporta_produ" class="peque" onkeypress="return acceptNum(event)" disabled="disabled"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
      <div align="center">
        <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" disabled="disabled">
        </div></td>
  </tr>
</table>



</form>

</div>