<?php
if($modif!=1)
	{
   $fila=get_grupo_sol_alta();
	}

 		 $idsolgrupo=$fila["idsolgrupo"];
		 $idgrupo=$fila["idgrupo"];
		 $fecha_solicitud=$fila["fecha_solicitud"];
		 $idproducto=$fila["idproducto"];
		  $fila_g=get_grupo_m($idgrupo);
		  $grupo=$fila_g["grupo"];
		  $folio=$fila["folio"];

?>

<form name="captura" action="" onSubmit="grupo_alta_solicitud_egos(1); return false" class="formu">  
<input type="hidden" name="idsolgrupo" id="idsolgrupo" value="<?php echo $idsolgrupo; ?>" />
<table width="454" border="0">
  <tr>
    <td colspan="3">
	  <li class="iheader">
		 
		<h2 class="art-logo-text">
	Edici&oacute;n de Solicitud Grupal	</h2>
	</li>	</td>
  </tr>
  <tr>
    <td colspan="3"><span class="cliente">
     <?php //get_grupo_solicitudes_m_update($idgrupo);
	 			get_grupo_solicitudes_div_update($idgrupo);
	  //consultamos los grupos existentes  ?>
    </span></td>
  </tr>
  <tr>
    <td colspan="3">
      <div id="solicitudes_grupos">
       <?php get_grupo_solicitudes_folios($idgrupo,$idsolgrupo,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']); ?>
        </div>
      
      </td>
  </tr>
  <tr>
    <td colspan="3"> <li class="iheader">
		 
		<h2 class="art-logo-text">
	Datos de la Solicitud Grupal	</h2></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2">&nbsp;</td>
    <td><div align="center">Folio</div></td>
  </tr>
  <tr>
    <td><div align="center">
      <input name="folio" type="text" class="folio" id="folio" onchange="conMayusculas(this)" value="<?php echo $folio;  ?>" size="20" maxlength="255" readonly="readonly">
    </div></td>
  </tr>
  <tr>
    <td>Grupo</td>
    <td width="6">Fecha de activaci&oacute;n</td>
    <td>Producto Financiero</td>
  </tr>
  <tr>
    <td><input type="text" name="grupo" size="20" maxlength="255" id="grupo" value="<?php echo nom($grupo); ?>" class="modif" onchange="conMayusculas(this)" readonly="readonly"></td>
    <td><input name="fecha_activacion" type="text" id="fecha_activacion" onclick="popUpCalendar(this, captura.fecha_activacion, 'dd-mm-yyyy');" readonly="readonly" class="iselect" value="<?php echo $fecha_solicitud; ?>"></td>
    <td><?php
    get_productos_sol_m($idproducto);
    ?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="177"><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="right">
      <input class="ibutton" type="button" name="nuevo" id="enviare" value="NUEVA SOLICITUD"  onclick="actualiza_grupo_solicitud_selec(2,'<?php echo $idgrupo;  ?>'); return false" />
    </div></td>
  </tr>
  <tr>
    <td width="257"><?php get_sol_individuales($idgrupo); ?></td>
    <td colspan="2"><div id="sol_grupal"><span class="cliente"><?php get_sol_grupales($idsolgrupo); ?></span></div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>