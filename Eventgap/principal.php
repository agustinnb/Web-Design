<?php session_start();

if (isset($_SESSION['tk_username'])){ 
include "librerias/mysqlconnect.php";
include "validaciones/diferencia_fechas.php";



function rmdirtree($dirname) { 
   if (is_dir($dirname)) {    //Operate on dirs only 
       $result=array(); 
       if (substr($dirname,-1)!='/') {$dirname.='/';}    //Append slash if necessary 
       $handle = opendir($dirname); 
       while (false !== ($file = readdir($handle))) { 
           if ($file!='.' && $file!= '..') {    //Ignore . and .. 
               $path = $dirname.$file; 
               if (is_dir($path)) {    //Recurse if subdir, Delete if file 
                   $result=array_merge($result,rmdirtree($path)); 
               }else{ 
                   unlink($path); 
                   $result[].=$path; 
               } 
           } 
       } 
       closedir($handle); 
       rmdir($dirname);    //Remove dir 
       $result[].=$dirname; 
       return $result;    //Return array of deleted items 
   }else{ 
       return false;    //Return false if attempting to operate on a file 
   } 
}  


$query="SELECT nomevent FROM eventos";
$result=mysql_query($query) or die ("Error borrando carpetas de eventos");
while ($row=@mysql_fetch_assoc($result)){
rmdirtree("tablasexcel" . $row['nomevent']);
}
unset($query);
mysql_free_result($result);
unset($row);



$user=$_SESSION['tk_username'];
$query= "SELECT * FROM organizadores WHERE usuario= '$user'";
$result = mysql_query($query) or die ("Error buscando el usuario en la DB");
$raw=@mysql_fetch_assoc($result);
$id=$raw['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Principal</title>
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" media="screen" href="librerias/css/others.css" />
<link rel="stylesheet" type="text/css" media="screen" href="librerias/css/chili.css" />
 <link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./greybox/";
    </script>

    <script type="text/javascript" src="greybox/AJS.js"></script>
    <script type="text/javascript" src="greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="greybox/gb_scripts.js"></script>
   
<script src="librerias/calendar.jsp" type="text/javascript"></script>
<script src="librerias/lib/jquery.js" type="text/javascript"></script>
<script src="librerias/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="librerias/js/jquery.maskedinput-1.0.js"></script>
<script type="text/javascript" src="librerias/js/ui.core.js"></script>
<script type="text/javascript" src="librerias/js/ui.accordion.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js" type="text/javascript"></script>
<style type="text/css">


<!--
body { font-size: 65.2%; }


.tit {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
}
.bod {font-family: Arial, Helvetica, sans-serif; 
		font-size: 12px}
		.error {font-family: Arial, Helvetica, sans-serif; 
		color: #FF0000;
		font-size: 9px;
		}
		.fc_main { background: #DDDDDD; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
#botonfechin { background:url('img/calendar_icon.jpg') no-repeat; border:none; width:35px; height:37px; }
#botonfechter { background:url('img/calendar_icon.jpg') no-repeat; border:none; width:35px; height:37px; }
#botonfechinsc { background:url('img/calendar_icon.jpg') no-repeat; border:none; width:35px; height:37px; }
#botonfechinscter { background:url('img/calendar_icon.jpg') no-repeat; border:none; width:35px; height:37px; }
#botonborrar { background:url('img/del.png') no-repeat; border:none; width:16px; height:16px; }
a:link {text-decoration: none}
a:visited {text-decoration: none}
#eventos { background-image:"img/bg.jpg"; }



</style>







<link rel="stylesheet" type="text/css" media="screen" href="style.css" />

<script type="text/javascript">





$(document).ready(function() {
						   
						  
						   $("#horain").mask("99:99");
						    $("#horater").mask("99:99");
					
				var accordion = $("#stepForm").accordion();
				
				var tabs = $("#tabs").tabs();
	var current = 0;		
	// validate signup form on keyup and submit
	var validator = $("#form_event").validate({
											  
		rules: {
	
			nom: {
				required: true,
				minlength: 2
							},
			ubic: {
				required: true,
				minlength: 2//,
	
			},
		fechin: {
				required: true,
				remote: "validaciones/valido_fechas.php"
			},
			fechter: {
				required: true,
				remote: "validaciones/valido_fechas.php"
			},
				fechinsc: {
				remote: "validaciones/valido_fechas.php"
			},
				fechinscter: {
				remote: "validaciones/valido_fechas.php"
			},
			horain: {
			required: true,
				remote: "validaciones/valido_hora.php"
			},
			horater: {
				required: true,
				remote: "validaciones/valido_hora.php"
		}
			/*,
			password: {
				required: true,
				minlength: 5
			},
			password_confirm: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true,
				remote: "emails.php"
			},
			dateformat: "required",
			terms: "required" */
		},
		messages: {

			nom: {
				required: "Ingrese el nombre del evento",
				minlength: jQuery.format("Ingrese al menos {0} caracteres")
	
			},
			ubic: {
				required: "Ingrese la ubicacion del evento",
				minlength: jQuery.format("Ingrese al menos {0} caracteres")
			},
			fechin: {
				required: "ingrese la fecha en la que comienza el evento",
				remote: "La fecha ingresada no es valida"
			},
			fechter: {
				required: "ingrese la fecha en la que termina el evento",
				remote: "La fecha ingresada no es valida"
			},
			fechinsc: "La fecha ingresada no es valida",
			fechinscter: "La fecha ingresada no es valida",
			horain: {
				required: "ingrese la hora en la que comienza el evento",
				remote: "La hora ingresada es invalida"
			},
				horater: {
				required: "ingrese la hora en la que comienza el evento",
				remote: "La hora ingresada es invalida"
			}
	
			
			/*,
			password: {
				required: "Provide a password",
				rangelength: jQuery.format("Enter at least {0} characters")
			},
			password_confirm: {
				required: "Repeat your password",
				minlength: jQuery.format("Enter at least {0} characters"),
				equalTo: "Enter the same password as above"
			},
			email: {
				required: "Please enter a valid email address",
				minlength: "Please enter a valid email address",
				remote: jQuery.format("{0} is already in use")
			},
			dateformat: "Choose your preferred dateformat",
			terms: " " */
		},
		// the errorPlacement has to take the table layout into account
		errorPlacement: function(error, element) {
			  
	   
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo( element.parent().next() );
		},
		// specifying a submitHandler prevents the default submit, good for the demo
	submitHandler: function() {
		if (document.getElementById('errorcant').style.visibility=='hidden'){
	document.getElementById('form_event').submit();
		}
	},  
		// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
			
		}
	});
	$("#sf2 .prevbutton").click(function(){
		accordion.accordion("activate", 0);
		current = 0;
	}); 
	$("#sf3 .prevbutton").click(function(){
		accordion.accordion("activate", 1);
		current = 1;
	}); 
	// these buttons all run the validation, overridden by specific targets above
	$(".open2").click(function() {
	  if (validator.form()) {
	    accordion.accordion("activate", 2);
	    current = 2;
	  }
	});
	$(".open1").click(function() {
	  if (validator.form()) {
	    accordion.accordion("activate", 1);
	    current = 1;
	  }
	});
	$(".open0").click(function() {
	  if (validator.form()) {
	    accordion.accordion("activate", 0);
	    current = 0;
	  }
	});
	
	// propose username by combining first- and lastname
/*	$("#username").focus(function() {
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		if(firstname && lastname && !this.value) {
			this.value = firstname + "." + lastname;
		}
	}); */
	// overwrite focusInvalid to activate tab with invalid elements
	
});









function OnlyNum(tfield) {
   var valid = "0123456789";
   var ok = "yes";
   var temp;
   for (var i=0; i<tfield.value.length; i++) {
    temp = "" + tfield.value.substring(i, i+1);
    if (valid.indexOf(temp) == "-1") ok = "no";
   }
   if (ok == "no") {
    document.getElementById('errorcant').style.visibility='visible';
    tfield.focus();
   }
   if (ok == "yes") {
	       document.getElementById('errorcant').style.visibility='hidden';
   }
}  




function habilita(form)
{
form.campob.disabled=false;
var cant = document.getElementById('campob').value;

for (i=0; i<cant; i++){
document.getElementById('camp'+i).style.visibility='visible';
document.getElementById('camp'+i).style.display="inherit";
cambiocamposvalor('1');

}
}

function deshabilita(form)
{
form.campob.disabled=true;
for (p=0;p<20;p++){
document.getElementById('camp'+p).style.visibility='hidden';	
document.getElementById('camp'+p).style.display="none";
cambiocamposvalor('0');
}
}


function showcamp(){
var cant = document.getElementById('campob').value;
for (i=0; i<cant; i++){
document.getElementById('camp'+i).style.visibility='visible';	
document.getElementById('camp'+i).style.display="inherit";

}
for (p=i;i<20;i++){
document.getElementById('camp'+i).style.visibility='hidden';
document.getElementById('camp'+i).style.display="none";

}


}



function Abrir_ventana (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=800, height=365, top=85, left=140";

window.open(pagina,"",opciones);
}


var camposvalor=0;

function cambiocamposvalor(getval){
if (parseInt(getval)==1){
camposvalor=1;
}else{
	camposvalor=0;
}
   var x=0;
	
if (camposvalor==1){
	var campimp="<table><tr><td>Elija los campos a imprimir:</td><td> <select name='campimpopt1'>";

	for (x=0;x<parseInt(document.getElementById('campob').value);x++){
	campimp= campimp + "<option name=campoa" + x  + " value=campoa" + x + ">" + document.getElementById('campo' + x).value + "</option>";
	}
	
	campimp= campimp + "</select></td><td>";
campimp = campimp + "<select name='campimpopt1_2'>";
	
	for (x=0;x<parseInt(document.getElementById('campob').value);x++){
	campimp= campimp + "<option name=campoa" + x  + " value=campoa" + x + ">" + document.getElementById('campo' + x).value + "</option>";
	}


campimp = campimp + "</select></td></tr>";
campimp = campimp + "<tr><td></td><td>";
campimp = campimp + "<select name='campimpopt1_3'>";


	for (x=0;x<parseInt(document.getElementById('campob').value);x++){
	campimp= campimp + "<option name=campoa" + x  + " value=campoa" + x + ">" + document.getElementById('campo' + x).value + "</option>";
	}




campimp = campimp + "</select></td></tr>";
campimp = campimp + "<tr><td></td><td>";
campimp = campimp + "<select name='campimpopt1_4'>";

	for (x=0;x<parseInt(document.getElementById('campob').value);x++){
	campimp= campimp + "<option name=campoa" + x  + " value=campoa" + x + ">" + document.getElementById('campo' + x).value + "</option>";
	}


campimp = campimp + "</select></td></tr>";
campimp = campimp + "</table>";
	
	document.getElementById('campimptd').innerHTML=campimp;
}else{


		var campimp="<table><tr><td>Elija los campos a imprimir:</td><td> <select name='campimpopt1_1'>";
		campimp= campimp + "<option selected='selected' name=campoa0"  + " value=campoa0" + ">" + "Nombre</option>";
		campimp= campimp + "<option name=campoa1"  + " value=campoa1" + ">" + "Apellido</option>";
		campimp= campimp + "<option name=campoa2"  + " value=campoa2" + ">" + "Empresa</option>";
		campimp= campimp + "<option name=campoa3"  + " value=campoa3" + ">" + "Cargo</option>";
		campimp= campimp + "<option name=campoa4"  + " value=campoa4" + ">" + "Direcci&oacute;n</option>";
		campimp= campimp + "<option name=campoa5"  + " value=campoa5" + ">" + "Pais</option>";
		campimp= campimp + "<option name=campoa6"  + " value=campoa6" + ">" + "Provincia</option>";
		campimp= campimp + "<option name=campoa7"  + " value=campoa7" + ">" + "Direcci&oacute;n</option>";
		campimp= campimp + "<option name=campoa8"  + " value=campoa8" + ">" + "Ciudad</option>";
		campimp= campimp + "<option name=campoa9"  + " value=campoa9" + ">" + "Tel&eacute;fono</option>";
		campimp= campimp + "<option name=campoa10"  + " value=campoa10" + ">" + "E-mail</option>";
		campimp= campimp + "<option name=campoa11"  + " value=campoa11" + ">" + "E-mail alternativo</option>";
campimp= campimp + "</select></td><td>";
campimp = campimp + "<select name='campimpopt1_2'>";
		campimp= campimp + "<option name=campoa0"  + " value=campoa0" + ">" + "Nombre</option>";
		campimp= campimp + "<option selected='selected' name=campoa1"  + " value=campoa1" + ">" + "Apellido</option>";
		campimp= campimp + "<option name=campoa2"  + " value=campoa2" + ">" + "Empresa</option>";
		campimp= campimp + "<option name=campoa3"  + " value=campoa3" + ">" + "Cargo</option>";
		campimp= campimp + "<option name=campoa4"  + " value=campoa4" + ">" + "Direcci&oacute;n</option>";
		campimp= campimp + "<option name=campoa5"  + " value=campoa5" + ">" + "Pais</option>";
		campimp= campimp + "<option name=campoa6"  + " value=campoa6" + ">" + "Provincia</option>";
		campimp= campimp + "<option name=campoa7"  + " value=campoa7" + ">" + "Direcci&oacute;n</option>";
		campimp= campimp + "<option name=campoa8"  + " value=campoa8" + ">" + "Ciudad</option>";
		campimp= campimp + "<option name=campoa9"  + " value=campoa9" + ">" + "Tel&eacute;fono</option>";
		campimp= campimp + "<option name=campoa10"  + " value=campoa10" + ">" + "E-mail</option>";
		campimp= campimp + "<option name=campoa11"  + " value=campoa11" + ">" + "E-mail alternativo</option>";
campimp = campimp + "</select></td></tr>";
campimp = campimp + "<tr><td></td><td>";
campimp = campimp + "<select name='campimpopt1_3'>";
		campimp= campimp + "<option name=campoa0"  + " value=campoa0" + ">" + "Nombre</option>";
		campimp= campimp + "<option name=campoa1"  + " value=campoa1" + ">" + "Apellido</option>";
		campimp= campimp + "<option selected='selected' name=campoa2"  + " value=campoa2" + ">" + "Empresa</option>";
		campimp= campimp + "<option name=campoa3"  + " value=campoa3" + ">" + "Cargo</option>";
		campimp= campimp + "<option name=campoa4"  + " value=campoa4" + ">" + "Direcci&oacute;n</option>";
		campimp= campimp + "<option name=campoa5"  + " value=campoa5" + ">" + "Pais</option>";
		campimp= campimp + "<option name=campoa6"  + " value=campoa6" + ">" + "Provincia</option>";
		campimp= campimp + "<option name=campoa7"  + " value=campoa7" + ">" + "Direcci&oacute;n</option>";
		campimp= campimp + "<option name=campoa8"  + " value=campoa8" + ">" + "Ciudad</option>";
		campimp= campimp + "<option name=campoa9"  + " value=campoa9" + ">" + "Tel&eacute;fono</option>";
		campimp= campimp + "<option name=campoa10"  + " value=campoa10" + ">" + "E-mail</option>";
		campimp= campimp + "<option name=campoa11"  + " value=campoa11" + ">" + "E-mail alternativo</option>";
campimp = campimp + "</select></td></tr>";
campimp = campimp + "<tr><td></td><td>";
campimp = campimp + "<select name='campimpopt1_4'>";
		campimp= campimp + "<option name=campoa0"  + " value=campoa0" + ">" + "Nombre</option>";
		campimp= campimp + "<option name=campoa1"  + " value=campoa1" + ">" + "Apellido</option>";
		campimp= campimp + "<option name=campoa2"  + " value=campoa2" + ">" + "Empresa</option>";
		campimp= campimp + "<option selected='selected' name=campoa3"  + " value=campoa3" + ">" + "Cargo</option>";
		campimp= campimp + "<option name=campoa4"  + " value=campoa4" + ">" + "Direcci&oacute;n</option>";
		campimp= campimp + "<option name=campoa5"  + " value=campoa5" + ">" + "Pais</option>";
		campimp= campimp + "<option name=campoa6"  + " value=campoa6" + ">" + "Provincia</option>";
		campimp= campimp + "<option name=campoa7"  + " value=campoa7" + ">" + "Direcci&oacute;n</option>";
		campimp= campimp + "<option name=campoa8"  + " value=campoa8" + ">" + "Ciudad</option>";
		campimp= campimp + "<option name=campoa9"  + " value=campoa9" + ">" + "Tel&eacute;fono</option>";
		campimp= campimp + "<option name=campoa10"  + " value=campoa10" + ">" + "E-mail</option>";
		campimp= campimp + "<option name=campoa11"  + " value=campoa11" + ">" + "E-mail alternativo</option>";
campimp = campimp + "</select></td></tr>";
campimp = campimp + "</table>";
	
	document.getElementById('campimptd').innerHTML=campimp;

}


/*


*/
}
function habilitacamposimp(){
document.getElementById('campimptd').style.visibility='visible';
document.getElementById('campimptd').style.display="inherit";
}
function deshabilitacamposimp(){
document.getElementById('campimptd').style.visibility='hidden';	
document.getElementById('campimptd').style.display="none";
}



</script>



</head>

<body>

	
	<div  id="tabs">
		<ul>
		<li><a href="#eventos">Eventos</a></li>
        
  <?php if ($raw['rango']=='A'||$raw['rango']=='S'){ echo "<li><a href='#crearevento'>Crear eventos</a></li>"; } ?>

	  </ul>
		
	
        <div style="background: url(img/bg.jpg) no-repeat top right;" id="eventos">


<p class="bod"><b>Eventos</b></p><p align="right" class="bod"><a href="logout.php">Cerrar sesion</a></p>
<?php if ($raw['rango']=='A' || $raw['rango']=='S'){
// echo "<p class='bod'><b><a href=crearevento.php>Crear nuevo evento</a></b></p>";
// echo "<tr><td class='bod' align='left'><b><a href=crearevento.php>Crear nuevo evento</a></b></td></tr>";
//}

?>

<?php
 if ($raw['rango']=='A'){
$query="SELECT * FROM eventos where organizador=$id";
 }
 if ($raw['rango']=='S'){
	 $query="SELECT * FROM eventos";
 }
$result=mysql_query($query);
$h=0;
while ($row=@mysql_fetch_assoc($result)){

$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechter=$row['fechter'];
$horater=$row['horater'];
$hter=explode(":",$horater);
$diater=explode("-",$fechter);
$timestamp1=mktime($hter[0],$hter[1],"00",$diater[1],$diater[2],$diater[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);
 $diferencia = $timestamp1 - $timestamp2;
  $resultado = diferencia_fechas($diferencia);
  $eventid=$row['id'];
  $nom=$row['nom'];
 
   $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);
   $asis=0;
  $insc=0;
  $p=0;
  $a=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  							if ($row2['asistente']==1){
								$asis++;
								}
								
								if ($row2['inscripto']==1){
								$insc++;
								}
								  if ($row2['asistente']==1 && $row2['inscripto']==1){
								  $p++;
								  }
								    if ($row2['asistente']==1 && $row2['inscripto']==0){
								  $a++;
								  }
								  }
								  




$query3="SELECT * FROM organizadores";
$result3=mysql_query($query3) or die ("<tr><td align='center' class='bod'>Error.</td></tr>");
$i=1;
while ($rew=mysql_fetch_assoc($result3)){
if ($rew['rango']!='A' && $rew['rango']!='S'){
$rangous=explode(";",$rew['rango']);

if ($rangous[1]==$id){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$eventid){
$moderador[$i]=$rew['usuario'];
$moderadorid[$i]=$rew['id'];
$i++;
}
}
}
}
}







								  
								  
								  
  if ($resultado<0){
	  if ($h==0){
	echo "<p class='bod'><b>Eventos realizados</b></p>";
	  echo "<p><table><tr><td align='center' class='bod'>Nombre</td><td  class='bod' align='center'>Asistentes</td><td  class='bod' align='center'>Inscriptos</td><td  class='bod' align='center'>Acreditados</td><td  class='bod' align='center'>Pre-acreditados</td><td align='center'  class='bod'>Estadisticas</td><td  class='bod' align='center'>Moderadores</td></tr>";
	  $h++;
	  }
  echo "<tr valign='top'><td rowspan='$i' class='bod'>" . utf8_decode($nom) . "</td><td rowspan='$i'  class='bod' align='center'>$asis (<a href='mostrar.php?id=$eventid&mos=asistentes' rel='gb_page_fs[]'>Mostrar</a>)</td><td rowspan='$i'  class='bod' align='center'>$insc (<a href='mostrar.php?id=$eventid&mos=inscriptos' rel='gb_page_fs[]'>Mostrar</a>)</td><td rowspan='$i'  class='bod' align='center'>$a (<a href='mostrar.php?id=$eventid&mos=acreditados' rel='gb_page_fs[]'>Mostrar</a>)</td><td rowspan='$i'  class='bod' rowspan='$i' align='center'>$p (<a href='mostrar.php?id=$eventid&mos=preacreditados' rel='gb_page_fs[]'>Mostrar</a>)</td><td rowspan='$i'  class='bod'  align='center'><a href='grafico.php?nomevent=$nomevent' rel='gb_page_center[650, 650]' title='Grafico'><img border='0' src='img/stat.png'></a></td><td    class='bod' align='center'></td></tr>";
   for ($x=1;$x<$i;$x++){
  echo "<tr><td class='bod' align='center'>$moderador[$x]<a href='borrarmod.php?mod=$moderadorid[$x]&id=$eventid'><img src='img/del.png' border='0' /></a></td></tr>";
  }

  }
}
echo "</table></p>";








 if ($raw['rango']=='A'){
$query="SELECT * FROM eventos where organizador=$id";
 }
 if ($raw['rango']=='S'){
	 $query="SELECT * FROM eventos";
 }
