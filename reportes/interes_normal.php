<?php 
ob_start(); 
include("../includes/constantes.php");
include("../includes/funciones.php");
include("../bd/conexion.php");
$fecha_f="13-11-2012";
$con=conectarse();
/***BEGIN ESTADO DE CUENTA***/
$sql="SET datestyle TO postgres, dmy; SELECT s.idcliente,s.idestatus,s.t_sol,c.folio,c.f_aprobacion,c.monto,c.idcredito FROM cc_solicitudes as s, cc_creditos as c    where s.idsolicitud=c.idsolicitud and c.cancelado='false' and c.f_ministracion<='$fecha_f'  order by c.folio";
	$consulta=pg_query($con,$sql);
	$sum_monto=0;
	$sum_monto_m=0;
	$sum_inormal=0;
	$sum_saldo=0;
	$cont=0;
	$fi=9;//filas generales
	$fm=9;//filas de la ministracion
	$fa=9;//filas de Anticipos
while($fila=pg_fetch_array($consulta))
{
	
$idcliente=$fila["idcliente"];
	
/*****************************************************************************MODULO DE MINISTRACIONES*/
$sqlm="SET datestyle TO postgres, dmy; 
SELECT
ca.fecha,
ca.ref_recibo as referencia,
ca.monto,
 '$fecha_f'::date-ca.fecha as dias_trans,
c.interes_normal as interes_normal,
0 as i_moratorio,
0 as pagos ,
'CAJA'::varchar as forma_pago
FROM cc_solicitudes as s, cc_creditos as c, cajas as ca, cc_cajas_ministracion as cam  where  s.idcliente='$idcliente' and  s.idsolicitud=c.idsolicitud  and c.idcredito=cam.idcredito  and cam.idmov=ca.idmov and ca.fecha<='$fecha_f'
UNION ALL
SELECT 
ch.fecha,
ch.ref_cheque as referencia,
ch.monto,
 '$fecha_f'::date-ch.fecha as dias_trans, 
c.interes_normal as interes_normal,
0 as i_moratorio,
0 as pagos,
'CHEQUE'::varchar as forma_pago
FROM cc_solicitudes as s, cc_creditos as c, cheques as ch, cc_cheques_ministracion as chm where  s.idcliente='$idcliente' and  s.idsolicitud=c.idsolicitud  and c.idcredito=chm.idcredito  and chm.idmov=ch.idmov and ch.fecha<='$fecha_f'
ORDER BY fecha

";

$consultam=pg_query($con,$sqlm);		
echo "<table border='1'>";
echo "<tr><td>Fecha de ministracion</td><td>Monto</td><td>Dias transcurridos</td><td>Interes</td></tr>";
while($filam=pg_fetch_array($consultam))
	{
$fecha_ministracion=date_dmy_ymd($filam["fecha"]); //cambia a formato y-m-d
$fecha_vencimiento=date_dmy_ymd($fecha_f); //cambia a formato y-m-d			
$interes_normal=get_interes_normal($filam["dias_trans"],$fecha_ministracion,$filam["monto"],$filam["interes_normal"]);				



echo "<tr>";
echo "<td>".$fecha_ministracion."</td>";
echo "<td>".$filam["monto"]."</td>";
echo "<td>".$filam["dias_trans"]."</td>";
echo "<td>".$interes_normal."</td>";


echo "</tr>";
echo "</table>";




break;

	}
		 	                        

/*****************************************************************************FINNNNNN MODULO DE MINISTRACIONES*/

/*****************************************************************************MODULO DE ANTICIPOS*/
$sqla="SET datestyle TO postgres, dmy; 
SELECT c.fecha,c.ref_cheque,c.monto
FROM cc_cheques_anticipos as a, cheques as c
WHERE
a.idcliente='$idcliente' and a.idmov=c.idmov and c.ch_cancelado=false and c.en_transito=true
order by c.fecha
";

$consultaa=pg_query($con,$sqla);		
while($filaa=pg_fetch_array($consultaa))
	{

	}
		 	                        


}

?>





