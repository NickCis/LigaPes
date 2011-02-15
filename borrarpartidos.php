<?php
require_once 'config.php';
require_once 'funciones.php';
require_once 'modules/borrarpartidos.php';
$borrar = borrarpartido() ;
switch ( $borrar ) {
	case 'error_1':
		echo('<div class="fberrorbox">No Estan todas las variables seteadas o Rango Insuficiente</div>');
	break;

	case 'error_2':
		echo('<div class="fberrorbox">Error con query informacion ganador</div>');
	break;

	case 'error_3':
		echo('<div class="fberrorbox">Error con query informacion perdedor</div>');
	break;

	case 'error_4':
		echo('<div class="fberrorbox">Partido inexistente</div>');
	break;

	case 'error_5':
		echo('<div class="fberrorbox">En empate la cant de goles es distinta</div>');
	break;

	case 'error_6':
		echo('<div class="fberrorbox">En victoria la cant de goles es igual</div>');
	break;

	case 'error_7':
		echo('<div class="fberrorbox">Hay Ganadores que no estan en la liga</div>');
	break;

	case 'error_8':
		echo('<div class="fberrorbox">Hay perdedores que no estan en la liga</div>');
	break;

	case 'error_9':
		echo('<div class="fberrorbox">Goles Perdedor mas altos que ganador</div>');
	break;

	case 'error_10':
		echo('<div class="fberrorbox">Valores de Goles No numericos</div>');
	break;

	case 'succes':
		echo("<div class=\"fbbluebox\">Partido borrado Correctamente</div>");
	break;

	default:
	echo($borrar);
	break;
}
?>
