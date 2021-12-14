<?php

if($modif!=1)
{
	$c_usu="SELECT * FROM u_usuarios order by nombre desc";
		$query_usu=pg_query($con,$c_usu);
		while($row_usu=pg_fetch_array($query_usu))
		{
		$usuario_id=$row_usu["uid"];
		$nom_usuario=$row_usu["nombre"];
		$iniciales=$row_usu["iniciales"];
		$perfil_id=$row_usu["id_perfil"];
		$usuario_nick=$row_usu["usuario"];
		$contra = sha1($row_usu["contra"]);
		
		}

}
?>

<form name="cliente" action=""  class="iform">

 <select name="usuario_id" class="iselect" onchange="actualiza_usu(1); return false">
 <option value="">Seleccione Usuario</option>

			<?php
		  
		  
		  $consulta_c="SELECT * from u_usuarios order by nombre ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
							
						?>	
						
						<option value="<?php echo $fila_c["uid"]?>"><?php echo nom($fila_c["nombre"]); ?></option>	
						
						<?php
						
						}
		  
		  
	  ?>      
	  </select> 
    </form>
 
 
  
 




<form name="captura" action="" onSubmit="usuarios_m(); return false" class="iform">
 
    <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>" />
  <table width="200" border="0">
    <tr>
      <td colspan="2"><li class="iheader"><h2 class="art-logo-text">Info Personal</h2></li></td>

      <td colspan="2"> <li class="iheader"><h2 class="art-logo-text">Datos De Conexion</h2></li></td>
    </tr>
    <tr>
      <th><label for="YourName"> Nombre : </label></th>
      <td>
      <input type="text" name="nombre" id="nombre" size="30" maxlength="50" value="<?php echo nom($nom_usuario); ?>" autocomplete="off"  class="itext" onChange="conMayusculas(this)">      </td>
      <th>
       <label for="YourName">  Usuario :</label> </th>
    <td>
      <input type="text" name="usuario" id="usuario" size="30" maxlength="50" value="<?php echo $usuario_nick; ?>" autocomplete="off" class="itext" >      </td>
    </tr>
    <tr>
       <th>			
       <label for="YourName"> Iniciales </label></th>
    <td><input  type="text" name="iniciales" id="iniciales" size="8" maxlength="30" value="<?php echo nom($iniciales); ?>" autocomplete="off" class="itext" onChange="conMayusculas(this)">      </td>
      <th><label for="YourName">Contrase&ntilde;a</label></th>
      <td><input type="text" name="contra" id="contra" size="30" maxlength="30" value="<?php echo $contra; ?>" autocomplete="off"  class="itext" /></td>
    </tr>
    <tr>
      <th>			
       <label for="YourName"> Perfil</label></th>
     <td>
		    <div align="center">
			<select name="perfil" class="iselect">
			<?php
		  
		  
		  $consulta_p=
				"SELECT nombre_perfil,id_perfil from perfiles order by id_perfil ";
                     	$id_query_p = pg_query($con,$consulta_p);
                     	while( $fila_p= pg_fetch_array($id_query_p) )
                        {  
							
							if($fila_p["id_perfil"]==$perfil_id)
							{
							?>
							<option value="<?php echo $fila_p["id_perfil"]?>" selected="selected"><?php echo nom($fila_p["nombre_perfil"]); ?></option>
								
							
							<?php 
							}
							else
							{
							?>
							<option value="<?php echo $fila_p["id_perfil"]?>"><?php echo nom($fila_p["nombre_perfil"]); ?></option>
							<?php
							}
						
						}
		  
		  
	  ?>      
	  </select>    
          </div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td >
          </td>
       <td >&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR">
        <input class="ibutton" type="button" name="nuevo" id="enviare" value="AGREGAR"  onclick="actualiza_usu(2); return false" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  </form>


