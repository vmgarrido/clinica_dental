$.ajaxSetup({
    async: false
});

var tabla;

function init() {
    limpiar();
	listar();
}

function listar(){
    tabla=$('#tablaEspecialidades2').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [],
		"ajax":
				{
					url: base_url + 'Cespecialidades/getEspecialidades',
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

function limpiar(){
    $("input[type=text]").val("");
    $("input[type=checkbox]").prop("checked", false);
	$('#exampleModal').modal('hide');
	$("#panelTrt").hide();
	$(".panelInit").show();
	$(".trt").prop("disabled", false);
	$("#txtEsp").prop("readonly", true);
	
}

function getTratamientos(id){

	$.post(base_url + "Cespecialidades/getTratamientos", {id: id}, function (data) {

	}).done(function (data) {
		$("#listTrt").html(data);
	});

}

$("#txtNombreEspecialidadNueva").keydown(function () {
    $("#mensaje-especialidad").fadeOut("fast");
});

$("#btnConsultar").click(function(){
	var esp = $("#txtNombreEspecialidadNueva").val();

	if (esp == "") {
        $("#mensaje-especialidad").fadeIn("slow");
        return false;
    }

	$.post(base_url + "Cespecialidades/verificarEsp", {esp: esp}, function (data) {

	}).done(function (data) {
		if(data == "1"){
			alertify.warning("Esta especialidad ya se encuentra registrada.");
		} else {
			registrar(esp);
		}
	});

});

function registrar(nombre){
	getTratamientos(null);
	$(".trt").prop("disabled", false);
	$(".btnAccion").hide();
	$("#btnRegistrar, #btnCancelar").show();
	$(".panelInit").hide();
	$("#espTitulo").text("Registrar Especialidad");
	$("#txtEsp").val(nombre);
	$("#txtIdEsp").val("");
	$("#panelTrt").show();
}

function ver(id, nombre){
	getTratamientos(id);
	$(".trt").prop("disabled", true);
	$(".btnAccion").hide();
	$("#btnCancelar").show();
	$(".panelInit").hide();
	$("#espTitulo").text("Ver datos");
	$("#txtEsp").val(nombre);
	$("#txtIdEsp").val(id);
	$("#panelTrt").show();
}

function edit(id, nombre){
	getTratamientos(id);
	$(".trt").prop("disabled", false);
	$(".btnAccion").hide();
	$("#btnModificar, #btnCancelar").show();
	$(".panelInit").hide();
	$("#espTitulo").text("Modificar Especialidad");
	$("#txtEsp").val(nombre);
	$("#txtIdEsp").val(id);
	$("#txtEsp").prop("readonly", false);
	$("#panelTrt").show();
}

function activar(id, nombre){
	getTratamientos(id);
	$(".trt").prop("disabled", true);
	$(".btnAccion").hide();
	$("#btnActivar, #btnCancelar").show();
	$(".panelInit").hide();
	$("#espTitulo").text("Modificar Especialidad");
	$("#txtEsp").val(nombre);
	$("#txtIdEsp").val(id);
	$("#txtEsp").prop("readonly", true);
	$("#panelTrt").show();
}

function desactivar(id, nombre){
	getTratamientos(id);
	$(".trt").prop("disabled", true);
	$(".btnAccion").hide();
	$("#btnDesactivar, #btnCancelar").show();
	$(".panelInit").hide();
	$("#espTitulo").text("Modificar Especialidad");
	$("#txtEsp").val(nombre);
	$("#txtIdEsp").val(id);
	$("#txtEsp").prop("readonly", true);
	$("#panelTrt").show();
}

$("#btnRegistrar").click(function(){
	var formData = new FormData($("form#formEsp")[0]);
	var esp = $("#txtEsp").val();

	alertify.confirm('Registrar Especialidad', '¿Seguro que desea registrar esta Especialidad "<strong>'+esp+'</strong>"?', function () {

		$.ajax({
			url: base_url + "Cespecialidades/registrarEsp",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function (datos) {
				console.log(datos);
				if(datos == "B"){
					alertify.warning("Seleccione tratamientos");
				}
				else if(datos == "1"){
					tabla.ajax.reload();
					limpiar();
					alertify.success("Especialidad registrada correctamente.");
				} else{
					alertify.error("Error en registrar especialidad");
				}
			}

		});

	}, function () {

	});
});

$("#btnModificar").click(function(){
	var formData = new FormData($("form#formEsp")[0]);
	var esp = $("#txtEsp").val();
	var id = $("#txtIdEsp").val();

	alertify.confirm('Modificar Especialidad', '¿Seguro que desea modificar esta Especialidad "<strong>'+esp+'</strong>"?', function () {

		$.ajax({
			url: base_url + "Cespecialidades/modificarEsp",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function (datos) {
				console.log(datos);
				if(datos == "B"){
					alertify.warning("Seleccione tratamientos");
				} else if(datos == "A"){
					alertify.warning("Esta especialidad ya se encuenta registrada.");
				} else if(datos == "1"){
					tabla.ajax.reload();
					limpiar();
					alertify.success("Especialidad modificada correctamente.");
				} else{
					alertify.error("Error en modificar especialidad");
				}
			}

		});

	}, function () {

	});

});

$("#btnActivar").click(function(){

	var formData = new FormData($("form#formEsp")[0]);
	var esp = $("#txtEsp").val();

	alertify.confirm('Activar Especialidad', '¿Seguro que desea activar esta Especialidad "<strong>'+esp+'</strong>"?', function () {

		$.ajax({
			url: base_url + "Cespecialidades/activarEsp",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function (datos) {
				console.log(datos);
				if(datos == "1"){
					tabla.ajax.reload();
					limpiar();
					alertify.success("Especialidad activada correctamente.");
				} else{
					alertify.error("Error en activar especialidad");
				}
			}

		});

	}, function () {

	});

});

$("#btnDesactivar").click(function(){

	var formData = new FormData($("form#formEsp")[0]);
	var esp = $("#txtEsp").val();

	alertify.confirm('Desactivar Especialidad', '¿Seguro que desea Desactivar esta Especialidad "<strong>'+esp+'</strong>"?', function () {

		$.ajax({
			url: base_url + "Cespecialidades/desactivarEsp",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function (datos) {
				console.log(datos);
				if(datos == "No"){
					alertify.warning("Esta especialidad tiene dentistas activos.");
				} else if(datos == "1"){
					tabla.ajax.reload();
					limpiar();
					alertify.success("Especialidad desactivada correctamente.");
				} else{
					alertify.error("Error en desactivar especialidad");
				}
			}

		});

	}, function () {

	});

});

$("#btnCancelar").click(function(){
	limpiar();
});

init();

