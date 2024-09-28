<?php
/*
include ("LDAPapi/adLDAP.php");
session_start();
if (isset($_SESSION['user'])){
header("Location: index.php");

}else{
error_reporting(E_ALL ^ E_NOTICE);
if (isset($_GET['code'])){
$code=trim($_GET['code']);
if (isset($_GET['dom'])){
$dom=$_GET['dom'];
if (isset($_GET['user'])){
$user=$_GET['user'];
mysql_connect("localhost","root","") or die("No me pude conectar a la DB 1");
mysql_select_db("dbProyecTA");
$query="SELECT * FROM codigos WHERE codigo='$code'";
$result=mysql_query($query);
$row=mysql_fetch_assoc($result);
if ($row['codigo']==$code){
$query="DELETE FROM codigos WHERE codigo='$code'";
mysql_query($query) or die("2");
mysql_close();
$ldap=new adLDAP();
$ldap->authenticate("AgustinB","A17n333b110*");
$result=$ldap->user_info("$user");
$ARRAYPRUEBA=array("LALALA","LLALALALA",array("ASDSDA","ADSADS"));
echo "<br /> <br />";
//for ($x=0;$x<count($result);$x++){
//for ($i=0;$i<count($result[$x]);$i++){

//}
//}

$dn=$result[0]['dn'];
$dna=split("OU=",$dn);
$dn=substr($dna[1],0,7);
echo $dn;
if ($dn=="TAUsers"){ 
$_SESSION['user']=$user; 
header("Location: index.php");
 }

}
}}}


} */

session_start();
if (isset($_GET['code'])){
$code=trim($_GET['code']);
if (isset($_GET['dom'])){
$dom=$_GET['dom'];
if (isset($_GET['user'])){
$user=$_GET['user'];
mysql_connect("localhost","root","") or die("No me pude conectar a la DB 1");
mysql_select_db("dbProyecTA");
$query="SELECT * FROM codigos WHERE codigo='$code'";
$result=mysql_query($query);
$row=mysql_fetch_assoc($result);
if ($row['codigo']==$code){
$query="DELETE FROM codigos WHERE codigo='$code'";
mysql_query($query) or die("2");
mysql_close();
}}}}
$_SESSION['user']=$user; 
header("Location: index.php");

//}
/*
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
  <style type="text/css">
b {
	color: #373737;
	font: 15px "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-weight: 300;
	line-height: 1.625;

}
h2 {
	color: #373737;
	font: 25px "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-weight: 300;
	line-height: 1.625;

}
</style>
</head>

<body>
<table>
<form method="post" name="formlogin">
<tr><td align="center" colspan="2"><h2>Ingrese sus credenciales</h2></td></tr>
<tr><td><b>Username:</b></td><td><input name="user" /></td></tr>
<tr><td><b>Password:</b></td><td><input name="pass" type="password"  /></td></tr>
<tr><td align="center" colspan="2"><input type="submit" name="butlogin" value="Login" /></td></tr>
</form>

<?php
if (isset($_POST['butlogin'])){
$user=trim(strtolower($_POST['user']));
$pass=md5($_POST['pass']);
mysql_connect("localhost","root","Trend123") or die("<tr><td align='center' colspan='2'>No me pude conectar a la DB 1</td></tr>");
mysql_select_db("dbProyecTA");
$query="SELECT * FROM users where user='$user'";
$result=mysql_query($query) or die ("<tr><td align='center' colspan='2'>No me pude conectar a la DB 2</td></tr>");
$row=mysql_fetch_assoc($result);
if ($row['user']==$user){
if ($row['pass']==$pass){
	$date=date("Y-m-d");
$query="UPDATE users SET fechlact = '$date' WHERE user='$user'";
mysql_query($query) or die ("<tr><td align='center' colspan='2'>No me pude conectar a la DB 3</td></tr>");

$_SESSION['user']=$row['user'];	
}else{
echo "<tr><td align='center' colspan='2'>La contrase&ntilde;a ingresada es invalida</td></tr>";
}}else{
echo "<tr><td align='center' colspan='2'>El nombre de usuario ingresado es invalido</td></tr>";
}
mysql_close();
}
?>
</table>
</body>
</html>
*/

?>