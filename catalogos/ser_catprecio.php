<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$idarticulos=$_POST["idarticulos"];

$precio=$_POST["precio"];
$ren_max=$_POST["ren_max"];
$ren_min=$_POST["ren_min"];
$man_max=$_POST["man_max"];
$man_min=$_POST["man_min"];
$hum_max=$_POST["hum_max"];
$hum_min=$_POST["hum_min"];
$man_sec=$_POST["man_sec"];
$fle_bul=$_POST["fle_bul"];
$mani_bul=$_POST["mani_bul"];
$sec_caj=$_POST["sec_caj"];
$precio_ren=round(($precio*$ren_max)/100,2);
$con=conectarse();

$sql_update="update al_cat_articulos set precio1=$precio , precio2=$precio_ren , ren_max_permitido=$ren_max , ren_min_permitido=$ren_min , 
				man_max_permitido=$man_max , man_min_permitido=$man_min , hum_max_permitido=$hum_max , hum_min_permitido=$hum_min ,
				man_secado=$man_sec , fletex_bulto=$fle_bul , maniobrax_bulto=$mani_bul , secadox_caja=$sec_caj
				where id_catalogo=$idarticulos";


		$consulta=pg_query($sql_update);

		//registrar logs
		$usuario=$_SESSION["nombre_u"];
		$sql="select registrar_logs(1,currval('al_cat_articulos_id_catalogo_seq')::text,'al_cat_articulos','M','{$usuario}',
		'Modificacion de los precios');";
		$querytmp = pg_query($con,$sql);
		
	
		if($consulta>0)
		{
				echo "<div align='center'><strong><font color='#003300'>El precio fue actualizado Correctamente</font></strong></div>";
		
		}
	
?>