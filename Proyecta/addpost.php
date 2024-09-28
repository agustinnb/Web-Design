<?php
include_once 'dbcon.php';
?>

<?php 
if (isset($_GET['ideatext'])){
if (isset($_GET['user'])){
if (isset($_GET['anon'])){
	$idea=$_GET['ideatext'];
	$user=$_GET['user'];
	if ($_GET['anon']=="true"){
	$anon=1;
	}else{
	$anon=0;
		}

		$comment=$idea;
		
	$palabras=explode(" ",$comment);
    $i=0;
for ($x=0;$x<count($palabras);$x++){
	
if (substr($palabras[$x],0,5)=="(325)"){
$hashtags[$i]=strtolower($palabras[$x]);
$i++;

}
}
if ($i==0){
echo "<p>El post debe tener por lo menos un hashtag</p>";
die();
}

for ($x=0;$x<count($hashtags);$x++){
$query="SELECT * FROM hashtags";
$result=mysql_query($query) or die("ERROR ACA");
$bandera=true;

while ($row=@mysql_fetch_assoc($result)){
if ($row['hashtag']==$hashtags[$x]){
$bandera=false;
}
}

if ($bandera==false){
$query="UPDATE hashtags SET contador = contador + 1 WHERE hashtag = '$hashtags[$x]'";
mysql_query($query) or die("<p>No me pude conectar a la DB 3</p>");
}else{
$query="INSERT INTO hashtags (hashtag,contador) VALUES ('$hashtags[$x]',1)";
mysql_query($query) or die("<tr><td align='center' colspan='2'>No me pude conectar a la DB 4</td></tr>");
}
}

$query="SELECT * FROM hashtags";
$result=@mysql_query($query);
$arch=fopen("tag-cloud/menu.xml","w");
fwrite($arch,'<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");
?>
<items>');
while ($row=@mysql_fetch_assoc($result)){
	
if ($row['contador']>10){
fwrite($arch,'<item link="../index.php?s=' . $row['hashtag'] . '">
		<![CDATA[ <h>' . str_replace("(325)","#",$row['hashtag']) . '</h>]]> 
	</item>');
}else if($row['contador']>5){
fwrite($arch,'<item link="../index.php?s=' . $row['hashtag'] . '">
		<![CDATA[ <m>' . str_replace("(325)","#",$row['hashtag']) . '</m>]]> 
	</item>');

}else{
fwrite($arch,'<item link="../index.php?s=' . $row['hashtag'] . '">
		<![CDATA[ <l>' . str_replace("(325)","#",$row['hashtag']) . '</l>]]> 
	</item>');

}
}
fwrite($arch,"</items>");
fclose($arch);		
		
		
		
	$date=date("Y-m-d");
$query="INSERT INTO ideas(idea,anon,por,dia) VALUES ('$idea',$anon,'$user','$date')";
mysql_query($query) or die("ERROR" . " " .  $query);




	













$query="SELECT * FROM ideas ORDER BY id DESC";
$p=0;
$result=mysql_query($query);
$geteach=@mysql_fetch_assoc($result);
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
sleep(1);
}}
}
mysql_close();
 ?>

