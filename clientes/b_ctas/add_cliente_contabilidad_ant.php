<?php
session_start();
include("../../includes/constantes.php");
include("../../includes/funciones.php");
include("../../bd/conexion.php");
require('include/funciones.php');
require('include/pagination.class.php');


$con=conectarse();
$cad_insert="";
$Errors="";
$busca_siexiste="";
$items = 10;
$page = 1;
if(isset($_GET['page']) and is_numeric($_GET['page']) and $page = $_GET['page'])
{
	if($page==1)
	$limit = " LIMIT $items";
	else	
	$limit = " LIMIT ".$items." OFFSET ".(($page-1)*$items);
}
else
{
$limit = " LIMIT $items";
}

//obtiene parametro
$q = sql_quote($_GET['q']); //para ejecutar consulta

$busca_siexiste="select count(*) as regenc from cuentas where idpadre=4679 and ";
$busca_siexiste.="descripcion=initcap(trim('".$q."')) and tipo='D' and nivel=3";

$found=Pg_Fetch_Assoc(pg_query($con,$busca_siexiste));

if($found['regenc']<=0){
	$cad_insert="select insertar_cuenta(4679,(select max(clave) from cuentas where idpadre=4679)+1,";
	$cad_insert.="trim(initcap('".$q."')),0.00,'D','D',6,false) as idcuenta";

	//agregar cliente
	$query = pg_query($con,$cad_insert);
				
				//registra logs
				$usuario=$_SESSION["nombre_u"];
				$sql="select registrar_logs(1,currval('cuentas_idcuenta_seq')::text,'cuentas','A','{$usuario}',
				'Alta de cuenta para el cliente:{$q} en la cuenta padre:4679');";
				$querytmp = pg_query($con,$sql);	
	
}else {
	$Errors="Imposible dar de alta al cliente en contabilidad porque ya existe....";
}

//consulta unaves agregado el nuevo cliente.
$busqueda = $q; //para mostrar en pantalla

$sqlStr = "SELECT * FROM cuentas WHERE idpadre=4679 and upper(descripcion) like upper('%$q%')";
$sqlStrAux = "SELECT count(*) as total FROM cuentas WHERE  idpadre=4679 and upper(descripcion) like upper('%$q%')";

$aux = Pg_Fetch_Assoc(pg_query($con,$sqlStrAux));
$query = pg_query($con,$sqlStr.$limit);

?>	<p><?php
		if($aux['total'] and isset($busqueda))
		{
		echo "{$aux['total']} Resultado".($aux['total']>1?'s':'')." que coinciden con tu b&uacute;squeda \"<strong>$busqueda</strong>\".";
		}
		elseif($aux['total'] and !isset($q))
		{
		echo "Total de registros: {$aux['total']}";
		}
		elseif(!$aux['total'] and isset($q))
		{
		echo"No hay registros que coincidan con tu b&uacute;squeda \"<strong>$busqueda</strong>\"";
		}
	   echo "<center>".$Errors."</center>";
	?></p>

	<?php 
		if($aux['total']>0){
			$p = new pagination;
			$p->Items($aux['total']);
			$p->limit($items);
			if(isset($q))
					$p->target("buscador.php?q=".urlencode($q));
				else
					$p->target("buscador.php");
			$p->currentPage($page);
			$p->show();
			echo "\t<table class=\"registros\">\n";
			echo "<tr class=\"titulos\"><td>Cuenta Contable</td></tr>\n";
			$r=0;
			while($row = pg_fetch_array($query)){
				
				        $clave_gral=$row["clave_gral"];
						$descripcion=$row["descripcion"];
						$tipo=$row["tipo"];
						$resp="$clave_gral $descripcion $tipo";
						$idcuenta=$row["idcuenta"];
          echo "\t\t<tr class=\"row$r\"><td><a href=\"#\" onclick=\"regresa_idcuenta_ant($idcuenta);return false\">".$resp."</a></td></tr>\n";
          if($r%2==0)++$r;
		  else--$r;
        }
			echo "\t</table>\n";
			
			$p->show();
		}
	?>