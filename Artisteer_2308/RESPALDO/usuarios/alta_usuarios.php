<?
include("../mysql/conexion.php");
$titulo="Disponibles para agregar Usuarios";
include(CABECERA);
?>


<?
include("consul_usuarios.php");
?>

<div id="cliente"></div>

  <?
$back=4;
include(FOOTER);

?>