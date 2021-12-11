<form name="captura" action="" onSubmit="add_proceso(); return false"  class="formu">
<table width="200" border="0">
  <tr>
    <td colspan="2"><li class="iheader"><h2 class="art-logo-text">Actividades del paquete tecnol&oacute;gico</h2></li></td>
    </tr>
  <tr>
    <td>Procesos existentes </td>
    <td>
      <?php proceso_existente(); ?>
    </td>
  </tr>
  <tr>
    <td>Nuevo Proceso </td>
    <td><input type="text" name="proceso" size="20" maxlength="200" id="proceso" class="modif" onChange="conMayusculas(this)"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="right">
        <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
    </div></td>
  </tr>
</table>

</form>

