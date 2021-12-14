<?php require("includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$titulo="SISTEMA INTEGRAL DE INFORMACIÓN";
include("includes/constantes.php");
include("includes/funciones.php");
include("bd/conexion.php");

require(CABECERA_INDEX);
?>



<div id="contenido">
	
	<table id="tabs" border="0" width="100%" align="center">
 
 
  <tr>
    <td><img id="Image2" alt="" src="images/cafe_brush.png" width="314" height="302" />
    
    
    
    
    
    
    
    </td> 
    <td>
      <h2><img id="Image3" alt="" src="images/postheadericon.png" />SII-EGOS 1.0</h2>
 
      <h3><?php 
	 $con=conectarse();
	 $s_sucursal=get_session_sucursal(); 
	 echo nom($s_sucursal["sucursal"]);
	  ?></h3>
 
      <ul>
        <li><?php echo nom($s_sucursal["direccion"]) ?> </li>
        <li><?php echo nom($s_sucursal["telefono"]) ?> </li>
      </ul>
    </td>
  </tr>
  <tr>
  
  <td colspan="2"><div align="center"></div></td>
  </tr>
</table>





</div>	
	
<?php
include (FOOTER_INDEX);  
?>