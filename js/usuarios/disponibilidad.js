$.ajaxSetup({
    async: false
});

var flag = false;
function init(){
    flag = false;
    limpiar();
    getHorarios();
    getDias();
    getDisponibilidad();
    getBloque1();
    getBloque2();
    getBox();
    $("#btnConsultarDentista").prop("disabled", false);
    $("#btnDesactivar, #btnLimpiar, #btnRegistrarHorario, #btnNuevaHorario").prop("disabled", true);
}

function limpiar() {
    $("input[type=text]").val("");
    $("#txtRut, #txtDv").prop("readonly", false);
    $("#listaHorario").html("");
}

function getBox(){
    $.post(base_url + "Cdisponibilidad/getBox", function (data) {

    }).done(function (data) {
        $("#cbxBox").html(data);
    });
}

function getHorarios(){
    $.post(base_url + "Ctiempo/getHorarios", function (data) {

    }).done(function (data) {
        console.log(data);
        $("#cbxHorario").html(data);
        $("#cbxJornada").html(data);
    });
}

function getDias(){
    
    var jornada = $("#cbxHorario").val();
    
    $.post(base_url + "Ctiempo/getDiasActivos", {jornada: jornada}, function (data) {

    }).done(function (data) {
        $("#cbxDia").html(data);
        $("#cbxDiasNuevo").html(data);
    });
}

$("#cbxHorario").change(function(){
    
    $("#cbxJornada").val($(this).val());
    getDias();
    changeDias();
    getBloque1();
    getBloque2();
    getLista();
});

$("#cbxJornada").change(function(){
    
    $("#cbxHorario").val($(this).val());
    getDias();
    changeDias();
    getBloque1();
    getBloque2();
    getLista();
});

function changeDias(){
    var rut = $("#txtRut").val();
    var dv = $("#txtDv").val();
    
    if (rut.length > 0 && dv.length > 0){
        getDispponibilidadDent(rut, dv);
    } else {
        getDisponibilidad();
    }
}

function getBloque1(){
    var jornada = $("#cbxJornada").val();
    var dia = $("#cbxDiasNuevo").val();
    
    $.post(base_url + "Ctiempo/getBloques1", {jornada: jornada, dia: dia}, function (data) {

    }).done(function (data) {
        $("#txtBloqueInicio").html(data);
    });
}

function getBloque2(){
    var jornada = $("#cbxJornada").val();
    var dia = $("#cbxDiasNuevo").val();
    var hi = $("#txtBloqueInicio").val();
    
    $.post(base_url + "Ctiempo/getBloques2", {jornada: jornada, dia: dia, hi: hi}, function (data) {

    }).done(function (data) {
        $("#cbxBloqueFin").html(data);
    });
}

$("#cbxDia").change(function(){
    $("#cbxDiasNuevo").val($(this).val());
    changeDias();
    getBloque1();
    getBloque2();
});

$("#cbxDiasNuevo").change(function(){
    $("#cbxDia").val($(this).val());
    changeDias();
    getBloque1();
    getBloque2();
});

$("#txtBloqueInicio").change(function(){
    getBloque2();
});

function getDisponibilidad(){
    
    var jornada = $("#cbxHorario").val();
    var id_dia = $("#cbxDia").val();
    
    $.post(base_url + "Cdisponibilidad/getDisponibilidad", {
        id_dia: id_dia,
        jornada: jornada
    }, function (data) {

    }, 'json').done(function (data) {
        $("#barraDisp").html(data.head);
        $("#filasDisp").html(data.body);
    });
    
}

$("#txtRut").keydown(function () {
    $("#mensajeRut").fadeOut("fast");
});

$("#txtDv").keydown(function () {
    $("#mensajeDv").fadeOut("fast");
});

function getDispponibilidadDent(rut, dv){
    var id_dia = $("#cbxDia").val();
    var rut_c = rut+' - '+dv;
    var jornada = $("#cbxHorario").val();
    
    $.post(base_url + "Cdisponibilidad/getDisponibilidadDent", {
        id_dia: id_dia,
        rut_c: rut_c,
        jornada: jornada
    }, function (data) {

    }, 'json').done(function (data) {
        $("#barraDisp").html(data.head);
        $("#filasDisp").html(data.body);
    });
}



