var urlBase = getAbsolutePath();
var ws_rest_login;
var urlLogeado;

var urlSecure;
var codigoSistema;
var cargaCapcha;

function doLogin(loginData) {
	
    ws_rest_login=urlBase+'controllers/login.php'
	urlLogeado=urlBase+'views/index.php'; 
	
	//console.log( "ws_rest_login --> "+ws_rest_login  );
	//console.log("urlLogeado --> "+urlLogeado); 

    $.ajax({
		type:'GET',
		url:ws_rest_login,		
		dataType: "json",
		data: {
			usuario:loginData.usuario,
			contrasena:loginData.contrasena
		},		
		success:function(resultado){
			//console.log("Status --> "+resultado.status);
			//console.log("Codigo respuesta --> "+resultado.coRespuesta);
  	    	
			if( resultado.coRespuesta=="0000"){
				notificacionMensaje(resultado.deRespuesta,'success');
    			window.location.href = urlLogeado;
			}else{
				notificacionMensaje(resultado.deRespuesta,'warning');
			}
			
		}
    });    
};
/*
function setenadoDatosPost(data){
	var ruta = 'login';	
	console.log(" ruta --> "+ruta);	
    $("#jsonData").val(JSON.stringify(data));
    $("#frmLogin").attr('action', ruta)
    $("#frmLogin").submit();
};
*/
/*************************************************************/
function createCaptcha() {
	//clear the contents of captcha div first
	document.getElementById('captcha').innerHTML = "";
	//$('#captcha').val('');
	//var charsArray = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
	var charsArray = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	var lengthOtp = 5;
	var captcha = [];
	
	for (var i = 0; i < lengthOtp; i++) {
		//below code will not allow Repetition of Characters
	    var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
	    if (captcha.indexOf(charsArray[index]) == -1)
	      captcha.push(charsArray[index]);
	    else i--;
	}
	
	var canv = document.createElement("canvas");
	canv.id = "captcha";
	canv.width=100;
	canv.height=33; //22;//50
	var ctx = canv.getContext("2d");
	ctx.font = "20px Arial"; //18px Arial   25px Georgia	
	ctx.fillStyle = "#e17127";
	//ctx.textAlign = "center";
	ctx.fillText(captcha.join(""), 0, 20);//  21  30
	//storing captcha so that can validate you can save it somewhere else according to your specific requirements
	code = captcha.join("");
	document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
	
};

function validateCaptcha() {
	//event.preventDefault();
	//debugger;
	
	var usuario = $.trim($("#username").val());
	var contrasena = $.trim($("#password").val());
	
	if( usuario=="" && contrasena=="" ){		
		notificacionMensaje("Ingrese usuario y contraseña.",'warning');
	    return false;
	}else{
	    
	    if( usuario=="" ){		
			notificacionMensaje("Ingrese usuario.",'warning');
			return false;
		    	
	    }else if( contrasena=="" ){
			notificacionMensaje("Ingrese contraseña.",'warning');
			return false;
		    
	    }else{
			
			if($.trim($("#cpatchaTextBox").val())!=""){
				
				if ($.trim($("#cpatchaTextBox").val()) == code) {			
					var formData = {
						usuario: $("#username").val(),
						contrasena:$("#password").val()
					};					
					doLogin(formData);
				}else{
					notificacionMensaje("Invalido el código captcha ingresado.",'warning');
					return false;				
				}
			}else{
				notificacionMensaje("Ingrese código captcha.",'warning');
				return false;
				
			}			
	    }
	}			
};
/*************************************************************/

$(document).ready(function() {	
	//console.log('valor ruta --> '+urlBase);
	
	/*** capcha 2 ***/    
	createCaptcha();

    $('#divUsuNoExiste').hide();    
    $("#username").focus();	
    
    $("#password, #cpatchaTextBox").keypress(function( event ) {
	if ( event.which == 13 ) {
	    $("#loginSubmit").click();
	}
    });
	
    /****************/
    $("#loginSubmit").click(function(){
		validateCaptcha();
    });	


	$(".cerrarMensaje").unbind("click").click(function(){
		$("#modalMensaje").modal('hide');
		$("#modalMensaje").hide(); 
	});	 
    
});