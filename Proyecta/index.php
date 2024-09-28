<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
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
div#error{
	color: #FF0000;
	font: 15px "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-weight: 300;
	line-height: 1.625;

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
div#ns{
margin-right:5px;
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
color: #C0C0C0;
cursor:pointer; }
a#cerr {
	font-family: Tahoma, Geneva, sans-serif; font-size: 12;
	color: #C0C0C0;
}


#ideas > div {
  overflow: hidden;
}
#ideas > .visible {
  visibility: visible;
  opacity: 1;
  /* When showing the content we only need to transition the
     opacity, and everything else should be applied instantly */
 -webkit-transition: opacity 2s linear;
  -moz-transition: opacity 2s linear;
  -o-transition: opacity 2s linear;
  transition: opacity 2s linear;
}
#ideas > .hidden {
  visibility: hidden;
  opacity: 0;
  /* When hiding the content we should delay the transition
     of the visibility value, so that it happens at the end
     of the opacity transition. Note that even though it works
     with visibility, the same trick doesn’t work with display,
     position, or height (barring a fixed height). */
  -webkit-transition: visibility 0s 2s, opacity 2s linear;
  -moz-transition: visibility 0s 2s, opacity 2s linear;
  -o-transition: visibility 0s 2s, opacity 2s linear;
  transition: visibility 0s 2s, opacity 2s linear;
}
#ideas > div > div {

}
/* Any formatting that results in the content taking up vertical
   space should be applied to the element’s content, not to
   the shown/hidden element itself, that that the element can
   collapse to a 0px height. */
/* We’re hiding the content with a negative top margin, after
   a 2s delay. We’re not using display:none or position:absolute
   because we can’t delay those. */

#ideas > .hidden > div {
  margin-top: -10000px;
  -webkit-transition: margin-top 0s 2s;
  -moz-transition: margin-top 0s 2s;
  -o-transition: margin-top 0s 2s;
  transition: margin-top 0s 2s;
} 
div#defaultideas > p {
margin-right: 5px;	
}












#defaultideas > div {
  overflow: hidden;
}
#defaultideas > .visible {
  visibility: visible;
  opacity: 1;
  /* When showing the content we only need to transition the
     opacity, and everything else should be applied instantly */
 -webkit-transition: opacity 2s linear;
  -moz-transition: opacity 2s linear;
  -o-transition: opacity 2s linear;
  transition: opacity 2s linear;
}
#defaultideas > .hidden {
  visibility: hidden;
  opacity: 0;
  /* When hiding the content we should delay the transition
     of the visibility value, so that it happens at the end
     of the opacity transition. Note that even though it works
     with visibility, the same trick doesn’t work with display,
     position, or height (barring a fixed height). */
  -webkit-transition: visibility 0s 2s, opacity 2s linear;
  -moz-transition: visibility 0s 2s, opacity 2s linear;
  -o-transition: visibility 0s 2s, opacity 2s linear;
  transition: visibility 0s 2s, opacity 2s linear;
}
#defaultideas > div > div {

}
/* Any formatting that results in the content taking up vertical
   space should be applied to the element’s content, not to
   the shown/hidden element itself, that that the element can
   collapse to a 0px height. */
/* We’re hiding the content with a negative top margin, after
   a 2s delay. We’re not using display:none or position:absolute
   because we can’t delay those. */

#defaultideas > .hidden > div {
  margin-top: -10000px;
  -webkit-transition: margin-top 0s 2s;
  -moz-transition: margin-top 0s 2s;
  -o-transition: margin-top 0s 2s;
  transition: margin-top 0s 2s;
} 
















</style>

<script type="text/javascript">
function textCounter() {
if (document.getElementById('ideatext').value.length < 140){
document.getElementById('carac2').innerHTML =  140 - document.getElementById('ideatext').value.length;
}else{ 
document.getElementById('carac2').innerHTML =  0;
document.getElementById('ideatext').value = document.getElementById('ideatext').value.substring(0,139);
if (window.event.keyCode != 8){
alert("No tiene más carácteres para utilizar");
}
} 
}
function trim (myString)
{
return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}

function busco(buscar){
	$('p#loading').html("<img src='img/ajax-loader.gif'>");
	document.getElementById('search1').value=buscar;
		var param=document.getElementById('search1').value;
		param = param.replace("#","(325)");
		  var saram="search=" + param;
		  	  if (trim(param)!=""){
       $('#defaultideas').load('search.php',saram,function(data){;$('p#loading').html("");$('div#ideas').html("");}).fadeIn("slow");
		  }
		
}