$("#btnConsultarDentista").click(function(){
    
    
    var rut = $("#txtRut").val();
    var dv = $("#txtDv").val();
    var jornada = $("#cbxHorario").val();
    
    $(".errores").fadeOut("fast");
    if (rut == "") {
        $("#mensajeRut").fadeIn("slow");
    } else if (dv == "") {
        $("#mensajeDv").fadeIn("slow");
    } else {
        
        var rut_valido;

        $.post(base_url + "Clogin/validarRut", {rut: rut, dv: dv}, function (data) {

        }).done(function (data) {
            rut_valido = data;
        });

        if(rut_valido == "0"){
            alertify.error("Este Rut es falso");
            return false;
        }
        
        $.post(base_url + "Cdisponibilidad/getDentista", {
            rut: rut,
            dv: dv
        }, function (data) {

        }, 'json').done(function (data) {
            if(data == null){
                alertify.error('Este Rut se encuentra registrado');
            } else {
                if(data.activo_u == "f"){
                    alertify.error('Este Rut se encuentra inactivo');
                } else if (data.activo_dent == "f"){
                    alertify.error('Este Rut no pertenece a un dentista');
                } else {
                    $("#txtRut, #txtDv").prop("readonly", true);
                    $("#btnConsultarDentista").prop("disabled", true);
                    $("#btnDesactivar, #btnLimpiar, #btnRegistrarHorario, #btnNuevaHorario").prop("disabled", false);
                    getDispponibilidadDent(rut, dv);
                    
                    $("#txtNombre").val(data.nombre);
                    $("#txtEspecialidad").val(data.nombre_esp);
                    $("#id_dent").val(data.id_dent);
                    $("#id_esp").val(data.id_especialidad);
                    flag = true;
                }
            }
        });
        
        
        getLista();
        
    }
});

function getLista(){
    var rut = $("#txtRut").val();
    var dv = $("#txtDv").val();
    var jornada = $("#cbxHorario").val();
    
    if (flag && rut.length>0 && dv.length>0){

        $.post(base_url + "Cdisponibilidad/getListaHorario", {
            rut: rut,
            dv: dv,
            jornada: jornada
        }, function (data) {

        }).done(function (data) {
            $("#listaHorario").html(data);
        });

    }
    
}

$("#btnNuevaHorario").click(function(){
    init();
})

// registrar nuevo horario

$("#btnRegistrarHorario").click(function(){
    
    var rut = $("#txtRut").val();
    var dv = $("#txtDv").val();
    var jornada = $("#cbxHorario").val();
    
    var formData = new FormData($("#formDisp")[0]);
    
    alertify.confirm('Registrar Disponibilidad', '¿Seguro que desea registrar esta disponibilidad?', function () {
            
        $.ajax({
            url: base_url + "Cdisponibilidad/setRegistrar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (datos) {
                console.log(datos);
                if (datos == "A") {
                    alertify.error('Esta disponibilidad está en conflicto con otra ya registrada');
                } else if (datos == "B"){
                    alertify.error('Este dentista ya trabaja en este dia');
                } else if (datos == "0"){
                    alertify.error('Error. No se ha logrado registrar esta disponibilidad');
                } else if (datos == "1") {
                    getDispponibilidadDent(rut,dv);
                    getLista();
                    alertify.success('Disponibilidad registrada correctamente');
                }
            }

        });

    }, function () {

    });
    
});

$("#tablaHorario").on("click", ".rmv", function() {
    var me = $(this);
    var dia = me.parents("tr").find("td").eq(0).html();
    var bloques = me.parents("tr").find("td").eq(1).html()+" - "+me.parents("tr").find("td").eq(2).html();
    var box = me.parents("tr").find("td").eq(3).html();

    var id = me.attr("d_id");

    var msg = 'Dia: <strong>'+dia+'</strong><br>';
    msg += 'Bloques <strong>'+bloques+'</strong><br>';
    msg += '<strong>'+box+'</strong><br>';
    msg += 'Realizando esta acción <strong>No habrá marcha atrás.</strong>'

    alertify.confirm('Confirmación. Desactivar disponibilidad', msg, function () {
        
        $.post(base_url + "Cdisponibilidad/removeDisponibilidad", {
                id: id
            },
            function (data) {

            }).done(function (data) {
            console.log(data);
            if (data == "A") {
                getLista();
                changeDias();
                alertify.success("Disponibilidad desactivada");
            } else {
                alertify.error("Error en desactivar disponibilidad");
            }


        });
        
    }, function () {

    });
});

init();