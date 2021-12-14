<?php
if($modif!=1)
	{
	   
	   
	   $fila=get_paquete_tec();
	   
	     $id_paquete=$fila["id_paquete"];
		 $nom_paquete=$fila["nom_paquete"];
		 $descripcion_paquete=$fila["descripcion_paquete"];
		 $fecha_paq=$fila["fecha_paq"];
		  $ingre_hec=$fila["ingre_hec"];
		 $iduni=$fila["iduni"];
		 $precio_hec=$fila["precio_hec"];
		 $smg=$fila["smg"];
		 
	
	}





?>
<style type="text/css">
<!--
.Estilo1 {
	color: #000040;
	font-weight: bold;
	background-color:#FFFF33;
}
-->
</style>

  
  
<form name="captura" action="" onSubmit="paquete_alta_egos(1); return false" class="formu">  
<input type="hidden" name="id_paquete" value="<?php echo $id_paquete; ?>" />

<table width="454" border="0">
  <tr>
    <td colspan="3">
	  <li class="iheader">
		 
		<h2 class="art-logo-text">
	PAQUETES TECNOL&Oacute;GICOS	</h2>
	</li>	</td>
  </tr>
  <tr>
    <td colspan="3"><span class="cliente">
      <select name="id_paquetes" class="modif" id="id_paquetes" onchange="actualiza_paquete_selec(1); return false">
        <option value="">Seleccione Paquete</option>
        <?php
		  
		  
		  $consulta_c="SELECT * FROM paquete_tec  order by nom_paquete ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
						$nom_paquetes=$fila_c["nom_paquete"];
						
						?>
        <option value="<?php echo $fila_c["id_paquete"]?>"><?php echo nom($nom_paquetes); ?></option>
        <?php
						
						}
		  
		  
	  ?>
      </select>
    </span></td>
  </tr>
  <tr>
    <td colspan="3">Nombre de paquete tecnol&oacute;gico </td>
  </tr>
  <tr>
    <td colspan="3"><input type="text" name="nom_paquete" size="20" maxlength="255" id="nom_paquete" value="<?php echo nom($nom_paquete); ?>" class="modif" onchange="conMayusculas(this)" /></td>
  </tr>
  <tr>
    <td colspan="3">Descripci&oacute;n del paquete tecnol&oacute;gico </td>
  </tr>
  <tr>
    <td colspan="3">
	
	
<textarea name="descripcion_paquete" class="itextarea"  onchange="conMayusculas(this)"><?php echo nom($descripcion_paquete); ?></textarea>	</td>
  </tr>
  <tr>
    <td><div align="center">Ingreso por Hectaria</div></td>
    <td><div align="center">Unidad</div></td>
    <td><div align="center">Precio x Hectarea</div></td>
  </tr>
  <tr>
    <td><div align="center">
      <input name="ingre_hec" type="text" class="peque" id="ingre_hec" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)" value="<?php echo $ingre_hec; ?>" size="20" maxlength="255"  />
    </div></td>
    <td><div align="center">
      <?php
    get_unidad_m($iduni);
    ?>
    </div></td>
    <td><div align="center">
      <input name="precio_hec" type="text" class="peque" id="precio_hec" onchange="conMayusculas(this)" onkeypress="return acceptNum(event)" value="<?php echo $precio_hec;  ?>" size="20" maxlength="255" />
    </div></td>
  </tr>
  <tr>
    <td>Fecha de alta </td>
    <td><div align="center">Smg</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="fecha_paq" type="text" id="fecha_paq" onclick="popUpCalendar(this, captura.fecha_paq, 'dd-mm-yyyy');"  value="<?php echo $fecha_paq; ?>" readonly="readonly" /></td>
    <td><input name="smg" type="text" class="peque" id="smg"  onkeypress="return acceptNum(event)" value="<?php echo $smg; ?>" size="20" maxlength="255"  /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="right">
      <input class="ibutton" type="button" name="nuevo" id="enviare" value="NUEVO PAQUETE"  onclick="actualiza_paquete_selec(2); return false" />
    </div></td>
    <td width="177"><div align="right">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><?php 

$img='<img src="../images/i_pdf.png" alt="Reporte de Solicitud" style="WIDTH: 40px; HEIGHT: 40px" title="Reporte de Requerimientos">';

echo '<a href="../reportes/pdf_paquete_reque.php" >  <strong>

'.$img.'

</strong>  </a>';


		 ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="257"><div align="left">
      <?php
	  get_paquete_reque($id_paquete); //OBTIENE LOS REQUERIMIENOS QUE ESTAN AGREAGADOS EN EL PAQUETE TEC..
	  ?>
   </div></td>
    <td width="6">&nbsp;</td>
    <td><div align="right">
      <input class="ibutton" type="button" name="nuevo2" id="nuevo" value="AGREGAR REQUERIMIENTO"  onclick="add_select_req('<?php echo $id_paquete; ?>','3'); return false" />
    </div></td>
  </tr>
</table>

</form>