// Last updated 2006-02-21
function addRowToTable()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  
  iteration = lastRow;
  var row = tbl.insertRow(lastRow);
  
   
  var cellRight = row.insertCell(0);
  newID_cant = 'cantidad' + iteration;
  cant = '<input type="text" name="cantidad" onkeypress="return acceptNum(event)" id="'+newID_cant+'" size="10" onchange="calcula(this)" />';
  cellRight.innerHTML = cant;
  
  var cellRight = row.insertCell(1);
  newID_descrip='descripcion'+iteration;
  descripcion = '<input type="text" name="descripcion" onchange="conMayusculas(this)"  id="'+newID_descrip+'" size="45" />';
  cellRight.innerHTML = descripcion;
  
  var cellRight = row.insertCell(2);
  newID_pre='p_uni'+iteration;
  p_uni = '<input type="text" name="p_uni" id="'+newID_pre+'" size="10" onchange="calcula(this)"/>';
  cellRight.innerHTML = p_uni;
  
  var cellRight = row.insertCell(3);
  newID_impor='importe'+iteration;
  impor = '<input type="text" name="importe" onkeypress="return acceptNum(event)" id="'+newID_impor+'" size="10" readonly="readonly" />';
  cellRight.innerHTML = impor;

 

  /* select cell
  var cellRightSel = row.insertCell(2);
  var sel = document.createElement('select');
  sel.name = 'selRow' + iteration;
  sel.options[0] = new Option('text zero', 'value0');
  sel.options[1] = new Option('text one', 'value1');
  cellRightSel.appendChild(sel);*/
}

function removeRowFromTable()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
  calcula();
}


function calcula()
{
  var tbl = document.getElementById('tblSample');
  var lastRow = tbl.rows.length;
  var iteracion = lastRow;
  
  var cantidad= new Array();
  var descripcion=new Array();
  var p_uni=new Array();
  var importe=new Array();
  var subtotal=0,cant_id,descrip_id,pre_id,importe_id,cant_dat,descrip_dat,pre_dat,total,iva;

  for(i=1;i<iteracion;i++)
     {
    cant_id = "cantidad"+i; 
    descrip_id = "descripcion"+i;  
    pre_id = "p_uni"+i;
    importe_id = "importe"+i;
    

	cant_dat = document.getElementById(cant_id).value;
    pre_dat = document.getElementById(pre_id).value; 
	
	   
    importe[i]=cant_dat*pre_dat;
    subtotal=subtotal+importe[i];
    document.getElementById(importe_id).value=importe[i];
     
  }
     iva=subtotal*.11;
     total=subtotal+iva;
     document.captura2.subtotal.value=subtotal;
     document.captura2.iva.value=iva;    
     document.captura2.total.value=total;    
}






/*
  
  

function openInNewWindow(frm)
{
  // open a blank window
  var aWindow = window.open('', 'TableAddRowNewWindow',
   'scrollbars=yes,menubar=yes,resizable=yes,toolbar=no,width=400,height=400');
   
  // set the target to the blank window
  frm.target = 'TableAddRowNewWindow';
  
  // submit
  frm.submit();
}


function keyPressTest(e, obj)
{
  var validateChkb = document.getElementById('chkValidateOnKeyPress');
  if (validateChkb.checked) {
    var displayObj = document.getElementById('spanOutput');
    var key;
    if(window.event) {
      key = window.event.keyCode; 
    }
    else if(e.which) {
      key = e.which;
    }
    var objId;
    if (obj != null) {
      objId = obj.id;
    } else {
      objId = this.id;
    }
    displayObj.innerHTML = objId + ' : ' + String.fromCharCode(key);
  }
}


function validateRow(frm)
{
  var chkb = document.getElementById('chkValidate');
  if (chkb.checked) {
    var tbl = document.getElementById('tblSample');
    var lastRow = tbl.rows.length - 1;
    var i;
    for (i=1; i<=lastRow; i++) {
      var aRow = document.getElementById('txtRow' + i);
      if (aRow.value.length <= 0) {
        alert('Row ' + i + ' is empty');
        return;
      }
    }
  }
  openInNewWindow(frm);
}
*/
