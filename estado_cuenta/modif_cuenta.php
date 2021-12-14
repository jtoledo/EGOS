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


<form name="captura" action="" onSubmit="genera_estado_cuenta(1); return false" class="formu">  
<table width="70%" border="0">
  <tr>
    <td colspan="2"><li class="iheader">
		  <div id="carga"></div>
		<h2 class="art-logo-text">
	ESTADO DE CUENTA</h2>
	</li></td>
  </tr>
  <tr>
    <td>Productor</td>
    <td><span class="clientes_sol">
      <?php
    get_clientes_cuenta();
    ?>
    </span></td>
    </tr>
  <tr>
    <td>Fecha de corte</td>
    <td>
    <input name="fecha_corte" type="text" class="folio" id="fecha_corte" onclick="popUpCalendar(this, captura.fecha_corte, 'dd-mm-yyyy');" readonly="readonly" value="<?php echo date("d-m-Y"); ?>">
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

<div id="estado_cuenta" align="center" style="width:100%; height:350px; overflow: scroll;">
</div>


</div> 

<?php
include (FOOTER);  
?>