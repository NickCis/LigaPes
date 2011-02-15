<?
/* Respuesta:
error:
	1: No Estan todas las variables seteadas
	2: Hay 2 ganadores iguales
	3: Hay un perdedor igual a un ganador
	4: Hay perdedores iguales
	5: En empate la cant de goles es distinta
	6: En victoria la cant de goles es igual
	7: Hay Ganadores que no estan en la liga
	8: Hay perdedores que no estan en la liga
	9: Goles Perdedor mas altos que ganador
	10: Valores de goles No numericos.
succes: Se Cargo correctamente el partido.
*/


function agregarpartido() {
	global $facebook, $user_id;
	$facebook->validate_fb_params() ;

	if (!$_POST['liga'] || !requiererango($_POST['liga'],2, NULL) || !isset($_POST['ganador']) || !isset($_POST['perdedor']) || !isset($_POST['golesG']) || !isset($_POST['golesP']) || !$facebook) {
		return 'error_1' ;
	}
	else {
		$liga = $_POST['liga'] ;
		if (isset($_POST['fb_sig_time'])) {
			$fecha = $_POST['fb_sig_time'] ;
		}
		else {
			$fecha = date('U') ;
		}
		$ganador = $_POST['ganador'] ;
		$ganadorj = implode("_",$ganador) ;
		$perdedor = $_POST['perdedor'] ;
		$perdedorj = implode("_",$perdedor) ;
		$golesG = $_POST['golesG'] ;
		$golesP = $_POST['golesP'] ;
		if ( !is_numeric($golesG) || !is_numeric($golesP) ) {
			return 'error_10';
		}	
		foreach($ganador as $ganadores) {
			if (!requiererango($_POST['liga'],2, $ganadores)) { // Controla que Los ganadores esten en la liga
				return 'error_7';
			}
			foreach($perdedor as $perdedores) { // Controla qe no halla Un perdedor igual a un ganador
				if (!requiererango($_POST['liga'],2, $perdedoresres)) { //Controla que los perdedores esten en la liga
					return 'error_8';
				}
				if ($ganadores == $perdedores) {
					return 'error_3';
				}
			}
		}
		
		$compgan = 0 ; // Controla que no halla dos ganadores iguales
		while ( $compgan < sizeof($ganador) ) {
			$compganin = 0;
			while ($compganin < sizeof($ganador)) {
				if ($compganin !== $compgan ) {
					if ( $ganador[$compganin] == $ganador[$compgan] ) {
						return 'error_2';
					}
				}
				$compganin++;
			}
			$compgan++ ;
		}
	
		$compper = 0 ; // Controla que no halla dos perdedores iguales
		while ( $compper < sizeof($perdedor) ) {
			$compperin = 0;
			while ($compperin < sizeof($perdedor)) {
				if ($compperin !== $compper ) {
					if ( $perdedor[$compperin] == $perdedor[$compper] ) {
						return 'error_4';
					}
				}
				$compperin++;
			}
			$compper++ ;
		}
	
		if($_POST['empate']) {
			if ($golesP != $golesG ) {
				return 'error_5';
			}
			$empa = 'si';
			$maspuntosG = 1 ;
			$maspuntosP = 1 ;
			$tipopartidoG = "epartidos" ;
			$tipopartidoP = "epartidos" ;
		}
		else {
			if ($golesP == $golesG ) {
				return 'error_6';
			}
			if ($golesG < $golesP ) {
				return 'error_9';
			}
			$empa = 'no';
			$maspuntosG = 3 ;
			$maspuntosP = 0 ;
			$tipopartidoG = "gpartidos" ;
			$tipopartidoP = "ppartidos" ;
		}
	
		$sqlp = "insert into " . $liga . "_partidos (fecha,ganador,perdedor,golesG,golesP,empate,creador) values ('$fecha','$ganadorj','$perdedorj','$golesG','$golesP','$empa','$user_id')" ;
		mysql_query($sqlp) ;
	
		foreach($ganador as $ganadores) {
			$sqlg = "select * from " . $liga . "_jugadores where jugador= '$ganadores' " ;
			$datosganador = mysql_query($sqlg) ;
			$datosganador = mysql_fetch_array($datosganador) ;
			$ganadorpunt = $datosganador[puntos] + $maspuntosG ;
			$ganadorpart = $datosganador[patidos] + 1 ;
			$ganadorpartg = $datosganador[$tipopartidoG] + 1 ;
			$ganadorgolesF = $datosganador[golesF] + $golesG ;
			$ganadorgolesE = $datosganador[golesE] + $golesP ;
			$sqlgu = "UPDATE `" . $liga . "_jugadores` SET `puntos` = '$ganadorpunt', `patidos` = '$ganadorpart', `" . $tipopartidoG . "` = '$ganadorpartg', `golesF` = '$ganadorgolesF', `golesE` = '$ganadorgolesE' WHERE `jugador` = '$ganadores' ;" ;
			mysql_query($sqlgu);
		}
		foreach($perdedor as $perdedores) {
			$sqlp = "select * from " . $liga . "_jugadores where jugador= '$perdedores' " ;
			$datosperdedor = mysql_query($sqlp) ;
			$datosperdedor = mysql_fetch_array($datosperdedor) ;
			$perdedorpunt = $datosperdedor[puntos] + $maspuntosP ;
			$perdedorpart = $datosperdedor[patidos] + 1 ;
			$perdedorpartp = $datosperdedor[$tipopartidoP] + 1 ;
			$perdedorgolesF = $datosperdedor[golesF] + $golesP ;
			$perdedorgolesE = $datosperdedor[golesE] + $golesG ;
			$sqlpu = "UPDATE `" . $liga . "_jugadores` SET `puntos` = '$perdedorpunt', `patidos` = '$perdedorpart', `" . $tipopartidoP . "` = '$perdedorpartp', `golesF` = '$perdedorgolesF', `golesE` = '$perdedorgolesE' WHERE `jugador` = '$perdedores' ;" ;
			mysql_query($sqlpu);
		}
	}
	return 'succes';
}
?>
