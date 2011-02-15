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
	case 'borrarliga':
		echo "no implementado";	
	break;

	case 'jugadores':
		echo "no implementado";
	break;

	default:
		if ( requiererango($_REQUEST['liga'],4, NULL) ) {
			echo "<div id=\"lista_partidos\">";
			echo lista_partidos_borrar(nombreliga($_REQUEST['liga']),partidos($_REQUEST['liga'],10,$_REQUEST['pag'],NULL),"borrarpartidos.php", Array( 'h3' => "class=\"htrestitle\"",'ul' => "class=\"fbbodyderul\"", 'can-img' => 'icons/cross.png'));
			echo lista_partidos_menu($_REQUEST['liga'],10,$_REQUEST['pag'],NULL,"href=\"javascript: div_ajax_post('liga_admin.php',$('#body_der')[0],{liga: '" . $_REQUEST['liga'] . "', pag: '\$pag' })\"",NULL,NULL,NULL);
			echo "</div>" ;
		}
		else {
			echo('<div class="fberrorbox">No Estan todas las variables seteadas o Rango Insuficiente</div>');
		}
	break;
}
?>	
</div>
