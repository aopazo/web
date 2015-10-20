<?php

function inicializaArchivo() {
    $myFile = fopen("recomendaciones.txt", "w") or die("No se puede abrir recomendaciones.txt");
    fwrite($myFile, "[");
    return $myFile;
};

// {  "Anio" : 2015,  "Mes" : "Junio",  "Dia" : 16,  "Alerta": "M",  "Actual": "E" },
function printLinea($archivo, $fecha, $recomendacion, $actual)
{
    $fechas = explode("-", $fecha);
    $txt = "	{  \"Anio\" : " . $fechas[0] . ",  \"Mes\" : \"" . toChileanMonth($fechas[1]) . "\", ";
    $txt .= " \"Dia\" : " . (int)$fechas[2] . ", \"Alerta\": \"" . $recomendacion . "\", ";
    $txt .= " \"Actual\" : \"" . $actual . "\" },\n";
    fwrite($archivo, $txt);
};

function finalizaArchivo($archivo) {
    fwrite($archivo, "{  \"Anio\" : 2010,  \"Mes\" : \"Noviembre\",  \"Dia\" : 16,  \"Alerta\": \"E\",  \"Actual\": \"E\" }\n");
    fwrite($archivo, "]\n");
    fclose($archivo);
}

$archivo = inicializaArchivo();
require_once("connection.php");
require_once("functions.php");

// Tomamos todas las recomendaciones
$RResult = mysql_query("SELECT * FROM recomendaciones ORDER BY fecha DESC"); //Falta definir limite del historial a mostrar

// inicializamos la recomendacion anterior en M
$RecomendacionAnterior = "M";

// Recorremos la tabla
while ($RRow = mysql_fetch_array($RResult)) {
    $RFecha = $RRow[0];
    $RRecomendacion = $RRow[1];
    printLinea($archivo,$RFecha,$RRecomendacion,$RecomendacionAnterior);
    $RecomendacionAnterior = $RRecomendacion;
}

finalizaArchivo($archivo);

?>

<html>
    <head>
    </head>
    <body>
    Script recomendaciones2txt ejecutado
    </body>
</html>
