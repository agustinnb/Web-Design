<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema eventos</title>


<script language="javascript">
function valida_envia(frm){
    //valido el nombre
	document.getElementById('error1').style.visibility = 'hidden';
	document.getElementById('error2').style.visibility = 'hidden';
    if (document.login.usuario.value.length==0){
        document.getElementById('error1').style.visibility = 'visible';
       document.login.usuario.focus()
       return false;
    }
	  if (document.login.passwd.value.length==0){

       document.getElementById('error2').style.visibility = 'visible';
       document.login.passwd.focus()
       return false;
    }
if (document.login.usuario.value.length!=0 && document.login.passwd.value.length!=0){
    document.contacto.submit();
	}
} 

</script>




<style type="text/css">
<!--
.tit {font-family: Arial, Helvetica, sans-serif}
.bod {font-family: Arial, Helvetica, sans-serif; 
		font-size: 12px}
.error {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #FF0000;
}
-->
</style></head>

<body>
<noscript>
<table  align="center"><tr><td class="tit"><div align="center">Su navegador no soporta o tiene deshabilitado javascript.</div></td></tr>
<tr><td td class="tit"><div align="center">Para habilitarlo, por favor, siga las siguientes <b>intrucciones</b>:
</div><br />
        <br /></td></tr>
<tr>
  <td class="bod">En caso de utilizar <b>Internet explorer 5/6/7/8</b>:</td>
</tr>
<tr><td class="bod">1. Haga click en <b>Herramientas</b> y luego en <b>Opciones de Internet</b></td></tr>
<tr><td class="bod">2. Haga click en la carpeta <b>Seguridad</b></td></tr>
<tr><td class="bod">3. Haga click en el bot&oacute;n <b>Nivel personalizado</b></td></tr>
<tr><td class="bod">4. Vaya a la secci&oacute;n de<b>Automatizaci&oacute;n</b></td></tr>
<tr><td class="bod">5. Seleccione <b>Activar en Automatización de los subprogramas de Java, Permitir operaciones de pegado por medio de una secuencia de comandos y Secuencias de comandos ActiveX</b></td></tr>
<tr><td class="bod">6. Haga click en el bot&oacute;n <b>Aceptar</b><br /><br /></td></tr>
<tr>

<tr>
  <td class="bod">En caso de utilizar <b>Google Chrome</b>:</td>
</tr>
<tr><td class="bod">1. Dentro de <b>Personaliza y controla Google Chrome</b>, haga click en <b>Opciones</b></td></tr>
<tr><td class="bod">2. Seleccione la pesta&ntilde;a <b>Opciones avanzadas</b></td></tr>
<tr><td class="bod">3. Dentro de <b>Red</b>, haga click en <b>Cambiar la configuraci&oacute;n del proxy</b></td></tr>
<tr><td class="bod">4. Selecciona la pesta&ntilde;a <b>Seguridad</b></td></tr>

<tr><td class="bod">5. Haz click en el bot&oacute;n <b>Nivel personalizado</b></td></tr>
<tr><td class="bod">6. Dentro de la ventana <b>Configuraci&oacute;n de seguridad – Zona Internet</b>, en <b>Script</b>, marque las casillas <b>Activar</b>, incluido el <b>Script de los Applets Java</b></td></tr>
<tr><td class="bod">7. Haga click en <b>OK</b> para cerrar la ventana <b>Configuración de seguridad – Zona Internet</b></td></tr>
<tr><td class="bod">8. Haz click en <b>OK</b> para cerrar <b>Google Chrome</b><br /><br /></td></tr>

<tr>  <td class="bod">En caso de utilizar <b>Mozilla Firefox 1.5/2/3</b>:</td>
</tr>
<tr><td class="bod">1. Seleccione <b>Herramientas</b></td></tr>
<tr><td class="bod">2. Seleccione <b>Opciones</b></td></tr>
<tr><td class="bod">3. Seleccione <b>Contenido</b></td></tr>
<tr><td class="bod">4. Seleccione la casilla de <b>Habilitar JavaScript</b></td></tr>
<tr><td class="bod">5. Haga click en <b>Ok</b><br /><br /></td></tr>

 

 

 


 

 


</table>
</noscript>
<?php 
if (!(isset($_SESSION['tk_username']))){ ?>
<table align="center" width="417" height="336" background="img/login.png"><tr>
  <td valign="middle">
 <table align="center"> <form name="login" onSubmit="return valida_envia(this)" method="post">
 <tr><td align="center" class="bod">Nombre de usuario:</td>
 </tr>
 <tr><td align="center"><input class="bod" name="usuario" /> </td></tr>
 <tr id="error1" style="visibility:hidden"><td align="center" class="error">El nombre de usuario ingresado no es valido</td>
 </tr>
 
 <tr><td align="center" class="bod">Contrase&ntilde;a:</td>
 </tr>
 <tr><td align="center"><input class="bod" name="passwd" type="password" /> </td></tr>
  <tr id="error2" style="visibility:hidden">
    <td align="center" class="error">La contrase&ntilde;a ingresada no es valida</td>
 </tr>
  <tr><td align="center"><input class="bod" name="enter" type="submit" value="Ingresar" /> </td></tr></form>
 <?php 

 if (isset($_POST['enter'])){
 include "librerias/mysqlconnect.php";
 $usuario=strtolower($_POST['usuario']);
 $passwd=$_POST['passwd'];
 $pass=md5($passwd);
 $query= "SELECT * from organizadores where usuario='$usuario'";
 $result=mysql_query($query) or die ("Error conectando con la tabla de usuarios");
 $row=@mysql_fetch_assoc($result);
 if ($row['usuario']==''){
  echo "<tr><td class='error' align='center'>El nombre de usuario es invalido</td></tr>";
 }else{
 if ($row['passwd']==$pass){
 $_SESSION['tk_username']= $row['usuario'];
   echo "<meta http-equiv=refresh content=0;URL=principal.php>";
  }else{
  echo "<tr><td class='error' align='center'>La password ingresada es invalida</td></tr>";
  }
  }

  include "librerias/closecon.php";
 } 

 ?>
 </table></td></tr></table>
 <?php
 
 }else{
  echo "<meta http-equiv=refresh content=0;URL=principal.php>"; } ?>
</body>
</html>
