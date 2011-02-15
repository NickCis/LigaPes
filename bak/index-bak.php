<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head></head> 
<body>
<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"> 
</script> 
<?php
require_once 'config.php';
require_once 'funciones.php';
if (invitacion ($user_id,NULL)) {
	$pageredir = $basepage . "/invite_see.php" ;	
	header("location: $pageredir") ;
}

?> 
<p>Hola <fb:name uid="<?php echo $user_id ?>" useyou="false"></fb:name>!</p>
<a href="crearliga.php">Crea tu liga!</a>
<?php 
echo lista_ligas($user_id, 10);
?>


<script type="text/javascript">  
FB.init("<?php echo $appapikey ?>", "xd_receiver.htm"); 
</script> 
</body>
</html>
