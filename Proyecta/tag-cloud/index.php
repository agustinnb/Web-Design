<html>
<head>
<?php //cabecera XML UTF-8 /  no-cache 
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");
?>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
<style>
body{  
margin: 0;  
}  
  
#DivTagCloudFX{  
position: absolute;  
z-index: 1;  
width:100%;  
}  
  
#dos{  
position: absolute;  
z-index: 2;  
background-image: url(barra.png);  
background-repeat: repeat;  
width: 100%;  
height: 60px;  
margin-top: 0px;  
font-weight: bold;  
text-indent:20px;  
}  
  
#tres{  
position:absolute;  
z-index: 3;  
margin-left:450px;  
}  
</style>
</head>
<body>

	<div id="DivTagCloudFX"></div>
	<script type="text/javascript" src="swfobject.js"></script>
	<script type="text/javascript">
		var flashvars = {};
		var params = {};
		params.base = "";
		params.scale = "noscale";
		params.salign = "tl";
		params.wmode = "transparent";
		params.allowFullScreen = "true";
		params.allowScriptAccess = "always";
		swfobject.embedSWF("TagCloudFX.swf", "DivTagCloudFX", "411", "290", "9.0.0", false, flashvars, params);
	
	</script>
<div id="dos"></div>
</body>
</html>