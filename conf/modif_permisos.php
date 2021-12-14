<?php require("../includes/session.php");?>
<?php verificar_sesion(); ?>
<?php
$perfil_id=$_GET["perfil_id"];
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
require(CABECERA);
?>


<div id="contenido" align="center">
<div class="left">
  <?php include("f_m_p.php"); ?>
  </div>
  <div class="right">
  
  <?php get_permisos_perfil($perfil_id); ?>
  </div>

</div>
 <div id="consul_perfiles" align="center">
  </div> 
 



   
<?php
include (FOOTER);  
?>