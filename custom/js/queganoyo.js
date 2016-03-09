
$('#ahorro').keypress(function(event) {
  // Backspace, tab, enter, end, home, left, right
  // We don't support the del key in Opera because del == . == 46.
  var controlKeys = [8, 9, 13, 35, 36, 37, 39];
  // IE doesn't support indexOf
  var isControlKey = controlKeys.join(",").match(new RegExp(event.which));
  // Some browsers just don't raise events for control keys. Easy.
  // e.g. Safari backspace.
  if (!event.which || // Control keys in most browsers. e.g. Firefox tab is 0
      (49 <= event.which && event.which <= 57) || // Always 1 through 9
      (48 == event.which && $(this).val()) || // No 0 first digit
      isControlKey) { // Opera assigns values for control keys.
    return;
  } else {
    event.preventDefault();
  }
});

function ColaArreglo(n, datos){
	return datos.slice(datos.length - n, datos.length);
	//var cola = datos.slice(datos.length - n, datos.length);
	//for (var j = cola.length - 3; j >= 0; j-=3){
	//	cola = cola.slice(0, j).concat(cola.slice(j+2, cola.length))
	//}
	}

function DatosGrafico(n, bdDatos) {
		var data = {
			labels: ColaArreglo(1+12*n, bdDatos['Nombre Serie Corto']),
			labelsTooltip: ColaArreglo(1+12*n, bdDatos['Nombre Serie Largo']),
			datasets: [
				{/*#df0e28*/
					label: 'Fondo A',
					fillColor: "rgba(223,14,40,0.2)",
					strokeColor: "rgba(223,14,40,1)",
					pointColor: "rgba(223,14,40,0)",
					pointStrokeColor: "rgba(223,14,40, 0)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(223,14,40,1)",
					data: ColaArreglo(1+12*n, bdDatos['AFP Capital']['A'])
				},
				{/*#309da1*/
					label: 'Atempus',
					fillColor: "rgba(48,157,161,0.2)",
					strokeColor: "rgba(48,157,161,1)",
					pointColor: "rgba(48,157,161,0)",
					pointStrokeColor: "rgba(48,157,161,0)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(48,157,161,1)",
					data: ColaArreglo(1+12*n, bdDatos['AFP Capital']['ATEMPUS2'])
				}
			]
		};
		return data;
	};
	
function HitDetectionRadio(historia, extrapolacion){
	if (extrapolacion){
		return Math.max(Math.min(10, 3-historia/12), -2);
	} else {
		return Math.max(Math.min(10, 3-historia), -2);
	}
}

function OpcionesGrafico(historia, extrapolacion) {
		var options = {
			bezierCurve: extrapolacion
			,animationSteps: 20
			,responsive: true
			,scaleShowGridLines : false
			,legendTemplate : "<% for (var i=datasets.length-1; i>=0; i--){%><span class=\"chartjs-tooltip-key\" style=\"background-color:<%=datasets[i].strokeColor%>\"></span><span> <%if(datasets[i].label){%><%=datasets[i].label%><%}%> </span><%}%>"
			,pointHitDetectionRadius: HitDetectionRadio(historia, extrapolacion)
			,customTooltips: function(tooltip) {
				// Tooltip Element
				if (extrapolacion) {
					var tooltipEl = $('#chartjs-tooltip-extrapolacion');
				} else {
					var tooltipEl = $('#chartjs-tooltip-n');
				}
				
				if (!tooltip) {
				   tooltipEl.css({
					   opacity: 0
				   });
				   return;
				}

				tooltipEl.removeClass('above below');
				tooltipEl.addClass(tooltip.yAlign);

				var innerHtml = [
									'<div class="chartjs-tooltip-section">',
									'	<span>' + tooltip.title + '</span>',
									'</div>'
								].join('');
				for (var i = tooltip.labels.length - 1; i >= 0; i--) {
					var color = tooltip.legendColors[i].fill;
					color = color.replace(",0)", ",1)");
					innerHtml += [
						'<div class="chartjs-tooltip-section">',
						'	<span class="chartjs-tooltip-key" style="background-color:' + color + '"></span>',
						'	<span class="chartjs-tooltip-value">$' + FormatoNumero(tooltip.labels[i], 0) + '</span>',			
						'</div>'
					].join('');
				}
				
				tooltipEl.html(innerHtml);

				tooltipEl.css({
				   opacity: 1,
				   left: tooltip.chart.canvas.offsetLeft + tooltip.x + 'px',
				   top: tooltip.chart.canvas.offsetTop + tooltip.y + 'px',
				   fontFamily: tooltip.fontFamily,
				   fontSize: tooltip.fontSize,
				   fontStyle: tooltip.fontStyle,
				});
			}
		};
		return options;
	};

