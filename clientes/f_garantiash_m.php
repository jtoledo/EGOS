<?php
if($modif==1)
	{
	   $consulta=" SET datestyle TO postgres, dmy; SELECT * FROM cc_gtias_hipotecarias where idcliente='$idcliente'  order by descripcion desc";
	   $id_query = pg_query($con,$consulta);
	
	
		while( $fila= pg_fetch_array($id_query) )
		   {
	 
		$idcliente=$fila["idcliente"];	 
		$idgtia=$fila["idgtia"];
	 
		 $descripcion=$fila["descripcion"];
		 $valor=$fila["valor"];
		 $fvaluacion=$fila["fvaluacion"];
		 $registro=$fila["registro"];
		 $libro=$fila["libro"];
		 $tomo=$fila["tomo"]; 
		 $seccion=$fila["seccion"];
		 $volumen=$fila["volumen"];
		 $superficie=$fila["superficie"];
		 $fregistro=$fila["fregistro"];
		 $antecedentes=$fila["antecedentes"];
		
		}
		
	
	}

$diar=dia($fregistro);
$mesr=mes($fregistro);
$anor=ano($fregistro);

?>
<form name="captura" action="" onSubmit="garantiash_alta_egos(1); return false" class="formu">  
<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>" />
<input type="hidden" name="idgtia" value="<?php echo $idgtia; ?>" />

<table width="629" border="0">
  <tr>
    <td colspan="7"><li class="iheader">
		 
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
    <td colspan="7"><span class="hipote">
    <select name="idgtias" class="consultor2" onchange="actualiza_garantiah_selec(1); return false">
                 <option value="">Seleccione Garant&iacute;a Hipotecarias</option>
      
      <?php
		  
		  
		  $consulta_c="SELECT * FROM cc_gtias_hipotecarias where idcliente='$idcliente' order by descripcion ";
				
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
    <td colspan="7">Descripci&oacute;n</td>
  </tr>
  <tr>
    <td colspan="7"><textarea class="itextarea_descrip" name="descripcion" id="YourMessage" onChange="conMayusculas(this)"><?php echo $descripcion; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="4">Valor  comercial $</td>
    <td colspan="3">Fecha&nbsp; de Valuaci&oacute;n</td>
  </tr>
  <tr>
    <td colspan="4"><input name="valor" type="text" class="itext" id="valor" value="<?php echo $valor; ?>" onkeypress="return acceptNum(event)"></td>
    <td colspan="3"><input name="fvaluacion" type="text" id="dateArrivals" onclick="popUpCalendar(this, captura.dateArrivals, 'dd-mm-yyyy');"  value="<?php echo $fvaluacion; ?>" readonly="readonly" class="itext"></td>
  </tr>
  <tr>
    <td colspan="7"><p><strong>Datos del RPP:</strong></p></td>
  </tr>
  <tr>
    <td width="120">Num.Reg. </td>
    <td width="120" colspan="3">Libro</td>
    <td width="120">Tomo </td>
    <td width="120">Secci&oacute;n</td>
    <td width="127">volumen</td>
  </tr>
  <tr>
    <td><input type="text" name="registro" size="20"  id="registro" value="<? echo $registro; ?>" class="itext" onChange="conMayusculas(this)"></td>
    <td width="120" colspan="3"><input type="text" name="libro" size="20"  id="libro" value="<? echo $libro; ?>" class="itext" onChange="conMayusculas(this)"></td>
    <td width="120"><input type="text" name="tomo" size="20"  id="tomo" value="<? echo $tomo; ?>" class="itext" onChange="conMayusculas(this)"></td>
    <td width="120"><input type="text" name="seccion" size="20"  id="seccion" value="<? echo $seccion; ?>" class="itext" onChange="conMayusculas(this)"></td>
    <td width="127"><input type="text" name="volumen" size="20"  id="volumen" value="<? echo $volumen; ?>" class="itext" onChange="conMayusculas(this)"></td>
  </tr>
  <tr>
    <td>Superficie</td>
    <td colspan="3">Fecha  de Registro </td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text" name="superficie" size="20"  id="superficie" value="<? echo $superficie; ?>" class="itext" onChange="conMayusculas(this)"></td>
    <td><select name="dia" id="dia" >
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
    <td><select name="mes" id="mes">
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
    <td><select name="ano" id="ano">
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
  </tr>
  <tr>
    <td colspan="7"><strong>En  el&nbsp; Registro P&uacute;blico de la Propiedad y de  Comercio de: </strong></td>
  </tr>
  <tr>
    <td colspan="7"><textarea class="itextarea_antes" name="antecedentes" id="antecedentes" onChange="conMayusculas(this)"><? echo $antecedentes; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="6"><div align="right">
      <input class="ibutton" type="button" name="nuevo" id="enviare" value="AGREGAR"  onclick="nuevo_gtiash('<?php echo $idcliente; ?>','1'); return false" />
    </div></td>
    <td><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
    </div></td>
  </tr>
</table>
</form>


 