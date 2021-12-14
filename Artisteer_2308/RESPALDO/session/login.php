<?php
include ("../includes/constantes.php");
include("conexion.php"); 
if(!isset($_SESSION[usuario])) 
{
$titulo="Identificacion de Usuario";
include (CABECERA);  

?>
<form name="logi" action="" onSubmit="autentifica(); return false">
 <div align="center">
  <table class="Record art-article">	
      <tr><th>
        USUARIO: </th>
    <td>
      <input type="text" name="user" id="user" size="30" maxlength="30" value="" autocomplete="off" >      </td>
    </tr>			
      <tr>
        <th>			
         CONTRASE&Ntilde;A:</th>
    <td><input type="password" name="contra" id="contra" size="30" maxlength="30" value="" autocomplete="off" >      </td>
    </tr>	
      <tr >
        <td colspan="2" >
          <div align="center">
            <input class="art-button" type="submit" name="enviar" id="enviar" value="ENVIAR"  > 
          </div></td>
    </tr>
  </table>
  <div id="respuesta"></div>
   </form>
  <?php
include (FOOTER);  
}
else
{
header("Location: ../inicio.php");
}
?>
</div>
