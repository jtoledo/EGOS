  function conMayusculas(field) {  
             field.value = field.value.toUpperCase()  
            }  

var nav4 = window.Event ? true : false;
function acceptNum(evt){	
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
var key = nav4 ? evt.which : evt.keyCode;	
return (key <= 13 || (key >= 48 && key <= 57) || key==46);
}

var msg="\n     Sistema integral de Informacion SII- EGOS 1.0";

function disableIE() {if (document.all) {alert(msg);return false;}

}

function disableNS(e) {

if (document.layers||(document.getElementById&&!document.all)) {

if (e.which==2||e.which==3) {alert(msg);return false;}

}

}

if (document.layers) {

document.captureEvents(Event.MOUSEDOWN);document.onmousedown=disableNS;

} else {

//document.onmouseup=disableNS;document.oncontextmenu=disableIE;

}
document.oncontextmenu=new Function("alert(msg);return false")

function esFechaValida(fecha)
{
    if (fecha != undefined && fecha.value != "" ){
        if (!/^\d{2}\/\d{2}\/\d{4}$/.test(fecha.value)){
            alert("formato de fecha no válidos (dd/mm/aaaa)")
			 document.getElementById('fecha').value="";
			 document.getElementById('fecha').focus();

            return false;
        }
        var dia  =  parseInt(fecha.value.substring(0,2),10);
        var mes  =  parseInt(fecha.value.substring(3,5),10);
        var anio =  parseInt(fecha.value.substring(6),10);
 
    switch(mes){
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            numDias=31;
            break;
        case 4: case 6: case 9: case 11:
            numDias=30;
            break;
        case 2:
            if (comprobarSiBisisesto(anio)){ numDias=29 }else{ numDias=28};
            break;
        default:
            alert("Fecha introducida errónea");
			document.getElementById('fecha').value="";
			document.getElementById('fecha').focus();
            return false;
    }
 
        if (dia>numDias || dia==0){
            alert("Fecha introducida errónea");
			document.getElementById('fecha').value="";
			document.getElementById('fecha').focus();
            return false;
        }
        return true;
    }
}

function comprobarSiBisisesto(anio){
if ( ( anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0))) {
    return true;
    }
else {
    return false;
    }
}

///  C O N F I G U R A C I O N   D E   L A   F A C T U R A.


function configuraF()
{
	
  if (document.config.nom.value.length==0)
   { 
      	 alert("Nombre o Razon Social No Puede Ser Vacio"); 
      	 document.config.nom.focus(); 
      	 return 0; 
	}
  if(document.config.rfc_emp.value.length==0)
    {
	  alert("Rfc No Puede Ser Vacio");
	    document.config.rfc_emp.focus();
		return 0;
		 }
	if(document.config.dire_emp.value.length==0)
	{  
	  alert("Direccion No Puede Ser Vacio");
	   document.config.dire_emp.focus();
	   return 0;
	   	     }	
	if(document.config.ciudad_emp.value.length==0)
	{  
	  alert("Ciudad No Puede Ser Vacio");
	   document.config.ciudad_emp.focus();
	   return 0;
	   	     }	
	if(document.config.estado_emp.value.length==0)
	{  
	  alert("Estado No Puede Ser Vacio");
	   document.config.estado_emp.focus();
	   return 0;
	   	     }	
			 
	if(document.config.cp_emp.value.length==0)
	{  
	  alert("Codigo Postal No Puede Ser Vacio");
	   document.config.cp_emp.focus();
	   return 0;
	   	     }	
	if(document.config.tel_emp.value.length==0)
	{  
	  alert("Telefono No Puede Ser Vacio");
	   document.config.tel_emp.focus();
	   return 0;
	   	     }		
	if(document.config.logo_emp.value.length==0)
	{  
	  alert("Selecciona una imagen");
	   document.config.logo_emp.focus();
	   return 0;
	   	     }
	if(document.config.suc_emp.value.length==0)
	{  
	  alert("Sucursal No Puede Ser Vacio");
	   document.config.suc_emp.focus();
	   return 0;
	   	     }	
			 
	if (document.config.fech_captura.value.length==0)
	{ 
      	 alert("Fecha no puede ser vacio"); 
      	 document.config.fech_captura.focus(); 
      	 return 0; 
	}
document.config.submit();	 
}

function configBF()
{
  if (document.configbf.id_suc.value.length==0)
   { 
      	 alert("Selecciona Una Sucursal"); 
      	 document.configbf.id_suc.focus(); 
      	 return 0; 
	}
document.config.submit();	 

}

