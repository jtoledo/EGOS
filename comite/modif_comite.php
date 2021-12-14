<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");

include(CABECERA);

?>

<div align="center" id="contenido">

<form name="capturas" action="" onSubmit="valida_solicitudes(2); return false" class="formu">  


  <table width="80%" border="0">
    <tr>
      <td colspan="4"><li class="iheader">
        <div id="carga"></div>
        <h2 class="art-logo-text">
          COMIT&Eacute; DE CR&Eacute;DITO</h2>
      </li>
				<div id="iFishEye_example_1" align="rigth" style="display:none;"> 
    		 		<table>  
        				<tr>  
            			<td><a id="fish1" href="../reportes/com_reporte_contrato.php?idcredito=<?php echo $idcredito;?>"><img class="iFishEyeImg" height="20" width="20" src="../images/word1.png" alt="Contrato de credito" /><br /><span class="iFishEyeCaption"><b>Contrato</b></span></a></td>  
           	 			<td><a id="fish2" href="../reportes/com_reporte_solicitud.php?idcredito=<?php echo $idcredito;?>"><img class="iFishEyeImg" height="20" width="20" src="../images/excel.png" alt="Solicitud" /><br /><span class="iFishEyeCaption"><b>Solicitud</b></span></a></td>  
            			<td><a id="fish3" href="../reportes/com_reporte_anexo.php?idcredito=<?php echo $idcredito;?>"><img class="iFishEyeImg" height="20" width="20" src="../images/word1.png" alt="Anexo" /><br /><span class="iFishEyeCaption"><b>Anexo</b></span></a></td>  
            			<td><a id="fish4" href="../reportes/com_reporte_recibo.php?idcredito=<?php echo $idcredito;?>"><img class="iFishEyeImg" height="20" width="20" src="../images/word1.png" alt="Recibo de dinero" /><br /><span class="iFishEyeCaption"><b>R.Dinero</b></span></a></td>  
            			<td><a id="fish5" href="../reportes/com_reporte_supervision.php?idcredito=<?php echo $idcredito; ?>"><img class="iFishEyeImg" height="20" width="20" src="../images/excel.png" alt="Reporte de supervision" /><br /><span class="iFishEyeCaption"><b>Supervici&oacuten</b></span></a></td>  
            	 	</tr>  
    	   		</table> 
				</div>		      
      
      </td>
      </tr>
    <tr>
      <td colspan="4" align="center"><h2>Créditos agendados para comit&eacute;</h2></td>
      </tr>
   
      <tr>
        <td>Solicitudes Agendadas</td>
      <td>
        <div id="sol_agendadas">
          <?php get_solicitudes_agendadas($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']); ?>
          </div>
        </td>
      
      <td>Solicitudes Autorizadas</td>
      <td>
	  <div id="sol_auto">
	  <?php get_solicitudes_autorizadas($_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']); ?>
      </div>
      </td>
      
  </table>
 </form> 

<div align="center" id="comite">
</div>
		

</div>
 

<?php

include (FOOTER);  
?>