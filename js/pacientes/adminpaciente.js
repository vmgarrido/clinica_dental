

$.ajaxSetup({
    async: false
});

function init() {
    limpiar();
    $(".form-control, .btn").prop("disabled", true);
    $(".btnAccion").prop("disabled", false).hide();
    $("#txtRut, #txtDv, #btnConsultar, .op, .opc").prop("disabled", false);
    getRegiones();
    getComunas();
    getTipoPaciente();
    getIsapres();
}

function limpiar() {
    $("input[type=text]").val("");
    $("input[type=text]").prop("readonly", false);
    $("#trIsapre").hide();
    $(".desc").hide();
}

function getRegiones() {
    $.post(base_url + "Cubicacion/getRegiones", function (data) {

    }).done(function (data) {
        $("#cbxRegion").html(data);
    });
}

function getComunas() {
    var id_region = $("#cbxRegion").val();
    $.post(base_url + "Cubicacion/getComunas", {
        id_region: id_region
    }, function (data2) {

    }).done(function (data2) {
        $("#cbxComuna").html(data2);
    });
}

function getTipoPaciente() {
    $.post(base_url + "Cadminpaciente/getTipoPaciente", function (data) {

    }).done(function (data) {
        $("#cbxPrevision").html(data);
    });
}

function getIsapres() {
    $.post(base_url + "Cadminpaciente/getIsapres", {
        id_tp: 3
    }, function (data) {

    }).done(function (data) {
        $("#cbxIsapre").html(data);
    });

}

$("#cbxRegion").change(function () {
    getComunas();
});

$("#cbxPrevision").change(function () {
    var id_tp = $("#cbxPrevision").val();

    if (id_tp != 3) {
        $("#trIsapre").hide();
    } else {
        $("#trIsapre").show();

    }
});
// fin cargar cbx

// desaparecer mensajes de error

$("#txtRut").keydown(function () {
    $("#mensajeRut").fadeOut("fast");
});

$("#txtDv").keydown(function () {
    $("#mensajeDv").fadeOut("fast");
});

$("#txtNombre").keydown(function () {
    $("#mensajeNombre").fadeOut("fast");
});

$("#txtApellidoP").keydown(function () {
    $("#mensajeApellidoP").fadeOut("fast");
});

$("#txtApellidoM").keydown(function () {
    $("#mensajeAéllidoM").fadeOut("fast");
});

$("#txtFechaNac").click(function () {
    $("#mensajeFechaNac").fadeOut("fast");
});

$("#txtCalle").keydown(function () {
    $("#mensajeCalle").fadeOut("fast");
});

$("#txtDomicilio").keydown(function () {
    $("#mensajeNumeroDomicilio").fadeOut("fast");
});

$("#txtTelefono").keydown(function () {
    $("#mensajeTelefono").fadeOut("fast");
});


// habilitar e inhabilitar campos

function habRegistro() {
    $(".form-control").prop("disabled", false);
}

var datosForm;

function setDatos(data) {
    $("#txtNombre").val(data.nombre_p);
    $("#txtApellidoP").val(data.apellidop_p);
    $("#txtApellidoM").val(data.apellidom_p);
    $("#txtSexo").val(data.sexo_p);
    $("#txtFechaNac").val(data.f_nacimiento_p);
    $("#cbxRegion").val(data.id_region);
    getComunas();
    $("#cbxComuna").val(data.id_comuna);
    $("#txtCalle").val(data.calle_p);
    $("#txtDomicilio").val(data.domicilio_p);
    $("#txtDepartamento").val(data.dpto_p);
    $("#txtTelefono").val(data.telefono_p);
    

    if (data.activo_tipo == "f") {
        $("#trTpDesc").show();
        $("#spnTp").text(data.tipo);
    } else{
        $("#cbxPrevision").val(data.id_tp);
    }

    if (data.activo_isapre == "f") {
        
    }

    if (data.id_tp != "3") {
        $("#trIsapre").hide();
    } else {
        if (data.activo_tipo == "t") {
            getIsapres();
            $("#trIsapre").show();
            if (data.activo_isapre == "t"){
                $("#cbxIsapre").val(data.id_isapre);
            }
            if (data.activo_isapre == "f"){
                $("#trIsDesc").show();
                $("#spnIsapre").text(data.isapre);
            }
        } else{
            $("#trIsDesc").show();
            $("#spnIsapre").text(data.isapre);
        }


    }
    $('#exampleModal').modal('hide');
}

