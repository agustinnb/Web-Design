<?php
include_once 'dbcon.php';
$search=trim($_GET['search']);
$query=mysql_query("SELECT * FROM ideas WHERE IF(anon=0,CONCAT(idea, ' ',por, ' ',dia),CONCAT(idea, ' ' , 'Anonimo' , ' ',dia)) LIKE '%" . $search . "%' ORDER BY id DESC") or die("ERROR");
while($geteach=@mysql_fetch_array($query))
{
echo "<p>";

$gidea=str_replace("(325)","#",$geteach['idea']);
$gpalabras=explode(" ",$gidea);
$gideadis="";
for ($x=0;$x<count($gpalabras);$x++){
if (substr($gpalabras[$x],0,1)=="#"){
$gpalabras[$x]="<a onclick=\"busco('" . $gpalabras[$x] . "')\">" . $gpalabras[$x] . "</a>";
}
$gideadis=$gideadis . $gpalabras[$x] . " ";
}
$gideadis=trim($gideadis);

echo "<p>".$gideadis."</p>";

if ($geteach['anon']==0){
echo "<p id='comdet'>Subido el <b><a onclick=\"busco('" . $geteach['dia'] .  "')\">" . $geteach['dia'] . "</a>" . "</b> por <b><a onclick=\"busco('" . $geteach['por'] .  "')\">" . $geteach['por'] . "</a>" . "</b><br />______________________________________</p>";
}else{
echo "<p id='comdet'>Subido el <b><a onclick=\"busco('" . $geteach['dia'] .  "')\">" . $geteach['dia'] . "</a>" . "</b> por <b><a onclick=\"busco('Anonimo')\">Anonimo</a>" . "</b><br />______________________________________</p>";
}
echo "</p>";
	
}
sleep(1);
?>