$result=mysql_query($query);
$h=0;
while ($row=@mysql_fetch_assoc($result)){


$fechinscter=$row['fechinscter'];
$fechinsc=$row['fechinsc'];
$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechin=$row['fechin'];
$fechter=$row['fechter'];
$horater=$row['horater'];
$horain=$row['horain'];
$hter=explode(":",$horater);
$hin=explode(":",$horain);
$diain=explode("-",$fechin);
$diater=explode("-",$fechter);
$timestamp1=mktime($hter[0],$hter[1],"00",$diater[1],$diater[2],$diater[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);
$timestamp3=mktime($hin[0],$hin[1],"00",$diain[1],$diain[2],$diain[0]);
 $diferencia = $timestamp1 - $timestamp2;
 $diferencia2= $timestamp3 - $timestamp2;
 $resultado2=diferencia_fechas($diferencia2);
  $resultado = diferencia_fechas($diferencia);
  $eventid=$row['id'];
  $nom=$row['nom'];

  $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);
  
  $p=0;
  $a=0;
  $asis=0;
  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  							  if ($row2['asistente']==1){
								  $asis++;
								  }
								    if ($row2['inscripto']==1){
								  $insc++;
								  }
								  if ($row2['asistente']==1 && $row2['inscripto']==1){
								  $p++;
								  }
								    if ($row2['asistente']==1 && $row2['inscripto']==0){
								  $a++;
								  }
								  }