$("#btnConsultar").click(function () {
    var rut = $("#txtRut").val();
    var dv = $("#txtDv").val();

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
        
        $.post(base_url + "Cadminpaciente/getPaciente", {
                rut: rut,
                dv: dv
            },
            function (data) {

            }, 'json').done(function (data) {
            console.log(data);
            $('#exampleModal').modal('show');
            $(".op").hide();
            if (data == null) {
                $(".modal-body h3").text("Este Rut no se encuentra registrado");
                $("#opRegistrar").show();
                $("#opRegistrar").click(function () {
                    $("#btnConsultar").prop("disabled", true);
                    habRegistro();
                    $(".btnAccion").hide();
                    $("#txtRut, #txtDv").prop("readonly", true);
                    $("#btnRegistrar, #btnCancelar").show();
                    $('#exampleModal').modal('hide');
                });
            } else {
                if (data.activo_p == "t") {
                    $(".modal-body h3").text("Este Rut ya se encuentra registrado.");
                    $("#opEditar, #opDesactivar, #opVer").show();
                    datosForm = data;
                } else {
                    $(".modal-body h3").text("Este Rut ya se encuentra registrado, pero inactivo.");
                    $("#opEditar, #opActivar, #opVer").show();
                    datosForm = data;
                }

            }


        });
    }

});

$("#opVer").click(function () {
    setDatos(datosForm);
    $("#btnConsultar").prop("disabled", true);
    $("#txtRut, #txtDv").prop("readonly", true);
    $("#btnCancelar").show();
});

$("#opEditar").click(function () {
    setDatos(datosForm);
    $(".form-control").prop("disabled", false);
    $("#btnConsultar").prop("disabled", true);
    $("#txtRut, #txtDv").prop("readonly", true);
    $("#btnCancelar").show();
    $("#btnModificar").show();
});

$("#opDesactivar").click(function () {
    setDatos(datosForm);
    $("#btnConsultar").prop("disabled", true);
    $("#txtRut, #txtDv").prop("readonly", true);
    $("#btnCancelar").show();
    $("#btnDesactivar").show();
});

$("#opActivar").click(function () {
    setDatos(datosForm);
    $("#btnConsultar").prop("disabled", true);
    $("#txtRut, #txtDv").prop("readonly", true);
    $("#btnCancelar").show();
    $("#btnActivar").show();
});

var nombre;
var apellido_p;
var apellido_m;
var sexo;
var fecha_nac;
var region;
var comuna;
var calle;
var domicilio;
var telefono;
var tipo_paciente;
var isapre;

function asignacion_vars() {
    nombre = $("#txtNombre").val();
    apellido_p = $("#txtApellidoP").val();
    apellido_m = $("#txtApellidoM").val();
    fecha_nac = $("#txtFechaNac").val();
    region = $("#cbxRegion").val();
    comuna = $("#cbxComuna").val();
    calle = $("#txtCalle").val();
    domicilio = $("#txtDomicilio").val();
    telefono = $("#txtTelefono").val();
    tipo_paciente = $("#cbxPrevision").val();
    isapre = $("#cbxIsapre").val();
}

var estado = "";
var text_estado = "";

