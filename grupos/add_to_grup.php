<?php


	  $fila=get_grupo_m($idgrupo);
	

 		 $idgrupo=$fila["idgrupo"];
		 $grupo=$fila["grupo"];
		 $idestado=$fila["idestado"];
		 $idmunicipio=$fila["idmunicipio"];
		 $idlocalidad=$fila["idlocalidad"];
		 $idcolonia=$fila["idcolonia"];
		 $domicilio=$fila["domicilio"];
		 $email=$fila["email"];
		 $fecha_activacion=$fila["fecha_activacion"];
		 $idrepresentante=$fila["idrepresentante"];
		 $status=$fila["status"];



?>
<form name="captura" action="" onSubmit="grupo_add_egos(1); return false" class="formu">  
<input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>" />

<table width="454" border="0">
  <tr>
    <td colspan="3">
	  <li class="iheader">
		 
		<h2 class="art-logo-text">

         <h2 class="art-logo-text"><?php 
	
	 $img="<img src='../images/back.png' name='atras' alt='atras' align='absmiddle'> ";	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"atras_grupo('".$idgrupo."','1')\">"


.$img.


"</a>";
	
	echo nom($grupo); ?>
		</h2>
	</li>	</td>
  </tr>
  <tr>
    <td colspan="2">Representante: 
      <?php get_representante_m_lect($idrepresentante); ?></td>
    <td width="177"><div align="center">Tipo de cliente: <strong><?php echo nom($tipo_cliente); ?></strong></div></td>
  </tr>
  <tr>
    <td colspan="2">Cliente</td>
    <td>Fecha de activaci&oacute;n</td>
  </tr>
  <tr>
    <td colspan="2"><?php get_productor_m(); ?></td>
    <td><input name="fecha_activacion" type="text" id="fecha_activacion" onclick="popUpCalendar(this, captura.fecha_activacion, 'dd-mm-yyyy');"  value="<?php echo $fecha_activacion; ?>" disabled="disabled" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php
	  get_clientes_grupo($idgrupo); //OBTIENE LOS clientes del grupo
	  ?></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="257">&nbsp;</td>
    <td width="6">&nbsp;</td>
    <td><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="AGREGAR" />
    </div></td>
  </tr>
</table>

</form>