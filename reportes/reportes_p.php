<blockquote><div align="center"><strong>Reportes</strong></div></blockquote>
<div align="center">
  <table width="200" border="0">
   
    <tr>
      <td align="center"><?php 

$img='<img src="'.$d.'dummies/pdf.png" alt="nota" style="WIDTH: 100px; HEIGHT: 100px">';

echo '<a href="'.$d.'reportes/reporte_sol_indv.php" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?>

      
      
      </td>
      <td align="center">  <?php 

$img='<img src="'.$d.'dummies/pdf.png" alt="nota" style="WIDTH: 100px; HEIGHT: 100px">';

echo '<a href="'.$d.'reportes/reporte_sol_grupos.php" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?>
</td>
      <td align="center">
       <?php 

$img='<img src="'.$d.'dummies/pdf.png" alt="nota" style="WIDTH: 100px; HEIGHT: 100px">';

echo '<a href="'.$d.'reportes/reporte_sol_agenda.php" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?>
    
      </td>
      <td align="center"> <?php 

$img='<img src="'.$d.'dummies/pdf.png" alt="nota" style="WIDTH: 100px; HEIGHT: 100px">';

echo '<a href="'.$d.'reportes/reporte_creditos_auto.php" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?></td>
      <td align="center"><?php 

$img='<img src="'.$d.'dummies/pdf.png" alt="nota" style="WIDTH: 100px; HEIGHT: 100px">';

echo '<a href="'.$d.'reportes/reporte_creditos_entregados.php" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?></td>
      <td align="center"><?php 

$img='<img src="'.$d.'dummies/pdf.png" alt="nota" style="WIDTH: 100px; HEIGHT: 100px">';

echo '<a href="'.$d.'reportes/reporte_compras.php" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?></td>
      <td align="center">
      <?php 

$img='<img src="'.$d.'dummies/pdf.png" alt="nota" style="WIDTH: 100px; HEIGHT: 100px">';

echo '<a href="'.$d.'reportes/reporte_servicios.php" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?>
      
      </td>
    </tr>
    
    <tr>
      <td><div align="center"><strong>Reportes Solicitudes Individuales</strong> </div></td>
      <td><div align="center">
       
          <p><strong>Reportes Solicitudes Grupales</strong> </p>
        
      </div></td>
      <td><div align="center"><strong>Solicitudes Agendadas</strong></div></td>
      <td><div align="center"><strong>Créditos Autorizados</strong></div></td>
      <td><div align="center"><strong>Créditos Entregados</strong></div></td>
      <td><div align="center"><strong>Compras</strong></div></td>
      <td><div align="center"><strong>Servicios</strong></div></td>
		</tr> 
		
		<tr>
		 <td align="center">
      	<?php 

				$img='<img src="'.$d.'images/excel.png" alt="nota" style="WIDTH: 50px; HEIGHT: 50px">';

				echo '<a href="'.$d.'reportes/cre_global_min.php?tipo_min=3" >  <strong><span class="Estilo1">

				'.$img.'

				</span></strong>  </a>';


		 	?>
      
      </td> 
      <td align="center">
      	<?php 

				$img='<img src="'.$d.'images/excel.png" alt="nota" style="WIDTH: 50px; HEIGHT: 50px">';

				echo '<a href="'.$d.'reportes/cat_cuentas.php" >  <strong><span class="Estilo1">

				'.$img.'

				</span></strong>  </a>';


		 	?>
      
      </td>   
       <td align="center">
      	<?php 

				 
				$img='<img src="'.$d.'dummies/reporte.png" alt="Saldos" style="WIDTH: 50px; HEIGHT: 50px">';

				echo '<a href="'.$d.'compras/reporte_calificacion.php" >  <strong><span class="Estilo1">

				'.$img.'

				</span></strong>  </a>';


		 	?>
      
      </td>
       <td align="center">
      	<?php 

				$img='<img src="'.$d.'images/excel.png" alt="Saldos" style="WIDTH: 50px; HEIGHT: 50px">';

				echo '<a href="'.$d.'reportes/historico_cliente.php" >  <strong><span class="Estilo1">

				'.$img.'

				</span></strong>  </a>';


		 	?>
      
      </td>
   </tr>		
		
	<tr>  
		    
       <td><div align="center"><strong>Créditos entregados</strong></div></td>
        <td><div align="center"><strong>Saldo de banco</strong></div></td>
        <td><div align="center"><strong>Reporte Calificación</strong></div></td>
        <td><div align="center"><strong>Historico de Cliente</strong></div></td>
    </tr>
  </table>
</div>
