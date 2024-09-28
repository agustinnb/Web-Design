<?php session_start();

if (isset($_SESSION['tk_username'])){ 
include "librerias/mysqlconnect.php";
include "validaciones/diferencia_fechas.php";
$user=$_SESSION['tk_username'];
$query= "SELECT * FROM organizadores WHERE usuario= '$user'";
$result = mysql_query($query) or die ("Error buscando el usuario en la DB");
$raw=@mysql_fetch_assoc($result);
$id=$raw['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agregar moderador</title>
<style type="text/css">


<!--
.error {font-family: Arial, Helvetica, sans-serif; 
		color: #FF0000;
		font-size: 9px;
		}
.tit {font-family: Arial, Helvetica, sans-serif}
.bod {font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		}
a:link {text-decoration: none}
a:visited {text-decoration: none}
a:active {text-decoration: none} 
</style>

<script language="javascript" type="text/javascript">
var error_name;
function validoob(valor,campo){
	if (valor!=""){
	
	return (true);
}else{

	error_name="Error, el campo " + campo  + " es obligatorio";
	document.getElementById('erroresjsp').innerHTML="Error, el campo " + campo  + " es obligatorio";
	return (false);
	}
}
function validarSelect() {
var	error2=false;
  	if (document.addmod.usuarios.value == "-1") {
          
		if (validoob(document.getElementById('usuario').value,document.getElementById('usuario').id)==false){
			error2=true;
		}
		if (validoob(document.getElementById('password').value,document.getElementById('password').id)==false){
			error2=true;
		}
		if (error2==true){
		return (false);
		}else{
		return (true);
		window.close();
		}
	}else{
		document.getElementById('erroresjsp').innerHTML=error_name;
	document.getElementById('addmod').submit();	
	window.close();
	}
	
	
}


</script>
</head>

<body >
<form id="addmod" action="" onsubmit="return validarSelect();" autocomplete="off" name="addmod" method="post">
<table align="center">

<tr><td class="tit" colspan="2" align="left"><b>Agregar moderador</b></td></tr>
<?php if ($raw['rango']=='A' || $raw['rango']=='S'){
if (isset($_GET['id'])){
$idevent=$_GET['id'];
				}else{
					die(); }
if ($raw['rango']=='A'){
$query="SELECT * FROM eventos WHERE id=$idevent and organizador=$id";
}
if ($raw['rango']=='S'){
$query="SELECT * FROM eventos WHERE id=$idevent";
}
$result=mysql_query($query) or die ("<tr><td align='center' class='bod'>Usted no puede agregar moderadores a este evento</td></tr>");
$row=mysql_fetch_assoc($result);
$query="SELECT * FROM organizadores";
$result=mysql_query($query) or die ("<tr><td align='center' class='bod'>Error.</td></tr>");
$i=0;
echo "<tr><td class='bod'>Moderadores</td><td align='bod'><select name='usuarios'><option value='-1'></option>";
while ($rew=mysql_fetch_assoc($result)){
if ($rew['rango']!='A' && $rew['rango']!='S'){
$rangous=explode(";",$rew['rango']);

if ($rangous[1]==$id){
	$usado=0;
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$idevent){
$usado=1;
}
}
if ($usado==0){
echo "<option value='{$rew['usuario']}'>{$rew['usuario']}</option>";
}
}

}



}
echo "</select></td></tr>";

}
?>
<tr><td align='center' class='bod'>Usuario</td><td align='center' class='bod'><input name="usuario" id="usuario" type="text" maxlength="20" /></td></tr>
<tr><td align='center' class='bod'>Password</td><td align='center' class='bod'><input name="password" id="password" type="password" maxlength="20" /></td></tr>
<tr><td colspan="2" align='center' class='bod'><input name="enviar" onclick="" type="submit" value="Agregar" /></td></tr>
<tr><td colspan="2" align='center' class='error' id='erroresjsp'></td></tr>

<?php 

if (isset($_POST['enviar'])){
if ($_POST['usuarios']=="-1"){
$us=$_POST['usuario'];
$pass=$_POST['password'];
$error=0;
if (strlen($pass)<5){
	$error=1;
echo "<tr><td colspan='2' align='center' class='error'>La password es muy corta (Tiene que tener al menos 5 letras)</td></tr>";
die();
}
if (trim($us)==""){
	echo "<tr><td colspan='2' align='center'class='error'>Escriba un usuario</td></tr>";
	die();
}
$query = "SELECT * FROM organizadores";
$result=mysql_query($query);
while ($ruw=mysql_fetch_assoc($result)){
if (strtolower($us)==strtolower($ruw['usuario'])){
	$error=1;
echo "<tr><td colspan='2' align='center' class='error'>Ya existe ese usuario</td></tr>";
die();
}
			  
}
$passwd=md5($pass);
$addus="U;";
$addus.=$id . ";";
$addus.=$idevent . ";";
$query="INSERT INTO organizadores (usuario,passwd,rango) VALUES ('$us','$passwd','$addus')";
mysql_query($query) or die("Error ingresando los datos en la DB");
if ($error==0){
echo "<script languaje='javascript' type='text/javascript'>top.window.location.reload(); parent.parent.GB_hide();</script>";
}
}else{
	$usuario=$_POST['usuarios'];
	$query="SELECT * FROM organizadores where usuario='$usuario'";
	$result=mysql_query($query);
	$ruw=@mysql_fetch_assoc($result);
	$rango=$ruw['rango'];
	$rango.=$idevent . ";";
	$query="UPDATE organizadores SET rango='$rango' WHERE usuario='$usuario'";
	mysql_query($query) or die ("Error actualizando la db");
if ($error==0){
echo "<script languaje='javascript' type='text/javascript'>top.window.location.reload(); parent.parent.GB_hide();</script>";
}
}

}



include "librerias/closecon.php";

} ?>

</table>
</form>
</body>
</html>