Chart.defaults.global.scaleLabel = function(label){return '$'+FormatoNumero(label.value, 0);};

function FormatoNumero(n, d){
	var k = Math.pow(10, d);
    var numero = Math.round(n * k) / k;
    var parts=numero.toString().split(".");
    return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".") + (parts[1] ? "," + parts[1] : "");
}


window.onload = function() {
	$.getJSON('valores_cuota.txt', function(bdDatos) {
			var ctxn = document.getElementById("simulacion-n").getContext("2d");
			var ctxE = document.getElementById("extrapolacion-n").getContext("2d");
			//var historia = parseFloat($('#historia').val());
			var historia = parseFloat($('#historia').text());
			
                        var datos_DatosGrafico = DatosGrafico(historia, bdDatos);
                        var datos_DatosGraficoExtrapolacion = DatosGraficoExtrapolacion(graficosimulacion, bdDatos);
                        
                        var datos_OpcionesGraficoHistoria = OpcionesGrafico(historia, false);
                        var datos_OpcionesGraficoExtrapolacion = OpcionesGrafico(CalculoHistoriaExtrapolacion(), true);
                        
			var graficosimulacion = new Chart(ctxn).Line(datos_DatosGrafico, datos_OpcionesGraficoHistoria);
			var graficoextrapolacion = new Chart(ctxE).Line(datos_DatosGraficoExtrapolacion, datos_OpcionesGraficoExtrapolacion);
			
			var graficos = [graficosimulacion, graficoextrapolacion];		
			
			graficos = ActualizarGraficos(bdDatos, graficos);
			
			$('#afp, #fondo').change(function() {
				graficos = ActualizarGraficos(bdDatos, graficos);
			});

			$('#historia').change(function() {
				graficos = ActualizarHistoria(bdDatos, graficos);
			});

			$('#edad, #edad-jubilacion').change(function() {				
				graficos = ActualizarGraficoExtrapolacion(graficos, bdDatos);
			});

			$('#ahorro').change(function() {
				if (parseInt($(this).val()) > parseInt($(this).data("max"))) {
						$(this).val($(this).data("max"));
					};
				if (parseInt($(this).val()) < parseInt($(this).data("min")) || !$(this).val()) {
						$(this).val($(this).data("min"));
					};
				graficos = ActualizarGraficos(bdDatos, graficos);
			});

		});
};

function ActualizarHistoria(bdDatos, graficos){
	//var historia = parseFloat($('#historia').val());
	var historia = parseFloat($('#historia').text());
	if (historia <= 2){
		$('#texto-inicial').text('Si');
	} else {
		$('#texto-inicial').text('Si hubiesemos existido hace más tiempo y');
	}
	graficos[0].destroy();
	var ctxn = document.getElementById("simulacion-n").getContext("2d");
        var datosOpcionesGrafico = OpcionesGrafico(historia, false);
	graficos[0] = new Chart(ctxn).Line(DatosGrafico(historia, bdDatos), datosOpcionesGrafico);
	
	graficos = ActualizarGraficos(bdDatos, graficos);
	return graficos;
}	

