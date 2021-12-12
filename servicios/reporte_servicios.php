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


<div id="contenido" align="center">

<form name="captura" action="" onSubmit="co_reporte_servicio(1); return false" class="formu">  
<table width="70%" border="0">
  <tr>
    <td colspan="2"><li class="iheader">
		  <div id="carga"></div>
		<h2 class="art-logo-text">
	REPORTE DE SERVICIOS</h2>
	</li></td>
  </tr>
  <tr>
    <td>Productor</td>
    <td>
      <?php
    get_clientes_cuenta(); //carga a los clientes y no actualiza nada
    ?>
</td>
    </tr>
  <tr>
    <td>Opci&oacute;n</td>
    <td>
    <select name="opcion" class="iselect">
    <option value="">Seleccione</option>
    <option value="1">CON ADEUDO</option>
    <option value="0">SIN ADEUDO</option>
    </select>
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>  <div align="center">
      <input class="ibutton" type="submit" name="enviar" id="enviar" value="GENERAR" />
    </div></td>
  </tr>
</table>
</form>

<div id="reporte_servicio" align="center" style="width:100%; height:250px; overflow: scroll;">
</div>
</div> 

<?php
include (FOOTER);  
?>