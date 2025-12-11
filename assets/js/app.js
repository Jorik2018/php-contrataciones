function validar_email( email ){
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

function notificacionMensaje(texto, clase){
	
	setTimeout(function(){
		$.gritter.add({
			title: 'Sistema de Convocatoria',
			text: texto,
			sticky: true,
			class_name: clase,
			time: '4000'
		});
	}, 100)
	$(".modal-backdrop").remove();
	$("body").css({ 'padding-right': '0' });
	return false;	
}

function forzarOcultarModal(){
	waitingDialog.hide();
 	$("#modalcito").hide();
}

$('.modal').on('hide.bs.modal', function (e) {
    $("body").css("padding-right","0 !important");
    $(".modal-backdrop").css('z-index', 1040);    
});

function b64toBlob(b64Data, contentType, sliceSize) {

	contentType = contentType || '';
	sliceSize = sliceSize || 512;

	var byteCharacters = atob(b64Data);
	var byteArrays = [];

	for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {	    
		var slice = byteCharacters.slice(offset, offset + sliceSize);
	    var byteNumbers = new Array(slice.length);
	    for (var i = 0; i < slice.length; i++) {
	    	byteNumbers[i] = slice.charCodeAt(i);
	    }
	    var byteArray = new Uint8Array(byteNumbers);
	    byteArrays.push(byteArray);
	}	    
	var blob = new Blob(byteArrays, {type: contentType});
	return blob;
}

function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
};

function esFecha(date) {	
	var dateParts = date.split("/");
	var dateObject = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);	
    return (new Date(dateObject) !== "Invalid Date" && !isNaN(new Date(dateObject)) ) ? true : false;
};

function obtenerFecha(date) {	
	var dateParts = date.split("/");
	var dateObject = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);	
    return new Date(dateObject);
};

$(document).ready(function() {
	var ventana_alto = $(window).height();
	$(".content-main").css("height", ventana_alto);
	
	$(".alert-info").hide();
	$(".alert-success").hide();
	$(".alert-warning").hide();
	$(".alert-danger").hide();
	$(".numeric").numeric({
			allowMinus   : false,
			allowThouSep : false
	});
	$(".numeric").numeric("integer")
    $(".decimal").numeric({});
    	
});