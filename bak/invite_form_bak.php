<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head></head> 
<body>
<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"> 
</script>
<?php
require_once 'config.php';
require_once 'funciones.php';
if(isset($_GET['liga'])) { 
	if (! requiererango($_GET['liga'], '3', NULL)) {
		exit("Rango no suficiente <a href=\" $basepage \">Click Aqui para volver al inicio</a>");
	}
	$liga = $_GET['liga'];
}
else {
	$liga = NULL ;
}
?>
<?php 
$texto = "Crea ligas de Pro Evolution Soccer y compartelas con tus amigos!";
$textoliga = "Unete a la liga: " . $liga ;
echo form_invite($basepage . "/invite.php", $texto, $liga, $textoliga, NULL);
?> 
<a href="<?php echo $basepage ; ?>">Click Aqui para volver al inicio</a>
<script type="text/javascript">  
FB.init("<?php echo $appapikey ?>", "xd_receiver.htm"); 
</script> 
</body>
</html>
