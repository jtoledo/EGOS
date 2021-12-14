<form name="captura_grupo" action="" class="formu">  
<table width="200" border="0">
   
    <tr>
      <td>Grupo</td>
      <td><span class="cliente">
        <?php 
	get_auto_grupo();
       ?>
        </span></td>
      </tr>
    
  </table>
   </form> 
<div align="center" id="detalles">
<?php $fila_grupo=get_grupo_m($idgrupo);?>


<form name="capturas" action="" onSubmit="valida_solicitudes(2); return false" class="formu">  


  <table width="80%" border="0">
    <tr>
      <td colspan="4"><li class="iheader">
        <div id="carga"></div>
        <h2 class="art-logo-text">
          COMIT&Eacute; DE CR&Eacute;DITO</h2>
      </li></td>
      </tr>
    <tr>
      <td colspan="4" align="center">  <?php echo "<font color='#000000'><strong>".nom($fila_grupo["grupo"])."</strong></font>"; ?></td>
      </tr>
   
      <tr>
        <td>Solicitudes Agendadas</td>
      <td>
        <div id="sol_agendadas">
          <?php get_solicitudes_agendadas_m($idgrupo); ?>
          </div>
        </td>
      
      <td>Solicitudes Autorizadas</td>
      <td>
	  <div id="sol_auto">
	  <?php get_solicitudes_autorizadas_m($idgrupo); ?>
      </div>
      </td>
      
     
      
      </tr>
  </table>
 </form> 

<div align="center" id="comite">
</div>



</div>