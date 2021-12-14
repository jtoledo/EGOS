<form name="captura" action="" onSubmit="add_colonia(); return false"  class="formu">
<table width="200" border="0">
  <tr>
    <td colspan="2"><li class="iheader"><h2 class="art-logo-text">Colonias</h2></li></td>
    </tr>
  <tr>
    <td>Estado</td>
    <td><?php generaSelect(); ?></td>
  </tr>
  <tr>
    <td>Municipio</td>
    <td><div id="municipios">
      <?php generaSelect_municipio2(); ?>
    </div></td>
  </tr>
  <tr>
    <td>Localidad</td>
     <td><div id="localidades">
	  <?php generaSelect_lo2(); ?>
	 </div></td>
  </tr>
  <tr>
    <td>Colonias existentes </td>
    <td><div id="colonias"><span class="cliente"><select  name="colonias_aux" id="cc_colonias_aux" class='consultor'>
      <?php
                    
					 
                     $consulta="SELECT * FROM cc_colonias where idestado='$idestado' and idmunicipio='$idmunicipio' and idlocalidad='$idlocalidad' ORDER BY colonia";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idcolonia"];
						if($idcolonia==$b)
						print("<option value=\"$b\" selected>".$fila["colonia"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["colonia"]."</option>");
                                 
                        }
						?>
    </select></span></div></td>
  </tr>
  <tr>
    <td>Nueva Colonia</td>
    <td><input type="text" name="colonia" size="20" maxlength="200" id="colonia" class="modif" onChange="conMayusculas(this)"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="right">
        <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
    </div></td>
  </tr>
</table>

</form>

