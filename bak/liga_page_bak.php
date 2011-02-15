<?php
require_once 'config.php';
require_once 'funciones.php';
if (! isset($_GET['liga'])) {
	header("location: $basepage") ;	
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head>
	<title>Liga Pes 2009</title>
	<link rel="shortcut icon" href="favicon.ico"> 
	<link type="text/css" href="css/humanity/jquery-ui-1.7.1.custom.css" rel="stylesheet" />
	<link type="text/css" href="css/pes-face.css" rel="stylesheet" />
	<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/es_LA" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
	<script type="text/javascript" src="development-bundle/ui/ui.core.js"></script>
	<script type="text/javascript" src="development-bundle/ui/ui.dialog.js"></script>
	<script type="text/javascript" src="development-bundle/ui/effects.core.js"></script>

	<script type="text/javascript">
	$(function() {

		$(".accordion").accordion({
			collapsible: true,
			autoHeight: false
		});
		$(".accordionb").accordion({
			collapsible: true,
			autoHeight: false
		});

	});
	</script>
</head>
<body>
<div id="todo">
<div id="header"><a href="<?php echo $basepage ; ?>"><img src="logo1.jpg" ></a></div>
<div class="fbmenu">
	<a href="#" class="fbtab">Partidos</a>
	<a href="#" class="fbtab">Jugadores</a>
	<a href="#" class="fbtab">Estadisticas</a>
	<a href="#" class="fbtab">Tabla Liga</a>
</div>

<div id="cuerpo">
	<?php
		echo tablas_jugadores ($_GET['liga'],"class=\"accordion\"",NULL,$tabla,$h3,$ah3,$divin,$ul,$li) ;
		echo lista_partidos(nombreliga($_GET['liga']),partidos($_GET['liga'],10,$_GET['pag'],NULL),NULL,NULL,NULL,NULL,NULL);
		echo lista_partidos_menu($_GET['liga'],10,$_GET['pag'],NULL,$basepage . "/liga_page.php",NULL,NULL,NULL);

	?>		
</div>
<script type="text/javascript">  
FB.init("<?php echo $appapikey ?>", "xd_receiver.htm"); 
</script> 
</body>
</html>
