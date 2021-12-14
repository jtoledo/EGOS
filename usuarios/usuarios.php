<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$id_usuario=$_SESSION["usuario"];
$nombre=$_SESSION["nombre"];
$perfil=$_SESSION["perfil"];
$id_perfil=$_SESSION["id_perfil"];
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

require(CABECERA);

?>


<div id="contenido" align="center">
 <div id="cliente" align="left" style="padding:0px 0px 0px 600px">
<form name="cliente" action=""  class="iform">
 <select name="usuario_id" class="iselect" onchange="actualiza_usu(); return false">

			<?php
		  
		  
		  $consulta_c="SELECT * from u_usuarios order by nombre ";
				
                     	$id_query_c = pg_query($con,$consulta_c);
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
							
						?>	
						
						<option value="<?php echo $fila_c["uid"]?>"><?php echo nom(utf8_decode($fila_c["nombre"])); ?></option>	
						
						<?php
						
						}
		  
		  
	  ?>      
	  </select> 
	  </form>
 </div>

<form name="captura" action="" onSubmit="usuarios(); return false" class="iform">

    <div align="center">
      <table width="651" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="475" colspan="2" >
            
            <table border="0" cellpadding="0" cellspacing="0">	
              
              <tr><th colspan="2">
                <li class="iheader"><h2 class="art-logo-text">Info Personal</h2></li>
		      
		 </th>
		      </tr>
              
              <tr><th width="107">
                <label for="YourName">Nombre :</label> </th>
          <td width="324">
            <input type="text" name="nombre" id="nombre" size="50" maxlength="60" value="" autocomplete="off" class="itext">      </td>
          </tr>			
              <tr>
                <th>			
                <label for="YourName">Iniciales</label></th>
          <td><input  type="text" name="iniciales" id="iniciales" size="8" maxlength="30" value="" autocomplete="off" class="itext">      </td>
          </tr>
              
              <tr>
                <th>			
                <label for="YourName">Perfil</label></th>
              <td>
                
                <select name="perfil" class="iselect">
                  <option value="">Seleccione Perfil</option>
                  <?php
		  
		  
		  $consulta=
				"SELECT nombre_perfil,id_perfil from perfiles order by id_perfil ";
                     	$id_query = pg_query($con,$consulta);
                     	while( $fila= pg_fetch_array($id_query) )
                        {  
							
						?>
                  <option value="<?php echo $fila["id_perfil"]?>"><?php echo nom(utf8_decode($fila["nombre_perfil"])); ?></option>
                  <?php
						
						}
		  
		  
	  ?>      
              </select>             </td></tr>
          </table>	</td>
          <td width="337">
            <table border="0" cellpadding="0" cellspacing="0">
              
              <tr><th colspan="2">
                <li class="iheader"><h2 class="art-logo-text">Datos de Conexi&oacute;n</h2></li>
		      
		 </th>
		      </tr>
              
              
              <tr><th>
                <label for="YourName">Usuario :</label> </th>
          <td>
            <input type="text" name="usuario" id="usuario" size="30" maxlength="30" value="" autocomplete="off" class="itext">      </td>
          </tr>	
              
              <tr><th>
                <label for="YourName">Contrase&ntilde;a : </label></th>
          <td>
            <input type="password" name="contra" id="contra" size="30" maxlength="30" value="" autocomplete="off"  class="itext">      </td>
          </tr>		
              <tr><th>
                <label for="YourName">Confirmar : </label></th>
          <td>
            <input type="password" name="contra2" id="contra2" size="30" maxlength="30" value="" autocomplete="off" class="itext" >      </td>
          </tr>		
              <tr >
                <td colspan="2" >
                <div align="center"></div></td>
          </tr>
          </table>  </td>
        </tr>
        <tr>
          <th><label for="YourName">Sucursal</label></th>
          <td><select name="id_sucursal" id="id_sucursal" class="iselect">
            <option value="">Seleccione Sucursal</option>
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
          </select>		  </td>
		    
        <td><div align="right">
          <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR">
          </div></td>
        </tr>
        <tr>
          
          <td colspan="2"><li class="iseparator">&nbsp;</li></td>
          <td><li class="iseparator">&nbsp;</li></td>
        </tr>
      </table>
    </div>
</form>
 







<blockquote>

<div id="consul_usuario">
  <?php
  include("consul_usuarios.php");
  ?>
  </div>

</div>
 

</blockquote>

   
<?php
include (FOOTER);  
?>