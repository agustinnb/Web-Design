<?php

session_start();

if (isset($_SESSION['tk_username'])){ 
include "librerias/mysqlconnect.php";
include "validaciones/diferencia_fechas.php";
$user=$_SESSION['tk_username'];
$query= "SELECT * FROM organizadores WHERE usuario= '$user'";
$result = mysql_query($query) or die ("Error buscando el usuario en la DB");
$raw=@mysql_fetch_assoc($result);
$id=$raw['id'];
$event=$_GET['nomevent'];
 if ($raw['rango']=='A'){
$query="SELECT * FROM eventos where organizador=$id and nomevent='$event'";
$result2=mysql_query($query);
$row2=@mysql_fetch_assoc($result2);
if ($row2['nomevent']==$event){
$nom=utf8_decode($row2['nom']);
$query = "SELECT * FROM $event";
}else{
	die ("Usted no es un organizador valido para este evento");
 }
 }
 if ($raw['rango']=='S'){
$query="SELECT * FROM eventos where nomevent='$event'";
$result2=mysql_query($query);
$row2=@mysql_fetch_assoc($result2);
$nom=utf8_decode($row2['nom']);
$query = "SELECT * FROM $event";
 }

// archivos incluidos. Librerías PHP para poder graficar.


include "librerias/funciones_php/FusionCharts.php";



$result=mysql_query($query);
$insc=0;
$asis=0;
$acred=0;
$prea=0;
while ($row=@mysql_fetch_assoc($result)){

if ($row['inscripto']==1){
$insc++;
}
if ($row['asistente']==1){
$asis++;
}
if ($row['asistente']==1 && $row['inscripto']==0){
$acred++;
}
if ($row['asistente']==1 && $row['inscripto']==1){
$prea++;
}
}


// Gráfico de Barras. 4 Variables, 4 barras.
// Estas variables serán usadas para representar los valores de cada unas de las 4 barras.
// Inicializo las variables a utilizar.
// $strXML: Para concatenar los parámetros finales para el gráfico.
$strXML = "";
// Armo los parámetros para el gráfico. Todos estos datos se concatenan en una variable.
// Encabezado de la variable XML. Comienza con la etiqueta "Chart".
// caption: define el título del gráfico.
// bgColor: define el color de fondo que tendrá el gráfico.
// baseFontSize: Tamaño de la fuente que se usará en el gráfico.
// showValues: = 1 indica que se mostrarán los valores de cada barra. = 0 No mostrará los valores en el gráfico.
// xAxisName: define el texto que irá sobre el eje X. Abajo del gráfico. También está xAxisName.
$strXML = "<chart caption = 'Grafico: Acreditaciones $nom' bgColor='#CDDEE5' baseFontSize='12' showValues='1' xAxisName='Inscripciones' >";
// Genero los enlaces que irá en cada barra del gráfico.
// Llamo a una función javascript llamado "detalleAnios". También envio parámetros como el título, total en semestre 1 y total en semestre 2
// La suma de las variables total de los semestres, enviados como parámetros, es igual al total del Año en cuestión.
// La función javascript que recibe estos datos se encuentra en el archivo "js/ajax.js"
// La función javascript, lo que hace es enviar los parámetros a un archivo llamado "grafico2.php" para que genere el gráfico detalle.
// Una vez generado el gráfico detalle, se desplegará en el DIV "detalle_chart". Haciéndose ahora visible.

$linkinsc =  urlencode("\"\"");
$linkasis =  urlencode("\"\"");
$linkacred = urlencode("\"\"");
$linkprea = urlencode("\"\"");
// Armado de cada barra.
// set label: asigno el nombre de cada barra.
// value: asigno el valor para cada barra.
// color: color que tendrá cada barra. Si no lo defino, tomará colores por defecto.
// Asigno los enlaces para cada barra.
$strXML .= "<set label = 'Inscriptos' value ='".$insc."' color = 'EA1000' link = ".$linkinsc." />";
$strXML .= "<set label = 'Asistentes' value ='".$asis."' color = '6D8D16' link = ".$linkasis." />";
$strXML .= "<set label = 'Acreditados' value ='".$acred."' color = 'FFBA00' link = ".$linkacred." />";
$strXML .= "<set label = 'Preacreditados' value ='".$prea."' color = '0000FF' link = ".$linkprea." />";
// Cerramos la etiqueta "chart".
$strXML .= "</chart>";
// Por último imprimo el gráfico.
// renderChartHTML: función que se encuentra en el archivo FusionCharts.php
// Envía varios parámetros.
// 1er parámetro: indica la ruta y nombre del archivo "swf" que contiene el gráfico. En este caso Columnas ( barras) 3D
// 2do parámetro: indica el archivo "xml" a usarse para graficar. En este caso queda vacío "", ya que los parámetros lo pasamos por PHP.
// 3er parámetro: $strXML, es el archivo parámetro para el gráfico. 
// 4to parámetro: "ejemplo". Es el identificador del gráfico. Puede ser cualquier nombre.
// 5to y 6to parámetro: indica ancho y alto que tendrá el gráfico.
// 7mo parámetro: "false". Trata del "modo debug". No es im,portante en nuestro caso, pero pueden ponerlo a true ara probarlo.
echo "<table align='center'><tr><td>";
echo renderChartHTML("swf_charts/Column3D.swf", "",$strXML, "Inscripciones", 500, 500, false);
echo "</td></tr>";
include "librerias/closecon.php";
}
?>