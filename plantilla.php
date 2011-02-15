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
	.accordionb { width: 73%; margin-left: 1% ; margin-right: 1% ; float: left; }

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
<div id="todo">
<div id="header" class="ui-corner-bottom"><img src="logo1.jpg" ></div>

<div id="menu" class="ui-state-default ui-corner-all">
	<ul>
		<li>
			<a href="crearliga.php" class="ui-state-default ui-corner-all">Invitar Amigos</a>
		</li>
		<li>
			<a href="" class="ui-state-default ui-corner-all">Crear liga</a>
		</li>
	</ul>
</div>
<div id="cuerpo">
	<div class="accordion">
	<h3><a href="#"></a></h3>
		<div></div>	
	</div>
		
	<div class="accordionb">
		<h3><a href="#">Promedio Puntos</a></h3>
		<div></div>
	
		<h3><a href="#">Promedio goles</a></h3>
		<div></div>
	</div>
</div>
<script type="text/javascript">  
FB.init("<?php echo $appapikey ?>", "xd_receiver.htm"); 
</script> 
</body>
</html>
