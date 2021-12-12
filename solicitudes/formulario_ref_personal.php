<form name="captura" action="" onSubmit="add_referencia_personal(1); return false" class="formu">  

  <table width="300" border="0">
    <tr>
      <td colspan="2">
      
      <div id="update_ref_per_modal">
     <?php
     if(isset($_SESSION["refe_per"]))
	 {
		 
		 consul_refe_per($_SESSION["refe_per"]);	
	 }
	 else
	 {
     ?>
      <select name="refe_per" class="modif">
        <option value="">Referencias Personales</option>
      </select>
      <?php
	 }
	  ?>
      
      </div>
      
      </td>
      <td>
	  
	  <?php update_ref_personales_historial($idcliente); ?>
	 
	  
      
      
      </td>
    </tr>
    <tr>
      <td colspan="3"><div align="center">
          <li class="iheader"> REFERENCIAS PERSONALES</li>
        
          </li>
          </div>
          </td>
      </tr>
    <tr>
      <td><div align="center">Nombre</div></td>
      <td><div align="center">Dirección</div></td>
      <td><div align="left">Telefono</div></td>
    </tr>
    <tr>
      <td><div align="center">
        <input name="nombre" type="text" class="iselect" id="nombre" onchange="conMayusculas(this)" value="<?php echo $nombre; ?>" size="20" maxlength="255" />
      </div></td>
      <td><div align="center">
        <input name="direccion" type="text" class="iselect" id="sucur" onchange="conMayusculas(this)" value="<?php echo $direccion; ?>" size="20" maxlength="255" />
      </div></td>
      <td><div align="left">
        <input name="telefono" type="text" class="iselect" id="telefono" onchange="conMayusculas(this)" value="<?php echo $telefono; ?>" size="20" maxlength="255" onkeypress="return acceptNum(event)" />
      </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div align="right">
        <input class="ibutton" type="submit" name="enviar" id="enviar" value="AGREGAR" />
      </div></td>
    </tr>
  </table>
</form>