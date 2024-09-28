<?php
include "librerias/mysqlconnect.php";
$query="SELECT * FROM CIBRA10";
$result=mysql_query($query);
while ($row=@mysql_fetch_assoc($result)){
if (strlen($row['campo_2'])>34){
echo $row['id'] . " " . $row['campo_0'] . " " . $row['campo_1'] . " " . $row['campo_2'] . "<br />";
}
}
include "librerias/closecon.php";
?>