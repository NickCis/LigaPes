<?
ob_start();
?>
<html>
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
	* { margin: 0px ; border: 0px ; padding: 0px}
	body { background-image: url('http://ps3media.ign.com/ps3/image/article/901/901161/pro-evolution-soccer-2009-20080820040038947.jpg'); background-attachment:fixed; }
	#todo { margin-left: 1%; margin-right: 1%; }
	#header { 
		width: 100% ; 
		background: #e67817 ;
	}

	.accordion { width: 25%;  float: left;}
	.accordionb { width: 48%; margin-left: 1% ; margin-right: 1% ; float: left}
        .grafico { width: 99% }

	table.tabla { 
		width: 98% ; 
		border-width: thick thick thick thick; 
		border-spacing: 5px; 
		border-style: dotted dotted dotted dotted; 
		border-color: gray gray gray gray; 
		border-collapse: collapse; 
		background-color: #fffff0;
		}
	table.tabla th { 
		border-width: 1px 1px 1px 1px; 
		padding: 1px 5px 5px 1px; 
		border-style: dotted dotted dotted dotted; 
		border-color: gray gray gray gray; 
		-moz-border-radius: 0px 0px 0px 0px; 
		}
	table.tabla td { 
		border-width: 1px 1px 1px 1px; 
		padding: 1px 5px 5px 1px; 
		border-style: dotted dotted dotted dotted; 
		border-color: gray gray gray gray; 
		-moz-border-radius: 0px 0px 0px 0px; 
		}

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

	</style>

	<script id="scripttemp" type="text/javascript" src=""></script>
	<script type="text/javascript">
	function mostrartabla(numero) {
		var elemento = document.getElementById('scripttemp'); 
		nuevoscript = document.createElement('script');
		nuevoscript.src = 'mostrar.php?pag='+numero+'&requiere=si&js=si';
		nuevoscript.id = 'scripttemp' ;
		elemento.parentNode.replaceChild(nuevoscript,elemento);
		setTimeout("document.getElementById('divtabla').innerHTML = tablajs",750) ;
	}

	function efecto(esconde,muestra){
		$(esconde).hide();
		$(muestra).show();
	}

	function dialogo(contenido,titulo){
		$("#tempo").html(contenido) ;
		$("#tempo").dialog('option', 'title', titulo);
		$("#tempo").dialog("open") ;
	}

	function imaglink(){
		var images = 0;
		while (images < $(".grafico").length){
			var imgconte = "<img src='"+$(".grafico")[images].src+"'>" ;
			var imgtit = $(".grafico")[images].alt ;
			$(".grafico")[images].onclick = function() { dialogo(imgconte,imgtit); };
			images = images + 1 ;
		}
	}

	function validarlogin(){
		var elemento = document.getElementById('scripttemp'); 
		nuevoscript = document.createElement('script');
		nuevoscript.src = 'entrar.php?nick='+document.getElementById("nickname").value+'&pass='+document.getElementById("password").value+'&js=si';
		nuevoscript.id = 'scripttemp' ;
		elemento.parentNode.replaceChild(nuevoscript,elemento);
		setTimeout(function() { 
			if(estado == 'si'){
				document.location.reload() ;
				return true ;
			}
			if(estado == 'pass'){
				alert('pass mal');
				return false ;
			}
			if(estado == 'usuario'){
				alert('usuario no existe');
				return false ;
			}
		},2000) ;
	}	

	</script>
	
	<script type="text/javascript">
	$(document).ready(function() {
		imaglink() ;
	});

	$(function() {
		$("#partidos").hide();

		$(".accordion").accordion({
			collapsible: true,
			autoHeight: false
		});
		$(".accordionb").accordion({
			collapsible: true,
			autoHeight: false
		});

		$("#tempo").dialog({
			bgiframe: true,
			modal: true,
			autoOpen: false,
			draggable: false,
			resizable: false,
			width: 'auto'
		});


	});
	</script>
</head>
<body>
<?
require 'config.php';
require 'funciones.php';
?>
<div id="todo">
<div id="header" class="ui-corner-bottom"><img src="logo.jpg" ></div>

<div id="menu" class="ui-state-default ui-corner-all">
	<ul><li><a href="#" class="ui-state-default ui-corner-all" onclick="dialogo(login,'Conectate');">Conectate</a></li><li><a href="javascript: efecto('#partidos','#graficos');" class="ui-state-default ui-corner-all">vista normal</a></li>
	</ul>
