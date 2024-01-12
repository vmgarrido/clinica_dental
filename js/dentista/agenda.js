$.ajaxSetup({
    async: false
});

var id_agenda = 0;
var id_historial = 0;
var rut_p = "";
var flagConfirm = false;

var finalTrt = null;
var finalPieza = null;
var finalNumero = null;
function init(){
    $("input[type=text], #txtDiagnostico").val("");
    $("input[type=radio][name=radioPaciente]").prop("disabled", false);
    $("#txtFecha").prop("disabled", false);
    $("#bodyAg, #body-trt-no-realizados, #body-historial, #body-tratamientos-realizados").html("");
    $("#btnConsultar").show();
    $("#btnNuevo, #btnFinalizar, #btnConfirmar, #btnRegistrar, #btnVerDatos, #btnListo, #btnRemover, #btnGuardar").hide();
    $("#txtDiagnostico").prop("readonly", true);
    getTratamientos();
    piezaUnica();
    getPiezas();
    flagConfirm = false;


    finalTrt = null;
    finalPieza = null;
    finalNumero = null;

}

function getHistorial(rut){
    $.post(base_url + "Cdentista/getHistorial", {
        rut_p: rut
    }, function (data) {

    }).done(function (data) {
        $("#body-historial").html(data);
    });
}

function getTratamientos(){
    $.post(base_url + "Cdentista/listarTratamientos", {
        id_esp: id_especialidad
    }, function (data) {

	}).done(function (data) {
        $("#cbxTratamiento").html(data);
	});
}

function getPiezas(){
    $.post(base_url + "Cdentista/listarPiezas", function (data) {

	}).done(function (data) {
        $("#cbxPieza").html(data);
	});
}

function piezaUnica(){
    var pu = $("#cbxTratamiento option:selected").attr("unica");
    if(pu == "si"){
        $("#cbxPieza").prop("disabled", false);
    } else{
        $("#cbxPieza").prop("disabled", true);
    }
}

$("#cbxTratamiento").change(function(){
    piezaUnica();
});

function consulta(){
    $("#txtFecha").prop("disabled", true);
    $("#btnConsultar").hide();
    $("#btnNuevo, .btnVer").show();
}

$("#btnNuevo").click(function(){
    location.reload();
});

$("#btnConsultar").click(function(){
    var fecha = $("#txtFecha").val();

    /*
    var resp;

    $.post(base_url + "Cdentista/fechaSuperior", {fecha: fecha}, function (data) {

	}).done(function (data) {
		resp = data;
    });
    
    if(resp == "0"){
        alertify.warning("La fecha no debe ser anterior al día de hoy");
        return false;
    }
    */

    $.post(base_url + "Cdentista/getAgenda", {id_dent: id_dent, fecha: fecha}, function (data) {

	}).done(function (data) {
        consulta();
		$("#bodyAg").html(data);
	});
});

var id_agenda = 0;
var pnombre = "";
var ptrt = "";
function verDatos(id, nombre, trt){
    $("#btnConfirmar").show();
    id_agenda = id;
    pnombre = nombre;
    ptrt = trt;

    $.post(base_url + "Cdentista/getPaciente", {id_agenda: id_agenda}, function (data) {

	}, 'json').done(function (data) {
        rut_p = data.rut_p;
        $("#txtRut").val(data.rut_p);
        $("#txtDv").val(data.dv_p);
        $("#txtNombre").val(data.nombre);
        $("#txtDiagnostico").val(data.diagnostico);
        getHistorial(data.rut_p);
        reloadTrSinRealizar();
	});
}

