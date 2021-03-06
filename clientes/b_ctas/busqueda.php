<?php
include("../../includes/constantes.php");
include("../../includes/funciones.php");
include("../../bd/conexion.php");
require('include/funciones.php');
require('include/pagination.class.php');
$con=conectarse();
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
if(isset($_GET['q']) and !eregi('^ *$',$_GET['q'])){
		$q = sql_quote($_GET['q']); //para ejecutar consulta
		$busqueda = $q; //para mostrar en pantalla

		$sqlStr = "SELECT * FROM cuentas WHERE idpadre=4448 and upper(descripcion) like upper('%$q%')";
		$sqlStrAux = "SELECT count(*) as total FROM cuentas WHERE idpadre=4448 and upper(descripcion) like upper('%$q%')";
	}else{
		$sqlStr = "SELECT * FROM cuentas where idpadre=4448";
		$sqlStrAux = "SELECT count(*) as total FROM cuentas where idpadre=4448";
	}

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
          echo "\t\t<tr class=\"row$r\"><td><a href=\"#\" onclick=\"regresa_idcuenta($idcuenta);return false\">".$resp."</a></td></tr>\n";
          if($r%2==0)++$r;
		  else--$r;
        }
			echo "\t</table>\n";
			$p->show();
		}
	?>