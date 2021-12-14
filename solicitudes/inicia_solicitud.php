<?php
$fecha=date("d-m-Y");
?>
<form name="captura" action="" onSubmit="grupo_alta_egos(2); return false" class="formu">  
<table width="100%" border="0">
  <tr>
    <td colspan="9"><li class="iheader">
		 <div id="carga"></div> 
		<h2 class="art-logo-text">
	SOLICITUDES DE CR&Eacute;DITO	</h2>
	</li></td>
  </tr>
  <tr>
    <td colspan="8" rowspan="2" valign="bottom"><span class="cliente">
      <select name="idsolicitudes" class="modif" id="idsolicitudes" >
        <option value="">Seleccione Solicitud</option>
       
        </select>
    </span></td>
    <td width="22%" valign="bottom"><div align="center">Folio</div></td>
    </tr>
  <tr>
    <td valign="bottom"><div align="center">
      <input name="folio" type="text" disabled="disabled" class="peque" id="folio" onchange="conMayusculas(this)" size="20" maxlength="255">
    </div></td>
  </tr>
  <tr>
    <td width="22%" colspan="2"><div align="left">Nombre Asesor</div></td>
    <td width="1%" rowspan="2"><div align="left">
      <input type="radio" name="individual" value="1" checked="checked">
    </div></td>
    <td width="7%" rowspan="2">Individual</td>
    <td width="7%" rowspan="2"><div align="left">
      <input type="radio" name="individual" value="2" disabled>
    </div></td>
    <td width="11%" rowspan="2">Grupal</td>
    <td colspan="2"><div align="center">Nombre de Grupo</div></td>
    <td><div align="center">Fecha</div></td>
  </tr>
  <tr>
    <td colspan="2"><input name="nom_asesor" type="text" disabled="disabled" class="modif" id="nom_asesor" onchange="conMayusculas(this)" value="<?php echo $nom_asesor;  ?>" size="20" maxlength="255"></td>
    <td colspan="2"><div align="center">
      <input name="grupo" type="text" disabled="true" class="modif" id="grupo" onchange="conMayusculas(this)" size="20" maxlength="255">
    </div></td>
    <td><div align="center">
      <input name="fecha_registro" type="text" disabled="disabled" class="itext" id="fecha_registro" onclick="popUpCalendar(this, captura.fecha_registro, 'dd-mm-yyyy');">
    </div></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2">Nombre Solicitante</td>
    <td colspan="4">U. economica a financiar</td>
    <td width="16%" rowspan="2"><div align="center">Experiencia / a&ntilde;os</div></td>
    <td width="14%" rowspan="2"><div align="center">Giro</div></td>
    <td rowspan="2"><div align="center">Destino</div></td>
  </tr>
  <tr>
    <td colspan="4"></td>
  </tr>
  <tr>
    <td colspan="2">
     <span class="clientes_sol">
    <?php
    get_clientes_sol();
    ?>
     </span>
    </td>
    <td colspan="4">
    
    <select  name="id_parcela" disabled="disabled" class='iselect' id="municipio" onchange='carga_select(this.id)'>
      <option value="">Selecciona Parcela</option>
    </select>
    </td>
    <td width="16%"><div align="center">
      <input name="experiencia" type="text" disabled="disabled" class="peque" id="experiencia" onchange="conMayusculas(this)"  onkeypress="return acceptNum(event)" size="20" maxlength="2">
    </div></td>
    <td width="14%"><?php
    get_giro_sol();
    ?></td>
    <td><input name="destino" type="text" disabled="disabled" class="itext" id="destino" onchange="conMayusculas(this)" size="20" maxlength="255" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4"><select  name="id_parcelas" disabled="disabled" class='iselect' id="municipio5" onchange='carga_select(this.id)'>
