<?php
/* Devolucion:
error:
	1: Usuario no tiene invitaciones
	2: variables no seteadas
succes: todo bien.
*/
function invite_accept () {
	global $facebook, $user_id;
	$facebook->validate_fb_params() ;
	if (!invitacion ($user_id,NULL)) {
		return 'error_1' ;		
	}
	if (isset($_REQUEST['liga']) ) {
		$ligas_acept = $_REQUEST['liga'];
		if (isset ($_REQUEST['fb_sig_time']) ) {
			$fecha = $_REQUEST['fb_sig_time'];
		}
		else {
			$fecha = date('U');
		}
		$a = 0 ;
		while ($a < sizeof($ligas_acept)) {
			if (! requiererango($ligas_acept[$a], 1, $user_id) ) {
				$sqlj = "insert into ". $ligas_acept[$a] ."_jugadores 	(fecha,jugador,puntos,patidos,gpartidos,epartidos,ppartidos,golesF,golesE,rango,invitador) values ('$fecha','$user_id','0','.0','0','0','0','0','0','3','0')" ;
				mysql_query($sqlj) ;
				$datosliga = mysql_fetch_array(mysql_query("select * from ligas where nombre= '" . $ligas_acept[$a] . "'"));
				$cantjug = $datosliga['cantjug'] + 1 ;
				$jugadores = $datosliga['jugadores'] . "_" . $user_id ;
				$sqll = "UPDATE `ligas` SET `cantjug` = '" . $cantjug . "', `jugadores` = '" . $jugadores . "' WHERE `nombre` = '" . $ligas_acept[$a] . "'" ;
				mysql_query($sqll);
			}
			$sqli = "DELETE FROM `invitacion` WHERE `jugador` = '" . $user_id . "' AND `liga` = '" . $ligas_acept[$a] . "'";	
			mysql_query($sqli) ;
			$a++ ;
		}
	}	
	else {	
		return 'error_2';
	}
	return 'succes';
}
?>
