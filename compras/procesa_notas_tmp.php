<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
session_start();
$id_usuario=$_SESSION["usuario"];
$id_periodo=$_SESSION["cosecha_sel"];
$id_almacen=$_SESSION["mov_sucursal"];

$idcliente=$_POST["idcliente"];
$idproductor=$_POST["idproductor"];
$id_catalogo=$_POST["id_catalogo"];
$produccion=$_POST["produccion"];
$fecha_nota=$_POST["fecha_nota"];
$vehiculo=$_POST["vehiculo"];
$henequen=$_POST["henequen"];
$yute=$_POST["yute"];
$bolsa=$_POST["bolsa"];
$kgs_brutos=$_POST["kgs_brutos"];
$tonga=$_POST["tonga"];
$resto_alimentos=valida_campo($_POST["resto_alimentos"]);
$desechos_human=valida_campo($_POST["desechos_human"]);
$olores_desa=valida_campo($_POST["olores_desa"]);
$otros_organicos=valida_campo($_POST["otros_organicos"]);
$manchas_comb=valida_campo($_POST["manchas_comb"]);
$vehiculo_sucio=valida_campo($_POST["vehiculo_sucio"]);
$olor_detergente=valida_campo($_POST["olor_detergente"]);
$otros_inorganicos=valida_campo($_POST["otros_inorganicos"]);
$precio_kilo=$_POST["precio_kilo"];
$rendimiento=valida_campo($_POST["rendimiento"]);
$mancha=valida_campo($_POST["mancha"]);
$humedad=valida_campo($_POST["humedad"]);
$cerezo=valida_campo($_POST["cerezo"]);
$criba=valida_campo($_POST["criba"]);
$resultado_analisis=$_POST["resultado_analisis"];
$constancia_cmc=valida_campo($_POST["constancia_cmc"]);
$no_productor=$_POST["no_productor"];
$total_kgs_neto2=valida_campo($_POST["total_kgs_neto2"]);
$forma_pago=$_POST["forma_pago"];
$no_cheque=valida_campo_var($_POST["no_cheque"]);
$banco_cheque=valida_campo_var($_POST["banco_cheque"]);
$costalera=$_POST["costalera"];
$estado_costalera=$_POST["estado_costalera"];
$observaciones=$_POST["observaciones"];
$henequen=$_POST["henequen"];
$enviar=$_POST["enviar"];
$retencion_p=(isset($_POST["retencion_p"])?$_POST["retencion_p"]:0.00);
$retencion_peso=(isset($_POST["retencion_peso"])?$_POST["retencion_peso"]:0.00);
$nserie=$_POST["serie"];
$miembro_c=(isset($_POST["miembro_c"])?$_POST["miembro_c"]:0);
$id_compra=$_POST["id_compra"];//solo cuando es modificacion de la nota de entrada

$id_servicio=retorna_valornum($_POST["id_servicio"]);

$con=conectarse();
/*$errores = validar_campos_obligatorios(array($henequen,$enviar));	
	
	if(empty($errores))
	{
		echo 0;
		exit;
	}
*/

/*TRATAMIENTO DE LA INFORMACION*/
//obtenemos los arreglos como auxiliares
$kgs_brutos_aux=explode(',',$kgs_brutos);
$henequen_aux=explode(',',$henequen);
$yute_aux=explode(',',$yute);
$bolsa_aux=explode(',',$bolsa);
$tonga_aux=explode(',',$tonga);
$total_kgs_brutos=0;
$total_hene=0;
$total_yute=0;
$total_bolsa=0;
foreach($kgs_brutos_aux as $valor)
{
	$total_kgs_brutos=$total_kgs_brutos+$valor;
}
//obtenemos los totales de las taras
//totales para henequen
foreach($henequen_aux as $hene)
{
	$total_hene=$total_hene+$hene;
}
foreach($yute_aux as $yut)
{
	$total_yute=$total_yute+$yut;
}
foreach($bolsa_aux as $bol)
{
	$total_bolsa=$total_bolsa+$bol;
}

//obtenemos el peso de las taras que son hene,yute,bolsa
$taras=get_taras($_SESSION['mov_sucursal']);
while($tar=pg_fetch_array($taras)) { 
	switch($tar['id_tara']) {
	case 1:	$peso_hene=$tar['peso']*$total_hene;//recuperamos el pesos de hene
	case 2:  $peso_yute=$tar['peso']*$total_yute;//recuperamos el pesos de yute
	case 3:  $peso_bolsa=$tar['peso']*$total_bolsa;//recuperamos el pesos de bolsa
	}
}

