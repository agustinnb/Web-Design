<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Random</title>
<style type="text/css">


<!--
.tit {font-family: Arial, Helvetica, sans-serif;
	}
.bod {font-family: Arial, Helvetica, sans-serif;
		font-size: 70px}
</style>
</head>

<body>


<?php 
include "librerias/mysqlconnect.php";
$query="SELECT * FROM IForo";
$result=mysql_query($query);
$i=0;
while ($row=@mysql_fetch_assoc($result)){
if (strtolower($row['campo_2'])!='aktio' && strtolower($row['campo_2'])!='ibm'){
$usuario[$i]=$row['id'] . " " .$row['campo_0'] . " " . $row['campo_1'];
$i++;
}
}


$random=$usuario[rand(0,$i)];
echo "<div align='center' class='bod'>Sorteo!</div><br /> <br />";
if (!(isset($_GET['id']))){
				  echo "<h1 align='center' class='tit'><a href='random.php?id=0'>INICIAR</a></h1>";
				  }else{
echo "<h1 align='center' class='tit'>" . utf8_decode($random) . "</h1>";

$id=$_GET['id'];
if ($id!=30){

	echo "<META HTTP-EQUIV=Refresh CONTENT='0.5; URL=random.php?id=". ($id+1) ."'>";
}

if ($id==30){
	  echo "<h1 align='center' class='tit'><a href='random.php'>REINICIAR</a></h1>";
}
				  }
include "librerias/closecon.php";

?>

</body>
</html>
