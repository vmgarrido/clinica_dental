$.ajaxSetup({
    async: false
});

function init() {
    limpiar();
    getEspecialidades();
    getTratamientos();
    getDentistas();
    getTresSemanas();
    cargarAgenda();
    getTipoPaciente();
    getIsapres();
}

function getTipoPaciente() {
    $.post(base_url + "Cadminpaciente/getTipoPaciente", function (data) {

    }).done(function (data) {
        $("#cbxTipoPaciente").html(data);
    });
}

$("#cbxTipoPaciente").change(function () {
    var id_tp = $(this).val();

    if (id_tp != 3) {
        $(".tdIsapre").hide();
    } else {
        $(".tdIsapre").show();

    }
});

function getIsapres() {
    $.post(base_url + "Cadminpaciente/getIsapres", {
        id_tp: 3
    }, function (data) {

    }).done(function (data) {
        $("#cbxIsapre").html(data);
    });

}

function limpiar() {
    $("input[type=text]").val("");
    $("#txtRut, #txtDv").prop("readonly", false);
    $("#chkSeleccionarBloque").prop("checked", false);
    $(".datosRegistrar").hide();
    $(".tdIsapre").hide();
    $("#btnRegistrar").prop("disabled",true);
    
    $(".des").prop("disabled", false);
    $(".libre").removeClass("pointer");
    $("#tablaAgenda tbody tr td").removeClass("success");
    limpiar_2();
    $("#btnConsultar").show();
}

function getTresSemanas() {
    $.post(base_url + "Ctiempo/getTresSemanas", function (data) {

    }).done(function (data) {
        $("#cbxSemana").html(data);
    });
}

function getEspecialidades() {
    $.post(base_url + "Cdentistas/getEspecialidades", function (data) {

    }).done(function (data) {
        $("#cbxEspecialidad").html(data);
    });
}

function getTratamientos() {

    var id_esp = $("#cbxEspecialidad").val();

    $.post(base_url + "Cdentistas/getTratamientos", {
        id_esp: id_esp
    }, function (data) {

    }).done(function (data) {
        $("#cbxTratamiento").html(data);
    });

    var val = $("#cbxTratamiento option:selected").attr("valor");
    var i = 0;
    var j = 0;
    var valu = "";

    for (j = val.length - 1; j >= 0; j--) {
        i++;
        if (i == 3) {
            valu = "." + val.charAt(j) + valu;
        } else {
            valu = val.charAt(j) + valu;
        }
    }

    $("#txtValorTratamiento").val('$ ' + valu);
    $("#txtValorTratamiento").attr("valor", val);
}



function getDentistas() {
    var id_esp = $("#cbxEspecialidad").val();
    console.log(id_esp);

    $.post(base_url + "Cdentistas/getDentistas", {
        id_esp: id_esp
    }, function (data) {

    }).done(function (data) {
        if (data != '') {
            $("#cbxDentista").html(data);
        } else {
            alert("no hay doctores")
        }
    });
}

function cargarAgenda() {
    var id_esp = $("#cbxEspecialidad").val();
    var id_dent = $("#cbxDentista").val();
    var semana = $("#cbxSemana").val();

    $.post(base_url + "Cregistraratencion/cargarAgenda", {
        id_esp: id_esp,
        id_dent: id_dent,
        semana: semana
    }, function (data) {

    }, 'json').done(function (data) {
        //console.log(data);

        if (data == "10") {
            alert("Este Dentista no tiene disponibilidad es resto de la semana");
        } else {
            $("#barraAgenda").html(data.head);
            $("#cuerpoAgenda").html(data.body);
            $("#jornada").val(data.jornada);
        }

    });
}

$("#cbxEspecialidad").change(function () {
    getTratamientos();
    getDentistas();
    getTresSemanas();
    cargarAgenda();
});

$("#cbxDentista").change(function () {
    getTresSemanas();
    cargarAgenda();
});

$("#cbxSemana").change(function () {
    cargarAgenda();
});

