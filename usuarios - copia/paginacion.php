<? 
$criterio = ""; 
$txt_criterio = ""; 
if ($_GET["criterio"]!=""){ 
   $txt_criterio = $_GET["criterio"]; 
   $criterio = " where user_name like '%"  ; 
} 
$sql="SELECT * FROM usuarios"; 
$res=mysql_query($sql); 
$numeroRegistros=mysql_num_rows($res); 
if($numeroRegistros<=0) 
{ 
    
    echo "<font face='verdana' size='-2'>No se encontraron resultados</font>"; 
    
}else{ 
    //////////elementos para el orden 
    if(!isset($orden)) 
    { 
       $orden="id_usuario"; 
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


$sql="SELECT * FROM usuarios,empleado,perfiles where usuarios.id_usuario=empleado.id_empleado and perfiles.id_perfil=usuarios.id_perfil
order by $orden LIMIT $tamPag OFFSET  $limitInf ";

$res=mysql_query($sql); 

//////////fin consulta con limites 
echo "<font face='verdana' size='-2'>encontrados ".$numeroRegistros." resultados</font>"; 
//echo "ordenados por <b>".$orden."</b>"; 
if(isset($txt_criterio)){ 
  //  echo "<br>Valor filtro: <b>".$txt_criterio."</b>"; 
} 
?>

  <table width="432" class="Record art-article" >
  <tr>
    	<td>Nombre</td>
   		<td width="51" class="th">RFC</td>
        <td width="110" class="th">Direcci&oacute;n</td>
		<td width="31" class="th">Perfil</td>
        <th width="47" class="th">Usuario</th>
        <?
while($registro=mysql_fetch_array($res)) 
{ 
?> 
      <!-- tabla de resultados --> 
    <tr > 
        
       <td width="169">
        <b><? 
	
	$nombre=$registro["nombre"]." ".$registro["ap_paterno"]." ".$registro["ap_materno"];
	$rfc=$registro["rfc"];
	$direccion=$registro["dire"];		
	$nom_perfil=$registro["nom_perfil"];
	$usua=$registro["user_name"];
	$id_usuario=$registro["id_usuario"];
	
  echo '<a href="modif_usuarios.php?id_usuario='.$id_usuario.'" >  <strong><span class="Estilo1">'.$nombre.'</span></strong>  </a>';		
		
	
	
	
	?></b>        </td> 
      <td><? echo utf8_decode($rfc); ?></td>
      <td><? echo utf8_decode($direccion); ?></td>
      <td><? echo utf8_decode($nom_perfil); ?></td>
      <td><div align="center"><? echo utf8_decode($usua); ?></div></td>
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