$total_kgs_netos=$total_kgs_brutos-$peso_hene-$peso_yute-$peso_bolsa;
$total_kgs_tara=$peso_hene+$peso_yute+$peso_bolsa;
/*CONVERTIMOS AL ARREGLOS PARA ENVIARLOS A LA BASE DE DATOS*/
$henequen="{".$henequen."}";
$yute="{".$yute."}";
$bolsa="{".$bolsa."}";
$kgs_brutos="{".$kgs_brutos."}";
$tonga="{".$tonga."}";



if($precio_kilo==0 or $precio_kilo<0)//VERIFICAMOS QUE EL PRECIO DEL KILO NO SEA 0
{
//$precio_kilo=get_precio_kilo($id_catalogo);
}
$subtotal=($total_kgs_netos*$precio_kilo)-$retencion_peso;
/*FIN DEL TRATAMIENTO DE LA INFORMACION*/



if($enviar=="GUARDAR")
	{
				$sql= "SET datestyle TO postgres, dmy; select co_genera_nentrada_egos('$idproductor','$id_almacen','$idcliente','$id_catalogo','$produccion','$fecha_nota','$vehiculo','$henequen','$yute','$bolsa','$kgs_brutos','$tonga','$resto_alimentos','$desechos_human','$olores_desa','$otros_organicos','$manchas_comb','$vehiculo_sucio','$olor_detergente','$otros_inorganicos','$precio_kilo','$rendimiento','$mancha','$humedad','$cerezo','$criba','$resultado_analisis','$constancia_cmc','$total_kgs_netos','$forma_pago',$no_cheque,$banco_cheque,'$costalera','$estado_costalera','$observaciones','$id_usuario','$total_kgs_brutos','$total_kgs_netos','$total_kgs_tara','$subtotal',$id_servicio,'$id_periodo',$retencion_p,$retencion_peso,$miembro_c,'$nserie')";


				$query = pg_query($con,$sql);
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('co_compras_id_compra_seq')::text,'co_compras','A','{$usuario}',
				'Alta de nota de entrada folio :'||(select folio from co_compras where id_compra=currval('co_compras_id_compra_seq')));";
				$querytmp = pg_query($con,$sql);
				

				while($row = pg_fetch_row($query))
            { 
						$resultado=$row[0];
						$consulta=1;
						
				}
	
	
		if($consulta>0)
		{
		
		$id_compra=substr($resultado,1,(strlen($resultado)));
		$id_compra = substr($id_compra, 0,-1);
		$id_compra=trim($id_compra);//obtenemos el id de la compra

		echo "<div align='center'><strong><font color='#003300'>La nota de entrada fue registrada correctamente</font></strong></div>";
		$fila=get_nota_arreglo($id_compra);  //cuando no hay una consulta determinada se consulta la primera solicitud
		
			if($fila!=0)
			{
				$modif=1;
				$id_compra=$fila["id_compra"];
				$id_almacen=$fila["id_almacen"];
				$id_periodo=$fila["id_periodo"];
				$idcliente=$fila["id_proveedor"];
				$id_catalogo=$fila["id_catalogo"];
				$produccion=$fila["produccion"];
				$fecha_nota=$fila["fecha_nota"];
				$vehiculo=$fila["vehiculo"];
				$folio=$fila["folio"];
				$resto_alimentos=$fila["resto_alimentos"];
				$desechos_human=$fila["desechos_human"];
				$olores_desa=$fila["olores_desa"];
				$otros_organicos=$fila["otros_organicos"];
				$manchas_comb=$fila["manchas_comb"];
				$vehiculo_sucio=$fila["vehiculo_sucio"];
				$olor_detergente=$fila["olor_detergente"];
				$otros_inorganicos=$fila["otros_inorganicos"];

				$precio_kilo=$fila["precio_kilo"];
				$rendimiento=$fila["rendimiento"];
				$mancha=$fila["mancha"];
				$humedad=$fila["humedad"];
				$cerezo=$fila["cerezo"];
				$criba=$fila["criba"];
				$resultado_analisis=$fila["resultado_analisis"];
				$constancia_cmc=$fila["constancia_cmc"];
				$forma_pago=$fila["forma_pago"];
				$no_cheque=$fila["no_cheque"];
				$banco_cheque=$fila["banco_cheque"];
				$costalera=$fila["costalera"];
				$estado_costalera=$fila["estado_costalera"];
				$observaciones=$fila["observaciones"];

				$total_kgs_brutos=$fila["total_kgs_brutos"];
				$total_kgs_netos=$fila["total_kgs_netos"];
				$total_tara=$fila["total_tara"];
				$total_kgs_neto2=$fila["total_kgs_neto2"];
				$subtotal=$fila["subtotal"];
				$nserie=$fila["serie"];
				$id_servicio=$fila["id_servicio"];
				include("nueva_nota.php");
			
			
			}
			else
			{
				include("nueva_nota.php");
			}
	
	
	
		}

		else
		{
		echo 0;
		exit;
		
		}


	}
	


?>