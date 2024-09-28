<?php session_start();

if (isset($_SESSION['tk_username'])){ 

include "librerias/mysqlconnect.php";
include "validaciones/diferencia_fechas.php";



function rmdirtree($dirname) { 
   if (is_dir($dirname)) {    //Operate on dirs only 
       $result=array(); 
       if (substr($dirname,-1)!='/') {$dirname.='/';}    //Append slash if necessary 
       $handle = opendir($dirname); 
       while (false !== ($file = readdir($handle))) { 
           if ($file!='.' && $file!= '..') {    //Ignore . and .. 
               $path = $dirname.$file; 
               if (is_dir($path)) {    //Recurse if subdir, Delete if file 
                   $result=array_merge($result,rmdirtree($path)); 
               }else{ 
                   unlink($path); 
                   $result[].=$path; 
               } 
           } 
       } 
       closedir($handle); 
       rmdir($dirname);    //Remove dir 
       $result[].=$dirname; 
       return $result;    //Return array of deleted items 
   }else{ 
       return false;    //Return false if attempting to operate on a file 
   } 
}  


$query="SELECT nomevent FROM eventos";
$result=mysql_query($query) or die ("Error borrando carpetas de eventos");
while ($row=@mysql_fetch_assoc($result)){
rmdirtree("tablasexcel" . $row['nomevent']);
}
unset($query);
mysql_free_result($result);
unset($row);



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
<title>Principal</title>
 <link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./greybox/";
    </script>

    <script type="text/javascript" src="greybox/AJS.js"></script>
    <script type="text/javascript" src="greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="greybox/gb_scripts.js"></script>
    <link type="text/css" rel="stylesheet" media="all" href="css/base.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/jquery-ui.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/grid.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/visualize.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/excanvas.js"></script>
<script type="text/javascript" src="js/visualize.jQuery.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
    <style type="text/css">

a:link {text-decoration: none;
color:#000;}
a:visited {text-decoration: none;
color:#000;
			}

body {font-family: Arial, Helvetica, sans-serif; 
		font-size: 13px;
		font:Verdana, Geneva, sans-serif;
		
		
		 }
		
div#container{ margin: 0 10%;}

/* td {
 padding:5px;
 
 }
*/
div#header{ margin: 0 10%; }

.bodtr {font-family: Arial, Helvetica, sans-serif; 
		font-size: 12px;
		font-weight:bold;
		font:Verdana, Geneva, sans-serif;
		
		
		 }
		 .bodtr2 {font-family: Arial, Helvetica, sans-serif; 
		font-size: 16px;
		font-weight:bold;
		font:Verdana, Geneva, sans-serif;
		
		
		 }
		  .bodtr3 {font-family: Arial, Helvetica, sans-serif; 
		font-size: 14px;
		font-weight:bold;
		font:Verdana, Geneva, sans-serif;
		
		
		 }
		 

</style>
</head>

<body>
<div style="text-align:center" id="header">
<img src="img/header.png" border="0"/>
</div>
<div id="container">



<p style="margin-right:10px" align="right" class="bod"><a href="logout.php">Cerrar sesion</a></p>

<?php if ($raw['rango']=='A' || $raw['rango']=='S'){
// echo "<p ><b><a href=crearevento.php>Crear nuevo evento</a></b></p>";
// echo "<tr><td  align='left'><b><a href=crearevento.php>Crear nuevo evento</a></b></td></tr>";
//}

?>

<?php
 if ($raw['rango']=='A'){
$query="SELECT * FROM eventos where organizador=$id";
 }
 if ($raw['rango']=='S'){
	 $query="SELECT * FROM eventos";
 }
$result=mysql_query($query);
$h=0;
while ($row=@mysql_fetch_assoc($result)){

$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechter=$row['fechter'];
$horater=$row['horater'];
$hter=explode(":",$horater);
$diater=explode("-",$fechter);
$timestamp1=mktime($hter[0],$hter[1],"00",$diater[1],$diater[2],$diater[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);
 $diferencia = $timestamp1 - $timestamp2;
  $resultado = diferencia_fechas($diferencia);
  $eventid=$row['id'];
  $nom=$row['nom'];
 
   $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);
   $asis=0;
  $insc=0;
  $p=0;
  $a=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  							if ($row2['asistente']==1){
								$asis++;
								}
								
								if ($row2['inscripto']==1){
								$insc++;
								}
								  if ($row2['asistente']==1 && $row2['inscripto']==1){
								  $p++;
								  }
								    if ($row2['asistente']==1 && $row2['inscripto']==0){
								  $a++;
								  }
								  }
								  




$query3="SELECT * FROM organizadores";
$result3=mysql_query($query3) or die ("<tr><td align='center' >Error.</td></tr>");
$i=1;
while ($rew=mysql_fetch_assoc($result3)){
if ($rew['rango']!='A' && $rew['rango']!='S'){
$rangous=explode(";",$rew['rango']);

if ($rangous[1]==$id){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$eventid){
$moderador[$i]=$rew['usuario'];
$moderadorid[$i]=$rew['id'];
$i++;
}
}
}
}
}






								  
							  
								  
  if ($resultado<0){
	  if ($h==0){
	echo "       <div class='box-header'> Eventos realizados </div>
          <div class='box table'>";
	  echo "       <table> 
                                <thead> 
                                    <tr>
                                        <th>Nombre</th> 
                                        <th>Asistentes</th> 
                                        <th>Inscriptos</th> 
										 <th>Acreditados</th> 
										  <th>Pre-Acreditados</th> 
										  	  <th>Estadisticas</th> 
											  	  <th>Moderadores</th> 
                                    </tr> 
                                </thead> 
                                <tbody>";
	  $h++;
	  }
  echo "<tr valign='top'><td rowspan='$i' style='text-align:center'  >" . utf8_decode($nom) . "</td><td rowspan='$i' style='text-align:center'    align='center'>$asis (<a href='mostrar.php?id=$eventid&mos=asistentes' >Mostrar</a>)</td><td rowspan='$i' style='text-align:center'    align='center'>$insc (<a href='mostrar.php?id=$eventid&mos=inscriptos' >Mostrar</a>)</td><td rowspan='$i' style='text-align:center'    align='center'>$a (<a href='mostrar.php?id=$eventid&mos=acreditados' >Mostrar</a>)</td><td rowspan='$i' style='text-align:center'    rowspan='$i' style='text-align:center'  align='center'>$p (<a href='mostrar.php?id=$eventid&mos=preacreditados' >Mostrar</a>)</td><td style='text-align:center' rowspan='$i'      align='center'><a href='grafico.php?nomevent=$nomevent' rel='gb_page_center[650, 650]' title='Grafico'><img border='0' src='img/stat.png'></a></td><td     align='center'></td></tr>";
   for ($x=1;$x<$i;$x++){
  echo "<tr><td  align='center'>$moderador[$x]<a href='borrarmod.php?mod=$moderadorid[$x]&id=$eventid'><img src='img/del.png' border='0' /></a></td></tr>";
  }

  }
}
echo "</tbody> 
					</table></div><br /><br />
