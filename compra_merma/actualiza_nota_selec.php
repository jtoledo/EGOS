<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 
$idcliente = $_POST["idcliente"];
$form = $_POST["form"];
$id_compra = $_POST["id_compra"];

session_start();
$id_usuario=$_SESSION["usuario"];

/* aqui voy hacer toda validacion para las mermas */

$con=conectarse();

$errores = validar_campos_obligatorios(array($idcliente));	

//$valida_almacen = validar_campos_obligatorios(array($id_almacen));	
$valida_compra = validar_campos_obligatorios(array($id_compra));	

	
	if(!empty($errores))
	{
		$band=1;
	}
	/*if(!empty($valida_almacen))
	{
		
	}*/
	$band_almacen=1;
	if(!empty($valida_compra))
	{
		$band_compra=1;
	}

	
	
	if($band==1 and $form==1 and $band_almacen==1)
	{
	   
			$fila=get_exits_nota_cliente($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);// comprueba si el cliente tiene notas de entrada si no tiene lo manda a crear una nueva nota
			if($fila!=0)
			{
			
			$fila=get_nota_arreglo_individual_merma($idcliente,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);	
			$modif=1;
			$id_compra=$fila["id_compra"];
			$id_periodo=$fila["id_periodo"];
			$id_almacen=$fila["id_almacen"];
			$idcliente=$fila["id_proveedor"];
			$idproductor=$fila["id_productor"];
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

			$retencion_p=$fila["retencion_p"];
			$retencion_peso=$fila["retencion_peso"];
			$miembro_c=$fila["miembro_cmc"];	
			$nserie=$fila["serie"];
			
			$total_kgs_brutos=$fila["total_kgs_brutos"];
			$total_kgs_netos=$fila["total_kgs_netos"];
			$total_tara=$fila["total_tara"];
			$total_kgs_neto2=$fila["total_kgs_neto2"];
			
			$subtotal=round(($fila["total_kgs_neto2"]*$fila["precio_kilo"])-$fila["retencion_peso"],2);
			//$fila["subtotal"];
			$id_servicio=$fila["id_servicio"];
			
			$deshabilita=((get_ntcompra_used($id_compra)>0 and $precio_kilo>0)?"disabled title='No se modifica porque ya tiene movimientos aplicados'":"2");
			include("nota_m.php");
			}
			else
			{
			include("nota_new.php"); 
			}
		

	
	}
		if($band==1 and $form==2 and $band_almacen==1)
	{
	   
			
			include("nota_new.php"); 
		

	
	}
	
	if($band==1 and $form==3 and $band_almacen==1)
	{
	   $fila=get_nota_arreglo_merma($id_compra,$_SESSION['mov_sucursal'],$_SESSION['cosecha_sel']);  //cuando no hay una consulta determinada se consulta la primera solicitud
	   if($fila!=0)
			{
			$modif=1;
$id_compra=$fila["id_compra"];
$id_periodo=$fila["id_periodo"];
$id_almacen=$fila["id_almacen"];
$idcliente=$fila["id_proveedor"];
$idproductor=$fila["id_productor"];
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

$retencion_p=$fila["retencion_p"];
$retencion_peso=$fila["retencion_peso"];
$miembro_c=$fila["miembro_cmc"];
$nserie=$fila["serie"];
			
$total_kgs_brutos=$fila["total_kgs_brutos"];
$total_kgs_netos=$fila["total_kgs_netos"];
$total_tara=$fila["total_tara"];
$total_kgs_neto2=$fila["total_kgs_neto2"];
$subtotal=round(($fila["total_kgs_neto2"]*$fila["precio_kilo"])-$fila["retencion_peso"],2);
//$subtotal=$fila["subtotal"];
$id_servicio=$fila["id_servicio"];

$deshabilita=((get_ntcompra_used($id_compra)>0 and $precio_kilo>0)?"disabled title='No se modifica porque ya tiene movimientos aplicados'":"2");
include("nota_m.php");
			
			
			}
			else
			{
			include("nota_new.php");
			}
			
			
		

	
	}



?>