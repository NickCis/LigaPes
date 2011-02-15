<?php
require_once 'config.php';
require_once 'funciones.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head></head> 
<body>
<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"> 
</script> 
<p>Hola <fb:name uid="<?php echo $user_id ;?>" useyou="false"></fb:name>!</p>
Crear liga

<?php echo form_liga($basepage . '/crearliga.php',NULL) ; ?>


<a href="<?php echo $basepage ; ?>">Click Aqui para volver al inicio</a>
<script type="text/javascript">  
FB.init("<?php echo $appapikey ;?>", "xd_receiver.htm"); 
</script> 
</body>
</html>
