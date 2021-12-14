<?php 
if($modif!=1)
{
$fila=get_se_servicios_gral();
$id_servicio=$fila["id_servicio"];
$idcliente=$fila["idcliente"];
$fecha_servicio=$fila["fecha_servicio"];
$folio_servicio=$fila["folio_servicio"];
$cantidad=$fila["cantidad"];
$id_tipo_servicio=$fila["id_tipo_servicio"];
$precio_u=$fila["precio_u"];
$subtotal=$fila["subtotal"];
$total=$fila["total"];
$observaciones=$fila["observaciones"];
}

?>
<form name="captura" action="" onSubmit="guarda_servicio(1); return false" class="formu">  
<input type="hidden" name="id_servicio" value="<?php echo $id_servicio; ?>" />
<table width="80%" border="0" align="center">
  <tr>
    <td colspan="6"><li class="iheader">
		  <div id="carga"></div>
		<h2 class="art-logo-text">
	EDICI&Oacute;N DE SERVICIOS</h2>
	</li></td>
  </tr>
  <tr>
    <td colspan="3" rowspan="2">&nbsp;</td>
    <td rowspan="2"><div align="right"></div></td>
    <td colspan="2">
      Servicios del cliente</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center" id="servicio_cliente">
      <?php get_servicios_cliente_select($idcliente); ?>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">Nombre Productor</div></td>
    <td><div align="center">Fecha</div></td>
    <td colspan="2"><div align="center">Folio</div></td>
    </tr>
  <tr>
    <td colspan="3"><div align="center"><span class="clientes_sol">
      <?php
    get_clientes_servicios_m($idcliente);
    ?>
    </span></div></td>
    <td><div align="center">
      <input name="fecha_servicio" type="text" id="fecha_servicio" onclick="popUpCalendar(this, captura.fecha_servicio, 'dd-mm-yyyy');"  value="<?php echo $fecha_servicio; ?>" readonly="readonly" class="itext" />
    </div></td>
    <td colspan="2"><div align="center">
      <input name="folio_servicio" type="text" class="folio" id="folio_servicio" onchange="conMayusculas(this)" value="<?php echo $folio_servicio;  ?>" size="20" maxlength="255" readonly="readonly" />
    </div></td>
  </tr>
  <tr>
    <td><div align="center">Cantidad</div></td>
    <td colspan="2"><div align="center">Tipo de servicio</div>      <div align="center"></div></td>
    <td><div align="center">Precio Unitario</div></td>
    <td><div align="center">Subtotal</div></td>
    <td><div align="center">Total</div></td>
  </tr>
  <tr>
    <td><div align="center">
      <input type="text" name="cantidad" size="15" maxlength="50"  id="cantidad" onkeypress="return acceptNum(event)" autocomplete="off" class="itext" value="<?php echo $cantidad; ?>"  onchange="calcula_total()" onkeyup="calcula_total()">
    </div></td>
    <td colspan="2"><div align="center">
      <?php
    get_tipo_servicios_m($id_tipo_servicio);
    ?>
  </div>      <div align="center"></div></td>
    <td><div align="center">
      <input type="text" name="precio_u" size="15" maxlength="50"  id="precio_u" onkeypress="return acceptNum(event)" autocomplete="off" class="itext" value="<?php echo  number_format($precio_u,2); ?>" onchange="calcula_total()" onkeyup="calcula_total()">
    </div></td>
    <td><div align="center">
      <input type="text" name="subtotal" size="15" maxlength="50"  id="subtotal" onkeypress="return acceptNum(event)" autocomplete="off" class="itext" value="<?php echo number_format($subtotal,2); ?>" readonly="readonly">
    </div></td>
    <td><div align="center">
      <input type="text" name="total" size="15" maxlength="50"  id="total" onkeypress="return acceptNum(event)" autocomplete="off" class="itext" value="<?php echo  number_format($total,2); ?>" readonly="readonly">
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">Observaciones</div></td>
    <td rowspan="2"><div align="center">
      <?php 

$img='<img src="../images/excel.png" alt="Recibo orden de servicio"  title="Recibo orden de servicio" width="40px" height="40px">';

echo '<a href="../reportes/orden_servicio.php?id_servicio='.$id_servicio.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?>
    </div></td>
    <td rowspan="2"><div align="center">
      <input class="ibutton" type="button" name="nuevo2" id="nuevo" value="NUEVO SERVICIO"  onclick="update_nuevo_servicio(3); return false" />
    </div></td>
    <td rowspan="2"><div align="center">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">
      <textarea name="observaciones" class="itextarea"><?php echo nom($observaciones); ?></textarea>
    </div></td>
    </tr>
</table>

</form>

