<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>El usuario</title>
<script>
function doit(){
var wsh = new ActiveXObject('WScript.Shell');
var usuario = wsh.ExpandEnvironmentStrings('%USERNAME%');
document.elform.T1.value= usuario;
}
</script>
</head>

<body onload="doit()">

<form  name="elform" method="POST" action="ldap.php">
	
<p><input type="text" name="T1" size="20">
<input type="submit" value="Enviar" name="B1">
<input type="reset" value="Restablecer" name="B2"></p>

</form>

</body>

</html> 