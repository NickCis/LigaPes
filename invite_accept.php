<?php
require_once 'config.php';
require_once 'funciones.php';
require_once 'modules/invite_accept.php';
$invite = invite_accept() ;
switch ( $agregar ) {
	case 'error_1':
		echo('<div class="fberrorbox">Usuario no tiene invitaciones</div>');
	break;

	case 'error_2':
		echo('<div class="fberrorbox">Variables no seteadas</div>');
	break;

	case 'succes':
		echo("<div class=\"fbbluebox\">Invitaciones Aceptadas</div>");
	break;

	default:
	echo($invite);
	break;
}
?>