";








 if ($raw['rango']=='A'){
$query="SELECT * FROM eventos where organizador=$id";
 }
 if ($raw['rango']=='S'){
	 $query="SELECT * FROM eventos";
 }
$result=mysql_query($query);
$h=0;
while ($row=@mysql_fetch_assoc($result)){


$fechinscter=$row['fechinscter'];
$fechinsc=$row['fechinsc'];
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
  $eventid=$row['id'];
  $nom=$row['nom'];

  $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);
  
  $p=0;
  $a=0;
  $asis=0;
  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  							  if ($row2['asistente']==1){
								  $asis++;
								  }
								    if ($row2['inscripto']==1){
								  $insc++;
								  }
								  if ($row2['asistente']==1 && $row2['inscripto']==1){
								  $p++;
								  }
								    if ($row2['asistente']==1 && $row2['inscripto']==0){
								  $a++;
								  }
								  }





$query3="SELECT * FROM organizadores";
$result3=mysql_query($query3) or die ("<tr><td align='center' >Error.</td></tr>");
$i=1;
while ($rew=mysql_fetch_assoc($result3)){
if ($rew['rango']!='A' && $rew['rango']!='S'){
$rangous=explode(";",$rew['rango']);

if ($rangous[1]==$id){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$eventid){
$moderador[$i]=$rew['usuario'];
$moderadorid[$i]=$rew['id'];
$i++;
}
}
}
}
}






  if ($resultado>0 && $resultado2<0){
	  if ($h==0){
		echo "       <div class='box-header'> Eventos en curso </div>
          <div class='box table'>";

	  echo "
	   <table> 
                                <thead> 
                                    <tr>
                                        <th>Nombre</th> 
                                        <th>Asistentes</th> 
                                        <th>Inscriptos</th> 
										 <th>Acreditados</th> 
										  <th>Pre-Acreditados</th> 
										  	  <th>Estadisticas</th> 
											    <th>Moderar</th>
											  	  <th>Moderadores</th> 
												  	  <th>Impresion masiva <b>(OJO)</b></th> 
                                    </tr> 
                                </thead> 
                                <tbody>
	 ";
	$h++;
	  }
  echo "<tr valign='top'><td rowspan='$i' style='text-align:center'   >" . utf8_decode($nom) . "</td><td rowspan='$i' style='text-align:center'    align='center'>$asis (<a href='mostrar.php?id=$eventid&mos=asistentes' title='Mostrar asistentes'  >Mostrar</a>)</td><td rowspan='$i' style='text-align:center'     align='center'>$insc (<a href='mostrar.php?id=$eventid&mos=inscriptos' title='Mostrar inscriptos' >Mostrar</a>)<td rowspan='$i' style='text-align:center'     align='center'>$a (<a href='mostrar.php?id=$eventid&mos=acreditados' title='Mostrar acreditados'  >Mostrar</a>)</td><td rowspan='$i' style='text-align:center'     align='center'>$p (<a href='mostrar.php?id=$eventid&mos=preacreditados' title='Mostrar preacreditados'  >Mostrar</a>)</td><td rowspan='$i' style='text-align:center'     align='center'><a href='grafico.php?nomevent=$nomevent' rel='gb_page_center[650, 650]' title='Grafico'><img border='0' src='img/stat.png'></a></td><td rowspan='$i' style='text-align:center'     align='center'><a href='moderar.php?id=$eventid'   title='Moderar evento'><img border='0' src='img/edit.png' /></a></td><td     align='center'><a href='addmod.php?id=$eventid'  rel='gb_page_center[300, 200]' title='Agregar moderador'>Agregar moderador</a></td><td rowspan='$i' style='text-align:center'     align='center'><a href='imprimirmas.php?id=$eventid' title='Impresion masiva'  ><img src='img/imprimir.jpg' border='0' /></a></td></tr>";
  for ($x=1;$x<$i;$x++){
  echo "<tr><td  align='center'>$moderador[$x]<a href='borrarmod.php?mod=$moderadorid[$x]&id=$eventid'><img src='img/del.png' border='0' /></a></td></tr>";
  }

 }

}
 echo "</tbody> 
					</table></div><br /><br />";



 if ($raw['rango']=='A'){
$query="SELECT * FROM eventos where organizador=$id";
 }
 if ($raw['rango']=='S'){
	 $query="SELECT * FROM eventos";
 }