function valida_Mfolios()
{
	  if (document.mfolios.folio_inicial.value.length==0)
   { 
      	 alert("Folio Inicial No Puede Ser Vacio"); 
      	 document.mfolios.folio_inicial.focus(); 
      	 return 0; 
	}
	 if (document.mfolios.folio_final.value.length==0)
   { 
      	 alert("Folio Final No Puede Ser Vacio"); 
      	 document.mfolios.folio_final.focus(); 
      	 return 0; 
	}
	 if (document.mfolios.sicofi.value.length==0)
   { 
      	 alert("Numero De Aprobacion Del Sicofi No Puede Ser Vacio"); 
      	 document.mfolios.sicofi.focus(); 
      	 return 0; 
	}
	
	 if (document.mfolios.fech_aprobacion.value.length==0)
   { 
      	 alert("Fecha De Aprobacion De Folios No Puede Ser Vacio"); 
      	 document.mfolios.fech_aprobacion.focus(); 
      	 return 0; 
	}
	 if (document.mfolios.img_cbb.value.length==0)
   { 
      	 alert("Selecciona Imagen Codigo De Barras Bidemencional"); 
      	 document.mfolios.img_cbb.focus(); 
      	 return 0; 
	}
	
document.mfolios.submit();	 

}





function configF()
{
	
  if (document.configf.id_suc.value.length==0)
   { 
      	 alert("Selecciona Una Sucursal"); 
      	 document.configf.id_suc.focus(); 
      	 return 0; 
	}
  if(document.configf.folio_inicial.value.length==0)
    {
	  alert("Folio Inicial No Puede Ser Vacio");
	    document.configf.folio_inicial.focus();
		return 0;
		 }
	if(document.configf.folio_final.value.length==0)
	{  
	  alert("Folio Final No Puede Ser Vacio");
	   document.configf.folio_final.focus();
	   return 0;
	   	     }	
	if(document.configf.sicofi.value.length==0)
	{  
	  alert("Numero De Aprobacion Sicofi No Puede Ser Vacio");
	   document.configf.sicofi.focus();
	   return 0;
	   	     }	
	if(document.configf.fech_aprobacion.value.length==0)
	{  
	  alert("Fecha De Aprobacion No Puede Ser Vacio");
	   document.configf.fech_aprobacion.focus();
	   return 0;
	   	     }	
			 
	if(document.configf.img_cbb.value.length==0)
	{  
	  alert("Imagen Codigo De Barras No Puede Ser Vacio");
	   document.configf.img_cbb.focus();
	   return 0;
	   	     }	
document.configf.submit();	 
}

function configuraB()
{
	 if (document.config.nom.value.length==0)
   { 
      	 alert("Nombre o Razon Social No Puede Ser Vacio"); 
      	 document.config.nom.focus(); 
      	 return 0; 
	}
  if(document.config.rfc_emp.value.length==0)
    {
	  alert("Rfc No Puede Ser Vacio");
	    document.config.rfc_emp.focus();
		return 0;
		 }
	if(document.config.dire_emp.value.length==0)
	{  
	  alert("Direccion No Puede Ser Vacio");
	   document.config.dire_emp.focus();
	   return 0;
	   	     }	
	if(document.config.ciudad_emp.value.length==0)
	{  
	  alert("Ciudad No Puede Ser Vacio");
	   document.config.ciudad_emp.focus();
	   return 0;
	   	     }	
	if(document.config.estado_emp.value.length==0)
	{  
	  alert("Estado No Puede Ser Vacio");
	   document.config.estado_emp.focus();
	   return 0;
	   	     }	
			 
	if(document.config.cp_emp.value.length==0)
	{  
	  alert("Codigo Postal No Puede Ser Vacio");
	   document.config.cp_emp.focus();
	   return 0;
	   	     }	
	if(document.config.tel_emp.value.length==0)
	{  
	  alert("Telefono No Puede Ser Vacio");
	   document.config.tel_emp.focus();
	   return 0;
	   	     }		
	if(document.config.logo_emp.value.length==0)
	{  
	  alert("Selecciona una imagen");
	   document.config.logo_emp.focus();
	   return 0;
	   	     }
	if(document.config.suc_emp.value.length==0)
	{  
	  alert("Sucursal No Puede Ser Vacio");
	   document.config.suc_emp.focus();
	   return 0;
	   	     }	
			 
	if (document.config.fech_captura.value.length==0)
	{ 
      	 alert("Fecha no puede ser vacio"); 
      	 document.config.fech_captura.focus(); 
      	 return 0; 
	}
 	
document.configf.submit();	 
}



function valida_buscaemp()
{

 if (document.busca.id_suc.value.length==0)
   { 
      	 alert("Selecciona Una Sucursal"); 
      	 document.busca.id_suc.focus(); 
      	 return 0; 
	}
document.busca.submit();	 
	
	}

/*FECHA ACTUAL
//Autor: Iván Nieto Pérez
//Este script y otros muchos pueden
//descarse on-line de forma gratuita
//en El Código: www.elcodigo.com
function obtiene_fecha(fecha) {
	
	var fecha_actual = new Date()

	var dia = fecha_actual.getDate()
	var mes = fecha_actual.getMonth() + 1
	var anio = fecha_actual.getFullYear()

	if (mes < 10)
		mes = '0' + mes

	if (dia < 10)
		dia = '0' + dia

	var fecha="dia/mes/anio";
	alert(fecha);
}


*/