$.ajaxSetup({
    async: false
});

function init(){
    $("#mensaje").hide();
}

$('#txtRut').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});

$('#txtDv').on('input', function () { 
    var a = this.value.replace(/[^0-9kK]/g,'');
    this.value = a.toUpperCase();
});

$("#txtRut").keydown(function(){
    $("#mensajeRut").fadeOut("fast");
});

$("#txtDv").keydown(function(){
    $("#mensajeDv").fadeOut("fast");
});

$("#txtPass").keydown(function(){
    $("#mensajePass").fadeOut("fast");
});

$("#btnIngresar").click(function(){
    var rut = $("#txtRut").val();
    var dv = $("#txtDv").val();
    var pass = $("#txtPass").val();
    
    $("#mensaje").hide();
    $(".errores").fadeOut("fast");
    if (rut == "") {
        $("#mensajeRut").fadeIn("slow");
    } else if (dv == "") {
        $("#mensajeDv").fadeIn("slow");
    } else if (pass == ""){
        $("#mensajePass").fadeIn("slow");
    } else {
        
        $.post(base_url + "Clogin/ingresar", {rut: rut, dv: dv, pass: pass}, function (data) {

        }).done(function (data) {
            
            if(data == "Rut falso"){
                $("#mensaje").show();
                $("#sp-msg").text("Este rut es falso");
            } else if (data == "0"){
                $("#mensaje").show();
                $("#sp-msg").text("Rut o Contraseña Incorrectos");
            } else if (data == "1") {
                location.href = base_url+"Cinicio/index";
            }
    
        });

    }
});

init();