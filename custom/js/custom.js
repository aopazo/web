// Add here all your JS customizations

$('#pageLoginheaderRecover').on('click', function(e) {
	e.preventDefault();
	$('.page-login').css("display","none");
	$('.page-recover').css("display","block");
	$('#nombreseccion').html("Recuperar contraseña");
	$('.page-recover').find('.recover-form input:first').focus();
	$('#formIngresoLogin').find('.form-control').val('');
	$('#formIngresoLogin').find('label.error').remove();
	window.location.hash == "";
});

$('#pageRecoverHeaderLogin, #pageModalRecuperoMailHeaderLogin').on('click', function(e) {
	e.preventDefault();
	$('.page-login').css("display","block");
	$('.page-recover').css("display","none");
	$('#nombreseccion').html("Ingresar");
	$('.page-login').find('.login-form input:first').focus();	
	$('#formIngresoRecuperarMail').find('.form-control').val('');	
	$('#formIngresoRecuperarMail').find('label.error').remove();
	window.location.hash == "";
});

$(document).ready(function(){
	$.get("header", function( data ) {
		$("#header-navegacion").html(data);
		})

	$.get("footer", function( data ) {
		$("#footer").html(data);
		$("#contenido").css("visibility", "visible");
		})
});		

function ActiveTab(tabdestino) {
        console.log("holi");
        if (tabdestino == "#validar" || tabdestino == "#facturacion" || tabdestino == "#transferencia") {
            $('#tabs a[href="#registro"]').css("color", "#00CD00").css("border-top-color", "#00CD00");
            $('#tabs a[href="#registro"]').find('span').html('<i class="fa fa-check pull-right"></i>');
            $('#tabs a[href="#registro"]').parent().addClass('disable');
        }
        if (tabdestino == "#facturacion" || tabdestino == "#transferencia") {
            $('#tabs a[href="#validar"]').css("color", "#00CD00").css("border-top-color", "#00CD00");
            $('#tabs a[href="#validar"]').find('span').html('<i class="fa fa-check pull-right"></i>');
            $('#tabs a[href="#validar"]').parent().addClass('disable');
        }
        if (tabdestino == "#transferencia") {
            $('#tabs a[href="#facturacion"]').css("color", "#00CD00").css("border-top-color", "#00CD00");
            $('#tabs a[href="#facturacion"]').find('span').html('<i class="fa fa-check pull-right"></i>');
            $('#tabs a[href="#facturacion"]').parent().addClass('disable');
        }
	$('#tabs a[href="' + tabdestino + '"]').attr('data-toggle', 'tab');
	$('#tabs a[href="' + tabdestino + '"]').parent().removeClass('disable');
	$('#tabs a[href="' + tabdestino + '"]').tab('show');
//	$('#tabs a[href="' + taborigen + '"]').css("color", "#00CD00").css("border-top-color", "#00CD00");
//	$('#tabs a[href="' + taborigen + '"]').find('span').html('<i class="fa fa-check pull-right"></i>');
        // actualiza el foco hacia el lugar a actualizar por el usuario en un móvil o tablet
	if (!$('#tabs a[href="' + tabdestino + '"]').visible($('#header').height())) {
		$('html, body').animate({ scrollTop: $('#tabs a[href="' + tabdestino + '"]').offset().top - $('#header').height() }, 500);
	}
}

function ContactoEnviado(idmodal) {
	$('#form-contacto').find('.form-control').val('');
	$('#form-contacto').find('label.error').remove();	
	$('#form-contacto').find('.has-success').removeClass('has-success');
	$(idmodal).modal({show: 'true'});
}

$('#editarmail').on('click', function(e) {
	$('#formcambiomail').toggle();
	$('#formcambiomail').find('.form-control').val('');
	$('#formcambiomail').find('label.error').remove();
});

$('#editarclave').on('click', function(e) {
	$('#formcambioclave').toggle();
	$('#formcambioclave').find('.form-control').val('');
	$('#formcambioclave').find('label.error').remove();
});

$('#editarnombres').on('click', function(e) {
	$('#formcambionombre').toggle();
	$('#formcambionombre').find('.form-control').val('');
	$('#formcambionombre').find('label.error').remove();
});

