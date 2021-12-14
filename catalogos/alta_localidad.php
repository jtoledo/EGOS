<form name="captura" action="" onSubmit="add_localidad(); return false"  class="formu">
<table width="200" border="0">
  <tr>
    <td colspan="2"><li class="iheader"><h2 class="art-logo-text">Localidades</h2></li></td>
    </tr>
  <tr>
    <td>Estado</td>
    <td><?php generaSelect_localidad(); ?></td>
  </tr>
  <tr>
    <td>Municipio</td>
    <td><div id="municipios">
      <select  name="municipio" id="cc_municipios" class='iselect' >
        <option value=''>Elige</option>
      </select>
    </div></td>
  </tr>
  <tr>
    <td>Localidades Existentes </td>
    <td><div id="localidades"><span class="cliente">
	  <select name="localidad_aux" id="cc_localidades_aux" class='consultor' >
	  <option value=''>Elige</option>
						
					</select></span>
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

