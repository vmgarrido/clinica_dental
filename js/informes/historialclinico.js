$.ajaxSetup({
    async: false
});

function init(){
	getEspecialidades();
	$("#h-body").html("");
	$("#btnLimpiar").hide();
}

function getEspecialidades(){
	$.post(base_url + "Cdentistas/getEspecialidades", function (data) {

    }).done(function (data) {
        $("#cbxEspecialidad").html(data);
    });
}

$("#txtFechaInicio").change(function () {
    $("#mensaje-fecha-inicio").fadeOut("fast");
});

$("#txtFechaFin").change(function () {
    $("#mensaje-fecha-fin").fadeOut("fast");
});

$("#btnConsultar").click(function(e){
	var startDate = $('#txtFechaInicio').val().replace(/-/g,'/');
	var endDate = $('#txtFechaFin').val().replace(/-/g,'/');
	var formData = new FormData($("#form-historial")[0]);

    $(".errores").fadeOut("fast");
    if(startDate.length == 0){
        $("#mensaje-fecha-inicio").fadeIn("slow");
        return false;
    }

    if(endDate.length == 0){
        $("#mensaje-fecha-fin").fadeIn("slow");
        return false;
    }

	if(startDate >= endDate){
	   alertify.warning("La fecha fin debe ser superior a la fecha inicio");
        return false;
	}

	$.ajax({
        url: base_url + "Cihistorialclinico/getHistorial",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            $("#h-body").html(datos);
            $("#btnLimpiar").show();
        }

    });
});

$("#btnLimpiar").click(function(){
	$("#h-body").html("");
	$(this).hide();
});

init();