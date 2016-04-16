$.fn.upload = function(remote, data, successFn, progressFn){
	if(typeof data!= "object"){
		progressFn= successFn;
		successFn= data;
	}
	return this.each(function(){
		if($(this)[0].files[0]){
			var formData =new FormData($("#euser")[0]);
			formData.append($(this).attr("name"), $(this)[0].files[0]);

			if(typeof data == "object"){
				for(var i in data){
					formData.append(i, data[i]);
				}
				//console.log(data);
			}

			$.ajax({
	        	url : remote,
		        type : 'POST',
		    	xhr: function(){
		    		myXhr = $.ajaxSettings.xhr();
		    		if(myXhr.upload && progressFn){
		    			myXhr.upload.addEventListener('progress', function(prog){
		    				var value = ~~((prog.loaded / prog.total) * 100);
		    				if (progressFn && typeof progressFn == "function"){
		    					progressFn(prog,value);
		    				}
		    				else if (progressFn){
		    					$(progressFn).val(value);
		    				}
		    			}, false);
		    		}
		    		return myXhr;
		    	},
		        
				data : formData,
		    	cache: false,
		    	contentType: false,
		    	processData: false,
		        dataType : 'html',
		    	
		        success : function(html) {
					$("#contenido").prepend(html);
			        //$("#prog")[0].value=0;
			        $("#euser")[0].reset();//resetea el formulario.

		        },
		    	error : function(jqXHR, status, error) {
		            alert('ocurrio un error'+ error+" : "+jqXHR.status+' status: '+status);
		        },
		    	// código a ejecutar sin importar si la petición falló o no
		        complete : function(jqXHR, status) {
		            //console.log('Petición realizada');
		        }
    		});
		}
	});
}