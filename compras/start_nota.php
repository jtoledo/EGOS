<form name="captura" action="" onSubmit="valida_solicitudes(2); return false" class="formu">  
<table width="100%" border="0">
  <tr>
    <td colspan="5"><li class="iheader">
		  <div id="carga"></div>
		<h2 class="art-logo-text">
	NOTA DE ENTRADA</h2>
	</li></td>
  </tr>
  
  <tr>
    <td>Proveedor</td>
    <td><span class="clientes_sol">
      <?php
    get_clientes_nota_tmp();
    ?>
    </span></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td><?php
    
    ?></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>