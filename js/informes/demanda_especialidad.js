$.ajaxSetup({
    async: false
});

function init(){
	getEspecialidades();
	$("input[type=text]").val("");
	$("#h-body").html("");
	$("#btnLimpiar").hide();
	$("#cbxFiltro").prop("disabled", true);
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

$("#btnConsultar").click(function(){
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
        url: base_url + "Cihistorialclinico/demandaEspecialidad",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',

        success: function (datos) {
            $("#h-body").html(datos.filas);
            $("#btnLimpiar").show();
            $("#txtCantidadReservas").val(datos.count);
        }

    });

    $('input#search').val("");
    $('input#search').quicksearch('table#tablaDE tbody tr');

});

$("#btnLimpiar").click(function(){
	init();
});

init();