<?php session_start();

if (isset($_SESSION['tk_username'])){  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body onunload="opener.document.location.reload();">
<?php 
$nomevent=$_GET['nomevent'];
$id=$_GET['id'];
$asistente=$_GET['asis'];
include "librerias/mysqlconnect.php";
$query="UPDATE $nomevent SET asistente = $asistente WHERE id=$id";
echo $query;
mysql_query($query) or die("Error enviando la asistencia a la base de datos.");
include "librerias/closecon.php";


?>
<script language="javascript" type="text/javascript">window.close();</script>
</body>
</html>
<?php } ?>
