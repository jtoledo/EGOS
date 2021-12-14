<? 
$criterio = ""; 
$txt_criterio = ""; 
if ($_GET["criterio"]!=""){ 
   $txt_criterio = $_GET["criterio"]; 
   $criterio = " where nombre like '%"  ; 
} 
$sql="SELECT * FROM empleado"; 
$res=mysql_query($sql); 
$numeroRegistros=mysql_num_rows($res); 
if($numeroRegistros<=0) 
{ 
    
    echo "<font face='verdana' size='-2'>No se encontraron resultados</font>"; 
    
}else{ 
    //////////elementos para el orden 
    if(!isset($orden)) 
    { 
       $orden="nombre"; 
    } 
    //////////fin elementos de orden 

    //////////calculo de elementos necesarios para paginacion 
    //tamao de la pagina 
    $tamPag=20; 

    //pagina actual si no esta definida y limites 
    if(!isset($_GET["pagina"])) 
    { 
       $pagina=1; 
       $inicio=1; 
       $final=$tamPag; 
    }else{ 
       $pagina = $_GET["pagina"]; 
    } 
    //calculo del limite inferior 
    $limitInf=($pagina-1)*$tamPag; 

    //calculo del numero de paginas 
    $numPags=ceil($numeroRegistros/$tamPag); 
    if(!isset($pagina)) 
    { 
       $pagina=1; 
       $inicio=1; 
       $final=$tamPag; 
    }else{ 
       $seccionActual=intval(($pagina-1)/$tamPag); 
       $inicio=($seccionActual*$tamPag)+1; 

       if($pagina<$numPags) 
       { 
          $final=$inicio+$tamPag-1; 
       }else{ 
          $final=$numPags; 
       } 

       if ($final>$numPags){ 
          $final=$numPags; 
       } 
    } 


$sql="SELECT * FROM empleado
order by $orden LIMIT $tamPag OFFSET  $limitInf ";

$res=mysql_query($sql); 

//////////fin consulta con limites 
echo "<font face='verdana' size='-2'>encontrados ".$numeroRegistros." resultados</font>"; 
//echo "ordenados por <b>".$orden."</b>"; 
if(isset($txt_criterio)){ 
  //  echo "<br>Valor filtro: <b>".$txt_criterio."</b>"; 
} 
?>

  <table class="Record art-article" >
 
	  <th >Nombre </th>
	  
	   
	   <th >Perfil </th>
		
		    
        <?
while($registro=mysql_fetch_array($res)) 
{ 
$nombre=$registro["nombre"]; 
	$ap_paterno=$registro["ap_paterno"]; 
	$ap_materno=$registro["ap_materno"]; 
	$id_empleado=$registro["id_empleado"];
	$nombre="$nombre $ap_paterno $ap_materno";
	
	$id_perfil=$registro["id_perfil"];



?> 
      <!-- tabla de resultados --> 
      <tr > 
        
      
      
	  <td>
	  <?
//	  echo utf8_decode($nombre);
	  
	  
	  echo '<a href="modif_empleados.php?id_empleado='.$id_empleado.'" >  <strong><span class="Estilo1">'.utf8_decode($nombre).'</span></strong>  </a>';		
	  
	  
	  ?>
	  </td>
	  
  
	   <td>
	  <?
	  $sql="select * from perfiles where id_perfil='$id_perfil'";
	  $consulta=mysql_query($sql);
	  while($fila_p=mysql_fetch_array($consulta))
	  {
	  $descripcion=$fila_p["nom_perfil"];
	  }
	  
	  echo utf8_decode($descripcion);
	  ?>
	  </td>
	  
	  
      
      </tr>
    
    <!-- fin tabla resultados --> 
    <? 
}//fin while 

?>
  </table>
<?
}//fin if 
//////////a partir de aqui viene la paginacion 
?> 
    <br> 
    <table class="Record art-article" > 
    <tr >
	<td > 
<? 
    if($pagina>1) 
    { 
       echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&orden=".$orden."&criterio=".$txt_criterio."'>"; 
       echo "<font face='verdana' size='-2'>anterior</font>"; 
       echo "</a> "; 
    } 

    for($i=$inicio;$i<=$final;$i++) 
    { 
       if($i==$pagina) 
       { 
          echo "<font face='verdana' size='-2'><b>".$i."</b> </font>"; 
       }else{ 
          echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&orden=".$orden."&criterio=".$txt_criterio."'>"; 
          echo "<font face='verdana' size='-2'>".$i."</font></a> "; 
       } 
    } 
    if($pagina<$numPags) 
   { 
       echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&orden=".$orden."&criterio=".$txt_criterio."'>"; 
       echo "<font face='verdana' size='-2'>siguiente</font></a>"; 
   } 
   ///////fin de la paginacion 

?> 
</td>
   </tr>
</table>