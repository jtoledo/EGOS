<?php
if(isset($idcliente))
{
	
	//if(isset($_SESSION["idparcelas"]))
	
unset($_SESSION["refe"]);
unset($_SESSION["refe_per"]);	
unset($_SESSION["idparcelas"]);	
unset($_SESSION["garantia_prendaria"]);	
unset($_SESSION["garantia_hipotecaria"]);	
	
$fecha=date("d-m-Y");
	$fila_tipo=get_tipo_cliente($idcliente);
	if($fila_tipo==2)//QUIERE DECIR QUE ES UN TIPO DE CLIENTE PROVEEDOR
	{
	exit("<strong>Este cliente es Proveedor y no tiene permisos para crear una solicitud de credito</strong>");
	}
	$fila_get_grupo=get_grupo_sol($idcliente);
	if($fila_get_grupo!=0)
	$grupo=$fila_get_grupo["grupo"];
	else
	$grupo="SIN GRUPO";

?>
<form name="captura" action="" onSubmit="valida_solicitudes(2); return false" class="formu">  

<table width="100%" border="0">
  <tr>
    <td colspan="10"><li class="iheader">
		  <div id="carga"></div>
		<h2 class="art-logo-text">
	SOLICITUDES DE CR&Eacute;DITO</h2>
	</li></td>
  </tr>
  <tr>
    <td colspan="9" rowspan="2" valign="bottom"><span class="cliente">
      <?php update_sol_modif($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']); ?>
    </span></td>
    <td width="22%" valign="bottom"><div align="center">Folio</div></td>
    </tr>
  <tr>
    <td valign="bottom"><div align="center">
      <input name="folio" type="text" class="peque" id="folio" onchange="conMayusculas(this)" value="<?php echo $folio;  ?>" size="20" maxlength="255" readonly="readonly">
    </div></td>
  </tr>
  <tr>
    <td width="22" colspan="2"><div align="left">Nombre Asesor</div></td>
    <td width="1%" rowspan="2"><div align="left">
      <input type="radio" name="individual" value="1" checked="checked">
    </div></td>
    <td width="7%" rowspan="2">Individual</td>
    <td width="7%" rowspan="2"><div align="left">
      <input type="radio" name="individual" value="2" disabled>
    </div></td>
    <td width="11" colspan="2" rowspan="2">Grupal</td>
    <td colspan="2"><div align="center">Nombre de Grupo</div></td>
    <td><div align="center">Fecha</div></td>
  </tr>
  <tr>
    <td colspan="2"><input name="nom_asesor" type="text" class="modif" id="nom_asesor" onchange="conMayusculas(this)" value="<?php echo $nom_asesor;  ?>" size="20" maxlength="255" readonly="readonly"></td>
    <td colspan="2"><div align="center">
      <input name="grupo" type="text" class="modif" id="grupo" onchange="conMayusculas(this)" value="<?php echo $grupo;  ?>" size="20" maxlength="255" disabled="disabled">
    </div></td>
    <td><div align="center">
      <input name="fecha_registro" type="text" id="fecha_registro" onclick="popUpCalendar(this, captura.fecha_registro, 'dd-mm-yyyy');"  value="<?php echo $fecha; ?>" readonly="readonly" class="itext">
    </div></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2">*Nombre Solicitante</td>
    <td colspan="5"></td>
    <td width="16%" rowspan="2"><div align="center">*Giro</div></td>
    <td colspan="2" rowspan="2"><div align="center">*Destino</div>      <div align="center"></div></td>
    </tr>
  <tr>
    <td colspan="5"><div align="center">*Experiencia / a&ntilde;os</div></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2">
    <span class="clientes_sol">
    <?php
    get_clientes_sol_m($idcliente);
    ?>
    </span>
    </td>
    <td colspan="5">
      </td>
    <td width="16%" rowspan="2"><div align="center">
      <?php
    get_giro_sol();
    ?>
    </div></td>
    <td colspan="2" rowspan="2"><div align="center">
      <input name="destino" type="text" class="modif" id="destino" onchange="conMayusculas(this)" value="<?php echo $destino;  ?>" size="20" maxlength="255" />
    </div></td>
    </tr>
  <tr>
    <td colspan="5"><div align="center">
      <input name="experiencia" type="text" class="peque" id="experiencia" onchange="conMayusculas(this)" size="20"  onkeypress="return acceptNum(event)" maxlength="2" />
    </div></td>
  </tr>
  <tr>
    <td colspan="2" align="left">U. economica a financiar      </td>
    <td colspan="5"></td>
    <td>&nbsp;</td>
    <td width="14%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left"><?php get_parcela_m($idcliente); ?></td>
    <td colspan="2"><div id="add_parcela"></div></td>
    <td colspan="4">
    
    <div id="add_parcela_select">
    <select  name="id_parcelas" id="id_parcelas" class='iselect'>
    <option value="">Parcelas Seleccionadas</option>
    </select>
    </div>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2">*Producto Financiero</td>
    <td colspan="5">*Concepto de Inversi&oacute;n</td>
    <td><div align="center">*Monto Rec. Propio</div></td>
    <td><div align="center">*Monto Parafinanciera</div></td>
    <td>Sup. Cultivada Total</td>
    
    </tr>
  <tr>
    <td colspan="2"><?php
    get_productos_sol();
    ?></td>
    <td colspan="5"><?php
    get_concepinv_sol();
    ?></td>
    <td>
    <div id="update_monto">
    <input name="monto" type="text" class="itext" id="monto" onchange="conMayusculas(this)" value="" size="20" maxlength="255"  onkeypress="return acceptNum(event)" />
    </div>
    
    </td>
	
	 <td>
    <div id="update_monto">
    <input name="monto_parafinanciera" type="text" class="itext" id="monto_parafinanciera" onchange="conMayusculas(this)" value="" size="20" maxlength="255"  onkeypress="return acceptNum(event)" />
    </div>
    
    </td>    
    
    
    <td>
    
    <div id="sc_t" align="center">
    <input name="sc_total" type="text" class="itext" id="sc_total" onchange="conMayusculas(this)" size="20" maxlength="255"  onkeypress="return acceptNum(event)" value="<?php $sc_total; ?>" readonly="readonly">
    </div>
    </tr>
	<tr>
		<td>*Paquete tecnol&oacute;gico</td>
	</tr>	
	<tr>     
    </td>
    <td><?php
    get_paquete_sol($idcliente);
    ?></td>
   </tr>
  <tr>
    <td colspan="2"><div align="left">Ingreso por Cosecha</div></td>
    <td colspan="8" rowspan="2"><div align="center">
      <h2 class="art-logo-text"> 
       
        Garant&iacute;as </h2>
    </div></td>
    </tr>
  <tr>
    <td colspan="2" align="right"><div align="left" id="ingreso_cosecha">
      <input name="ingre_cosecha" type="text" class="itext" id="ingre_cosecha" onchange="conMayusculas(this)" value="<?php echo $ingre_cosecha;  ?>" size="20" maxlength="255" onkeypress="return acceptNum(event)"  readonly="readonly">
    </div></td>
    </tr>
  <tr>
    <td colspan="2" rowspan="3"><div align="left">Costo por cosecha</div></td>
    <td colspan="6"><div align="center"><strong>Prendarias</strong></div></td>
    <td colspan="2"><div align="center"><strong>Hipotecaria</strong></div></td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td colspan="3"><div align="center">Propio</div></td>
    <td colspan="2"><div align="center">Aval</div></td>
    <td><div align="center">Propio</div></td>
    <td><div align="center">Aval</div></td>
    </tr>
  <tr>
    <td colspan="3"><div align="center">
      <input name="propio" type="radio" value="1"  onchange='update_g_p(this.value,<?php echo $idcliente; ?>); return false' checked="checked" >
    </div></td>
    <td colspan="2"><div align="center">
      <input name="propio" type="radio" value="2" onchange='update_g_p(this.value,<?php echo $idcliente; ?>); return false'>
    </div></td>
    <td><div align="center">
      <input name="propio_h" type="radio" onchange="update_g_p(this.value,<?php echo $idcliente; ?>); return false" value="4" checked="checked" />
    </div></td>
    <td><div align="center">
      <input name="propio_h" type="radio" onchange="update_g_p(this.value,<?php echo $idcliente; ?>); return false" value="5" />
    </div></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2"><div align="left" id="costo_cosecha">
      <input name="costo_cosecha" type="text" class="itext" id="costo_cosecha" onchange="conMayusculas(this)" value="<?php echo $costo_cosecha;  ?>" size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">
      </div></td>
    <td colspan="6"><div id="cliente_aval">
      
    </div></td>
    <td colspan="2">
    
    <div id="cliente_aval_h">
      
    </div>
    </td>
  </tr>
  <tr>
    <td colspan="6"><div align="center" id="update_garantias_p">
      <?php
    get_g_p_propia($idcliente);
    ?>
    </div></td>
    <td colspan="2">
	<div align="center" id="update_garantias_h">
	<?php
    get_g_h_propia($idcliente);
    ?>
    </div>
    </td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2"><div align="left">Ingreso Bruto</div></td>
    <td colspan="6">
    
    <div id="gara_add_p" align="center">
    <select name="idgtiap_sele" class="modif">
      <option value="">Ver Garantias Seleccionadas</option>
    </select>
    </div>
    </td>
    <td colspan="2">
     <div id="hipo_add_h" align="center">
    
    <select name="idgtiah" class="modif">
      <option value="">Ver Garantias Seleccionadas</option>
    </select>
    
    </div>
    </td>
    </tr>
  <tr>
    <td colspan="8"></td>
    </tr>
  <tr>
    <td colspan="2" rowspan="2"><div align="left" id="ingreso_bruto">
      <input name="ingre_bruto" type="text" class="itext" id="ingre_bruto" onchange="conMayusculas(this)" value="<?php echo $ingre_bruto;  ?>" size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">
    </div></td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td colspan="2"><div align="center">Porcentaje de Garant&iacute;a L&iacute;quida</div></td>
    <td rowspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input name="gar_liq_porcentaje" type="text" class="peque" id="gar_liq_porcentaje" onchange="conMayusculas(this)" value="" size="20" maxlength="2"  onkeypress="return acceptNum(event)" />
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="left">(-) Otros gastos</div></td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="left">
      <input name="otrosgastos" type="text" class="itext" id="otrosgastos"  value="" size="20" maxlength="255" onkeypress="return acceptNum(event)" onChange="update_monto()">
    </div></td>
    <td>Describa</td>
    <td colspan="5"><div align="left">
      <input name="descripcionotrosgts" type="text" class="itext" id="descripcionotrosgts" onchange="conMayusculas(this)" value="<?php echo $descripcionotrosgts;  ?>" size="20" maxlength="255" />
    </div></td>
    <td><div align="right">
      <?php
	  $img=' <img src="../images/modif.png" width="32" heigth="32">';	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"referencias('".$idcliente."')\" >".$img."</a>";
 ?>
    </div></td>
    <td colspan="2"><div align="center" id="update_ref_banco">
      <select name="refe" class="modif">
        <option value="">Referencias Bancarias</option>
      </select>
    </div></td>
    </tr>
  <tr>
    <td colspan="2"><div align="left">(+) Otros Ingresos</div></td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td><div align="left">
      <input name="otrosingresos" type="text" class="itext" id="otrosingresos"   size="20" maxlength="255" onkeypress="return acceptNum(event)" onChange="update_monto()">
    </div></td>
    <td>Describa</td>
    <td colspan="5"><div align="left">
      <input name="descripcionotrosing" type="text" class="itext" id="descripcionotrosing" onchange="conMayusculas(this)" value="<?php echo $descripcionotrosing;  ?>" size="20" maxlength="255" />
    </div></td>
    <td><div align="right">
      <?php
	  $img=' <img src="../images/modif.png" width="32" heigth="32">';	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"referencias_per('".$idcliente."')\" >".$img."</a>";
 ?>
    </div></td>
    <td colspan="2"><div align="center" id="update_ref_per">
      <select name="refe_per" class="modif">
        <option value="">Referencias Personales</option>
      </select>
    </div></td>
    </tr>
  <tr>
    <td colspan="2"><div align="left"><strong>Ingreso Neto</strong></div></td>
    <td colspan="6">Tipo de solicitud </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="left" id="ingreso_neto">
      <input name="ingre_neto" type="text" class="itext" id="ingre_neto" onchange="conMayusculas(this)" value="<?php echo $ingre_neto;  ?>" size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">
    </div></td>
    <td colspan="6"><select name="t_sol" class="modif">
      <option value="">Seleccione </option>
      <option value="1">Cr&eacute;dito dentro de la organizaci&oacute;n</option>
      <option value="2">Cr&eacute;dito fuera de la organizaci&oacute;n</option>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td colspan="6">&nbsp;</td>
    <td rowspan="2"><div align="center">
      <!--<input name="validar" type="submit" class="ibutton" id="validar" value="VALIDAR" />-->
    </div></td>
    <td rowspan="2"><div align="center">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" >
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td colspan="5" rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

<?php
}
else
{
	include("inicia_solicitud.php");
}
?>