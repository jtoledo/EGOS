<?php
define("SERVIDOR","localhost");
define("USUARIO","postgres");
define("DB","egos");
define("PASS","751973");


//define('BASE_DIR', dirname(__FILE__));
$path=$_SERVER['DOCUMENT_ROOT']."/EGOS/";
$cabecera=$path."includes/cabecera.php";
$footer=$path."includes/footer.php";

$cabecera_index=$path."includes/cabecera_index.php";
$footer_index=$path."includes/footer_index.php";


$cabecera_modal=$path."includes/cabecera_modal.php";
$footer_modal=$path."includes/footer_modal.php";

$cabecera_modal_cuenta=$path."includes/cabecera_modal_cuenta.php";



define("CABECERA",$cabecera);
define("FOOTER",$footer);

define("CABECERA_INDEX",$cabecera_index);
define("FOOTER_INDEX",$footer_index);

define("CABECERA_MODAL",$cabecera_modal);
define("FOOTER_MODAL",$footer_modal);
define("CABECERA_MODAL_CUENTA",$cabecera_modal_cuenta);
?>
