$.ajaxSetup({
    async: false
});

var tabla;

function init(){
	getTipoPacientes();
	listar();
}

function listar(){
    tabla=$('#tablaEditIsapre').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [],
		"ajax":
				{
					url: base_url + 'Cprevision/getIsapres',
					type : "post",
					dataType : "json",
                    async: false,
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "asc" ]],//Ordenar (columna,orden),
        "language": {
                "lengthMenu": "Mostrar las _MENU_ primeras filas",
                "zeroRecords": "No se encuentran resultados.",
                "infoEmpty": "",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "sSearch": "Buscar:"
            }
	}).DataTable();
}

function getTipoPacientes(){

	$.post(base_url + "Cprevision/getTipoPacientes", function (data) {

    }, 'json').done(function (data) {
        console.log(data);

		for(var i in data) {

			switch(data[i].id) {
			    case "2":
			        
			    	if(data[i].activo_tipo == "t"){
			    		$("#td-fonasa").html('<button type="button" class="btn btn-danger" onclick="desactivar(2);">Desactivar</button>');
			    	} else{

			    		$("#td-fonasa").html('<button type="button" class="btn btn-success" onclick="activar(2);">Activar</button>');
			    	}

			        break;
			    case "3":
			        
			    	if(data[i].activo_tipo == "t"){
			    		$("#td-isapre").html('<button type="button" class="btn btn-danger" onclick="desactivar(3);">Desactivar</button>');
			    	} else{

			    		$("#td-isapre").html('<button type="button" class="btn btn-success" onclick="activar(3);">Activar</button>');
			    	}

			        break;
			} 

		}
    });
}

function desactivar(id){

	$.post(base_url + "Cprevision/desactivarTipoPaciente", {id: id}, function (data) {

    }).done(function (data) {
        if(data == 1){
        	getTipoPacientes();
        	alertify.success("Proceso completado");
        } else {
        	alertify.error("Error en desactivar");
        }
    });

}

function activar(id){

	$.post(base_url + "Cprevision/activarTipoPaciente", {id: id}, function (data) {

    }).done(function (data) {
        if(data == 1){
        	getTipoPacientes();
        	alertify.success("Proceso completado");
        } else {
        	alertify.error("Error en activar");
        }
    });

}

function desactivarIs(id, isapre){
	alertify.confirm('Confirmar Desactivación', 'Isapre: <strong>'+isapre+'</strong>', function () {
		$.post(base_url + "Cprevision/desactivarIsapre", {id: id}, function (data) {

	    }).done(function (data) {
	        if(data == 1){
	        	tabla.ajax.reload();
	        	alertify.success("Desactivar completado");
	        } else {
	        	alertify.error("Error en desactivar");
	        }
	    });
    }, function () {

	});
}

function activarIs(id, isapre){
	alertify.confirm('Confirmar Activación', 'Isapre: <strong>'+isapre+'</strong>', function () {
		
		$.post(base_url + "Cprevision/activarIsapre", {id: id}, function (data) {

	    }).done(function (data) {
	        if(data == 1){
	        	tabla.ajax.reload();
	        	alertify.success("Activar completado");
	        } else {
	        	alertify.error("Error en activar");
	        }
	    });
	}, function () {

	});
}

$("#txtNuevaIsapre").keydown(function () {
    $("#mensajeIsapre").fadeOut("fast");
});

$("#btnRegistrar").click(function(){
	var isapre = $("#txtNuevaIsapre").val();

	$(".errores").fadeOut("fast");
    if (isapre == "") {
        $("#mensajeIsapre").fadeIn("slow");
    } else{

    	alertify.confirm('Confirmar Registro', 'Isapre: <strong>'+isapre+'</strong>', function () {
	    	$.post(base_url + "Cprevision/registrarIsapre", {isapre: isapre}, function (data) {

		    }).done(function (data) {
		        if(data == "A"){
		        	alertify.warning("Esta isapre ya se encuentra registrada");
		        } else if(data == "1"){
		        	tabla.ajax.reload();
		        	alertify.success("Registro completado");
		        } else {
		        	alertify.error("Error en registrar");
		        }
		    });
		}, function () {

        });

    }
});
var isapre_actual = "";
function edit(id, isapre){
	isapre_actual = isapre;
	$("#aId").val(id);
	$("#newIsapre").val(isapre);
	$('#exampleModal').modal('show');
}

$("#btnCambiar").click(function(){
	var id = $("#aId").val();
	var isapre = $("#newIsapre").val();

	alertify.confirm('Confirmar Modificación', 'Isapre antigua: <strong>'+isapre_actual+'</strong><br>Isapre nueva: <strong>'+isapre+'</strong>', function () {
		$.post(base_url + "Cprevision/editarIsapre", {id: id, isapre: isapre}, function (data) {

	    }).done(function (data) {
	        if(data == "A"){
	        	alertify.warning("Esta isapre ya se encuentra registrada");
	        } else if(data == "1"){
				$('#exampleModal').modal('hide');
	        	tabla.ajax.reload();
	        	alertify.success("Modificación completada");
	        } else {
	        	alertify.error("Error en Modificar");
	        }
	    });
	}, function () {

	});
});

init();