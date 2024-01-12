$.ajaxSetup({
    async: false
});

var tabla;

function init() {
    limpiar();
	listar();
}

function limpiar(){
    $("input[type=text]").val("");
}

function listar(){
    tabla=$('#tablaBox2').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [],
		"ajax":
				{
					url: base_url + 'Cbox/getBoxes',
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

$("#txtNumeroBoxNuevo").keydown(function () {
    $("#mensaje-numero").fadeOut("fast");
});

$("#btnRegistrar").click(function(e){

    var num_box = $("#txtNumeroBoxNuevo").val();

    if (num_box == "") {
        $("#mensaje-numero").fadeIn("slow");
        return false;
    }

    alertify.confirm('Registrar Box', '¿Seguro que desea registrar "<strong>Box '+num_box+'</strong>"?', function () {
        $.post(base_url + "Cbox/registrarBox", {num_box: num_box}, function (data) {

        }).done(function (data) {
            
            if(data == "A"){
                alertify.warning("Este box ya se encuentra registrado");
            } else if (data == "1"){
                limpiar();
                tabla.ajax.reload();
                alertify.success("Box registrado correctamente");
            } else{
                alertify.error("Error en registrar");
            }

        });
    }, function () {

	});

});

function desactivarBox(id_box, num_box){
    alertify.confirm('Desactivar Box', '¿Seguro que desea desactivar "<strong>Box '+num_box+'</strong>"?', function () {
        $.post(base_url + "Cbox/desactivarBox", {id_box: id_box}, function (data) {

        }).done(function (data) {
            
            if (data == "1"){
                limpiar();
                tabla.ajax.reload();
                alertify.success("Box desactivado correctamente");
            } else{
                alertify.error("Error en desactivar");
            }

        });
    }, function () {

	});
}

function activarBox(id_box, num_box){
    alertify.confirm('Activar Box', '¿Seguro que desea activar "<strong>Box '+num_box+'</strong>"?', function () {
        $.post(base_url + "Cbox/activarBox", {id_box: id_box}, function (data) {

        }).done(function (data) {
            
            if (data == "1"){
                limpiar();
                tabla.ajax.reload();
                alertify.success("Box activado correctamente");
            } else{
                alertify.error("Error en activar");
            }

        });
    }, function () {

	});
}

function editarBox(id_box, num_box){
    $("#txtIdBox").val(id_box);
    $("#txtNumeroBoxEdit").val(num_box);
    $('#exampleModal').modal('show');
}

$("#btnGuardar").click(function(){
    var id_box = $("#txtIdBox").val();
    var num_box = $("#txtNumeroBoxEdit").val();

    $.post(base_url + "Cbox/modificarBox", {id_box: id_box, num_box: num_box}, function (data) {

    }).done(function (data) {
        
        if(data == "A"){
            alertify.warning("Este box ya se encuentra registrado");
        } else if (data == "1"){
            $('#exampleModal').modal('hide');
            limpiar();
            tabla.ajax.reload();
            alertify.success("Box modificado correctamente");
        } else{
            alertify.error("Error en modificar box");
        }

    });
});

init();