function ActualizarGraficos(bdDatos, graficos){
	var ahorroinicial = parseFloat($('#ahorro').val());
	
	//var historia = parseFloat($('#historia').val());
	var historia = parseFloat($('#historia').text());
	var afp = $('#afp option:selected').text();
	var fondo = $('#fondo option:selected').text();
		
	var seriefondo = ColaArreglo(1+12*historia, bdDatos[afp][fondo]);
	var serieatempus = ColaArreglo(1+12*historia, bdDatos[afp]['ATEMPUS2']);
	var serieatempusGratis = ColaArreglo(1+12*historia, bdDatos[afp]['ATEMPUS6']);
	
	var numeroDeDatos = seriefondo.length;
	
	graficos[0].datasets[0].label = "Fondo " + fondo;
	graficos[0].datasets[0].points[0].value = ahorroinicial;
	graficos[0].datasets[1].points[0].value = ahorroinicial;
	
	for (var i = 1; i <= numeroDeDatos - 1; i++){
			graficos[0].datasets[0].points[i].value = (graficos[0].datasets[0].points[i-1].value)*(seriefondo[i]/seriefondo[i-1]);	
			graficos[0].datasets[1].points[i].value = (graficos[0].datasets[1].points[i-1].value)*(serieatempus[i]/serieatempus[i-1]);	
		}
        
        var ahorrofinalAFP = ahorroinicial*seriefondo[numeroDeDatos - 1]/seriefondo[0];
	var ahorrofinalAtempus = ahorroinicial*serieatempus[numeroDeDatos - 1]/serieatempus[0];
	var ahorrofinalAtempusGratis = ahorroinicial*serieatempusGratis[numeroDeDatos - 1]/serieatempusGratis[0];
	
        graficos[0].update();
	$('#leyenda-n').html(graficos[0].generateLegend());
	$('#leyenda-afp-n').html(afp);
	$('#proyeccion-n').html('<destacar class="appear-animation flash">$'+FormatoNumero(ahorrofinalAtempus, 0)+'</destacar>');
	$('#ahorro-inicial').html('$'+FormatoNumero(ahorroinicial, 0));
	$('#ahorro-final-afp').html('<destacarAFP class="appear-animation flash">$'+FormatoNumero(ahorrofinalAFP, 0)+'</destacarAFP>');
	//$('#ahorro-final-afp').html('$'+FormatoNumero(ahorrofinalAFP, 0));
	$('#ahorro-final-atempus').html('$'+FormatoNumero(ahorrofinalAtempus, 0));
	$('#ahorro-final-atempusGratis').html('$'+FormatoNumero(ahorrofinalAtempusGratis, 0));
	$('#chartjs-tooltip-n').css({ opacity : "0" });
	
	graficos = ActualizarDatosGraficoExtrapolacion(graficos, bdDatos);
	return graficos;
};

function CalculoHistoriaExtrapolacion(){
	var edad = parseFloat($('#edad').val());
	var edad_jubilacion = parseFloat($('#edad-jubilacion').val());
	if (edad >= edad_jubilacion){
		edad_jubilacion = edad + 1;
		$('#edad-jubilacion').val(edad_jubilacion);
	}
	return edad_jubilacion - edad;
}


function DatosExtrapolacion(graficosimulacion, bdDatos){
	var fechas = bdDatos['Nombre Serie Corto'].sort();
	var fecha = fechas[fechas.length-1];
	
	var ahorrofinal = parseFloat($('#ahorro').val());
        
	var historia = parseFloat($('#historia').text());
	var afp = $('#afp option:selected').text();
	var fondo = $('#fondo option:selected').text();
	var seriefondo = ColaArreglo(1+12*historia, bdDatos[afp][fondo]);
	var serieatempus = ColaArreglo(1+12*historia, bdDatos[afp]['ATEMPUS2']);
	
	var historiaproyectada = CalculoHistoriaExtrapolacion();
		
	var numeroDeDatos = seriefondo.length;	
	var ahorrofinalSinAtempus = seriefondo[numeroDeDatos-1];
	var ahorroinicialSinAtempus = seriefondo[0];
	var factorSinAtempus = Math.pow(ahorrofinalSinAtempus/ahorroinicialSinAtempus, 12/(numeroDeDatos - 1));
	
	var ahorrofinalConAtempus = serieatempus[numeroDeDatos-1];
	var ahorroinicialConAtempus = serieatempus[0];
	var factorConAtempus = Math.pow(ahorrofinalConAtempus/ahorroinicialConAtempus, 12/(numeroDeDatos - 1));
	
	var factorCotizacionSinAtempus = 0;
	var factorCotizacionConAtempus = 0;
	
	for (var j = 1; j <= 12; j++){
			factorCotizacionSinAtempus += Math.pow(factorSinAtempus, j/12);
			factorCotizacionConAtempus += Math.pow(factorConAtempus, j/12);
		};
		
	var labels = [fecha];
	var labelsTooltip = ['Año ' + fecha];
	var datosConAtempus = [ahorrofinal];
	var datosSinAtempus = [ahorrofinal];
	
	for (var j = 1; j <= historiaproyectada; j++){
			labels[labels.length] = parseFloat(labels[labels.length-1])+1;
			labelsTooltip[labelsTooltip.length] = 'Año ' + labels[labels.length-1];
			datosConAtempus[datosConAtempus.length] = datosConAtempus[datosConAtempus.length-1]*factorConAtempus;
			datosSinAtempus[datosSinAtempus.length] = datosSinAtempus[datosSinAtempus.length-1]*factorSinAtempus;
		};
		
	return {
				"labels": labels,
				"labelsTooltip": labelsTooltip,
				"datosConAtempus": datosConAtempus,
				"datosSinAtempus": datosSinAtempus
			};
}

