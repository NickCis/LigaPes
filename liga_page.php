<?php
/*echo('<pre>');
print_r($_REQUEST);
echo('</pre>');*/
require_once 'config.php';
require_once 'funciones.php';
if (! isset($_REQUEST['liga'])) {
	exit('ERROR: Liga No seteada');
}

?>
<div id="liga_body">
<?php
switch ($_REQUEST['accion']) {
	case 'tabla_jug':
		echo tablas_jugadores ($_REQUEST['liga'],NULL,"id=\"tablacuadricula\"","class=\"ui-state-default\"",NULL,$tabla,"class=\"htrestitle\"",$ah3,$divin,$ul,$li) ;
		echo "</div>" ;
		echo "<img src=\"icons/accept.png\" onload='$(\"#tablacuadricula\").sortable(); $(\"#tablacuadricula\").disableSelection()' />";
	break;

	case 'grafico':
		echo grafico_liga($_REQUEST['liga']);
	break;

	default:
		echo "<div id=\"lista_partidos\">";
		echo lista_partidos(nombreliga($_REQUEST['liga']),partidos($_REQUEST['liga'],10,$_REQUEST['pag'],NULL),NULL,NULL,"class=\"htrestitle\"","class=\"fbbodyderul\"",NULL,"class=\"fbbodyderfbfecha\"");
		echo lista_partidos_menu($_REQUEST['liga'],10,$_REQUEST['pag'],NULL,"href=\"javascript: div_ajax_post('liga_page.php',$('#body_der')[0],{liga: '" . $_REQUEST['liga'] . "', pag: '\$pag' })\"",NULL,NULL,NULL);
		echo "</div>" ;
	break;
}
?>	
</div>
