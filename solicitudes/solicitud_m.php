<?php
if($modif!=1)
{
$fila=get_solicitud();  //cuando no hay una consulta determinada se consulta la primera solicitud
}
$idsolicitud=$fila["idsolicitud"];
$idcliente=$fila["idcliente"];
$idgiro=$fila["idgiro"];
$idproducto=$fila["idproducto"];
$folio=$fila["folio"];
$fecha_registro=$fila["fecha_registro"];
$monto=$fila["monto"];
$monto_finan=$fila["monto_parafinanciera"];
$experiencia=$fila["experiencia"];
$destino=$fila["destino"];
$idpromotor=$fila["idpromotor"];  //promotor que creo la solicitud
$gar_liq_porcentaje=$fila["gar_liq_porcentaje"];
$idcon_inv=$fila["idcon_inv"];
$id_paquete=$fila["id_paquete"];
$otrosgastos=$fila["otrosgastos"];
$descripcionotrosgts=$fila["descripcionotrosgts"];
$otrosingresos=$fila["otrosingresos"];
$descripcionotrosing=$fila["descripcionotrosing"];
$ids_parcelas=$fila["ids_parcelas"];
$ids_gara_prendarias=$fila["ids_gara_prendarias"];
$ids_gara_hipotecarias=$fila["ids_gara_hipotecarias"];
$t_sol=$fila["t_sol"];
$nom_asesor=get_asesor_sol($idpromotor);


unset($_SESSION["refe"]);
unset($_SESSION["refe_per"]);	
unset($_SESSION["idparcelas"]);	
unset($_SESSION["garantia_prendaria"]);	
unset($_SESSION["garantia_hipotecaria"]);	


$_SESSION["refe"]=asigna_referencia_bancaria($idsolicitud);
$_SESSION["refe_per"]=asigna_referencia_personal($idsolicitud);


//PROCESO DE LAS PARCELAS Y COSTOS DE LA COSECHA
$array_parcelas = explode("-",$ids_parcelas);
$array_parcelas=array_filter($array_parcelas);//quita cedenas vacias
$array_gtias_prendarias = explode("-",$ids_gara_prendarias);
$array_gtias_prendarias=array_filter($array_gtias_prendarias);//quita cedenas vacias
$array_gtias_hipotecarias = explode("-",$ids_gara_hipotecarias);
$array_gtias_hipotecarias=array_filter($array_gtias_hipotecarias);//quita cedenas vacias

	$_SESSION['idparcelas']=$ids_parcelas; 	
	$_SESSION['garantia_prendaria']=$ids_gara_prendarias;	
	$_SESSION['garantia_hipotecaria']=$ids_gara_hipotecarias;

		$super_total=get_superficie_cultivada_total($array_parcelas);  
		$costo_cultivo_m2=get_costo_cultivo($id_paquete); //se obtiene la suma total de requerimientos por m2
		$suma_parcelas_m2=get_parcelas_m2($array_parcelas);// se obtiene las suma de todas las parcelas en  m2
		$costo_cultivo_total=$suma_parcelas_m2*$costo_cultivo_m2;
		$ingreso_por_hect=get_ingreso_xhec($id_paquete);  //inreso por hectaria recuperacion de la tabla de paquete-tec
		$ingreso_por_m2=$ingreso_por_hect/10000; //ingreso por en m2
		$super_total_cult=$suma_parcelas_m2*$ingreso_por_m2;
		$ingreso_bruto=$super_total_cult-$costo_cultivo_total;
		$porcentaje_liq=get_liquidez($idcliente);
		//$monto=($ingreso_bruto*$porcentaje_liq)/100;
		$ingreso_neto=$ingreso_bruto-$otrosgastos;
		$ingreso_neto=$ingreso_neto+$otrosingresos;
//TERMINA PROCESO DE LAS PARCELAS
	
		
	
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
<form name="captura" action="" onSubmit="valida_solicitudes(1); return false" class="formu" >  
<input type="hidden" name="idsolicitud" id="idsolicitud" value="<?php echo $idsolicitud; ?>" />

