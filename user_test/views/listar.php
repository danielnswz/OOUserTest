<?php
	include("../controllers/UsuarioController.php");
session_start();
if(isset($_SESSION['email'])){
	if(isset($_POST['ID'])||isset($_POST['NOMBRE'])||isset($_POST['APELLIDO'])||isset($_POST['SEXO'])||isset($_POST['EMAIL'])){
		$where="id like '".$_POST['ID']."%' AND nombre like '".$_POST['NOMBRE']."%' AND apellido like '".$_POST['APELLIDO']."%' AND sexo like '".$_POST['SEXO']."%' AND email like '".$_POST['EMAIL']."%'";
		$rs = UsuarioController::getList($where);
	}else{
		$rs = UsuarioController::getList();
	}
	echo "<div class='table-responsive'><table class='table table-hover table-bordered table-condensed'id='tabla' style='font-size: 87%'><tbody>
					<thead align='center'>
						<th style='max-width: 105px; padding:0;'><input style='width: 100%; type='text' id='ID' name='ID' placeholder='ID' onkeydown=' if(event.keyCode == 13) busqueda(\"0\"); '></th>
						<th style='max-width: 105px; padding:0;'><input style='width: 100%; type='text' id='NOMBRE' name='NOMBRE' placeholder='NOMBRE' onkeydown=' if(event.keyCode == 13) busqueda(\"0\"); '></th>
						<th style='max-width: 105px; padding:0;'><input style='width: 100%; type='text' id='APELLIDO' name='APELLIDO' placeholder='APELLIDO' onkeydown=' if(event.keyCode == 13) busqueda(\"0\"); '></th>
						<th style='max-width: 105px; padding:0;'><input style='width: 100%; type='text' id='SEXO' name='SEXO' placeholder='SEXO' onkeydown=' if(event.keyCode == 13) busqueda(\"0\"); '></th>
						<th style='max-width: 105px; padding:0;'><input style='width: 100%; type='text' id='EMAIL' name='EMAIL' placeholder='EMAIL' onkeydown=' if(event.keyCode == 13) busqueda(\"0\"); '></th>
						<!--<th style='max-width: 105px; padding:0;'><input style='width: 100%; type='text' id='PASSWORD' name='PASSWORD' placeholder='PASSWORD' onkeydown=' if(event.keyCode == 13) busqueda(\"0\"); '></th>-->
					</thead>";
	if($rs!=NULL){
		foreach ($rs as $key => $value) {
			$u = $rs[$key];
			echo "<tr id='tr' style='cursor: pointer' style='width:100%; font-stretch: ultra-condensed; letter-spacing: 0;text-transform: capitalize;max-width: 100%;line-height: 250%; margin:0; text-align:center;' align='center' onclick='seleccionado(this)'>
					<td id='ID_td'>".$u->getId()."</td>
					<td id='NOMBRE_td'>".$u->getNombre()."</td>
					<td id='APELLIDO_td'>".$u->getApellido()."</td>
					<td id='SEXO_td'>".$u->getSexo()."</td>
					<td id='EMAIL_td'>".$u->getEmail()."</td>
                    <input type='hidden' id='foto_".$u->getId()."' value='".$u->getFoto()."'>
				  </tr>";
		}
	}else{
		echo "No hay registros!";
	}
	
	echo "</tbody></table>";
?>
    <script type="text/javascript">
    function busqueda(inf){
        var formData =new FormData();
        var ID = $("#ID").val();
        var NOMBRE = $("#NOMBRE").val();
        var APELLIDO = $("#APELLIDO").val();
        var SEXO = $("#SEXO").val();
        var EMAIL = $("#EMAIL").val();
        /*console.log("ID=>"+ID);
        console.log("NOMBRE=>"+NOMBRE);
        console.log("APELLIDO=>"+APELLIDO);
        console.log("SEXO=>"+SEXO);
        console.log("EMAIL=>"+EMAIL);*/
        formData.append('ID',ID);
        formData.append('NOMBRE',NOMBRE);
        formData.append('APELLIDO',APELLIDO);
        formData.append('SEXO',SEXO);
        formData.append('EMAIL',EMAIL);
        $.ajax({
         	url: '<? echo "http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/views/listar.php"?>' ,
        	type : 'POST',
         	data : formData,
        	dataType : 'html',
        	contentType: false,
        	processData: false,
        	success : function(contenido) {
        	  $("#contenido").html(contenido);
        	},
        	error : function(jqXHR, status, error){
        	  console.log('error');
        	}
        });
    }
    function seleccionado(elemento){
    	var v_datos = new Array();
    	var v_idtd = new Array();
    	var formData =new FormData();

        $(elemento).find('td').each(function(i, e){
            v_datos[i]=$(e).html();
            v_idtd[i]=$(e).attr('id');
            if($(e).attr('id')=='ID_td'){
                //console.log($(e).html()+"=> #foto_"+$(e).html());
                //console.log($("#foto_"+$(e).html()).val());
                formData.append('foto',$("#foto_"+$(e).html()).val());
            }
                
            formData.append(v_idtd[i], v_datos[i]);
            //console.log($(e).attr('id')+"=>"+v_datos[i]);
        });

        $.ajax({
         	url: '<? echo "http://".$_SERVER['HTTP_HOST']."/agentes_informaticos/views/Usuario.php"?>' ,
        	type : 'POST',
         	data : formData,
        	dataType : 'html',
        	contentType: false,
        	processData: false,
        	success : function(contenido) {
        	  $("#contenido").html(contenido);
        	},
        	error : function(jqXHR, status, error){
        	  console.log('error');
        	}
        });
    }


</script>
<?php
}else{
    echo "Error Not Found 404";
}
?>