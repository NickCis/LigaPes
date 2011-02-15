<?php 
echo('<pre>');
print_r($_REQUEST);
echo('</pre>');

require_once 'config.php';
require_once 'funciones.php';
require_once 'modules/invite.php';
$invitar = invitar() ;
switch ( $invitar ) {
	case 'error_1':
		echo('<div class="fberrorbox">Error: Rango No suficiente  <a href="' . $basepage . '">Click Aqui para volver al inicio</a></div>');
	break;

	case 'error_2':
		echo('<div class="fberrorbox">Error: Ids No seteadas <a href="' . $basepage . '">Click Aqui para volver al inicio</a></div>');
	break;
	
	case 'succes':
		echo('Se han invitado a los usuarios correctamente  <a href="' . $basepage . '">Click Aqui para volver al inicio</a>.');
	break;

	default:
	echo($agregar);
	break;
}

?> 
