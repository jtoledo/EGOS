<?php
session_start();
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
require(CABECERA_MODAL);
?>
<script>
function cerrar(idcliente) {
	parent.VentanaModal.cerrar_referencia_per(idcliente);
}
</script>
<?php
$img=' <img src="../images/close.png" width="20" heigth="20">';	
  	  echo"<a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"cerrar('".$idcliente."')\" >".$img."</a>";
$idcliente=$_GET["idcliente"];
$con=conectarse();
?>	  

<div id="contenido_banco" align="center">
<?php

include("formulario_ref_personal.php");
?>

</div> 

<?php
include (FOOTER_MODAL);  
?>