$query3="SELECT * FROM organizadores";
$result3=mysql_query($query3) or die ("<tr><td align='center' class='bod'>Error.</td></tr>");
$i=1;
while ($rew=mysql_fetch_assoc($result3)){
if ($rew['rango']!='A' && $rew['rango']!='S'){
$rangous=explode(";",$rew['rango']);

if ($rangous[1]==$id){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$eventid){
$moderador[$i]=$rew['usuario'];
$moderadorid[$i]=$rew['id'];
$i++;
}
}
}
}
}






  if ($resultado>0 && $resultado2<0){
	  if ($h==0){
	echo "<p class='bod'><b>Eventos en curso</b></p>";
	  echo "<p class='bod'><table><tr><td align='center' class='bod'>Nombre</td><td  class='bod' align='center'>Asistentes</td><td  class='bod' align='center'>Inscriptos</td><td  class='bod' align='center'>Acreditados</td><td  class='bod' align='center'>Pre-acreditados</td><td align='center'  class='bod'>Estadisticas</td><td  class='bod' align='center'>Moderar</td><td  class='bod' align='center'>Moderadores</td><td class='bod' align='center'>Impresion masiva <b>(OJO)</b></td></tr>";
	$h++;
	  }
  echo "<tr valign='top'><td rowspan='$i'  class='bod'>" . utf8_decode($nom) . "</td><td rowspan='$i'  class='bod' align='center'>$asis (<a href='mostrar.php?id=$eventid&mos=asistentes' title='Mostrar asistentes'  rel='gb_page_fs[]'>Mostrar</a>)</td><td rowspan='$i'   class='bod' align='center'>$insc (<a href='mostrar.php?id=$eventid&mos=inscriptos' title='Mostrar inscriptos' rel='gb_page_fs[]'>Mostrar</a>)<td rowspan='$i'   class='bod' align='center'>$a (<a href='mostrar.php?id=$eventid&mos=acreditados' title='Mostrar acreditados'  rel='gb_page_fs[]'>Mostrar</a>)</td><td rowspan='$i'   class='bod' align='center'>$p (<a href='mostrar.php?id=$eventid&mos=preacreditados' title='Mostrar preacreditados'  rel='gb_page_fs[]'>Mostrar</a>)</td><td rowspan='$i'  class='bod'  align='center'><a href='grafico.php?nomevent=$nomevent' rel='gb_page_center[650, 650]' title='Grafico'><img border='0' src='img/stat.png'></a></td><td rowspan='$i'   class='bod' align='center'><a href='moderar.php?id=$eventid'  rel='gb_page_fs[]' title='Moderar evento'><img border='0' src='img/edit.png' /></a></td><td    class='bod' align='center'><a href='addmod.php?id=$eventid'  rel='gb_page_center[300, 200]' title='Agregar moderador'>Agregar moderador</a></td><td rowspan='$i'   class='bod' align='center'><a href='imprimirmas.php?id=$eventid' title='Impresion masiva'  rel='gb_page_fs[]'><img src='img/imprimir.jpg' border='0' /></a></td></tr>";
  for ($x=1;$x<$i;$x++){
  echo "<tr><td class='bod' align='center'>$moderador[$x]<a href='borrarmod.php?mod=$moderadorid[$x]&id=$eventid'><img src='img/del.png' border='0' /></a></td></tr>";
  }

 }

}
 echo "</table></p>";



 if ($raw['rango']=='A'){
$query="SELECT * FROM eventos where organizador=$id";
 }
 if ($raw['rango']=='S'){
	 $query="SELECT * FROM eventos";
 }
$result=mysql_query($query);
$p=0;
while ($row=@mysql_fetch_assoc($result)){

$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechinscter=$row['fechinscter'];
$fechinsc=$row['fechinsc'];
$fechin=$row['fechin'];
$fechter=$row['fechter'];
$horater=$row['horater'];
$horain=$row['horain'];
  $eventid=$row['id'];
$hter=explode(":",$horater);
$hin=explode(":",$horain);
$diain=explode("-",$fechin);
$timestamp1=mktime($hin[0],$hin[1],"00",$diain[1],$diain[2],$diain[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);

 $diferencia = $timestamp1 - $timestamp2;

  $resultado = diferencia_fechas($diferencia);
  $nom=$row['nom'];
  $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);

  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){

								    if ($row2['inscripto']==1){
								  $insc++;
								  }
							
								  }
  
  
  
  
$query3="SELECT * FROM organizadores";
$result3=mysql_query($query3) or die ("<tr><td align='center' class='bod'>Error.</td></tr>");
$i=1;
while ($rew=mysql_fetch_assoc($result3)){
if ($rew['rango']!='A' && $rew['rango']!='S'){
$rangous=explode(";",$rew['rango']);

if ($rangous[1]==$id){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$eventid){
$moderador[$i]=$rew['usuario'];
$moderadorid[$i]=$rew['id'];
$i++;
}
}
}
}
} 
 
  
  
  
  
  
  if ($resultado>0){
	  if ($p==0){
	echo "<p class='bod'><b>Eventos a realizar</b></p>";
	  echo "<p class='bod'><table><tr><td align='center' class='bod'>Nombre</td><td  class='bod' align='center'>Inscriptos</td><td  class='bod' align='center'>Moderadores</td><td class='bod' align='center'>Impresion masiva <b>(OJO)</b></td></tr>";
	$p++;
	  }
  echo "<tr valign='top'><td rowspan='$i' class='bod'>$nom</td><td rowspan='$i'  class='bod' align='center'>$insc (<a href='mostrar.php?id=$eventid&mos=inscriptos' rel='gb_page_fs[]'>Mostrar</a>)<td    class='bod' align='center'><a href='addmod.php?id=$eventid' rel='gb_page_center[300, 200]'>Agregar moderador</a></td><td rowspan='$i'   class='bod' align='center'><a href='imprimirmas.php?id=$eventid' title='Impresion masiva'  rel='gb_page_fs[]'><img src='img/imprimir.jpg' border='0' /></a></td></tr>";
    for ($x=1;$x<$i;$x++){
  echo "<tr><td class='bod' align='center'>$moderador[$x]<a href='borrarmod.php?mod=$moderadorid[$x]&id=$eventid'><img src='img/del.png' border='0' /></a></td></tr>";
  }

 }

}
 echo "</table></p>";
 }else{
 $rangous=explode(";",$raw['rango']);
 $idorg=$rangous[1];
 
 
 $query="SELECT * from eventos where organizador=$idorg";
 
 
 $result=mysql_query($query);
   
$h=0;
while ($row=@mysql_fetch_assoc($result)){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$row['id']){
$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechter=$row['fechter'];
$horater=$row['horater'];
$hter=explode(":",$horater);
$diater=explode("-",$fechter);
$timestamp1=mktime($hter[0],$hter[1],"00",$diater[1],$diater[2],$diater[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);
 $diferencia = $timestamp1 - $timestamp2;
  $resultado = diferencia_fechas($diferencia);
  $eventid=$row['id'];
  $nom=$row['nom'];

   $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);

  $p=0;
  $a=0;
  $asis=0;
  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  							  if ($row2['asistente']==1){
								  $asis++;
								  }
								    if ($row2['inscripto']==1){
								  $insc++;
								  }
								  if ($row2['asistente']==1 && $row2['inscripto']==1){
								  $p++;
								  }
								    if ($row2['asistente']==1 && $row2['inscripto']==0){
								  $a++;
								  }
								  }



						  
								  
								  
  if ($resultado<0){
	  if ($h==0){
	echo "<p class=bod><b>Eventos realizados</b></p>";
	  echo "<p><table><tr><td align='center' class='bod'>Nombre</td><td  class='bod' align='center'>Asistentes</td><td  class='bod' align='center'>Inscriptos</td><td  class='bod' align='center'>Acreditados</td><td  class='bod' align='center'>Pre-acreditados</td></tr>";
	  $h++;
	  }
  echo "<tr valign='top'><td class='bod'>" . utf8_decode($nom) . "</td><td class='bod' align='center'>$asis </td><td class='bod' align='center'>$insc </td><td  class='bod' align='center'>$a</td><td  class='bod'  align='center'>$p</td><td    class='bod' align='center'></td></tr>";


  }
  }
  
}
}
echo "</table></p>";

 
 
 
 
 
 
 
 
 
 
 
 
 
$query="SELECT * from eventos where organizador=$idorg";
$result=mysql_query($query);
$h=0;
while ($row=@mysql_fetch_assoc($result)){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$row['id']){

$fechinscter=$row['fechinscter'];
$fechinsc=$row['fechinsc'];
$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechin=$row['fechin'];
$fechter=$row['fechter'];
$horater=$row['horater'];
$horain=$row['horain'];
$hter=explode(":",$horater);
$hin=explode(":",$horain);
$diain=explode("-",$fechin);
$diater=explode("-",$fechter);
$timestamp1=mktime($hter[0],$hter[1],"00",$diater[1],$diater[2],$diater[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);
$timestamp3=mktime($hin[0],$hin[1],"00",$diain[1],$diain[2],$diain[0]);
 $diferencia = $timestamp1 - $timestamp2;
 $diferencia2= $timestamp3 - $timestamp2;
 $resultado2=diferencia_fechas($diferencia2);
  $resultado = diferencia_fechas($diferencia);
  $eventid=$row['id'];
  $nom=$row['nom'];

  $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);
  
 $p=0;
  $a=0;
  $asis=0;
  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  							  if ($row2['asistente']==1){
								  $asis++;
								  }
								    if ($row2['inscripto']==1){
								  $insc++;
								  }
								  if ($row2['asistente']==1 && $row2['inscripto']==1){
								  $p++;
								  }
								    if ($row2['asistente']==1 && $row2['inscripto']==0){
								  $a++;
								  }
								  }



  if ($resultado>0 && $resultado2<0){
	  if ($h==0){
	echo "<p class='bod'><b>Eventos en curso</b></p>";
	  echo "<p><table><tr><td align='center' class='bod'>Nombre</td><td  class='bod' align='center'>Asistentes</td><td  class='bod' align='center'>Inscriptos</td><td  class='bod' align='center'>Acreditados</td><td  class='bod' align='center'>Pre-acreditados</td><td  class='bod' align='center'>Moderar</td></tr>";
	$h++;
	  }
  echo "<tr valign='top'><td class='bod'>" . utf8_decode($nom) . "</td><td  class='bod' align='center'>$asis</td><td class='bod' align='center'>$insc<td class='bod' align='center'>$a </td><td  class='bod' align='center'>$p</td><td class='bod' align='center'><a href='moderar.php?id=$eventid' rel='gb_page_fs[]'><img border='0' src='img/edit.png' /></a></td></tr>";


 }
}

}

}
echo "</table></p>";


 
 
 
 
 
 
 
 $query="SELECT * from eventos where organizador=$idorg";
