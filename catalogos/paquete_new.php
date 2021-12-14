
<style type="text/css">
<!--
.Estilo1 {
	color: #000040;
	font-weight: bold;
	background-color:#FFFF33;
}
-->
</style>
<form name="captura" action="" onSubmit="paquete_alta_egos(2); return false" class="formu">  
<table width="454" border="0">
  <tr>
    <td colspan="3">
	  <li class="iheader">
		 
		<h2 class="art-logo-text">
	PAQUETES TECNOL&Oacute;GICOS	</h2>
	</li>	</td>
  </tr>
  <tr>
    <td colspan="3"><span class="cliente">
      <select name="id_paquetes" class="modif" id="id_paquetes" onchange="actualiza_paquete_selec(1); return false">
        <option value="">Seleccione Paquete</option>
        <?php
		  
		  
		  $consulta_c="SELECT * FROM paquete_tec  order by nom_paquete ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						$nom_paquetes=$fila_c["nom_paquete"];
						
						?>
        <option value="<?php echo $fila_c["id_paquete"]?>"><?php echo nom($nom_paquetes); ?></option>
        <?php
						
						}
		  
		  
	  ?>
      </select>
    </span></td>
  </tr>
  <tr>
    <td colspan="3">Nombre de paquete tecnol&oacute;gico </td>
  </tr>
  <tr>
    <td colspan="3"><input type="text" name="nom_paquete" size="20" maxlength="255" id="nom_paquete" class="modif" onchange="conMayusculas(this)" /></td>
  </tr>
  <tr>
    <td colspan="3">Descripci&oacute;n del paquete tecnol&oacute;gico </td>
  </tr>
  <tr>
    <td colspan="3">
	
	
<textarea name="descripcion_paquete" class="itextarea"  onchange="conMayusculas(this)"></textarea>
	
	
	</td>
  </tr>
  <tr>
    <td><div align="center">Ingreso por Hectaria</div></td>
    <td><div align="center">Unidad</div></td>
    <td><div align="center">Precio x Hectarea</div></td>
  </tr>
  <tr>
    <td><div align="center">
      <input name="ingre_hec" type="text" class="peque" id="ingre_hec" onchange="conMayusculas(this)" size="20" maxlength="255" onkeypress="return acceptNum(event)"  />
    </div></td>
    <td><div align="center">
      <?php
    get_unidad();
    ?>
    </div></td>
    <td><div align="center">
      <input name="precio_hec" type="text" class="peque" id="precio_hec" onchange="conMayusculas(this)" size="20" maxlength="255" onkeypress="return acceptNum(event)" />
    </div></td>
  </tr>
  <tr>
    <td>Fecha de alta </td>
    <td>Smg</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="fecha_paq" type="text" id="fecha_paq" onclick="popUpCalendar(this, captura.fecha_paq, 'dd-mm-yyyy');" readonly="readonly" /></td>
    <td><input type="text" name="smg" size="20" maxlength="255" id="smg" class="peque" onkeypress="return acceptNum(event)"  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="right"></div></td>
    <td width="177"><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
    </div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="257"><div align="left">
      <select name="select" class="iselect" id="select" onchange="actualiza_requeri_selec(1); return false">
        <option value="">Ver requerimientos del paquete actual</option>
        <?php
		  
		  
		  $consulta_c="SELECT * FROM conf_paquete,cc_ptrequerimientos,paquete_tec where 
		  
		  conf_paquete.id_paquete='$id_paquete' and conf_paquete.idrequerimiento=cc_ptrequerimientos.idrequerimiento and paquete_tec.id_paquete=conf_paquete.id_paquete order by cc_ptrequerimientos.requerimiento ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						$requerimiento=$fila_c["requerimiento"];
						
						?>
        <option value="<?php echo $fila_c["idrequerimiento"]?>"><?php echo nom($requerimiento); ?></option>
        <?php
						
						}
		  
		  
	  ?>
      </select>
   </div></td>
    <td width="6">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>