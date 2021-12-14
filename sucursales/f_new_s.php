 
 <form name="sucursal" action=""  class="iform">

  <div align="left">
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
  </div>
</form>


 <form name="captura" action="" onSubmit="sucursales(); return false" class="iform">
 
<table border="0">
  <tr>
    
    <td colspan="4"><li class="iheader"><h2 class="art-logo-text">Agrega Sucursal</h2></li></td>
  </tr>
  <tr>
    <th><label for="YourName">Sucursal</label></th>
    <td colspan="3"><input type="text" name="sucursal" id="sucursal" size="60" maxlength="30" value="" autocomplete="off"  class="itext"onChange="conMayusculas(this)"></td>
  </tr>
  <tr>
   <th><label for="YourName">Direcci&oacute;n</label></th>
    <td colspan="3"><input type="text" name="direccion" id="direccion" size="60" maxlength="30" value="" autocomplete="off"  class="itext" onChange="conMayusculas(this)"></td>
  </tr>
  <tr>
   <th><label for="YourName">Tel&eacute;fono</label></th>
    <td><input type="text" name="telefono" id="telefono" size="30" maxlength="15" value="" autocomplete="off" onKeyPress="return acceptNum(event)"  class="itext"> </td>
     <th><label for="YourName">Cp</label></th>
    <td><input type="text" name="cp" id="cp" size="6" maxlength="5" value="" autocomplete="off"  onKeyPress="return acceptNum(event)"  class="itext"> </td>
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
							
						?>
      <option value="<?php echo $fila["id"]?>"><?php echo nom(utf8_decode($fila["sucursal"])); ?></option>
      <?php
						
						}
		  
		  
	  ?>
    </select></td>
     <th><label for="YourName">Encargado</label></th>
    <td><select name="idencargado" id="idencargado"  class="iselect">
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
							
						?>
      <option value="<?php echo $row["uid"]?>"><?php echo nom(utf8_decode($users)); ?></option>
      <?php
						
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
   <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">
      
        <div align="right">
          <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR"  >        
        </div></td>
  </tr>
   <tr>
     <td colspan="4"><li class="iseparator">&nbsp;</li></td>
   </tr>
</table>

  
</form>
 