$result=mysql_query($query);
$p=0;
while ($row=@mysql_fetch_assoc($result)){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$row['id']){
$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechinscter=$row['fechinscter'];
$fechinsc=$row['fechinsc'];
$fechin=$row['fechin'];
$fechter=$row['fechter'];
$horater=$row['horater'];
$horain=$row['horain'];
  $eventid=$row['id'];
$hter=explode(":",$horater);
$hin=explode(":",$horain);
$diain=explode("-",$fechin);
$timestamp1=mktime($hin[0],$hin[1],"00",$diain[1],$diain[2],$diain[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);

 $diferencia = $timestamp1 - $timestamp2;

  $resultado = diferencia_fechas($diferencia);
  $nom=$row['nom'];

  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  						
								    if ($row2['inscripto']==1){
								  $insc++;
								  }
						
								  }
  
  
  
  
  
  
  if ($resultado>0){
	  if ($p==0){
	echo "<p class='bod'><b>Eventos a realizar</b></p>";
	  echo "<p><table><tr><td align='center' class='bod'>Nombre</td><td  class='bod' align='center'>Inscriptos</td></tr>";
	$p++;
	  }
  echo "<tr valign='top'><td class='bod'>" . utf8_decode($nom) . "</td><td class='bod' align='center'>$insc</td></tr>";


 }
}

}

}
echo "</table></p>";
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 }

?>


</div>


