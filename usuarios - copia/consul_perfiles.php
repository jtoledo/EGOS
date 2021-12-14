<?php
/*$sql="SELECT * \n".

"FROM empleado\n". 
"where empleado.id_empleado not in (\n".
"select usuarios.id_usuario from usuarios where empleado.id_empleado=usuarios.id_usuario   )" .
"";
*/
$RegistrosAMostrar=4;

//estos valores los recibo por GET
if(isset($_GET['pag'])){
	$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
	$PagAct=$_GET['pag'];
//caso contrario los iniciamos
include("../includes/constantes.php");
include("../bd/conexion.php");
$con=conectarse();

}else{
	$RegistrosAEmpezar=0;
	$PagAct=1;
	
}


$sql="SELECT * FROM perfiles order by id_perfil LIMIT $RegistrosAMostrar OFFSET $RegistrosAEmpezar ";
$res=pg_query($con,$sql); 
?>
<br />

    <div align="center">
      <table width="241" border="1" style="border-collapse:collapse;" >
        <tr>
          
          <th width="58">Nombre            </th>
		     <th width="167">Descripci&oacute;n		       </th>
	    </tr>
        
        
        <?php
while($registro=pg_fetch_array($res)) 
{ 
?> 
       
        <tr > 
          
          
          <td>
            <div align="center">
              <?php
			  $id_perfiles=$registro["id_perfil"];
			$nombre_perfil=$registro["nombre_perfil"];
			$descripcion=$registro["descripcion"];
	  
//	  echo ucwords(strtolower(utf8_decode($nombre_perfil)));
	  
	echo '<a href="modif_perfil.php?perfil_id='.$id_perfiles.'" >  <strong><span class="Estilo1">'.nom($nombre_perfil).'</span></strong>  </a>';  
	  ?>        
	  
	  
	    
          </div></td>
          <td>
            <div align="center">
              <?php
		   echo ucwords(strtolower(utf8_decode($descripcion)));
	  ?>          
          </div></td>
		
		
		
		
	    </tr>
        
        
		
		
		
		
        <?php 
}





?>
      </table>
	  
<br />
<?php
//******--------determinar las páginas---------******//
$NroRegistros=pg_num_rows(pg_query($con,"SELECT * FROM perfiles"));

$PagAnt=$PagAct-1;
$PagSig=$PagAct+1;
$PagUlt=$NroRegistros/$RegistrosAMostrar;

//verificamos residuo para ver si llevará decimales
$Res=$NroRegistros%$RegistrosAMostrar;
// si hay residuo usamos funcion floor para que me
// devuelva la parte entera, SIN REDONDEAR, y le sumamos
// una unidad para obtener la ultima pagina
if($Res>0) $PagUlt=floor($PagUlt)+1;

//desplazamiento
echo "<a onclick=\"Pagina('1')\">Primero</a> ";
if($PagAct>1) 
echo "<a onclick=\"Pagina('$PagAnt')\">Anterior</a> ";
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina('$PagSig')\">Siguiente</a> ";
echo "<a onclick=\"Pagina('$PagUlt')\">Ultimo</a>";
?>
	  
	  
    </div>
