<?php
ob_start();
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];

$id_catalogo=trim($_POST["id_catalogo"]);
$idcliente=trim($_POST["idproductor"]);
$form=$_POST["form"];  

$con=conectarse();




		if($form==1)//actualizacion o recuperacion de precio de cafe
			{
				$consulta=pg_query($con,"SELECT * FROM al_cat_articulos where id_catalogo='$id_catalogo'");
				if($fila=pg_fetch_array($consulta))	
				{
					$precio_cafe=$fila["precio1"];
					$retencion_p=$fila["retencion_porc"];
					
					$sql="select coalesce(sum(cosecha_esp_kg),0.00) as tot_a_entregar,
					(select coalesce(sum(total_kgs_netos),0.00) as total_compra 
					from co_compras where id_periodo={$_SESSION['cosecha_sel']} and id_catalogo={$id_catalogo} and id_proveedor={$idcliente} and estatus=true)  
					as tot_comprado,
					coalesce(sum(cosecha_esp_kg),0.00)-
					(select coalesce(sum(total_kgs_netos),0.00) as total_compra 
					from co_compras where id_periodo={$_SESSION['cosecha_sel']} and id_catalogo={$id_catalogo} and id_proveedor={$idcliente} and estatus=true) 
					as tot_pen_entregar
 					from cc_parcela_cosecha pc,cc_parcelas p 
					where pc.id_parcela=p.id_parcela and p.idcliente={$idcliente} 
					and p.id_catalogo={$id_catalogo} and pc.id_periodo={$_SESSION['cosecha_sel']}";

					$consulta=pg_query($con,$sql);
					$fila=pg_fetch_array($consulta);
   				if(is_null($fila["tot_a_entregar"])) {	
						$valor='0.00|0.00|0.00';
					}else {
						$valor=$fila["tot_a_entregar"].'|'.$fila["tot_comprado"].'|'.$fila["tot_pen_entregar"];
					}
				
					
					echo $precio_cafe."|".$retencion_p."|".$valor; //serializado de datos
					//$precio_cafe;

				}
				else
				{
					echo "";
				}
				
			}



?>