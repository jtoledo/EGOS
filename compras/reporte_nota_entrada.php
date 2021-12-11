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

<form name="captura" action="" onSubmit="re_genera_ntcompras(<?php echo $_SESSION['cosecha_sel']; ?>,<?php echo $_SESSION['mov_sucursal'];?>); return false" class="formu">  


  <table width="60%" border="0">
    <tr>
      <td colspan="2"><li class="iheader">
        <div id="carga"></div>
        <h2 class="art-logo-text">
          Reporte Notas de Entrada</h2>
        </li></td>
      </tr>
   
    <tr>
      <td>Fecha inicial</td>
      <td>
        <input name="fecha_i" type="text" id="fecha_i" onclick="popUpCalendar(this, captura.fecha_i, 'dd-mm-yyyy');"  value="" readonly="readonly" class="iselect">
        </td>
          </tr>
          
<tr>
      <td>Fecha Corte</td>
      <td>
        <input name="fecha_f" type="text" id="fecha_f" onclick="popUpCalendar(this, captura.fecha_f, 'dd-mm-yyyy');"  value="<?php echo date("d-m-Y"); ?>" readonly="readonly" class="iselect">
        </td>
          </tr>
          <tr>
				<td>Producto</td>				
				 <td><?php get_producto_r(); ?></td>          
          </tr>
     
           <tr>
      <td>Tonga</td>
      <td>
        <?php get_tonga_nt(); ?>
        </td>
          </tr>  
          
          <tr>
      <td></td>
      <td align="center"><input class="ibutton" type="submit" name="enviar" id="enviar" value="GENERAR" />
        
        </td>
          </tr>
          
  </table>
 

<div align="center" id="consul_reporte">
</div>
 </form>

</div>

<?php
include (FOOTER);  
?>