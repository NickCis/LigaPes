<?php
require_once 'config.php';
require_once 'funciones.php';
if (!$_POST) {
	?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head>
	<link type="text/css" href="css/pes-face.css" rel="stylesheet" />
</head>
<body>
<div id="fb-root"></div>
<script type="text/javascript" src="http://connect.facebook.net/es_LA/all.js"></script>
<script type="text/javascript">
	var appId = '<?php echo $appId ;?>';
	window.fbAsyncInit = function() {
		FB.init({
			appId  : appId,
			status : true, // check login status
			cookie : true, // enable cookies to allow the server to access the session
			xfbml  : true  // parse XFBML
		});
	};

</script>
<script type="text/javascript" src="js/autocomplete_select.js"></script>
<script type="text/javascript" src="js/submitform.js"></script>
	<?php
}

if (!$_REQUEST['liga'] || !requiererango($_REQUEST['liga'],2,NULL)) { exit('<div class=\"fberrorbox\">Liga No seteada</div>'); }
$liga = $_REQUEST['liga'] ;

echo "<div id=\"respuesta_partido\"></div>";
echo new_form_partido($liga,$basepage . "/agregarpartidos.php\" onsubmit=\"return submitForm(this, '" . $basepage . "/agregarpartidos.php', 'respuesta_partido')", array("regana" => "class=\"fbgreybox aformre\"", "reperd" => "class=\"fbgreybox aformre\"", "ingana" => "class=\"fbinfobox\"", "inperd" => "class=\"fbinfobox\"", "golesgana" => "class=\"fbinfobox\"", "golesperd" => "class=\"fbinfobox\"") );
if (!$_POST) {
	?>
</body>
</html>
<?php } ?>