$("#cbxTratamiento").change(function () {
    var val = $("#cbxTratamiento option:selected").attr("valor");
    var i = 0;
    var j = 0;
    var valu = "";

    for (j = val.length - 1; j >= 0; j--) {
        i++;
        if (i == 3) {
            valu = "." + val.charAt(j) + valu;
        } else {
            valu = val.charAt(j) + valu;
        }
    }

    $("#txtValorTratamiento").val('$ ' + valu);
    $("#txtValorTratamiento").attr("valor", val);
});

// get datos paciente
$("#txtRut").keydown(function(){
    $("#mensajeRut").fadeOut("fast");
});

$("#txtDv").keydown(function(){
    $("#mensajeDv").fadeOut("fast");
});
$("#btnConsultar").click(function () {
    var rut = $("#txtRut").val();
    var dv = $("#txtDv").val();

    var rut_valido;

    $("#mensaje").hide();
    $(".errores").fadeOut("fast");
    if (rut == "") {
        $("#mensajeRut").fadeIn("slow");
        return false;
    } else if (dv == "") {
        $("#mensajeDv").fadeIn("slow");
        return false;
    }

    $.post(base_url + "Clogin/validarRut", {rut: rut, dv: dv}, function (data) {

    }).done(function (data) {
        rut_valido = data;
    });

    if(rut_valido == "0"){
        alertify.error("Este Rut es falso");
        return false;
    }

    $.post(base_url + "Cadminpaciente/getPaciente", {
            rut: rut,
            dv: dv
        },
        function (data) {

        }, 'json').done(function (data) {
        if (data == null) {
            alertify.error("Este Rut no se encuentra registrado");
        } else {
            if (data.activo_p == "f") {
                alertify.error("Este Paciente se encuentra inactivo");
            } else {
                mostrarDatos(data);
            }

        }


    });

});

function mostrarDatos(data) {

    $("#txtRut, #txtDv").prop("readonly", true);

    $("#txtNombrePaciente").val(data.nombre_p + ' ' + data.apellidop_p + ' ' + data.apellidom_p);

    $(".datosRegistrar").show();
    $("#btnConsultar").hide();
}

$("#btnCancelar").click(function () {
    init();
});

function limpiar_2(){
    $("#txtFechaAtención1, #txtBloque1").val("");
}

$("#chkSeleccionarBloque").change(function () {

    if ($(this).prop("checked")) {

        $(".libre").addClass("pointer");
        
        $(".des").prop("disabled", true);
        var a = $('td[columna="10"][fila="2"]').text();
        $("#btnRegistrar").prop("disabled",false);

    } else {
        $(".des").prop("disabled", false);
        $(".libre").removeClass("pointer");
        $("#tablaAgenda tbody tr td").removeClass("success");
        limpiar_2();
        $("#btnRegistrar").prop("disabled",true);
    }

});

