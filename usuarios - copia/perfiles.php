<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$id_usuario=$_SESSION[usuario];
$nombre=$_SESSION[nombre];
$perfil=$_SESSION[perfil];
$id_perfil=$_SESSION[id_perfil];
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

require(CABECERA);
?>




<div id="contenido" align="center">


<form name="captura" action="" onSubmit="perfiles(); return false"  class="iform">
<li class="iheader"><h2 class="art-logo-text">Perfiles</h2></li>
  <table class="Record art-article">	
  
   
      <tr><th>
       <label for="YourName"> Nombre de perfil:</label> </th>
    <td>
      <input type="text" name="nom_perfil" id="nom_perfil" size="30" maxlength="30" value="" autocomplete="off" class="itext">      </td>
    </tr>			
      <tr>
        <th>			
       <label for="YourName">   Descripci&oacute;n </label></th>
    <td><input  type="text" name="desc" id="desc" size="30" maxlength="30" value="" autocomplete="off" class="itext">       </td>
    </tr>	
      <tr >
        <td colspan="2" >
          <div align="center">
            <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR"  > 
          </div></td>
    </tr>
  </table>
  <li class="iseparator">&nbsp;</li>
  </form>
 







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