<form name="captura" action="" onSubmit="add_localidad(); return false"  class="formu">
<table width="200" border="0">
  <tr>
    <td colspan="2"><li class="iheader"><h2 class="art-logo-text">Localidades</h2></li></td>
    </tr>
  <tr>
    <td>Estado</td>
    <td><?php generaSelect(); ?></td>
  </tr>
  <tr>
    <td>Municipio</td>
    <td><div id="municipios">
      <?php generaSelect_municipio(); ?>
    </div></td>
  </tr>
  <tr>
    <td>Localidades Existentes </td>
    <td><div id="localidades"><span class="cliente">
	  <?php generaSelect_lo(); ?></span>
	 </div></td>
  </tr>
  <tr>
    <td>Nueva Localidad</td>
    <td><input type="text" name="localidad" size="20" maxlength="200" id="localidad" class="modif" onChange="conMayusculas(this)"></td>
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