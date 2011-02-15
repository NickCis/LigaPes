<?php
require_once 'config.php';
require_once 'funciones.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head>
	<title>Liga Pes 2009</title>
	<link rel="shortcut icon" href="favicon.ico"> 
	<link type="text/css" href="css/facebook/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
	<link type="text/css" href="css/pes-face.css" rel="stylesheet" />

	<script type="text/javascript" src="development-bundle/jquery-1.4.2.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.position.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.mouse.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.sortable.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.accordion.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.dialog.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.position.js"></script>
	<script type="text/javascript" src="development-bundle/ui/jquery.ui.autocomplete.js"></script>

<script type="text/javascript">
	var liga ;
	$(function() {
		$("#fbdivacord").accordion({
			autoHeight: false,
			navigation: true,
			icons: false
		});
	});
</script>

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
<script type="text/javascript" src="js/getelementsbytype.js"></script>
<script type="text/javascript" src="js/popup.js"></script>
<script type="text/javascript" src="js/publishstream.js"></script>
<script type="text/javascript">	
	function div_ajax_post(pagina,objeto,variables) {
		objeto.innerHTML = '<img src="icons/loading.gif" >' ;
		var fbvars = { <?php echo fbvars("POST") ?>} ;
		jQuery.extend(fbvars, variables); 
		$.post(pagina, fbvars , function(data) {
			var ele = objeto;
			ele.innerHTML = data;
			FB.XFBML.parse(ele);
		});
		
	};
</script>
<div id="todo">
<div id="header"><a href="<?php echo $basepage ; ?>"><img src="logo1.jpg" ></a></div>

<div class="fbmenu">
	<a href="#" onclick="div_ajax_post('liga_page.php',$('#body_der')[0],{'liga' : liga});" class="fbtab">Partidos</a>
	<a href="#" onclick="div_ajax_post('liga_page.php',$('#body_der')[0],{'liga' : liga, 'accion' : 'tabla_jug'});" class="fbtab">Tabla Jugadores</a>
	<a href="#" onclick="div_ajax_post('liga_page.php',$('#body_der')[0],{'liga' : liga, 'accion' : 'grafico'});" class="fbtab">Grafico</a>
	<a href="#" onclick="" class="fbtab">Hola</a>
</div>

<div id="cuerpo">
	<?php
		if (invitacion ($user_id,NULL)) { echo "<div class=\"fbinfobox\" style=\"width: 500px;\"><a href=\"invite_see.php\" onclick=\"event.preventDefault(); face_popup_box(this.innerHTML,this.href,true);\">** TENES INVITACIONES PARA OTRAS LIGAS!! **</a></div>" ; }
	?>
	<div class="fbmenuizq">
		<div id="fbdivacord">
			<h3><a href="#"><img src="pes.jpg" style="height: 16px; width: 16px;">Inicio</img></a></h3><div></div>
			<h3><a href="crearliga_form.php" onclick="event.preventDefault(); div_ajax_post(this.href,$('#body_der')[0]);"><img src="icons/group_add.png">Crear Liga</img></a></h3><div></div>
			<h3><a href="invite_form.php" onclick="event.preventDefault(); div_ajax_post(this.href,$('#body_der')[0]);"><img src="icons/user_add.png">Invita a tus amigos!</img></a></h3><div></div>
			<?php
				echo menu_ligas(NULL,NULL,"class=\"fbmenuizqin\"","class=\"fbdivacordh3\""," onclick=\"event.preventDefault(); liga = '\$liga' ; div_ajax_post('liga_page.php',$('#body_der')[0],{liga : '\$liga'});\"","src=\"icons/group.png\"",$ul,$li," onclick=\"event.preventDefault(); face_popup_box(this.innerHTML,this.href,true);\"",NULL,$liga);  
			?>	
		</div>
		<div class="fbcontdiv"></div>
	</div>
	<div id="body_der" class="fbbodyder">Bienvenido a Liga pes!</div>
</div>

</body>
</html>
