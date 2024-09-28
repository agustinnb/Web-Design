<?php

//sleep(2);

/*
function diferencia_fechas($diferencia){
 $segundos = $diferencia % 60;
 $segundos = str_pad($segundos, 2, "0", STR_PAD_LEFT);
 $diferencia = floor($diferencia / 60);
 $minutos = $diferencia % 60;
 $minutos = str_pad($minutos, 2, "0", STR_PAD_LEFT);
 $diferencia = floor($diferencia / 60);
 $horas = $diferencia;
 $cadena = $horas.":".$minutos.":".$segundos;
 return $cadena;
}
$valid = 'true';
if (isset($_REQUEST['fechin'])){
$fechin=$_REQUEST['fechin'];	
}else{
exit(1);
}
if (isset($_REQUEST['fechter'])){
$fechter=$_REQUEST['fechter'];	
}else{
exit(1);
}
if (isset($_REQUEST['horain'])){
$horain=$_REQUEST['horain'];	
}else{
exit(1);
}
if (isset($_REQUEST['horater'])){
$horater=$_REQUEST['horater'];	
}else{
exit(1);
}
for ($x=0;$x<strlen($horain);$x++){
if (substr($horain,$x,1)=="_"){
exit(1);
}
}
for ($x=0;$x<strlen($horater);$x++){
if (substr($horater,$x,1)=="_"){
exit(1);
}
}
$horain2=explode(":",$horain);
if ($horain2[0]>23){
$request="La hora ingresada es invalida";
$valid="false";
}
if ($horain2[1]>59){
$request="La hora ingresada es invalida";
$valid="false";
}
$horater2=explode(":",$horater);
if ($horater2[0]>23){
$request="La hora ingresada es invalida";
$valid="false";
}
if ($horater2[1]>59){
$request="La hora ingresada es invalida";
$valid="false";
}

$fechin2=explode("-",$fechin);
$fechter2=explode("-",$fechin);

$timestamp1=mktime($horain2[0],$horain2[1],"00",$fechin2[1],$fechin2[2],$fechin2[0]);
$timestamp2=mktime($horater2[0],$horater2[1],"00",$fechter2[1],$fechter2[2],$fechter2[0]);
 $diferencia = $timestamp1 - $timestamp2;
  $resultado = diferencia_fechas($diferencia);
$request= $resultado;
$valid="false";
echo $valid; */
set_error_handler("customError"); 
function customError($errno, $errstr)
  {
  $valid='false';
	exit(1);
  } 
if (isset($_REQUEST['fechin'])){
$request = $_REQUEST['fechin'];
}
if (isset($_REQUEST['fechinsc'])){
$request = $_REQUEST['fechinsc'];
}
if (isset($_REQUEST['fechinscter'])){
$request = $_REQUEST['fechinscter'];
}
if (isset($_REQUEST['fechter'])){
	$request = $_REQUEST['fechter'];
}
$actual=date("Y-m-d");
$actual2=explode("-",$actual);
$anoact=$actual2[0];
$mesact=$actual2[1];
$diaact=$actual2[2];
$fechevent=explode("-",$request);

$valid="true";

if ($fechevent[0]<$anoact){
$valid = 'false';
}
if ($fechevent[0]==$anoact && $fechevent[1]<$mesact){
$valid = 'false';
}
if ($fechevent[0]==$anoact && $fechevent[1]==$mesact && $fechevent[2]<$diaact){
$valid = 'false';
}

if ($fechevent[0]>$anoact){
$valid = 'true';
}

if ($fechevent[0]>=$anoact && $fechevent[1]>=$mesact && $fechevent[2]>=$diaact){
$valid = 'true';
}

echo $valid;
/*
echo $totalact;
for ($x=1800;$x<$anoact+1;$x++){
	for ($p=1;$p<13;$p++){
		for ($h=1;$h<32;$h++){
			if (strlen($x)==1){
			$x= "000".$x;
			}
			if (strlen($x)==2){
			$x= "00".$x;
			}
			if (strlen($x)==3){
			$x= "0".$x;
			}
			if (strlen($p)==1){
			$p= "0".$p;
			}
			if (strlen($h)==1){
			$h= "0".$h;
			}
		
		if ($totalact!=$fechinvs[$i]){
			if ($x<$anoact){
		$fechinvs[$i]=$x."-".$p."-".$h;
		$i++;
			}
			if ($x==$anoact && $p<$mesact){
				$fechinvs[$i]=$x."-".$p."-".$h;
		$i++;
			}
			if ($x==$anoact & $p==$mesact && $h<$diaact){
											 $fechinvs[$i]=$x."-".$p."-".$h;
											$i++;
											   }
			
		}

		
		}
	}
}
for ($x=721000;$x<$i;$x++){
	echo $fechinvs[$x]."<br />";
}
/*
$valid = 'true';
foreach($users as $user) {
	if( strtolower($user) == $request )
		$valid = 'false';
}
echo $valid;
*/

?>