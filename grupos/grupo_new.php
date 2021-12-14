<form name="captura" action="" onSubmit="grupo_alta_egos(2); return false" class="formu">  
<table width="454" border="0">
  <tr>
    <td colspan="4">
	  <li class="iheader">
		 
		<h2 class="art-logo-text">
	GRUPOS	</h2>
	</li>	</td>
  </tr>
  <tr>
    <td colspan="4"><span class="cliente">
      <select name="idgrupos" class="consultor" id="idgrupos" onchange="actualiza_grupo_selec(1); return false">
        <option value="">Seleccione Grupo</option>
        <?php
		  
		  
		  $consulta_c="SELECT * FROM cc_grupos  order by grupo ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						$grupos=$fila_c["grupo"];
						
						?>
        <option value="<?php echo $fila_c["idgrupo"]?>"><?php echo nom(utf8_encode($grupos)); ?></option>
        <?php
						
						}
		  
		  
	  ?>
      </select>
    </span></td>
  </tr>
  <tr>
    <td colspan="3">Denominaci&oacute;n Social </td>
    <td>Correo Electr&oacute;nico</td>
  </tr>
  <tr>
    <td colspan="3"><input type="text" name="grupo" size="20" maxlength="255" id="grupo" class="modif" onchange="conMayusculas(this)" /></td>
    <td><input type="text" name="email" size="20" maxlength="200" value="<? echo $email;  ?>"  id="email" onchange="if ( !this.value.match(/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/) ) { this.value = '' }" onfocus="if (this.value == '') this.value = '';" title="El Formato correcto es: nombre@dominio.servidor"; class="itext"  onblur="conMayusculas(this)" /></td>
  </tr>
  <tr>
    <td colspan="4">Domicilio</td>
    </tr>
  <tr>
    <td colspan="4"><input type="text" name="domicilio" size="20" maxlength="255" id="domicilio" class="modif" onchange="conMayusculas(this)" /></td>
  </tr>
  <tr>
    <td>Estado</td>
    <td>Municipio</td>
    <td>Localidad</td>
    <td>Colonia</td>
  </tr>
  <tr>
    <td><?php generaSelect(); ?></td>
    <td>
    <div id="municipios">
    <select  name="municipio" id="cc_municipios" class='iselect' onchange='carga_select(this.id)'>
      <?php
                     
					 
                     $consulta="SELECT * FROM cc_municipios where idestado='$idestado'  ORDER BY municipio";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idmunicipio"];
						if($idmunicipio==$b)
						print("<option value=\"$b\" selected>".$fila["municipio"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["municipio"]."</option>");
                                 
                        }
						?>
    </select>
    </div>
    </td>
    <td><div id="localidades">
      <select name="localidad" id="cc_localidades" class='iselect' onchange='carga_select(this.id)'>
        <?php
                    
					 
$consulta="SELECT * FROM cc_localidades where idestado='$idestado' and idmunicipio='$idmunicipio' ORDER BY localidad";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idlocalidad"];
						if($idlocalidad==$b)
						print("<option value=\"$b\" selected>".$fila["localidad"]."</option>");
						else
						print("<option value=\"$b\" >".$fila["localidad"]."</option>");
                                 
                        }
						?>
      </select>
    </div></td>
    <td>
    <div id="colonias">
    <select  name="colonia" id="cc_colonias" class='iselect'>
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
    </select></div></td>
  </tr>
  <tr>
    <td colspan="4">Representate</td>
  </tr>
  <tr>
    <td colspan="4">
    
    <?php get_representante(); ?>
    
    </td>
  </tr>
  <tr>
    <td colspan="4">Fecha de activaci&oacute;n</td>
  </tr>
  <tr>
    <td colspan="4"><input name="fecha_activacion" type="text" id="fecha_activacion" onclick="popUpCalendar(this, captura.fecha_activacion, 'dd-mm-yyyy');" readonly="readonly" /></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td width="177"><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
    </div></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="257" colspan="2">&nbsp;</td>
    <td width="6">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>