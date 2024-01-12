$.ajaxSetup({
    async: false
});

function init() {
    $("input[type=text], input[type=time]").val("");
    $("#horario-nuevo, #td-opcion").html("");
    listHorario();
    listHorarioNuevo();
}

function listHorario(){

    $.ajax({
        url: base_url + "Chorarios/getHorarioActual",
        type: "POST",
        contentType: false,
        processData: false,
        async: false,

        success: function (datos) {
            datos = JSON.parse(datos);
            
            $("#txtFechaHorarioActual1").val(datos.fecha_inicio);
            $("#txtFechaHorarioActual2").val(datos.fecha_fin);
            $("#txtMinutosBloqueActual").val(datos.duracion);
            $("#txtMinInicio").val(datos.hora_inicio);
            $("#txtMaxFin").val(datos.hora_fin);
            $("#listHorario").html(datos.body);
        }

    });
}

function listHorarioNuevo(){

    $.ajax({
        url: base_url + "Chorarios/getHorarioNuevo",
        type: "POST",
        contentType: false,
        processData: false,
        async: false,
        dataType: 'json',

        success: function (datos) {
            if(datos == null){
                $("#td-opcion").html("");
            } else {
                $("#td-opcion").html('<button type="button" class="btn btn-danger" onclick="desactivarHorario('+datos.id_horario+');">Desactivar horario</button>');
                $("#nuevo-fecha-inicio").val(datos.fecha_inicio);
                $("#minutos-nuevo").val(datos.duracion);
                $("#hora-inicio-nuevo").val(datos.hora_inicio);
                $("#hora-inicio-fin").val(datos.hora_fin);
                $("#horario-nuevo").html(datos.body);
            }
        }

    });

}

// condiciones checkbox

$("#chkLunes").change(function () {
    if ($(this).prop('checked')) {
        $("#txtLunesVal").val("1");
        $(".txtLunes").prop("readonly", false);
    } else {
        $("#txtLunesVal").val("0");
        $(".txtLunes").val("");
        $(".txtLunes").prop("readonly", true);
    }
});

$("#chkMartes").change(function () {
    if ($(this).prop('checked')) {
        $("#txtMartesVal").val("1");
        $(".txtMartes").prop("readonly", false);
    } else {
        $("#txtMartesVal").val("0");
        $(".txtMartes").val("");
        $(".txtMartes").prop("readonly", true);
    }
});

$("#chkMiercoles").change(function () {
    if ($(this).prop('checked')) {
        $("#txtMiercolesVal").val("1");
        $(".txtMiercoles").prop("readonly", false);
    } else {
        $("#txtMiercolesVal").val("0");
        $(".txtMiercoles").val("");
        $(".txtMiercoles").prop("readonly", true);
    }
});

$("#chkJueves").change(function () {
    if ($(this).prop('checked')) {
        $("#txtJuevesVal").val("1");
        $(".txtJueves").prop("readonly", false);
    } else {
        $("#txtJuevesVal").val("0");
        $(".txtJueves").val("");
        $(".txtJueves").prop("readonly", true);
    }
});

$("#chkViernes").change(function () {
    if ($(this).prop('checked')) {
        $("#txtViernesVal").val("1");
        $(".txtViernes").prop("readonly", false);
    } else {
        $("#txtViernesVal").val("0");
        $(".txtViernes").val("");
        $(".txtViernes").prop("readonly", true);
    }
});

$("#chkSabado").change(function () {
    if ($(this).prop('checked')) {
        $("#txtSabadoVal").val("1");
        $(".txtSabado").prop("readonly", false);
    } else {
        $("#txtSabadoVal").val("0");
        $(".txtSabado").val("");
        $(".txtSabado").prop("readonly", true);
    }
});

// fin condiciones checkbox

// inicio validaciones campos

$("#txtFechaHorarioNuevo").click(function () {
    $("#mensajeFecha").fadeOut("fast");
});

$("#txtMinutosBloque").keydown(function () {
    $("#mensajeBloque").fadeOut("fast");
});

$("#txt-hora-inicio").click(function () {
    $("#mensaje-hinicio").fadeOut("fast");
});

$("#txt-hora-fin").keydown(function () {
    $("#mensaje-hfin").fadeOut("fast");
});

// fin validaciones campos

function eval_minutos(minutos){
    var eval_5 = minutos % 5;
    var eval_60 = 60 % minutos;

    if(eval_5 == 0 && eval_60 == 0 && minutos > 0){
        return true;
    } else{
        return false;
    }
}

function foco_ini(i){
    var tx = $("input[ini="+i+"]");
    
    setTimeout(function() {
      $(tx).focus();
      $(tx).select();
    }, 10);
}

function foco_fin(i){
    var tx = $("input[fin="+i+"]");
    
    setTimeout(function() {
      $(tx).focus();
      $(tx).select();
    }, 10);
}

