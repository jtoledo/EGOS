function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;

}


 function serializa_arreglo(array)
{
 var serial=array[0];
  for (i=1; i<array.length; i++)
   serial += ',' + array[i];
   return serial;
}




function limpia_mano()
{
	document.captura.concep.value="";
}


function autoriza_solicitud(idsolicitud,form){
	
if(idsolicitud=="")
{
 alert("Selecciona  Solicitud"); 
 document.capturas.idsolicitud.focus(); 
 return 0; 
				 
}
	
	
	divFormulario = document.getElementById('comite');
	barra= document.getElementById('iFishEye_example_1');
	fish1= document.getElementById('fish1');
	fish2= document.getElementById('fish2');
   fish3= document.getElementById('fish3');
   fish4= document.getElementById('fish4');
   fish5= document.getElementById('fish5');
   
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_comite_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {

			datarecibe=ajax.responseText.split("|");			
			
					
			divFormulario.innerHTML = datarecibe[0]+datarecibe[2];
			if (datarecibe[1]=="0") {
				barra.style.display='none';			
			}else {			
				barra.style.display='';
			}				
			datarepor=fish1.href.split("=");			
			fish1.href=	datarepor[0]+"="+datarecibe[1];
			datarepor=fish2.href.split("=");			
			fish2.href=	datarepor[0]+"="+datarecibe[1];
			datarepor=fish3.href.split("=");			
			fish3.href=	datarepor[0]+"="+datarecibe[1];
			datarepor=fish4.href.split("=");			
			fish4.href=	datarepor[0]+"="+datarecibe[1];
			datarepor=fish5.href.split("=");			
			fish5.href=	datarepor[0]+"="+datarecibe[1];
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idsolicitud="+idsolicitud+"&form="+form)

}

function autoriza_solicitud_grupo(idsolicitud,form){
	
if(idsolicitud=="")
{
 alert("Selecciona  Solicitud"); 
 document.capturas.idsolicitud.focus(); 
 return 0; 
				 
}




	divFormulario = document.getElementById('comite');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_comite_selec_grupo.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idsolicitud="+idsolicitud+"&form="+form)

}

function rellenar_notas(idcliente,sel_nota,idtiposervicio){
	
	divFormulario = document.getElementById('notas_e');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_notase.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcliente="+idcliente+"&sel_nota="+sel_nota+"&idtiposervicio="+idtiposervicio)

}






function cc_autoriza_solicitud(form_m){
	
	if (document.captura.monto_auto.value.length==0)
	{ 
      	 alert("Monto autorizado no puede ser vacio"); 
      	 document.captura.monto_auto.focus(); 
      	 return 0; 
	}
	if (document.captura.fecha_comite.value.length==0)
	{ 
      	 alert("Fecha de comite no puede ser vacio"); 
      	 document.captura.fecha_comite.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fecha_ministracion.value.length==0)
	{ 
      	 alert("Fecha de ministracion no puede ser vacio"); 
      	 document.captura.fecha_ministracion.focus(); 
      	 return 0; 
	}
	
	f_ministra_pfinan=null;
	iddispo=0;	
	if (parseFloat(document.captura.monto_finan.value)>0.00)
	{			
				
		if (document.captura.f_ministra_pfinan.value.length==0)
		{ 
      	 alert("Fecha de ministracion Parafinanciera no puede ser vacio"); 
      	 document.captura.f_ministra_pfinan.focus(); 
      	 return 0; 
		}else{
			f_ministra_pfinan=document.captura.f_ministra_pfinan.value;
		}
		if (parseInt(document.captura.iddispo.value)<=0)
		{ 
      	 alert("Seleccione la fecha de disposicion."); 
      	 document.captura.iddispo.focus(); 
      	 return 0; 
		}else {
			iddispo=document.captura.iddispo.value;
		}
	}
if(form_m==2)
	{
	
	idcredito=document.captura.idcredito.value;
	interes_nor=document.captura.interes_normal.value;
	interes_mor=document.captura.interes_moratorio.value;
	
	}

folio_sol=document.captura.folio_sol.value;

alert("La solicitud "+folio_sol+"  sera autorizado en unos momentos");




	divFormulario = document.getElementById('comite');
	sol_agendadas = document.getElementById('sol_agendadas');
	sol_auto = document.getElementById('sol_auto');
	
	
	
	
	
	
	idsolicitud=document.captura.idsolicitud.value;
	monto_auto=document.captura.monto_auto.value;
	monto_finan= document.captura.monto_finan.value;	
	fecha_comite=document.captura.fecha_comite.value;
	fecha_ministracion=document.captura.fecha_ministracion.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_comite_selec.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			if(ajax.responseText==0)
			{
			alert("Error acuda con el admon del sistema");
			}
			else
			{
			
			data = ajax.responseText.split("#separador");
			divFormulario.innerHTML = data[0];
			sol_agendadas.innerHTML = data[1];
			sol_auto.innerHTML = data[2];
			
			divFormulario.style.display="block";
			}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==2) //modificar
{
	
	//alert("aca estamos");
ajax.send("iddispo="+iddispo+"&f_ministra_pfinan="+f_ministra_pfinan+"&monto_finan="+monto_finan+"&idsolicitud="+idsolicitud+"&interes_nor="+interes_nor+"&interes_mor="+interes_mor+"&monto_auto="+monto_auto+"&fecha_comite="+fecha_comite+"&fecha_ministracion="+fecha_ministracion+"&enviar="+enviar+"&idcredito="+idcredito+"&form="+form_m);

}
if(form_m==3)//guardar
{
	//alert("aca estamos2");
	
	
ajax.send("iddispo="+iddispo+"&f_ministra_pfinan="+f_ministra_pfinan+"&monto_finan="+monto_finan+"&idsolicitud="+idsolicitud+"&monto_auto="+monto_auto+"&fecha_comite="+fecha_comite+"&fecha_ministracion="+fecha_ministracion+"&enviar="+enviar+"&form="+form_m);

}

}


function cc_autoriza_solicitud_grupo(form_m){
	
	if (document.captura.monto_auto.value.length==0)
	{ 
      	 alert("Monto autorizado no puede ser vacio"); 
      	 document.captura.monto_auto.focus(); 
      	 return 0; 
	}
	if (document.captura.fecha_comite.value.length==0)
	{ 
      	 alert("Fecha de comite no puede ser vacio"); 
      	 document.captura.fecha_comite.focus(); 
      	 return 0; 
	}
	
	if (document.captura.fecha_ministracion.value.length==0)
	{ 
      	 alert("Fecha de ministracion no puede ser vacio"); 
      	 document.captura.fecha_ministracion.focus(); 
      	 return 0; 
	}

if(form_m==2)
	{
	
	idcredito=document.captura.idcredito.value;
	
	}

folio_sol=document.captura.folio_sol.value;

alert("La solicitud "+folio_sol+"  sera autorizado en unos momentos");




	divFormulario = document.getElementById('comite');
	sol_agendadas = document.getElementById('sol_agendadas');
	sol_auto = document.getElementById('sol_auto');
	
	
	
	
	
	
	idsolicitud=document.captura.idsolicitud.value;
	monto_auto=document.captura.monto_auto.value;
	fecha_comite=document.captura.fecha_comite.value;
	fecha_ministracion=document.captura.fecha_ministracion.value;
	enviar=document.captura.enviar.value;
	
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_comite_selec_grupo.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			if(ajax.responseText==0)
			{
			alert("Error acuda con el admon del sistema");
			}
			else
			{
			
			data = ajax.responseText.split("#separador");
			divFormulario.innerHTML = data[0];
			sol_agendadas.innerHTML = data[1];
			sol_auto.innerHTML = data[2];
			
			divFormulario.style.display="block";
			}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


if(form_m==2) //modificar
{
	
	//alert("aca estamos");
ajax.send("idsolicitud="+idsolicitud+"&monto_auto="+monto_auto+"&fecha_comite="+fecha_comite+"&fecha_ministracion="+fecha_ministracion+"&enviar="+enviar+"&idcredito="+idcredito+"&form="+form_m);

}
if(form_m==3)//guardar
{
	//alert("aca estamos2");
	
ajax.send("idsolicitud="+idsolicitud+"&monto_auto="+monto_auto+"&fecha_comite="+fecha_comite+"&fecha_ministracion="+fecha_ministracion+"&enviar="+enviar+"&form="+form_m);

}

}




function cc_update_credito_select(valor,form){
	
if(valor=="")
{
 alert("Selecciona  Opcion"); 
 return 0; 
				 
}




	divFormulario = document.getElementById('consulta_creditos');
	bloque = document.getElementById('bloque');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_creditos_select.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText;
			bloque.innerHTML = "";
			
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("valor="+valor+"&form="+form)

}

