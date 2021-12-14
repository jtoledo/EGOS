<?php
include("../mysql/conexion.php");
$titulo="Ingreso de Empleados";
include(CABECERA);
?>

  <form name="captura" action="" onSubmit="alta_empleados(); return false">

    <div align="center">
      <table class="Record art-article"  >	    	
        
        <tr>
          <th>
            
          Nombre      </th>
					    <td>
					      <input type="text" name="nombre" size="30" maxlength="50" value=""  onChange="conMayusculas(this)">				      </td>
		      </tr>						
        
        <tr>
          <th>
            
            Apellido Paterno        </th>
					    <td>
					      <input type="text" name="ap_paterno" size="30" maxlength="50" value=""  onChange="conMayusculas(this)">				      </td>
		      </tr>	
        
        <tr>
          <th>
            
          Apellido Materno      </th>
					    <td>
					      <input type="text" name="ap_materno" size="30" maxlength="50" value=""  onChange="conMayusculas(this)">				      </td>
		      </tr>	
        
        
        
      <!--  <tr>
          <th>
            
          Rfc      </th>
					    <td>
					      <input type="text" name="rfc" size="30" maxlength="50" value=""  onChange="conMayusculas(this)">				      </td>
		      </tr>					
        -->
        
       <!-- <tr>
          <th>
            
          Curp      </th>
					    <td>
					      <input type="text" name="curp" size="30" maxlength="50" value=""  onChange="conMayusculas(this)">				      </td>
		      </tr>	-->
        
        
        
        <tr>
          <th>
            
          G&eacute;nero      </th>
					    <td>
					      
					      <select name="sexo">
						  <option value="">Seleccione</option>
					        <option value="Hombre">Masculino</option>
					        <option value="Mujer">Femenino</option>
				          </select>				      </td>
		      </tr>	
        
     <!--   <tr>
          <th >
            
                       
          Direcci&oacute;n      </th>
					    <td>
					      <input type="text" name="dire" size="30" maxlength="50" value="" onChange="conMayusculas(this)">				      </td>
		      </tr>
        
        <tr>
          <th >
                                  
          C&oacute;digo Postal      </th>
					    <td>
					      <input type="text" name="cod_postal" size="30" maxlength="50" value="" onkeypress="return acceptNum(event)">				      </td>
		      </tr>
        
        <tr>
          <th >Email</th>
        <td ><input type="text" name="email" size="20" maxlength="200" value="" id="email" onchange="if ( !this.value.match(/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/) ) { this.value = '' }" onfocus="if (this.value == '') this.value = '';" title="El Formato correcto es: nombre@dominio.servidor";/></td>
      </tr>
        
        -->
        <tr>
          <th >
            
          Perfil      </th>
					    <td>
					      <select name="id_perfil" id="id_perfil">
					        <option value=''>------ SELECCIONE PERFIL DE USUARIO------</option>
					        
					        <?
		  
		   $consulta="SELECT * FROM perfiles ORDER BY nom_perfil";
                     $id_query = mysql_query($consulta);
                     while( $fila= mysql_fetch_array($id_query) )
                        {  
						$b=$fila["id_perfil"];
						
						 print("<option value=\"$b\">".$fila["nom_perfil"]."</option>");
                                 
                        }
						
			?>
				          </select>				      </td>
		      </tr>	
            
        
		
		
        <tr >
          <td colspan="2">
            
            
          <center>						<input class="art-button" type="submit" name="enviar" id="enviar" value="GUARDAR" >                </center>        </td>
	  </tr>
        </table>
    </div>
  </form>
		  
		   
<div id="empleados"></div>

 <?
$back=5;
include(FOOTER);

?>