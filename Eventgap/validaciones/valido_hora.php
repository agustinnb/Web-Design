<?php
if (isset($_REQUEST['horain'])){
$request = $_REQUEST['horain'];
}
if (isset($_REQUEST['horater'])){
	$request = $_REQUEST['horater'];
}
//sleep(2);
usleep(150000);

$i=0;
for ($x=24;$x<100;$x++){
for ($p=0;$p<100;$p++){
	if (strlen($p)==1){
	$p="0".$p;
	}
	$horasinvs[$i]=$x.":".$p;
	$i++;
}}
for ($x=0;$x<24;$x++){
for($p=60;$p<100;$p++){
if (strlen($x)==1){
	$x= "0".$x;
}
$horasinvs[$i]=$x.":".$p;
$i++;
}
}


$valid = 'true';
 foreach($horasinvs as $horainv) {
	if($horainv == $request )
		$valid = 'false';
}
echo $valid;
?>