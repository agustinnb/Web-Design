<?php session_start();

if (isset($_SESSION['tk_username'])){ 
include "librerias/mysqlconnect.php";
$user=$_SESSION['tk_username'];
$query= "SELECT * FROM organizadores WHERE usuario= '$user'";
$result = mysql_query($query) or die ("Error buscando el usuario en la DB");
$raw=@mysql_fetch_assoc($result);
$id=$raw['id'];
if ($raw['rango']=='S'){
if (isset($_GET['id'])){
				$eventid=$_GET['id'];
	$query="SELECT * FROM eventos WHERE id=$eventid";
}
}else if ($raw['rango']=='A'){
if (isset($_GET['id'])){
				$eventid=$_GET['id'];
	$query="SELECT * FROM eventos WHERE id=$eventid AND orcanizador =$id";
}
}else{
if (isset($_GET['id'])){
	$eventid=$_GET['id'];
	$rango=$raw['rango'];
	$rangousuario=explode(";",$rango);
	$rangoadmus=$rangousuario[1];
	$query="SELECT * FROM organizadores WHERE id = $rangoadmus";
	$resulti=mysql_query($query) or die ("error");
	$rew=@mysql_fetch_assoc($resulti);
	if ($rew['rango']=='S'){
	$query="SELECT * FROM eventos WHERE id=$eventid";
	}
	if ($rew['rango']=='A'){
	$query="SELECT * FROM eventos WHERE id=$eventid AND organizador = $rangoadmus";
	}

}
}
if (isset($_GET['mos'])){
		$mos=$_GET['mos'];
		}else{
		die();
		}
	$result=mysql_query($query) or die ("Usted no es el organizador de este evento");
$row=@mysql_fetch_assoc($result);
$nom=$row['nom'];
$nomevent=$row['nomevent'];
$cantcampos=$row['cantcampos'];
$directivas=$row['directivas'];
$dir=explode(";",$directivas);
$i=0;
for ($x=0;$x<$cantcampos;$x++){
	$campo[$x]=$dir[$i];
	$i=$i+3;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mostrar</title>
 <style type="text/css">

a:link {text-decoration: none;
color:#000;}
a:visited {text-decoration: none;
color:#000;
			}



</style>


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
		tab=document.getElementById('tabla');
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
  
  for(i=0;i<fila.length-3;i++)
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
    
    
    
<script type="text/javascript">
function imprimir(){
	document.getElementById('imprimir').style.display="none";
		document.getElementById('editar').style.display="none";

self.print();
}

//javascript:top.location.href='borrararch.php?tabla=<?php  // echo "tablasexcel" . $nomevent . "/tabla" . $mos . ".xls"; ?>';
</script>
</head>

<body onunload="top.window.location.reload();">
<div align="center" id="container">
<img src="img/header.png" border="0"/>
<div class='box-header'> Evento <?php echo utf8_decode($nom); ?> <br /><a href='javascript:rescol(true)' style="font-size:10px">Reestablecer columnas</a> </div>
         
          <div class='box table'>
<table cellpadding="2" id="tabla" cellspacing="2" align="center">


<?php 
if ($mos=="inscriptos"){
$query="SELECT * from $nomevent where inscripto=1";
}
if ($mos=="asistentes"){
$query="SELECT * from $nomevent where asistente=1";
}
if ($mos=="acreditados"){
$query="SELECT * from $nomevent where asistente=1 and inscripto=0";
}
if ($mos=="preacreditados"){
$query="SELECT * from $nomevent where asistente=1 and inscripto=1";
}
$result=mysql_query($query);
$result2=mysql_query($query);
$tablaXLS="<table cellpadding='2' cellspacing='2' align='center'><tr class='tit' height='50'><td valign='top' colspan='" . ($cantcampos+1) . "' >Evento " . utf8_decode($nom) . "</td></tr><tr>";
 for ($x=0;$x<$cantcampos;$x++){
$tablaXLS.= "<td align='center' >" . utf8_decode($campo[$x]) . "</td>";
 } 
 $tablaXLS.="</tr>";
 while ($row=mysql_fetch_assoc($result)){ 
		$tablaXLS.=	"<tr>";
		for ($x=0;$x<$cantcampos;$x++){ 
		$tablaXLS.="<td align='center' >" . utf8_decode($row['campo_'.$x]) . "</td>";
 } 
 }
 $tablaXLS.="</tr></table>";
 $scarpeta="tablasexcel$nomevent"; //carpeta donde guardar el archivo.
 $sfile=$scarpeta."/tabla$mos.xls"; //ruta del archivo a generar
 if (is_dir($scarpeta)){
$fp=fopen($sfile,"w");
fwrite($fp,$tablaXLS);
fclose($fp);
 }else{
 mkdir($scarpeta);
 $fp=fopen($sfile,"w");
fwrite($fp,$tablaXLS);
fclose($fp);
 }



?>

<thead><?php for ($x=0;$x<$cantcampos;$x++){ ?>
<th id="campo<?php echo $x; ?>" style="width:150px" class="bodtr"><nobr><?php echo utf8_decode($campo[$x]) . " <a href='javascript:ocultarColumna(document.getElementById(\"campo$x\"),$x,false)'>-</a>";  ?>  </nobr>             </th>
<?php } ?><th class="bodtr" align="center" >Editar</th>

</thead><tbody id="tbody">
<?php
while ($row2=mysql_fetch_assoc($result2)){ ?>
				<tr> <?php			for ($x=0;$x<$cantcampos;$x++){ ?>
<td align="center" ><?php echo utf8_decode($row2['campo_'.$x]); ?></td>

<?php } ?>
<td align="center" ><a href='editar.php?id=<?php echo $eventid; ?>&idus=<?php echo $row2['id']; ?>' onclick="location.href='#'" class="greybox" title="Editar inscripto"><img border="0" src="img/edit.png" /></a></td>
</tr> 
							  
		<?php					  }
?>
<tr  align="center" id='imprimir'><td align="center" style="text-align:center" colspan="<?php echo $cantcampos+2; ?>"><a href="javascript:imprimir()"><img src="img/imprimir.jpg" border="0" /></a></td></tr>
<tr align="center"  id='editar'><td align="center" style="text-align:center" colspan="<?php echo $cantcampos+2; ?>"><a href="<?php echo $sfile; ?>">Guardar tabla en excel</a></td></tr>
<tr align="center"  id='editar'><td align="center" style="text-align:center" colspan="<?php echo $cantcampos+2; ?>"><a href="principal.php">Volver</a></td></tr>
</tbody>
</table></div>

<p style="margin-right:10px" align="right">Designed by <a href="http://www.gapnix.com">Gapnix</a></p>
<script language="JavaScript">

if (document.getElementById("tabla").offsetWidth>window.innerWidth){

   		document.getElementById("tabla").style.fontSize="80%";
}
    </script>

</div> 
</body>
</html>
<?php 

include "librerias/closecon.php";
}else{
	header("Location:http://agustinbottos.com.ar");
}
?>