</select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Producto Financiero</td>
    <td colspan="4">Concepto de Inversi&oacute;n</td>
    <td><div align="center">Monto Solicitado</div></td>
    <td>Superficie Cultivada Total</td>
    <td>Paquete tecnologico</td>
    </tr>
  <tr>
    <td colspan="2"><?php
    get_productos_sol();
    ?></td>
    <td colspan="4"><?php
    get_concepinv_sol();
    ?></td>
    <td><input name="monto" type="text" disabled="disabled" class="itext" id="monto" onchange="conMayusculas(this)"  onkeypress="return acceptNum(event)" size="20" maxlength="255" /></td>
    <td><input name="superficie_productiva" type="text" disabled="disabled" class="itext" id="superficie_productiva" onchange="conMayusculas(this)"  onkeypress="return acceptNum(event)" size="20" maxlength="255" /></td>
    <td><?php
    get_paquete_sol_i();
    ?></td>
  </tr>
  <tr>
    <td colspan="2"><div align="left">Ingreso por cosecha</div></td>
    <td colspan="7" rowspan="2"><div align="center">
      <h2 class="art-logo-text"> Garant&iacute;as </h2>
    </div></td>
    </tr>
  <tr>
    <td colspan="2"><div align="left">
      <input name="ingre_cosecha" type="text" class="itext" id="ingre_cosecha" onchange="conMayusculas(this)" size="20" maxlength="255" onkeypress="return acceptNum(event)" />
    </div></td>
    </tr>
  <tr>
    <td colspan="2"><div align="left">Costo por cosecha</div></td>
    <td colspan="5"><div align="center">Prendaria</div></td>
    <td colspan="2"><div align="center">Hipotecaria</div></td>
    </tr>
  <tr>
    <td colspan="2"><div align="left">
      <input name="costo_cosecha" type="text" class="itext" id="costo_cosecha" onchange="conMayusculas(this)" size="20" maxlength="255" onkeypress="return acceptNum(event)" />
    </div></td>
    <td colspan="5"><div align="center">
      <select  name="idgtia" disabled="disabled" class='modif' id="id_parcelas" onchange='carga_select(this.id)'>
        </select>
    </div></td>
    <td colspan="2"><div align="center">
      <select  name="idgtiah" disabled="disabled" class='modif' id="id_parcelas2" onchange='carga_select(this.id)'>
      </select>
    </div></td>
    </tr>
  <tr>
    <td colspan="2"><div align="left">Ingreso Bruto</div></td>
    <td colspan="4">&nbsp;</td>
    <td rowspan="6">&nbsp;</td>
    <td rowspan="6">&nbsp;</td>
    <td rowspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="left">
      <input name="ingre_bruto" type="text" class="itext" id="ingre_bruto" onchange="conMayusculas(this)" size="20" maxlength="255" onkeypress="return acceptNum(event)">
    </div></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="left">(-) Otros gastos</div></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="left">
      <input name="otrosgastos" type="text" class="itext" id="otrosgastos" onchange="conMayusculas(this)" size="20" maxlength="255" onkeypress="return acceptNum(event)">
    </div></td>
    <td>Describa</td>
    <td colspan="4"><div align="left">
      <input name="descripcionotrosgts" type="text" class="itext" id="descripcionotrosgts" onchange="conMayusculas(this)" size="20" maxlength="255" />
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="left">(+) Otros Ingresos</div></td>
    <td colspan="4">&nbsp;</td>
    </tr>
  <tr>
    <td><div align="left">
      <input name="otrosingresos" type="text" class="itext" id="otrosingresos" onchange="conMayusculas(this)" size="20" maxlength="255" onkeypress="return acceptNum(event)">
    </div></td>
    <td>Describa</td>
    <td colspan="4"><div align="left">
      <input name="descripcionotrosing" type="text" class="itext" id="descripcionotrosing" onchange="conMayusculas(this)" size="20" maxlength="255" />
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="left"><strong>Ingreso Neto</strong></div></td>
    <td colspan="5">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="left">
      <input name="ingre_neto" type="text" class="itext" id="ingre_neto" onchange="conMayusculas(this)" size="20" maxlength="255" onkeypress="return acceptNum(event)">
    </div></td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td colspan="5">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td colspan="4" rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>