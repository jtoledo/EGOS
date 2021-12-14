<?
include("../mysql/conexion.php");

/*$consulta=
				"  SELECT menu.id_menu, menu.opcion\n" .
                "  FROM menu \n" .
                " where menu.id_menu not in 
		    ( \n" .
                "	select perfiles_usr.id_menu from perfiles_usr where perfiles_usr.id_perfil= " . $id_perfil . " )\n" .
               "and menu.tipo='P'\n" .
               "";
*/
$sql="SELECT * \n".

"FROM empleado\n". 
"where empleado.id_empleado not in (\n".
"select usuarios.id_usuario from usuarios where empleado.id_empleado=usuarios.id_usuario   )" .


"";
//usuarios.id_usuario order by empleado.nombre;
$res=mysql_query($sql); 
?>


    <div align="center">
      <table width="99">
        <tr>
          
          <th>Nombre            </th>
		     <th>Rfc		       </th>
		     <th>Direcci&oacute;n		       </th>
			 <th>Perfil		       </th>
	    </tr>
        
        
        <?
while($registro=mysql_fetch_array($res)) 
{ 
?> 
        <!-- tabla de resultados --> 
        <tr > 
          
          
          <td>
            <div align="center">
              <?
			  $id_empleado=$registro["id_empleado"];
			$rfc=$registro["rfc"];
			$dire=$registro["dire"];
			$id_perfil=$registro["id_perfil"];
		  $nombre=$registro["nombre"];
		  $ap_paterno=$registro["ap_paterno"];
		  $am_paterno=$registro["ap_materno"];
		  $nombre="$nombre $ap_paterno $ap_materno";

	    echo '<a href="agrega_user.php?id_empleado='.$id_empleado.'" >  <strong><span class="Estilo1">'.$nombre.'</span></strong>  </a>';		
	  ?>          
          </div></td>
          <td>
            <div align="center">
              <?
		   echo utf8_decode($rfc);
	  ?>          
          </div></td>
		  <td>
		    <div align="center">
		      <?
		   echo utf8_decode($dire);
	  ?>          
          </div></td>
		
		
		
		 <td>
		    <div align="center">
		      <?
		  
		  
		  $consulta=
				"SELECT nom_perfil from perfiles where id_perfil='$id_perfil' ";
                     	$id_query = mysql_query($consulta);
                     	while( $fila= mysql_fetch_array($id_query) )
                        {  
							
						echo utf8_decode($fila["nom_perfil"]);
						
						}
		  
		  
	  ?>          
          </div></td>
		
		
		
		
		
		
		  </tr>
        
        
		
		
		
		
        <? 
}

?>
      </table>
    </div>