$result=mysql_query($query);
$p=0;
while ($row=@mysql_fetch_assoc($result)){

$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechinscter=$row['fechinscter'];
$fechinsc=$row['fechinsc'];
$fechin=$row['fechin'];
$fechter=$row['fechter'];
$horater=$row['horater'];
$horain=$row['horain'];
  $eventid=$row['id'];
$hter=explode(":",$horater);
$hin=explode(":",$horain);
$diain=explode("-",$fechin);
$timestamp1=mktime($hin[0],$hin[1],"00",$diain[1],$diain[2],$diain[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);

 $diferencia = $timestamp1 - $timestamp2;

  $resultado = diferencia_fechas($diferencia);
  $nom=$row['nom'];
  $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);

  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){

								    if ($row2['inscripto']==1){
								  $insc++;
								  }
							
								  }
  
  
  
  
$query3="SELECT * FROM organizadores";
$result3=mysql_query($query3) or die ("<tr><td align='center' >Error.</td></tr>");
$i=1;
while ($rew=mysql_fetch_assoc($result3)){
if ($rew['rango']!='A' && $rew['rango']!='S'){
$rangous=explode(";",$rew['rango']);

if ($rangous[1]==$id){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$eventid){
$moderador[$i]=$rew['usuario'];
$moderadorid[$i]=$rew['id'];
$i++;
}
}
}
}
} 
 
  
  
  
  
  
  if ($resultado>0){
	  if ($p==0){
	echo "       <div class='box-header'> Eventos a realizar </div>
          <div class='box table'>";

	  echo "
	  <table> 
                                <thead> 
                                    <tr>
                                        <th>Nombre</th> 
                                        <th>Inscriptos</th> 
											  <th>Moderadores</th> 
											  	  	  <th>Impresion masiva <b>(OJO)</b></th> 
                                    </tr> 
                                </thead> 
                                <tbody>";
	$p++;
	  }
  echo "<tr valign='top'><td rowspan='$i' style='text-align:center'  >$nom</td><td rowspan='$i' style='text-align:center'    align='center'>$insc (<a href='mostrar.php?id=$eventid&mos=inscriptos' >Mostrar</a>)<td     align='center'><a href='addmod.php?id=$eventid' rel='gb_page_center[300, 200]'>Agregar moderador</a></td><td rowspan='$i' style='text-align:center'     align='center'><a href='imprimirmas.php?id=$eventid' title='Impresion masiva'  ><img src='img/imprimir.jpg' border='0' /></a></td></tr>";
    for ($x=1;$x<$i;$x++){
  echo "<tr><td  align='center'>$moderador[$x]<a href='borrarmod.php?mod=$moderadorid[$x]&id=$eventid'><img src='img/del.png' border='0' /></a></td></tr>";
  }

 }

}
 echo "</tbody></table></div><br /><br />";
 }else{
 $rangous=explode(";",$raw['rango']);
 $idorg=$rangous[1];
 
 
 $query="SELECT * from eventos where organizador=$idorg";
 
 
 $result=mysql_query($query);
   
$h=0;
while ($row=@mysql_fetch_assoc($result)){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$row['id']){
$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechter=$row['fechter'];
$horater=$row['horater'];
$hter=explode(":",$horater);
$diater=explode("-",$fechter);
$timestamp1=mktime($hter[0],$hter[1],"00",$diater[1],$diater[2],$diater[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);
 $diferencia = $timestamp1 - $timestamp2;
  $resultado = diferencia_fechas($diferencia);
  $eventid=$row['id'];
  $nom=$row['nom'];

   $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);

  $p=0;
  $a=0;
  $asis=0;
  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  							  if ($row2['asistente']==1){
								  $asis++;
								  }
								    if ($row2['inscripto']==1){
								  $insc++;
								  }
								  if ($row2['asistente']==1 && $row2['inscripto']==1){
								  $p++;
								  }
								    if ($row2['asistente']==1 && $row2['inscripto']==0){
								  $a++;
								  }
								  }



						  
								  
								  
  if ($resultado<0){
	  if ($h==0){
		echo "       <div class='box-header'> Eventos realizados </div>
          <div class='box table'>";

	  echo " <table> 
                                <thead> 
                                    <tr>
                                        <th>Nombre</th> 
                                        <th>Asistentes</th> 
                                        <th>Inscriptos</th> 
										 <th>Acreditados</th> 
										  <th>Pre-Acreditados</th> 
										
                                    </tr> 
                                </thead> 
                                <tbody>";
							
	  $h++;
	  }
  echo "<tr valign='top'><td >" . utf8_decode($nom) . "</td><td  align='center'>$asis </td><td  align='center'>$insc </td><td   align='center'>$a</td><td    align='center'>$p</td><td     align='center'></td></tr>";


  }
  }
  
}
}
echo "</tbody></table></div><br /><br />";

 
 
 
 
 
 
 
 
 
 
 
 
 
$query="SELECT * from eventos where organizador=$idorg";
$result=mysql_query($query);
$h=0;
while ($row=@mysql_fetch_assoc($result)){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$row['id']){

$fechinscter=$row['fechinscter'];
$fechinsc=$row['fechinsc'];
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
  $eventid=$row['id'];
  $nom=$row['nom'];

  $nomevent=$row['nomevent'];
  $query2= "SELECT * from $nomevent";
  $result2=mysql_query($query2);
  
 $p=0;
  $a=0;
  $asis=0;
  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  							  if ($row2['asistente']==1){
								  $asis++;
								  }
								    if ($row2['inscripto']==1){
								  $insc++;
								  }
								  if ($row2['asistente']==1 && $row2['inscripto']==1){
								  $p++;
								  }
								    if ($row2['asistente']==1 && $row2['inscripto']==0){
								  $a++;
								  }
								  }



  if ($resultado>0 && $resultado2<0){
	  if ($h==0){
	echo "       <div class='box-header'> Eventos en curso </div>
          <div class='box table'>";

	  echo "<table> <thead> 
                                    <tr>
                                        <th>Nombre</th> 
                                        <th>Asistentes</th> 
                                        <th>Inscriptos</th> 
										 <th>Acreditados</th> 
										  <th>Pre-Acreditados</th> 
										  <th>Moderar</th> 
                                    </tr> 
                                </thead> <tbody>";
								
	$h++;
	  }
  echo "<tr valign='top'><td >" . utf8_decode($nom) . "</td><td   align='center'>$asis</td><td  align='center'>$insc<td  align='center'>$a </td><td   align='center'>$p</td><td  align='center'><a href='moderar.php?id=$eventid' ><img border='0' src='img/edit.png' /></a></td></tr>";


 }
}

}

}
echo "</tbody></table></div><br /><br />";


 
 
 
 
 
 
 
 $query="SELECT * from eventos where organizador=$idorg";
