<form name="captura" action="" onSubmit="add_unidad(); return false"  class="formu">
<table width="200" border="0">
  <tr>
    <td colspan="2"><li class="iheader"><h2 class="art-logo-text">Unidades de medida</h2></li></td>
    </tr>
  <tr>
    <td>Unidades existentes </td>
    <td>
      <?php unidad_existente(); ?>
    </td>
  </tr>
  <tr>
    <td>Nueva Unidad </td>
    <td><input type="text" name="unidad" size="20" maxlength="200" id="unidad" class="modif" onChange="conMayusculas(this)"></td>
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

