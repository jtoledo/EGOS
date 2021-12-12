<?php
ob_start();
include("../includes/constantes.php");
include("conexion.php"); 
$user=$_POST['user'];
$contra = sha1(trim($_POST["contra"]));
$id_sucursal=$_POST['id_sucursal'];
$id_periodo=$_POST['id_periodo'];
$des_periodo=$_POST['des_periodo'];
$con=conectarse();


$usuarios=pg_query($con,"SELECT * FROM u_usuarios WHERE usuario='$user' and contra='$contra' ");
if($user_ok = pg_fetch_array($usuarios)) 
{
   $id_perfil=$user_ok["id_perfil"];
   $id_user=$user_ok["uid"];
   $nombre=$user_ok["usuario"];
   $idsucursal=$user_ok["id_sucursal"];
   
   $consulta="SELECT * FROM perfiles where id_perfil='$id_perfil'";
   $id_query = pg_query($con,$consulta);
    	while( $fila= pg_fetch_array($id_query) )
            {  
			  $perfil=$fila["nombre_perfil"];
			}


   $consulta_s="SELECT * FROM cc_sucursales where id='$idsucursal'";
   $id_query_s = pg_query($con,$consulta_s);
    	while( $fila_s= pg_fetch_array($id_query_s) )
            {  
			  $sucursal=$fila_s["sucursal"];
			}


$_SESSION["usuario"] = $user_ok["uid"];
$_SESSION["nombre_u"] = $nombre;
$_SESSION["perfil"] = $perfil;
$_SESSION["id_perfil"] = $id_perfil;
$_SESSION["sucursal_u"] = $sucursal;
$_SESSION["mov_sucursal"] =$id_sucursal;
$_SESSION["cosecha_des"] =$des_periodo;
$_SESSION["cosecha_sel"] =$id_periodo;

//$_SESSION["id_empresa"]=$id_empresa;

echo "1";
 }
else
echo "<font color='#CCFF00'>Error Usuario o Contrase&ntilde;a Incorrectos Verifica Tus Datos</font>";

?>

