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
          EXPEDIENTE DE CR&Eacute;DITO</h2>
        </li></td>
      </tr>
    <tr>
      <td>Cliente</td>
      <td><span class="cliente">
        <?php 
	  
	  
    get_clientes_expediente();
    
	  
	  
	  //update_sol_modif($idcliente); verifica las solicitudes de los clientes
	  
	   ?>
        </span></td>
      </tr>
    
    <tr>
      <td>Solicitudes</td>
      <td>
        <div id="update_sol">
          <select name="idsolicitud" class="modif">
            <option value="">Ver Solicitudes</option>
            </select>
          </div>
        </td>
      
      
      
     
      
      </tr>
  </table>
 

<div align="center" id="detalles">
</div>
 </form>

</div>

<?php
include (FOOTER);  
?>