$result=mysql_query($query);
$p=0;
while ($row=@mysql_fetch_assoc($result)){
for ($x=2;$x<count($rangous);$x++){
if ($rangous[$x]==$row['id']){
$ano = date("Y");
$mes=date("m");
$dias=date("d");
$hora=date("H");
$minutos=date("i");
$fechinscter=$row['fechinscter'];
$fechinsc=$row['fechinsc'];
$fechin=$row['fechin'];
$fechter=$row['fechter'];
$horater=$row['horater'];
$horain=$row['horain'];
  $eventid=$row['id'];
$hter=explode(":",$horater);
$hin=explode(":",$horain);
$diain=explode("-",$fechin);
$timestamp1=mktime($hin[0],$hin[1],"00",$diain[1],$diain[2],$diain[0]);
$timestamp2=mktime($hora,$minutos,"00",$mes,$dias,$ano);

 $diferencia = $timestamp1 - $timestamp2;

  $resultado = diferencia_fechas($diferencia);
  $nom=$row['nom'];

  $insc=0;
  while ($row2=@mysql_fetch_assoc($result2)){
	  						
								    if ($row2['inscripto']==1){
								  $insc++;
								  }
						
								  }
  
  
  
  
  
  
  if ($resultado>0){
	  if ($p==0){
	echo "       <div class='box-header'> Eventos a realizar </div>
          <div class='box table'>";

	  echo "  <table> <thead> 
                                    <tr>
                                        <th>Nombre</th> 
                                        <th>Inscriptos</th> 
										</tr> 
                                </thead> <tbody>";
	 
	$p++;
	  }
  echo "<tr valign='top'><td >" . utf8_decode($nom) . "</td><td  align='center'>$insc</td></tr>";


 }
}

}

}
echo "</tbody></table></div><br /><br />";
 
 
 
 
 
 
 
 
 
  
 }
 
 ?>
 <div align="center"><img src="img/newevent.png" /></div>


</div> 
 <?php
 
 
 

}

?>








</body>
</html>