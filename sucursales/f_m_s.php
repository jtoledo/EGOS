<?php
if($modif!=1)
	{
		$c_sucursal="SELECT * FROM cc_sucursales order by sucursal desc";
		$query_c=pg_query($con,$c_sucursal);
		while($row_sucursal=pg_fetch_array($query_c))
		{
		$sucursal=$row_sucursal["sucursal"];
		$direccion=$row_sucursal["direccion"];
		$telefono=$row_sucursal["telefono"];
		$cp=$row_sucursal["cp"];
		$idsede=$row_sucursal["idsede"];
		$idencargado=$row_sucursal["idencargado"];
		$sucursal_id=$row_sucursal["id"];
		
		}
	}





?>


  <div align="left">
<form name="sucursal" action=""  class="iform">


    <select name="sucursal_id" class="iselect" onchange="actualiza_sucursal(1); return false">
                 <option value="">Seleccione Sucursal</option>
      
      <?php
		  
		  
		  $consulta_c="SELECT * FROM cc_sucursales order by sucursal ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
							
						?>	
      
      <option value="<?php echo $fila_c["id"]?>"><?php echo nom(utf8_decode($fila_c["sucursal"])); ?></option>	
      
      <?php
						
						}
		  
		  
	  ?>      
    </select> 

</form>
  </div>

 <form name="captura" action="" onSubmit="sucursales_m(); return false" class="iform">
 <input type="hidden" name="sucursal_id" value="<?php echo $sucursal_id; ?>" />
<table border="0">
 
 
  <tr>
    <td colspan="4"><li class="iheader"><h2 class="art-logo-text">Modifica Sucursal </h2></li></td>
  </tr>
  <tr>
    <th><label for="YourName">Sucursal</label></th>
    <td colspan="3">
	<input type="text" name="sucursal" id="sucursal" size="60" maxlength="30" value="<?php echo $sucursal; ?>" autocomplete="off"  class="itext" onChange="conMayusculas(this)"></td>
  </tr>
  <tr>
   <th><label for="YourName">Direcci&oacute;n</label></th>
    <td colspan="3"><input type="text" name="direccion" id="direccion" size="60" maxlength="30" value="<?php echo $direccion; ?>" autocomplete="off"  class="itext" onChange="conMayusculas(this)"></td>
  </tr>
  <tr>
   <th><label for="YourName">Tel&eacute;fono</label></th>
    <td><input type="text" name="telefono" id="telefono" size="30" maxlength="15" value="<?php echo $telefono; ?>" autocomplete="off" onKeyPress="return acceptNum(event)"  class="itext" > </td>
     <th><label for="YourName">Cp</label></th>
    <td><input type="text" name="cp" id="cp" size="6" maxlength="5" value="<?php echo $cp; ?>" autocomplete="off"  onKeyPress="return acceptNum(event)"  class="itext"> </td>
  </tr>
  
   <tr>
   <th><label for="YourName">Sede</label></th>
    <td><select name="idsede" id="idsede" class="iselect">
      <option value="">Seleccione Sede</option>
      <?php
		  
		  
		  $consulta=
				"SELECT sucursal,id from cc_sucursales order by sucursal ";
                     	$id_query = pg_query($con,$consulta);
                     	while( $fila= pg_fetch_array($id_query) )
                        {  
							if($fila["id"]==$idsede)
							{
							
						?>
      <option value="<?php echo $fila["id"]?>" selected="selected"><?php echo nom(utf8_decode($fila["sucursal"])); ?></option>
      <?php
						
							}
							
							else
							{
							?>
							<option value="<?php echo $fila["id"]?>"><?php echo nom(utf8_decode($fila["sucursal"])); ?></option>
							<?php
							}
						
						
						}
		  
		  
	  ?>
    </select></td>
     <th><label for="YourName">Encargado</label></th>
    <td><select name="idencargado" id="idencargado" class="iselect">
      <option value="">Seleccione encargado</option>
      <?php
		  
		  
		  $consulta_u=
				"SELECT * from u_usuarios order by usuario ";
                     	$id_query_u = pg_query($con,$consulta_u);
                     	while( $row= pg_fetch_array($id_query_u) )
                        {  
						
	
						$usu=$row["usuario"];
						$nombre_p=$row["nombre"];
						$iniciales=$row["iniciales"];
						
						$users="[ {$usu} ] {$nombre_p} ({$iniciales})";
						
							
							if($row["uid"]==$idencargado)
								{
								
								?>
								
								<option value="<?php echo $row["uid"]?>" selected="selected"><?php echo nom(utf8_decode($users)); ?></option>
								
								<?php
								
								}
								else
								{
							
						
							
						?>
								  <option value="<?php echo $row["uid"]?>"><?php echo nom(utf8_decode($users)); ?></option>
								  <?php
								  
								 }
						
						
						
						}
		  
		  
	  ?>
    </select></td>
  </tr>
   <tr>
   <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
   <tr>
     <td colspan="3">&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
    
     <td colspan="3">&nbsp;</td>
     <td><input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR" />
      <input class="ibutton" type="button" name="nuevo" id="enviare" value="AGREGAR"  onclick="actualiza_sucursal(2); return false" /></td>
   </tr>
   <tr>
     <td colspan="4"><li class="iseparator">&nbsp;</li></td>
   </tr>
</table>

 
</form>