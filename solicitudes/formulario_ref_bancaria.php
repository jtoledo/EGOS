<form name="captura" action="" onSubmit="add_referencia_banco(1); return false" class="formu">  

  <table width="200" border="0">
    <tr>
      <td colspan="2">
      
      <div id="update_ref_banco_modal">
     <?php
     if(isset($_SESSION["refe"]))
	 {
		 
		 consul_refe($_SESSION["refe"]);	
	 }
	 else
	 {
     ?>
      <select name="refe" class="modif">
        <option value="">Referencias Bancarias</option>
      </select>
      <?php
	 }
	  ?>
      
      </div>
      
      </td>
      <td><?php update_referencias_historial($idcliente);
	 
	  ?>
      
      
      </td>
    </tr>
    <tr>
      <td colspan="3"><div align="center">
          <li class="iheader"> REFERENCIAS BANCARIAS</li>
        </div>
          </li></td>
      </tr>
    <tr>
      <td>Banco</td>
      <td>Sucursal</td>
      <td>Dirección</td>
    </tr>
    <tr>
      <td><div align="center">
        <input name="banco" type="text" class="iselect" id="banco" onchange="conMayusculas(this)" value="<?php echo $banco; ?>" size="20" maxlength="255" />
      </div></td>
      <td><input name="sucursal" type="text" class="iselect" id="sucur" onchange="conMayusculas(this)" value="<?php echo $sucursal; ?>" size="20" maxlength="255" /></td>
      <td><input name="direccion" type="text" class="iselect" id="dire" onchange="conMayusculas(this)" value="<?php echo $direccion; ?>" size="20" maxlength="255" /></td>
    </tr>
    <tr>
      <td>Teléfono</td>
      <td>Tipo</td>
      <td>No de cuenta</td>
    </tr>
    <tr>
      <td><input name="telefono" type="text" class="iselect" id="tel" onchange="conMayusculas(this)" value="<?php echo $telefono; ?>" size="20" maxlength="255" onkeypress="return acceptNum(event)"></td>
      <td><input name="tipo_cuenta" type="text" class="iselect" id="tipo" onchange="conMayusculas(this)" value="<?php echo $tipo_cuenta; ?>" size="20" maxlength="255" /></td>
      <td><input name="no_cuenta" type="text" class="iselect" id="no_cuenta" onchange="conMayusculas(this)" value="<?php echo $no_cuenta; ?>" size="20" maxlength="255" /></td>
    </tr>
    <tr>
      <td>Contacto</td>
      <td rowspan="2">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input name="contacto" type="text" class="iselect" id="banco2" onchange="conMayusculas(this)" value="<?php echo $contacto; ?>" size="20" maxlength="255" /></td>
      <td><div align="right">
        <input class="ibutton" type="submit" name="enviar" id="enviar" value="AGREGAR" />
      </div></td>
    </tr>
  </table>
</form>