$("#btnRegistrar").click(function () {

    var fecha = $("#txtFechaHorarioNuevo").val();
    var flag = "ok";
    var bloques = $("#txtMinutosBloque").val();
    var h_inicio = $("#txt-hora-inicio").val();
    var h_fin = $("#txt-hora-fin").val();

    var stt = new Date("November 13, 2013 " + h_inicio);
    var ett = new Date("November 13, 2013 " + h_fin);
    var h_inicio2 = stt.getTime();
    var h_fin2 = ett.getTime();

    var cont = 0;
    if ($("#chkLunes").prop("checked")) {
        cont++;
    }
    if ($("#chkMartes").prop("checked")) {
        cont++;
    }
    if ($("#chkMiercoles").prop("checked")) {
        cont++;
    }
    if ($("#chkJueves").prop("checked")) {
        cont++;
    }
    if ($("#chkViernes").prop("checked")) {
        cont++;
    }
    if ($("#chkSabado").prop("checked")) {
        cont++;
    }

    $(".errores").fadeOut("fast");
    if (fecha.length == 0) {
        $("#mensajeFecha").fadeIn("slow");
        return false;
    } else if (bloques.length == 0) {
        $("#mensajeBloque").fadeIn("slow");
        return false;
    } else if(!eval_minutos(bloques)){
        alertify.warning("Los minutos deben ser positivos, multiplos de 5 y divisor de 60");
        return false;
    } else if(h_inicio.length == 0){
        $("#mensaje-hinicio").fadeIn("slow");
        return false;
    } else if(h_fin.length == 0){
        $("#mensaje-hfin").fadeIn("slow");
        return false;
    } else if(h_inicio2 >= h_fin2){
        alertify.warning("La hora fin fin debe ser superior a la actual");
        return false;
    } else if (cont == 0) {
        alertify.error('Debe activar al menos un día');
        return false;
    }

    for(var i = 1; i<=5; i++){
        if($("input[dia="+i+"]").prop("checked")){
            var ini = $("input[ini="+i+"]").val();
            if(ini.length == 0){
                alertify.warning("Ingrese Hora inicio");
                foco_ini(i);
                return false;
            }
            var stt = new Date("November 13, 2013 " + ini);
            ini = stt.getTime();

            var fin = $("input[fin="+i+"]").val();
            if(fin.length == 0){
                alertify.warning("Ingrese Hora fin");
                foco_fin(i);
                return false;
            }
            var ett = new Date("November 13, 2013 " + fin);
            fin = ett.getTime();

            if(ini < h_inicio2){
                alertify.warning("Hora inicio menor a permitida");
                foco_ini(i);
                return false;
            } else if(ini >= h_fin2){
                alertify.warning("Hora inicio superior a permitida");
                foco_ini(i);
                return false;
            } else if(fin > h_fin2){
                alertify.warning("Hora fin superior a permitida");
                foco_fin(i);
                return false;
            } else if(fin <= h_inicio2){
                alertify.warning("Hora fin menor a permitida");
                foco_fin(i);
                return false;
            } else if(ini >= fin){
                alertify.warning("Hora inicio mayor o igual a Hora fin");
                foco_ini(i);
                return false;
            }

        }
    }
    // Evaluar minutos bloque


    $.post(base_url + "Chorarios/evaluarFecha", {
        fecha: fecha
    }, function (data) {

    }).done(function (data) {
        flag = data;
    });


    var eval_horario = 0;
    $.post(base_url + "Chorarios/evalHorario", function (data) {

    }).done(function (data) {
        evalHorario = data;
    });

    var formData = new FormData($("#formHorario")[0]);


    if(evalHorario > 0){
        alertify.error("Ya existe una jornada superior a la actual");
        return false;
    } else if(flag == "No Lunes"){
        alertify.error('La fecha ingresada no corresponde a un Lunes');
        return false;
    } else if (flag == "pasado") {
        alertify.error('La fecha ingresada debe ser superior al día de hoy');
        return false;
    }



    alertify.confirm('Registrar Horario nuevo', '¿Seguro que desea registrar este nuevo horario de trabajo?', function () {

        $.ajax({
            url: base_url + "Chorarios/registrarHorario",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (datos) {
                if(datos == 1){
                    init();
                    alertify.success('Horario registrado con exito');
                } else {
                    alertify.error('Error en registrar nuevo horario');
                }
            }

        });

    }, function () {

    });

    
    
});

function desactivarDia(dia, id_horario, id_dia){
    
    alertify.confirm('Desactivar día', '¿Seguro que desea desactivar día "<strong>'+dia+'</strong>"?', function () {
        $.post(base_url + "Chorarios/desactivarDia", {
            id_dia: id_dia,
            id_horario: id_horario
        }, function (data) {

        }).done(function (data) {
            if(data == "1"){
                init();
                alertify.success("Día "+dia+" desactivado correctamente.");
            } else {
                alertify.error("Error en desactivar día "+dia);
            }
        });
    
    }, function () {

    });

}

function activarDia(dia, id_horario, id_dia){
    
    alertify.confirm('Activar día', '¿Seguro que desea Activar día "<strong>'+dia+'</strong>"?', function () {
        $.post(base_url + "Chorarios/activarDia", {
            id_dia: id_dia,
            id_horario: id_horario
        }, function (data) {

        }).done(function (data) {
            if(data == "1"){
                init();
                alertify.success("Día "+dia+" activado correctamente.");
            } else {
                alertify.error("Error en activar día "+dia);
            }
        });
    
    }, function () {

    });

}

function desactivarHorario(id){
    alertify.confirm('Confirmar, Desactivar horario', 'Al realizar esta operación no podrá ser revertida', function () {
        $.post(base_url + "Chorarios/desactivarHorarioNuevo", {
            id: id
        }, function (data) {

        }).done(function (data) {
            if(data == "1"){
                init();
                alertify.success("Horario desactivado.");
            } else {
                alertify.error("Error en activar horario");
            }
        });
    
    }, function () {

    });
}

init();
