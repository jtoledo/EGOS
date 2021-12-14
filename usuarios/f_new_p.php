 
 <form name="perfil" action=""  class="iform">

 <select name="perfil_id" class="iselect" onchange="actualiza_perfil(1); return false">
 <option value="">Seleccione Perfil</option>

			<?php
		  
		  
		  $consulta_c="SELECT * from perfiles order by nombre_perfil ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
							
						?>	
						
						<option value="<?php echo $fila_c["id_perfil"]?>"><?php echo nom($fila_c["nombre_perfil"]); ?></option>	
						
						<?php
						
						}
		  
		  
	  ?>      
	  </select> 
    </form>

  <div align="left">
<form name="captura" action="" onSubmit="perfiles(); return false"  class="iform">


    <table class="Record art-article">	
      
      
      <tr>
        <th colspan="3"><li class="iheader"><h2 class="art-logo-text">Perfiles</h2></li></th>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>
        <label for="YourName"> Nombre de perfil:</label> </th>
      <td>
        <input type="text" name="nom_perfil" id="nom_perfil" size="30" maxlength="30" value="" autocomplete="off" class="itext" onChange="conMayusculas(this)">      </td>
      </tr>			
      <tr>
        <th>&nbsp;</th>
        <th>			
        <label for="YourName">   Descripci&oacute;n </label></th>
      <td><input  type="text" name="desc" id="desc" size="30" maxlength="30" value="" autocomplete="off" class="itext" onChange="conMayusculas(this)">       </td>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <td>&nbsp;</td>
      </tr>	
      <tr >
        <td colspan="3" >
          
          <div align="right">
            <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR"  > 
            </div></td>
      </tr>
    </table>
  </div>
  <li class="iseparator">&nbsp;</li>
</form>
 
