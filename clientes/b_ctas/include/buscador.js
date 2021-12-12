function xmlhttp(){
		var xmlhttp;
		try{xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");}
		catch(e){
			try{xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");}
			catch(e){
				try{xmlhttp = new XMLHttpRequest();}
				catch(e){
					xmlhttp = false;
				}
			}
		}
		if (!xmlhttp) 
				return null;
			else
				return xmlhttp;
	}

function buscar(){
		var query = document.getElementById('q').value;
		var A = document.getElementById('resultados');
		var B = document.getElementById('loading');
		var ajax = xmlhttp();

		ajax.onreadystatechange=function(){
				if(ajax.readyState==1){
						B.innerHTML = "<img src='images/loading.gif' alg='Loading...'>";
					}
				if(ajax.readyState==4){
						A.innerHTML = ajax.responseText;
						B.innerHTML = "";
					}
			}
		ajax.open("GET","busqueda.php?q="+encodeURIComponent(query),true);
		ajax.send(null);
		return false;
	}

function buscar_ant(){
		var query = document.getElementById('q').value;
		var A = document.getElementById('resultados');
		var B = document.getElementById('loading');
		var ajax = xmlhttp();

		ajax.onreadystatechange=function(){
				if(ajax.readyState==1){
						B.innerHTML = "<img src='images/loading.gif' alg='Loading...'>";
					}
				if(ajax.readyState==4){
						A.innerHTML = ajax.responseText;
						B.innerHTML = "";
					}
			}
		ajax.open("GET","busqueda_ant.php?q="+encodeURIComponent(query),true);
		ajax.send(null);
		return false;
	}

function add_cliente_contabilidad(){
		var query = document.getElementById('clienteadd').value;
		var A = document.getElementById('resultados');
		var B = document.getElementById('loading');
		var ajax = xmlhttp();

		ajax.onreadystatechange=function(){
				if(ajax.readyState==1){
						B.innerHTML = "<img src='images/loading.gif' alg='Loading...'>";
					}
				if(ajax.readyState==4){
						A.innerHTML = ajax.responseText;
						B.innerHTML = "";
					}
			}
		ajax.open("GET","add_cliente_contabilidad.php?q="+encodeURIComponent(query),true);
		ajax.send(null);
		return false;
	}
function add_cliente_contabilidad_ant(){
		var query = document.getElementById('clienteadd').value;
		var A = document.getElementById('resultados');
		var B = document.getElementById('loading');
		var ajax = xmlhttp();

		ajax.onreadystatechange=function(){
				if(ajax.readyState==1){
						B.innerHTML = "<img src='images/loading.gif' alg='Loading...'>";
					}
				if(ajax.readyState==4){
						A.innerHTML = ajax.responseText;
						B.innerHTML = "";
					}
			}
		ajax.open("GET","add_cliente_contabilidad_ant.php?q="+encodeURIComponent(query),true);
		ajax.send(null);
		return false;
	}