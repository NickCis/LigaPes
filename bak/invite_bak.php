<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head></head> 
<body>
<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"> 
</script> 
<?php
require_once 'config.php';
require_once 'funciones.php';
if(isset($_GET['liga'])) { 
	requiererango ($_GET['liga'], '3', NULL);
}
?> 
<p>Hello, <fb:name uid="<?php echo $user_id ?>" useyou="false"></fb:name>!</p>
<?php
if(isset($_GET['ids'])) { # --------------
	$invitacionIds = $_GET['ids'] ;
	echo "Se han mandado las invitaciones. <a href=\"" . $basepage . "\">Click Aqui para volver al inicio</a>";
	echo $_GET['liga'] ;
	if(isset($_GET['liga'])) {
		if(existeliga ($_GET['liga'])) {
			$a = 0;
			while ( $a < sizeof($invitacionIds)) {
				if (!invitacion($invitacionIds[$a],$_GET['liga'])) {
					if (requiererango ($_GET['liga'], '1', $invitacionIds[$a])) {
						$fecha = date('d-m-Y');
						$sqlI = "insert into invitacion (jugador,liga,invitador,fecha) values ('$invitacionIds[$a]','$_GET[liga]','$user_id','$fecha')" ;
						mysql_query($sqlI) ;
					}
				}
				$a++ ;
			}
		}
	}
} # ----------------------
else {
?> 
<fb:serverFbml>
    <script type="text/fbml">
      <fb:fbml>
          <fb:request-form
                    action="<?php echo $basepage; ?>/invite.php"
                    method="GET"
                    invite="true"
                    type="Liga Pes"
                    content="Crea ligas de Pro Evolution Soccer y compartelas con tus amigos! <?php if(isset($_GET['liga'])) {echo 'Unete a la liga ' . $_GET['liga'] ;} ?> <a href='http://apps.facebook.com/ligapes/'>Liga Pes</a>
                 <fb:req-choice url='http://apps.facebook.com/ligapes'
                       label='Ligapes' />
              "
              >
				<?php if(isset($_GET['liga'])) {echo '<input id="liga" type="hidden" fb_protected="true" value="' . $_GET['liga'] . '" name="liga"/>';} ?>
                    <fb:multi-friend-selector
                    showborder="false"
                    actiontext="Invita a tus amigos a unirse a Liga Pes.">
        </fb:request-form>
      </fb:fbml>

    </script>
  </fb:serverFbml>
<?php
}
?>
<a href="<?php echo $basepage ; ?>">Click Aqui para volver al inicio</a>
<script type="text/javascript">  
FB.init("<?php echo $appapikey ?>", "xd_receiver.htm"); 
</script> 
</body>
</html>
