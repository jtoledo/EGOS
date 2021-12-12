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

<form name="captura" action="" onSubmit="re_genera_estadocuenta_pro(3); return false" class="formu">  


  <table width="60%" border="0">
    <tr>
      <td colspan="2"><li class="iheader">
        <div id="carga"></div>
        <h2 class="art-logo-text">
          Estado de Cuenta x Grupo</h2>
        </li></td>
      </tr>
   <tr>
      <td>Grupo</td>
      <td><span class="cliente">
        <?php 
	  
	  
   get_grupo_reporte();
    
	   ?>
        </span></td>
      </tr>
    
   
          
<tr>
      <td>Fecha Corte</td>
      <td>
        <input name="fecha_f" type="text" id="fecha_f" onclick="popUpCalendar(this, captura.fecha_f, 'dd-mm-yyyy');"  value="<?php echo date("d-m-Y"); ?>" readonly="readonly" class="iselect">
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