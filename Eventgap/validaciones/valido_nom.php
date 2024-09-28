<?php 
set_error_handler("customError"); 
function customError($errno, $errstr)
  {
  $valid='false';
  echo $errstr;
  echo $valid;
	exit(1);
  } 
if (isset($_GET['nom'])){
$request = trim(strtolower($_REQUEST['nom']));
}

//sleep(2);
//usleep(150000);



include "../librerias/mysqlconnect.php";

$query="SELECT nom FROM eventos";
$result=mysql_query($query);
$i=0;
$validonoms[0]="none";
while ($row=@mysql_fetch_assoc($result)){
	
	$validonoms[$i]=$row['nom'];
	$i++;

}

$valid = 'true';
foreach($validonoms as $validonom) {
if (strtolower($validonom)==$request){
						$valid='false';
						}

	$nomevent=str_replace(" ","",$validonom);
$nomevent=str_replace(";","",$nomevent);
$nomevent2=str_replace(" ","",$request);
$nomevent2=str_replace(";","",$nomevent2);
if (strtolower($nomevent)==$nomevent2){
$valid='false'; 
} 
 }

include "../librerias/closecon.php"; 
echo $valid;
?>