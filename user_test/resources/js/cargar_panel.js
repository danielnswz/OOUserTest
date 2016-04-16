function cargar(url_p, id_panel, datos, asincrono){
	var actual = $("#"+id_panel).html();
	$("#"+id_panel).html('<div align="center"><img style="max-width:300px" src="../resources/images/loading.gif" /></div>');
	//wait(2);
	if(asincrono!= false) asincrono=true;
	//console.log(url_p+' : '+as);
	$.ajax({
		url:url_p,
		type : 'POST',
		data: datos,
		dataType : 'html',
		async: asincrono,
		success : function(html) {
			setTimeout(function() {
			    $("#"+id_panel).html(html);//establece nuevo contenido para el panel.
			}, 500);
			
		},
		error : function(jqXHR, status, error) {
		    alert('ocurrio un error: '+ error+"-->"+jqXHR.status);
		}	
	});
}