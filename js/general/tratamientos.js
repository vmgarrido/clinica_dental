$.ajaxSetup({
    async: false
});

var tabla;

function init() {
    limpiar();
    listar();
}

function listar(){
    tabla=$('#tablaTratamientos2').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [],
		"ajax":
				{
					url: base_url + 'Ctratamientos/getTratamientos',
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
}

function getTratamientos(){
    $.post(base_url + "Ctratamientos/getTratamientos", function (data) {

    }).done(function (data) {
        $("#bodyTratamientos").html(data);
    });
}

$("#txtTratamientoNuevo").keydown(function () {
    $("#mensajeTrt").fadeOut("fast");
});

$("#txtValor").keydown(function () {
    $("#mensajeValor").fadeOut("fast");
});

$("#btnRegistrar").click(function(){
    var trt = $("#txtTratamientoNuevo").val();
    var valor = $("#txtValor").val();

    var pu = false;
    if($("#chkPU").prop("checked")){
        pu = true;
    }
    
    $(".errores").fadeOut("fast");
    if(trt.length == 0){
        $("#mensajeTrt").fadeIn("slow");
    } else if (valor.length == 0){
        $("#mensajeValor").fadeIn("slow");
    } else {
        
        alertify.confirm('Registrar Tratamiento', '¿Seguro que desea registrar este tratamiento "'+trt+'"?', function () {
        
            $.post(base_url + "Ctratamientos/setTratamientos", {
                trt: trt,
                valor: valor,
                pu: pu
            }, function (data) {

            }).done(function (data) {
                console.log(data);
                if(data == "A"){
                    alertify.warning("Este tratamiento ya se encuentra registrado");
                } else if( data == "1"){
                    limpiar();
                    tabla.ajax.reload();
                    alertify.success("Tratamiento registrado correctamente");
                } else{
                    alertify.error("Error en registrar Tratamiento");
                }
            });
        }, function () {

        });
    }
});


function edit(id, trt, valor, pu){
    $("#aId").val(id);
    $("#newTrt").val(trt);
    $("#newValor").val(valor);
    
    if(pu == "Si"){
        $("#newPu").prop("checked", true);
    } else{
        $("#newPu").prop("checked", false);
    }
    
    $('#exampleModal').modal('show');
}

function desactivar(id, trt){
    
    alertify.confirm('Desactivar Tratamiento', '¿Seguro que deseas desactivar tratamiento <strong>"'+trt+'"</strong>?', function () {
            
        $.post(base_url + "Ctratamientos/desactivarTratamiento", {
            id: id
        }, function (data) {

        }).done(function (data) {
            console.log(data);
            if( data == "1"){
                limpiar();
                tabla.ajax.reload();
                alertify.success("Tratamiento desactivado correctamente");
            } else{
                alertify.error("Error en desactivar Tratamiento");
            }
        });

    }, function () {

    });
    
}

function activar(id, trt){
    
    alertify.confirm('Activar Tratamiento', '¿Seguro que deseas activar tratamiento <strong>"'+trt+'"</strong>?', function () {
            
        $.post(base_url + "Ctratamientos/activarTratamiento", {
            id: id
        }, function (data) {

        }).done(function (data) {
            console.log(data);
            if( data == "1"){
                limpiar();
                tabla.ajax.reload();
                alertify.success("Tratamiento activado correctamente");
            } else{
                alertify.error("Error en activar Tratamiento");
            }
        });

    }, function () {

    });
    
}

$("#btnCambiar").click(function(e){
    var id = $("#aId").val();
    var trt = $("#newTrt").val();
    var valor = $("#newValor").val();
    var pu = false;
    if($("#newPu").prop("checked")){
        pu = true;
    }
    
    $.post(base_url + "Ctratamientos/editarTratamiento", {
        trt: trt,
        valor: valor,
        pu: pu,
        id: id
    }, function (data) {

    }).done(function (data) {
        console.log(data);
        if(data == "A"){
            alertify.warning("Este Tratamiento <strong>'"+trt+"'</strong> ya se encuentra registrado");
        } else if(data == "1"){
            limpiar();
            tabla.ajax.reload();
            alertify.success("Tratamiento editado correctamente");
        } else {
            aletify.error("Error en editar tratamiento");
        }
    });
});




init();


