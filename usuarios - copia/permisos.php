<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$id_usuario=$_SESSION[usuario];
$nombre=$_SESSION[nombre];
$perfil=$_SESSION[perfil];
$perfil_id=$_GET["perfil_id"];
$id_perfil=$_SESSION[id_perfil];
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

require(CABECERA);
$c_perfil="SELECT * FROM perfiles WHERE id_perfil='$perfil_id'";
$query_c=pg_query($con,$c_perfil);
while($row_perfil=pg_fetch_array($query_c))
{
$nom_perfil=$row_perfil["nombre_perfil"];
$desc=$row_perfil["descripcion"];
}
?>


<div id="contenido" align="center">


<form name="captura" action="" onSubmit="perfiles_m(); return false" class="iform">
<input type="hidden" name="perfil_id" value="<?php echo $perfil_id; ?>" />
  <table class="Record art-article">	
  
   <tr><th colspan="2">
        <li class="iheader"><h2 class="art-logo-text">Configuraci&oacute;n de Permisos</h2></li>
		
		 </th>
		</tr>
  
      <tr><th>
    <label for="YourName">     Nombre de perfil:</label></th>
    <td>
      <input type="text" name="nom_perfil" id="nom_perfil" size="30" maxlength="30" value="<?php echo nom($nom_perfil); ?>" autocomplete="off" class="itext">      </td>
    </tr>			
      <tr>
        <th>			
       <label for="YourName">   Descripci&oacute;n </label></th>
    <td><input  type="text" name="desc" id="desc" size="30" maxlength="30" value="<?php echo nom($desc); ?>" autocomplete="off" class="itext" >      </td>
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
 
 
<div align="left" style="padding:0px 0px 0px 20px"> <a href="perfiles.php" class="art-button">Nuevo Perfil</a>
 <a href="permisos.php?perfil_id=<?php echo $perfil_id; ?>" class="art-button">Permisos</a>
</div>

<blockquote>

<div id="consul_perfil">
  <?php
  include("consul_perfiles.php");
  ?>
  </div>

</div>
 

</blockquote>

   
<?php
include (FOOTER);  
?>