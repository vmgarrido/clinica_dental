$.ajaxSetup({
    async: false
});

var tabla;

function init() {
    limpiar();
	listar();
}

function listar(){
    tabla=$('#tablaPiezasactuales').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [],
		"ajax":
				{
					url: base_url + 'Cpiezasdentales/getPiezas',
					type : "post",
					dataType : "json",
                    async: false,
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    "order": [[ 1, "asc" ]],//Ordenar (columna,orden),
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
}

// desaparecer mensajes de error

$("#txtNombrePiezaNueva").keydown(function () {
    $("#mensaje-pieza").fadeOut("fast");
});

$("#txtNumeroPiezaNueva").keydown(function () {
    $("#mensaje-numero").fadeOut("fast");
});

$("#btnRegistrar").click(function(){
    var nombre = $("#txtNombrePiezaNueva").val();
    var numero = $("#txtNumeroPiezaNueva").val();

    if (nombre == "") {
        $("#mensaje-pieza").fadeIn("slow");
        return false;
    } else if (numero == "") {
        $("#mensaje-numero").fadeIn("slow");
        return false;
    }

    var msg = "Nombre: <strong>"+nombre+"</strong><br>Número: <strong>"+numero+"</strong>";

    alertify.confirm('Confirmar registro', msg, function () {
        $.post(base_url + "Cpiezasdentales/registrarPieza", {nombre: nombre, numero: numero}, function (data) {

        }).done(function (data) {
            
            if(data == "A"){
                alertify.warning("Esta pieza ya se encuentra registrada");
            } else if (data == "1"){
                limpiar();
                tabla.ajax.reload();
                alertify.success("Pieza registrada correctamente");
            } else{
                alertify.error("Error en registrar pieza");
            }

        });
    }, function () {

	});
});

function editarPieza(id, nombre, numero){
    $("#txtIdPieza").val(id);
    $("#txtNombrePiezaEdit").val(nombre);
    $("#txtNumeroPiezaEdit").val(numero);

    $('#exampleModal').modal('show');
}

$("#btnGuardar").click(function(){
    var id_pd = $("#txtIdPieza").val();
    var nombre = $("#txtNombrePiezaEdit").val();
    var numero = $("#txtNumeroPiezaEdit").val();

    var msg = "Nombre: <strong>"+nombre+"</strong><br>Número: <strong>"+numero+"</strong>";

    alertify.confirm('Confirmar modificación', msg, function () {
        $.post(base_url + "Cpiezasdentales/modificarPieza", {id_pd: id_pd,nombre: nombre, numero: numero}, function (data) {

        }).done(function (data) {
            
            if(data == "A"){
                alertify.warning("Esta pieza ya se encuentra registrada");
            } else if (data == "1"){
                $('#exampleModal').modal('hide');
                limpiar();
                tabla.ajax.reload();
                alertify.success("Pieza modificada correctamente");
            } else{
                alertify.error("Error en modificar pieza");
            }

        });
    }, function () {

	});
});

function desactivarPieza(id, nombre, numero){
    var msg = "Nombre: <strong>"+nombre+"</strong><br>Número: <strong>"+numero+"</strong>";

    alertify.confirm('Desactivar pieza. Confirmar', msg, function () {
        $.post(base_url + "Cpiezasdentales/desactivarPieza", {id_pd: id}, function (data) {

        }).done(function (data) {
            
            if (data == "1"){
                limpiar();
                tabla.ajax.reload();
                alertify.success("Pieza desactivada correctamente");
            } else{
                alertify.error("Error en desactivar pieza");
            }

        });
    }, function () {

	});
}

function activarPieza(id, nombre, numero){
    var msg = "Nombre: <strong>"+nombre+"</strong><br>Número: <strong>"+numero+"</strong>";

    alertify.confirm('Activar pieza. Confirmar', msg, function () {
        $.post(base_url + "Cpiezasdentales/activarPieza", {id_pd: id}, function (data) {

        }).done(function (data) {
            
            if (data == "1"){
                limpiar();
                tabla.ajax.reload();
                alertify.success("Pieza activada correctamente");
            } else{
                alertify.error("Error activar pieza");
            }

        });
    }, function () {

	});
}


init();