function init(){
	$("#formUsuario").show();
	$("#panel2").hide();
}

$(".editar").click(function(){
	$("#formUsuario").hide();
	$("#panel2").show();
});

$("#btnCancelar").click(function(){
	init();
});

init();