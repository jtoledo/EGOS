<form name="captura" action=""    class="formu">
<table width="808" border="0">
  <tr>
    <td><li class="iheader"><h2 class="art-logo-text">Requerimiento de procesos del paquete tecnol&oacute;gico</h2></li></td>
    </tr>
  <tr>
    <td><div align="center">Procesos existentes</div></td>
    </tr>
  <tr>
    <td><div align="center">
      <?php proceso_actualiza_m($idproceso); ?>
    </div></td>
    </tr>
  <tr>
    <td><div align="center">Requerimientos
    </div></td>
    </tr>
  <tr>
    <td> <div id="reque">
      <div align="center">
         <?php consulta_requerimiento_n($idproceso); ?>
      </div>
    </div></td>
    </tr>
  </table>
</form>
<div id="form_reque">
  <form name="reque" action="" onSubmit="add_reque(2); return false"  class="formu">
 <input type="hidden" name="idproceso" value="<? echo $idproceso; ?>" />     

  <table width="808"  border="0">

  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center"><strong>Requerimiento</strong></div></td>
    <td colspan="5"><input name="requerimiento" type="text" class="modif" id="requerimiento"  size="20" maxlength="255" onChange="conMayusculas(this)"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="140"><div align="center"><strong>U de medida / Servicio </strong></div></td>
    <td width="87"><div align="center"><strong>Cantidad</strong></div></td>
    <td width="55"><div align="center"><strong>Ciclos</strong></div></td>
    <td width="86"><div align="center"><strong>Total ciclos </strong></div></td>
    <td width="52"><div align="center"><strong>$/UN</strong></div></td>
    <td width="58"><div align="center"><strong>$ Total </strong></div></td>
    <td width="70"><div align="center"><strong>Porciento Productor </strong></div></td>
    <td width="100"><div align="center"><strong>Cuota Cr&eacute;dito </strong></div></td>
    <td width="122"><div align="center"><strong>Aportaci&oacute;n Productor </strong></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <?php get_unidad($iduni); ?>
    </div></td>
    <td><input type="text" name="cantidad" size="20" maxlength="200" id="cantidad" class="peque" onkeypress="return acceptNum(event)"   onchange="llenar_campo(); return false"></td>
    <td><input name="ciclos" type="text" class="peque" id="ciclos" onkeypress="return acceptNum(event)" size="20" maxlength="200"  onchange="llenar_campo(); return false"></td>
    <td><input name="total_ciclos" type="text" class="peque" id="total_ciclos" onkeypress="return acceptNum(event)" size="20" maxlength="200"  readonly="readonly"></td>
    <td><input name="un" type="text" class="peque" id="un" onkeypress="return acceptNum(event)" size="20" maxlength="200" onchange="llenar_campo(); return false"></td>
    <td><input name="total" type="text" class="peque" id="total" onkeypress="return acceptNum(event)" size="20" maxlength="200"  readonly="readonly"></td>
    <td><input name="porciento_produ" type="text" class="peque" id="porciento_produ" onkeypress="return acceptNum(event)" size="20" maxlength="200"  onchange="llenar_campo(); return false"></td>
    <td><input name="cuota_credi" type="text" class="peque" id="cuota_credi" onkeypress="return acceptNum(event)" size="20" maxlength="200"  readonly="readonly"></td>
    <td><input name="aporta_produ" type="text" class="peque" id="aporta_produ" onkeypress="return acceptNum(event)" size="20" maxlength="200" readonly="readonly"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php 

$img='<img src="../images/i_pdf.png" alt="nota" style="WIDTH: 40px; HEIGHT: 40px">';

echo '<a href="../TCPDF/tcpdf/examples/pdf_procesos.php" >  <strong><span class="Estilo1">

'.$img.'

</span></strong>  </a>';


		 ?></td>
    <td><div align="left"><strong>Procesos Grales</strong> </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
      <div align="center">
        <input class="ibutton" type="submit" name="enviar" id="enviar" value="GUARDAR" />
        </div></td>
  </tr>
</table>

</form>

</div>