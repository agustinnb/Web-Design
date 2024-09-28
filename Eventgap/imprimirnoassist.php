<?php session_start();

if (isset($_SESSION['tk_username'])){  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?php 

$nomevent=$_GET['nomevent'];
$id=$_GET['id'];
$name = $_GET['name'];
$emp = $_GET['emp']; 
$emp=str_replace("!", " ",$emp);
$emp=utf8_decode($emp);

if (strlen($name)<20){
$name=str_replace("!", " ",$name);
$name=str_replace("_"," ",$name);
}else{
$name2 = explode("_",$name);
$name3=explode("!",$name2[0]);
$name4=explode("!",$name2[1]);
$temp= substr($name3[1],0,1);
$name=$name3[0] . " " . $temp . ". ";
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

<APPLET CODE="Imprimir.class" ARCHIVE= "Imprimir.jar" WIDTH=300 HEIGHT=100>
	<PARAM NAME="Nombre" VALUE="<?php echo $name; ?>">
	<PARAM NAME="Empresa" VALUE="<?php echo $emp; ?>">
    <PARAM NAME="id" VALUE="<?php echo $id; ?>">
    </APPLET>
	<script type="text/javascript">
<!--
if ((document.applets[0].getLHost())!=null){

window.close();
}

</script>

</body>
</html>
<?php } ?>