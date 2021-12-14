<?php
if($modif!=1)//MODIFICA REQUERIMIENTO EXISTENTE EN EL PAQUETE
{
$fila=get_requerimiento_paq($id_paquete); //OBTIENE LA CONSULTA DE REQUERIMIENTOS

$fila_paq=get_paquete_tec_m($id_paquete);//OBTIENE NOMBRE DEL PAQUETE

$id_conf_paq=$fila["id_conf_paq"];

}
else//para modificacion del mismo requerimiento
{
$fila=consul_requerimientos_paq($id_conf_paq); //OBTIENE LA CONSULTA DE REQUERIMIENTOS

$id_paquete=$fila["id_paquete"];

$fila_paq=get_paquete_tec_m($id_paquete);


//$id_conf_paq=$fila["id_conf_paq"];

}

$idrequerimiento=$fila["idrequerimiento"];
$idproceso=$fila["idproceso"];
$requerimiento=$fila["requerimiento"];
$iduni=$fila["iduni"];
$cantidad=$fila["cantidad"];
$ciclos=$fila["ciclos"];
$total_ciclos=$fila["total_ciclos"];
$un=$fila["un"];
$total=$fila["total"];
$porciento_produ=$fila["porciento_produ"];
$cuota_credi=$fila["cuota_credi"];
$aporta_produ=$fila["aporta_produ"];


 $nom_paquete=$fila_paq["nom_paquete"];



?>

<form name="captura" action=""    class="formu">
<input type="hidden" name="id_paquete" value="<? echo $id_paquete; ?>" />
<table width="808" border="0">
  <tr>
    <td><li class="iheader"><h2 class="art-logo-text"><?php 
	
	 $img="<img src='../images/back.png' name='atras' alt='atras' align='absmiddle'> ";	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"atras_paquete('".$id_paquete."')\">"


.$img.


"</a>";
	
	echo nom($nom_paquete); ?></h2></li></td>
    </tr>
  
  <tr>
    <td><div align="center">Requerimientos Disponibles
    </div></td>
    </tr>
  <tr>
    <td> <div id="reque">
      <div align="center">
         <?php consulta_requerimiento_paq($id_paquete); ?>
      </div>
    </div></td>
    </tr>
  </table>
</form>
<form name="reque" action="" onSubmit="add_reque_paq(1); return false"  class="formu">
      <input type="hidden" name="idrequerimiento" value="<? echo $idrequerimiento; ?>" />
	   <input type="hidden" name="idproceso" value="<? echo $idproceso; ?>" /> 
	   
	   <input type="hidden" name="id_paquete" value="<? echo $id_paquete; ?>" />
	   <input type="hidden" name="id_conf_paq" value="<? echo $id_conf_paq; ?>" />
	   

  <table width="808"  border="0">

  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Requerimiento</strong></td>
    <td colspan="5"><input name="requerimiento" type="text" class="modif" id="requerimiento" onChange="conMayusculas(this)" value="<?php echo $requerimiento; ?>"  size="20" maxlength="255" readonly="readonly"></td>
    <td></td>
  </tr>
  <tr>
    <td width="140"><div align="center"><strong>U de medida / Servicio </strong></div></td>
    <td width="87"><div align="center"><strong>Cantidad</strong></div></td>
    <td width="55"><div align="center"><strong>Ciclos</strong></div></td>
    <td width="86"><div align="center"><strong>Total ciclos </strong></div></td>
    <td width="52"><div align="center"><strong>$/UN</strong></div></td>
    <td width="58"><div align="center"><strong>$ Total </strong></div></td>
    <td width="70"><div align="center"><strong>Porciento Productor </strong></div></td>
    <td width="100"><div align="center"><strong>Cuota Cr&eacute;dito </strong></div></td>
    <td width="122"><div align="center"><strong>Aportaci&oacute;n Productor </strong></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <?php get_unidad_m($iduni); ?>
    </div></td>
    <td><input type="text" name="cantidad" size="20" maxlength="200" id="cantidad" class="peque" onkeypress="return acceptNum(event)" value="<?php echo $cantidad; ?>"     onchange="llenar_campo(); return false"></td>
    <td><input name="ciclos" type="text" class="peque" id="ciclos" onkeypress="return acceptNum(event)" value="<?php echo $ciclos; ?>" size="20" maxlength="200" onchange="llenar_campo(); return false"></td>
    <td><input name="total_ciclos" type="text" class="peque" id="total_ciclos" onkeypress="return acceptNum(event)" value="<?php echo $total_ciclos; ?>" size="20" maxlength="200" readonly="readonly"></td>
    <td><input name="un" type="text" class="peque" id="un" onkeypress="return acceptNum(event)" value="<?php echo $un; ?>" size="20" maxlength="200" onchange="llenar_campo(); return false"></td>
    <td><input name="total" type="text" class="peque" id="total" onkeypress="return acceptNum(event)" value="<?php echo $total; ?>" size="20" maxlength="200"  readonly="readonly"></td>
    <td><input name="porciento_produ" type="text" class="peque" id="porciento_produ" onkeypress="return acceptNum(event)" value="<?php echo $porciento_produ; ?>" size="20" maxlength="200" onchange="llenar_campo(); return false"></td>
    <td><input name="cuota_credi" type="text" class="peque" id="cuota_credi" onkeypress="return acceptNum(event)" value="<?php echo $cuota_credi; ?>" size="20" maxlength="200" readonly="readonly"></td>
    <td><input name="aporta_produ" type="text" class="peque" id="aporta_produ" onkeypress="return acceptNum(event)" value="<?php echo $aporta_produ; ?>" size="20" maxlength="200" readonly="readonly"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>	</td>
    <td colspan="3"><?php
	  get_paquete_reque($id_paquete); //OBTIENE LOS REQUERIMIENOS QUE ESTAN AGREAGADOS EN EL PAQUETE TEC..
	  ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td> <?php
	$img='<img src="../images/close.png" alt="elimina productores" style="WIDTH: 48px; HEIGHT: 48px">';

echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"elimina_reque_paq('".$id_conf_paq."','".$id_paquete."')\">"


.$img.


"</a>";
	  ?></td>
    <td>
      <div align="center">
        <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
        </div></td>
  </tr>
</table>

</form>



