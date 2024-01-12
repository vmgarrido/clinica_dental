$.ajaxSetup({
    async: false
});

function init(){
    $("#panel1").show();
    $("#panel2").hide();
    listar();
}

function listar(){
    $.post(base_url + "Catencionesconflicto/getHoras", function (data) {

    }).done(function (data) {
        $("#h-body").html(data);
    });
}

function cambiar(){
    $("#panel1").hide();
    $("#panel2").show();
}

$("#btnCancelar").click(function () {
    $("#panel2").hide();
    $("#panel1").show();
});

init();