function cambia_status_credito(valor,form,idcredito){
	if (confirm('Cambiando estatus del credito'))
	{
	 
			divFormulario = document.getElementById('consulta_creditos');
			ajax=objetoAjax();
			ajax.open("POST", "actualiza_creditos_select.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText;
					document.captura.consulta_credito.value="";
					//alert (estatus);
					//divFormulario.style.display="block";
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("valor="+valor+"&form="+form+"&idcredito="+idcredito)
	}

}


function cc_update_documentos_credito(idcredito,form){
	
if(idcredito=="")
{
 alert("Seleccione credito entregado"); 
 return 0; 
				 
}


	divFormulario = document.getElementById('bloque');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_creditos_select.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcredito="+idcredito+"&form="+form)

}

function cc_actualiza_sol_expediente(idcliente,form){

if(idcliente=="")
{
 alert("Selecciona  un cliente"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('update_sol');
	//carga = document.getElementById('carga');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_creditos_select.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			divFormulario.innerHTML = ajax.responseText
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}

function cc_actualiza_detalle_cliente_credito(idcredito,form){
if(idcredito=="")
{
 alert("Selecciona  Credito"); 
 document.captura.idcredito.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('detalles');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_creditos_select.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divFormulario.innerHTML = ajax.responseText
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("idcredito="+idcredito+"&form="+form)

}



function cc_validad_creditos_entre(form){
	
folio=document.captura_credito.folio.value;
if (confirm("El credito "+folio+" Cambiara a entregado en unos momentos"))
{
	
	
	
			if (document.captura_credito.f_entrega.value.length==0)
			{ 
				 alert("Fecha de entrega no puede ser vacio"); 
				 document.captura_credito.f_entrega.focus(); 
				 return 0; 
			}
			
				
			if (document.captura_credito.observaciones.value==0)
			{ 
				 alert("Observaciones de credito no puede ser vacio"); 
				 document.captura_credito.observaciones.focus(); 
				 return 0; 
			}
			if (document.captura_credito.monto_auto.value==0)
			{ 
				 alert("Monto autorizado no puede ser vacio"); 
				 document.captura_credito.monto_auto.focus(); 
				 return 0; 
			}
		
		
			divFormulario = document.getElementById('detalles');
			f_entrega=document.captura_credito.f_entrega.value;
			observaciones=document.captura_credito.observaciones.value;
			idcredito=document.captura_credito.idcredito.value;
			monto_auto=document.captura_credito.monto_auto.value;
			
			enviar=document.captura_credito.enviar.value;
			ajax=objetoAjax();
			ajax.open("POST", "actualiza_creditos_select.php");
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
					alert("Error acuda con el admon del sistema");
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					
					divFormulario.style.display="block";
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		
		
ajax.send("idcredito="+idcredito+"&f_entrega="+f_entrega+"&observaciones="+observaciones+"&enviar="+enviar+"&form="+form+"&monto_auto="+monto_auto);

}
}


/*FUNCIONES DEL PROCESO DE NOTAS DE ENTRADA*/
function actualiza_nota_cliente(idcliente,form){


if(idcliente=="")
{
 alert("Elije a un cliente"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('contenido');
	carga = document.getElementById('carga');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_nota_selec.php");
	carga.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}

function actualiza_nota_cliente_tmp(idcliente,form){


if(idcliente=="")
{
 alert("Elije a un cliente"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('contenido');
	carga = document.getElementById('carga');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_nota_selec_tmp.php");
	carga.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}

function actualiza_cliente_form(){


	
idcliente=document.captura.idcliente.value;
id_almacen=document.captura.id_almacen.value;
form=1;

if(id_almacen=="")
{
 alert("Seleccione almacen"); 
 document.captura.id_almacen.focus(); 
 return 0; 
				 
}



if(idcliente!="")
{
 actualiza_nota_cliente(idcliente,form);
 return 0; 
				 
}




}


/*FUNCIONES PARA QUE LA TABLA SE AUTOINCREMENTE EN LAS NOTAS DE ENTRADA */

function removeRowFromTable()
{
  var tbl = document.getElementById('myTable');
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
}


function deltonga(t)
    {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;

			  var tbl = document.getElementById('myTable');
			  var lastRow = tbl.rows.length;
			  if (lastRow > 2) 
			  {
					table.removeChild(tr);
			  }
			  
			calcula_kgs_netos();
			  
    }


function displayResult()
{

	bandera=1;
	//divFormulario = document.getElementById('update_ref_banco');

	ajax=objetoAjax();
	ajax.open("POST", "get_tonga.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			

	tonga=ajax.responseText;

//************nos posicionamos en la tabla que controla las pesadas
var table=document.getElementById("myTable");
var lastRow = table.rows.length;

if(lastRow>=19)//**validamos que no se excedan las pesadas
{
	alert("Se excede numero maximo de pesadas");
	return 0;
}


var iteration = lastRow;
var row = table.insertRow(lastRow);

	    var td = row.parentNode;
        var tr = row.parentNode;
		td.align='center';



if(tonga!=0)
{
       // var table = tr.parentNode;
       // table.removeChild(tr);


var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);


	

					cell1.innerHTML="<div align='center'><input type='text' name='hene[]' size='15' maxlength='50' value=''  id='hene' onKeyPress='return acceptNum(event)' autocomplete='off' class='peque' onchange='calcula_kgs_netos()' onkeyup='calcula_kgs_netos()'></div>";
					cell2.innerHTML="<div align='center'><input type='text' name='yute[]' size='15' maxlength='50' value=''  id='yute' onKeyPress='return acceptNum(event)' autocomplete='off' class='peque' onchange='calcula_kgs_netos()' onkeyup='calcula_kgs_netos()'></div>";
					cell3.innerHTML="<div align='center'><input type='text' name='bolsa[]' size='15' maxlength='50' value=''  id='bolsa' onKeyPress='return acceptNum(event)' autocomplete='off' class='peque' onchange='calcula_kgs_netos()' onkeyup='calcula_kgs_netos()'></div>";
					cell4.innerHTML="<div align='center'><input type='text' name='kgs_brutos[]' size='15' maxlength='50' value=''  id='kgs_brutos' onKeyPress='return acceptNum(event)' autocomplete='off' class='peque' onchange='calcula_kgs_netos()' onkeyup='calcula_kgs_netos()'></div>";
					
					cell5.innerHTML="<div align='center'>"+tonga+"</div>";
					
					cell6.innerHTML="<input type='button' onclick='deltonga(this)' value='Eliminar'>";
					

}
else
{
	alert("Ocurrio un error acuda con el admon del sistema");
	 return 0; 
	
}

					
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("bandera="+bandera)

}


/*TERMINAS LAS FUNCIONES DE LOS INCREMENTOS DE LAS TABLAS DE NOTA DE ENTRADA */

/*VALIDACIONES DE LA NOTA DE ENTRADA*/

function guarda_nota(form){
	
//folio=document.captura_credito.folio.value;
//if (confirm("El credito "+folio+" Cambiara a entregado en unos momentos"))

if (confirm("Esta completamente seguro que registro las pesadas correctamente ?"))
{
			
				
			if (document.captura.idcliente.value.length==0)
			{ 
				 alert("Proveedor no puede ser vacio"); 
				 document.captura.idcliente.focus(); 
				 return 0; 
			}
			if (document.captura.idproductor.value.length==0)
			{ 
				 alert("Productor no puede ser vacio"); 
				 document.captura.idproductor.focus(); 
				 return 0; 
			}
			if (document.captura.id_series.value=='0')
			{ 
				 alert("Seleccione la serie de la nota..."); 
				 document.captura.id_series.focus(); 
				 return 0; 
			}
			if (document.captura.id_catalogo.value.length==0)
			{ 
				 alert("Producto no puede ser vacio"); 
				 document.captura.id_catalogo.focus(); 
				 return 0; 
			}
			if (document.captura.produccion.value.length==0)
			{ 
				 alert("Produccion no puede ser vacio"); 
				 document.captura.produccion.focus(); 
				 return 0; 
			}
			if (document.captura.fecha_nota.value.length==0)
			{ 
				 alert("Fecha de la nota no puede ser vacio"); 
				 document.captura.fecha_nota.focus(); 
				 return 0; 
			}
			if (document.captura.vehiculo.value.length==0)
			{ 
				 alert("Datos del vehiculo no puede ser vacio"); 
				 document.captura.vehiculo.focus(); 
				 return 0; 
			}
			
			
			
			if (document.captura.precio_kilo.value.length==0)
			{ 
				 alert("Precio kilo no puede ser vacio"); 
				 document.captura.precio_kilo.focus(); 
				 return 0; 
			}
			if (document.captura.folio.value.length==0)
			{ 
				var folion='';				 
			}else {
				if(document.captura.folio.value.indexOf('.') != -1){
					alert("??En el folio no se permiten caracteres que no sean numericos!"); 
				 	document.captura.folio.focus(); 
				 	return 0;
				}				
				var folion=document.captura.folio.value;	
			}
		
		//validar cuando sea cliente 4C
		 			
			if (document.captura.produccion.value=='4c')
			{ 				
				if ((document.captura.kgentrega.value - document.captura.total_kgs_neto2.value.replace(/\,/g,''))<=0)
				{					 
				 	alert("La entrega de producto ha sobre pasado lo esperado en la cosecha"); 
				 	//return 0;
				} 
			}
		/*validamos radio button*/
		
	
	//validad analisis sensorial
	
	var s = "no"; 

			with (document.captura)
	{ 
		for ( var i = 0; i < resultado_analisis.length; i++ ) 
		{ 
			if ( resultado_analisis[i].checked ) 
			{ 
			s= "si"; 
	
			//window.alert("Ha seleccionado: \n" + entra_garantia[i].value); 
			break; 
			} 
		} 
			if ( s == "no" )
			{ 
			
			window.alert("Analisis sensorial no puede ser vacio" ) ; 
			return 0; 
			

			} 
	}	
	//termina la validadcion
	//validad forma de pago
	
	if (document.captura.forma_pago.value.length==0)
			{ 
				 alert("Forma de pago no puede ser vacio"); 
				 document.captura.forma_pago.focus(); 
				 return 0; 
			}
	//termina la validadcion
		
	/*valida costalera*/	
	var s = "no"; 

			with (document.captura)
	{ 
		for ( var i = 0; i < costalera.length; i++ ) 
		{ 
			if ( costalera[i].checked ) 
			{ 
			s= "si"; 
	
			//window.alert("Ha seleccionado: \n" + entra_garantia[i].value); 
			break; 
			} 
		} 
			if ( s == "no" )
			{ 
			
			window.alert("Costalera no puede ser vacio" ) ; 
			return 0; 
			

			} 
	}
	
	/*termina validacion de costalera*/
		
		/*validacion estado de la costalera*/
		
		var s = "no"; 

			with (document.captura)
	{ 
		for ( var i = 0; i < estado_costalera.length; i++ ) 
		{ 
			if ( estado_costalera[i].checked ) 
			{ 
			s= "si"; 
	
			//window.alert("Ha seleccionado: \n" + entra_garantia[i].value); 
			break; 
			} 
		} 
			if ( s == "no" )
			{ 
			
			window.alert("Estado de la costalera no puede ser vacio" ) ; 
			return 0; 
			

			} 
	}
	
	/*DECLARAMOS TODOS LOS ARREGLOS: HENEQUEN, YUTE, BOLSA, KILOGRAMOS BRUTOS, NUMERO DE TONGA*/
	
	var arreglo_hene=new Array();
	var arreglo_yute=new Array();
	var arreglo_bolsa=new Array();
	var arreglo_kgsbrutos=new Array();
	var arreglo_tonga=new Array();

	var henequen = document.getElementsByName("hene[]");
	var yute = document.getElementsByName("yute[]");
	var bolsa = document.getElementsByName("bolsa[]");
	var kgs_brutos = document.getElementsByName("kgs_brutos[]");
	var tonga = document.getElementsByName("id_tonga[]");
	
	/*FIN DE LAS DECLARACIONES*/

//Como todas las pesadas forzosamente son del mismo tama??o solo se recorre una sola vez
var contador=0;
var conta_kgs=0;
var tongas=0;


  for (var i = 0; i < henequen.length; i++) 
	{
	
	if(henequen[i].value.length==0)
	henequen[i].value=0;
	if(yute[i].value.length==0)
	yute[i].value=0;
	if(bolsa[i].value.length==0)
	bolsa[i].value=0;
	
	

	
	contador=contador+henequen[i].value+yute[i].value+bolsa[i].value;
	
		if(contador<=0)
		{
		alert("La pesada no puede ir vacia");
		return 0;
		}
		
	conta_kgs=kgs_brutos[i].value;
		if(conta_kgs<=0)
		{
		alert("Kilogramos brutos no puede ser vacio");
		return 0;
		}
		
		
		
		tongas=tonga[i].value;
		if(tongas<=0)
		{
		alert("Tonga no puede ir vacia");
		return 0;
		}
		
	  contador=0;
	  conta_kgs=0;
	  tongas=0;
    }


/*GUARDAMOS TODAS LAS PESADAS EN ARREGLOS PARA PODER SERIALIZARLO EN FORMA DE CADENA Y PODER ENVIARLO MEDIANTE AJAX*/


  for (var i = 0; i < henequen.length; i++) 
	{
//	prueba=prueba.replace(/\,/g,''); //para eliminar todas las comas	
//patron = ",";
henequens=henequen[i].value.replace(/\,/g,'');
yutes=yute[i].value.replace(/\,/g,'');
bolsas=bolsa[i].value.replace(/\,/g,'');
kgs_brutoss=kgs_brutos[i].value.replace(/\,/g,'');
tongas=tonga[i].value.replace(/\,/g,'');
		
	    arreglo_hene[i]=henequens;
	  arreglo_yute[i]=yutes;
	  arreglo_bolsa[i]=bolsas;
	  arreglo_kgsbrutos[i]=kgs_brutoss;
	  arreglo_tonga[i]=tongas;
    }
 
	idcliente=document.captura.idcliente.value;
	idproductor=document.captura.idproductor.value;
	id_catalogo=document.captura.id_catalogo.value;
	produccion=document.captura.produccion.value;
	fecha_nota=document.captura.fecha_nota.value;
	vehiculo=document.captura.vehiculo.value;
	
	henequen=serializa_arreglo(arreglo_hene);	
	yute=serializa_arreglo(arreglo_yute);	
	bolsa=serializa_arreglo(arreglo_bolsa);	
	kgs_brutos=serializa_arreglo(arreglo_kgsbrutos);
	tonga=serializa_arreglo(arreglo_tonga);	
	
	
	
	if(!(captura.resto_alimentos.checked)) //cuando el checkbox no esta marcado
	resto_alimentos="";
	else
	resto_alimentos=document.captura.resto_alimentos.value;
	
	if(!(captura.desechos_human.checked)) //cuando el checkbox no esta marcado
	desechos_human="";
	else
	desechos_human=document.captura.desechos_human.value;
	
	if(!(captura.olores_desa.checked)) //cuando el checkbox no esta marcado
	olores_desa="";
	else
	olores_desa=document.captura.olores_desa.value;
	
	if(!(captura.otros_organicos.checked)) //cuando el checkbox no esta marcado
	otros_organicos="";
	else
	otros_organicos=document.captura.otros_organicos.value;
	
	if(!(captura.manchas_comb.checked)) //cuando el checkbox no esta marcado
	manchas_comb="";
	else
	manchas_comb=document.captura.manchas_comb.value;
	
	if(!(captura.vehiculo_sucio.checked)) //cuando el checkbox no esta marcado
	vehiculo_sucio="";
	else
	vehiculo_sucio=document.captura.vehiculo_sucio.value;
	
	if(!(captura.olor_detergente.checked)) //cuando el checkbox no esta marcado
	olor_detergente="";
	else
	olor_detergente=document.captura.olor_detergente.value;
	
	if(!(captura.otros_inorganicos.checked)) //cuando el checkbox no esta marcado
	otros_inorganicos="";
	else
	otros_inorganicos=document.captura.otros_inorganicos.value;

		//variables para el uso de retencion		
		var retencion_p;
		var retencion_peso;
		var miembro_c;
		if(document.captura.retencion_si.checked){
			retencion_p=document.captura.ret_porc.value.replace(/\,/g,'');
			retencion_peso=document.captura.retencion_peso.value.replace(/\,/g,'');
/*			//deshabilitado por descuadre
			if (document.captura.miembro_cmc.checked) 
				miembro_c=1;
			else 
				miembro_c=0; */
				miembro_c=0;
		}else {
			retencion_p=0.00
			retencion_peso=0.00
			miembro_c=0
		}
		//termina checado de uso de retencion
	
	id_servicio=document.captura.id_servicio.value;//SERVICIOS LIGADOS
	precio_kilo=document.captura.precio_kilo.value;
	rendimiento=document.captura.rendimiento.value;
	mancha=document.captura.mancha.value;
	humedad=document.captura.humedad.value;
	cerezo=document.captura.cerezo.value;
	criba=document.captura.criba.value;

			resultado_analisis=getRadioButtonSelectedValue(document.captura.resultado_analisis); //forma de capturar valor de radio

			if(!(captura.constancia_cmc.checked)) //cuando el checkbox no esta marcado
				constancia_cmc="";
			else
				constancia_cmc=document.captura.constancia_cmc.value;
			
			no_productor=document.captura.no_productor.value;
			total_kgs_neto2=document.captura.total_kgs_neto2.value;
			
			forma_pago=no_cheque=document.captura.forma_pago.value;
			
			no_cheque=document.captura.no_cheque.value;
			banco_cheque=document.captura.banco_cheque.value;
			costalera=getRadioButtonSelectedValue(document.captura.costalera); //forma de capturar valor de radio
			estado_costalera=getRadioButtonSelectedValue(document.captura.estado_costalera); //forma de capturar valor de radio
			observaciones=document.captura.observaciones.value;
			
			
	if(form==1)
	{
	
	id_compra=document.captura.id_compra.value;
	
	}
			
			
			//obtiene la serie
			nserie=document.captura.id_series.value;
			divFormulario = document.getElementById('contenido');
			enviar=document.captura.enviar.value;
			ajax=objetoAjax();
			ajax.open("POST", "procesa_notas.php");
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					//alert(ajax.responseText);
					if(ajax.responseText==0)
					{
					alert("Error acuda con el admon del sistema");
					}
					else
					{
					  if (ajax.responseText==1) {
							alert("??Cuidado! el folio: "+nserie+folion+" ya existen en la base de Datos, Imposible guardar la nota");		  
					  }else {
							if (ajax.responseText==2) {
								alert("??Cuidado! Revise el folio: "+nserie+folion+" debido aque no coincide con los folios que se estan usando, Imposible Guardar la nota");		  
					  		}else {					
								divFormulario.innerHTML = ajax.responseText;
							}					 
					  }
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		if(form==2) //alta
		{

		ajax.send("folio="+folion+"&idproductor="+idproductor+"&serie="+nserie+"&idcliente="+idcliente+"&id_catalogo="+id_catalogo+"&produccion="+produccion+"&fecha_nota="+fecha_nota+"&vehiculo="+vehiculo+"&henequen="+henequen+"&yute="+yute+"&bolsa="+bolsa+"&kgs_brutos="+kgs_brutos+"&tonga="+tonga+"&resto_alimentos="+resto_alimentos+"&desechos_human="+desechos_human+"&olores_desa="+olores_desa+"&otros_organicos="+otros_organicos+"&manchas_comb="+manchas_comb+"&vehiculo_sucio="+vehiculo_sucio+"&olor_detergente="+olor_detergente+"&otros_inorganicos="+otros_inorganicos+"&precio_kilo="+precio_kilo+"&rendimiento="+rendimiento+"&mancha="+mancha+"&humedad="+humedad+"&cerezo="+cerezo+"&criba="+criba+"&resultado_analisis="+resultado_analisis+"&constancia_cmc="+constancia_cmc+"&no_productor="+no_productor+"&total_kgs_neto2="+total_kgs_neto2+"&forma_pago="+forma_pago+"&no_cheque="+no_cheque+"&banco_cheque="+banco_cheque+"&costalera="+costalera+"&estado_costalera="+estado_costalera+"&observaciones="+observaciones+"&enviar="+enviar+"&form="+form+"&id_servicio="+id_servicio+"&retencion_p="+retencion_p+"&retencion_peso="+retencion_peso+"&miembro_c="+miembro_c);
		}
		if(form==1)//modificar
		{

		ajax.send("idproductor="+idproductor+"&serie="+nserie+"&idcliente="+idcliente+"&id_catalogo="+id_catalogo+"&produccion="+produccion+"&fecha_nota="+fecha_nota+"&vehiculo="+vehiculo+"&henequen="+henequen+"&yute="+yute+"&bolsa="+bolsa+"&kgs_brutos="+kgs_brutos+"&tonga="+tonga+"&resto_alimentos="+resto_alimentos+"&desechos_human="+desechos_human+"&olores_desa="+olores_desa+"&otros_organicos="+otros_organicos+"&manchas_comb="+manchas_comb+"&vehiculo_sucio="+vehiculo_sucio+"&olor_detergente="+olor_detergente+"&otros_inorganicos="+otros_inorganicos+"&precio_kilo="+precio_kilo+"&rendimiento="+rendimiento+"&mancha="+mancha+"&humedad="+humedad+"&cerezo="+cerezo+"&criba="+criba+"&resultado_analisis="+resultado_analisis+"&constancia_cmc="+constancia_cmc+"&no_productor="+no_productor+"&total_kgs_neto2="+total_kgs_neto2+"&forma_pago="+forma_pago+"&no_cheque="+no_cheque+"&banco_cheque="+banco_cheque+"&costalera="+costalera+"&estado_costalera="+estado_costalera+"&observaciones="+observaciones+"&enviar="+enviar+"&form="+form+"&id_compra="+id_compra+"&id_servicio="+id_servicio+"&retencion_p="+retencion_p+"&retencion_peso="+retencion_peso+"&miembro_c="+miembro_c);
		}

}
}

function guarda_nota_tmp(form){
	
//folio=document.captura_credito.folio.value;
//if (confirm("El credito "+folio+" Cambiara a entregado en unos momentos"))

if (confirm("Esta completamente seguro que registro las pesadas correctamente ?"))
{
	
	
	
			if (document.captura.idcliente.value.length==0)
			{ 
				 alert("Proveedor no puede ser vacio"); 
				 document.captura.idcliente.focus(); 
				 return 0; 
			}
			if (document.captura.idproductor.value.length==0)
			{ 
				 alert("Productor no puede ser vacio"); 
				 document.captura.idproductor.focus(); 
				 return 0; 
			}
			if (document.captura.id_series.value=='0')
			{ 
				 alert("Seleccione la serie de la nota..."); 
				 document.captura.id_series.focus(); 
				 return 0; 
			}
			if (document.captura.id_catalogo.value.length==0)
			{ 
				 alert("Producto no puede ser vacio"); 
				 document.captura.id_catalogo.focus(); 
				 return 0; 
			}
			if (document.captura.produccion.value.length==0)
			{ 
				 alert("Produccion no puede ser vacio"); 
				 document.captura.produccion.focus(); 
				 return 0; 
			}
			if (document.captura.fecha_nota.value.length==0)
			{ 
				 alert("Fecha de la nota no puede ser vacio"); 
				 document.captura.fecha_nota.focus(); 
				 return 0; 
			}
			if (document.captura.vehiculo.value.length==0)
			{ 
				 alert("Datos del vehiculo no puede ser vacio"); 
				 document.captura.vehiculo.focus(); 
				 return 0; 
			}
			
			
			
			if (document.captura.precio_kilo.value.length==0)
			{ 
				 alert("Precio kilo no puede ser vacio"); 
				 document.captura.precio_kilo.focus(); 
				 return 0; 
			}
			
		/*validamos radio button*/
		
	
	//validad analisis sensorial
	
	var s = "no"; 

			with (document.captura)
	{ 
		for ( var i = 0; i < resultado_analisis.length; i++ ) 
		{ 
			if ( resultado_analisis[i].checked ) 
			{ 
			s= "si"; 
	
			//window.alert("Ha seleccionado: \n" + entra_garantia[i].value); 
			break; 
			} 
		} 
			if ( s == "no" )
			{ 
			
			window.alert("Analisis sensorial no puede ser vacio" ) ; 
			return 0; 
			

			} 
	}	
	//termina la validadcion
	//validad forma de pago
	
	if (document.captura.forma_pago.value.length==0)
			{ 
				 alert("Forma de pago no puede ser vacio"); 
				 document.captura.forma_pago.focus(); 
				 return 0; 
			}
	//termina la validadcion
		
	/*valida costalera*/	
	var s = "no"; 

			with (document.captura)
	{ 
		for ( var i = 0; i < costalera.length; i++ ) 
		{ 
			if ( costalera[i].checked ) 
			{ 
			s= "si"; 
	
			//window.alert("Ha seleccionado: \n" + entra_garantia[i].value); 
			break; 
			} 
		} 
			if ( s == "no" )
			{ 
			
			window.alert("Costalera no puede ser vacio" ) ; 
			return 0; 
			

			} 
	}
	
	/*termina validacion de costalera*/
		
		/*validacion estado de la costalera*/
		
		var s = "no"; 

			with (document.captura)
	{ 
		for ( var i = 0; i < estado_costalera.length; i++ ) 
		{ 
			if ( estado_costalera[i].checked ) 
			{ 
			s= "si"; 
	
			//window.alert("Ha seleccionado: \n" + entra_garantia[i].value); 
			break; 
			} 
		} 
			if ( s == "no" )
			{ 
			
			window.alert("Estado de la costalera no puede ser vacio" ) ; 
			return 0; 
			

			} 
	}
	
	/*DECLARAMOS TODOS LOS ARREGLOS: HENEQUEN, YUTE, BOLSA, KILOGRAMOS BRUTOS, NUMERO DE TONGA*/
	
	var arreglo_hene=new Array();
	var arreglo_yute=new Array();
	var arreglo_bolsa=new Array();
	var arreglo_kgsbrutos=new Array();
	var arreglo_tonga=new Array();

	var henequen = document.getElementsByName("hene[]");
	var yute = document.getElementsByName("yute[]");
	var bolsa = document.getElementsByName("bolsa[]");
	var kgs_brutos = document.getElementsByName("kgs_brutos[]");
	var tonga = document.getElementsByName("id_tonga[]");
	
	/*FIN DE LAS DECLARACIONES*/

//Como todas las pesadas forzosamente son del mismo tama??o solo se recorre una sola vez
var contador=0;
var conta_kgs=0;
var tongas=0;


  for (var i = 0; i < henequen.length; i++) 
	{
	
	if(henequen[i].value.length==0)
	henequen[i].value=0;
	if(yute[i].value.length==0)
	yute[i].value=0;
	if(bolsa[i].value.length==0)
	bolsa[i].value=0;
	
	

	
	contador=contador+henequen[i].value+yute[i].value+bolsa[i].value;
	
		if(contador<=0)
		{
		alert("La pesada no puede ir vacia");
		return 0;
		}
		
	conta_kgs=kgs_brutos[i].value;
		if(conta_kgs<=0)
		{
		alert("Kilogramos brutos no puede ser vacio");
		return 0;
		}
		
		
		
		tongas=tonga[i].value;
		if(tongas<=0)
		{
		alert("Tonga no puede ir vacia");
		return 0;
		}
		
	  contador=0;
	  conta_kgs=0;
	  tongas=0;
    }


/*GUARDAMOS TODAS LAS PESADAS EN ARREGLOS PARA PODER SERIALIZARLO EN FORMA DE CADENA Y PODER ENVIARLO MEDIANTE AJAX*/


  for (var i = 0; i < henequen.length; i++) 
	{
//	prueba=prueba.replace(/\,/g,''); //para eliminar todas las comas	
//patron = ",";
henequens=henequen[i].value.replace(/\,/g,'');
yutes=yute[i].value.replace(/\,/g,'');
bolsas=bolsa[i].value.replace(/\,/g,'');
kgs_brutoss=kgs_brutos[i].value.replace(/\,/g,'');
tongas=tonga[i].value.replace(/\,/g,'');
		
	    arreglo_hene[i]=henequens;
	  arreglo_yute[i]=yutes;
	  arreglo_bolsa[i]=bolsas;
	  arreglo_kgsbrutos[i]=kgs_brutoss;
	  arreglo_tonga[i]=tongas;
    }
 
	idcliente=document.captura.idcliente.value;
	idproductor=document.captura.idproductor.value;
	id_catalogo=document.captura.id_catalogo.value;
	produccion=document.captura.produccion.value;
	fecha_nota=document.captura.fecha_nota.value;
	vehiculo=document.captura.vehiculo.value;
	
	henequen=serializa_arreglo(arreglo_hene);	
	yute=serializa_arreglo(arreglo_yute);	
	bolsa=serializa_arreglo(arreglo_bolsa);	
	kgs_brutos=serializa_arreglo(arreglo_kgsbrutos);
	tonga=serializa_arreglo(arreglo_tonga);	
	
	
	
	if(!(captura.resto_alimentos.checked)) //cuando el checkbox no esta marcado
	resto_alimentos="";
	else
	resto_alimentos=document.captura.resto_alimentos.value;
	
	if(!(captura.desechos_human.checked)) //cuando el checkbox no esta marcado
	desechos_human="";
	else
	desechos_human=document.captura.desechos_human.value;
	
	if(!(captura.olores_desa.checked)) //cuando el checkbox no esta marcado
	olores_desa="";
	else
	olores_desa=document.captura.olores_desa.value;
	
	if(!(captura.otros_organicos.checked)) //cuando el checkbox no esta marcado
	otros_organicos="";
	else
	otros_organicos=document.captura.otros_organicos.value;
	
	if(!(captura.manchas_comb.checked)) //cuando el checkbox no esta marcado
	manchas_comb="";
	else
	manchas_comb=document.captura.manchas_comb.value;
	
	if(!(captura.vehiculo_sucio.checked)) //cuando el checkbox no esta marcado
	vehiculo_sucio="";
	else
	vehiculo_sucio=document.captura.vehiculo_sucio.value;
	
	if(!(captura.olor_detergente.checked)) //cuando el checkbox no esta marcado
	olor_detergente="";
	else
	olor_detergente=document.captura.olor_detergente.value;
	
	if(!(captura.otros_inorganicos.checked)) //cuando el checkbox no esta marcado
	otros_inorganicos="";
	else
	otros_inorganicos=document.captura.otros_inorganicos.value;

		//variables para el uso de retencion		
		var retencion_p;
		var retencion_peso;
		var miembro_c;
		if(document.captura.retencion_si.checked){
			retencion_p=document.captura.ret_porc.value.replace(/\,/g,'');
			retencion_peso=document.captura.retencion_peso.value.replace(/\,/g,'');
/*			//deshabilitado por descuadre
			if (document.captura.miembro_cmc.checked) 
				miembro_c=1;
			else 
				miembro_c=0; */
				miembro_c=0;
		}else {
			retencion_p=0.00
			retencion_peso=0.00
			miembro_c=0
		}
		//termina checado de uso de retencion
	
	id_servicio=document.captura.id_servicio.value;//SERVICIOS LIGADOS
	precio_kilo=document.captura.precio_kilo.value;
	rendimiento=document.captura.rendimiento.value;
	mancha=document.captura.mancha.value;
	humedad=document.captura.humedad.value;
	cerezo=document.captura.cerezo.value;
	criba=document.captura.criba.value;

			resultado_analisis=getRadioButtonSelectedValue(document.captura.resultado_analisis); //forma de capturar valor de radio

			if(!(captura.constancia_cmc.checked)) //cuando el checkbox no esta marcado
				constancia_cmc="";
			else
				constancia_cmc=document.captura.constancia_cmc.value;
			
			no_productor=document.captura.no_productor.value;
			total_kgs_neto2=document.captura.total_kgs_neto2.value;
			
			forma_pago=no_cheque=document.captura.forma_pago.value;
			
			no_cheque=document.captura.no_cheque.value;
			banco_cheque=document.captura.banco_cheque.value;
			costalera=getRadioButtonSelectedValue(document.captura.costalera); //forma de capturar valor de radio
			estado_costalera=getRadioButtonSelectedValue(document.captura.estado_costalera); //forma de capturar valor de radio
			observaciones=document.captura.observaciones.value;
			
			
	if(form==1)
	{
	
	id_compra=document.captura.id_compra.value;
	
	}
			
			
			//obtiene la serie
			nserie=document.captura.id_series.value;
			divFormulario = document.getElementById('contenido');
			enviar=document.captura.enviar.value;
			ajax=objetoAjax();
			ajax.open("POST", "procesa_notas_tmp.php");
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
					alert("Error acuda con el admon del sistema");
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		if(form==2) //alta
		{

		ajax.send("idproductor="+idproductor+"&serie="+nserie+"&idcliente="+idcliente+"&id_catalogo="+id_catalogo+"&produccion="+produccion+"&fecha_nota="+fecha_nota+"&vehiculo="+vehiculo+"&henequen="+henequen+"&yute="+yute+"&bolsa="+bolsa+"&kgs_brutos="+kgs_brutos+"&tonga="+tonga+"&resto_alimentos="+resto_alimentos+"&desechos_human="+desechos_human+"&olores_desa="+olores_desa+"&otros_organicos="+otros_organicos+"&manchas_comb="+manchas_comb+"&vehiculo_sucio="+vehiculo_sucio+"&olor_detergente="+olor_detergente+"&otros_inorganicos="+otros_inorganicos+"&precio_kilo="+precio_kilo+"&rendimiento="+rendimiento+"&mancha="+mancha+"&humedad="+humedad+"&cerezo="+cerezo+"&criba="+criba+"&resultado_analisis="+resultado_analisis+"&constancia_cmc="+constancia_cmc+"&no_productor="+no_productor+"&total_kgs_neto2="+total_kgs_neto2+"&forma_pago="+forma_pago+"&no_cheque="+no_cheque+"&banco_cheque="+banco_cheque+"&costalera="+costalera+"&estado_costalera="+estado_costalera+"&observaciones="+observaciones+"&enviar="+enviar+"&form="+form+"&id_servicio="+id_servicio+"&retencion_p="+retencion_p+"&retencion_peso="+retencion_peso+"&miembro_c="+miembro_c);
		}
		if(form==1)//modificar
		{

		ajax.send("idproductor="+idproductor+"&serie="+nserie+"&idcliente="+idcliente+"&id_catalogo="+id_catalogo+"&produccion="+produccion+"&fecha_nota="+fecha_nota+"&vehiculo="+vehiculo+"&henequen="+henequen+"&yute="+yute+"&bolsa="+bolsa+"&kgs_brutos="+kgs_brutos+"&tonga="+tonga+"&resto_alimentos="+resto_alimentos+"&desechos_human="+desechos_human+"&olores_desa="+olores_desa+"&otros_organicos="+otros_organicos+"&manchas_comb="+manchas_comb+"&vehiculo_sucio="+vehiculo_sucio+"&olor_detergente="+olor_detergente+"&otros_inorganicos="+otros_inorganicos+"&precio_kilo="+precio_kilo+"&rendimiento="+rendimiento+"&mancha="+mancha+"&humedad="+humedad+"&cerezo="+cerezo+"&criba="+criba+"&resultado_analisis="+resultado_analisis+"&constancia_cmc="+constancia_cmc+"&no_productor="+no_productor+"&total_kgs_neto2="+total_kgs_neto2+"&forma_pago="+forma_pago+"&no_cheque="+no_cheque+"&banco_cheque="+banco_cheque+"&costalera="+costalera+"&estado_costalera="+estado_costalera+"&observaciones="+observaciones+"&enviar="+enviar+"&form="+form+"&id_compra="+id_compra+"&id_servicio="+id_servicio+"&retencion_p="+retencion_p+"&retencion_peso="+retencion_peso+"&miembro_c="+miembro_c);
		}

}
}





function getRadioButtonSelectedValue(ctrl)
{

    for(i=0;i<ctrl.length;i++)
    {
        if(ctrl[i].checked)
        { 
        		return ctrl[i].value; 
        }
    }
}





//TERMINA LAS VALIDACIONES DE LA NOTA DE ENTRADA





function cc_get_precio_producto(id_catalogo,form){
var preciox_kg;
var retencion_p;
idcliente = document.getElementById('idcliente').value;	

if(id_catalogo=="")
{
 alert("Seleccione Producto"); 
 return 0; 
				 
}
form=1;

	//divFormulario = document.getElementById('bloque');

	ajax=objetoAjax();
	ajax.open("POST", "update_precio_producto.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			//de-serializar
			valor_regreso=ajax.responseText;
			preciox_kg=valor_regreso.substring(0,valor_regreso.indexOf("|"));
			
			valor_regreso=valor_regreso.substring(valor_regreso.indexOf("|")+1,valor_regreso.length);

			retencion_p=valor_regreso.substring(0,valor_regreso.indexOf("|"));
		
			valor_regreso=valor_regreso.substring(valor_regreso.indexOf("|")+1,valor_regreso.length);
			kgs_esperados=valor_regreso.substring(0,valor_regreso.indexOf("|"));
					
			
			valor_regreso=valor_regreso.substring(valor_regreso.indexOf("|")+1,valor_regreso.length);
			kgs_recibidos=valor_regreso.substring(0,valor_regreso.indexOf("|"));

			valor_regreso=valor_regreso.substring(valor_regreso.indexOf("|")+1,valor_regreso.length);

			kgs_xrecibir=valor_regreso
					
		   totkgs_entrega = document.getElementById('pentrega');
		   totkgs_entrega.innerHTML="Cosecha esperada: <b> "+kgs_esperados+"</b> Kgs.";
			kgentrega = document.getElementById('kgentrega');			
			kgentrega.value=kgs_xrecibir;
			
			totkgs_entregado = document.getElementById('entregado');
			totkgs_entregado.innerHTML="Entregado: <b> "+kgs_recibidos+"</b> Kgs. Pendiente: <b> "+kgs_xrecibir+"</b> Kgs.";	
							
			document.captura.precio_kilo.value=preciox_kg;
			document.captura.ret_porc.value=retencion_p;			
			
			calcula_kgs_netos()
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	

ajax.send("id_catalogo="+id_catalogo+"&form="+form+"&idcliente="+idcliente)

}


function actualiza_nota_cliente_directo(id_compra,form){




if(idcliente=="")
{
 alert("Elije a un cliente"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('contenido');
	carga = document.getElementById('carga');

	ajax=objetoAjax();
	ajax.open("POST", "actualiza_nota_selec.php");
	carga.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form+"&id_compra="+id_compra)


}
function verificaMonto(can_val,monto_actual)
{
	
	val1=can_val.value.replace(/\,/g,'');
	val2=monto_actual.value.replace(/\,/g,''); 
   if (parseFloat(val1)<parseFloat(val2)) {
		alert("No esta permitido modificar a una cantidad Menor, el monto de cr??dito")
		can_val.value=val2
   }
}

function calcula_kgs_netos(input)
{
	
	
	var arreglo_hene=new Array();
	var arreglo_yute=new Array();
	var arreglo_bolsa=new Array();
	var arreglo_kgsbrutos=new Array();
	var arreglo_tonga=new Array();

	var henequen = document.getElementsByName("hene[]");
	var yute = document.getElementsByName("yute[]");
	var bolsa = document.getElementsByName("bolsa[]");
	var kgs_brutos = document.getElementsByName("kgs_brutos[]");
	var tonga = document.getElementsByName("id_tonga[]");
	
	/*FIN DE LAS DECLARACIONES*/

//Como todas las pesadas forzosamente son del mismo tama??o solo se recorre una sola vez
var contador=0;
var conta_kgs=0;
var tongas=0;
var tara_hene=document.getElementById("tara_henequen").value;
var tara_yute=document.getElementById("tara_yute").value;
var tara_bolsa=document.getElementById("tara_bolsa").value;


var total_kgs_brutos=0
var total_hene=0;
var total_yute=0;
var total_bolsa=0;


  for (var i = 0; i < henequen.length; i++) 
	{

	/*VALIDAMOS QUE LOS CAMPOS NO ESTEN VACIOS*/

	if(henequen[i].value.length==0)
	henequen[i].value=0;
	if(yute[i].value.length==0)
	yute[i].value=0;
	if(bolsa[i].value.length==0)
	bolsa[i].value=0;
	if(kgs_brutos[i].value.length==0)
	kgs_brutos[i].value=0;
	/*TERMINA LA VALIDACION*/
	
/*SI LOS TOTALES TIENEN COMAS*/

henequens=henequen[i].value.replace(/\,/g,'');
yutes=yute[i].value.replace(/\,/g,'');
bolsas=bolsa[i].value.replace(/\,/g,'');
kgs_brutoss=kgs_brutos[i].value.replace(/\,/g,'');

	 
	  arreglo_hene[i]=henequens;
	  arreglo_yute[i]=yutes;
	  arreglo_bolsa[i]=bolsas;
	  arreglo_kgsbrutos[i]=kgs_brutoss;

   }
   
 	for (var i = 0; i < arreglo_hene.length; i++) 
	{
	total_hene+=parseFloat(arreglo_hene[i]);
	
	}
	for (var i = 0; i < arreglo_yute.length; i++) 
	{
	total_yute+=parseFloat(arreglo_yute[i]);
	}
	for (var i = 0; i < arreglo_bolsa.length; i++) 
	{
	total_bolsa+=parseFloat(arreglo_bolsa[i]);
	}
	for (var i = 0; i < arreglo_kgsbrutos.length; i++) 
	{
	total_kgs_brutos+=parseFloat(arreglo_kgsbrutos[i]);
	}
	

peso_hene=eval(tara_hene)*eval(total_hene);//recuperamos el pesos de hene
peso_yute=eval(tara_yute)*eval(total_yute);//recuperamos el pesos de yute
peso_bolsa=eval(tara_bolsa)*eval(total_bolsa);//recuperamos el pesos de bolsa
total_kgs_netos=eval(total_kgs_brutos)-eval(peso_hene)-eval(peso_yute)-eval(peso_bolsa);
total_kgs_tara=eval(peso_hene)+eval(peso_yute)+eval(peso_bolsa);


document.captura.total_kgs_brutos.value=test_numero(total_kgs_brutos);
document.captura.total_tara.value=test_numero(total_kgs_tara);
document.captura.total_kgs_netos.value=test_numero(total_kgs_netos);

if(document.captura.precio_kilo.value.length==0)
{
	//alert("Warning !!! Precio de kilo esta vacio");
	precio_kilo=0;
}
else
{
precio_kilo=document.captura.precio_kilo.value;
}




subtotal=eval(total_kgs_netos)*eval(precio_kilo);
document.captura.subtotal.value=test_numero(subtotal);

//calcular retencion si esta activada la casilla
if (document.captura.retencion_si.checked){
			calculo_retencion(true);
}



}

function calculo_retencion(activo) {
var tretencion=0.00;
var ttotal=0.00;
var reten_p=0.00;
var total_kg=0.00;
var precio_kg=0.00;
var subtotal=0.00;
	if(activo){
		total_kg=parseFloat(document.captura.total_kgs_netos.value.replace(/\,/g,''));
		precio_kg=parseFloat(document.captura.precio_kilo.value.replace(/\,/g,''));		
		subtotal=total_kg*precio_kg;
		//se deshabilito la retencion por descuadre		
		/*reten_p=parseFloat(document.captura.ret_porc.value);
		if (!document.captura.miembro_cmc.checked) {
			reten_p=reten_p/2;
		}
		tretencion=(total_kg*reten_p);
		tretencion=Math.round(tretencion*100)/100;
		document.captura.retencion_peso.value=test_numero(tretencion);*/
//esto se agrego por el descuadre		
		tretencion=parseFloat(document.captura.retencion_peso.value.replace(/\,/g,''));
		document.captura.retencion_si.checked=true;
//hasta aqui agregue		
		ttotal=subtotal-tretencion;
		document.captura.subtotal.value=test_numero(ttotal);
	}else{
		total_kg=parseFloat(document.captura.total_kgs_netos.value.replace(/\,/g,''));
		precio_kg=parseFloat(document.captura.precio_kilo.value.replace(/\,/g,''));		
		subtotal=total_kg*precio_kg;
		document.captura.retencion_peso.value=test_numero(0.00);
		ttotal=subtotal;
		document.captura.subtotal.value=test_numero(ttotal);
	}


}

function obtener_precio() 
{
	//funcionalidad para el calculo del precio
	
	var ren=document.captura.rendimiento.value;
	var man=document.captura.mancha.value;
	var hum=document.captura.humedad.value;
	var pro=document.captura.id_catalogo.value;
	var fecha=document.captura.fecha_nota.value;
	
	var fecha_actual=document.captura.fecha_actual.value;
	
	var servicio=document.captura.id_servicio.value;
   var precio_base=14;
   var precio_compra=0.00;
   var mancha=0;
   var humedad=0;
   
   if (document.captura.id_servicio.value.trim().length==0) {	
		//biene del campo
		precio_compra=Math.round((precio_base/(60/100)*(ren/100))*100)/100;
		
		//precio_compra=precio_compra-(precio_compra*((mancha+humedad)/100));	
		if (pro=="1") {
			//APLICA CONSIDERACION CON LA MANCHA

			var f = new obtiene_fecha(fecha_actual);	
			var f1= new obtiene_fecha(fecha);		 		
			var mif1 = new Date( f1.anio, f1.mes, f1.dia); 
			var mif = new Date( f.anio, f.mes, f.dia);
			vdias=mif.getTime()-mif1.getTime();
			vdias=Math.floor(vdias / (1000 * 60 * 60 * 24));			
			if (vdias<=2) {
				mancha=man-18;
				humedad=hum-12;
		   	if (mancha<=0) {
		   		mancha=0;
		   	}
				if (humedad<=0) {
					humedad=0;
				}
			
			}else {
				humedad=hum-12;
				if (humedad<=0) {
					humedad=0;
				}
				if (man<=20) {
					mancha=man-20;
					if (mancha<=0) {
		   			mancha=0;
		   		}				
				}
				if (man>20) {
					mancha=man-20;
					if (mancha<=0) {
		   			mancha=0;
		   		}else{
		   			mancha=mancha/2
		   		}
		   						
				}
			
			}
		
			precio_compra=Math.round((precio_compra-(precio_compra*(mancha+humedad))/100)*100)/100;
			
		}else {
			mancha=man-18;
			humedad=hum-12;
		   if (mancha<=0) {
		   	mancha=0;
		   }
			if (humedad<=0) {
				humedad=0;
			}

			precio_compra=Math.round((precio_compra-(precio_compra*(mancha+humedad))/100)*100)/100;

		}
	
	}else {
		
		precio_compra=Math.round((precio_base/(60/100)*(ren/100))*100)/100;
		mancha=man-18;
		humedad=hum-12;
		precio_compra=Math.round((precio_compra-(precio_compra*(mancha+humedad))/100)*100)/100;
			
	}
   //alert(precio_compra);
	
}

function obtiene_fecha( cadena ) {

   //Separador para la introduccion de las fechas
   var separador = "-"

   //Separa por dia, mes y a??o
   if ( cadena.indexOf( separador ) != -1 ) {
        var posi1 = 0
        var posi2 = cadena.indexOf( separador, posi1 + 1 )
        var posi3 = cadena.indexOf( separador, posi2 + 1 )
        this.dia = cadena.substring( posi1, posi2 )
        this.mes = cadena.substring( posi2 + 1, posi3 )
        this.anio = cadena.substring( posi3 + 1, cadena.length )
   } else {
        this.dia = 0
        this.mes = 0
        this.anio = 0   
   }
}

function fmiembro_cmc(){
		if (document.captura.retencion_si.checked){
			calculo_retencion(true);
		}
}

/*TERMINA LAS FUNCIONES DE NOTAS DE ENTRADA*/


/*FORMATO DE NUMEROS COMO NUMBER_FORMAT*/

 /* Modificado por Ultiminio Ramos G */
   /* Fecha: 2012-04-05 */
   /* Para formatear el n??mero separado con comas para los miles y punto para los decimales */
   /* Fue tomado desde: http://javascript.espaciolatino.com/ */
   function test_numero(valor){
      var nuevo_numero = new oNumero(valor);
    
return nuevo_numero.formato(2,true);
   }
    
   function oNumero(numero){
      //Propiedades 
      this.valor = numero || 0
      this.dec = -1;
 
      //M??todos 
      this.formato = numFormat;
      this.ponValor = ponValor;
 
      //Definici??n de los m??todos
      function ponValor(cad) {
         if (cad =='-' || cad=='+') return
         if (cad.length ==0) return
         if (cad.indexOf('.') >=0)
            this.valor = parseFloat(cad);
         else
            this.valor = parseInt(cad);
      } 
 
      function numFormat(dec, miles) {
         var num = this.valor, signo=3, expr;
         var cad = ""+this.valor;
         var ceros = "", pos, pdec, i;
         for (i=0; i < dec; i++){
            ceros += '0';
         }
 
         pos = cad.indexOf('.')
         if (pos < 0) {
            cad = cad+"."+ceros;
         } else {
            pdec = cad.length - pos -1;
 
            if (pdec <= dec) {
               for (i=0; i< (dec-pdec); i++) {
 
                  cad += '0';
               }
            } else {
               num = num*Math.pow(10, dec);
               num = Math.round(num);
               num = num/Math.pow(10, dec);
               cad = new String(num);
            }
         }
 
         pos = cad.indexOf('.')
 
         if (pos < 0){
            pos = cad.lentgh;
         }
 
         if (cad.substr(0,1)=='-' || cad.substr(0,1) == '+') {
            signo = 4;
         }
 
         if (miles && pos > signo) {
            do {
               expr = /([+-]?\d)(\d{3}[\.\,]\d*)/
               cad.match(expr)
               cad=cad.replace(expr, RegExp.$1+','+RegExp.$2);
            }
 
            while (cad.indexOf(',') > signo) {
               if (dec <= 0) {
                  cad = cad.replace(/\./,'');
               }
            }
         }
         return cad;
      }
   }//Fin del objeto oNumero:
/*TERMINA FORMATO DE NUEMROS*/

/***************FUNCIONES DEL MODULO DE  SERVICIOS******************/
function se_actualiza_servicios_cliente(idcliente,form){

if(idcliente=="")
{
 alert("Seleccione a un cliente"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_servicio_selec.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}


function actualiza_historico_cliente(tipo_orden){

	div_update_sel = document.getElementById('update_sel');
	div_update_sel.innerHTML = '<img src="../session/loading.gif" align="middle" /> ';
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_combo_historico.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			

			div_update_sel.innerHTML=ajax.responseText;
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("tipo_orden="+tipo_orden)




}


function se_update_servicios(id_servicio,form){

if(id_servicio=="")
{
 alert("Seleccione Servicio"); 
 document.captura.id_servicios.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_servicio_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("id_servicio="+id_servicio+"&form="+form)


}

/*MODULO DE OTROS SERVICIOS*/

function se_actualiza_oservicios_cliente(idcliente,form){

if(idcliente=="")
{
 alert("Seleccione a un cliente"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_oservicio_selec.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}

function se_update_oservicios(id_servicio,form){

if(id_servicio=="")
{
 alert("Seleccione Servicio"); 
 document.captura.id_servicios.focus(); 
 return 0; 
				 
}

	divFormulario = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_oservicio_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("id_servicio="+id_servicio+"&form="+form)


}

function guarda_oservicio(form){
	
//folio=document.captura_credito.folio.value;
//if (confirm("El credito "+folio+" Cambiara a entregado en unos momentos"))
if (confirm("Esta completamente seguro de guardar servicio ?"))
{
	
	
	
			if (document.captura.idcliente.value.length==0)
			{ 
				 alert("Cliente no puede ser vacio"); 
				 document.captura.idcliente.focus(); 
				 return 0; 
			}
			if (document.captura.fecha_servicio.value.length==0)
			{ 
				 alert("Fecha del servicio no puede ser vacio"); 
				 document.captura.fecha_servicio.focus(); 
				 return 0; 
			}
			if (document.captura.cantidad.value.length==0)
			{ 
				 alert("Cantidad no puede ser vacio"); 
				 document.captura.cantidad.focus(); 
				 return 0; 
			}
			if (document.captura.id_tipo_servicio.value.length==0)
			{ 
				 alert("Tipo de servicio no puede ser vacio"); 
				 document.captura.id_tipo_servicio.focus(); 
				 return 0; 
			}
			if (document.captura.precio_u.value.length==0)
			{ 
				 alert("Precio unitario no puede ser vacio"); 
				 document.captura.precio_u.focus(); 
				 return 0; 
			}
			if (document.captura.subtotal.value.length==0)
			{ 
				 alert("Subtotal no puede ser vacio"); 
				 document.captura.subtotal.focus(); 
				 return 0; 
			}
			if (document.captura.total.value.length==0)
			{ 
				 alert("Total no puede ser vacio"); 
				 document.captura.total.focus(); 
				 return 0; 
			}
		
	
	idcliente=document.captura.idcliente.value;
	fecha_servicio=document.captura.fecha_servicio.value;
	cantidad=document.captura.cantidad.value;
	id_tipo_servicio=document.captura.id_tipo_servicio.value;
	precio_u=document.captura.precio_u.value;
	subtotal=document.captura.subtotal.value;
	total=document.captura.total.value;
	observaciones=document.captura.observaciones.value;
	nota_asociada=document.captura.nt_asociada.value;
	enviar=document.captura.enviar.value;
	if(form==1)
	{
	
	id_servicio=document.captura.id_servicio.value;
	
	}
			
			
			
			divFormulario = document.getElementById('contenido');
			ajax=objetoAjax();
			ajax.open("POST", "procesa_oservicios.php");
			divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
					alert("Error acuda con el admon del sistema");
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		if(form==2)
		{
		
		ajax.send("idcliente="+idcliente+"&nota_asociada="+nota_asociada+"&fecha_servicio="+fecha_servicio+"&cantidad="+cantidad+"&id_tipo_servicio="+id_tipo_servicio+"&precio_u="+precio_u+"&subtotal="+subtotal+"&total="+total+"&observaciones="+observaciones+"&enviar="+enviar+"&form="+form);
		}
		if(form==1)//modificar
		{
		
ajax.send("idcliente="+idcliente+"&nota_asociada="+nota_asociada+"&fecha_servicio="+fecha_servicio+"&cantidad="+cantidad+"&id_tipo_servicio="+id_tipo_servicio+"&precio_u="+precio_u+"&subtotal="+subtotal+"&total="+total+"&observaciones="+observaciones+"&enviar="+enviar+"&form="+form+"&id_servicio="+id_servicio);
		}

}
}
<!--FIN DEL MODULO OTROS SERVICIOS-->



function guarda_servicio(form){
	
//folio=document.captura_credito.folio.value;
//if (confirm("El credito "+folio+" Cambiara a entregado en unos momentos"))
	
if (confirm("Esta completamente seguro de guardar servicio ?"))
{			
			
	      if (isNaN(parseInt(document.getElementById("idcliente").value))!=true || document.getElementById("idcliente").value=='')
			{	
				if (document.captura.idcliente.value.length==0)
				{ 
				 	alert("Cliente no puede ser vacio"); 
				 	document.captura.idcliente.focus(); 
				 	return 0; 
				}
			}else{ 
				if (dijit.byId('idcliente').get('value').length==0)
				{ 
				 	alert("Cliente no puede ser vacio"); 
				 	document.captura.idcliente.focus(); 
				 	return 0; 
				}
			}
			if (document.captura.fecha_servicio.value.length==0)
			{ 
				 alert("Fecha del servicio no puede ser vacio"); 
				 document.captura.fecha_servicio.focus(); 
				 return 0; 
			}
			if (document.captura.id_catalogo.value.length==0)
			{ 
				 alert("Tipo de cafe no puede ser vacio"); 
				 document.captura.id_catalogo.focus(); 
				 return 0; 
			}
			if (document.captura.id_secadora.value.length==0)
			{ 
				 alert("Secadora no puede ser vacio"); 
				 document.captura.id_secadora.focus(); 
				 return 0; 
			}
			
			/*DECLARAMOS TODOS LOS ARREGLOS: HENEQUEN, YUTE, BOLSA, KILOGRAMOS BRUTOS, NUMERO DE TONGA*/
	
	var arreglo_bolsa=new Array();
	var arreglo_kgsbrutos=new Array();
	var arreglo_tara=new Array();
	var arreglo_kgsnetos=new Array();
	var arreglo_cajas=new Array();
	
	var bolsa = document.getElementsByName("bolsa[]");
	var kgs_brutos = document.getElementsByName("kgs_brutos[]");
	var tara = document.getElementsByName("tara[]");
	var kgs_netos = document.getElementsByName("kgs_netos[]");
	var cajas = document.getElementsByName("cajas[]");
	
	
	/*FIN DE LAS DECLARACIONES*/

//Como todas las pesadas forzosamente son del mismo tama??o solo se recorre una sola vez
var contador=0;
var conta_kgs=0;
var conta_tara=0;
var conta_kgsnetos=0;
var conta_cajas=0;

  for (var i = 0; i < bolsa.length; i++) 
	{

	if(bolsa[i].value.length==0)
	bolsa[i].value=0;
	if(kgs_brutos[i].value.length==0)
	kgs_brutos[i].value=0;
	if(tara[i].value.length==0)
	tara[i].value=0;
	if(kgs_netos[i].value.length==0)
	kgs_netos[i].value=0;
	if(cajas[i].value.length==0)
	cajas[i].value=0;

	contador=contador+bolsa[i].value;
	
		if(contador<=0)
		{
		alert("La pesada no puede ir vacia");
		return 0;
		}
		
		conta_kgs=kgs_brutos[i].value;
		if(conta_kgs<=0)
		{
		alert("Kilogramos brutos no puede ser vacio");
		return 0;
		}
		
		conta_tara=tara[i].value;
		if(conta_tara<=0)
		{
		alert("Tara no puede ser vacio");
		return 0;
		}
	
	    conta_kgsnetos=kgs_netos[i].value;
		if(conta_kgsnetos<=0)
		{
		alert("Kilogramos netos no puede ser vacio");
		return 0;
		}
		conta_cajas=cajas[i].value;
		if(conta_cajas<=0)
		{
		alert("Cajas no puede ser vacio");
		return 0;
		}	
		
	  contador=0;
	  conta_kgs=0;
	  conta_tara=0;
	  conta_kgsnetos=0;
	  conta_cajas=0;

    }


/*GUARDAMOS TODAS LAS PESADAS EN ARREGLOS PARA PODER SERIALIZARLO EN FORMA DE CADENA Y PODER ENVIARLO MEDIANTE AJAX*/


  for (var i = 0; i < bolsa.length; i++) 
	{
b=bolsa[i].value.replace(/\,/g,'');
kbrutos=kgs_brutos[i].value.replace(/\,/g,'');
tar=tara[i].value.replace(/\,/g,'');
knetos=kgs_netos[i].value.replace(/\,/g,'');
ca=cajas[i].value.replace(/\,/g,'');
		
      arreglo_bolsa[i]=b;
	  arreglo_kgsbrutos[i]=kbrutos;
	  arreglo_tara[i]=tar;
	  arreglo_kgsnetos[i]=knetos;
	  arreglo_cajas[i]=ca;
    }
 
   
	
	b=serializa_arreglo(arreglo_bolsa);	
	kbrutos=serializa_arreglo(arreglo_kgsbrutos);	
	tar=serializa_arreglo(arreglo_tara);	
	knetos=serializa_arreglo(arreglo_kgsnetos);
	ca=serializa_arreglo(arreglo_cajas);	
	
	
			
			if (document.captura.hora_r.value.length==0)
			{ 
				 alert("Hora de recepcion no puede ser vacio"); 
				 document.captura.hora_r.focus(); 
				 return 0; 
			}
			if (document.captura.hora_s.value.length==0)
			{ 
				 alert("Hora de secado no puede ser vacio"); 
				 document.captura.hora_s.focus(); 
				 return 0; 
			}
			if (document.captura.horafs.value.length==0)
			{ 
				 alert("Hora final de secado no puede ser vacio"); 
				 document.captura.horafs.focus(); 
				 return 0; 
			}
		
			if (document.captura.costo_kgsalida.value.length==0)
			{ 
				 alert("Costo x kilo de salida no puede ser vacio"); 
				 document.captura.costo_kgsalida.focus(); 
				 return 0; 
			}
	
	if(isNaN(parseInt(document.getElementById("idcliente").value))!=true || document.getElementById("idcliente").value=='')
	{	
		idcliente=document.captura.idcliente.value;
	}else{
		idcliente=dijit.byId('idcliente').get('value');	
	}	
	fecha_servicio=document.captura.fecha_servicio.value;
	id_catalogo=document.captura.id_catalogo.value;
	id_secadora=document.captura.id_secadora.value;
	observaciones=document.captura.observaciones.value;
	hora_r=document.captura.hora_r.value;
	hora_s=document.captura.hora_s.value;
	horafs=document.captura.horafs.value;
	maduro=document.captura.maduro.value;
	smaduro=document.captura.smaduro.value;
	bayo=document.captura.bayo.value;
	verde=document.captura.verde.value;
	quemado=document.captura.quemado.value;
	tierno=document.captura.tierno.value;
	smata=document.captura.smata.value;	
	costo_kgsalida=document.captura.costo_kgsalida.value;
	enviar=document.captura.enviar.value;
	if(form==1)
	{
	
	id_servicio=document.captura.id_servicio.value;
	
	}
	
	
	
		
			divFormulario = document.getElementById('contenido');
			ajax=objetoAjax();
			ajax.open("POST", "procesa_servicios.php");
			divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
					alert("Error acuda con el admon del sistema");
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		if(form==2)
		{
		
		ajax.send("idcliente="+idcliente+"&fecha_servicio="+fecha_servicio+"&id_catalogo="+id_catalogo+"&id_secadora="+id_secadora+"&observaciones="+observaciones+"&hora_r="+hora_r+"&hora_s="+hora_s+"&horafs="+horafs+"&maduro="+maduro+"&smaduro="+smaduro+"&bayo="+bayo+"&verde="+verde+"&quemado="+quemado+"&tierno="+tierno+"&smata="+smata+"&enviar="+enviar+"&form="+form+"&b="+b+"&kbrutos="+kbrutos+"&tar="+tar+"&knetos="+knetos+"&ca="+ca+"&costo_kgsalida="+costo_kgsalida);
		}
		if(form==1)//modificar
		{
		
ajax.send("idcliente="+idcliente+"&fecha_servicio="+fecha_servicio+"&id_catalogo="+id_catalogo+"&id_secadora="+id_secadora+"&observaciones="+observaciones+"&hora_r="+hora_r+"&hora_s="+hora_s+"&horafs="+horafs+"&maduro="+maduro+"&smaduro="+smaduro+"&bayo="+bayo+"&verde="+verde+"&quemado="+quemado+"&tierno="+tierno+"&smata="+smata+"&enviar="+enviar+"&form="+form+"&b="+b+"&kbrutos="+kbrutos+"&tar="+tar+"&knetos="+knetos+"&ca="+ca+"&id_servicio="+id_servicio+"&costo_kgsalida="+costo_kgsalida);
		}

}
}



function update_nuevo_servicio(form){


	//alert("Muchas gracias la informacion ha sido enviada");
	
//	idgrupo=document.captura.idgrupo.value;
idcliente=document.captura.idcliente.value;

if(idcliente=="")
{
 alert("Seleccione Productor"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}



	divFormulario = document.getElementById('contenido');
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_servicio_selec.php");
	carga.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}

function update_nuevo_oservicio(form){


	//alert("Muchas gracias la informacion ha sido enviada");
	
//	idgrupo=document.captura.idgrupo.value;
idcliente=document.captura.idcliente.value;

if(idcliente=="")
{
 alert("Seleccione Productor"); 
 document.captura.idcliente.focus(); 
 return 0; 
				 
}



	divFormulario = document.getElementById('contenido');
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_oservicio_selec.php");
	carga.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form)


}
function calcula_total()
{

			if (document.captura.cantidad.value.length==0)
			{ 
			document.captura.cantidad.value=0;	 
			}
			if (document.captura.precio_u.value.length==0)
			{ 
			document.captura.precio_u.value=0;	 
			}

cantidad=document.captura.cantidad.value;	 
precio_u=document.captura.precio_u.value;	 

cantidad=cantidad.replace(/\,/g,'');
precio_u=precio_u.replace(/\,/g,'');
			

subtotal=eval(cantidad)*eval(precio_u);
document.captura.subtotal.value=test_numero(subtotal);
document.captura.total.value=test_numero(subtotal);
}







function get_pago_servicio(id_servicio){
	
if (confirm("Esta seguro de entrar al modulo de cobros ?"))
{
var form=4;
	
//form=4 SEGUIMOS CON EL ARCHIVO actualiza_servicio_selec PARA PODER ACTUALIZAR EL FORMULARIO DE COBROS
	
	divFormulario = document.getElementById('div_cobros');
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_servicio_selec.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
					if(ajax.responseText==0)
					{
					alert("Error acuda con el admon del sistema");
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					
					}
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("id_servicio="+id_servicio+"&form="+form)

}

}

function convertir_numero()
{
importe=document.captura_cobro.importe.value;
document.captura_cobro.importe.value=test_numero(importe);
}


function cobrar_servicio(){
			

if (document.captura_cobro.importe.value.length==0)
{ 
alert("Importe no puede ser vacio"); 
document.captura_cobro.importe.focus(); 
return 0; 
}				
if (document.captura_cobro.fecha_cobro.value.length==0)
{ 
alert("Importe no puede ser vacio"); 
document.captura_cobro.fecha_cobro.focus(); 
return 0; 
}				
	
	
importe=document.captura_cobro.importe.value;
fecha_cobro=document.captura_cobro.fecha_cobro.value;
id_servicio=document.captura_cobro.id_servicio.value;	 	
enviar=document.captura_cobro.enviar.value;
	
if (confirm("Esta seguro de abonar "+importe+"  ?"))
{
var form=5;
	
//form=5 abonamos importe al sevicio

	
	divFormulario = document.getElementById('consulta_abonos');
	carga = document.getElementById('carga');
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_servicio_selec.php");
	carga.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
					if(ajax.responseText==1) //ERROE MONTO A PAGAR SOBREPASA EL SALDO DEL SERVICIO
					{
					alert("Error Monto a pagar sobrepasa el saldo del servicio !!!");
					document.captura_cobro.importe.value="";
					document.captura_cobro.importe.focus();
					carga.innerHTML=""; 
									
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					document.captura_cobro.importe.value="";
					carga.innerHTML=""; 
					
					}
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("importe="+importe+"&form="+form+"&fecha_cobro="+fecha_cobro+"&enviar="+enviar+"&id_servicio="+id_servicio)

}

}


function cancela_cobro_ser(id_servicio,id_cobro,importe,fecha_cobro){

if (confirm("Seguro de Cancelar Pago con el importe = "+importe+" y fecha= "+fecha_cobro+"  se cancelara permanentemente?"))
{
var form=6;
	
//form=6 CANCELA PAGO DE SERVICIO

	
	divFormulario = document.getElementById('consulta_abonos');
	carga = document.getElementById('carga');
	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_servicio_selec.php");
	carga.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
					if(ajax.responseText==0) //ERROr no c cancelo el pago
					{
					alert("Error acuda con el admon del sistema");
					carga.innerHTML=""; 
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					carga.innerHTML=""; 
					
					}
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("id_servicio="+id_servicio+"&id_cobro="+id_cobro+"&form="+form)

}

}


/***REPORTE DE LOS SERVICIOS*/

function co_reporte_servicio(form){
	
if (confirm("Esta seguro De Generar Reporte ?"))
{
		
	

//form=1 NOS SIRVE PARA GENERAR ESTADO DE CUENTA DE NUESTROS CLIENTES
			if (document.captura.idcliente.value.length==0)
			{ 
				 alert("Cliente no puede ser vacio"); 
				 document.captura.idcliente.focus(); 
				 return 0; 
			}
			if (document.captura.opcion.value.length==0)
			{ 
				 alert("Opcion adeudo o sin adeudo no puede ser vacio"); 
				 document.captura.opcion.focus(); 
				 return 0; 
			}

	idcliente=document.captura.idcliente.value;
	opcion=document.captura.opcion.value;
	divFormulario = document.getElementById('reporte_servicio');
	
	ajax=objetoAjax();
	ajax.open("POST", "genera_reportes.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
					if(ajax.responseText==0)
					{
					alert("Error acuda con el admon del sistema");
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					
					}
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form+"&opcion="+opcion)

}

}

/**FIN DE LOS REPORTES*/




/*******************FIN DE MODULO DE SERVICIOS*************************/

/*********************MODULO DE ESTADO DE CUENTA DE LOS CLIENTES*******************************/

function genera_estado_cuenta(form){
	
if (confirm("Generar estado de cuenta ?"))
{
		
	

//form=1 NOS SIRVE PARA GENERAR ESTADO DE CUENTA DE NUESTROS CLIENTES
			if (document.captura.idcliente.value.length==0)
			{ 
				 alert("Cliente no puede ser vacio"); 
				 document.captura.idcliente.focus(); 
				 return 0; 
			}
			if (document.captura.fecha_corte.value.length==0)
			{ 
				 alert("Fecha de corte no puede ser vacio"); 
				 document.captura.fecha_corte.focus(); 
				 return 0; 
			}

	idcliente=document.captura.idcliente.value;
	fecha_corte=document.captura.fecha_corte.value;
	divFormulario = document.getElementById('estado_cuenta');
	
	ajax=objetoAjax();
	ajax.open("POST", "genera_estado_cuenta.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
					if(ajax.responseText==0)
					{
					alert("Error acuda con el admon del sistema");
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					
					}
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idcliente="+idcliente+"&form="+form+"&fecha_corte="+fecha_corte)

}

}


/********************FIN DEL MODULO DE ESTADO DE CUENTA DE LOS CLIENTES**********************/


/**************MODULO DE ORDENAMIENTO DE MENU******/

function ordena_menu(){



	divFormulario = document.getElementById('contenido');
	var form=4; //Ordenacion de menu
	
		menu=document.captura.menu.value;
		
		
var arreglo_orden=new Array();
var orden = document.getElementsByName("orden[]");

for (var i = 0; i < orden.length; i++) 
	{
if(orden[i].value.length==0)
orden[i].value=0;

ordenes=orden[i].value.replace(/\,/g,'');
		
	  arreglo_orden[i]=ordenes;
	  
    }

cadena_orden=serializa_arreglo(arreglo_orden);	

	
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_formu_p.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
					if(ajax.responseText==0)
					{
					alert("Error acuda con el admon del sistema");
					}
					else
					{
					
					divFormulario.innerHTML = ajax.responseText;
					
					}
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("menu="+menu+"&cadena_orden="+cadena_orden+"&form="+form)



}
/**FIN DE ORDENAMIENTO DE MENU ************************/


/**FUNCION PARA FILTRAR AUTORIZACION DE GRUIPO**/

function auto_filtra_grupo(idgrupo){

if(idgrupo=="")
{
 alert("Seleccione Grupo"); 
 document.captura_grupo.idgrupo.focus(); 
 return 0; 
				 
}
 var form=7;
	divFormulario = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "actualiza_creditos_select.php");
	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			
			
			
			divFormulario.innerHTML = ajax.responseText;
			
			
			
						
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	


ajax.send("idgrupo="+idgrupo+"&form="+form)


}

/**FUNCION  FIN PARA FILTRAR AUTORIZACION DE GRUIPO**/


/*GENERACION DE REPORTE SOLICITUD X GRUPO*/

function re_genera_gruposol(){
	
			if (document.captura.idgrupo.value.length==0)
			{ 
				 alert("Grupo no puede ser vacio"); 
				 document.captura.idgrupo.focus(); 
				 return 0; 
			} 
			if (document.captura.fecha_i.value.length==0)
			{ 
				 alert("Fecha inicial no puede ser vacio"); 
				 document.captura.fecha_i.focus(); 
				 return 0; 
			} 
			if (document.captura.fecha_f.value.length==0)
			{ 
				 alert("Fecha corte no puede ser vacio"); 
				 document.captura.fecha_f.focus(); 
				 return 0; 
			}
	 
idgrupo=document.captura.idgrupo.value;
fecha_i=document.captura.fecha_i.value;
fecha_f=document.captura.fecha_f.value;
enviar=document.captura.enviar.value;
form=1; //GENERAR REPORTE DE SOLICITUDES GRUPALES
	 
	 
			divFormulario = document.getElementById('consul_reporte');
			ajax=objetoAjax();
			ajax.open("POST", "serv_reporte.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Generando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText;
					document.captura.idgrupo.value="";
					//alert (estatus);
					//divFormulario.style.display="block";
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("idgrupo="+idgrupo+"&fecha_i="+fecha_i+"&fecha_f="+fecha_f+"&enviar="+enviar+"&form="+form)
	}



/*FINDE LA GENERACION DE SOLICITUDES POR GRUPO*/


/*CANCELACION DE CREDITOS*/
function cc_cancela_credito(idcredito){

if (confirm('Quieres CANCELAR el credito'))
{

	if (confirm('Estas completamente seguro de CANCELAR el credito'))
	{

	
			if(idcredito=="")
			{
			 alert("No es posible continuar ha ocurrido un error acuda con el admon del sistema"); 
			 return 0; 
							 
			}
			
			form=8; //CANCELACION DE CREDITOS EN ACTUALIZA_CREDITOS_SELECT
			
			
				divFormulario = document.getElementById('detalles');
			
				ajax=objetoAjax();
				ajax.open("POST", "actualiza_creditos_select.php");
				<!--divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Procesando...';-->
				ajax.onreadystatechange=function() {
					if (ajax.readyState==4) {
						
						
						if(ajax.responseText==0)
					{
						alert("!!Este credito no puede ser cancelado, tiene un cheque en transito!!");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText;
					}
						
						
									
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				
			
			ajax.send("idcredito="+idcredito+"&form="+form)
	}

}

}

/*FIN DE LA CANCELACION DE CREDITOS*/


function re_genera_estadocuenta(){
	
		/*	if (document.captura.idgrupo.value.length==0)
			{ 
				 alert("Grupo no puede ser vacio"); 
				 document.captura.idgrupo.focus(); 
				 return 0; 
			} 
			if (document.captura.fecha_i.value.length==0)
			{ 
				 alert("Fecha inicial no puede ser vacio"); 
				 document.captura.fecha_i.focus(); 
				 return 0; 
			} */
			if (document.captura.fecha_f.value.length==0)
			{ 
				 alert("Fecha corte no puede ser vacio"); 
				 document.captura.fecha_f.focus(); 
				 return 0; 
			}
	 
//idgrupo=document.captura.idgrupo.value;
//fecha_i=document.captura.fecha_i.value;
fecha_f=document.captura.fecha_f.value;
enviar=document.captura.enviar.value;
form=1; //GENERAR REPORTE DE SOLICITUDES GRUPALES
	 
	 
			divFormulario = document.getElementById('consul_reporte');
			ajax=objetoAjax();
			ajax.open("POST", "serv_estado_cuenta.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Generando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText;
					//document.captura.idgrupo.value="";
					//alert (estatus);
					//divFormulario.style.display="block";
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("fecha_f="+fecha_f+"&enviar="+enviar+"&form="+form)
	}

function re_genera_estadocuenta_pro(form){
	
if(form==2)//REPORTE POR PRODUCTOR
{		
			if (document.captura.idcliente.value.length==0)
			{ 
				 alert("Productor no puede ser vacio"); 
				 document.captura.idcliente.focus(); 
				 return 0; 
			}

idcliente=document.captura.idcliente.value;
}
if(form==3)//REPORTE POR GRUPO
{		
			if (document.captura.idgrupo.value.length==0)
			{ 
				 alert("Grupo o razon social no puede ser vacio"); 
				 document.captura.idgrupo.focus(); 
				 return 0; 
			}

idgrupo=document.captura.idgrupo.value;
}
			if (document.captura.fecha_f.value.length==0)
			{ 
				 alert("Fecha corte no puede ser vacio"); 
				 document.captura.fecha_f.focus(); 
				 return 0; 
			}
	 
//idgrupo=document.captura.idgrupo.value;
fecha_f=document.captura.fecha_f.value;
enviar=document.captura.enviar.value;

	 
	 
			divFormulario = document.getElementById('consul_reporte');
			ajax=objetoAjax();
			ajax.open("POST", "serv_estado_cuenta.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Generando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText;
					//document.captura.idgrupo.value="";
					//alert (estatus);
					//divFormulario.style.display="block";
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			
		if(form==2)	
		{
		ajax.send("fecha_f="+fecha_f+"&enviar="+enviar+"&form="+form+"&idcliente="+idcliente)
		}
		if(form==3)	
		{
		ajax.send("fecha_f="+fecha_f+"&enviar="+enviar+"&form="+form+"&idgrupo="+idgrupo)
		}
		
	}


/*MODULO DE SERVICIOS*/
function add_fila_se()
{

	
	//divFormulario = document.getElementById('update_ref_banco');


//************nos posicionamos en la tabla que controla las pesadas
var table=document.getElementById("tservicios");
var lastRow = table.rows.length;

if(lastRow>=19)//**validamos que no se excedan las pesadas
{
	alert("Se excede numero maximo de pesadas");
	return 0;
}


var iteration = lastRow;
var row = table.insertRow(lastRow);

	    var td = row.parentNode;
        var tr = row.parentNode;
		td.align='center';

var cell1=row.insertCell(0);
var cell2=row.insertCell(1);
var cell3=row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);


cell1.innerHTML="<div align='center'><input type='text' name='bolsa[]' size='15' maxlength='50' value=''  id='bolsa' onKeyPress='return acceptNum(event)' autocomplete='off' class='peque' onchange='calcula_kgs_netos_se()' onkeyup='calcula_kgs_netos_se()'></div>";
				
cell2.innerHTML="<div align='center'><input type='text' name='kgs_brutos[]' size='15' maxlength='50' value=''  id='kgs_brutos' onKeyPress='return acceptNum(event)' autocomplete='off' class='peque' onchange='calcula_kgs_netos_se()' onkeyup='calcula_kgs_netos_se()'></div>";

cell3.innerHTML="<div align='center'><input type='text' name='tara[]' size='15' maxlength='50' value=''  id='total_tara' onKeyPress='return acceptNum(event)' autocomplete='off' class='peque' onchange='calcula_kgs_netos_se_tara()' onkeyup='calcula_kgs_netos_se_tara()' ></div>";

cell4.innerHTML="<div align='center'><input type='text' name='kgs_netos[]' size='15' maxlength='50' value=''  id='kgs_netos' onKeyPress='return acceptNum(event)' autocomplete='off' class='peque' ></div>";

cell5.innerHTML="<div align='center'><input type='text' name='cajas[]' size='15' maxlength='50' value=''  id='cajas' onKeyPress='return acceptNum(event)' autocomplete='off' class='peque' ></div>";
	
cell6.innerHTML="<input type='button' onclick='remove_tse(this)' value='Eliminar'>";
					
					
					


}

function remove_tse(t)
    {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
  
			  var tbl = document.getElementById('tservicios');
			  var lastRow = tbl.rows.length;
			  if (lastRow > 2) 
			  {
					table.removeChild(tr);
					calcula_kgs_netos_se();
			  }
			  

			  
			  
    }


function calcula_kgs_netos_se(elemento)
{
	

	
	
	var arreglo_bolsa=new Array();
	var arreglo_kgsbrutos=new Array();
	var arreglo_tara=new Array();
	var arreglo_kgsnetos=new Array();
	var arreglo_cajas=new Array();
	

	var bolsa = document.getElementsByName("bolsa[]");
	var kgs_brutos = document.getElementsByName("kgs_brutos[]");
	var tara = document.getElementsByName("tara[]");
	var kgs_netos = document.getElementsByName("kgs_netos[]");
	var cajas = document.getElementsByName("cajas[]");



	
	/*FIN DE LAS DECLARACIONES*/

//Como todas las pesadas forzosamente son del mismo tama??o solo se recorre una sola vez
var contador=0;
var conta_kgs=0;
var tara_bolsa=document.getElementById("tara_bolsa").value;	
var total_kgs_brutos=0
var total_kgs_netos=0
var total_bolsa=0;
var peso_caja=66;

  for (var i = 0; i < bolsa.length; i++) 
	{

	/*VALIDAMOS QUE LOS CAMPOS NO ESTEN VACIOS*/

	if(bolsa[i].value.length==0)
	bolsa[i].value=0;
	if(kgs_brutos[i].value.length==0)
	kgs_brutos[i].value=0;
	/*TERMINA LA VALIDACION*/
	
/*SI LOS TOTALES TIENEN COMAS*/

bolsas=bolsa[i].value.replace(/\,/g,'');
kgs_brutoss=kgs_brutos[i].value.replace(/\,/g,'');

	 
	  arreglo_bolsa[i]=bolsas;
	  arreglo_kgsbrutos[i]=kgs_brutoss;


   
	
peso_bolsa=eval(tara_bolsa)*eval(arreglo_bolsa[i]);//recuperamos el pesos de bolsa
kgs_netos=eval(arreglo_kgsbrutos[i])-eval(peso_bolsa);

ecajas=eval(kgs_netos)/eval(peso_caja);

//document.captura.tara.value=test_numero(peso_bolsa);

document.captura.elements["tara[]"].value=test_numero(peso_bolsa);
document.captura.elements["kgs_netos[]"].value=test_numero(kgs_netos);
document.captura.elements["cajas[]"].value=test_numero(ecajas);

   }


//subtotal=eval(total_kgs_netos)*eval(precio_kilo);
//document.captura.subtotal.value=test_numero(subtotal);





}
function calcula_kgs_netos_se_tara(input)
{
	
	
	var arreglo_bolsa=new Array();
	var arreglo_kgsbrutos=new Array();
	var arreglo_tara=new Array();
	var arreglo_kgsnetos=new Array();
	var arreglo_cajas=new Array();
	

	var bolsa = document.getElementsByName("bolsa[]");
	var kgs_brutos = document.getElementsByName("kgs_brutos[]");
	var tara = document.getElementsByName("tara[]");
	var kgs_netos = document.getElementsByName("kgs_netos[]");
	var cajas = document.getElementsByName("cajas[]");
	
	/*FIN DE LAS DECLARACIONES*/

//Como todas las pesadas forzosamente son del mismo tama??o solo se recorre una sola vez
var contador=0;
var conta_kgs=0;
//var tara_bolsa=0.2;	
var total_kgs_brutos=0
var total_kgs_netos=0
var total_bolsa=0;
var peso_caja=66;

  for (var i = 0; i < bolsa.length; i++) 
	{

	/*VALIDAMOS QUE LOS CAMPOS NO ESTEN VACIOS*/

	if(bolsa[i].value.length==0)
	bolsa[i].value=0;
	if(kgs_brutos[i].value.length==0)
	kgs_brutos[i].value=0;
	/*TERMINA LA VALIDACION*/
	
/*SI LOS TOTALES TIENEN COMAS*/

bolsas=bolsa[i].value.replace(/\,/g,'');
kgs_brutoss=kgs_brutos[i].value.replace(/\,/g,'');

	 
	  arreglo_bolsa[i]=bolsas;
	  arreglo_kgsbrutos[i]=kgs_brutoss;


   
	
//peso_bolsa=eval(tara_bolsa)*eval(arreglo_bolsa[i]);//recuperamos el pesos de bolsa
peso_bolsa=document.captura.tara.value;
kgs_netos=eval(arreglo_kgsbrutos[i])-eval(peso_bolsa);
ecajas=eval(kgs_netos)/eval(peso_caja);
//document.captura.tara.value=test_numero(peso_bolsa);
//document.captura.kgs_netos.value=test_numero(kgs_netos);
//document.captura.cajas.value=test_numero(ecajas);

document.captura.elements["kgs_netos[]"].value=test_numero(kgs_netos);
document.captura.elements["cajas[]"].value=test_numero(ecajas);

   
   }


//subtotal=eval(total_kgs_netos)*eval(precio_kilo);
//document.captura.subtotal.value=test_numero(subtotal);





}
/*FINN DEL MODULO DE SERVICIOS*/

function re_genera_rcompras(form){
	
if(form==2)//REPORTE POR PRODUCTOR
{		
			if (document.captura.idcliente.value.length==0)
			{ 
				 alert("Productor no puede ser vacio"); 
				 document.captura.idcliente.focus(); 
				 return 0; 
			}

idcliente=document.captura.idcliente.value;
}			

			if (document.captura.id_periodo.value.length==0)
			{ 
				 alert("Cosecha no puede ser vacio"); 
				 document.captura.id_periodo.focus(); 
				 return 0; 
			}
			if (document.captura.id_almacen.value.length==0)
			{ 
				 alert("Almacen no puede ser vacio"); 
				 document.captura.id_almacen.focus(); 
				 return 0; 
			}

			if (document.captura.fecha_i.value.length==0)
			{ 
				 alert("Fecha Inicial no puede ser vacio"); 
				 document.captura.fecha_i.focus(); 
				 return 0; 
			}
			if (document.captura.fecha_f.value.length==0)
			{ 
				 alert("Fecha corte no puede ser vacio"); 
				 document.captura.fecha_f.focus(); 
				 return 0; 
			}
			if (document.captura.id_catalogo.value.length==0)
			{ 
				 alert("Tipo de cafe no puede ser vacio"); 
				 document.captura.id_catalogo.focus(); 
				 return 0; 
			}
			if (document.captura.id_tonga.value.length==0)
			{ 
				 alert("Tonga no puede ser vacio"); 
				 document.captura.id_tonga.focus(); 
				 return 0; 
			}
			
id_periodo=document.captura.id_periodo.value;
fecha_i=document.captura.fecha_i.value;
fecha_f=document.captura.fecha_f.value;
id_catalogo=document.captura.id_catalogo.value;
id_tonga=document.captura.id_tonga.value;
id_almacen=document.captura.id_almacen.value;
enviar=document.captura.enviar.value;

	 
	 
			divFormulario = document.getElementById('consul_reporte');
			ajax=objetoAjax();
			ajax.open("POST", "serv_reporte.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Generando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText;
				
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			
		if(form==1)	
		{
		ajax.send("id_periodo="+id_periodo+"&fecha_i="+fecha_i+"&fecha_f="+fecha_f+"&id_catalogo="+id_catalogo+"&id_tonga="+id_tonga+"&form="+form+"&enviar="+enviar+"&id_almacen="+id_almacen)
		}
		if(form==2)	
		{
				ajax.send("id_periodo="+id_periodo+"&fecha_i="+fecha_i+"&fecha_f="+fecha_f+"&id_catalogo="+id_catalogo+"&id_tonga="+id_tonga+"&form="+form+"&enviar="+enviar+"&idcliente="+idcliente+"&id_almacen="+id_almacen)

		}
		
	}

function re_genera_ntcompras(id_periodo,id_almacen){
	
			
			if (document.captura.fecha_i.value.length==0)
			{ 
				 alert("Fecha Inicial no puede ser vacio"); 
				 document.captura.fecha_i.focus(); 
				 return 0; 
			}
			if (document.captura.fecha_f.value.length==0)
			{ 
				 alert("Fecha corte no puede ser vacio"); 
				 document.captura.fecha_f.focus(); 
				 return 0; 
			}
			if (document.captura.id_catalogo.value.length==0)
			{ 
				 alert("Seleccione un producto, porfavor"); 
				 document.captura.id_catalogo.focus(); 
				 return 0; 
			}
			

fecha_i=document.captura.fecha_i.value;
fecha_f=document.captura.fecha_f.value;
id_tonga=document.captura.id_tonga.value;
id_catalogo=document.captura.id_catalogo.value;
	 
			divFormulario = document.getElementById('consul_reporte');
			ajax=objetoAjax();
			ajax.open("POST", "serv_reporte_ntcompra.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Generando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText;
				
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			

		ajax.send("id_periodo="+id_periodo+"&id_producto="+id_catalogo+"&fecha_i="+fecha_i+"&fecha_f="+fecha_f+"&id_tonga="+id_tonga+"&id_almacen="+id_almacen)
		
		
		
	}




function re_genera_calificacion(id_periodo,id_almacen){
	
			
			if (document.captura.fecha_i.value.length==0)
			{ 
				 alert("Fecha Inicial no puede ser vacio"); 
				 document.captura.fecha_i.focus(); 
				 return 0; 
			}
			if (document.captura.fecha_f.value.length==0)
			{ 
				 alert("Fecha corte no puede ser vacio"); 
				 document.captura.fecha_f.focus(); 
				 return 0; 
			}
			if (document.captura.id_catalogo.value.length==0)
			{ 
				 alert("Seleccione un producto, porfavor"); 
				 document.captura.id_catalogo.focus(); 
				 return 0; 
			}
			

fecha_i=document.captura.fecha_i.value;
fecha_f=document.captura.fecha_f.value;
id_tonga=document.captura.id_tonga.value;
id_catalogo=document.captura.id_catalogo.value;
	 		document.getElementById('idproceso').innerHTML = '<img src="../session/loading.gif" align="middle" /> Enviando Reporte a Excel';
			divFormulario = document.getElementById('consul_reporte');
			divFormulario.innerHTML="";
			ajax=objetoAjax();
			ajax.open("POST", "serv_reporte_calificacion.php");
			//	divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Generando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}else{
						if (ajax.responseText==1) {
													
							generar_rep_calificacion(id_periodo,fecha_i,fecha_f,id_catalogo,id_tonga,id_almacen);
												
						}else{
							divFormulario.innerHTML = ajax.responseText;
						}
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			

		ajax.send("id_periodo="+id_periodo+"&id_producto="+id_catalogo+"&fecha_i="+fecha_i+"&fecha_f="+fecha_f+"&id_tonga="+id_tonga+"&id_almacen="+id_almacen)
		
		
		
	}

function generar_rep_calificacion(id_periodo,fecha_i,fecha_f,id_producto,id_tonga,id_almacen){
	
			
	 		ajax=objetoAjax();
			ajax.open("POST", "../reportes/reporte_calificacion.php");
			divFormulario = document.getElementById('consul_reporte');				
				//divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Generando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					if (ajax.status==200)
    				{
    					divFormulario.innerHTML="<a  href='../reportes/reporte_calificacion.xlsx'><img src='../images/excel.png' alt='nota'  width='40px' height='40px'> <strong><span class='Estilo1'></span></strong>  </a>";							
						document.getElementById('idproceso').innerHTML = '';
   				 }
					
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			
		ajax.send("id_periodo="+id_periodo+"&id_producto="+id_producto+"&fecha_i="+fecha_i+"&fecha_f="+fecha_f+"&id_tonga="+id_tonga+"&id_almacen="+id_almacen)
		
		
		
	}

function re_historico_cliente(id_periodo,id_almacen){
	
			
			if (document.captura.fecha_i.value.length==0)
			{ 
				 alert("Fecha Inicial no puede ser vacio"); 
				 document.captura.fecha_i.focus(); 
				 return 0; 
			}
			if (document.captura.fecha_f.value.length==0)
			{ 
				 alert("Fecha corte no puede ser vacio"); 
				 document.captura.fecha_f.focus(); 
				 return 0; 
			}
			if (document.captura.id_catalogo.value.length==0)
			{ 
				 alert("Seleccione un producto, porfavor"); 
				 document.captura.id_catalogo.focus(); 
				 return 0; 
			}
			

fecha_i=document.captura.fecha_i.value;
fecha_f=document.captura.fecha_f.value;
id_tonga=document.captura.id_tonga.value;
id_catalogo=document.captura.id_catalogo.value;
	 
			divFormulario = document.getElementById('consul_reporte');
			ajax=objetoAjax();
			ajax.open("POST", "serv_historico_cliente.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> Generando...';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText;
				
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			

		ajax.send("id_periodo="+id_periodo+"&id_producto="+id_catalogo+"&fecha_i="+fecha_i+"&fecha_f="+fecha_f+"&id_tonga="+id_tonga+"&id_almacen="+id_almacen)
		
		
		
	}


function reporte_historico_cliente(id_periodo,id_almacen){
	
			
			if (document.captura.idcliente.value.length==0)
			{ 
				 alert("Seleccione un Cliente, Porfavor!"); 
				 document.captura.idcliente.focus(); 
				 return 0; 
			}
			vidcliente=document.captura.idcliente.value;
			
			divFormulario = document.getElementById('consul_reporte');
			ajax=objetoAjax();
			ajax.open("POST", "serv_historico_cliente.php");
				divFormulario.innerHTML = '<img src="../session/loading.gif" align="middle" /> ';
			ajax.onreadystatechange=function() {
				if (ajax.readyState==4) {
					
					if(ajax.responseText==0)
					{
						alert("Ocurrio un problema acuda con el admon del sistema");
						return 0;
					}
					else
					{
					divFormulario.innerHTML = ajax.responseText;
				
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			
		
		ajax.send("id_cliente="+vidcliente+"&id_periodo="+id_periodo+"&id_almacen="+id_almacen);
		
		
		
	}

function limpiar_combo(){
   	
	document.getElementById("consul_reporte").innerHTML="";
}



