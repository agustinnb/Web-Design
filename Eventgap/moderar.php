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
	   echo "Este evento no puede ser moderado debido a que ya ha terminado o aun no ha comenzado"; }else{
 $nom=$row['nom'];
$nomevent=$row['nomevent'];
$cantcampos=$row['cantcampos'];
$directivas=$row['directivas'];
$dir=explode(";",$directivas);
$i=0;
for ($x=0;$x<$cantcampos;$x++){
	$campo[$x]=$dir[$i];
	$tipovarcamp[$x]=$dir[$i+1];
	$i=$i+3;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Moderar evento</title>
<style type="text/css">




a:link {text-decoration: none;
color:#000;}
a:visited {text-decoration: none;
color:#000;
			}




</style>
<link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="js/bsn.AutoSuggest_c_2.0.js"></script>


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>

    
    
    
    
    
    
    
    
    
    
    
    
           <link type="text/css" rel="stylesheet" media="all" href="css/base.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/jquery-ui.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/grid.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/visualize.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/excanvas.js"></script>
<script type="text/javascript" src="js/visualize.jQuery.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  <script type="text/javascript" src="http://jquery.com/src/latest/"></script>
    <script type="text/javascript" src="greyboxjr/greybox.js"></script>
    <link href="greyboxjr/greybox.css" rel="stylesheet" type="text/css" media="all" />
    
 


    <script type="text/javascript">
	


function rescol(ver){
		  dis= ver ? '' : 'none';
		tab=document.getElementById('tablamod');
	col2=tab.getElementsByTagName("th");
	
	 col=tab.getElementsByTagName('td');
	   for(h=0;h<col2.length;h++){
		tab.getElementsByTagName('th')[h].style.display=dis;

	   }
	    for(h=0;h<col.length;h++){
		tab.getElementsByTagName('td')[h].style.display=dis;

	   }
	
	}
	
	
	function ocultarColumna(campo,num,ver) {
  dis= ver ? '' : 'none';
  fila=document.getElementById('tbody').getElementsByTagName('tr');
  campo.style.display=dis;
  
  for(i=0;i<fila.length-1;i++)
    fila[i].getElementsByTagName('td')[num].style.display=dis;
}

	
	

	
	
	
	
	
      var GB_ANIMATION = true;
      $(document).ready(function(){
        $("a.greybox").click(function(){
          var t = this.title || $(this).text() || this.href;
          GB_show(t,this.href,470,600);
          return false;
        });
      });
    </script>
    
    
    
    
    
    
    
<script language="javascript">


function cerrar(){
	top.window.location.reload();
	parent.parent.GB_hide();
	
}

function Abrir_ventana (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=800, height=365, top=85, left=140";

window.open(pagina,"",opciones);
}

</script>
</head>

<body>
<div style="text-align:center" id="header">
<img src="img/header.png" height="document.getElementById('container').height" "document.getElementById('container').width" border="0"/>
</div>
<div align="center" id="container">



       <div class="box-header"> <nobr><b>Evento <?php echo utf8_decode($nom); ?></b></nobr> <br /><a href='javascript:rescol(true)' style="font-size:10px">Reestablecer columnas</a> </div>
              <div class='box table'>
<table id="tablamod" border="1" cellpadding="2" cellspacing="2" align="center">
  

<thead>
<th valign="top" align="center" style="text-align:center" colspan="<?php echo $cantcampos+6; ?>" ><form method="get" action="">
   
    
	<input type="text" id="testinput_xml" name="testinput_xml" value="" style="width:300px" /><select id='elijobus' onchange="changebus()" name='elijobus'><option value="all">Todos</option><option value="id">ID</option>
 
    <?php
	for ($x=0;$x<$cantcampos;$x++){
		if ($tipovarcamp[$x]==1 or $tipovarcamp[$x]==2 or $tipovarcamp[$x]==5 or $tipovarcamp[$x]==7 or $tipovarcamp[$x]==9){
	echo "<option value='campo_$x'>". utf8_decode($campo[$x]) . "</option>";
		}
	}
	
	?></select>
	<br /><br />
    
    
    
</form>
<form method="post" action="">
<input type="hidden" value="" id="getbus" name="getbus" />
<input type="hidden" value="" id="getbust" name="getbust" />
<input type="submit" value="Buscar" name="buscar" onclick="javascript:getElementById('getbus').value=getElementById('testinput_xml').value; getElementById('getbust').value=getElementById('elijobus').value;" id="buscar" />
</form>

<script type="text/javascript">
	var options_xml = {
		script:"test.php?id=<?php echo $eventid; ?>&busco=" + document.getElementById('elijobus').value + "&",
		varname:"input"
	};
	var as_xml = new AutoSuggest('testinput_xml', options_xml);

function changebus(){
	var options_xml = {
		script:"test.php?id=<?php echo $eventid; ?>&busco=" + document.getElementById('elijobus').value + "&",
		varname:"input"
	};
	var as_xml = new AutoSuggest('testinput_xml', options_xml);
}
</script></th></thead>
<thead><th valign="top" style="text-align:center" align="center" colspan="<?php echo $cantcampos+6; ?>" ><b><a href='crear.php?id=<?php echo $eventid; ?>'  class="greybox"  title="Agregar asistente">Agregar asistente</a></b></th></thead><thead>
<th align="center" ><a href="moderar.php?orderby=id&id=<?php echo $eventid; ?>">ID</a></td><?php for ($x=0;$x<$cantcampos;$x++){ $pr=$x+1; ?>
<th align="center" id="campo<?php echo $x; ?>" ><nobr> <?php echo "<a href='moderar.php?orderby=campo_$x&id=$eventid'>".utf8_decode($campo[$x])."</a> <a href='javascript:ocultarColumna(document.getElementById(\"campo$x\"),$pr,false)'>-</a>"; ?> </nobr></th>
<?php } ?>
<th align="center" >Inscripto</th><th align="center" >Asistente</th><th align="center" >Editar</th><th align="center" >Imprimir</th><th align="center" >Imprimir (sin asistencia)</th>
</thead><tbody id="tbody">

<?php 


if (isset($_POST['buscar'])){
$search=$_POST['getbus'];
$searcht=$_POST['getbust'];
header("location:moderar.php?id=$eventid&search=$search&searcht=$searcht");
}
$query="SELECT * from $nomevent";
	if (isset($_GET['orderby'])){

						  $orderby=$_GET['orderby'];
						  $query="SELECT * from $nomevent order by $orderby";
					  }

if (isset($_GET['search'])){
					  $search=$_GET['search'];
					  $searcht=$_GET['searcht'];
					  if ($searcht=="all"){
				  $query = "SELECT * from $nomevent WHERE id LIKE '%" . utf8_encode($search) . "%' OR ";
				  for ($x=0;$x<$cantcampos;$x++){
				  if ($x!=$cantcampos-1){
				  $query .= "campo_$x LIKE '%" . utf8_encode($search) . "' OR ";
				  }else{
					
					    $query .= " campo_$x LIKE '%" . utf8_encode($search) . "%'";
					
				  }
				  }
					  }else if ($searcht=="id"){
					   $query = "SELECT * from $nomevent WHERE id LIKE '%" . utf8_encode($search) . "%'";
					  
					  }else{
					  $query = "SELECT * from $nomevent WHERE $searcht LIKE '%" . utf8_encode($search) . "%'";
					  }
				  
				  }

$result=mysql_query($query) or die($query);

while ($row=mysql_fetch_assoc($result)){ ?>
				<tr><td align="center" ><?php echo $row['id']; ?></td> <?php			for ($x=0;$x<$cantcampos;$x++){
					if ($x==0){
					$nom=str_replace(" ","!",$row['campo_'.$x]);
		$nom=str_replace("á", "a",$nom);
				$nom=str_replace("é", "e",$nom);
				$nom=str_replace("í", "i",$nom);
				$nom=str_replace("ó", "o",$nom);
				$nom=str_replace("ú", "u",$nom);
				$nom=str_replace("Á", "A",$nom);
				$nom=str_replace("É", "E",$nom);
				$nom=str_replace("Í", "I",$nom);
				$nom=str_replace("Ó", "O",$nom);
				$nom=str_replace("Ú", "U",$nom);
				$nom=str_replace("ñ", "n",$nom);
				$nom=str_replace("Ñ", "N",$nom);
					}
						if ($x==1){
					$ape=str_replace(" ","!",$row['campo_'.$x]);
					$ape=str_replace("á", "a",$ape);
				$ape=str_replace("é", "e",$ape);
				$ape=str_replace("í", "i",$ape);
				$ape=str_replace("ó", "o",$ape);
				$ape=str_replace("ú", "u",$ape);
				$ape=str_replace("Á", "A",$ape);
				$ape=str_replace("É", "E",$ape);
				$ape=str_replace("Í", "I",$ape);
				$ape=str_replace("Ó", "O",$ape);
				$ape=str_replace("Ú", "U",$ape);
				$ape=str_replace("ñ", "n",$ape);
				$ape=str_replace("Ñ", "N",$ape);
					}
						if ($x==2){
					$emp=str_replace(" ","!",$row['campo_'.$x]);
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
			
					}
					?>
<td align="center" ><?php echo utf8_decode($row['campo_'.$x]); ?></td>
<?php } ?>
<td align="center" ><?php if ($row['inscripto']==1){ echo "SI"; }else{ echo "NO"; } ?></td><td align="center" ><?php if ($row['asistente']==1){ echo "<a href=javascript:Abrir_ventana('asistente.php?id=". $row['id']. "&nomevent=$nomevent&asis=0')><img src='img/verde.jpg' border='0' /></a>"; }else{ echo "<a href=javascript:Abrir_ventana('asistente.php?id=". $row['id']. "&nomevent=$nomevent&asis=1')><img src='img/rojo.jpg' border='0' /></a>"; } ?></td><td align="center" ><a href='editar.php?id=<?php echo $eventid; ?>&idus=<?php echo $row['id']; ?>' class="greybox" onclick="location.href='#'" title="Editar inscripto"><img border="0" src="img/edit.png" /></a></td><td align="center" ><a href="javascript:Abrir_ventana('imprimir.php?id=<?php echo $row['id']; ?>&nomevent=<?php echo $nomevent; ?>&name=<?php echo utf8_decode($nom) . "_" . utf8_decode($ape); ?>&emp=<?php echo utf8_decode($emp); ?>')"><img border="0" src="img/imprimir.jpg" /></a></td><td align="center" ><a href="javascript:Abrir_ventana('imprimirnoassist.php?id=<?php echo $row['id']; ?>&nomevent=<?php echo $nomevent; ?>&name=<?php echo utf8_decode($nom) . "_" . utf8_decode($ape); ?>&emp=<?php echo utf8_decode($emp); ?>')"><img border="0" src="img/imprimir.jpg" /></a></td>
</tr> 
							  
		<?php			}		  }
?>

<tr><td style="text-align:center" colspan="<?php echo $cantcampos+6; ?>" align="center" ><a href="principal.php" onclick="cerrar()">Volver</a>
</td></tr></tbody></table></div>

<p style="margin-right:10px" align="right">Designed by <a href="http://www.gapnix.com">Gapnix</a></p>
<script language="JavaScript">

if (document.getElementById("tablamod").offsetWidth>window.innerWidth){
		
   		document.getElementById("tablamod").style.fontSize="70%";
}
    </script>
</div> 
</body>
</html>
<?php } 

} ?>