$('#editarrut').on('click', function(e) {
	$('#formcambiorut').toggle();
	$('#formcambiorut').find('.form-control').val('');
	$('#formcambiorut').find('label.error').remove();
});

$('#editardireccion').on('click', function(e) {
	$('#formcambiodireccion').toggle();
	$('#formcambiodireccion').find('.form-control').val('');
	$('#formcambiodireccion').find('label.error').remove();
});

function OcultarFormMailyQuizasMostrarModal(idform, idmodal, idmail, siCancelar) {
	var email = $(idform).find('input[name="email"]').val();
	$(idform).hide().find('label.error').remove();
	$(idform).find('.form-control').val('');
	if (siCancelar == 0) {
		$(validacionOK).addClass("hidden");
		$(validacionKO).removeClass("hidden");
		$(suscripcionOK).addClass("hidden");
		$(suscripcionKO).removeClass("hidden");
		$(mailprovisorio).text($(idmail).text());
		$(idmail).text(email);
		$(seccionemailprovisorio).show();		
		$(idmodal).modal({show: 'true'}); 
	}
	return false;
}

function OcultarFormClaveyQuizasMostrarModal(idform, idmodal, siCancelar) {
	var clave = $(idform).find('input[name="password"]').val();
	$(idform).hide().find('label.error').remove();
	$(idform).find('.form-control').val('');
	if (siCancelar == 0) {		
		$(idmodal).modal({show: 'true'}); 
	}
}

function OcultarFormNombreyQuizasMostrarModal(idform, idmodal, idnombres, idapellidos, siCancelar) {
	var nombres = $(idform).find('input[name="nombres"]').val();
	var apellidos = $(idform).find('input[name="apellidos"]').val();
	$(idform).hide().find('label.error').remove();
	$(idform).find('.form-control').val('');
	if (siCancelar == 0) {		
		$(idnombres).text(nombres);
		$(idapellidos).text(apellidos);
		$(idmodal).modal({show: 'true'}); 
	}
}

function OcultarFormRUTyQuizasMostrarModal(idform, idmodal, idrut, siCancelar) {
	var rut = $(idform).find('input[name="rut"]').val();
	$(idform).hide().find('label.error').remove();
	$(idform).find('.form-control').val('');
	if (siCancelar == 0) {		
		$(idrut).text(rut);
		$(idmodal).modal({show: 'true'}); 
	}
}

function OcultarFormDireccionyQuizasMostrarModal(idform, idmodal, iddireccion, idcomuna, idciudad, idregion, siCancelar) {
	var direccion = $(idform).find('input[name="direccion"]').val();
	var comuna = $(idform).find('input[name="comuna"]').val();
	var ciudad = $(idform).find('input[name="ciudad"]').val();
	var region = $(idform).find('input[name="region"]').val();
	$(idform).hide().find('label.error').remove();
	$(idform).find('.form-control').val('');
	if (siCancelar == 0) {
		$(iddireccion).text(direccion);
		$(idcomuna).text(comuna);
		$(idciudad).text(ciudad);
		$(idregion).text(region);
		$(idmodal).modal({show: 'true'}); 
	}
}

$('#formRegistroFacturacion').validate();

$('#formcambiomail').validate({
	rules: {
		email_repetir: {
			equalTo: "#email"
		}
	}	
});

$('#formcambioclave').validate({
	rules: {
		password_repetir: {
			equalTo: "#password"
		}
	}	
});

$('#formUsuario').validate({
	rules: {
		'captcha': {
			captcha: true
		},
		'checkboxes[]': {
			required: true
		},
		contrasena_repetir: {
			equalTo: "#contrasena"
		},
		correo_repetir: {
			equalTo: "#correo"
		}
	}	
});

$('#formContactenos').validate({
	rules: {
		'captcha': {
			captcha: true
		}
	}	
});

$('#formIngresoLogin').validate();

$('#formIngresoRecuperarMail').validate();

$('#formcambionombre').validate();

$('#formcambiorut').validate();

$('#formcambiodireccion').validate();

function MostrarModal(idmodal) {
	$(idmodal).modal({show: 'true'}); 
}

function popup(ses){
	if(ses == '') ;
	else{
		document.getElementById(ses).style.visibility = "visible";
		document.getElementById(ses).style.display = "block";
	}
}