$("#btnConfirmar").click(function(){

    var msg = 'Nombre: <strong>'+pnombre+'</strong><br>';
    msg += 'Tratamiento: <strong>'+ptrt+'</strong>';

    var row = '';

    var id_tsn = null;
    var id_trz = null;

    alertify.confirm('Confirmar atención', msg, function (){
        $("#btnConfirmar").hide();
        $("#btnVerDatos, #btnNuevo").hide();
        $("input[type=radio][name=radioPaciente]").prop("disabled", true);
        $("#btnFinalizar, #btnRegistrar, #btnGuardar").show();

        $.post(base_url + "Cdentista/registrarHistorial", {
            id_agenda: id_agenda,
            id_dent: id_dent,
            rut_p: rut_p,
            id_especialidad: id_especialidad
        }, function (data) {

        }, 'json').done(function (data) {
            id_historial = data.id_hc;

            finalTrt = data.trt;
            finalPieza = data.nom_pieza;
            finalNumero = data.num_pieza;
            id_tsn = data.id_tsn;
            id_trz = data.id_trz;

            $("#txtDiagnostico").prop("readonly", false);
            $(".btnVer").hide();
        });
        
        flagConfirm = true;
        if(finalTrt == null){
            $(".realizar").show();
        } else{
            row += '<tr>';
            row += '<td class="col1">'+finalTrt+'</td>';
            row += '<td class="col2">'+finalPieza+'</td>';
            row += '<td class="col3">'+finalNumero+'</td>';
            row += '<td class="col4"><button type="button" id_tsn="'+id_tsn+'" id_trz="'+id_trz+'" class="btn btn-danger btn2 realizado"><i class="fa fa-times"></i></button></td>';
            row += '</tr>';

            $("#body-tratamientos-realizados").append(row);
        }

    }, function () {

    });
});

$("#btnGuardar").click(function(){

    var diagnostico = $("#txtDiagnostico").val();

    if(diagnostico == ""){
        alertify.warning("Debe ingresar un diagnóstico");
        return false;
    }

    alertify.confirm('Registrar Diagbóstico', '¿Seguro que desea registrar este diagóstico?', function (){
        $.post(base_url + "Cdentista/registrarDiagnostico", {
            id_hc: id_historial,
            diagnostico: diagnostico
        }, function (data) {

        }).done(function (data) {
            if(data == "1"){
                alertify.success("Diagnóstico registrado");
            } else{
                alertify.error("Error en registrar diagnóstico");
            }
        });
    }, function () {

    });
});

$("#btnRegistrar").click(function(){
    var id_trt = $("#cbxTratamiento option:selected").val();
    var nom_trt = $("#cbxTratamiento option:selected").text();

    var nombre = "", numero = "";
    if($("#cbxPieza").prop("disabled") == false){
        nombre = $("#cbxPieza option:selected").attr("nombre");
        numero = $("#cbxPieza option:selected").attr("numero");
    }

    var fila = '';
    $.post(base_url + "Cdentista/setTrtSinRealizar", {
        id_dent: id_dent,
        rut_p: rut_p,
        id_trt: id_trt,
        nombre_pieza_d: nombre,
        num_pieza_d: numero
    }, function (data) {

    }).done(function (data) {
        if(data > 0){
            fila += '<tr>';
            fila += '<td class="colTr">'+nom_trt+'</td>';
            fila += '<td class="colTr">'+nombre+'</td>';
            fila += '<td class="colTr">'+numero+'</td>';
            fila += '<td class="colTr"><button type="button" class="btn btn-danger btn2 rmv" id_tsn="'+data+'"><i class="fa fa-times "></i></button></td>';
            fila += "</tr>";
            $("#body-lista-trt").append(fila);
            alertify.success("Tratamiento registrado");
            $("#btnListo").show();
        } else{
            alertify.error("Error en registrar tratamiento");
        }
    });

    
});

$(document).on('click', '.rmv', function () {
    var id_tsn = $(this).attr("id_tsn");
    var fila = $(this);
    
    $.post(base_url + "Cdentista/borrarTratamiento", {
        id_tsn: id_tsn
    }, function (data) {

    }).done(function (data) {
        if(data == "1"){
            fila.closest('tr').remove();
            alertify.warning("Tratamiento eliminado");
        } else{
            alertify.error("Error en eliminar tratamiento");
        }
    });
});

function reloadTrSinRealizar(){

    $.post(base_url + "Cdentista/getTrtSinRealizar", {
        rut_p: rut_p
    }, function (data) {

    }).done(function (data) {
        $("#body-trt-no-realizados").html(data);
    });

    console.log(finalTrt+" final trt");
    if(flagConfirm == false || finalTrt != null){
        $(".realizar").hide();
    } else{
        $(".realizar").show();
    }

}