<table width="100%" border="0">
  <tr>
    <td colspan="10">
    <div id="carga"></div>
    <li class="iheader">
		 
		<h2 class="art-logo-text">
	EDICI&Oacute;N DE SOLICITUDES DE CR&Eacute;DITO</h2>
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
      <input name="folio" type="text" class="folio" id="folio" onchange="conMayusculas(this)" value="<?php echo $folio;  ?>" size="20" maxlength="255" readonly="readonly">
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
      <input name="fecha_registro" type="text" id="fecha_registro" onclick="popUpCalendar(this, captura.fecha_registro, 'dd-mm-yyyy');"  value="<?php echo $fecha_registro; ?>" readonly="readonly" class="itext">
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
    get_giro_sol_m($idgiro);
    ?>
    </div></td>
    <td colspan="2" rowspan="2"><div align="center">
      <input name="destino" type="text" class="modif" id="destino" onchange="conMayusculas(this)" value="<?php echo $destino;  ?>" size="20" maxlength="255" />
    </div></td>
    </tr>
  <tr>
    <td colspan="5"><div align="center">
      <input name="experiencia" type="text" class="peque" id="experiencia" onchange="conMayusculas(this)"  onkeypress="return acceptNum(event)" value="<?php echo $experiencia; ?>" size="20" maxlength="2" />
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
    <td colspan="6">
      
      <div id="add_parcela_select">
        <?php get_parcelas_add_m($array_parcelas,$idcliente); ?>
        </div>
    </td>
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
    get_productos_sol_m($idproducto);
    ?></td>
    <td colspan="5"><?php
    get_concepinv_sol_m($idcon_inv);
    ?></td>
    <td>
    <div id="update_monto">
    <input name="monto" type="text" class="itext" id="monto" onchange="conMayusculas(this)" value="<?php echo number_format($monto,2); ?>" size="20" maxlength="255"  onkeypress="return acceptNum(event)" />
    </div>
    
    </td>
    
    <td>
    <div id="update_monto_parafinanciera">
    <input name="monto_parafinanciera" type="text" class="itext" id="monto_parafinanciera" onchange="conMayusculas(this)" value="<?php echo number_format($monto_finan,2); ?>" size="20" maxlength="255"  onkeypress="return acceptNum(event)" />
    </div>
    
    </td>
    
    <td>
    
    <div id="sc_t" align="center">
    <input name="sc_total" type="text" class="itext" id="sc_total" onchange="conMayusculas(this)" size="20" maxlength="255"  onkeypress="return acceptNum(event)" value="<?php echo $super_total; ?>" readonly="readonly">
    </div>
   
    </td>
  </tr>
	<tr>
		<td>*Paquete tecnol&oacute;gico</td>
	</tr>  
  <tr>
    <td><?php
    get_paquete_sol_m($id_paquete,$idcliente);
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
      <input name="ingre_cosecha" type="text" class="itext" id="ingre_cosecha" onchange="conMayusculas(this)" value="<?php echo number_format($super_total_cult,2);?>" size="20" maxlength="255" onkeypress="return acceptNum(event)"  readonly="readonly">
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
      <input name="costo_cosecha" type="text" class="itext" id="costo_cosecha" onchange="conMayusculas(this)" value="<?php echo number_format($costo_cultivo_total,2);  ?>" size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">
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
    <?php get_gara_p_selecc($array_gtias_prendarias) ?>
    </div>
    </td>
    <td colspan="2">
     <div id="hipo_add_h" align="center">
    
  <?php  get_gara_h_selecc($array_gtias_hipotecarias); ?>
    
    </div>
    </td>
    </tr>
  <tr>
    <td colspan="8"></td>
    </tr>
  <tr>
    <td colspan="2" rowspan="2"><div align="left" id="ingreso_bruto">
      <input name="ingre_bruto" type="text" class="itext" id="ingre_bruto" onchange="conMayusculas(this)" value="<?php echo number_format($ingreso_bruto,2);  ?>" size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">
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
      <input name="gar_liq_porcentaje" type="text" class="peque" id="gar_liq_porcentaje" onchange="conMayusculas(this)"  size="20" maxlength="2"  onkeypress="return acceptNum(event)" value="<?php echo $gar_liq_porcentaje; ?>">
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="left">(-) Otros gastos</div></td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="left">
      <input name="otrosgastos" type="text" class="itext" id="otrosgastos" size="20" maxlength="255" onkeypress="return acceptNum(event)" onChange="update_monto()" value="<?php echo number_format($otrosgastos,2); ?>">
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
      
	  <?php
	  if(isset($_SESSION["refe"])) { consul_refe_sol($_SESSION["refe"]); }
	  else
	  {
	  ?>
      <select name="refe" class="modif">
        <option value="">Referencias Bancarias</option>
      </select>
      <?php
	  }
	  ?>
      
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="left">(+) Otros Ingresos</div></td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td><div align="left">
      <input name="otrosingresos" type="text" class="itext" id="otrosingresos"   size="20" maxlength="255" onkeypress="return acceptNum(event)" onChange="update_monto()" value="<?php echo number_format($otrosingresos,2); ?>">
    </div></td>
    <td>Describa</td>
    <td colspan="5"><div align="left">
      <input name="descripcionotrosing" type="text" class="itext" id="descripcionotrosing" onchange="conMayusculas(this)" value="<?php echo $descripcionotrosing;  ?>" size="20" maxlength="255" />
    </div></td>
    <td>
      <div align="right" >
        <?php
	  $img=' <img src="../images/modif.png" width="32" heigth="32">';	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"referencias_per('".$idcliente."')\" >".$img."</a>";
 ?>
      </div></td>
    <td colspan="2"><div align="center" id="update_ref_per">
       <?php
	  if(isset($_SESSION["refe_per"])) { consul_refe_per_sol($_SESSION["refe_per"]); }
	  else
	  {
	  ?>
      <select name="refe_per" class="modif">
        <option value="">Referencias Personales</option>
      </select>
      <?php
	  }
	  ?>
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
      <input name="ingre_neto" type="text" class="itext" id="ingre_neto" onchange="conMayusculas(this)" value="<?php echo number_format($ingreso_neto,2);  ?>" size="20" maxlength="255" onkeypress="return acceptNum(event)" readonly="readonly">
    </div></td>
    <td colspan="6" align="left">
    
    <select name="t_sol" class="modif">
      <option value="">Seleccione </option>
      <?php if($t_sol==1){$a="selected='selected'";}if($t_sol==2){$b="selected='selected'";} ?>
      
      <option value="1"<?php echo $a; ?>>Cr&eacute;dito dentro de la organizaci&oacute;n</option>
      <option value="2" <?php echo $b; ?>>Cr&eacute;dito fuera de la organizaci&oacute;n</option>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">	</td>
    <td colspan="6">&nbsp;</td>
    <td rowspan="2"><div align="center">
      <!--<input name="validar" type="submit" class="ibutton" id="validar" value="VALIDAR" />
      <input class="ibutton" type="button" name="nuevo2" id="nuevo" value="NUEVA SOLICITUD"  onclick="actualiza_sol_nuevo(<?php echo $idcliente; ?>); return false" />
-->   
    </div></td>
    <td rowspan="2"><div align="center">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" >
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td colspan="5" rowspan="2">&nbsp;</td>
    <td rowspan="2"><div align="center">
      <?php 

$img='<img src="../images/excel.png" alt="Reporte de Solicitud"  title="Reporte de Solicitud">';

echo '<a href="../reportes/reporte_solicitud.php?idsolicitud='.$idsolicitud.'" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?>
    </div></td>
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
