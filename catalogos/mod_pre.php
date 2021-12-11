<form name="captura" action="" onSubmit="valida_modarticulos(1); return false" class="formu">  
 
	<table width="900" border="0" cellpadding="20px">
  <tr>
	<td valign="top">
		<h4 class="art-logo-text">    
			       
	CAMBIO DE PRECIOS EN EL CAFE</h4>
	<li class="iheader"></li>    
    <table border="0">    
	 <tr>    
    <td>Producto:<?php echo $idarticulos;?></td>
    <td colspan="3"><span class="cliente">
      <select name="idarticulos" class="consultor" id="idarticulos" style="width:200px" onchange="actualiza_articulos_selec(1); return false">
        <option value="">Seleccione Producto<?php echo $idarticulos;?></option>
        <?php
		  
		  
		  						$consulta_c="SELECT id_catalogo,descripcion FROM al_cat_articulos  order by descripcion ";
								
                     	$id_query_c = pg_query($con,$consulta_c);
                     	
                     	while( $fila_c= pg_fetch_array($id_query_c) )
                        {  
								$producto=$fila_c["descripcion"];
						
						?>
        <option value="<?php echo $fila_c["id_catalogo"]?>"><?php echo nom($producto); ?></option>
			        
        <?php
					
						}
		  
		  
	  ?>
      </select>
    </span>
    
    </td>
    </tr>
	<tr><td colspan="3">
			<div id="precios_update" >	
	 
			</div>
	</td></tr>	    
    </table>
   </td>   
    <td colspan="5"  valign="top">
	  
		 
		 
		 
		 <h4 class="art-logo-text">    
			       
	LISTA DE PRECIOS</h4>
	<li class="iheader"></li>
		<div id="lp" style="height:300px;overflow:scroll">
		
		</div>	
		 <script type="text/javascript" >
				listar_catalogo();
		 </script>      
    
		</td>
  </tr>
  
  
 
</table>



</form>