$("#tablaAgenda").on("click", "td.pointer", function () {
    //Quitar color
    $("#tablaAgenda tbody tr td").removeClass("success");
    
    
    var col = $(this).attr("columna");
    var fila = $(this).attr("fila");

    
    var cBloques = $("#cbxCantidadBloques").val();

    //alert(col+" "+fila);

    var bloque_inicio;
    var bloque_fin;
    
    bloque_inicio = $('td[columna="' + col + ', 0"]').attr("hora_inicio");
    if (cBloques == "2") {
        var col2 = parseInt(col) + 1;
        //alert(col2+" "+fila);
        var estado = $('td[columna="' + col2 + '"][fila="' + fila + '"]').attr("estado");
        
        if (estado != "libre") {
            limpiar_2();
            alertify.error("El bloque siguiente no se encuentra disponible");
        } else {
            bloque_fin = $('td[columna="' + col2 + ', 0"]').attr("hora_fin");
            
            $('td[columna="' + col + '"][fila="' + fila + '"], td[columna="' + col2 + '"][fila="' + fila + '"]').addClass("success");
            
            var fecha_1 = $('td[columna="' + col + '"][fila="' + fila + '"]').attr("fecha");
            var fecha_texo = $('td[columna="' + col + '"][fila="' + fila + '"]').attr("fecha2");
            var id_dia = $('td[columna="' + col + '"][fila="' + fila + '"]').attr("id_dia");
            $("#txtFechaAtención1").val(fecha_texo);
            $("#txtFechaAtención1").attr("fecha", $(this).attr("fecha"));
            $("#txtFechaAtención1").attr("id_dia", id_dia);
            
            $("#txtFechaAtención1").attr("id_box", $(this).attr("id_box"));


            $("#txtBloque1").val(bloque_inicio+" - "+bloque_fin);
            $("#txtBloque1").attr("hora_inicio", bloque_inicio);
            $("#txtBloque1").attr("hora_fin", bloque_fin);
            
            $("#id_disp").val($(this).attr("id_disp"));
        }
    } else {
        bloque_fin = $('td[columna="' + col + ', 0"]').attr("hora_fin");
        
        var fecha_1 = $('td[columna="' + col + '"][fila="' + fila + '"]').attr("fecha");
        var fecha_texo = $('td[columna="' + col + '"][fila="' + fila + '"]').attr("fecha2");
        var id_dia = $('td[columna="' + col + '"][fila="' + fila + '"]').attr("id_dia");
        $("#txtFechaAtención1").val(fecha_texo);
        $("#txtFechaAtención1").attr("fecha", $(this).attr("fecha"));
        $("#txtFechaAtención1").attr("fecha", fecha_1);
        $("#txtFechaAtención1").attr("id_dia", id_dia);
        
        $("#txtFechaAtención1").attr("id_box", $(this).attr("id_box"));

        $("#txtBloque1").val(bloque_inicio+" - "+bloque_fin);
        $("#txtBloque1").attr("hora_inicio", bloque_inicio);
        $("#txtBloque1").attr("hora_fin", bloque_fin);
        
        $("#id_disp").val($(this).attr("id_disp"));
        
        $(this).addClass("success");
    }

});

$("#btnRegistrar").click(function(){
    
    var rut_p = $("#txtRut").val();
    var id_esp = $("#cbxEspecialidad").val();
    var id_dent = $("#cbxDentista").val();
    var tratamiento = $("#cbxTratamiento").val();
    var valor = $("#txtValorTratamiento").attr("valor");
    var fecha = $("#txtFechaAtención1").attr("fecha");
    var id_dia = $("#txtFechaAtención1").attr("id_dia");
    var id_box = $("#txtFechaAtención1").attr("id_box");
    var hora_inicio = $("#txtBloque1").attr("hora_inicio");
    var hora_fin = $("#txtBloque1").attr("hora_fin");
    var tipo_paciente = $("#cbxTipoPaciente").val();
    var isapre = $("#cbxIsapre").val();
    var jornada = $("#jornada").val();
    var id_disp = $("#id_disp").val();
    
    if($("#txtFechaAtención1").val=="" || $("#txtBloque1").val()==""){
        alertify.warning("Seleccione una hora de atención");
    } else {
        
        var paciente = $("#txtNombrePaciente").val();
        var fecha_1 = $("#txtFechaAtención1").val();
        var bloque = $("#txtBloque1").val();
        var dentista = $("#cbxDentista option:selected").text();

        var mensaje = '<strong>Paciente: </strong>'+paciente+'<br>';
        mensaje += '<strong>Dentista: </strong>'+dentista+'<br>';
        mensaje += '<strong>Fecha: </strong>'+fecha_1+'<br>';
        mensaje += '<strong>Bloque: </strong>'+bloque;

        alertify.confirm('Registrar atención', mensaje, function () {
            $.post(base_url + "Cregistraratencion/setAgenda", {
                    rut_p: rut_p,
                    id_especialidad: id_esp,
                    id_dent: id_dent, 
                    id_trt: tratamiento, 
                    valor_trt: valor, 
                    fecha: fecha, 
                    id_dia: id_dia, 
                    id_box: id_box, 
                    hora_inicio: hora_inicio,
                    hora_fin: hora_fin, 
                    id_tp: tipo_paciente, 
                    id_isapre: isapre, 
                    id_horario: jornada, 
                    id_disp: id_disp
                },
                function (data) {

                }).done(function (data) {
                console.log(data);
                if (data == null) {
                    alertify.error("Error en registrar atencion");
                } else if( data == "1"){
                    init();
                    alertify.success("Atencion registrada");
                } else {
                    alertify.error("Error en registrar atencion");
                }


            });
        }, function () {

        });
    }
    
    
});

init();
