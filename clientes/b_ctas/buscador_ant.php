<?php
session_start();
$form=$_GET["form"];
$orden=1; //ESPECIFICAR CUANDO ESTA DENTRO DE UNA CARPETA
$d="../"; //ESPECIFICAR PARA EL RECORRIDO DE MENU
$titulo="SISTEMA INTEGRAL DE INFORMACION";
include("../../includes/constantes.php");
include("../../includes/funciones.php");
include("../../bd/conexion.php");
require('include/funciones.php');
require('include/pagination.class.php');
require(CABECERA_MODAL_CUENTA);
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
if(isset($_GET['q']) or isset($_GET['cliente'])){
		$q = (isset($_GET['q'])?sql_quote($_GET['q']):sql_quote($_GET['cliente'])); //para ejecutar consulta
		
		$busqueda = $q; //para mostrar en pantalla

		$sqlStr = "SELECT * FROM cuentas WHERE idpadre=4679 and upper(descripcion) like upper('%$q%')";
		$sqlStrAux = "SELECT count(*) as total FROM cuentas WHERE idpadre=4679 and upper(descripcion) like upper('%$q%')";
	}else{
		$sqlStr = "SELECT * FROM cuentas where idpadre=4679";
		$sqlStrAux = "SELECT count(*) as total FROM cuentas where idpadre=4679";
	}

$aux = Pg_Fetch_Assoc(pg_query($con,$sqlStrAux));
$query = pg_query($con,$sqlStr.$limit);


?>
	<form action="index.php" onsubmit="return buscar_ant()">
      <label>Buscar</label> <input type="text" id="q" name="q" value="<?php if(isset($q)) echo $busqueda; else echo $_GET['cliente'];?>" onKeyUp="return buscar_ant()">
      <input type="submit" value="Buscar" id="boton">
      <span id="loading"></span>
    </form>
    <form action="index.php" onsubmit="return add_cliente_contabilidad_ant()">
		<input type="hidden" id="clienteadd" name="clienteadd" value="<?php echo $_GET['cliente'];?>">    	
    	<input type="submit" value="Agregar a <?php echo $_GET['cliente'];?>" id="botonadd">
    </form>
    <div id="resultados">
	<p><?php
				
		if($aux['total'] and isset($busqueda)){
				echo "{$aux['total']} Resultado".($aux['total']>1?'s':'')." que coinciden con tu b&uacute;squeda \"<strong>$busqueda</strong>\".";
			}elseif($aux['total'] and !isset($q)){
				echo "Total de registros: {$aux['total']}";
			}elseif(!$aux['total'] and isset($q)){
				echo"No hay registros que coincidan con tu b&uacute;squeda \"<strong>$busqueda</strong>\"";
			}
	?></p>

	<?php 
		if($aux['total']>0){
			$p = new pagination;
			$p->Items($aux['total']);
			$p->limit($items);
			if(isset($q))
					$p->target("buscador_ant.php?q=".urlencode($q));
				else
					$p->target("buscador_ant.php");
			$p->currentPage($page);
			$p->show();
			echo "\t<table class=\"registros\">\n";
			echo "<tr class=\"titulos\"><td>Cuenta Contable(Rubro de anticipo)</td></tr>\n";
			$r=0;
			while($row = pg_fetch_array($query)){
				
				        $clave_gral=$row["clave_gral"];
						$descripcion=$row["descripcion"];
						$tipo=$row["tipo"];
						$resp="$clave_gral $descripcion $tipo";
						$idcuenta=$row["idcuenta"];
				
          echo "\t\t<tr class=\"row$r\"><td><a href=\"#\" onclick=\"regresa_idcuenta_ant($idcuenta);return false\">".$resp."</a></td></tr>\n";
          if($r%2==0)++$r;else--$r;
        }
			echo "\t</table>\n";
			$p->show();
		}
	?>
    </div>
    

    

<?php
include (FOOTER_MODAL);  
?>
