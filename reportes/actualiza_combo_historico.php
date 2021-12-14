<?php
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php"); 

session_start();
$tipo_orden=$_POST["tipo_orden"];
$idsucursal=$_SESSION['mov_sucursal'];
$con=conectarse();

	switch($tipo_orden) {
			case 1:	
					$sql="select cl.idcliente,c.idcredito ,cl.nombre,cl.ap_paterno,cl.ap_materno,
					(
						coalesce((select sum(cj.monto)  from cc_cajas_ministracion cm,cajas cj 
						where  cj.rbo_cancelado=false and cm.idmov=cj.idmov and cm.id_periodo=s.id_periodo and
						cm.idcredito in (select idcredito from cc_creditos cre,cc_solicitudes sol,cc_clientes cli where cre.idsolicitud=sol.idsolicitud 
						and sol.idcliente=cli.idcliente and cli.idcliente=cl.idcliente and idestatus=3)),0.00) +

						coalesce((select sum(ch.monto)  from cc_cheques_ministracion cm,cheques ch 
						where  ch.ch_cancelado=false and cm.idmov=ch.idmov  and cm.id_periodo=s.id_periodo and
						cm.idcredito in (select idcredito from cc_creditos cre,cc_solicitudes sol,cc_clientes cli where cre.idsolicitud=sol.idsolicitud 
						and sol.idcliente=cli.idcliente and cli.idcliente=cl.idcliente and idestatus=3)),0.00) +

						coalesce((select sum(interes) from calculo_interes_especial(cl.idcliente,now()::date,s.id_sucursal,s.id_periodo) AS 
						(fecha_disposicion date,fecha_corte date,fecha_vencimiento date,cns_pagare integer,idcredito integer,
						pago_realizado numeric(16,2),capital_financiado numeric(16,2),interes numeric(16,2),pago numeric(16,2),taza_interes numeric(6,2),
						dias_periodo int,idcargo integer)),0.00) +
		
						coalesce((select sum(monto) from cc_cheques_anticipos ca,cheques c where ca.idmov=c.idmov and idcliente=cl.idcliente 		
						and c.ch_cancelado=false and ca.id_periodo=s.id_periodo),0.00)  +

						coalesce((select sum(total) from se_oservicios sv, se_nombre_servicios ns 
						where sv.id_tipo_servicio=ns.id_tipo_servicio and sv.idcliente=cl.idcliente and sv.id_periodo=s.id_periodo),0.00) + 

						coalesce((select sum(costo_kgsalida*total_kgs_netos) as monto  from co_compras cm,se_servicios sr 
						where cm.estatus=true and cm.id_servicio=sr.id_servicio and cm.id_proveedor=cl.idcliente and cm.id_periodo=s.id_periodo
						),0.00) 
					) 
					
					-
					(
						coalesce((select sum(monto_cobrado) from re_cobros_realizados where estatus=true and cns_pagare in
						(select pg.cns_pagare from cc_pagares pg,cc_creditos cr,cc_solicitudes sol,cc_clientes cli 
						where cr.idsolicitud=sol.idsolicitud and sol.idcliente=cli.idcliente and cr.idcredito=pg.idcredito 
						and cli.idcliente=cl.idcliente and pg.cancelado=false and cr.id_periodo=s.id_periodo)),0.00)  +

						coalesce((select sum(monto_cobrado) from re_cobros_realizados where estatus=true and idctaxcobrar in
						(select idctaxcobrar from cc_cheques_anticipos ca,cheques c,co_ctasxcobrar cxc where c.idmov=cxc.idmov and ca.idmov=c.idmov 
						and idcliente=cl.idcliente and c.ch_cancelado=false and ca.id_periodo=s.id_periodo)),0.00) +


						coalesce((select sum(monto_cobrado) from re_cobros_realizados  where estatus=true and id_servicio in
						(select sv.id_servicio from se_oservicios sv, se_nombre_servicios ns 
						where sv.id_tipo_servicio=ns.id_tipo_servicio and sv.idcliente=cl.idcliente and sv.id_periodo=s.id_periodo)),0.00) +


						coalesce((select sum(monto_cobrado) from re_cobros_realizados where estatus=false and id_secado in
						(select sr.id_servicio from co_compras cm,se_servicios sr 
						where cm.estatus=true and cm.id_servicio=sr.id_servicio and cm.id_proveedor=cl.idcliente
						and cm.id_periodo=s.id_periodo) ),0.00)  
					) as saldo,s.id_periodo
	
					from cc_clientes cl,cc_solicitudes s,cc_creditos c where cl.idcliente=s.idcliente and s.idsolicitud=c.idsolicitud 
					and c.id_periodo=(select max(id_periodo) from co_pcosecha) and s.id_sucursal=$idsucursal order by saldo desc";
					
					$sql1="select cl.idcliente,c.idcredito ,cl.nombre,cl.ap_paterno,cl.ap_materno,
					(
						coalesce((select sum(cj.monto)  from cc_cajas_ministracion cm,cajas cj 
						where  cj.rbo_cancelado=false and cm.idmov=cj.idmov and cm.id_periodo=s.id_periodo and
						cm.idcredito in (select idcredito from cc_creditos cre,cc_solicitudes sol,cc_clientes cli where cre.idsolicitud=sol.idsolicitud 
						and sol.idcliente=cli.idcliente and cli.idcliente=cl.idcliente and idestatus=3)),0.00) +

						coalesce((select sum(ch.monto)  from cc_cheques_ministracion cm,cheques ch 
						where  ch.ch_cancelado=false and cm.idmov=ch.idmov  and cm.id_periodo=s.id_periodo and
						cm.idcredito in (select idcredito from cc_creditos cre,cc_solicitudes sol,cc_clientes cli where cre.idsolicitud=sol.idsolicitud 
						and sol.idcliente=cli.idcliente and cli.idcliente=cl.idcliente and idestatus=3)),0.00) +

						coalesce((select sum(interes) from calculo_interes_especial(cl.idcliente,now()::date,s.id_sucursal,s.id_periodo) AS 
						(fecha_disposicion date,fecha_corte date,fecha_vencimiento date,cns_pagare integer,idcredito integer,
						pago_realizado numeric(16,2),capital_financiado numeric(16,2),interes numeric(16,2),pago numeric(16,2),taza_interes numeric(6,2),
						dias_periodo int,idcargo integer)),0.00) +
		
						coalesce((select sum(monto) from cc_cheques_anticipos ca,cheques c where ca.idmov=c.idmov and idcliente=cl.idcliente 		
						and c.ch_cancelado=false and ca.id_periodo=s.id_periodo),0.00)  +

						coalesce((select sum(total) from se_oservicios sv, se_nombre_servicios ns 
						where sv.id_tipo_servicio=ns.id_tipo_servicio and sv.idcliente=cl.idcliente and sv.id_periodo=s.id_periodo),0.00) + 

						coalesce((select sum(costo_kgsalida*total_kgs_netos) as monto  from co_compras cm,se_servicios sr 
						where cm.estatus=true and cm.id_servicio=sr.id_servicio and cm.id_proveedor=cl.idcliente and cm.id_periodo=s.id_periodo
						),0.00) 
					) 
					
					-
					(
						coalesce((select sum(monto_cobrado) from re_cobros_realizados where estatus=true and cns_pagare in
						(select pg.cns_pagare from cc_pagares pg,cc_creditos cr,cc_solicitudes sol,cc_clientes cli 
						where cr.idsolicitud=sol.idsolicitud and sol.idcliente=cli.idcliente and cr.idcredito=pg.idcredito 
						and cli.idcliente=cl.idcliente and pg.cancelado=false and cr.id_periodo=s.id_periodo)),0.00)  +

						coalesce((select sum(monto_cobrado) from re_cobros_realizados where estatus=true and idctaxcobrar in
						(select idctaxcobrar from cc_cheques_anticipos ca,cheques c,co_ctasxcobrar cxc where c.idmov=cxc.idmov and ca.idmov=c.idmov 
						and idcliente=cl.idcliente and c.ch_cancelado=false and ca.id_periodo=s.id_periodo)),0.00) +


						coalesce((select sum(monto_cobrado) from re_cobros_realizados  where estatus=true and id_servicio in
						(select sv.id_servicio from se_oservicios sv, se_nombre_servicios ns 
						where sv.id_tipo_servicio=ns.id_tipo_servicio and sv.idcliente=cl.idcliente and sv.id_periodo=s.id_periodo)),0.00) +


						coalesce((select sum(monto_cobrado) from re_cobros_realizados where estatus=false and id_secado in
						(select sr.id_servicio from co_compras cm,se_servicios sr 
						where cm.estatus=true and cm.id_servicio=sr.id_servicio and cm.id_proveedor=cl.idcliente
						and cm.id_periodo=s.id_periodo) ),0.00)  
					) as saldo,s.id_periodo
	
					from cc_clientes cl,cc_solicitudes s,cc_creditos c where cl.idcliente=s.idcliente and s.idsolicitud=c.idsolicitud and 

					(
						coalesce((select sum(cj.monto)  from cc_cajas_ministracion cm,cajas cj 
						where  cj.rbo_cancelado=false and cm.idmov=cj.idmov and cm.id_periodo=s.id_periodo and
						cm.idcredito in (select idcredito from cc_creditos cre,cc_solicitudes sol,cc_clientes cli where cre.idsolicitud=sol.idsolicitud 
						and sol.idcliente=cli.idcliente and cli.idcliente=cl.idcliente and idestatus=3)),0.00) +

						coalesce((select sum(ch.monto)  from cc_cheques_ministracion cm,cheques ch 
						where  ch.ch_cancelado=false and cm.idmov=ch.idmov  and cm.id_periodo=s.id_periodo and
						cm.idcredito in (select idcredito from cc_creditos cre,cc_solicitudes sol,cc_clientes cli where cre.idsolicitud=sol.idsolicitud 
						and sol.idcliente=cli.idcliente and cli.idcliente=cl.idcliente and idestatus=3)),0.00) +

						coalesce((select sum(interes) from calculo_interes_especial(cl.idcliente,now()::date,s.id_sucursal,s.id_periodo) AS 
						(fecha_disposicion date,fecha_corte date,fecha_vencimiento date,cns_pagare integer,idcredito integer,
						pago_realizado numeric(16,2),capital_financiado numeric(16,2),interes numeric(16,2),pago numeric(16,2),taza_interes numeric(6,2),
						dias_periodo int,idcargo integer)),0.00) +
		
						coalesce((select sum(monto) from cc_cheques_anticipos ca,cheques c where ca.idmov=c.idmov and idcliente=cl.idcliente 		
						and c.ch_cancelado=false and ca.id_periodo=s.id_periodo),0.00)  +

						coalesce((select sum(total) from se_oservicios sv, se_nombre_servicios ns 
						where sv.id_tipo_servicio=ns.id_tipo_servicio and sv.idcliente=cl.idcliente and sv.id_periodo=s.id_periodo),0.00) + 

						coalesce((select sum(costo_kgsalida*total_kgs_netos) as monto  from co_compras cm,se_servicios sr 
						where cm.estatus=true and cm.id_servicio=sr.id_servicio and cm.id_proveedor=cl.idcliente and cm.id_periodo=s.id_periodo
						),0.00) 
					) 
					
					-
					(
						coalesce((select sum(monto_cobrado) from re_cobros_realizados where estatus=true and cns_pagare in
						(select pg.cns_pagare from cc_pagares pg,cc_creditos cr,cc_solicitudes sol,cc_clientes cli 
						where cr.idsolicitud=sol.idsolicitud and sol.idcliente=cli.idcliente and cr.idcredito=pg.idcredito 
						and cli.idcliente=cl.idcliente and pg.cancelado=false and cr.id_periodo=s.id_periodo)),0.00)  +

						coalesce((select sum(monto_cobrado) from re_cobros_realizados where estatus=true and idctaxcobrar in
						(select idctaxcobrar from cc_cheques_anticipos ca,cheques c,co_ctasxcobrar cxc where c.idmov=cxc.idmov and ca.idmov=c.idmov 
						and idcliente=cl.idcliente and c.ch_cancelado=false and ca.id_periodo=s.id_periodo)),0.00) +


						coalesce((select sum(monto_cobrado) from re_cobros_realizados  where estatus=true and id_servicio in
						(select sv.id_servicio from se_oservicios sv, se_nombre_servicios ns 
						where sv.id_tipo_servicio=ns.id_tipo_servicio and sv.idcliente=cl.idcliente and sv.id_periodo=s.id_periodo)),0.00) +


						coalesce((select sum(monto_cobrado) from re_cobros_realizados where estatus=false and id_secado in
						(select sr.id_servicio from co_compras cm,se_servicios sr 
						where cm.estatus=true and cm.id_servicio=sr.id_servicio and cm.id_proveedor=cl.idcliente
						and cm.id_periodo=s.id_periodo) ),0.00)  
					) >0 and cl.deuda_cero=false and
					
					cl.idcliente not in (select cl.idcliente	from cc_clientes cl,cc_solicitudes s,
					cc_creditos c where cl.idcliente=s.idcliente and s.idsolicitud=c.idsolicitud 
					and c.id_periodo=(select max(id_periodo) from co_pcosecha))
					
					and c.id_periodo<(select max(id_periodo) from co_pcosecha) and s.id_sucursal=$idsucursal order by saldo desc";
					break;
			case 2:	
					$sql="SELECT * FROM cc_clientes order by nombre ";
					$sql1="";
					break;
	}
  
	
	//dojoType='dijit.form.FilteringSelect'
	$id_periodo=$_SESSION['cosecha_sel'];
   $id_sucursal=$_SESSION['mov_sucursal']; 
	echo "<select name='idcliente' id='idcliente' onChange='reporte_historico_cliente(".$id_periodo.",".$id_sucursal."); return false' class='modif'>";
	echo "<option value='' >Seleccione cliente</option>";
 
   $consulta=pg_query($con,$sql);
   $control=0; 
	 while($fila=pg_fetch_array($consulta))
	{
							$b=$fila["idcliente"];
							$nom_clientes=" ".$fila["nombre"]." ".$fila["ap_paterno"]." ".$fila["ap_materno"]."  ";
						   $saldo=$fila["saldo"];
					if($fila["saldo"]>0) {		
						 if($idcliente==$b)
						 print("<option value=\"$b\" selected>".nom($nom_clientes)." </option>");
						 else
						print("<option value=\"$b\">".nom($nom_clientes)." </option>");
               }else {
   					 if(!empty($sql1) and $control==0) {
   					 		$control=1;
   					 		$consulta1=pg_query($con,$sql1);
		 						while($fila1=pg_fetch_array($consulta1))
								{	
									$b=$fila1["idcliente"];
									$nom_clientes=" ".$fila1["nombre"]." ".$fila1["ap_paterno"]." ".$fila1["ap_materno"]."  ";
							 
						 			if($idcliente==$b)
						 				print("<option value=\"$b\" selected>".nom($nom_clientes)."</option>");
						 			else
										print("<option value=\"$b\">".nom($nom_clientes)."</option>");
                                 
								}   
								
      				  }	
      				  //si no entro a meter las cosechas anteriores pone los saldos en cero
      				  if($idcliente==$b)
						 		print("<option value=\"$b\" selected>".nom($nom_clientes)." </option>");
						  else
								print("<option value=\"$b\">".nom($nom_clientes)." </option>");            
	               
               }                  
	
	
	}
	
 	echo "</select>";    
?>		