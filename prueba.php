<?php
require_once 'config.php';
require_once 'funciones.php';
echo urlencode("asdasd /n asdasd");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>jQuery UI Autocomplete Custom Data Demo</title>

	<script type="text/javascript" src="http://jqueryui.com/demos/autocomplete/../../jquery-1.4.2.js"></script>
	<script type="text/javascript" src="http://jqueryui.com/demos/autocomplete/../../ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="http://jqueryui.com/demos/autocomplete/../../ui/jquery.ui.widget.js"></script>
	<link type="text/css" href="http://jqueryui.com/demos/autocomplete/../../themes/base/jquery.ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="http://jqueryui.com/demos/autocomplete/../../ui/jquery.ui.position.js"></script>
	<script type="text/javascript" src="http://jqueryui.com/demos/autocomplete/../../ui/jquery.ui.autocomplete.js"></script>
	<style type="text/css">
	#project-label {
		display: block;
		font-weight: bold;
		margin-bottom: 1em;
	}
	#project-icon {
		float: left;
		height: 32px;
		width: 32px;
	}
	#project-description {
		margin: 0;
		padding: 0;
	}
	</style>


<script type="text/javascript" src="js/autocomplete_select.js"></script>
<script type="text/javascript">var inputvar =  <?php echo jsusuarios('liga_uefa') ;?></script>
	<script type="text/javascript">
	/*var inputvar = [
			{
				value: 'jquery',
				label: 'jQuery',
				icon: 'jquery_32x32.png'
			},
			{
				value: 'jquery-ui',
				label: 'jQuery UI',
				icon: 'jqueryui_32x32.png'
			},
			{
				value: 'sizzlejs',
				label: 'Sizzle JS',
				icon: 'sizzlejs_32x32.png'
			}
		];

	var inputvar =  <?php echo jsusuarios('liga_uefa') ;?>
	function autocomplete_select(inputid,rnodeid,namevar,options) {
		$('#'+inputid).autocomplete({
			minLength: 0,
			source: options,
			focus: function(event, ui) {
				$('#'+inputid).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#'+inputid).val('');
				$('#'+rnodeid).append('<span><img src="' + ui.item.icon + '">'+ ui.item.label + '<input value="'+ ui.item.value +'" type="hidden" name="'+ namevar +'[]" ><a href="#" onclick="$(this.parentNode).remove()">X</a></span>');
				alert(rnode.innerHTML);
				
				return false;
			}
		})
		.data( "autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a><img src='" + item.icon + "'>" + item.label + "</a>" )
				.appendTo( ul );
		};

	};



	
	$(function() {
		var projects = [
			{
				value: 'jquery',
				label: 'jQuery',
				icon: 'jquery_32x32.png'
			},
			{
				value: 'jquery-ui',
				label: 'jQuery UI',
				icon: 'jqueryui_32x32.png'
			},
			{
				value: 'sizzlejs',
				label: 'Sizzle JS',
				icon: 'sizzlejs_32x32.png'
			}
		];
		
		$('#project').autocomplete({
			minLength: 0,
			source: projects,
			focus: function(event, ui) {
				$('#project').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#project').val('');
				$('#project-icon').attr('src', 'http://jqueryui.com/demos/autocomplete/../images/' + ui.item.icon);
				$('#project-result').append('<span><img src="http://jqueryui.com/demos/autocomplete/../images/' + ui.item.icon + '">'+ ui.item.label + '<input value="'+ ui.item.value +'" type="hidden" name="result[]" ><a href="#" onclick="$(this.parentNode).remove()">X</a></span>');
				
				return false;
			}
		})
		.data( "autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a><img src='http://jqueryui.com/demos/autocomplete/../images/" + item.icon + "'>" + item.label + "</a>" )
				.appendTo( ul );
		};
	});*/
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


<?
/*$hola = $facebook->api_client->users_getInfo(miembrosliga('liga_uefa'),Array('name','pic_square'));

echo('-----<pre>');
print_r($hola);
echo('</pre>-----');*/

echo('<pre>');
print_r($_REQUEST);
echo('</pre>');
?>
<a href='#' onclick='autocomplete_select("project","project-result","resultado",inputvar); autocomplete_select("perde","perde-result","perde",inputvar)'>Autoselect</a>
<div class="demo">
	<form name='nombres' id='nombres' action='http://ligapes2009.site90.com/app/prueba.php' method="get">
		Ganadores
		<input id="project"/>
		<div id="project-result"></div>
		Perdedores		
		<input id="perde"/>
		<div id="perde-result"></div>
		<input type="submit">
	</form>


</div><!-- End demo -->

<div class="demo-description">
<p>
You can use your own custom data formats and displays by simply overriding the default focus and select actions.

</p>
<p>
Try typing "j" to get a list of projects or just press the down arrow.
</p>
</div><!-- End demo-description -->

</body>
</html>

