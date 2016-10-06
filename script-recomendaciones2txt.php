<?php

function inicializaArchivo0() {
    $myFile = fopen("recomendacionesSD.txt", "w") or die("No se puede abrir recomendacionesSD.txt");
    fwrite($myFile, "[");
    return $myFile;
};

function inicializaArchivo1() {
    $myFile = fopen("recomendacionesCD.txt", "w") or die("No se puede abrir recomendacionesCD.txt");
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

$archivo0 = inicializaArchivo0();
$archivo1 = inicializaArchivo1();
require_once("connection.php");
require_once("functions.php");

// Tomamos todas las recomendaciones
$sql0  = " SELECT A.Fecha, A.Recomendacion, B.Recomendacion ";
$sql0 .= " FROM ";
$sql0 .= " 	( ";
$sql0 .= "         SELECT A.Fecha, Max(B.Fecha) as FechaLado ";
$sql0 .= "         FROM recomendaciones A inner JOIN ";
$sql0 .= "              (Select Fecha, Recomendacion FROM recomendaciones WHERE Recomendacion <> 'M') B on A.Fecha >= B.Fecha ";
$sql0 .= "         GROUP By A.Fecha ";
$sql0 .= "     ) F inner JOIN ";
$sql0 .= "     recomendaciones A on A.Fecha = F.Fecha inner join ";
$sql0 .= "     recomendaciones B on B.Fecha = F.FechaLado ";
$sql0 .= " Order by A.Fecha desc LIMIT 300 ";


$sql1  = " SELECT A.Fecha, A.Recomendacion, B.Recomendacion ";
$sql1 .= " FROM ";
$sql1 .= " 	( ";
$sql1 .= "         SELECT A.Fecha, Max(B.Fecha) as FechaLado ";
$sql1 .= "         FROM recomendaciones A inner JOIN ";
$sql1 .= "              (Select Fecha, Recomendacion FROM recomendaciones WHERE Recomendacion <> 'M') B on A.Fecha >= B.Fecha ";
$sql1 .= "         GROUP By A.Fecha ";
$sql1 .= "     ) F inner JOIN ";
$sql1 .= "     recomendaciones A on A.Fecha = F.Fecha inner join ";
$sql1 .= "     recomendaciones B on B.Fecha = F.FechaLado ";
$sql1 .= " Where A.Fecha <= (CURRENT_DATE() - INTERVAL (4 + (Case When DayOfWeek(A.Fecha) in (4,3,2,1) then 2 Else 0 End)) DAY) ";
$sql1 .= " Order by A.Fecha desc LIMIT 300 ";

$RResult0 = mysql_query($sql0);
$RResult1 = mysql_query($sql1);


// Recorremos la tabla
while ($RRow = mysql_fetch_array($RResult0)) {
    $RFecha = $RRow[0];
    $RRecomendacion = $RRow[1];
    $RecomendacionAnterior = $RRow[2];
    printLinea($archivo0,$RFecha,$RRecomendacion,$RecomendacionAnterior);
}

finalizaArchivo($archivo0);

// Recorremos la tabla
while ($RRow = mysql_fetch_array($RResult1)) {
    $RFecha = $RRow[0];
    $RRecomendacion = $RRow[1];
    $RecomendacionAnterior = $RRow[2];
    printLinea($archivo1,$RFecha,$RRecomendacion,$RecomendacionAnterior);
}

finalizaArchivo($archivo1);

?>
Script recomendaciones2txt ejecutado