</div>
<div id="cuerpo">
	<div class="accordion">
	<?
	$juga = jugadoresid() ;
	$njuga = 1;
	$numjug = numjugadores () ;
	while ( $njuga <= $numjug ) {
	      	$datos = mysql_query("select * from jugadores where id= '$juga[$njuga]'");
		$datos = mysql_fetch_array($datos);
		$jugador = $datos[jugador];
		?>
			<h3><a href="#"><? echo $jugador ; ?></a></h3>
			<div><? echo tabla($juga[$njuga]); ?></div>	
		<? $njuga = $njuga + 1 ;	
	} ?>
	</div>
		
	<div class="accordionb" id="graficos">
	<?
	$juga = jugadoresid() ;
	$njuga = 1;
	$numjug = numjugadores () ;
	while ( $njuga <= $numjug ) {
		$datos = mysql_query("select * from jugadores where id= '$juga[$njuga]'") ;
		$datos = mysql_fetch_array($datos) ; 	
		if ( $datos[patidos] == 0 ) { $puntos[$njuga] = 0; }
		else {	$puntos[$njuga] = $datos[puntos] / $datos[patidos];
			$puntos[$njuga] = round($puntos[$njuga], 2); 
			}
		if ( $datos[patidos] == 0 ) { $goles[$njuga] = 0; }
		else {  $difgoles = $datos[golesF] - $datos[golesE] ;
			$goles[$njuga] = $difgoles / $datos[patidos] ;
			$goles[$njuga] = round($goles[$njuga], 2);
			}
		$njuga = $njuga + 1 ;
	}
	?>
		<h3><a href="#">Promedio Puntos</a></h3>
		<div><img class="grafico" alt="Promedio Puntos" src='new/graidle/grafico.php?num=<?
			$numjug = numjugadores () ;
			echo $numjug . "&";
			$nomjuga = jugadoresnom() ;
			$njuga = 1;
			while ( $njuga <= $numjug ) {
				$nvar = "nom" . $njuga ;
				$$nvar = $nomjuga[$njuga] ;
				$pvar = "prom" . $njuga ;
				$$pvar = $puntos[$njuga] ;
				echo $nvar . "=" . $$nvar . "&" ;
				echo $pvar . "=" . $$pvar . "&" ;
				$njuga = $njuga + 1 ;
				}
			?>
		tit=Promedio+Puntos'>
		</div>
	
		<h3><a href="#">Promedio goles</a></h3>
		<div><img class="grafico" alt="Promedio Goles" src='new/graidle/grafico.php?num=<?
			echo $numjug . "&";
			$njuga = 1;
			while ( $njuga <= $numjug ) {
				$datos = mysql_query("select * from jugadores where id= $juga[$njuga]") ;
				$datos = mysql_fetch_array($datos) ;
				$nvar = "nom" . $njuga ;
				$$nvar = $nomjuga[$njuga] ;
				$pvar = "prom" . $njuga ;
				$$pvar = $goles[$njuga] ;
				echo $nvar . "=" . $$nvar . "&" ;
				echo $pvar . "=" . $$pvar . "&" ;
				$njuga = $njuga + 1 ;
				}
			?>
		tit=Promedio+goles'>
		</div>
	</div>

	<div class="accordionb" id="partidos">
		<h3><a href="#">Todos Los partidos</a></h3>
		<div id="divtabla"></div>
	
		<h3><a href="#">Tabla Completa</a></h3>
		<div><? echo tablatodo() ; ?></div>
	</div>

	<div class="accordion">
		<h3><a href="#">Ultimos Partidos</a></h3>
		<div><?	echo upart(5) ; ?>
			<a href="javascript: efecto('#graficos','#partidos'); mostrartabla(1);">Todos Los Partidos</a>
		</div>
	
		<h3><a href="#">Promedio Puntos</a></h3>
		<div>
			<table class='tabla'>
			<tr><th>Jugador</th><th>Promedio</th></tr>
			<?
				$juganom = jugadoresnom() ;
				$njuga = 1;
				$numjug = numjugadores () ;
				while ( $njuga <= $numjug ) {
					echo "<tr><td>" . $juganom[$njuga] . "</td><td>" . $puntos[$njuga] . "</td></tr>" ;
					$njuga = $njuga + 1 ;
					}
				?>
			</table>
		</div>
	
		<h3><a href="#">Promedio Goles</a></h3>
		<div>
		<table class='tabla'><tr><th>Jugador</th><th>Promedio</th></tr>
		<?
			$juganom = jugadoresnom() ;
			$njuga = 1;
			$numjug = numjugadores () ;
			while ( $njuga <= $numjug ) {
				echo "<tr><td>" . $juganom[$njuga] . "</td><td>" . $goles[$njuga] . "</td></tr>" ;
				$njuga = $njuga + 1 ;
			}
		?>
		</table>	
		</div>
	</div>
</div>
<div id="tempo"></div>
</div>
</body>
</html>
<?
ob_end_flush();
?>