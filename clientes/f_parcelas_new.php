<?php
if($modif==1)
	{
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_parcelas where idcliente='$idcliente'  order by num_predio ";
	   $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		 $id_parcela=$fila["id_parcela"];
		 $idcliente=$fila["idcliente"];
		 $f_registro=$fila["f_registro"];
		 $desc_predio=$fila["desc_predio"];
		 $idestado=$fila["idestado"];
		 $idmunicipio=$fila["idmunicipio"];
		 $idlocalidad=$fila["idlocalidad"];
		 $idcolonia=$fila["idcolonia"];
		 $id_catalogo=$fila["id_catalogo"];
		 $super_esp=$fila["super_esp"];
		 $num_predio=$fila["num_predio"];
		 $color=$fila["color"];
		 $textura=$fila["textura"];
		 $estruct=$fila["estruct"];
		 $poro=$fila["poro"];
		 $perme=$fila["perme"];
		 $prof_efe=$fila["prof_efe"];
		 $temp=$fila["temp"];
		 $lluvia=$fila["lluvia"];
		 $hume_aire=$fila["hume_aire"];
		 $vientos=$fila["vientos"];
		 $brillo_solar=$fila["brillo_solar"];
		 $nubosidad=$fila["nubosidad"];
		 $st_hec=$fila["st_hec"];
		 $st_area=$fila["st_area"];
		 $st_centi=$fila["st_centi"];
		 $st_deci=$fila["st_deci"];
		 
		 
		  $sc_hec=$fila["sc_hec"];
		 $sc_area=$fila["sc_area"];
		 $sc_centi=$fila["sc_centi"];
		 $sc_deci=$fila["sc_deci"];
		 
		}
		
	
	}





?>
<style type="text/css">
<!--
.Estilo1 {
	color: #000040;
	font-weight: bold;
	background-color:#FFFF33;
}
-->
</style>




  
  
  
  
  
<form name="captura" action="" onSubmit="parcelas_alta_egos(2); return false" class="formu">  
<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>" />
 <table width="200" border="0">
     <tr>
       <td colspan="17">
         <li class="iheader">
		 
		 <?php
		  $img="<img src='../images/back.png' name='atras' alt='atras' align='absmiddle'> ";	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"atras_cliente('".$idcliente."')\">"


.$img.


"</a>";
	 
echo "".nom($nom_completo); 		 
?>		 
		 
		 </li>
		 </td>
		 
     </tr>
    <tr>
      <td colspan="14">&nbsp;</td>
     <td>*Fecha Registro </td>
     <td colspan="2">*Descripci&oacute;n</td>
    </tr>
   <tr>
     <td colspan="14">
	 

<!--<form name="captura_parcela" action=""  class="iform">checar js para las actualizaciones-->

<span class="cliente">
    <select name="id_parcelas" class="consultor" onchange="actualiza_parcela_selec(1); return false">
                 <option value="">Seleccione Parcela</option>
      
      <?php
		  
		  
		  $consulta_c="SELECT * FROM cc_parcelas where idcliente='$idcliente' order by num_predio ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						$desc_predios=$fila_c["desc_predio"];
						$num_predios=$fila_c["num_predio"];
						$descrip=$num_predios." - ".$desc_predios;
						?>	
      
      <option value="<?php echo $fila_c["id_parcela"]?>"><?php echo nom(utf8_decode($descrip)); ?></option>	
      
      <?php
						
						}
		  
		  
	  ?>      
    </select> 
