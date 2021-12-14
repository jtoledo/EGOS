<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

require(CABECERA);

?>

<div align="center" id="contenido">

<form name="captura" action="" onSubmit="valida_solicitudes(2); return false" class="formu">  
<table width="200" border="0">
    <tr>
      <td colspan="2"><li class="iheader">
        <div id="carga"></div>
        <h2 class="art-logo-text">
          CR&Eacute;DITOS AUTORIZADOS</h2>
        </li></td>
      </tr>
    <tr>
      <td>Cliente</td>
      <td><span class="cliente">
        <?php 
	get_clientes_creditos_auto();
       ?>
        </span></td>
      </tr>
    
    <tr>
      <td>Cr&eacute;ditos</td>
      <td>
        <div id="update_sol">
          <select name="idcredito" class="modif">
            <option value="">Ver Creditos</option>
            </select>
          </div>
        </td>
      </tr>
  </table>
   </form> 
<div align="center" id="detalles">
</div>


</div>

<?php
include (FOOTER);  
?>