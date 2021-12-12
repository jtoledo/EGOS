<?php
	include("../includes/constantes.php");
	include("../includes/funciones.php");
	include("../bd/conexion.php"); 
	
	$idcliente=$_POST["idcliente"]; 
	$nota_sel=$_POST["sel_nota"]; 
   $idtservicio=$_POST["idtiposervicio"]; 
   $con= conectarse();
    

	
	echo "<select name='nt_asociada' id='nt_asociada' class='iselect'>";
	echo "<option value='' selected>Seleccione una nota</option>";
	if(!empty($nota_sel)) 
	{
		$consulta_sel=pg_query($con, "select case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio) as folio,fecha_nota,total_kgs_netos*precio_kilo as total from co_compras where case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio)='$nota_sel'");	
		$fila_sel=pg_fetch_array($consulta_sel);
		$folio_s=trim($fila_sel["folio"]);
		$fecha_s=$fila_sel["fecha_nota"];
		
		$subtotal=round($fila_sel["total"],2);
		$monto_s=number_format($subtotal,2);
												
		$desc="$folio_s -- Fecha--$fecha_s Total:-- $monto_s";		
		print("<option value=\"$folio_s\" selected>".$desc."</option>");	

	}	
	
	 $sql="SELECT case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio) as folio,fecha_nota,total_kgs_netos*precio_kilo as total FROM co_compras where estatus=true and id_proveedor='$idcliente'";
    $sql.=" except all (select case when trim(serie)!='' then trim(serie)||'-' else '' end||trim(folio) as folio,cm.fecha_nota,cm.total_kgs_netos*cm.precio_kilo as total from se_oservicios os,";
    $sql.="co_compras cm where trim(cm.folio)=trim(os.nota_asociada) and os.id_tipo_servicio='$idtservicio' and os.idcliente='$idcliente' and os.nota_asociada is not null) order by folio";
	 $consulta=pg_query($con, $sql);
	 
	while($fila=pg_fetch_array($consulta))
	{
		
						$folio_s=trim($fila["folio"]);
						$fecha_s=$fila["fecha_nota"];
						
						

						$subtotal=round($fila["total"],2);
						$monto_s=number_format($subtotal,2);
												
						$desc="$folio_s -- Fecha--$fecha_s Total:-- $monto_s";
						if(trim($nota_sel)==trim($folio_s)) 
						{
						 	echo "<option value='".$folio_s."' selected>".$desc."</option>";
						}else {
							echo "<option value='".$folio_s."'>".$desc."</option>";
						}
		     
	
	
	}
	echo "</select>";

?>
