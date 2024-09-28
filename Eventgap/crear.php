<?php session_start(); 
if (isset($_SESSION['tk_username'])){ 
include "librerias/mysqlconnect.php";
include "validaciones/diferencia_fechas.php";
$user=$_SESSION['tk_username'];
$query= "SELECT * FROM organizadores WHERE usuario= '$user'";
$result = mysql_query($query) or die ("Error buscando el usuario en la DB");
$raw=@mysql_fetch_assoc($result);
$id=$raw['id'];
if (isset($_GET['id'])){
$eventid=$_GET['id'];

$rango=$raw['rango'];
if ($rango=='A' || $rango=='S'){
if ($rango=='A'){
	$query="SELECT * FROM eventos WHERE id=$eventid AND organizador=$id";
}
if ($rango=='S'){
$query="SELECT * FROM eventos WHERE id=$eventid";

}
}else{
$rangous=explode(";",$rango);
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$eventid){
$query="SELECT * FROM eventos WHERE id=$eventid";

}
}
}
if ($query==""){
die ("Usted no es un organizador valido para este evento");
}
$result=mysql_query($query) or die ("Usted no es un organizador valido para este evento");
$row=@mysql_fetch_assoc($result);
$id=$row['organizador'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Crear nuevo usuario</title>

<script src="librerias/calendar.jsp" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
var error_name;
function validarSiNumero(numero,campo){
if (numero!=""){
if (!/^-?[0-9]+([-][0-9]*)?$/.test(numero)) {

error_name="Error, el campo " + campo + " debe ser un numero";
document.getElementById('erroresjsp').innerHTML="Error, el campo " + campo + " debe ser un numero";
return (false);
}else{
	document.getElementById('erroresjsp').innerHTML="";
	return (true);
} 
}
}

function validarSiNumeroConComa(numero,campo){
if (numero!=""){
if (!/^-?[0-9]+([,\.\-][0-9]*)?$/.test(numero)) {

error_name="Error, el campo " + campo + " debe ser un numero";
document.getElementById('erroresjsp').innerHTML="Error, el campo " + campo + " debe ser un numero";
return (false);

}else{
	document.getElementById('erroresjsp').innerHTML="";
	return (true);
} 
}
}




function validarEmail(valor) {
	if (valor!=""){
	if (/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/.test(valor)){
	
document.getElementById('erroresjsp').innerHTML="";
return (true);
} else {
	
error_name="Error, " + valor + " no es un mail valido";
	document.getElementById('erroresjsp').innerHTML="Error, " + valor + " no es un mail valido";

return (false);
}
	} else{ return (true); }

}





</script> 

<?php function comprobar_email($email){
    $mail_correcto = 0;
    //compruebo unas cosas primeras
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
          //miro si tiene caracter .
          if (substr_count($email,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($email, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
    if ($mail_correcto)
       return 1;
    else
       return 0;
}
?>


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
<!-- #botonfechter { background:url('img/calendar_icon.jpg') no-repeat; border:none; width:35px; height:37px; }
 <!-- #botonfechinsc { background:url('img/calendar_icon.jpg') no-repeat; border:none; width:35px; height:37px; }
<!--#botonfechinscter { background:url('img/calendar_icon.jpg') no-repeat; border:none; width:35px; height:37px; }
-->
</style>
<?php


$nom=$row['nom'];
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
$cantinsc=$row['cantinsc'];

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
 
   if (!($resultado>0 && $resultado2<0)){
	   echo "Este evento no puede ser moderado debido a que ya ha terminado o aun no ha comenzado"; 
	   die();
	   }
  


$dir=explode(";",$directivas);
$i=0;
for ($x=0;$x<$cantcampos;$x++){
	$campo[$x]=$dir[$i];
	$tipovarcamp[$x]=$dir[$i+1];
	$optioncamp[$x]=$dir[$i+2];
	$moscampo[$x]=$campo[$x];
	$moscampo[$x]=str_replace("/","",$moscampo[$x]);
		$moscampo[$x]=str_replace("-","",$moscampo[$x]);

	$i=$i+3;
	if ($tipovarcamp[$x]==9){
	echo "<script language='javascript'>
	function habilita$x()
{


document.getElementById('otro_campo_$x').style.visibility='visible';




}

function deshabilita$x()
{

document.getElementById('otro_campo_$x').style.visibility='hidden';	

}
	
</script>"; } }
	?>

<script  language="javascript" type="text/javascript">



function valido_form(form){
var error=false;
<?php for ($x=$cantcampos-1;$x>-1;$x--){

 if ($tipovarcamp[$x]==3){

echo "\n if (validarSiNumero(document.getElementById('$moscampo[$x]').value,document.getElementById('$moscampo[$x]').id)==false){ error=true; \n }\n";

}  
 if ($tipovarcamp[$x]==4){

echo "\n if (validarSiNumeroConComa(document.getElementById('$moscampo[$x]').value,document.getElementById('$moscampo[$x]').id)==false){ error=true; }\n";

} 
  if ($tipovarcamp[$x]==7){

echo "\n if (validarEmail(document.getElementById('$moscampo[$x]').value)==false){ error=true; }\n";

}  }


?>

if (error==false){
document.getElementById('evento_<?php echo $nomevent; ?>').submit();
window.close();

}else{
	document.getElementById('erroresjsp').innerHTML=error_name;
return (false);
}
}

function salir(){
parent.location=parent.location + '&search=' + document.getElementById('<?php echo $moscampo[1]; ?>').value + "&searcht=campo_1";
}

</script>


</head>

<body onunload="salir()">

<table align="center">
<form id="evento_<?php echo $nomevent; ?>" action="" onsubmit="return valido_form(this);" autocomplete="off" name="evento_<?php echo $nomevent; ?>" method="post">


<?php
	for ($x=0;$x<$cantcampos;$x++){
	echo "<tr><td class='bod'><label id='l$moscampo[$x]' for='$moscampo[$x]'>$campo[$x]</label></td>";
	if ($tipovarcamp[$x]==1){
		echo "<td class='bod'><input id='$moscampo[$x]'  name='campo_$x' type='text' maxlength='20' /></td><td colspan='2'></td>";
	}
	if ($tipovarcamp[$x]==2){
		echo "<td class='bod'><input id='$moscampo[$x]' name='campo_$x' type='text' maxlength='50' /></td><td colspan='2'></td>";
	}
		if ($tipovarcamp[$x]==3){
		echo "<td class='bod'><input id='$moscampo[$x]'  name='campo_$x' type='text' maxlength='50' /></td><td colspan='2'></td>";
	}
			if ($tipovarcamp[$x]==4){
		echo "<td class='bod'><input id='$moscampo[$x]'  name='campo_$x' type='text' maxlength='50' /></td><td colspan='2'></td>";
	}
	
				if ($tipovarcamp[$x]==5){
		echo "<td class='bod'><textarea cols='100'  class='bod' id='$moscampo[$x]' name='campo_$x' rows='10'></textarea></td><td colspan='2'></td>";
	}
					if ($tipovarcamp[$x]==6){
		echo "<td  class='bod'><input size='10' class='bod' id='fc_$x'  type='text' readonly='readonly' name='campo_$x' title='YYYY-MM-DD' /></td>
             <td class'bod'> <input type='button' value='=' name='botoncampo_$x' id='botoncampo_$x' onclick='displayCalendarFor('fc_$x');' /></td><td class='bod'><input type='button' value='X' class='bod' onclick='javascript:getElementById('fc_$x').value='';' /></td><td class='bod'></td>";
	}
	if ($tipovarcamp[$x]==7){
				
		echo "<td class='bod'><input id='$moscampo[$x]' name='campo_$x' type='text' maxlength='50' /></td><td colspan='3'></td>";

	}
	if ($tipovarcamp[$x]==8){
				
		echo "<td class='bod'><select name='campo_$x'>
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
			 <br />
            <option>Holanda</option>
           
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
		
			
		echo "<td class='bod' ><select  id='$moscampo[$x]' name='campo_$x'>
              <option value='-1' onclick='javascript:deshabilita$x();'>Elija un cargo...</option>
            <br />
			<option onclick='javascript:deshabilita$x();'>Director general</option>
            <br />
            <option  onclick='javascript:deshabilita$x();'>Secretario/a de direcci&oacute;n</option>
            <br />
            <option  onclick='javascript:deshabilita$x();'>Director comercial</option>
            <br />
            <option  onclick='javascript:deshabilita$x();'>Director de marketing</option>
            <br />
            <option  onclick='javascript:deshabilita$x();'>Product manager</option>
            <br />
            <option  onclick='javascript:deshabilita$x();'>Export manager</option>
            <br />
            <br />
            <option  onclick='javascript:deshabilita$x();'>Jefe de ventas</option>
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
            <option  onclick='javascript:deshabilita$x();'>Secretaria/o de recepci&oacute;</option>
            <br />
            <option  onclick='javascript:deshabilita$x();'>Director de sistemas de informaci&oacute;n</option>
            <br /> 
            <option  onclick='javascript:deshabilita$x();'>Analista</option>
            <br />
            <option  onclick='javascript:deshabilita$x();'>Programador</option>
            <br />
            <option value='otro' onclick='javascript:habilita$x();'>Otro...</option>
            <br />
    
          </select></td><td  colspan='2' id='otro_campo_$x'  style='visibility:hidden;' class='bod'><input type='text' name='otro1_campo_$x' id='otro1_campo_$x' maxlength='50'  /></td>";

	}
	echo "</tr>";
	}
	?>
   

    <tr><td colspan="4" class="error" id="erroresjsp" align="center"></td></tr>
    <tr><td colspan="4" align="center"><input class="bod"  type="submit" value="Guardar"   onclick="" name="enviar" /><input class="bod"  type="button" value="Volver"   onclick="parent.GB_hide();" /></td></tr>
    </form>
    <?php
	if (isset($_POST['enviar'])){
	

	for ($x=0;$x<$cantcampos;$x++){
	$campo[$x]=$_POST['campo_'. $x];
	
		if ($tipovarcamp[$x]==4){
			if ($campo[$x]==""){
			$campo[$x]="0";
			}
		if (is_numeric($campo[$x])==false){
				echo "<tr><td colspan='4' align='center' class='error'>El campo $moscampo[$x] tiene que ser numerico</td></tr>";
				die();
		}
		}
	if ($tipovarcamp[$x]==3){
			if ($campo[$x]==""){
			$campo[$x]=0;
			}
		if (!(preg_match("/^-?[0-9]+([,\.\-][0-9]*)?$/",$campo[$x]))){
				echo "<tr><td colspan='4' align='center' class='error'>El campo $moscampo[$x] tiene que ser decimal</td></tr>";
				die();
		}
		} 
			if ($tipovarcamp[$x]==7){
					if ($campo[$x]==""){
					$campo[$x]="none@none.com";
					}
		if (comprobar_email($campo[$x])==0){
				echo "<tr><td colspan='4' align='center' class='error'>El campo $moscampo[$x] tiene que ser un mail valido</td></tr>";
				die();
		}}
		if ($tipovarcamp[$x]==9 && $campo[$x]=="otro"){
			$campo[$x]=$_POST['otro1_campo_'.$x];
			if ($campo[$x]==""){
			echo "<tr><td colspan='4' align='center' class='error'>Por favor ingrese un puesto de trabajo</td></tr>";
				die();
			}
		}
	}
		$query="INSERT INTO $nomevent(";
		for ($x=0;$x<$cantcampos;$x++){
		
		$query.="campo_$x,";
		 }
		
		$query.="fecha,hora,fechaas,horaas,asistente) VALUES (";
		for ($x=0;$x<$cantcampos;$x++){
			if ($campo[$x]=="none@none.com"){
			$campo[$x]="";
			}
		$query.="'" . utf8_encode($campo[$x]) . "',";	
	
		}
		$fecha=date("Y-m-d");
		$hora=date("H:i");
		$query.="'$fecha','$hora','$fecha','$hora',1)";
		mysql_query($query) or die("Error insertando los datos en la tabla $query");

$query="SELECT cantas FROM eventos WHERE id=$eventid";
$result=mysql_query($query) or die ("<tr><td colspan='4' class='error' align='center'>Error ingresando a la tabla del evento</td></tr>");
$row=@mysql_fetch_assoc($result);
$cantas=$row['cantas'];
$cantas++;
$query="UPDATE eventos SET cantas = $cantas where id=$eventid";
mysql_query($query) or die ("<tr><td colspan='4' class='error' align='center'>Error updateando la DB</td></tr>");
$query="SELECT A from organizadores where id=$idorg";
$result=mysql_query($query) or die ("<tr><td colspan='4' class='error' align='center'>Error ingresando a la tabla de organizadores</td></tr>");
$row=@mysql_fetch_assoc($result);
$A=$row['A'];
$A++;
$query="UPDATE organizadores SET A=$A WHERE id=$idorg";
mysql_query($query) or die ("<tr><td  colspan='4' class='error' align='center'>Error updateando la tabla de organizadores</td></tr>");
echo "<script languaje='javascript' type='text/javascript'>parent.parent.location.reload(); parent.GB_hide(); </script>";
}
	
	?>
    
    </table>
</body>
<?php 
include "librerias/closecon.php";
}  } else{
	header("Location:http://agustinbottos.com.ar");
}
?>
</html>