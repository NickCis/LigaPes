<?php 
/* Devolucion:
error:
	1: Rango no suficiente
	2: Ids no seteadas

succes: Sin errores.
*/
function invitar() {
	global $facebook, $user_id;
	$facebook->validate_fb_params() ;
	if(isset($_REQUEST['liga'])) { 
		if (! requiererango($_REQUEST['liga'], '3', NULL)) {
			return "error_1";
		}
	}
	else {
		return "No invitacion de liga";
	}

	if(isset($_REQUEST['ids'])) {
		$invitacionIds = $_REQUEST['ids'] ;
		if(isset($_REQUEST['liga'])) {
			if(existeliga ($_REQUEST['liga'])) {
				$a = 0;
				while ( $a < sizeof($invitacionIds)) {
					if (!invitacion($invitacionIds[$a],$_REQUEST['liga'])) {
						if (!requiererango ($_REQUEST['liga'], '1', $invitacionIds[$a])) {
							if (isset($_REQUEST['fb_sig_time'])) {
								$fecha = $_REQUEST['fb_sig_time'] ;
							}
							else {
								$fecha = date('U') ;
							}
							$sqlI = "insert into invitacion (jugador,liga,invitador,fecha) values ('$invitacionIds[$a]','$_REQUEST[liga]','$user_id','$fecha')" ;
							mysql_query($sqlI) ;
						}
					}
					$a++ ;
				}
			}
		return 'succes';
		}
	}
	else {
		return 'error_2';
	}
}	
?> 
