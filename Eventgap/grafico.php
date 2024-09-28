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

// archivos incluidos. Librer�as PHP para poder graficar.


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


// Gr�fico de Barras. 4 Variables, 4 barras.
// Estas variables ser�n usadas para representar los valores de cada unas de las 4 barras.
// Inicializo las variables a utilizar.
// $strXML: Para concatenar los par�metros finales para el gr�fico.
$strXML = "";
// Armo los par�metros para el gr�fico. Todos estos datos se concatenan en una variable.
// Encabezado de la variable XML. Comienza con la etiqueta "Chart".
// caption: define el t�tulo del gr�fico.
// bgColor: define el color de fondo que tendr� el gr�fico.
// baseFontSize: Tama�o de la fuente que se usar� en el gr�fico.
// showValues: = 1 indica que se mostrar�n los valores de cada barra. = 0 No mostrar� los valores en el gr�fico.
// xAxisName: define el texto que ir� sobre el eje X. Abajo del gr�fico. Tambi�n est� xAxisName.
$strXML = "<chart caption = 'Grafico: Acreditaciones $nom' bgColor='#CDDEE5' baseFontSize='12' showValues='1' xAxisName='Inscripciones' >";
// Genero los enlaces que ir� en cada barra del gr�fico.
// Llamo a una funci�n javascript llamado "detalleAnios". Tambi�n envio par�metros como el t�tulo, total en semestre 1 y total en semestre 2
// La suma de las variables total de los semestres, enviados como par�metros, es igual al total del A�o en cuesti�n.
// La funci�n javascript que recibe estos datos se encuentra en el archivo "js/ajax.js"
// La funci�n javascript, lo que hace es enviar los par�metros a un archivo llamado "grafico2.php" para que genere el gr�fico detalle.
// Una vez generado el gr�fico detalle, se desplegar� en el DIV "detalle_chart". Haci�ndose ahora visible.

$linkinsc =  urlencode("\"\"");
$linkasis =  urlencode("\"\"");
$linkacred = urlencode("\"\"");
$linkprea = urlencode("\"\"");
// Armado de cada barra.
// set label: asigno el nombre de cada barra.
// value: asigno el valor para cada barra.
// color: color que tendr� cada barra. Si no lo defino, tomar� colores por defecto.
// Asigno los enlaces para cada barra.
$strXML .= "<set label = 'Inscriptos' value ='".$insc."' color = 'EA1000' link = ".$linkinsc." />";
$strXML .= "<set label = 'Asistentes' value ='".$asis."' color = '6D8D16' link = ".$linkasis." />";
$strXML .= "<set label = 'Acreditados' value ='".$acred."' color = 'FFBA00' link = ".$linkacred." />";
$strXML .= "<set label = 'Preacreditados' value ='".$prea."' color = '0000FF' link = ".$linkprea." />";
// Cerramos la etiqueta "chart".
$strXML .= "</chart>";
// Por �ltimo imprimo el gr�fico.
// renderChartHTML: funci�n que se encuentra en el archivo FusionCharts.php
// Env�a varios par�metros.
// 1er par�metro: indica la ruta y nombre del archivo "swf" que contiene el gr�fico. En este caso Columnas ( barras) 3D
// 2do par�metro: indica el archivo "xml" a usarse para graficar. En este caso queda vac�o "", ya que los par�metros lo pasamos por PHP.
// 3er par�metro: $strXML, es el archivo par�metro para el gr�fico. 
// 4to par�metro: "ejemplo". Es el identificador del gr�fico. Puede ser cualquier nombre.
// 5to y 6to par�metro: indica ancho y alto que tendr� el gr�fico.
// 7mo par�metro: "false". Trata del "modo debug". No es im,portante en nuestro caso, pero pueden ponerlo a true ara probarlo.
echo "<table align='center'><tr><td>";
echo renderChartHTML("swf_charts/Column3D.swf", "",$strXML, "Inscripciones", 500, 500, false);
echo "</td></tr>";
include "librerias/closecon.php";
}
?>