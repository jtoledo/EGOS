<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$id_usuario=$_SESSION["usuario"];
$nombre=$_SESSION["nombre"];
$perfil=$_SESSION["perfil"];
$id_perfil=$_SESSION["id_perfil"];
$usuario_id=$_GET["usuario_id"];
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

require(CABECERA);


$c_usu="SELECT * FROM u_usuarios WHERE uid='$usuario_id'";
$query_usu=pg_query($con,$c_usu);
while($row_usu=pg_fetch_array($query_usu))
{
$nom_usuario=$row_usu["nombre"];
$iniciales=$row_usu["iniciales"];
$perfil_id=$row_usu["id_perfil"];
$usuario_nick=$row_usu["usuario"];
}

?>


<div id="contenido" align="center">


<form name="captura" action="" onSubmit="usuarios_m(); return false" class="iform">
<input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>" />
  <table class="Record art-article">	
  
   <tr><th colspan="2">
         <li class="iheader"><h2 class="art-logo-text">Info Personal</h2></li>
		
		 </th>
		</tr>
  
      <tr><th>
        <label for="YourName"> Nombre : </label></th>
    <td>
      <input type="text" name="nombre" id="nombre" size="30" maxlength="30" value="<?php echo nom($nom_usuario); ?>" autocomplete="off"  class="itext">      </td>
    </tr>			
      <tr>
        <th>			
       <label for="YourName"> Iniciales </label></th>
    <td><input  type="text" name="iniciales" id="iniciales" size="8" maxlength="30" value="<?php echo nom($iniciales); ?>" autocomplete="off" class="itext">      </td>
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
							<option value="<?php echo $fila_p["id_perfil"]?>" selected="selected"><?php echo nom(utf8_decode($fila_p["nombre_perfil"])); ?></option>
								
							
							<?php 
							}
							else
							{
							?>
							<option value="<?php echo $fila_p["id_perfil"]?>"><?php echo nom(utf8_decode($fila_p["nombre_perfil"])); ?></option>
							<?php
							}
						
						}
		  
		  
	  ?>      
	  
	  </select>    
          </div></td>
    </tr>
	<tr><th colspan="2">
        <li class="iheader"><h2 class="art-logo-text">Datos De Conexion</h2></li>
		
		 </th>
		</tr>
		
		
		 <tr><th>
       <label for="YourName">  Usuario :</label> </th>
    <td>
      <input type="text" name="usuario" id="usuario" size="30" maxlength="30" value="<?php echo $usuario_nick; ?>" autocomplete="off" class="itext">      </td>
    </tr>	
		
		
      <tr >
        <td colspan="2" >
          <div align="center">
            <input class="ibutton" type="submit" name="enviar" id="enviar" value="MODIFICAR"  > 
          </div></td>
    </tr>
  </table>
   <li class="iseparator">&nbsp;</li>
  </form>
 
</div>
<div align="left" style="padding:0px 0px 0px 20px"> <a href="usuarios.php" class="art-button">Nuevo Usuario</a></div>

<blockquote>

<div id="consul_usuario">
  <?php
  include("consul_usuarios.php");
  ?>
  </div>


 

</blockquote>

   
<?php
include (FOOTER);  
?>