<?php 
$query= "SELECT * FROM organizadores WHERE usuario= '$user'";
$result = mysql_query($query) or die ("Error buscando el usuario en la DB");
$raw=@mysql_fetch_assoc($result);
if ($raw['rango']=="A" || $raw['rango']=="S"){
	$id=$raw['id'];
?>







<div align="center" id="crearevento">
<form name="form_event" autocomplete="off" id="form_event" method="post" action="">
<ul id="stepForm" class="ui-accordion-container">
	<li id="sf1"><a href='#' class="ui-accordion-link"> </a>
<div>

        <table align="center">
          <tr>
            <td align="center" colspan="4" class="tit"><b>Crear nuevo evento</b></td>
          </tr>
          <tr>
            <td class="bod"><label id="lnom" for="nom">Nombre del evento (*):</label></td>
            <td class="bod"><input id="nom" name="nom"  <?php if (isset($_GET['nom'])){ $nom=$_GET['nom']; echo "value='$nom'"; } ?> type="text" maxlength="100" /></td>
            <td class="bod" colspan="2"></td>
          </tr>
          <tr>
            <td  class="bod"><label id="lfechin" for="fechin">Fecha de inicio (aaaa-mm-dd) (*):</label></td>
            <td  class="bod"><input size="10" <?php if (isset($_GET['fechin'])){ $fechin=$_GET['fechin']; echo "value='$fechin'"; } ?> class="bod" id="fc_1286208765" type="text" readonly="readonly" name="fechin" title="YYYY-MM-DD" />
              <input type="button" value="=" name="botonfechin" id="botonfechin" onclick="displayCalendarFor('fc_1286208765');" /></td> <td class="bod" colspan="2"></td>
          </tr>
          <tr>
            <td  class="bod"><label id="lfechter" for="fechter">Fecha de termino (aaaa-mm-dd) (*):</label></td>
            <td class="bod"><input size="10" <?php if (isset($_GET['fechter'])){ $fechter=$_GET['fechter']; echo "value='$fechter'"; } ?> class="bod" id="fc_1286208766" type="text" readonly="readonly" name="fechter" title="YYYY-MM-DD" />
              <input type="button" value="=" name="botonfechter" id="botonfechter" onclick="displayCalendarFor('fc_1286208766');" /></td> <td class="bod" colspan="2"></td>
          </tr>
          <tr>
            <td  class="bod"><label id="lhorain" for="horain">Hora de inicio (hh:mm) (*):</label></td>
            <td  class="bod"><input type="text" <?php if (isset($_GET['horain'])){ $horain=substr($_GET['horain'],0,5); echo "value='$horain'"; } ?> name="horain" class="bod" id="horain" size="3" maxlength="5" value="" /></td><td class="bod" colspan="2"></td>
          </tr>
          <tr>
            <td  class="bod"><label id="lhorater" for="horater">Hora de termino (hh:mm) (*):</label></td>
            <td class="bod"><input name="horater" <?php if (isset($_GET['horater'])){ $horater=substr($_GET['horater'],0,5); echo "value='$horater'"; } ?> class="bod" id="horater" size="3" maxlength="5" value="" /></td><td class="bod" colspan="2"></td>
          </tr>
          <tr>
            <td  class="bod">Fecha de inicio de inscripci&oacute;n (aaaa-mm-dd):</td>
            <td  class="bod"><input size="10" readonly="readonly" class="bod" id="fc_1286208767" type="text" name="fechinsc" title="YYYY-MM-DD" />
              <input type="button" value="=" name="botonfechinsc" id="botonfechinsc"  onclick="displayCalendarFor('fc_1286208767');" /></td><td align="left"> <input type="button" class="bod" name="botonborrar" id="botonborrar" onclick="javascript:getElementById('fc_1286208767').value='';" /></td><td class="bod"></td>
          </tr>
          <tr>
            <td  class="bod">Fecha de fin de inscripci&oacute;n (aaaa-mm-dd):</td>
            <td class="bod"><input name="fechinscter" type="text" class="bod" id="fc_1286208768" title="YYYY-MM-DD" size="10" readonly="readonly" />
            <input type="button" value="=" name="botonfechinscter" id="botonfechinscter" onclick="displayCalendarFor('fc_1286208768');" /></td><td align="left"> <input type="button" id="botonborrar" name="botonborrar"  class="bod" onclick="javascript:getElementById('fc_1286208768').value='';" /></td><td class="bod"></td>
          </tr>
          <tr>
            <td  class="bod">Ubicaci&oacute;n del evento (*):</td>
            <td   class="bod"><input name="ubic" <?php if (isset($_GET['ubic'])){ $ubic=$_GET['ubic']; echo "value='$ubic'"; } ?> class="bod" id="ubic" maxlength="100" /></td>
            <td colspan="2" class="bod"></td>
          </tr>
          <tr>
            <td  class="bod">Cantidad m&aacute;xima de inscriptos:</td>
            <td  class="plugin">
              <span class="plugin">
              <input onchange="javascript:OnlyNum(this);" name="cantmax" class="bod" id="cantmax" size="2" maxlength="5" />
            </span></td>
            <td colspan="2" id="errorcant" style="visibility:hidden; font-size: 9px;" class="plugin" >Por favor ingrese numeros validos</td>
          </tr>
          <tr></tr>
          <tr>
            <td colspan="4" class="bod"><b>Campos</b></td>
          </tr>
          <tr>
            <td colspan="4"  class="bod">Usar los campos preestablecidos (ver)
              <input type="radio" name="campos" id="campos" value="0" <?php if (!(isset($_GET['nom']))){ echo "checked";  } ?> onclick="deshabilita(this.form)" /></td>
          </tr>
          <tr>
            <td colspan="4" class="bod">Personalizar los campos
              <input type="radio" name="campos" id="campos" <?php if (isset($_GET['nom'])){ echo "checked";  } ?>  value="1" onclick="habilita(this.form)" /></td>
          </tr>
          <tr>
            <td colspan="5" class="bod">Cantidad de campos<select name="campob" <?php if (!(isset($_GET['nom']))){ echo "disabled='disabled'";  } ?>  id="campob" onchange="showcamp()">
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==1) { echo "selected='selected'"; }} ?> value="1">1</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==2) { echo "selected='selected'"; }} ?> value="2">2</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==3) { echo "selected='selected'"; }} ?> value="3">3</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==4)  { echo "selected='selected'"; }} ?> value="4">4</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==5) { echo "selected='selected'"; }} ?> value="5">5</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==6) { echo "selected='selected'"; }} ?> value="6">6</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==7) { echo "selected='selected'"; }} ?> value="7">7</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==8) { echo "selected='selected'"; }} ?> value="8">8</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==9) { echo "selected='selected'"; }} ?> value="9">9</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==10) { echo "selected='selected'"; }} ?> value="10">10</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==11) { echo "selected='selected'"; }} ?> value="11">11</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==12) { echo "selected='selected'"; }} ?> value="12">12</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==13) { echo "selected='selected'"; }} ?> value="13">13</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==14) { echo "selected='selected'"; }} ?> value="14">14</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==15) { echo "selected='selected'"; }} ?> value="15">15</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==16) { echo "selected='selected'"; }} ?> value="16">16</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==17) { echo "selected='selected'"; }} ?> value="17">17</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==18) { echo "selected='selected'"; }} ?> value="18">18</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==19) { echo "selected='selected'"; }} ?> value="19">19</option>
              <option <?php if (isset($_GET['cantcampos'])){ $cantcampos=$_GET['cantcampos']; if ($cantcampos==20) { echo "selected='selected'"; }} ?> value="20">20</option>
            </select></td>
           
          </tr>
          <tr id="camp0" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<1) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
            <td class="bod">Nombre campo 1</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"  <?php if (isset($_GET['campo_0'])){ $campo0=$_GET['campo_0']; echo "value='$campo0'";  } ?> name="campo0" id="campo0"  /></td>
            <td class="bod"><select name="tipovar0">
              <option <?php if (isset($_GET['tipovarcamp_0'])){ $tipovarcamp0=$_GET['tipovarcamp_0']; if ($tipovarcamp0==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_0'])){ $tipovarcamp0=$_GET['tipovarcamp_0']; if ($tipovarcamp0==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_0'])){ $tipovarcamp0=$_GET['tipovarcamp_0']; if ($tipovarcamp0==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_0'])){ $tipovarcamp0=$_GET['tipovarcamp_0']; if ($tipovarcamp0==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_0'])){ $tipovarcamp0=$_GET['tipovarcamp_0']; if ($tipovarcamp0==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_0'])){ $tipovarcamp0=$_GET['tipovarcamp_0']; if ($tipovarcamp0==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_0'])){ $tipovarcamp0=$_GET['tipovarcamp_0']; if ($tipovarcamp0==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_0'])){ $tipovarcamp0=$_GET['tipovarcamp_0']; if ($tipovarcamp0==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_0'])){ $tipovarcamp0=$_GET['tipovarcamp_0']; if ($tipovarcamp0==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_0'])){ $optioncamp0=$_GET['optioncamp_0']; if ($optioncamp0==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo0" value="1" />
              Obligatorio </td>
          </tr>
          
          
          
          
          
          <tr id="camp1" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<2) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
            <td class="bod">Nombre campo 2</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_1'])){ $campo1=$_GET['campo_1']; echo "value='$campo1'";  } ?> name="campo1" id="campo1"  /></td>
            <td class="bod"><select name="tipovar1">
              <option <?php if (isset($_GET['tipovarcamp_1'])){ $tipovarcamp1=$_GET['tipovarcamp_1']; if ($tipovarcamp1==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_1'])){ $tipovarcamp1=$_GET['tipovarcamp_1']; if ($tipovarcamp1==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_1'])){ $tipovarcamp1=$_GET['tipovarcamp_1']; if ($tipovarcamp1==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_1'])){ $tipovarcamp1=$_GET['tipovarcamp_1']; if ($tipovarcamp1==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_1'])){ $tipovarcamp1=$_GET['tipovarcamp_1']; if ($tipovarcamp1==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_1'])){ $tipovarcamp1=$_GET['tipovarcamp_1']; if ($tipovarcamp1==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_1'])){ $tipovarcamp1=$_GET['tipovarcamp_1']; if ($tipovarcamp1==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_1'])){ $tipovarcamp1=$_GET['tipovarcamp_1']; if ($tipovarcamp1==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_1'])){ $tipovarcamp1=$_GET['tipovarcamp_1']; if ($tipovarcamp1==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_1'])){ $optioncamp1=$_GET['optioncamp_1']; if ($optioncamp1==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo1" value="1" /> Obligatorio </td>
          </tr>
          
          
          
          
          
          
          
          
         <tr id="camp2" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<3) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
            <td class="bod">Nombre campo 3</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_2'])){ $campo2=$_GET['campo_2']; echo "value='$campo2'";  } ?> name="campo2" id="campo2"  /></td>
            <td class="bod"><select name="tipovar2">
              <option <?php if (isset($_GET['tipovarcamp_2'])){ $tipovarcamp2=$_GET['tipovarcamp_2']; if ($tipovarcamp2==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_2'])){ $tipovarcamp2=$_GET['tipovarcamp_2']; if ($tipovarcamp2==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_2'])){ $tipovarcamp2=$_GET['tipovarcamp_2']; if ($tipovarcamp2==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_2'])){ $tipovarcamp2=$_GET['tipovarcamp_2']; if ($tipovarcamp2==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_2'])){ $tipovarcamp2=$_GET['tipovarcamp_2']; if ($tipovarcamp2==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_2'])){ $tipovarcamp2=$_GET['tipovarcamp_2']; if ($tipovarcamp2==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_2'])){ $tipovarcamp2=$_GET['tipovarcamp_2']; if ($tipovarcamp2==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_2'])){ $tipovarcamp2=$_GET['tipovarcamp_2']; if ($tipovarcamp2==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_2'])){ $tipovarcamp2=$_GET['tipovarcamp_2']; if ($tipovarcamp2==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_2'])){ $optioncamp2=$_GET['optioncamp_2']; if ($optioncamp2==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo2" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
          
          
          
          <tr id="camp3" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<4) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 4</td>
            <td><input class="bod"  onchange="cambiocamposvalor('1')"  <?php if (isset($_GET['campo_3'])){ $campo3=$_GET['campo_3']; echo "value='$campo3'";  } ?> name="campo3" id="campo3"  /></td>
            <td class="bod"><select name="tipovar3">
              <option <?php if (isset($_GET['tipovarcamp_3'])){ $tipovarcamp3=$_GET['tipovarcamp_3']; if ($tipovarcamp3==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_3'])){ $tipovarcamp3=$_GET['tipovarcamp_3']; if ($tipovarcamp3==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_3'])){ $tipovarcamp3=$_GET['tipovarcamp_3']; if ($tipovarcamp3==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_3'])){ $tipovarcamp3=$_GET['tipovarcamp_3']; if ($tipovarcamp3==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_3'])){ $tipovarcamp3=$_GET['tipovarcamp_3']; if ($tipovarcamp3==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_3'])){ $tipovarcamp3=$_GET['tipovarcamp_3']; if ($tipovarcamp3==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_3'])){ $tipovarcamp3=$_GET['tipovarcamp_3']; if ($tipovarcamp3==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_3'])){ $tipovarcamp3=$_GET['tipovarcamp_3']; if ($tipovarcamp3==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_3'])){ $tipovarcamp3=$_GET['tipovarcamp_3']; if ($tipovarcamp3==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_3'])){ $optioncamp3=$_GET['optioncamp_3']; if ($optioncamp3==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo3" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          <tr id="camp4" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<5) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 5</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_4'])){ $campo4=$_GET['campo_4']; echo "value='$campo4'";  } ?> name="campo4" id="campo4"  /></td>
            <td class="bod"><select name="tipovar4">
              <option <?php if (isset($_GET['tipovarcamp_4'])){ $tipovarcamp4=$_GET['tipovarcamp_4']; if ($tipovarcamp4==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_4'])){ $tipovarcamp4=$_GET['tipovarcamp_4']; if ($tipovarcamp4==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_4'])){ $tipovarcamp4=$_GET['tipovarcamp_4']; if ($tipovarcamp4==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_4'])){ $tipovarcamp4=$_GET['tipovarcamp_4']; if ($tipovarcamp4==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_4'])){ $tipovarcamp4=$_GET['tipovarcamp_4']; if ($tipovarcamp4==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_4'])){ $tipovarcamp4=$_GET['tipovarcamp_4']; if ($tipovarcamp4==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_4'])){ $tipovarcamp4=$_GET['tipovarcamp_4']; if ($tipovarcamp4==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_4'])){ $tipovarcamp4=$_GET['tipovarcamp_4']; if ($tipovarcamp4==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_4'])){ $tipovarcamp4=$_GET['tipovarcamp_4']; if ($tipovarcamp4==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_4'])){ $optioncamp4=$_GET['optioncamp_4']; if ($optioncamp4==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo4" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
     <tr id="camp5" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<6) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 6</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_5'])){ $campo5=$_GET['campo_5']; echo "value='$campo5'";  } ?> name="campo5" id="campo5"  /></td>
            <td class="bod"><select name="tipovar5">
              <option <?php if (isset($_GET['tipovarcamp_5'])){ $tipovarcamp5=$_GET['tipovarcamp_5']; if ($tipovarcamp5==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_5'])){ $tipovarcamp5=$_GET['tipovarcamp_5']; if ($tipovarcamp5==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_5'])){ $tipovarcamp5=$_GET['tipovarcamp_5']; if ($tipovarcamp5==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_5'])){ $tipovarcamp5=$_GET['tipovarcamp_5']; if ($tipovarcamp5==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_5'])){ $tipovarcamp5=$_GET['tipovarcamp_5']; if ($tipovarcamp5==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_5'])){ $tipovarcamp5=$_GET['tipovarcamp_5']; if ($tipovarcamp5==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_5'])){ $tipovarcamp5=$_GET['tipovarcamp_5']; if ($tipovarcamp5==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_5'])){ $tipovarcamp5=$_GET['tipovarcamp_5']; if ($tipovarcamp5==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_5'])){ $tipovarcamp5=$_GET['tipovarcamp_5']; if ($tipovarcamp5==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_5'])){ $optioncamp5=$_GET['optioncamp_5']; if ($optioncamp5==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo5" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
           
          
     <tr id="camp6" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<7) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 7</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_6'])){ $campo6=$_GET['campo_6']; echo "value='$campo6'";  } ?> name="campo6" id="campo6"  /></td>
            <td class="bod"><select name="tipovar6">
              <option <?php if (isset($_GET['tipovarcamp_6'])){ $tipovarcamp6=$_GET['tipovarcamp_6']; if ($tipovarcamp6==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_6'])){ $tipovarcamp6=$_GET['tipovarcamp_6']; if ($tipovarcamp6==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_6'])){ $tipovarcamp6=$_GET['tipovarcamp_6']; if ($tipovarcamp6==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_6'])){ $tipovarcamp6=$_GET['tipovarcamp_6']; if ($tipovarcamp6==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_6'])){ $tipovarcamp6=$_GET['tipovarcamp_6']; if ($tipovarcamp6==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_6'])){ $tipovarcamp6=$_GET['tipovarcamp_6']; if ($tipovarcamp6==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_6'])){ $tipovarcamp6=$_GET['tipovarcamp_6']; if ($tipovarcamp6==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_6'])){ $tipovarcamp6=$_GET['tipovarcamp_6']; if ($tipovarcamp6==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_6'])){ $tipovarcamp6=$_GET['tipovarcamp_6']; if ($tipovarcamp6==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_6'])){ $optioncamp6=$_GET['optioncamp_6']; if ($optioncamp6==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo6" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
          
          
          
          
              
     <tr id="camp7" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<7) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 8</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_7'])){ $campo7=$_GET['campo_7']; echo "value='$campo7'";  } ?> name="campo7" id="campo7"  /></td>
            <td class="bod"><select name="tipovar7">
              <option <?php if (isset($_GET['tipovarcamp_7'])){ $tipovarcamp7=$_GET['tipovarcamp_7']; if ($tipovarcamp7==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_7'])){ $tipovarcamp7=$_GET['tipovarcamp_7']; if ($tipovarcamp7==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_7'])){ $tipovarcamp7=$_GET['tipovarcamp_7']; if ($tipovarcamp7==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_7'])){ $tipovarcamp7=$_GET['tipovarcamp_7']; if ($tipovarcamp7==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_7'])){ $tipovarcamp7=$_GET['tipovarcamp_7']; if ($tipovarcamp7==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_7'])){ $tipovarcamp7=$_GET['tipovarcamp_7']; if ($tipovarcamp7==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_7'])){ $tipovarcamp7=$_GET['tipovarcamp_7']; if ($tipovarcamp7==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_7'])){ $tipovarcamp7=$_GET['tipovarcamp_7']; if ($tipovarcamp7==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_7'])){ $tipovarcamp7=$_GET['tipovarcamp_7']; if ($tipovarcamp7==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_7'])){ $optioncamp7=$_GET['optioncamp_7']; if ($optioncamp7==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo7" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
          
          
          
           <tr id="camp8" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<9) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 9</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_8'])){ $campo8=$_GET['campo_8']; echo "value='$campo8'";  } ?> name="campo8" id="campo8"  /></td>
            <td class="bod"><select name="tipovar8">
              <option <?php if (isset($_GET['tipovarcamp_8'])){ $tipovarcamp8=$_GET['tipovarcamp_8']; if ($tipovarcamp8==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_8'])){ $tipovarcamp8=$_GET['tipovarcamp_8']; if ($tipovarcamp8==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_8'])){ $tipovarcamp8=$_GET['tipovarcamp_8']; if ($tipovarcamp8==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_8'])){ $tipovarcamp8=$_GET['tipovarcamp_8']; if ($tipovarcamp8==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_8'])){ $tipovarcamp8=$_GET['tipovarcamp_8']; if ($tipovarcamp8==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_8'])){ $tipovarcamp8=$_GET['tipovarcamp_8']; if ($tipovarcamp8==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_8'])){ $tipovarcamp8=$_GET['tipovarcamp_8']; if ($tipovarcamp8==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_8'])){ $tipovarcamp8=$_GET['tipovarcamp_8']; if ($tipovarcamp8==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_8'])){ $tipovarcamp8=$_GET['tipovarcamp_8']; if ($tipovarcamp8==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_8'])){ $optioncamp8=$_GET['optioncamp_8']; if ($optioncamp8==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo8" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
      <tr id="camp9" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<10) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 10</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_9'])){ $campo9=$_GET['campo_9']; echo "value='$campo9'";  } ?> name="campo9" id="campo9"  /></td>
            <td class="bod"><select name="tipovar9">
              <option <?php if (isset($_GET['tipovarcamp_9'])){ $tipovarcamp9=$_GET['tipovarcamp_9']; if ($tipovarcamp9==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_9'])){ $tipovarcamp9=$_GET['tipovarcamp_9']; if ($tipovarcamp9==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_9'])){ $tipovarcamp9=$_GET['tipovarcamp_9']; if ($tipovarcamp9==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_9'])){ $tipovarcamp9=$_GET['tipovarcamp_9']; if ($tipovarcamp9==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_9'])){ $tipovarcamp9=$_GET['tipovarcamp_9']; if ($tipovarcamp9==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_9'])){ $tipovarcamp9=$_GET['tipovarcamp_9']; if ($tipovarcamp9==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_9'])){ $tipovarcamp9=$_GET['tipovarcamp_9']; if ($tipovarcamp9==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_9'])){ $tipovarcamp9=$_GET['tipovarcamp_9']; if ($tipovarcamp9==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_9'])){ $tipovarcamp9=$_GET['tipovarcamp_9']; if ($tipovarcamp9==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_9'])){ $optioncamp9=$_GET['optioncamp_9']; if ($optioncamp9==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo9" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
       <tr id="camp10" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<11) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 11</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_10'])){ $campo10=$_GET['campo_10']; echo "value='$campo10'";  } ?> name="campo10" id="campo10"  /></td>
            <td class="bod"><select name="tipovar10">
              <option <?php if (isset($_GET['tipovarcamp_10'])){ $tipovarcamp10=$_GET['tipovarcamp_10']; if ($tipovarcamp10==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_10'])){ $tipovarcamp10=$_GET['tipovarcamp_10']; if ($tipovarcamp10==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_10'])){ $tipovarcamp10=$_GET['tipovarcamp_10']; if ($tipovarcamp10==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_10'])){ $tipovarcamp10=$_GET['tipovarcamp_10']; if ($tipovarcamp10==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_10'])){ $tipovarcamp10=$_GET['tipovarcamp_10']; if ($tipovarcamp10==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_10'])){ $tipovarcamp10=$_GET['tipovarcamp_10']; if ($tipovarcamp10==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_10'])){ $tipovarcamp10=$_GET['tipovarcamp_10']; if ($tipovarcamp10==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_10'])){ $tipovarcamp10=$_GET['tipovarcamp_10']; if ($tipovarcamp10==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_10'])){ $tipovarcamp10=$_GET['tipovarcamp_10']; if ($tipovarcamp10==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_10'])){ $optioncamp10=$_GET['optioncamp_10']; if ($optioncamp10==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo10" value="1" />Obligatorio</td>
          </tr>
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
       <tr id="camp11" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<12) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 12</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_11'])){ $campo11=$_GET['campo_11']; echo "value='$campo11'";  } ?> name="campo11" id="campo11"  /></td>
            <td class="bod"><select name="tipovar11">
              <option <?php if (isset($_GET['tipovarcamp_11'])){ $tipovarcamp11=$_GET['tipovarcamp_11']; if ($tipovarcamp11==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_11'])){ $tipovarcamp11=$_GET['tipovarcamp_11']; if ($tipovarcamp11==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_11'])){ $tipovarcamp11=$_GET['tipovarcamp_11']; if ($tipovarcamp11==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_11'])){ $tipovarcamp11=$_GET['tipovarcamp_11']; if ($tipovarcamp11==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_11'])){ $tipovarcamp11=$_GET['tipovarcamp_11']; if ($tipovarcamp11==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_11'])){ $tipovarcamp11=$_GET['tipovarcamp_11']; if ($tipovarcamp11==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_11'])){ $tipovarcamp11=$_GET['tipovarcamp_11']; if ($tipovarcamp11==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_11'])){ $tipovarcamp11=$_GET['tipovarcamp_11']; if ($tipovarcamp11==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_11'])){ $tipovarcamp11=$_GET['tipovarcamp_11']; if ($tipovarcamp11==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_11'])){ $optioncamp11=$_GET['optioncamp_11']; if ($optioncamp11==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo11" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          <tr id="camp12" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<13) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 13</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_12'])){ $campo12=$_GET['campo_12']; echo "value='$campo12'";  } ?> name="campo12" id="campo12"  /></td>
            <td class="bod"><select name="tipovar12">
              <option <?php if (isset($_GET['tipovarcamp_12'])){ $tipovarcamp12=$_GET['tipovarcamp_12']; if ($tipovarcamp12==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_12'])){ $tipovarcamp12=$_GET['tipovarcamp_12']; if ($tipovarcamp12==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_12'])){ $tipovarcamp12=$_GET['tipovarcamp_12']; if ($tipovarcamp12==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_12'])){ $tipovarcamp12=$_GET['tipovarcamp_12']; if ($tipovarcamp12==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_12'])){ $tipovarcamp12=$_GET['tipovarcamp_12']; if ($tipovarcamp12==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_12'])){ $tipovarcamp12=$_GET['tipovarcamp_12']; if ($tipovarcamp12==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_12'])){ $tipovarcamp12=$_GET['tipovarcamp_12']; if ($tipovarcamp12==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_12'])){ $tipovarcamp12=$_GET['tipovarcamp_12']; if ($tipovarcamp12==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_12'])){ $tipovarcamp12=$_GET['tipovarcamp_12']; if ($tipovarcamp12==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_12'])){ $optioncamp12=$_GET['optioncamp_12']; if ($optioncamp12==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo12" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
                 <tr id="camp13" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<14) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 14</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_13'])){ $campo13=$_GET['campo_13']; echo "value='$campo13'";  } ?> name="campo13" id="campo13"  /></td>
            <td class="bod"><select name="tipovar13">
              <option <?php if (isset($_GET['tipovarcamp_13'])){ $tipovarcamp13=$_GET['tipovarcamp_13']; if ($tipovarcamp13==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_13'])){ $tipovarcamp13=$_GET['tipovarcamp_13']; if ($tipovarcamp13==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_13'])){ $tipovarcamp13=$_GET['tipovarcamp_13']; if ($tipovarcamp13==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_13'])){ $tipovarcamp13=$_GET['tipovarcamp_13']; if ($tipovarcamp13==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_13'])){ $tipovarcamp13=$_GET['tipovarcamp_13']; if ($tipovarcamp13==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_13'])){ $tipovarcamp13=$_GET['tipovarcamp_13']; if ($tipovarcamp13==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_13'])){ $tipovarcamp13=$_GET['tipovarcamp_13']; if ($tipovarcamp13==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_13'])){ $tipovarcamp13=$_GET['tipovarcamp_13']; if ($tipovarcamp13==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_13'])){ $tipovarcamp13=$_GET['tipovarcamp_13']; if ($tipovarcamp13==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_13'])){ $optioncamp13=$_GET['optioncamp_13']; if ($optioncamp13==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo13" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
                     <tr id="camp14" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<15) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 15</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_14'])){ $campo14=$_GET['campo_14']; echo "value='$campo14'";  } ?> name="campo14" id="campo14"  /></td>
            <td class="bod"><select name="tipovar14">
              <option <?php if (isset($_GET['tipovarcamp_14'])){ $tipovarcamp14=$_GET['tipovarcamp_14']; if ($tipovarcamp14==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_14'])){ $tipovarcamp14=$_GET['tipovarcamp_14']; if ($tipovarcamp14==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_14'])){ $tipovarcamp14=$_GET['tipovarcamp_14']; if ($tipovarcamp14==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_14'])){ $tipovarcamp14=$_GET['tipovarcamp_14']; if ($tipovarcamp14==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_14'])){ $tipovarcamp14=$_GET['tipovarcamp_14']; if ($tipovarcamp14==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_14'])){ $tipovarcamp14=$_GET['tipovarcamp_14']; if ($tipovarcamp14==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_14'])){ $tipovarcamp14=$_GET['tipovarcamp_14']; if ($tipovarcamp14==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_14'])){ $tipovarcamp14=$_GET['tipovarcamp_14']; if ($tipovarcamp14==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_14'])){ $tipovarcamp14=$_GET['tipovarcamp_14']; if ($tipovarcamp14==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_14'])){ $optioncamp14=$_GET['optioncamp_14']; if ($optioncamp14==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo14" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
                 <tr id="camp15" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<16) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 16</td>
            <td><input class="bod"  onchange="cambiocamposvalor('1')"  <?php if (isset($_GET['campo_15'])){ $campo15=$_GET['campo_15']; echo "value='$campo15'";  } ?> name="campo15" id="campo15"  /></td>
            <td class="bod"><select name="tipovar15">
              <option <?php if (isset($_GET['tipovarcamp_15'])){ $tipovarcamp15=$_GET['tipovarcamp_15']; if ($tipovarcamp15==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_15'])){ $tipovarcamp15=$_GET['tipovarcamp_15']; if ($tipovarcamp15==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_15'])){ $tipovarcamp15=$_GET['tipovarcamp_15']; if ($tipovarcamp15==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_15'])){ $tipovarcamp15=$_GET['tipovarcamp_15']; if ($tipovarcamp15==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_15'])){ $tipovarcamp15=$_GET['tipovarcamp_15']; if ($tipovarcamp15==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_15'])){ $tipovarcamp15=$_GET['tipovarcamp_15']; if ($tipovarcamp15==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_15'])){ $tipovarcamp15=$_GET['tipovarcamp_15']; if ($tipovarcamp15==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_15'])){ $tipovarcamp15=$_GET['tipovarcamp_15']; if ($tipovarcamp15==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_15'])){ $tipovarcamp15=$_GET['tipovarcamp_15']; if ($tipovarcamp15==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_15'])){ $optioncamp15=$_GET['optioncamp_15']; if ($optioncamp15==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo15" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
        
                 <tr id="camp16" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<17) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 17</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_16'])){ $campo16=$_GET['campo_16']; echo "value='$campo16'";  } ?> name="campo16" id="campo16"  /></td>
            <td class="bod"><select name="tipovar16">
              <option <?php if (isset($_GET['tipovarcamp_16'])){ $tipovarcamp16=$_GET['tipovarcamp_16']; if ($tipovarcamp16==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_16'])){ $tipovarcamp16=$_GET['tipovarcamp_16']; if ($tipovarcamp16==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_16'])){ $tipovarcamp16=$_GET['tipovarcamp_16']; if ($tipovarcamp16==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_16'])){ $tipovarcamp16=$_GET['tipovarcamp_16']; if ($tipovarcamp16==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_16'])){ $tipovarcamp16=$_GET['tipovarcamp_16']; if ($tipovarcamp16==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_16'])){ $tipovarcamp16=$_GET['tipovarcamp_16']; if ($tipovarcamp16==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_16'])){ $tipovarcamp16=$_GET['tipovarcamp_16']; if ($tipovarcamp16==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_16'])){ $tipovarcamp16=$_GET['tipovarcamp_16']; if ($tipovarcamp16==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_16'])){ $tipovarcamp16=$_GET['tipovarcamp_16']; if ($tipovarcamp16==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_16'])){ $optioncamp16=$_GET['optioncamp_16']; if ($optioncamp16==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo16" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
                 <tr id="camp17" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<18) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 18</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_17'])){ $campo17=$_GET['campo_17']; echo "value='$campo17'";  } ?> name="campo17" id="campo17"  /></td>
            <td class="bod"><select name="tipovar17">
              <option <?php if (isset($_GET['tipovarcamp_17'])){ $tipovarcamp17=$_GET['tipovarcamp_17']; if ($tipovarcamp17==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_17'])){ $tipovarcamp17=$_GET['tipovarcamp_17']; if ($tipovarcamp17==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_17'])){ $tipovarcamp17=$_GET['tipovarcamp_17']; if ($tipovarcamp17==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_17'])){ $tipovarcamp17=$_GET['tipovarcamp_17']; if ($tipovarcamp17==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_17'])){ $tipovarcamp17=$_GET['tipovarcamp_17']; if ($tipovarcamp17==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_17'])){ $tipovarcamp17=$_GET['tipovarcamp_17']; if ($tipovarcamp17==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_17'])){ $tipovarcamp17=$_GET['tipovarcamp_17']; if ($tipovarcamp17==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_17'])){ $tipovarcamp17=$_GET['tipovarcamp_17']; if ($tipovarcamp17==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_17'])){ $tipovarcamp17=$_GET['tipovarcamp_17']; if ($tipovarcamp17==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_17'])){ $optioncamp17=$_GET['optioncamp_17']; if ($optioncamp17==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo17" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
          
                 <tr id="camp18" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<19) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 19</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_18'])){ $campo18=$_GET['campo_18']; echo "value='$campo18'";  } ?> name="campo18" id="campo18"  /></td>
            <td class="bod"><select name="tipovar18">
              <option <?php if (isset($_GET['tipovarcamp_18'])){ $tipovarcamp18=$_GET['tipovarcamp_18']; if ($tipovarcamp18==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_18'])){ $tipovarcamp18=$_GET['tipovarcamp_18']; if ($tipovarcamp18==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_18'])){ $tipovarcamp18=$_GET['tipovarcamp_18']; if ($tipovarcamp18==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_18'])){ $tipovarcamp18=$_GET['tipovarcamp_18']; if ($tipovarcamp18==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_18'])){ $tipovarcamp18=$_GET['tipovarcamp_18']; if ($tipovarcamp18==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_18'])){ $tipovarcamp18=$_GET['tipovarcamp_18']; if ($tipovarcamp18==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_18'])){ $tipovarcamp18=$_GET['tipovarcamp_18']; if ($tipovarcamp18==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_18'])){ $tipovarcamp18=$_GET['tipovarcamp_18']; if ($tipovarcamp18==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_18'])){ $tipovarcamp18=$_GET['tipovarcamp_18']; if ($tipovarcamp18==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_18'])){ $optioncamp18=$_GET['optioncamp_18']; if ($optioncamp18==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo18" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
              <tr id="camp19" <?php if (isset($_GET['cantcampos'])){ if ($cantcampos<20) { echo "style='position:inherit;visibility:hidden;display:none'"; }}else{ echo "style='position:inherit;visibility:hidden;display:none'"; } ?> >
          <td class="bod">Nombre campo 20</td>
            <td><input class="bod" onchange="cambiocamposvalor('1')"   <?php if (isset($_GET['campo_19'])){ $campo19=$_GET['campo_19']; echo "value='$campo19'";  } ?> name="campo19" id="campo19"  /></td>
            <td class="bod"><select name="tipovar19">
              <option <?php if (isset($_GET['tipovarcamp_19'])){ $tipovarcamp19=$_GET['tipovarcamp_19']; if ($tipovarcamp19==1){ echo "selected='selected'";}  } ?> value="1">Caracteres (Hasta 20)</option>
              <option <?php if (isset($_GET['tipovarcamp_19'])){ $tipovarcamp19=$_GET['tipovarcamp_19']; if ($tipovarcamp19==2){ echo "selected='selected'";}  } ?>  value="2">Caracteres (Hasta 50)</option>
              <option <?php if (isset($_GET['tipovarcamp_19'])){ $tipovarcamp19=$_GET['tipovarcamp_19']; if ($tipovarcamp19==3){ echo "selected='selected'";}  } ?>  value="3">Decimal</option>
              <option <?php if (isset($_GET['tipovarcamp_19'])){ $tipovarcamp19=$_GET['tipovarcamp_19']; if ($tipovarcamp19==4){ echo "selected='selected'";}  } ?>  value="4">Numero con coma</option>
              <option <?php if (isset($_GET['tipovarcamp_19'])){ $tipovarcamp19=$_GET['tipovarcamp_19']; if ($tipovarcamp19==5){ echo "selected='selected'";}  } ?>  value="5">Texto</option>
              <option <?php if (isset($_GET['tipovarcamp_19'])){ $tipovarcamp19=$_GET['tipovarcamp_19']; if ($tipovarcamp19==6){ echo "selected='selected'";}  } ?>  value="6">Fecha</option>
              <option <?php if (isset($_GET['tipovarcamp_19'])){ $tipovarcamp19=$_GET['tipovarcamp_19']; if ($tipovarcamp19==7){ echo "selected='selected'";}  } ?>  value="7">E-mail</option>
              <option <?php if (isset($_GET['tipovarcamp_19'])){ $tipovarcamp19=$_GET['tipovarcamp_19']; if ($tipovarcamp19==8){ echo "selected='selected'";}  } ?>  value="8">Pais</option>
              <option<?php if (isset($_GET['tipovarcamp_19'])){ $tipovarcamp19=$_GET['tipovarcamp_19']; if ($tipovarcamp19==9){ echo "selected='selected'";}  } ?>  value="9">Puesto de trabajo</option>
            </select></td>
            <td class="bod" align="center"><input <?php if (isset($_GET['optioncamp_19'])){ $optioncamp19=$_GET['optioncamp_19']; if ($optioncamp19==1){ echo "checked='checked'"; }} ?> type="checkbox" name="optioncampo19" value="1" />Obligatorio</td>
          </tr>
          
          
          
          
          
          
          
          
          
          
          
          
          
          <tr id="boton">
            <td class="bod" colspan="4" align="center"><div class="buttonWrapper"><input name="formNext1" onclick="getElementById('sf2').style.visibility='visible'" type="button" class="open1 nextbutton" value="Siguiente" alt="Next" title="Next" /></div></td>
         </td></tr> <?php	if (isset($_GET['error'])){
				$error=$_GET['error'];
					   if ($error==1){
						   echo "<tr><td class='error' align='center' colspan='4'>La fecha de termino no puede ser anterior a la fecha de inicio</td></tr>";
					   }
			if ($error==2){
  echo "<tr><td class='error' align='center' colspan='4'>La fecha de termino de inscripci&oacute;n no puede ser anterior a la fecha de inicio</td></tr>";	
}
		if ($error==3){
  echo "<tr><td class='error' align='center' colspan='4'>La inscripci&oacute;n no puede extenderse m&aacute;s alla de la fecha de termino del evento</td></tr>";
		}
		
			if ($error==4){
		  echo "<tr><td class='error' align='center' colspan='4'>La inscripci&oacute;n no puede extenderse m&aacute;s alla de la fecha de termino del evento</td></tr>";
			}
			
				if ($error==5){
			echo "<tr><td class='error' align='center' colspan='4'>Ese evento ya existe en nuestra base de datos</td></tr>";
			}
			if ($error==6){
			echo "<tr><td class='error' align='center' colspan='4'>No se ingreso un nombre para el evento</td></tr>";
			}
			if ($error==7){
				echo "<tr><td class='error' align='center' colspan='4'>Alguno de los campos del evento esta vacio</td></tr>";
				}
} ?>

   

































</table>

	</fieldset>
	</div>

</li>
<li id="sf2">
	<a href='#' class="ui-accordion-link">
	</a>









<div>
	
    
    <table align="center">
    <tr>
      <td class="tit">Imprimir etiquetas
    </td></tr>
    <tr><td class="bod">Imprimir etiquetas en este evento con impresoras de etiquetas ZEBRA<input checked="checked" onchange="javascript:camposaimp()" type="radio" name="imprimir" value="0" />
    </td></tr>
    <tr><td class="bod">Imprimir etiquetas en este evento con otra impresora<input onclick="habilitacamposimp()" type="radio" name="imprimir" value="1" />
    </td></tr>
    <tr><td class="bod">No imprimir nada<input type="radio" name="imprimir" value="2" onclick="deshabilitacamposimp()" />
    </td></tr><tr>
    
    <tr><td class="bod"><div id="campimptd"><script type="text/javascript"> cambiocamposvalor('0'); </script></div>
    </td></tr><tr>
    
    <td class="bod">	<div align="center" class="buttonWrapper"><input name="formBack0" type="button" class="open0 prevbutton" value="Anterior" alt="Back" title="Back" /> </div><br />
    <div align="center"><input name="crear" type="submit" id="crear" class="open0 prevbutton" value="Crear nuevo evento" /></div></td></tr>
    <?php 



if (isset($_POST['crear'])){


$nom=utf8_encode($_POST['nom']);
$fechin=$_POST['fechin'];
$fechter=$_POST['fechter'];
$horain=$_POST['horain'];
$horater=$_POST['horater'];
if ($_POST['fechinsc']!=""){
$fechinsc=$_POST['fechinsc'];
}else{
$fechinsc=date("Y-m-d");
}
if ($_POST['fechinscter']!=""){
$fechinscter=$_POST['fechinscter'];
}else{
$fechinscter=$fechter;
}
$cantmax=$_POST['cantmax'];
$ubic=$_POST['ubic'];
$campos=$_POST['campos'];
$nomevent=str_replace(" ","",$nom);
$nomevent=str_replace(";","",$nomevent);
$nom2=str_replace(" ","",$nom);
if ($cantmax==""){
$cantmax=0;
}


$diain=explode("-",$fechin);
$diater=explode("-",$fechter);
$diainsc=explode("-",$fechinsc);
$diainscter=explode("-",$fechinscter);
$horasin=explode(":",$horain);
$horaster=explode(":",$horater);

$timestamp1=mktime($horasin[0],$horasin[1],"00",$diain[1],$diain[2],$diain[0]);
$timestamp2=mktime($horaster[0],$horaster[1],"00",$diater[1],$diater[2],$diater[0]);
 $diferencia = $timestamp1 - $timestamp2;
  $resultado = diferencia_fechas($diferencia);
  if ($resultado>0){
	  
  header("Location:principal.php?error=1#crearevento");
  exit(1);
  }
  $timestamp11=mktime("00","00","00",$diainsc[1],$diainsc[2],$diainsc[0]);
$timestamp21=mktime("00","00","00",$diainscter[1],$diainscter[2],$diainscter[0]);
 $diferencia = $timestamp11 - $timestamp21;
  $resultado = diferencia_fechas($diferencia);
if ($resultado>0){
	 header("Location:principal.php?error=2#crearevento");

  exit(1);
  }
  $diferencia=$timestamp2 - $timestamp11;
    $resultado = diferencia_fechas($diferencia);
  if ($resultado<0){
	   header("Location:principal.php?error=3#crearevento");

  exit(1);
  }
    $diferencia=$timestamp2 - $timestamp21;
    $resultado = diferencia_fechas($diferencia);
  if ($resultado<0){

  	   header("Location:principal.php?error=4#crearevento");
  exit(1);
  }
  $query="select nom from eventos";
  $result=mysql_query($query);
  while ($row=@mysql_fetch_assoc($result)){
	if ($nom == $row['nom']){
		  header("Location:principal.php?error=5#crearevento");
	
	
	exit(1);
	}
  }
  
  
if ($nom2==""){
			  header("Location:principal.php?error=6#crearevento");

exit(1);
}else{
	



if ($campos==0){




$query="CREATE TABLE $nomevent (id FLOAT NOT NULL AUTO_INCREMENT, campo_0 varchar(50) NOT NULL, campo_1 varchar(50) NOT NULL,campo_2 varchar(50) NOT NULL,campo_3 varchar(50) NOT NULL,campo_4 varchar(50) NOT NULL,campo_5 varchar(50) NOT NULL,campo_6 varchar(50) NOT NULL,campo_7 varchar(50) NOT NULL,campo_8 varchar(50) NOT NULL,campo_9 varchar(50) NOT NULL,campo_10 varchar(100) NOT NULL,fecha DATE NOT NULL,hora TIME NOT NULL, fechaas DATE NOT NULL, horaas TIME NOT NULL,ip varchar(100) NOT NULL, inscripto INT NOT NULL, asistente INT NOT NULL, primary key(id))";

mysql_query($query) or die ("<tr><td class='error' align='center' colspan='4'>Error creando la tabla</td></tr>");

$query = "INSERT INTO eventos (nom,fechin,fechter,horain,horater,fechinsc,fechinscter,cantmax,ubic,cantcampos,nomevent,directivas,organizador) VALUES ('$nom','$fechin','$fechter','$horain','$horater','$fechinsc','$fechinscter',$cantmax,'$ubic',11,'$nomevent',";
																																					
																																						   $query.="'Nombre;2;1;Apellido;2;1;Empresa;2;1;Cargo;9;1;Dirección;2;0;Pais;8;0;Provincia;2;0;Ciudad;2;0;Teléfono;3;1;E-mail;7;1;E-mail alternativo;7;0;'";
																																						   $query.=",$id)";

mysql_query($query) or die ("<tr><td class='error' align='center' colspan='4'>Error insertando el evento en la tabla</td></tr>");
					
					echo "<script languaje='javascript' type='text/javascript'> GB_show('Mostrar formulario', '../mosform.php?nom=$nom');</script>";
					//header ("Location: mosform.php?nom=$nom");																															
																														
							//	nombre varchar(40) NOT NULL,apellido varchar(60) NOT NULL,empresa varchar(40) NOT NULL,cargo varchar(40) NOT NULL,direccion varchar(60) NOT NULL,pais varchar(60) NOT NULL,provincia varchar(60) NOT NULL,ciudad varchar(60) NOT NULL,telefono varchar(60) NOT NULL,email varchar(100) NOT NULL,email2 varchar(100) NOT NULL,fecha DATE NOT NULL,hora TIME NOT NULL,ip varchar(100) NOT NULL, inscripto INT NOT NULL, asistente INT NOT NULL, primary key(id))";
// mysql_query($query) or die ("Error creando la tabla del evento");
}else{
$campob=$_POST['campob'];
for ($p=0;$p<$campob;$p++){
	
	
$campo[$p]=$_POST['campo'.$p];
$tipovarcamp[$p]=$_POST['tipovar'.$p];
if (isset($_POST['optioncampo'.$p])){
	
$optioncamp[$p]=$_POST['optioncampo'.$p];
}else{
	$optioncamp[$p]=0;
}
if ($tipovarcamp[$p]==1){
$tipocampo[$p]="varchar(20) NOT NULL";
}
if ($tipovarcamp[$p]==2){
$tipocampo[$p]="varchar(50) NOT NULL";
}
if ($tipovarcamp[$p]==3){
$tipocampo[$p]="varchar(30) NOT NULL";
}
if ($tipovarcamp[$p]==4){
$tipocampo[$p]="varchar(30) NOT NULL";
}
if ($tipovarcamp[$p]==5){
$tipocampo[$p]="TEXT NOT NULL";
}
if ($tipovarcamp[$p]==6){
$tipocampo[$p]="DATE NOT NULL";
}
if ($tipovarcamp[$p]==7){
$tipocampo[$p]="varchar(50) NOT NULL";
}
if ($tipovarcamp[$p]==8){
$tipocampo[$p]="varchar(50) NOT NULL";
}
if ($tipovarcamp[$p]==9){
$tipocampo[$p]="varchar(50) NOT NULL";
}


$campo2[$p]=str_replace(" ","",$campo[$p]);

if ($campo2[$p]==""){
	header("Location:principal.php?error=7#crearevento");

	die();
}


																																		
																														
							//	nombre varchar(40) NOT NULL,apellido varchar(60) NOT NULL,empresa varchar(40) NOT NULL,cargo varchar(40) NOT NULL,direccion varchar(60) NOT NULL,pais varchar(60) NOT NULL,provincia varchar(60) NOT NULL,ciudad varchar(60) NOT NULL,telefono varchar(60) NOT NULL,email varchar(100) NOT NULL,email2 varchar(100) NOT NULL,fecha DATE NOT NULL,hora TIME NOT NULL,ip varchar(100) NOT NULL, inscripto INT NOT NULL, asistente INT NOT NULL, primary key(id))";
// mysql_query($query) or die ("Error creando la tabla del evento");


}
$query="CREATE TABLE $nomevent (id FLOAT NOT NULL AUTO_INCREMENT,";
								
for ($x=0;$x<$campob;$x++){
$query.= "campo_" . $x . " " . $tipocampo[$x] . ",";
}

$query.= "fecha DATE NOT NULL,hora TIME NOT NULL, fechaas DATE NOT NULL, horaas TIME NOT NULL,ip varchar(100) NOT NULL, inscripto INT NOT NULL, asistente INT NOT NULL, primary key(id))";
// campo_0 varchar(50) NOT NULL, campo_1 varchar(50) NOT NULL,campo_2 varchar(40) NOT NULL,campo_3 varchar(50) NOT NULL,campo_4 varchar(50) NOT NULL,campo_5 varchar(50) NOT NULL,campo_6 varchar(50) NOT NULL,campo_7 varchar(50) NOT NULL,campo_8 varchar(50) NOT NULL,campo_9 varchar(50) NOT NULL,campo_10 varchar(100) NOT NULL,fecha DATE NOT NULL,hora TIME NOT NULL, fechaas DATE NOT NULL, horaas TIME NOT NULL,ip varchar(100) NOT NULL, inscripto INT NOT NULL, asistente INT NOT NULL, primary key(id))";

mysql_query($query) or die ("<tr><td class='error' align='center' colspan='4'>Error creando la tabla</td></tr>");

$query = "INSERT INTO eventos (nom,fechin,fechter,horain,horater,fechinsc,fechinscter,cantmax,ubic,cantcampos,nomevent,directivas,organizador) VALUES ('$nom','$fechin','$fechter','$horain','$horater','$fechinsc','$fechinscter',$cantmax,'$ubic',$campob,'$nomevent','";
																																					
for ($x=0;$x<$campob;$x++){																																						   $query.="$campo[$x];$tipovarcamp[$x];$optioncamp[$x];";
}
$query.="',$id)";

mysql_query($query) or die ("<tr><td class='error' align='center' colspan='4'>Error insertando el evento en la tabla $query</td></tr>");
mkdir("tablasexcel$nomevent");
       
echo "<script languaje='javascript' type='text/javascript'> GB_show('Mostrar formulario', '../mosform.php?nom=$nom',800, 480);</script>";

/*$campob=str_replace(" ","",$campob);
$nomevent=str_replace(" ","",$nom);
$campotot=explode(";",$campob); */
/* 
$enviarcampos="Location:new_event.php?";
$enviarcampos .= "nomevent=$nomevent&";
for ($x=0;$x<count($campotot)-1;$x++){
$enviarcampos .= "campo$x=" . $campotot[$x] . "&";
}

$enviarcampos = substr($enviarcampos,0,strlen($enviarcampos)-1);
$enviarcampos .= "&cantcampos=";
$enviarcampos .= count($campotot)-1;
header($enviarcampos);

*/


}
}
}
}
?>

   
    

    </div>

    
    </li>
</ul>

</form>
</div>


</div>

    
    
	

























</body>
</html>
 
<?php
include "librerias/closecon.php";
}else{
header("Location:index.php");

}
?>