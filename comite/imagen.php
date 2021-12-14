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
function cerrar() {
	parent.VentanaModal.cerrar();
}
</script>
<?php
$idcliente=trim($_GET["idcliente"]);
$idconcepto=trim($_GET["idconcepto"]);

$con=conectarse();
?>	  

<div id="contenido_banco" align="center">

<?php
$sql="SELECT * FROM expediente where idcliente='$idcliente' and idconcepto='$idconcepto'";
$res=pg_query($con,$sql); 
while($registro=pg_fetch_array($res)) 
{ 

// $idconcepto=$registro["idconcepto"];
 $ubicacion=$registro["ubicacion"];
 $nom_doc=get_documento($idconcepto);
 
 ?>

<ul class="gallery clearfix">      
 <a href="../clientes/<?php echo $ubicacion; ?>"  rel="prettyPhoto[]" title="<?php echo nom($nom_doc); ?>" >
  <img src="../clientes/<?php echo $ubicacion; ?>"  width="600" height="600" />
  </a>
  </ul>

<?php
}
?>

</div> 

<?php
include (FOOTER_MODAL);  
?>