</span>
<!--</form>-->

	 
	 </td>
     <td>
	 
	 <input name="f_registro" type="text" id="f_registro" onClick="popUpCalendar(this, captura.f_registro, 'dd-mm-yyyy');"  value="" readonly="readonly" class="iselect">	 </td>
     <td colspan="2"><input type="text" name="desc_predio" size="20" maxlength="70" id="desc_predio" value="" class="modif" onChange="conMayusculas(this)"></td>
    </tr>
   <tr>
     <td colspan="7">*Estado</td>
     <td colspan="7">*Municipio</td>
     <td>*Localidad</td>
     <td>*Colonia</td>
     <td>*Tipo de caf&eacute; </td>
   </tr>
   <tr>
     <td colspan="7"><?php generaSelect_new(); ?></td>
     <td colspan="7"><div id="municipios">
       <select  name="municipio" id="cc_municipios" class='iselect' onChange='carga_select(this.id)'>
         <option value=''>Elige</option>
         
         <?php
                     
					 
                     $consulta="SELECT * FROM cc_municipios where idestado='$idestado'  ORDER BY municipio";
                     $id_query = pg_query($con,$consulta);
                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$b=$fila["idmunicipio"];
						
						print("<option value=\"$b\" >".$fila["municipio"]."</option>");
                                 
                        }
						?>
         
         
         </select>
     </div></td>
     <td><div id="localidades">
       <select name="localidad" id="cc_localidades" class='iselect' onChange='carga_select(this.id)'>
         <option value=''>Elige</option>
         
         </select>
     </div></td>
     <td><div id="colonias">
	<select  name="colonia" id="cc_colonias" class='iselect'>
	<option value=''>Elige</option>
						
					</select>
					
	</div></td>
       <td><select name="id_cafe" id="id_cafe" class="iselect">
       <option value="">Seleccione Cafe</option>
       <?php
                    
					 
                     $consulta="SELECT * FROM al_cat_articulos  order by descripcion";
                     $id_query = pg_query($con,$consulta);

                     while( $fila= pg_fetch_array($id_query) )
                        {  
						$id_catalogo=$fila["id_catalogo"];
						
						if($id_catalogo==$id_catalogo)
						print("<option value=\"$id_catalogo\" selected>".$fila["descripcion"]."</option>");
						else
						print("<option value=\"$id_catalogo\" >".$fila["descripcion"]."</option>");
                                 
                        }
						?>
     </select></td>
   </tr>
   <tr>
     <td colspan="7">*Super Total </td>
     <td colspan="7">*Super Cultivada </td>
     <td>Cosecha esperada </td>
     <td>Num Predio </td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td><input type="text" name="st_hec" onkeypress="return acceptNum(event)" maxlength="4" size="8" id="st_hec" class="cuatro" /></td>
     <td rowspan="2">-</td>
     <td><input name="st_area" type="text" onkeypress="return acceptNum(event)" class="dos" id="st_area" size="4"  maxlength="2" /></td>
     <td rowspan="2">-</td>
     <td><input name="st_centi" type="text" onkeypress="return acceptNum(event)" class="dos" id="st_centi" size="4"  maxlength="2" /></td>
     <td rowspan="2">.</td>
     <td><input name="st_deci" type="text" onkeypress="return acceptNum(event)" class="dos" id="st_deci" size="4"  maxlength="2" /></td>
     <td><input name="sc_hec" type="text" onkeypress="return acceptNum(event)" class="cuatro" id="sc_hec" size="8"  maxlength="4" /></td>
     <td rowspan="2">-</td>
     <td><input name="sc_area" type="text" onkeypress="return acceptNum(event)" class="dos" id="sc_area" size="4"  maxlength="2" /></td>
     <td rowspan="2">-</td>
     <td><input name="sc_centi" type="text" onkeypress="return acceptNum(event)" class="dos" id="sc_centi" size="4"  maxlength="2" /></td>
     <td rowspan="2">.</td>
     <td><input name="sc_deci" type="text" onkeypress="return acceptNum(event)" class="dos" id="sc_deci" size="4"  maxlength="2" /></td>
     <td rowspan="2"><input type="text" onkeypress="return acceptNum(event)" name="super_esp" size="20" maxlength="15" id="super_esp" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td rowspan="2"><input type="text" name="num_predio" size="20" maxlength="15" id="num_predio" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td rowspan="2">&nbsp;</td>
   </tr>
   <tr>
     <td><div align="center">H</div></td>
     <td><div align="center">A</div></td>
     <td><div align="center">CA</div></td>
     <td><div align="center">CC</div></td>
     <td><div align="center">H</div></td>
     <td><div align="center">A</div></td>
     <td><div align="center">CA</div></td>
     <td><div align="center">CC</div></td>
   </tr>
   <tr>
     <td colspan="14" rowspan="2"><div align="center"><strong>Propiedades F&iacute;sicas Del Suelo </strong></div></td>
     <td>Color</td>
     <td>Textura</td>
     <td>Estructura</td>
   </tr>
   <tr>
     <td><input type="text" name="color" size="20" maxlength="15" id="color" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td><input type="text" name="textura" size="20" maxlength="15" id="textura" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td><input type="text" name="estruct" size="20" maxlength="15" id="estruct" value="" class="itext" onChange="conMayusculas(this)"></td>
   </tr>
   <tr>
     <td colspan="7">Porosidad</td>
     <td colspan="7">Permeabilidad</td>
     <td>Profundidad efectiva </td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td colspan="7"><input type="text" name="poro" size="20" maxlength="15" id="poro" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td colspan="7"><input type="text" name="perme" size="20" maxlength="15" id="perme" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td><input type="text" name="prof_efe" size="20" maxlength="15" id="prof_efe" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td colspan="14" rowspan="2"><div align="center"><strong>Condiciones Clim&aacute;ticas </strong></div></td>
     <td>Temperatura</td>
     <td>LLuvia</td>
     <td>Humedad aire </td>
   </tr>
   <tr>
     <td><input type="text" name="temp" size="20" maxlength="15" id="temp" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td><input type="text" name="lluvia" size="20" maxlength="15" id="lluvia" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td><input type="text" name="hume_aire" size="20" maxlength="15" id="hume_aire" value="" class="itext" onChange="conMayusculas(this)"></td>
   </tr>
   <tr>
     <td colspan="7">Vientos</td>
     <td colspan="7">Brillo Solar </td>
     <td>Nubosidad</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td colspan="7"><input type="text" name="vientos" size="20" maxlength="15" id="vientos" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td colspan="7"><input type="text" name="brillo_solar" size="20" maxlength="15" id="brillo_solar" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td><input type="text" name="nubosidad" size="20" maxlength="15" id="nubosidad" value="" class="itext" onChange="conMayusculas(this)"></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td colspan="7">&nbsp;</td>
     <td colspan="7">&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td><div align="right">
       <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
     </div></td>
   </tr>
 </table>
</form>