$("#btnRegistrar").click(function () {
    asignacion_vars();
    var formData = new FormData($("#formP")[0]);
    $(".errores").fadeOut("fast");
    if (nombre == "") {
        $("#mensajeNombre").fadeIn("slow");
    } else if (apellido_p == "") {
        $("#mensajeApellidoP").fadeIn("slow");
    } else if (apellido_m == "") {
        $("#mensajeAéllidoM").fadeIn("slow");
    } else if (fecha_nac.length == 0) {
        $("#mensajeFechaNac").fadeIn("slow");
    } else if (calle == "") {
        $("#mensajeCalle").fadeIn("slow");
    } else if (domicilio == "") {
        $("#mensajeNumeroDomicilio").fadeIn("slow");
    } else if (telefono == "") {
        $("#mensajeTelefono").fadeIn("slow");
    } else {
        alertify.confirm('Registrar Paciente', '¿Seguro que desea registrar este paciente?', function () {
            
            $.ajax({
                url: base_url + "Cadminpaciente/registrarPaciente",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function (datos) {
                    console.log(datos);
                    if (datos == "1") {
                        cancelar();
                        alertify.success('Paciente registrado correctamente');
                    } else if (datos == "0") {
                        alertify.error('Error en registrar al paciente');
                    }
                }

            });

        }, function () {

        });
    }
});



$("#btnModificar").click(function () {
    asignacion_vars();
    var formData = new FormData($("#formP")[0]);
    $(".errores").fadeOut("fast");
    if (nombre == "") {
        $("#mensajeNombre").fadeIn("slow");
    } else if (apellido_p == "") {
        $("#mensajeApellidoP").fadeIn("slow");
    } else if (apellido_m == "") {
        $("#mensajeAéllidoM").fadeIn("slow");
    } else if (fecha_nac.length == 0) {
        $("#mensajeFechaNac").fadeIn("slow");
    } else if (calle == "") {
        $("#mensajeCalle").fadeIn("slow");
    } else if (domicilio == "") {
        $("#mensajeNumeroDomicilio").fadeIn("slow");
    } else if (telefono == "") {
        $("#mensajeTelefono").fadeIn("slow");
    } else {
        alertify.confirm('Modificar Paciente', '¿Seguro que deseas modificar este paciente?', function () {
            
            $.ajax({
                url: base_url + "Cadminpaciente/modificarPaciente",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function (datos) {
                    console.log(datos);
                    if (datos == "1") {
                        cancelar();
                        alertify.success('Paciente modificado correctamente');
                    } else if (datos == "0") {
                        alertify.error('Error en modificar al paciente');
                    }
                }

            });

        }, function () {

        });
    }
});

$("#btnDesactivar").click(function () {

    var formData = new FormData($("#formP")[0]);

    alertify.confirm('Desactivar Paciente', '¿Seguro que deseas desactivar este paciente?', function () {
        
        $.ajax({
            url: base_url + "Cadminpaciente/desactivarPaciente",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (datos) {
                console.log(datos);
                if (datos == "1") {
                    cancelar();
                    alertify.success('Paciente desactivado correctamente');
                } else if (datos == "0") {
                    alertify.error('Error en desactivar al paciente');
                }
            }

        });

    }, function () {

    });
});

$("#btnActivar").click(function () {

    var formData = new FormData($("#formP")[0]);

    alertify.confirm('Activar Paciente', '¿Seguro que deseas activar este paciente?', function () {
        
        $.ajax({
            url: base_url + "Cadminpaciente/activarPaciente",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (datos) {
                console.log(datos);
                if (datos == "1") {
                    cancelar();
                    alertify.success('Paciente activado correctamente');
                } else if (datos == "0") {
                    alertify.error('Error en activar al paciente');
                }
            }

        });

    }, function () {

    });
});

function cancelar() {
    $(".form-control, .btn").prop("disabled", true);
    $(".btnAccion").prop("disabled", false).hide();
    $("#txtRut, #txtDv, #btnConsultar, .op, .opc").prop("disabled", false);
    init();
}

$("#btnCancelar").click(function () {
    init();
});

init();
