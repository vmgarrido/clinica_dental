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
        url: base_url + "Cihistorialclinico/getHistorial2",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',

        success: function (datos) {
            $("#h-body").html(datos.filas);
            $("#txtHrsAtendidas").val(datos.atendidas);
            $("#txtHrsSinAtender").val(datos.sin_atender);
            $("#btnLimpiar").show();

            if(datos.atendidas > 0 || datos.sin_atender > 0){
            	$("#cbxFiltro").prop("disabled", false);
            } else{
            	$("#cbxFiltro").prop("disabled", true);
            }
        }

    });

    $("#cbxFiltro").val("T");
	$('input#search').val("");
    $('input#search').quicksearch('table#tablaHrs tbody tr');
});

$("#cbxFiltro").change(function(){
	var valu = $(this).val();
	if(valu == "T"){
		$('input#search').val("");
	} else if (valu == "A"){
		$('input#search').val("Atendida");
	} else {
		$('input#search').val("Sin Atender");
	}
	$('input#search').quicksearch('table#tablaHrs tbody tr');
});

$("#btnLimpiar").click(function(){
	init();
});

init();