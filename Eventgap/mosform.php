<?php session_start();

if (isset($_SESSION['tk_username'])){ 
include "librerias/mysqlconnect.php";
$user=$_SESSION['tk_username'];
$query= "SELECT * FROM organizadores WHERE usuario= '$user'";
$result = mysql_query($query) or die ("Error buscando el usuario en la DB");
$raw=@mysql_fetch_assoc($result);
if ($raw['rango']=="A" || $raw['rango']=="S"){
	if (isset($_GET['nom'])){
		$nom=$_GET['nom'];
$query= "SELECT * FROM eventos WHERE nom='$nom'";	
$result=mysql_query($query);
$row=@mysql_fetch_assoc($result);
$id=$row['id'];
$fechin=$row['fechin'];
$fechter=$row['fechter'];
$fechinsc=$row['fechinsc'];
$fechinscter=$row['fechinscter'];
$horain=$row['horain'];
$horater=$row['horater'];
$idorg=$row['organizador'];
$nomevent=$row['nomevent'];
$cantcampos=$row['cantcampos'];
$cantmax=$row['cantmax'];
$ubic=$row['ubic'];
$directivas=$row['directivas'];
$dir=explode(";",$directivas);
$i=0;
for ($x=0;$x<$cantcampos;$x++){
	$campo[$x]=$dir[$i];
	$tipovarcamp[$x]=$dir[$i+1];
	$optioncamp[$x]=$dir[$i+2];
	$moscampo[$x]=$campo[$x];
	
	$i=$i+3;
	if ($tipovarcamp[$x]==9){
	echo "<script language='javascript'>
	function habilita$x()
{


document.getElementById('otro1_$moscampo[$x]').style.visibility='visible';




}

function deshabilita$x()
{

document.getElementById('otro1_$moscampo[$x]').style.visibility='hidden';	

}
	
</script>"; } }
	?>
    <script language="javascript">
	function guardo(){


var answer = confirm ("Recuerde que la inscripción no podra ser modificada. ¿Desea continuar?")
if (answer){
	document.getElementById('guardare').style.visibility="hidden";
	document.getElementById('iframe').style.visibility='visible';

	document.getElementById('iframe2').style.visibility='visible';

	}else{
return (false); }
	}
    </script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crear nuevo evento</title>
<link rel="stylesheet" type="text/css" media="screen" href="librerias/css/others.css" />
<link rel="stylesheet" type="text/css" media="screen" href="librerias/css/chili.css" />

<script src="librerias/calendar.jsp" type="text/javascript"></script>
<script src="librerias/lib/jquery.js" type="text/javascript"></script>
<script src="librerias/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="librerias/js/jquery.maskedinput-1.0.js"></script>
<script type="text/javascript" src="librerias/js/ui.core.js"></script>
<script type="text/javascript" src="librerias/js/ui.accordion.js"></script>
<style type="text/css">
<!--
.tit {font-family: Arial, Helvetica, sans-serif}
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
<!-- #botonfechin { background:url('img/calendar_icon.jpg') no-repeat; border:none; width:35px; height:37px; }

-->
</style>
</head>

<body>

<form id="evento_<?php echo $nom; ?>" autocomplete="off" name="evento_<?php echo $nomevent; ?>" method="post">
<table align="center"><tr><td class="bod"colspan='4' align="center">La inscripci&oacute;n al evento se vera de la siguiente manera: </td></tr>
<tr><td class="tit"colspan='2' align="center"><b>Inscripci&oacute;n</b></td><td colspan="2"></td></tr>
<tr><td></td></tr>

<?php
	for ($x=0;$x<$cantcampos;$x++){
	echo "<tr><td class='bod'><label id='l$moscampo[$x]' for='$moscampo[$x]'>" . utf8_decode($moscampo[$x]); if ($optioncamp[$x]==1){ echo "(*)"; }
	echo "</label></td>";
	if ($tipovarcamp[$x]==1){
		echo "<td class='bod'><input id='$moscampo[$x]' readonly='readonly' name='$moscampo[$x]' type='text' maxlength='20' /></td><td colspan='2'></td>";
	}
	if ($tipovarcamp[$x]==2){
		echo "<td class='bod'><input id='$moscampo[$x] readonly='readonly'' name='$moscampo[$x]' type='text' maxlength='50' /></td><td colspan='2'></td>";
	}
		if ($tipovarcamp[$x]==3){
		echo "<td class='bod'><input id='$moscampo[$x]' readonly='readonly' name='$moscampo[$x]' type='text' maxlength='50' /></td><td colspan='2'></td>";
	}
			if ($tipovarcamp[$x]==4){
		echo "<td class='bod'><input id='$moscampo[$x]' readonly='readonly' name='$moscampo[$x]' type='text' maxlength='50' /></td><td colspan='2'></td>";
	}
	
				if ($tipovarcamp[$x]==5){
		echo "<td class='bod'><textarea cols='100' readonly='readonly' class='bod' id=''$moscampo[$x]' name='$moscampo[$x]' rows='10'></textarea></td><td colspan='2'></td>";
	}
					if ($tipovarcamp[$x]==6){
		echo "<td  class='bod'><input size='10' class='bod' id='fc_$x' type='text' readonly='readonly' name='$moscampo[$x]' title='YYYY-MM-DD' /></td>
             <td class'bod'> <input type='button' value='=' name='boton$moscampo[$x]' id='boton$moscampo[$x]' onclick='displayCalendarFor('fc_$x');' /></td><td class='bod'><input type='button' value='X' class='bod' onclick='javascript:getElementById('fc_$x').value='';' /></td><td class='bod'></td>";
	}
	if ($tipovarcamp[$x]==7){
				
		echo "<td class='bod'><input id='$moscampo[$x]' readonly='readonly' name='$moscampo[$x]' type='text' maxlength='50' /></td><td colspan='3'></td>";

	}
	if ($tipovarcamp[$x]==8){
				
		echo "<td class='bod'><select name='$moscampo[$x]'>
            <option>Afganistán</option>
            <br />
            <option>Albania</option>
            <br />
            <option>Alemania</option>
            <br />
            <option>Andorra</option>
            <br />
            <option>Angola</option>
            <br />
            <option>Anguila</option>
            <br />
            <br />
            <option>Antigua y Barbuda</option>
            <br />
            <option>Arabia Saudí</option>
            <br />
            <option>Argelia</option>
			<br />
            <option selected='selected'>Argentina</option>
             <br />
            <option>Armenia</option>
            <br />
            <option>Australia</option>
            <br />
            <option>Austria</option>
            <br />
            <option>Azerbaiyán</option>
            <br />
            <option>Bahamas</option>
            <br />
            <option>Bahráin</option>
            <br />
            <option>Bangladesh</option>
            <br />
            <option>Barbados</option>
            <br />
            <option>Bélgica</option>
            <br />
            <option>Belice</option>
            <br />
            <option>Benín</option>
            <br />
            <option>Bermudas</option>
            <br />
            <option>Bielorrusia</option>
            <br />
            <br />
            <option>Bolivia</option>
            <br />
            <option>Bosnia y Herzegovina</option>
            <br />
            <option>Botsuana</option>
            <br />
            <option>Brasil</option>
            <br />
            <option>Brunéi</option>
            <br />
            <option>Bulgaria</option>
            <br />
            <option>Burkina Faso</option>
            <br />
            <option>Burundi</option>
            <br />
            <option>Bután</option>
            <br />
            <option>Cabo Verde</option>
            <br />
            <option>Camboya</option>
            <br />
            <option>Camerún</option>
            <br />
            <option>Canadá</option>
            <br />
            <option>Chad</option>
            <br />
            <option>Chequia</option>
            <br />
            <option>Chile</option>
            <br />
            <option>China</option>
            <br />
            <option>Chipre</option>
            <br />
            <option>Cisjordania y Franja de Gaza</option>
            <br />
            <option>Colombia</option>
            <br />
            <option>Comoras</option>
            <br />
            <option>Congo</option>
            <br />
            <option>Corea del Norte</option>
            <br />
            <option>Corea del Sur</option>
            <br />
            <option>Costa de Marfil</option>
            <br />
            <option>Costa Rica</option>
            <br />
            <option>Croacia</option>
            <br />
            <option>Cuba</option>
            <br />
            <option>Dinamarca</option>
            <br />
            <option>Dominica</option>
            <br />
            <option>Ecuador</option>
            <br />
            <option>Egipto</option>
            <br />
            <option>El Salvador</option>
            <br />
            <option>Emiratos Árabes Unidos</option>
            <br />
            <option>Eritrea</option>
            <br />
            <option>Eslovaquia</option>
            <br />
            <option>Eslovenia</option>
            <br />
            <option>España</option>
            <br />
            <option>Estados Unidos</option>
            <br />
            <option>Estonia</option>
            <br />
            <option>Etiopía</option>
            <br />
            <option>Filipinas</option>
            <br />
            <option>Finlandia</option>
            <br />
            <option>Fiyi</option>
            <br />
            <option>Francia</option>
            <br />
            <option>Gabón</option>
            <br />
            <option>Gambia</option>
            <br />
            <option>Georgia</option>
            <br />
            <option>Ghana</option>
            <br />
            <option>Granada</option>
            <br />
            <option>Grecia</option>
            <br />
            <option>Guadalupe</option>
            <br />
            <option>Guadalupe</option>
            <br />
            <option>Guam</option>
            <br />
            <option>Guatemala</option>
            <br />
            <option>Guinea</option>
            <br />
            <option>Guinea-Bissau</option>
            <br />
            <option>Guinea Ecuatorial</option>
            <br />
            <option>Guyana</option>
            <br />
            <option>Haití</option>
            <option>Holanda</option>
            <br />
            <br />
            <option>Honduras</option>
            <br />
            <option>Hong Kong</option>
            <br />
            <option>Hungría</option>
            <br />
            <option>India</option>
            <br />
            <option>Indonesia</option>
            <br />
            <option>Irán</option>
            <br />
            <option>Iraq</option>
            <br />
            <option>Irlanda</option>
            <br />
            <option>Islandia</option>
            <br />
            <option>Islas Marshall</option>
            <br />
            <option>Islas Salomón</option>
            <br />
            <option>Israel</option>
            <br />
            <option>Italia</option>
            <br />
            <option>Jamaica</option>
            <br />
            <option>Japón</option>
            <br />
            <option>Jordania</option>
            <br />
            <option>Kazajistán</option>
            <br />
            <option>Kenia</option>
            <br />
            <option>Kirguizistán</option>
            <br />
            <option>Kiribati</option>
            <br />
            <option>Kuwait</option>
            <br />
            <option>Laos</option>
            <br />
            <option>Lesoto</option>
            <br />
            <option>Letonia</option>
            <br />
            <option>Líbano</option>
            <br />
            <option>Liberia</option>
            <br />
            <option>Libia</option>
            <br />
            <option>Liechtenstein</option>
            <br />
            <option>Lituania</option>
            <br />
            <option>Luxemburgo</option>
            <br />
            <option>Macedonia</option>
            <br />
            <option>Madagascar</option>
            <br />
            <option>Malasia</option>
            <br />
            <option>Malaui</option>
            <br />
            <option>Maldivas</option>
            <br />
            <option>Malí</option>
            <br />
            <option>Malta</option>
            <br />
            <option>Marruecos</option>
            <br />
            <option>Mauritania</option>
            <br />
            <option>Mauricio</option>
            <br />
            <option>México</option>
            <br />
            <option>Micronesia</option>
            <br />
            <option>Moldavia</option>
            <br />
            <option>Mónaco</option>
            <br />
            <option>Mongolia</option>
            <br />
            <option>Montenegro</option>
            <br />
            <option>Mozambique</option>
            <br />
            <option>Myanmar</option>
            <br />
            <option>Namibia</option>
            <br />
            <option>Nauru</option>
            <br />
            <option>Nepal</option>
            <br />
            <option>Nueva Zelanda</option>
            <br />
            <option>Nicaragua</option>
            <br />
            <option>Níger</option>
            <br />
            <option>Nigeria</option>
            <br />
            <option>Niue</option>
            <br />
            <option>Noruega</option>
            <br />
            <option>Omán</option>
            <br />
            <option>Países Bajos</option>
            <br />
            <option>Pakistán</option>
            <br />
            <option>Palau</option>
            <br />
            <option>Palestina</option>
            <br />
            <option>Panamá</option>
            <option>Nueva Guinea</option>
            <br />
            <br />
            <option>Paraguay</option>
            <br />
            <option>Perú</option>
            <br />
            <option>Polonia</option>
            <br />
            <option>Portugal</option>
            <br />
            <option>Puerto Rico</option>
            <br />
            <option>Quatar</option>
            <br />
            <option>Reino Unido</option>
            <br />
            <option>República Centroafricana</option>
            <br />
            <br />
            <option>República Dominicana</option>
            <br />
            <option>Rumania</option>
            <br />
            <option>Rusia</option>
            <br />
            <option>Ruanda</option>
            <br />
            <option>Sahara Occidental</option>
            <br />
            <option>Samoa</option>
            <br />
            <option>San Cristóbal y Nieves</option>
            <br />
            <option>San Marino</option>
            <br />
            <option>San Vicente y las Granadinas</option>
            <br />
            <option>Santa Lucía</option>
            <br />
            <option>Santo Tomé y Príncipe</option>
            <br />
            <option>Senegal</option>
            <br />
            <option>Serbia</option>
            <br />
            <option>Seychelles</option>
            <br />
            <option>Sierra Leona</option>
            <br />
            <option>Singapur</option>
            <br />
            <option>Siria</option>
            <br />
            <option>Somalía</option>
            <br />
            <option>Sri Lanka</option>
            <br />
            <option>Sudáfrica</option>
            <br />
            <option>Sudán</option>
            <br />
            <option>Suecia</option>
            <br />
            <option>Suiza</option>
            <br />
            <option>Surinam</option>
            <br />
            <option>Suazilandia</option>
            <br />
            <option>Tailandia</option>
            <br />
            <option>Taiwán</option>
            <br />
            <option>Tanzania</option>
            <br />
            <option>Tayikistán</option>
            <br />
            <option>Timor Oriental</option>
            <br />
            <option>Togo</option>
            <br />
            <option>Tonga</option>
            <br />
            <option>Trinidad y Tobago</option>
            <br />
            <option>Túnez</option>
            <br />
            <option>Turkmenistán</option>
            <br />
            <option>Turquía</option>
            <br />
            <option>Tuvalu</option>
            <br />
            <option>Ucrania</option>
            <br />
            <option>Uganda</option>
            <br />
            <option>Uruguay</option>
            <br />
            <option>Uzbekistán</option>
            <br />
            <option>Vanuatu</option>
            <br />
            <option>Vaticano</option>
            <br />
            <option>Venezuela</option>
            <br />
            <option>Vietnam</option>
            <br />
            <option>Yemen</option>
            <br />
            <option>Yibuti</option>
            <br />
            <option>Yugoslavia</option>
            <br />
            <option>Zambia</option>
            <br />
            <option>Zimbabue</option>
            <br />
          </select></td><td colspan='2'></td>";

	}
		if ($tipovarcamp[$x]==9){
				
		echo "<td class='bod' ><select name='$moscampo[$x]'>
            <option onclick='javascript:deshabilita$x();'>Director general</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Secretario/a de direcci&oacute;n</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director comercial</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director de marketing</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Product manager</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Export manager</option>
            <br />
            <br />
            <option onclick='javascript:deshabilita$x();'>Jefe de ventas</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>T&eacute;cnico comercial</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director de producci&oacute;n</option>
			  <br />
            <option onclick='javascript:deshabilita$x();'>Responsable de mantenimiento</option>
              <br />
            <option onclick='javascript:deshabilita$x();'>Mecanico</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director de I+D</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director de calidad</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>T&eacute;cnico de calidad</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director de logistica</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director de recursos humanos</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director de formacion</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Tecnico de seleccion</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director administrativo financiero</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Controller</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Contable</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Secretaria/o de recepci&oacute;</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Director de sistemas de informaci&oacute;n</option>
            <br /> 
            <option onclick='javascript:deshabilita$x();'>Analista</option>
            <br />
            <option onclick='javascript:deshabilita$x();'>Programador</option>
            <br />
            <option onclick='javascript:habilita$x();'>Otro...</option>
            <br />
    
          </select></td><td  colspan='2' id='otro1_$moscampo[$x]' style='visibility:hidden;' readonly='readonly' class='bod'><input type='text' name='otro_$moscampo[$x]' id='otro_$moscampo[$x]' maxlength='50'  /></td>";

	}
	echo "</tr>";
	}
	?>
     <tr><td class="bod">Verificaci&oacute;n del numero</td><td>
	
	  <input name="txtNumber" readonly="readonly" type="text" class="bod" id="txtNumber" value="" size="8" maxlength="5" /><img align="absmiddle" src="randomImage.php" />
    <tr align="center" id="iframe" style='visibility:hidden;'><td class="bod" colspan="4">Por favor ingrese el siguiente codigo en su pagina web:  <textarea> <iframe src="http://files.usuaria.org.ar/sistema_acreditaciones/eventos2/inscripcion.php?id=<?php echo $id; ?>"
      width="800" height="500" scrolling="auto" frameborder="1" transparency>
     </iframe></textarea>
</td></tr>

    <tr id="guardare" style="visibility:visible" ><td colspan="2"   align="center"><input type="button" onClick="guardo();" value="Guardar" name="guardar" /><input type="submit" value="Volver atras" name="volver" id='volver' /></td></tr>
     <tr id="iframe2" style='visibility:hidden;' ><td colspan="4"  align="center"><input type="button" value="Volver a la pagina principal"  name="volverprin" id='volverprin' onClick="window.top.location='principal.php';" /></td></tr>
    <?php 
if (isset($_POST['volver'])){
$query="DROP TABLE $nomevent";
rmdir("tablasexcel$nomevent");
mysql_query($query) or die("<tr><td colspan='4' class='error'>Error borrando la tabla</td></tr>");
$query="DELETE FROM eventos where id=$id";
mysql_query($query) or die("<tr><td colspan='4' class='error'>Error borrando el evento</td></tr>");
$guardo="";
for($x=0;$x<$cantcampos;$x++){
	$guardo.="&campo_$x=" . $campo[$x] . "&tipovarcamp_$x=" . $tipovarcamp[$x] . "&optioncamp_$x=" . $optioncamp[$x];
}

echo "<script languaje='javascript' type='text/javascript'>window.top.location='principal.php?nom=$nom&cantcampos=$cantcampos&fechin=$fechin&ubic=$ubic&fechter=$fechter&horain=$horain&horater=$horater$guardo#crearevento'; parent.parent.GB_hide();</script>";
}


include "librerias/closecon.php";
}else{
	header("Location:crearevento.php"); 	}
}else{
	header("Location:index.php"); }
}else{
header("Location:index.php");
}

?>

</table>
</form>

</body>
</html>