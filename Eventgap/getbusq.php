<?php
include "librerias/mysqlconnect.php";
$id=$_GET['id'];
$query="SELECT directivas, nomevent, cantcampos FROM eventos where id=$id";
$result=mysql_query($query);
$row=@mysql_fetch_assoc($result);
$dir=explode(";",$row['directivas']);
$cantcampos=$row['cantcampos'];
$nomevent=$row['nomevent'];
$i=0;
for ($x=0;$x<$cantcampos;$x++){
	$campo[$x]=$dir[$i];
	$tipovarcamp[$x]=$dir[$i+1];
	$i=$i+3;
}

$query="SELECT * FROM $nomevent";
$result=mysql_query($query);
$p=0;

while ($row2=@mysql_fetch_assoc($result)){

if ($_GET['busco']=="id" or $_GET['busco']=="all"){
$aUsers[$p]=$row2['id'];
$p++;
}

for ($x=0;$x<$cantcampos;$x++){
	if ($_GET['busco']=="all"){

if ($tipovarcamp[$x]==1){
$aUsers[$p]=$row2['campo_' . $x];

$p++;
}
if ($tipovarcamp[$x]==2){
$aUsers[$p]=$row2['campo_' . $x];

$p++;
}
if ($tipovarcamp[$x]==5){
$aUsers[$p]=$row2['campo_' . $x];

$p++;
}
if ($tipovarcamp[$x]==7){
$aUsers[$p]=$row2['campo_' . $x];

$p++;
}
if ($tipovarcamp[$x]==9){
$aUsers[$p]=$row2['campo_' . $x];

$p++;
}
}else{
if ($_GET['busco']=="campo_".$x){
$aUsers[$p]=$row2['campo_' . $x];

$p++;
}

}


}

}
echo ";";
for ($x=0;$x<$p;$x++){
	if (trim($aUsers[$x]!="") and trim($aUsers[$x])!="-1"){
echo $aUsers[$x] . ";";
					 }
}
include "librerias/closecon.php";
?>