function reloadTrRealizados(){

    $.post(base_url + "Cdentista/getTrtSinRealizar", {
        rut_p: rut_p
    }, function (data) {

    }).done(function (data) {
        $("#body-trt-no-realizados").html(data);
    });

    if(flagConfirm == false || finalTrt != null){
        $(".realizar").hide();
    }

}

$("#btnListo").click(function(){
    

    alertify.confirm('Confirmar', '¿Está seguro de fijar estos tratamientos?<br>Después no podrán ser eliminados', function (){
        $("#body-lista-trt").html("");
        $("#btnListo").hide();
        reloadTrSinRealizar();
    }, function () {

    });

});

// Realizar Tratamiento
$(document).on('click', '.realizar', function () {
    var id_tsn = $(this).attr("tsn");
    var trt = $(this).attr("trt");
    var id_trt = $(this).attr("id_trt");
    var pieza = $(this).attr("pieza");
    var numero = $(this).attr("numero");

    var fila = $(this);

    var msg = 'Tratamiento: <strong>'+trt+'</strong>';
    if(pieza != ""){
        msg += '<br>Pieza: <strong>'+pieza+' '+numero+'</strong>';
    }

    var row = '';
    alertify.confirm('Registrar Tratamiento', msg, function (){

        $.post(base_url + "Cdentista/realizarTratamiento", {
            id_dent: id_dent,
            rut_p: rut_p,
            id_tsn: id_tsn,
            id_trt: id_trt,
            nombre_pieza_d: pieza,
            num_pieza_d: numero,
            id_hc: id_historial
        }, function (data) {
    
        }).done(function (data) {
            
            if(data > 0){
                fila.closest('tr').remove();

                row += '<tr>';
                row += '<td class="col1">'+trt+'</td>';
                row += '<td class="col2">'+pieza+'</td>';
                row += '<td class="col3">'+numero+'</td>';
                row += '<td class="col4"><button type="button" id_tsn="'+id_tsn+'" id_trz="'+data+'" class="btn btn-danger btn2 realizado"><i class="fa fa-times"></i></button></td>';
                row += '</tr>';

                $("#body-tratamientos-realizados").append(row);

                alertify.warning("Tratamiento realizado");
                flagConfirm = false;
                $(".realizar").hide();
            } else{
                alertify.error("Error en realizar tratamiento");
            }
            
        });

    }, function () {

    });
});


$(document).on('click', '.realizado', function () {
    var me = $(this);
    var id_tsn = me.attr("id_tsn");
    var id_trz = me.attr("id_trz");

    alertify.confirm('Remover Tratamiento. Confirmación', '', function (){

        $.post(base_url + "Cdentista/removerTrtRealizado", {
            id_hc: id_historial,
            id_tsn: id_tsn,
            id_trz: id_trz
        }, function (data) {
    
        }).done(function (data) {
            
            if(data > 0){
                me.closest('tr').remove();

                //$("#body-tratamientos-realizados").append(row);
                flagConfirm = true;
                finalTrt = null;
                reloadTrSinRealizar();
            } else{
                alertify.error("Error en remover tratamiento");
            }
            
        });

    }, function () {

    });
});

$("#btnFinalizar").click(function(){

    alertify.confirm('Confirmar, Finalizar atención', 'Realizada esta acción, no se podrá revertir.', function (){
        $.post(base_url + "Cdentista/finalizarAtencion", {
            id_agenda: id_agenda
        }, function (data) {

        }).done(function (data) {
            
            if(data == "1"){
                init();
                alertify.success("Atención finalizada correctamente");
            } else{
                alertify.error("Error en finalizar atención");
            }
            
        });
    }, function () {

    });

});

function verDiagnostico(id){
    $.post(base_url + "Cdentista/getDiagnostico", {
        id: id
    }, function (data) {

    }, 'json').done(function (data) {
        
        $("#m-title").text("Diagnóstico "+data.fecha);
        $("#m-body").text(data.diagnostico);
        $('#myModal').modal('show');
        
    });
    
}

init();

