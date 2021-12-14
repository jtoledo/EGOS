<?php

$RegistrosAMostrar=6;

//estos valores los recibo por GET
if(isset($_GET['pag'])){
	$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
	$PagAct=$_GET['pag'];
//caso contrario los iniciamos



include("../includes/constantes.php");
include("../bd/conexion.php");
include("../includes/funciones.php");
$con=conectarse();

}else{
	$RegistrosAEmpezar=0;
	$PagAct=1;
	
}



$sql="SELECT * FROM expediente where idcliente='$idcliente' order by tipo_archivo LIMIT $RegistrosAMostrar OFFSET $RegistrosAEmpezar ";


$res=pg_query($con,$sql); 
?>
<br />

    <div align="center">
     
	 <ul class="gallery clearfix">
	 
	  <table border="0">
        <tr>
          
          <th width="127">Documento</th>
	  <th width="81">Archivo</th>
	  <th> </th> 		
    </tr>
        
        
        <?php
while($registro=pg_fetch_array($res)) 
{ 
?> 
       
        <tr > 
          
          
          <td>
            <div align="center">
              <?php
			  $idarchivo=$registro["id_archivo"];
			  $idconcepto=$registro["idconcepto"];
			  $ubicacion=$registro["ubicacion"];
	  
	  
	  $nom_doc=get_documento($idconcepto);
	  
	  
//	  echo ucwords(strtolower(utf8_decode($nombre_perfil)));
	  
	/*echo '<a href="modif_perfil.php?perfil_id='.$perfil_id.'" >  <strong><span class="Estilo1">'.nom($nombre_perfil).'</span></strong>  </a>';  */
	 
	 echo nom($nom_doc);
	 
	  ?>        
	  
	  
	    
          </div></td>
   
  
  <td>
<li> <a href="<?php echo $ubicacion; ?>"  rel="prettyPhoto[]" title="<?php echo nom($nom_doc); ?>" >
  <img src="<?php echo $ubicacion; ?>"  width="50" height="50" />
  </a></li>
  </td>
 <td><form action="" method="post" name="frm1"><input type="hidden" name="vdel" value="<?php echo $idarchivo; ?>" />
 <input type=submit value='Eliminar'></form></td> 
  
   </tr>
   
   
		
        <?php 
}

?>
      </table>
	  
	  </ul>
	  <br />
<?php
//******--------determinar las páginas---------******//
$NroRegistros=pg_num_rows(pg_query($con,"SELECT * FROM expediente where idcliente='$idcliente'"));

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
echo "<a onclick=\"Pagina_u('1')\">Primero</a> ";
if($PagAct>1) 
echo "<a onclick=\"Pagina_u('$PagAnt')\">Anterior</a> ";
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt)  echo " <a onclick=\"Pagina_u('$PagSig')\">Siguiente</a> ";
echo "<a onclick=\"Pagina_u('$PagUlt')\">Ultimo</a>";


?>
	  
	  
    </div>
