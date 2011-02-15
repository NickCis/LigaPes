<?
ob_start();

// the facebook client library
include_once 'facebook-platform/php/facebook.php';

require 'config.php';
require 'funciones.php';

$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<title>Liga Pes 2009</title>
	<link rel="shortcut icon" href="favicon.ico"> 
	<link type="text/css" href="css/humanity/jquery-ui-1.7.1.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
	<script type="text/javascript" src="development-bundle/ui/ui.core.js"></script>
	<script type="text/javascript" src="development-bundle/ui/ui.dialog.js"></script>
	<script type="text/javascript" src="development-bundle/ui/effects.core.js"></script>
	<style type="text/css">
	* {
		margin: 0px ; 
		border: 0px ; 
		padding: 0px; 
	}
	#todo { margin-left: 1%; margin-right: 1%; }
	#header { 
		width: 100% ; 
		background: #e67817 ;
	}

	.accordion { width: 25%;  float: left; }
	.accordionb { width: 48%; margin-left: 1% ; margin-right: 1% ; float: left; }
    .grafico { width: 99% }


	.loginbutton {
		background:#004A95;
		font-weight:bold;
		border-color:#D9DFEA #0E1F5B #0E1F5B #D9DFEA;
		border-style:solid;
		border-width:1px;
		color:#FFFFFF;
		font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
		font-size:11px;
		padding:2px 15px 3px;
		text-align:center;
	}
	input.button {
		border-style:solid;
		border-color:#CCCCCC;
		border-width:1px;
	}
	.login_cuerpo .izq{
		float:left;
		width:115px;
		height:22px;
		text-align:right;
	}
	.login_cuerpo .der{
		float:left;
		height:25px;
		padding-left:5px;
		padding-top:2px;
	}
	.login_cuerpo input.ilogin{
		width: 150px;
	}
	.login_cuerpo input.login{
		margin-left: 132px;
		width: 132px;
		font-size: 10px;
	}
	.login_cuerpo form{
		font-weight:bold;
		margin: 0px;
	}

	#menu { 
		margin-top: 1ex; 
		margin-bottom: 1.5ex ;
	}
	#menu ul{ 
		list-style:none; 
		height: 2ex;

	}
	#menu ul li{ 
		float: right;
		margin-top: 0.5ex;
		height: 3ex;
		margin-right: 1.5em
	}
	#menu ul li a{ 
		display: block;
		font-weight: bold;
		color: white;
		background: #e67817;
		padding-left: 0.5em;
		padding-right: 0.5em;
		border-bottom: 0.2em solid #cdc3b7;
		border-left: 0.2em solid #cdc3b7;
	}
	#menu ul li a:hover{
		background: #c26513;
		border-bottom: 0;
		border-left: 0;
		border-top: 0.2em solid #cdc3b7;
		border-right: 0.2em solid #cdc3b7;
	}
	</style>

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
	<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
	<script type="text/javascript">  FB.init("e30aa3a25f0935fb174a310a4ca4b6e4", "xd_receiver.htm"); </script>

<div id="todo">
<fb:name firstnameonly="true" uid="<?=$user?>" useyou="false"/></fb:name>
	<div id="header" class="ui-corner-bottom"><img src="logo1.jpg" ></div>

	<div id="menu" class="ui-state-default ui-corner-all">
		<ul>
			<li>
				<a href="#" class="ui-state-default ui-corner-all">Hi <fb:name uid="<?=$user?>"></fb:name>!</a>
			</li>

			<li>
				<a href="#" class="ui-state-default ui-corner-all">Alternar Vistas</a>
			</li>
		</ul>
	</div>

	<div id="cuerpo">
		<div class="accordion">
			<h3><a href="#">Jugador</a></h3>
			<div>Tabla</div>	
		</div>
		
		<div class="accordionb" id="graficos">
			<h3><a href="#">Promedio Puntos</a></h3>
			<div>Grafico 1</div>
	
			<h3><a href="#">Promedio goles</a></h3>
			<div>Grafico 2</div>

			<h3><a href="#">Todos Los partidos</a></h3>
			<div>Tabla</div>
	
			<h3><a href="#">Tabla Completa</a></h3>
			<div>Tabla</div>
		</div>

		<div class="accordion">
			<h3><a href="#">Ultimos Partidos</a></h3>
			<div>Tabla</div>
	
			<h3><a href="#">Promedio Puntos</a></h3>
			<div>Tabla</div>
	
			<h3><a href="#">Promedio Goles</a></h3>
			<div>Tabla</div>
		</div>
	</div>
</div>
</body>
</html>
<?
ob_end_flush();
?>
