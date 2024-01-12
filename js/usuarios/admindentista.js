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
    getEspecialidades();
    $("#trEsp").hide();
}

function limpiar() {
    $("input[type=text], input[type=password]").val("");
    $("input[type=text]").prop("readonly", false);
    $(".passNueva").hide();
    $("#asterisco").text("");
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

function getEspecialidades() {
    $.post(base_url + "Cadmindentista/getEspecialidades", function (data2) {

    }).done(function (data2) {
        $("#txtEspecialidad").html(data2);
    });
}

$("#cbxRegion").change(function () {
    getComunas();
});

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

$("#txtEmail").keydown(function () {
    $("#mensajeEmail").fadeOut("fast");
});

$("#txtPass").keydown(function () {
    $("#mensajePass").fadeOut("fast");
});

// habilitar e inhabilitar campos

function habRegistro() {
    $(".form-control").prop("disabled", false);
}

var flag_registro = false;
$("#btnConsultar").click(function () {
    flag_registro = false;

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

        
        $.post(base_url + "Cadmindentista/getDentista", {
                rut: rut,
                dv: dv
            },
            function (data) {

            }, 'json').done(function (data) {
            //console.log(data);
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
                    $("#asterisco").text("(*)");
                });
            } else {
                if (data.activo_u == "t" && data.activo_dent == "t") {
                    $(".modal-body h3").text("Este Rut ya se encuentra registrado.");
                    $("#opEditar, #opDesactivar, #opVer").show();
                    console.log(data.id_especialidad);
                    datosForm = data;
                } else if (data.activo_u == "t" && (data.activo_dent == "f" || data.activo_dent == null)) {
                    $(".modal-body h3").text("Este Rut ya se encuentra registrado como usuario, pero no corresponde a un dentista.");
                    datosForm = data;
                } else if (data.activo_u == "f" && data.activo_dent == "f") {
                    $(".modal-body h3").text("Este Rut ya se encuentra registrado, pero inactivo.");
                    $("#opEditar, #opActivar, #opVer").show();
                    datosForm = data;
                } else if (data.activo_u == "f" && data.activo_dent == null){
                    $(".modal-body h3").text("Este Rut ya se encuentra registrado como usuario inactivo, ¿Registrar como dentista?.");
                    $("#opRegistrar").show();
                    flag_registro = true;
                    datosForm = data;

                    $("#opRegistrar").click(function () {
                        setDatos(datosForm);
                        $("#btnConsultar").prop("disabled", true);
                        habRegistro();
                        $(".btnAccion").hide();
                        $("#txtRut, #txtDv").prop("readonly", true);
                        $("#btnRegistrar, #btnCancelar").show();
                        $('#exampleModal').modal('hide');
                        $("#asterisco").text("(*)");
                    });
                }

            }


        });
    }

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
var email;
var pass;

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
    email = $("#txtEmail").val();
    pass = $("#txtPass").val();
}


function setDatos(data) {
    $("#txtNombre").val(data.nombre_u);
    $("#txtApellidoP").val(data.apellidop_u);
    $("#txtApellidoM").val(data.apellidom_u);
    $("#txtSexo").val(data.sexo_u);
    $("#txtFechaNac").val(data.f_nacimiento_u);
    $("#cbxRegion").val(data.id_region);
    getComunas();
    $("#cbxComuna").val(data.id_comuna);
    $("#txtCalle").val(data.calle_u);
    $("#txtDomicilio").val(data.domicilio_u);
    $("#txtDepartamento").val(data.dpto_u);
    $("#txtTelefono").val(data.telefono_u);
    $("#txtEmail").val(data.email_u);

    
    if(data.activo_esp == "f"){
        $("#trEsp").show();
        $("#tdEsp").text(data.nombre_esp);
    } else {
        if(flag_registro == false){
            $("#txtEspecialidad").val(data.id_especialidad);
        }
    }
    
    if (data.activo_u == "f") {
        $("#estado").val("0");
    } else{
        $("#estado").val("1");
    }
    
    
    $('#exampleModal').modal('hide');
}

$("#btnRegistrar").click(function () {
    asignacion_vars();

    var url = (flag_registro == false) ? 'Cadmindentista/registrarDentista' : 'Cadmindentista/registrarDentista2';

    var formData = new FormData($("#formUsuario")[0]);
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
    } else if (email == "") {
        $("#mensajeEmail").fadeIn("slow");
    } else if (pass == "") {
        $("#mensajePass").fadeIn("slow");
    } else {
        alertify.confirm('Registrar Dentista', '¿Seguro que desea registrar este nuevo Dentista?', function () {

            $.ajax({
                url: base_url + url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function (datos) {
                    console.log(datos);
                    if (datos == "1") {
                        cancelar();
                        alertify.success('Dentista registrado correctamente');
                    } else {
                        alertify.error('Error en registrar al dentista');
                    }
                }

            });

        }, function () {

        });
    }
});

$("#btnModificar").click(function () {
    asignacion_vars();
    var formData = new FormData($("#formUsuario")[0]);
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
    } else if (email == "") {
        $("#mensajeEmail").fadeIn("slow");
    } else {
        alertify.confirm('Modificar Usuario', '¿Seguro que deseas modificar este usuario?', function () {

            $.ajax({
                url: base_url + "Cadmindentista/modificarDentista",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function (datos) {
                    console.log(datos);
                    if (datos == "1") {
                        cancelar();
                        alertify.success('Dentista modificado correctamente');
                    } else {
                        alertify.error('Error en modificar al dentista');
                    }
                }

            });

        }, function () {

        });
    }
});

$("#btnDesactivar").click(function () {

    var formData = new FormData($("#formUsuario")[0]);


    alertify.confirm('Desactivar Dentista', '¿Seguro que deseas desactivar este dentista?', function () {

        $.ajax({
            url: base_url + "Cadmindentista/desactivarDentista",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (datos) {
                console.log(datos);
                if (datos == "1") {
                    cancelar();
                    alertify.success('Dentista desactivado correctamente');
                } else {
                    alertify.error('Error en desactivar al dentista');
                }
            }

        });

    }, function () {

    });


});

$("#btnActivar").click(function () {

    var formData = new FormData($("#formUsuario")[0]);

    alertify.confirm('Activar Dentista', '¿Seguro que deseas activar este Dentista?', function () {

        $.ajax({
            url: base_url + "Cadmindentista/activarDentista",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (datos) {
                console.log(datos);
                if (datos == "1") {
                    cancelar();
                    alertify.success('Dentista activado correctamente');
                } else {
                    alertify.error('Error en activar al Dentista');
                }
            }

        });

    }, function () {

    });
});

var datosForm;

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
    $(".passNueva").show();
    $("#asterisco").text("(opcional)");
    
    if (datosForm.activo_u == "f") {
        $("#txtEspecialidad").prop("disabled", true);
    }
    
});

$("#opDesactivar").click(function () {
    setDatos(datosForm);
    $("#btnConsultar").prop("disabled", true);
    $("#txtRut, #txtDv").prop("readonly", true);
    $("#btnCancelar").show();
    $("#btnDesactivar").show();

    if (datosForm.id_cargo == 3) {
        $("#trFechDel").show();
        $("#txtFechaEliminacion").prop("disabled", false);
    }
});

$("#opActivar").click(function () {
    setDatos(datosForm);
    $("#btnConsultar").prop("disabled", true);
    $("#txtRut, #txtDv").prop("readonly", true);
    $("#btnCancelar").show();
    $("#btnActivar").show();
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
