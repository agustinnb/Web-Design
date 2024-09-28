<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type='text/javascript' src='js/jquery-1.6.4.js'></script>
  
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
   
     <link rel="stylesheet" type="text/css" href="css/style.css">
    
      <script type='text/javascript' src="js/jquery-ui.js"></script>
      
<script type='text/javascript' src='js/scrolljs.js'></script>


  <style type="text/css">
body{
		border: 0;
	font-family: inherit;
	font-size: 100%;
	font-style: inherit;
	font-weight: inherit;
	background-color:#F2F2F2;
	margin: 0;
	outline: 0;
	padding: 0;
	vertical-align: baseline;
	margin-right:5%;
	margin-left:5%;
	margin-top:5%;
}
table#tablaprin{
	background-color:#FFF;
	border:double;
	border-color:#D9D9D9;
}

input#search1 {
	background: url(images/search.png) no-repeat 5px 6px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	font-size: 14px;
	height: 22px;
	line-height: 1.2em;
	padding: 4px 10px 4px 28px;
}
p, td#ano {
	color: #373737;
	font: 15px "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-weight: 300;
	line-height: 1.625;

}
h3 {
	font-family: Tahoma, Geneva, sans-serif; font-size: x-large;
}

h2 {
	font-family: Tahoma, Geneva, sans-serif; font-size: small;
}
td#footer, td#name, span#carac1, p#comdet {
		font-family: Tahoma, Geneva, sans-serif; font-size: small;
