<?php session_start();

if (isset($_SESSION['tk_username'])){ 
include "librerias/mysqlconnect.php";
$user=$_SESSION['tk_username'];
$query= "SELECT * FROM organizadores WHERE usuario= '$user'";
$result = mysql_query($query) or die ("Error buscando el usuario en la DB");
$raw=@mysql_fetch_assoc($result);
$id=$raw['id'];


if ($raw['rango']=='A' || $raw['rango']=='S'){
if (isset($_GET['id'])){
$idevent=$_GET['id'];
				}else{
					die(); }
if (isset($_GET['mod'])){
	$mod=$_GET['mod']; } else{
	die("Falta algun parametro");
	}

$query="SELECT * FROM organizadores where id=$mod";
$result=mysql_query($query) or die ("<tr><td align='center' class='bod'>Error.</td></tr>");
$i=0;
$rew=@mysql_fetch_assoc($result);
if ($rew['rango']!='A' && $rew['rango']!='S'){
$rangous=explode(";",$rew['rango']);
if ($rangous[1]==$id){
for ($x=2;$x<count($rangous);$x++){
	if ($rangous[$x]==$idevent){
	$rangous[$x]="";
	}
}
}
$rangonuevo="U;" . $rangous[1] . ";";
echo count($rangous);
for ($x=2;$x<count($rangous);$x++){
	if ($rangous[$x]!=""){
	$rangonuevo.=$rangous[$x].";";
	}
}

$rangoaver=explode(";",$rangonuevo);


if (count($rangoaver)-1==2){
$query="DELETE FROM organizadores WHERE id=$mod";
}else{
$query="UPDATE organizadores SET rango='$rangonuevo' WHERE id=$mod";
}
 mysql_query($query) or die ("Error actualizando el usuario");
/*

	$usuario=$_POST['usuarios'];
	$query="SELECT * FROM organizadores where usuario='$usuario'";
	$result=mysql_query($query);
	$ruw=@mysql_fetch_assoc($result);
	$rango=$ruw['rango'];
	$rango.=$idevent . ";";
	$query="UPDATE organizadores SET rango='$rango' WHERE usuario='$usuario'";
	mysql_query($query) or die ("Error actualizando la db"); */
	
 header("Location:principal.php");
}


}




} ?>
