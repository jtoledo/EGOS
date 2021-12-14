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

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>   </title>
	 <link rel="stylesheet" href="styles2.css" type="text/css" media="all" />
    </head>
    <body>
			<div align="center" id="contenido">

<form name="captura" action="" onSubmit="reporte_historico_cliente(<?php echo $_SESSION['cosecha_sel']; ?>,<?php echo $_SESSION['mov_sucursal'];?>); return false" class="formu">  


  <table width="60%" border="0">
    <tr>
      <td colspan="2"><li class="iheader">
        <div id="carga"></div>
        <h2 class="art-logo-text">
          Historial de Cliente</h2>
        </li>
			
        </td>
      </tr>
      <tr><td colspan="2">
	<fieldset><legend>Ordenado por:</legend>     	
	<input type="radio" name="order" onclick="actualiza_historico_cliente(2)" checked="true">nombre  <input type="radio" name="order" onclick="actualiza_historico_cliente(1)" >Deuda  
	</fieldset> 
	</td></tr>
	<tr>
		<td>Clientes:</td>
		<td>
    		
		<div id="update_sel">	
		<script type="text/javascript" >
				actualiza_historico_cliente(2);	
		</script>			
		</div>
		
		</td>	
	</tr>   
	
   
      <td></td>
      <td align="center">
		

<!-- <input class="ibutton" type="submit" name="enviar" id="enviar" value="GENERAR HISTORICO" /> --> 
     
		</td></tr>
		<tr><td></td><td align="center">      
       <div id="consul_reporte">
		
		</div>
        </td>
          </tr>
          
  </table>
 
 </form>

</div>
    </body>
</html>
<?php
include (FOOTER);  
?>