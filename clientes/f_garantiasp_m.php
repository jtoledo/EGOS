<?php
if($modif==1)
	{
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_prendarias where idcliente='$idcliente'  order by descripcion desc";
	   $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		$idcliente=$fila["idcliente"];	 
		$idgtia=$fila["idgtia"];
	 
		 $descripcion=$fila["descripcion"];
		 $valor=$fila["valor"];
		 $fregistro=$fila["fregistro"];  //fecha de valuacion
		 
		 $marca=$fila["marca"];
		 $modelo=$fila["modelo"];
		 $estado_actual=$fila["estado_actual"]; 
		 $valuador=$fila["valuador"];
		 
		 $no_serie=$fila["no_serie"];
		 
		 $no_factura=$fila["no_factura"];
		 $f_factura=$fila["f_factura"];
		 
		}
		
	
	}

$diar=dia($f_factura);
$mesr=mes($f_factura);
$anor=ano($f_factura);

?>
<form name="captura" action="" onSubmit="garantiasp_alta_egos(1); return false" class="formu">  
<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>" />
<input type="hidden" name="idgtia" value="<?php echo $idgtia; ?>" />

<table width="547" border="0">
  <tr>
    <td colspan="8"><li class="iheader">
		 
		 <?php
		  $img="<img src='../images/back.png' name='atras' alt='atras' align='absmiddle'> ";	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"atras_cliente('".$idcliente."')\">"


.$img.


"</a>";
	 
echo "".nom($nom_completo); 		 
?>		 
		 
		 </li></td>
  </tr>
  <tr>
    <td colspan="8"><span class="hipote">
    <select name="idgtias" class="consultor2" onchange="actualiza_garantiap_selec(1); return false">
                 <option value="">Seleccione Garant&iacute;a Prendarias</option>
      
      <?php
		  
		  
		  $consulta_c="SELECT * FROM cc_gtias_prendarias where idcliente='$idcliente' order by descripcion ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						$desc= limitarPalabras($fila_c["descripcion"],15);
						?>	
      
      <option value="<?php echo $fila_c["idgtia"]?>"><?php echo nom(utf8_decode($desc)); ?></option>	
      
      <?php
						
						}
		  
		  
	  ?>      
    </select> 
</span></td>
  </tr>
  <tr>
    <td colspan="8">Descripci&oacute;n</td>
  </tr>
  <tr>
    <td colspan="8"><textarea class="itextarea_descrip" name="descripcion" id="YourMessage" onChange="conMayusculas(this)"><?php echo $descripcion; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="5">Valor  comercial $</td>
    <td width="146">Fecha&nbsp; de Valuaci&oacute;n</td>
    <td colspan="2">Valuador</td>
    </tr>
  <tr>
    <td colspan="5"><input name="valor" type="text" class="itext" id="valor" value="<?php echo $valor; ?>" onkeypress="return acceptNum(event)"></td>
    <td><input name="fregistro" type="text" id="dateArrivals" onclick="popUpCalendar(this, captura.dateArrivals, 'dd-mm-yyyy');"  value="<?php echo $fregistro; ?>" readonly="readonly" class="itext" /></td>
    <td colspan="2"><input name="valuador" type="text" id="valuador"   value="<?php echo $valuador; ?>"  class="modif"  onChange="conMayusculas(this)"></td>
    </tr>
  <tr>
    <td colspan="8"><p><strong>DATOS DEL BIEN :</strong></p></td>
  </tr>
  <tr>
    <td colspan="4">Marca</td>
    <td colspan="2">Modelo</td>
    <td colspan="2">Estado  actual</td>
    </tr>
  <tr>
    <td colspan="4"><input type="text" name="marca" size="20" maxlength="255" id="marca" value="<? echo $estado_actual; ?>" class="modif" onChange="conMayusculas(this)"></td>
    <td colspan="2"><input type="text" name="modelo" size="20" maxlength="255" id="modelo" value="<? echo $modelo; ?>" class="itext" onChange="conMayusculas(this)"></td>
    <td colspan="2"><input type="text" name="estado_actual" size="20" maxlength="255" id="estado_actual" value="<? echo $estado_actual; ?>" class="modif" onChange="conMayusculas(this)"></td>
    </tr>
  <tr>
    <td width="120">No.  de serie </td>
    <td colspan="3">Fecha  Factura</td>
    <td colspan="2">Num. De Factura</td>
    <td colspan="2"><p>&nbsp;</p></td>
    </tr>
  <tr>
    <td><input type="text" name="no_serie" size="20" maxlength="255" id="no_serie" value="<? echo $no_serie; ?>" class="itext" onChange="conMayusculas(this)"></td>
    <td width="55"><select name="dia" id="dia" >
      <option value="">dia</option>
      <?php
for($i=01;$i<32;$i++)
{
if($diar==$i)
echo '<option value="'.$i.'" selected=selected>'.$i.'</option>';
else
echo '<option value="'.$i.'">'.$i.'</option>';

}
?>
    </select></td>
    <td width="62"><select name="mes" id="mes">
      <option value="">mes</option>
      <?php
for($i=01;$i<13;$i++)
{
if($mesr==$i)
echo '<option value="'.$i.'" selected=selected>'.$i.'</option>';
else
echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
    </select></td>
    <td width="59"><select name="ano" id="ano">
      <option value="">a&ntilde;o</option>
      <?php
for($i=1930;$i<2013;$i++)
{
if($anor==$i)
echo '<option value="'.$i.'" selected=selected>'.$i.'</option>';
else
echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
    </select></td>
    <td colspan="2"><input name="no_factura" type="text" class="itext" id="no_factura" value="<?php echo $no_factura; ?>"  onChange="conMayusculas(this)"></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="7"><div align="right">
      <input class="ibutton" type="button" name="nuevo" id="enviare" value="AGREGAR"  onclick="nuevo_gtiasp('<?php echo $idcliente; ?>','1'); return false" />
    </div></td>
    <td width="141"><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
    </div></td>
  </tr>
</table>
</form>


 