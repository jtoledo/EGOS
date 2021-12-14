<?php
if($modif!=1)
	{
	$c_perfil="SELECT * FROM perfiles order by nombre_perfil desc";
	$query_c=pg_query($con,$c_perfil);
	while($row_perfil=pg_fetch_array($query_c))
	{
	$nom_perfil=$row_perfil["nombre_perfil"];
	$desc=$row_perfil["descripcion"];
	$perfil_id=$row_perfil["id_perfil"];
	}
}

?>

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


<form name="captura" action="" onSubmit="perfiles_m(); return false" class="iform">
  <div align="left">
    <input type="hidden" name="perfil_id" value="<?php echo $perfil_id; ?>" />
    <table class="Record art-article">	
      
      <tr><th colspan="2">
        <li class="iheader"><h2 class="art-logo-text">Perfiles</h2></li>
		  
		 </th>
		  </tr>
      
      <tr><th>
        <label for="YourName">     Nombre de perfil:</label></th>
      <td>
        <input type="text" name="nom_perfil" id="nom_perfil" size="30" maxlength="30" value="<?php echo nom($nom_perfil); ?>" autocomplete="off" class="itext" onChange="conMayusculas(this)">      </td>
      </tr>			
      <tr>
        <th>			
        <label for="YourName">   Descripci&oacute;n </label></th>
      <td><input  type="text" name="desc" id="desc" size="30" maxlength="30" value="<?php echo nom($desc); ?>" autocomplete="off" class="itext" onChange="conMayusculas(this)">      </td>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <td>&nbsp;</td>
        </tr>	
      <tr >
        <td >&nbsp;</td>
        <td ><div align="right">
            <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR">
            <input class="ibutton" type="button" name="nuevo" id="enviare" value="AGREGAR"  onclick="actualiza_perfil(2); return false" />
        </div></td>
      </tr>
    </table>
  </div>
  <li class="iseparator">&nbsp;</li>
</form>