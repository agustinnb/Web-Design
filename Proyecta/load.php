<?php
include_once 'dbcon.php';
?>

<?php 
$from=$_GET['from']*3; ?>

<?php
$query=mysql_query("SELECT * FROM ideas ORDER BY id DESC LIMIT $from,3");
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