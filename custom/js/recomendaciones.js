window.onload = function() {
	// Carga de texto con json
	$.getJSON('get-recomendaciones.php', function(bdAlertas) {
			console.log("lili");
			for (var i = 0; i <= 5; i++) {
				// Si hay salto de Año, agregamos el header antes de continuar
					if (i == 0 || bdAlertas[i].Anio != bdAlertas[i-1].Anio){
							$('#mostrarhistroia-box').before(ElementoAnio(bdAlertas[i].Anio));
						}
					if (i == 0){
							$('#mostrarhistroia-box').before(ElementoRecomendacionActual(bdAlertas[i].Anio, bdAlertas[i].Mes, bdAlertas[i].Dia, bdAlertas[i].Alerta, bdAlertas[i].Actual));
							$('.timeline-box').slideDown();
					} else {
							$('#mostrarhistroia-box').before(ElementoRecomendacion(bdAlertas[i].Anio, bdAlertas[i].Mes, bdAlertas[i].Dia, bdAlertas[i].Alerta, bdAlertas[i].Actual));
							$('.timeline-box').delay( 200*(i-1) ).slideDown(200);
					}
				}
				
			$('#mostrarmashistoria').on('click', function(e) {
					e.preventDefault();
					for (var j = 1; j <= 10; j++) {
						if (i == 0 || bdAlertas[i].Anio != bdAlertas[i-1].Anio){
							$('#mostrarhistroia-box').before(ElementoAnio(bdAlertas[i].Anio));
							$('.timeline-date').delay( 200*(j-1) ).slideDown(200);
					
						}
					
						if (i<=bdAlertas.length-1){
							$('#mostrarhistroia-box').before(ElementoRecomendacion(bdAlertas[i].Anio, bdAlertas[i].Mes, bdAlertas[i].Dia, bdAlertas[i].Alerta, bdAlertas[i].Actual));
							$('.timeline-box').delay( 200*(j-1) ).slideDown(200);
							i++;
						}
					}
				});
		});

	// Nueva carga con json
	$.getJSON('recomendaciones.txt', function(bdAlertas) {
		;//for (var i = bdAlertas)
	});
};




$('#mostrarmashistoria').on('click', function(e) {
	e.preventDefault();
	$('.pormostrar').css("display","block");
});


function ElementoRecomendacionActual(anio, mes, dia, alerta, actual){
	if (actual == 'A'){
		var lado = 'left';
	} else {
		var lado = 'right';
	}
	if (alerta == 'A'){
		var mensaje = 'Mueve tu dinero al fondo A, independiente del fondo en que estés actualmente.';
	} else if (alerta == 'M'){
		var mensaje = 'Mantén tu dinero en el fondo en el que lo tienes actualmente.';
	} else {
		var mensaje = 'Mueve tu dinero al fondo E, independiente del fondo en que estés actualmente.';
	}		
	var innerHtml = [				
						'<article class="timeline-box ' + lado + ' post post-medium primera">',
						'	<div class="row">',
						'		<div class="col-md-12">',
						'			<h3 class = "center">RECOMENDACIÓN ACTUAL</h3>',
						'		</div>',
						'	</div>',
						'	<div class="row">',
						'		<div class="col-md-4">',
						'			<div class="post-meta">',
						'				<div class="post-date">',
						'					<span class="day">' + dia + '</span>',
						'					<span class="month">' + mes + '</span>',
						'				</div>',
						'			</div>',
						'		</div>',
						'		<div class="col-md-8">',
						'			<h4 align="center">Fondo ' + alerta + '</h4>',
						'			<p>' + mensaje + '</p>',
						'		</div>',
						'	</div>',
						'</article>'
					].join('');
	return innerHtml;
}

function ElementoRecomendacion(anio, mes, dia, alerta, actual){
	if (actual == 'A'){
		var lado = 'left';
	} else {
		var lado = 'right';
	}	
	var innerHtml = [				
						'<article class="timeline-box ' + lado + ' post post-medium" style="display:none;">',
						'	<div class="row">',
						'		<div class="col-md-4">',
						'			<div class="post-meta">',
						'				<div class="post-date">',
						'					<span class="day">' + dia + '</span>',
						'					<span class="month">' + mes + '</span>',
						'				</div>',
						'			</div>',
						'		</div>',
						'		<div class="col-md-8 cuadro-recomendacion">',
						'			<h4 align="center">Fondo ' + alerta + '</h4>',
						'		</div>',
						'	</div>',
						'</article>'
					].join('');
	return innerHtml;
}

function ElementoAnio(anio){
	var innerHtml = [				
						'<div class="timeline-date">', // sacando algo que no hace sentido:  style="display:none;"
						'	<h3>Año ' + anio + '</h3>',
						'</div>'
					].join('');
	return innerHtml;
}