function DatosGraficoExtrapolacion(graficosimulacion, bdDatos){
	var datos = DatosExtrapolacion(graficosimulacion, bdDatos);	
	
	var data = {
			labels: datos.labels,
			labelsTooltip: datos.labelsTooltip,
			datasets: [
				{/*#df0e28*/
					label: 'Sin Atempus',
					fillColor: "rgba(223,14,40,0.2)",
					strokeColor: "rgba(223,14,40,1)",
					pointColor: "rgba(223,14,40,0)",
					pointStrokeColor: "rgba(223,14,40, 0)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(223,14,40,1)",
					data: datos.datosSinAtempus
				},
				{/*#309da1*/
					label: 'Con Atempus',
					fillColor: "rgba(48,157,161,0.2)",
					strokeColor: "rgba(48,157,161,1)",
					pointColor: "rgba(48,157,161,0)",
					pointStrokeColor: "rgba(48,157,161,0)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(48,157,161,1)",
					data: datos.datosConAtempus
				}
			]
		};
		return data;
}

function ActualizarGraficoExtrapolacion(graficos, bdDatos){	
	graficos[1].destroy();
	var ctxE = document.getElementById("extrapolacion-n").getContext("2d");
        var datosOpcionesGrafico = OpcionesGrafico(CalculoHistoriaExtrapolacion(), true);
	graficos[1] = new Chart(ctxE).Line(DatosGraficoExtrapolacion(graficos[0], bdDatos), datosOpcionesGrafico);	
	
	var numeroDeDatos = graficos[1].datasets[1].points.length;
	var beneficio = graficos[1].datasets[1].points[numeroDeDatos - 1].value / graficos[1].datasets[0].points[numeroDeDatos - 1].value - 1;
	$('#proyeccion-jubilacion').html('<destacar class="appear-animation flash">'+FormatoNumero(100*beneficio, 2)+'%</destacar>');
	$('#chartjs-tooltip-extrapolacion').css({ opacity : "0" });
	
	return graficos;
}

function ActualizarDatosGraficoExtrapolacion(graficos, bdDatos){		
	var numeroDeDatos = graficos[1].datasets[1].points.length;
	var datosNuevos= DatosExtrapolacion(graficos[0], bdDatos);
	
	for (var j = 0; j <= numeroDeDatos-1; j++){
			graficos[1].datasets[0].points[j].value = datosNuevos.datosSinAtempus[j];
			graficos[1].datasets[1].points[j].value = datosNuevos.datosConAtempus[j];
		};
		
	graficos[1].update();
	var beneficio = graficos[1].datasets[1].points[numeroDeDatos - 1].value / graficos[1].datasets[0].points[numeroDeDatos - 1].value - 1;
	$('#proyeccion-jubilacion').html('<destacar class="appear-animation flash">'+FormatoNumero(100*beneficio, 2)+'%</destacar>');
	$('#chartjs-tooltip-extrapolacion').css({ opacity : "0" });
	
	return graficos;
}