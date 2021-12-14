<form name="captura" action="" onSubmit="grupo_alta_solicitud_egos(2); return false" class="formu">  
<table width="454" border="0">
  <tr>
    <td colspan="4">
	  <li class="iheader">
		 
		<h2 class="art-logo-text">
	Solicitud Grupal	</h2>
	</li>	</td>
  </tr>
  <tr>
    <td colspan="4"><span class="cliente">
     <?php get_grupo_solicitudes_div_update($idgrupo);//consultamos los grupos existentes  ?>
    </span></td>
  </tr>
  <tr>
    <td colspan="4">
      <div id="solicitudes_grupos">
      <?php
	  	 $fila=get_grupo_sol_consulta_sol($idgrupo,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
		 
		 if($fila!=0)//quiere decir q si tiene solicitudes grupales
		 {
		  $idsolgrupo=$fila["idsolgrupo"]; 
		  get_grupo_solicitudes_folios($idgrupo,$idsolgrupo,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
	  
	   }
		 else //no hay solicitudes grupales mandar a nueva solicitud
		 {
			 ?>
			<select  name="idsol_grupo" id="idsol_grupo" class='modif' >
          <option value="">Solicitudes del Grupo</option> 
          </select>
          <?php
		 }
	  ?>
      
      
      
        
        </div>
      
      </td>
  </tr>
  <tr>
    <td colspan="4"> <li class="iheader">
		 
		<h2 class="art-logo-text">
	Datos de la Solicitud Grupal	</h2></td>
  </tr>
  <tr>
    <td colspan="2">Grupo</td>
    <td>Fecha de activaci&oacute;n</td>
    <td>Producto Financiero</td>
  </tr>
  <tr>
    <td colspan="2"><input type="text" name="grupo" size="20" maxlength="255" id="grupo" class="modif" onchange="conMayusculas(this)" readonly="readonly" value="<?php echo nom($grupo); ?>"></td>
    <td><input name="fecha_activacion" type="text" id="fecha_activacion" onclick="popUpCalendar(this, captura.fecha_activacion, 'dd-mm-yyyy');" readonly="readonly" class="iselect"></td>
    <td><?php
    get_productos_sol();
    ?></td>
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