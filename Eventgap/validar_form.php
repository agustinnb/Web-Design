<?php 
			  echo "<table align='center'>";
include "librerias/mysqlconnect.php";
$nom=$_POST['nom'];
$fechin=$_POST['fechin'];
$fechter=$_POST['fechter'];
$horain=$_POST['horain'];
$horater=$_POST['horater'];
if (isset($_POST['fechins'])){
$fechinsc=$_POST['fechinsc'];
}else{
$fechinsc=date("Y-m-d");
}
if (isset($_POST['fechinscter'])){
$fechinscter=$_POST['fechinscter'];
}else{
$fechinscter=$fechin;
}
$cantmax=$_POST['cantmax'];
$ubic=$_POST['ubic'];
$campos=$_POST['campos'];
$nomevent=str_replace(" ","",$nom);
$nomevent=str_replace(";","",$nomevent);
$nom2=str_replace(" ","",$nom);

include "validaciones/diferencia_fechas.php";

$diain=explode("-",$fechin);
$diater=explode("-",$fechter);
$diainsc=explode("-",$fechinsc);
$diainscter=explode("-",$diainscter);
$horasin=explode(":",$horain);
$horaster=explode(":",$horater);

$timestamp1=mktime($horasin[0],$horasin[1],"00",$diain[1],$diain[2],$diain[0]);
$timestamp2=mktime($horaster[0],$horaster[1],"00",$diater[1],$diater[2],$diater[0]);
 $diferencia = $timestamp1 - $timestamp2;
  $resultado = diferencia_fechas($diferencia);
  echo "<tr><td class='error' align='center' colspan='4'>".$resultado."</td></tr>";

if ($nom2==""){
echo "<tr><td class='error' align='center' colspan='4'>No se ingreso un nombre para el evento</td></tr>";
exit(1);
}else{
	





if ($campos==0){

$nom=str_replace("á","&atilde;",$nom);
$nom=str_replace("Á","&Atilde;",$nom);
$nom=str_replace("é","&etilde;",$nom);
$nom=str_replace("É","&Etilde;",$nom);
$nom=str_replace("í","&itilde;",$nom);
$nom=str_replace("Í","&Itilde;",$nom);
$nom=str_replace("ó","&otilde;",$nom);
$nom=str_replace("Ó","&Otilde;",$nom);
$nom=str_replace("ú","&utilde;",$nom);
$nom=str_replace("Ú","&Utilde;",$nom);
$nom=str_replace("ñ","&ntilde;",$nom);
$nom=str_replace("Ñ","&Ntilde;",$nom);


// $query="CREATE TABLE $nomevent (id FLOAT NOT NULL AUTO_INCREMENT,nombre varchar(40) NOT NULL,apellido varchar(60) NOT NULL,empresa varchar(40) NOT NULL,cargo varchar(40) NOT NULL,direccion varchar(60) NOT NULL,pais varchar(60) NOT NULL,provincia varchar(60) NOT NULL,ciudad varchar(60) NOT NULL,telefono varchar(60) NOT NULL,email varchar(100) NOT NULL,email2 varchar(100) NOT NULL,fecha DATE NOT NULL,hora TIME NOT NULL,ip varchar(100) NOT NULL, inscripto INT NOT NULL, asistente INT NOT NULL, primary key(id))";
// mysql_query($query) or die ("Error creando la tabla del evento");
}else{
$campob=$_POST['campob'];
for ($x=0;$x<$campob;$x++){
	
	
$campo[$x]=$_POST['campo'.$x];
$tipovarcamp[$x]=$_POST['tipovar'.$x];
if (isset($_POST['optioncampo'.$x])){
	
$optioncamp[$x]=$_POST['optioncampo'.$x];
}else{
	
	$optioncamp[$x]=0;
}

$campo2[$x]=str_replace(" ","",$campo[$x]);
if ($campo2[$x]==""){
	echo "<tr><td class='error' align='center' colspan='4'>Alguno de los campos del evento esta vacio</td></tr>";
	die();
}
for ($i=0;$i<$x;$i++){
if ($campo2[$i]==$campo2[$x]){
echo "<tr><td class='error' align='center' colspan='4'>Alguno de los campos esta repetido</td></tr>";
die();
}
}

}

$campob=str_replace(" ","",$campob);
$nomevent=str_replace(" ","",$nom);
$campotot=explode(";",$campob);
/* 
$enviarcampos="Location:new_event.php?";
$enviarcampos .= "nomevent=$nomevent&";
for ($x=0;$x<count($campotot)-1;$x++){
$enviarcampos .= "campo$x=" . $campotot[$x] . "&";
}

$enviarcampos = substr($enviarcampos,0,strlen($enviarcampos)-1);
$enviarcampos .= "&cantcampos=";
$enviarcampos .= count($campotot)-1;
header($enviarcampos);

*/


 }
 include "librerias/closecon.php";

}
}
echo "<table>"; ?>