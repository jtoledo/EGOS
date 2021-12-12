 $(document).ready(function(){
						   
		$("#estado").change(function(){
			if($(this).val()!=""){
				var dato=$(this).val();
				$("#imgmunicipio").show();
				$.ajax({
					type:"POST",
					dataType:"html",
					url:"action.php",
					data:"idestado="+dato+"&tarea=listMunicipio",
					success:function(msg){
						//alert(msg);
						$("#municipio").empty().removeAttr("disabled").append(msg);
						$("#imgmunicipio").hide();
					}
				});
			}else{
				$("#municipio").empty().attr("disabled","disabled");
				$("#localidad").empty().attr("disabled","disabled");
				$("#colonia").empty().attr("disabled","disabled");
			}	
		});
		
		$("#municipio").change(function(){
			if($(this).val()!=""){
				var dato=$(this).val();
				$("#imglocalidad").show();
				$.ajax({
					type:"POST",
					dataType:"html",
					url:"action.php",
					data:"idmunicipio="+dato+"&tarea=listLocalidad",
					success:function(msg){
						//alert(msg);
						$("#localidad").empty().removeAttr("disabled").append(msg);
						$("#imglocalidad").hide();
					}
				});
			}else{
				$("#localidad").empty().attr("disabled","disabled");
			}	
		});
		
		
		
		$("#localidad").change(function(){
			if($(this).val()!=""){
				var dato=$(this).val();
				$("#imgcolonia").show();
				$.ajax({
					type:"POST",
					dataType:"html",
					url:"action.php",
					data:"idlocalidad="+dato+"&tarea=listColonia",
					success:function(msg){
						//alert(msg);
						$("#colonia").empty().removeAttr("disabled").append(msg);
						$("#imgcolonia").hide();
					}
				});
			}else{
				$("#colonia").empty().attr("disabled","disabled");
			}	
		});
		
	
	
	
	
	
	
	});