color: #C0C0C0;
}
textarea {
	font-family: Tahoma, Geneva, sans-serif; font-size: small;
overflow:auto;
	
}
a:link, a:visited { text-decoration: none; 
color: #C0C0C0;}
a:hover { text-decoration: none;
color: #C0C0C0; }
a#cerr {
	font-family: Tahoma, Geneva, sans-serif; font-size: 12;
	color: #C0C0C0;
}




</style>


<title>Proyecta V2</title>

</head>

<body>


<?php

// if (isset($_SESSION['user'])){


?>



<table id="tablaprin" width="926" align="center">
<tr><td colspan="2"><img src="images/banner.jpg" /></td></tr>
<tr><td valign="top" width="505"><img src="images/gPlus.png" /></td><td width="489" align="right" id="name">
<?php /*
if (isset($_SESSION['user'])){ */
?>
Bienvenido <b>PEPE<?php // echo $_SESSION['user']; ?></b><br />
<?php /* } */ ?>
<br /><input id="search1" name="search1" /></td></tr>
<tr><td valign="top">
<div id="ideas"  class="mousescroll">
<p>ACA VA UNA NOTICIA</p>

<p id="comdet">Subido el <b>27-07-2012</b> por <b></b><br />______________________________________</p>

<p>ACA VA UNA NOTICIA</p>

<p id="comdet">Subido el <b>27-07-2012</b> por <b>Smiley</b><br />______________________________________</p>


<p>ACA VA UNA NOTICIA DISTINTA A LA ANTERIOR NOTICIA PARA PROBAR A VER SI ESTA VERGA FUNCIONA COMO DEBERIA ESTAR FUNCIONANDO SUPERCALIFRAGILISTICAMENTE ESPIALIDOSO</p>

<p id="comdet">Subido el <b>27-07-2012</b> por <b>Smiley</b><br />______________________________________</p>
<p id='more'>Mostrar m&aacute;s</p>
</div>

</td>
<td align="right" valign="top">
<iframe frameborder="0" width="411" height="290" src="tag-cloud/index.html"></iframe>

</td>

</tr>
<tr>
  <td valign="top">
<?php /* if (isset($_SESSION['user'])){ */ ?>
  <form name="formcom" method="post">
<table width="502"><tr><td colspan="2">
<textarea name="idea" cols="80" rows="4" id="idea" onkeydown="textCounter()"></textarea>
</td></tr>
<tr>
<td width="234" align="left"><input type="submit" name="ingcom" value="Enviar" /></td><td width="256" id="ano" align="right"><input type="checkbox" name="anon"  align="right" />Anonimo</td>
</tr><tr>
<td colspan="2">
<span id="carac1">Caracteres restantes: <b id="carac2">140</b></span>
</td>
</tr>
</table>
</form>
<?php
 /* }
if (isset($_POST['ingcom'])){
mysql_connect("localhost","root","Trend123") or die("<tr><td align='center' colspan='2'>No me pude conectar a la DB 1</td></tr>");
mysql_select_db("dbProyecTA");

	$comment=trim($_POST['comment']);
	$anon=$_POST['anon'];
$palabras=split(" ",$comment);
$i=0;
for ($x=0;$x<count($palabras);$x++){
if (substr($palabras[$x],0,1)=="#"){
$hashtags[$i]=strtolower($palabras[$x]);
$i++;
}
}
if ($i==0){
echo "<tr><td align='center' colspan='2'>El post debe tener por lo menos un hashtag</td></tr>";
die();
}

for ($x=0;$x<count($hashtags);$x++){
$query="SELECT * FROM hashtags";
$result=mysql_query($query);
$bandera=true;
while ($row=mysql_fetch_assoc($result)){
if ($row['hashtag']==$hashtags[$x]){
$bandera=false;
}
}
if ($bandera==false){
$query="UPDATE hashtags SET contador = contador + 1 WHERE hashtag = '$hashtags[$x]'";
mysql_query($query) or die("<tr><td align='center' colspan='2'>No me pude conectar a la DB 3</td></tr>");
}else{
$query="INSERT INTO hashtags (hashtag,contador) VALUES ('$hashtags[$x]',1)";
mysql_query($query) or die("<tr><td align='center' colspan='2'>No me pude conectar a la DB 4</td></tr>");
}
}
$usuario=$_SESSION['user'];
$query="SELECT * FROM users WHERE user='$usuario'";
$result=mysql_query($query) or die("<tr><td align='center' colspan='2'>No me pude conectar a la DB 1</td></tr>");
$row=mysql_fetch_assoc($result);
mysql_close();
}
*/
?>
</td>
</tr>
<tr><td id="footer"  colspan="2">Trend Argentina S.A. Copyright 2012</td></tr>

</table>
<script type="text/javascript">
function textCounter() {
if (document.getElementById('comment').value.length < 140){
document.getElementById('carac2').innerHTML =  140 - document.getElementById('comment').value.length;
}else{ 
document.getElementById('carac2').innerHTML =  0;
document.getElementById('comment').innerHTML = document.getElementById('comment').innerHTML.substr(0,140);
if (window.event.keyCode != 8){
alert("No tiene más carácteres para utilizar");
}
} 
}</script>
<?php /*
}else{
	
	mysql_connect("localhost","root","Trend123") or die("<tr><td align='center' colspan='2'>No me pude conectar a la DB 1</td></tr>");
mysql_select_db("dbProyecTA");

$caracteres = 8;
$random_pass = substr(md5(rand()),0,$caracteres);

$query="INSERT INTO codigos (codigo) VALUES ('$random_pass')";
	mysql_query($query) or die ("ERROR INGRESANDO A LA DB");
	
?>

<div align="center"><APPLET CODE="LDAPcon.class" ARCHIVE= "JAR/LDAPcon.jar" WIDTH=300 HEIGHT=100>
<PARAM NAME="code1" VALUE="<?php echo $random_pass ?>">
<PARAM NAME="IP" VALUE="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
<PARAM NAME="DC" VALUE="10.0.0.20">
<PARAM NAME="IPSERVER" VALUE="10.0.0.61">
<PARAM NAME="IPPER" VALUE="10.0.0.*">
<PARAM NAME="DOM" VALUE="TRENDARGENTINA">
<PARAM NAME="PAGEOUT" VALUE="http://10.0.0.61/new/login.php">
</APPLET></div>
<div align="center">Si no puede ingresar a la p&aacute;gina, dirigase <a href="http://www.java.com/en/download/ie_manual.jsp?locale=en">Aqui</a>

<?php
} */
?>
</body>
</html>