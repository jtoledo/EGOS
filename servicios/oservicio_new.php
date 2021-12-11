<form name="captura" action="" onSubmit="guarda_oservicio(2); return false" class="formu">  
<table width="80%" border="0" align="center">
  <tr>
    <td colspan="6"><li class="iheader">
		  <div id="carga"></div>
		<h2 class="art-logo-text">
	OTROS SERVICIOS</h2>
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
      <?php get_oservicios_cliente_select($idcliente); ?>
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
    get_clientes_oservicios_m($idcliente);
    ?>
    </span></div></td>
    <td><div align="center">
      <input name="fecha_servicio" type="text" id="fecha_servicio" onclick="popUpCalendar(this, captura.fecha_servicio, 'dd-mm-yyyy');"  value="<?php echo $fecha_servicio; ?>" readonly="readonly" class="itext" />
    </div></td>
    <td colspan="2"><div align="center">
      <input name="folio_servicio" type="text" class="folio" id="folio_servicio" onchange="conMayusculas(this)" value="<?php echo $folio;  ?>" size="20" maxlength="255" readonly="readonly" />
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
      <input type="text" name="cantidad" size="15" maxlength="50"  id="cantidad" onkeypress="return acceptNum(event)" autocomplete="off" class="itext"  onchange="calcula_total()" onkeyup="calcula_total()">
    </div></td>
    <td colspan="2"><div align="center">
      <?php
    get_tipo_oservicios($id_tipo_servicio);
    ?>
  </div>      <div align="center"></div></td>
    <td><div align="center">
      <input type="text" name="precio_u" size="15" maxlength="50"  id="precio_u" onkeypress="return acceptNum(event)" autocomplete="off" class="itext" onchange="calcula_total()" onkeyup="calcula_total()">
    </div></td>
    <td><div align="center">
      <input type="text" name="subtotal" size="15" maxlength="50"  id="subtotal" onkeypress="return acceptNum(event)" autocomplete="off" class="itext" readonly="readonly">
    </div></td>
    <td><div align="center">
      <input type="text" name="total" size="15" maxlength="50"  id="total" onkeypress="return acceptNum(event)" autocomplete="off" class="itext" readonly="readonly">
    </div></td>
  </tr>
  <tr>
    <td><div align="center">Nota de entrada</div></td>
    <td colspan="3"><div align="center">Observaciones</div></td>
    <td rowspan="2" valign="center"><div align="center">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
    </td>
  </tr>
  <tr>
	 <td valign="top">
	 <div id="notas_e" name="notas_e">
		 <?php
    			get_notas_entradade_servicio($idcliente,"",$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);
    	 ?> 
	 </div>	 
	 <!--<input name="nt_asociada" type="text" class="itext" id="nt_asociada" onchange="conMayusculas(this)" size="20" maxlength="10" />
	 -->
	 </td>    
    <td colspan="3"><div align="center">
      <textarea name="observaciones" class="itextarea"></textarea>
    </div></td>
    </tr>
</table>

</form>