</script>

<title>Proyecta V2</title>

</head>

<body>


<?php
include_once 'dbcon.php';
if (isset($_SESSION['user'])){




?>



<table id="tablaprin" width="926" align="center">
<tr><td colspan="2"><img src="images/banner.jpg" /></td></tr>
<tr><td valign="top" width="505"><img src="images/gPlus.png" /></td><td width="489" align="right" id="name">
<?php 
if (isset($_SESSION['user'])){ 
?>
<div id="ns">Bienvenido <b><?php echo $_SESSION['user']; ?></b><br />
<?php  }  ?>
<br /><input id="search1" name="search1" /></div></td></tr>
<tr><td valign="top">
<div id="ideascon"  class="mousescroll">
<p align="center" id="loading"></p>

<div id='defaultideas'>
<?php
if (!isset($_GET['s'])){
$query=mysql_query("SELECT * FROM ideas ORDER BY id DESC LIMIT 3");
while($geteach=@mysql_fetch_array($query))
{

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
$getlastid=$geteach['id'];
}
}else{
	$s=$_GET['s'];
	$query=mysql_query("SELECT * FROM ideas WHERE IF(anon=0,CONCAT(idea, ' ',por, ' ',dia),CONCAT(idea, ' ' , 'Anonimo' , ' ',dia)) LIKE '%" . $s . "%' ORDER BY id DESC") or die("ERROR");
while($geteach=@mysql_fetch_array($query))
{

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
}

}
?>

<div id='ideas'></div>

<p id='more'>Mostrar m&aacute;s</p>

<!--  -->

</div>
</div>
</td>
<td align="right" valign="top">
<iframe id="tagcloud" frameborder="0" width="411" height="290" src="tag-cloud/index.php"></iframe>

</td>

</tr>
<tr>
  <td valign="top">
<?php if (isset($_SESSION['user'])){ ?>
  <form name="formidea">
<table width="502"><tr><td colspan="2">
<textarea name="ideatext" cols="80" rows="4" id="ideatext" onkeypress="textCounter()"></textarea>
</td></tr>
<tr>
<td width="234" align="left"><input type="button" id="inidea" name="inidea" value="Enviar" /></td><td width="256" id="ano" align="right"><input type="checkbox" name="anon" id="anon" align="right" />Anonimo</td>
</tr><tr>
<td colspan="2">
<span id="carac1">Caracteres restantes: <b id="carac2">140</b></span>
<div id="error"></div>
</td>
</tr>
</table>
</form>
<?php
 }
if (isset($_POST['ingcom'])){


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

?>
</td>
</tr>
<tr><td id="footer"  colspan="2">Trend Argentina S.A. Copyright 2012</td></tr>

</table>


<style>




body{background:url('img/bg-top.png');}
div#defaultquestions,div#ideas{width:550px;font-family:Tahoma,Arial;font-size:12px;text-align:left;}
p.posts{margin:3px;padding:10px;background:#F3FAFB;border-top:1px solid #EBF2F3;}
p.posts img{margin:right:5px;}
p#more{width:450px;height:15px;padding:5px;background:#DCDCDC;border:1px solid #AAC1EB;color:white;text-align:center;font-family:Tahoma,Arial;font-size:12px;font-weight:bold;margin-top:10px;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;cursor:pointer;}
p#more:hover{background:#ACAAAA;}
</style>

<script language='Javascript'>
var ptr=1;
$('p#more').click(function()
{
	
param="from="+ptr;
divptr="div"+ptr++;
$('div#ideas').append("<div class='hidden' id="+divptr+"></div>");

$('p#more').html("<img src='img/l.gif'>");
 var gdata = $.get('load.php',param,function(data){$('div#'+divptr).html(data);$('div.divptr').css({'borderLeft':'none'});$('p#more').html("show more");});
// document.querySelector('#ideas > #' + divptr).className='visible';
 // document.querySelector('#ideas > #' + divptr).className='visible';
  /*	function(data) {
        json = data;
        
    }
*/
//$('div#'+divptr).toggleClass('hidden visible');

 $.when(gdata).then(function(){ 
 document.querySelector('#ideas > #' + divptr).className='visible' });
// 
});
  



</script>


<script language='Javascript'>
var ptr2=1;
$('input#inidea').click(function()
{
	var rem = document.getElementById('ideatext').value;
	var rem2 = rem.split(" ");
	var bandera=0;
	for (var x=0;x<rem2.length;x++){
	if (rem2[x].substring(0,1)=="#"){
	bandera=1;
	break;
	}else{
	bandera=0;
	}
	}
	if (bandera==0){
	$('#error').html("Debe ingresar al menos un hashtag");
	}else{
	
	rem = rem.replace("#","(325)");
	param="ideatext="+ rem + "&user=<?php echo $_SESSION['user']; ?>"  + "&anon=" + document.getElementById('anon').checked;
divptr="div"+ptr2++;
$('div#defaultideas').prepend("<div class='hidden' id="+divptr+"></div>");
	$('p#loading').html("<img src='img/ajax-loader.gif'>");
$('p#more').html("<img src='img/l.gif'>");
 var gdata = $.get('addpost.php',param,function(data){$('div#'+divptr).html(data);$('p#more').html("show more");$('p#loading').html("");});
 $.when(gdata).then(function(){ 
 document.querySelector('#defaultideas > #' + divptr).className='visible'; document.querySelector('#ideatext').value=""; document.querySelector('#carac2').innerHTML = "140"; });

	}
	/*
param="from="+ptr;
divptr="div"+ptr++;

$('div#ideas').append("<div class='divptr' id="+divptr+"></div>");

divptr="div"+ptr++;
$('div#ideas').prepend("<div class='hidden' id="+divptr+"></div>");

$('p#more').html("<img src='img/l.gif'>");
 var gdata = $.get('load.php',param,function(data){$('div#'+divptr).html(data);$('div.divptr').css({'borderLeft':'none'});$('p#more').html("show more");});
 $.when(gdata).then(function(){ 
 document.querySelector('#ideas > #' + divptr).className='visible' });
*/
});
</script>




<?php 
}else{
	
	
$caracteres = 8;
$random_pass = substr(md5(rand()),0,$caracteres);

$query="INSERT INTO codigos (codigo) VALUES ('$random_pass')";
	mysql_query($query) or die ("ERROR INGRESANDO A LA DB");
	
?>

<div align="center"><APPLET CODE="LDAPcon.class" ARCHIVE= "JAR/LDAPcon.jar" WIDTH=300 HEIGHT=100>
<PARAM NAME="code1" VALUE="<?php echo $random_pass ?>">
<PARAM NAME="IP" VALUE="192.168.1.105"> <?php // echo $_SERVER['REMOTE_ADDR']; ?>
<PARAM NAME="DC" VALUE="192.168.1.100">
<PARAM NAME="IPSERVER" VALUE="192.168.1.105">
<PARAM NAME="IPPER" VALUE="192.168.1.*">
<PARAM NAME="DOM" VALUE="desktop">
<PARAM NAME="PAGEOUT" VALUE="http://localhost/proyecta/login.php">
</APPLET></div>
<div align="center">Si no puede ingresar a la p&aacute;gina, dirigase <a href="http://www.java.com/en/download/ie_manual.jsp?locale=en">Aqui</a>

<?php
} 
?>
<script type="text/javascript">
<?php echo "var glast=" . $geteach['id'] . ";"; ?>

var rel = new function(){
//  $('#defaultideas').load('loadintime.php').fadeIn("slow");

}
setInterval(document.getElementById('tagcloud').contentDocument.location.reload(true), 1000);

</script>
<script type="text/javascript">

$('#search1').keypress(function(event){
 
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		$('p#loading').html("<img src='img/ajax-loader.gif'>");
		var param=document.getElementById('search1').value;
		param = param.replace("#","(325)");
		  var saram="search=" + param;
		  	  if (trim(param)!=""){
       $('#defaultideas').load('search.php',saram,function(data){;$('p#loading').html("");$('div#ideas').html("");}).fadeIn("slow");
		  }
		  
	}
	event.stopPropagation();
});
/*
$('#search1').keypress(function(e){
   var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		alert('You pressed a "enter" key in textbox');
	/*	  var param=document.getElementById('search1').value;
		  var saram="search=" + param;
		  
		  if (trim(param)!=""){
       $('#defaultideas').load('search.php',param).fadeIn("slow");
		  }
	  */
/*   }
      }); */
	  </script>
</body>
</html>