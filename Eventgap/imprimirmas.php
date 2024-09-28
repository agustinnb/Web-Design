<?php
session_start();

if (isset($_SESSION['tk_username'])){ 
include "librerias/mysqlconnect.php";
include "validaciones/diferencia_fechas.php";
$user=$_SESSION['tk_username'];
$query= "SELECT * FROM organizadores WHERE usuario= '$user'";
$result = mysql_query($query) or die ("Error buscando el usuario en la DB");
$raw=@mysql_fetch_assoc($result);
$id=$raw['id'];
 if ($raw['rango']=='A'){
$query="SELECT * FROM eventos where organizador=$id";
 }
 if ($raw['rango']=='S'){
	 $query="SELECT * FROM eventos";
 }
$result2=mysql_query($query) or die ("Error buscando el evento");
$p=false;
while ($row=@mysql_fetch_assoc($result2)){
if ($row['id']==$_GET['id']){
$p=true;
}
}
if ($p==false){
die("Usted no esta autorizado para imprimir masivamente etiquetas");	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Impresion masiva</title>
</head>

<body>
<table>
<?php 

if (isset($_GET['id'])){
				$id=$_GET['id'];
$query="SELECT * FROM eventos WHERE id=$id";
$result2=mysql_query($query);
$row2=@mysql_fetch_assoc($result2);
$query="SELECT * FROM " . $row2['nomevent'];
$result=mysql_query($query);
while ($row=@mysql_fetch_assoc($result)){
$id=$row['id'];
$nombre = trim($row['campo_0']);
$nombre = str_replace(" ","!",$nombre);
$apellido = trim($row['campo_1']);
$apellido = str_replace(" ","!",$apellido);
$name =utf8_decode($nombre . "_" . $apellido);
		$name=str_replace("á", "a",$name);
				$name=str_replace("é", "e",$name);
				$name=str_replace("í", "i",$name);
				$name=str_replace("ó", "o",$name);
				$name=str_replace("ú", "u",$name);
				$name=str_replace("Á", "A",$name);
				$name=str_replace("É", "E",$name);
				$name=str_replace("Í", "I",$name);
				$name=str_replace("Ó", "O",$name);
				$name=str_replace("Ú", "U",$name);
				$name=str_replace("ñ", "n",$name);
				$name=str_replace("Ñ", "N",$name);
$emp = utf8_decode($row['campo_2']); 
		$emp=str_replace("á", "a",$emp);
				$emp=str_replace("é", "e",$emp);
				$emp=str_replace("í", "i",$emp);
				$emp=str_replace("ó", "o",$emp);
				$emp=str_replace("ú", "u",$emp);
				$emp=str_replace("Á", "A",$emp);
				$emp=str_replace("É", "E",$emp);
				$emp=str_replace("Í", "I",$emp);
				$emp=str_replace("Ó", "O",$emp);
				$emp=str_replace("Ú", "U",$emp);
				$emp=str_replace("ñ", "n",$emp);
				$emp=str_replace("Ñ", "N",$emp);
if (strlen($name)<20){
$name=str_replace("!", " ",$name);
$name=str_replace("_"," ",$name);
}else{
$name2 = explode("_",$name);
$name3=explode("!",$name2[0]);
$name4=explode("!",$name2[1]);
if ($name3[1]!=NULL){
$temp= substr($name3[1],0,1);			 
$name=$name3[0] . " " . $temp . ". ";
			 }else{
			 
$name=$name3[0] . " ";
			 }
if (!(is_array($name4))){
$name.= $name4;
 }else{
 for ($x=0;$x<count($name4);$x++){
$name.= $name4[$x] . " ";
 }
 }
if (strlen($name)>20){
$temp2=substr($name3[0],0,1);
$name=$temp2 . ". " . $temp . ". ";
if (!(is_array($name4))){
$name.= $name4;
 }else{
 for ($x=0;$x<count($name4);$x++){
$name.= $name4[$x] . " ";
 }
 }
}
}



?>
<tr style="visibility:hidden"><td>
<APPLET CODE="Imprimir.class" ARCHIVE= "Imprimir.jar" WIDTH=300 HEIGHT=100>
    <PARAM NAME="Nombre" VALUE="<?php echo $name; ?>">
	<PARAM NAME="Empresa" VALUE="<?php echo $emp; ?>">
     <PARAM NAME="id" VALUE="<?php echo $id; ?>">
    </APPLET></td></tr>

<?php
}
}
include "librerias/closecon.php";
}
?>
</table>
</body>
</html>
