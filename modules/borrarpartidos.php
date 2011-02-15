<?
/* Respuesta:
error:
	1: No Estan todas las variables seteadas o no hay rango requerido
	2: Error con query informacion ganador
	3: Error con query informacion perdedor
	4: Partido inexistente
succes: Se borro correctamente el partido
*/


function borrarpartido() {
	global $facebook, $user_id;
	$facebook->validate_fb_params() ;

	if (!$_REQUEST['liga'] || !requiererango($_REQUEST['liga'],4, NULL) || !isset($_REQUEST['partidoid']) || !$facebook) {
		return 'error_1' ;
	}
	else {
		$sqli = " SELECT * FROM `". $_REQUEST['liga'] . "_partidos`  WHERE `id` = ". $_REQUEST['partidoid'] ;
		if ( $info = mysql_query($sqli) ) {
			if ( $info = mysql_fetch_array($info) ) {
				$gana_re =str_replace("_"," OR `jugador` = ", $info['ganador'] );
				$sqlg = " SELECT * FROM `". $_REQUEST['liga'] . "_jugadores`  WHERE `jugador` = " . $gana_re ;
				if (! $sqlgq = mysql_query($sqlg) ) {
					return "error_2";
				}
				while ($ganador = mysql_fetch_array($sqlgq) ) {
					if ($info['empate'] == 'si') {
						$gana['puntos'] = $ganador['puntos'] - 1;
						$gana['gpartidos'] = $ganador['gpartidos'] ;
						$gana['epartidos'] = $ganador['epartidos'] - 1;
						$gana['ppartidos'] = $ganador['gpartidos'] ;
					}
					else {
						$gana['puntos'] = $ganador['puntos'] - 3;
						$gana['gpartidos'] = $ganador['gpartidos'] -1;
						$gana['epartidos'] = $ganador['epartidos'] ;
						$gana['ppartidos'] = $ganador['gpartidos'] ;
					}
					$gana['patidos'] = $ganador['patidos'] - 1;
					$gana['golesF'] = $ganador['golesF'] - $info['golesG'];
					$gana['golesE'] = $ganador['golesE'] - $info['golesP'];
					$sqlUg = "UPDATE `". $_REQUEST['liga'] ."_partidos` SET `puntos` = '" . $gana['puntos'] . "',
`patidos` = '" . $gana['patidos'] . "', `gpartidos` = '" . $gana['gpartidos'] . "', `epartidos` = '" . $gana['epartidos'] . "', `ppartidos` = '" . $gana['patidos'] . "', `golesF` = '" . $gana['golesF'] . "', `golesE` = '" . $gana['golesE'] . "' WHERE `" . $_REQUEST['liga'] . "_jugadores`.`jugador` =" . $ganador['jugador'];
					mysql_query($sqlUg);

				}
				$perd_re = str_replace("_"," OR `jugador` = ", $info['ganador']) ;
				$sqlp = " SELECT * FROM `". $_REQUEST['liga'] . "_jugadores`  WHERE `jugador` = " . $perd_re ;
				if (! $sqlpq = mysql_query($sqlp) ) {
					return 'error_3';
				}
				while ($perdedor = mysql_fetch_array($sqlpq) ) {
					if ($info['empate'] == 'si') {
						$perd['puntos'] = $perdedor['puntos'] -1 ;
						$perd['gpartidos'] = $perdedor['gpartidos'];
						$perd['gpartidos'] = $perdedor['epartidos'] -1 ;
						$perd['ppartidos'] = $perdedor['ppartidos'];
					}
					else {					
						$perd['puntos'] = $perdedor['puntos'] ;
						$perd['gpartidos'] = $perdedor['gpartidos'];
						$perd['gpartidos'] = $perdedor['epartidos'] ;
						$perd['ppartidos'] = $perdedor['ppartidos'] -1;
					}
					$perd['patidos'] = $perdedor['patidos'] - 1;
					$perd['golesF'] = $perdedor['golesF'] - $info['golesP'];
					$perd['golesE'] = $perdedor['golesE'] - $info['golesG'];
					$sqlUp = "UPDATE `". $_REQUEST['liga'] ."_partidos` SET `puntos` = '" . $perd['puntos'] . "',
`patidos` = '" . $perd['patidos'] . "', `gpartidos` = '" . $perd['gpartidos'] . "', `epartidos` = '" . $perd['epartidos'] . "', `ppartidos` = '" . $perd['patidos'] . "', `golesF` = '" . $perd['golesF'] . "', `golesE` = '" . $perd['golesE'] . "' WHERE `" . $_REQUEST['liga'] . "_jugadores`.`jugador` =" . $perdedor['jugador'];
					mysql_query($sqlUp);
				}
			}
			else {
				return 'error_4' ;
			}
		}
		else {
			return 'error_4' ;
		}
		$sqld = "DELETE FROM `". $_REQUEST['liga'] ."_partidos` WHERE `id` = ". $_REQUEST['partidoid'] ." LIMIT 1";
		mysql_query($sqld) ;	
	}
	return 'succes';
}
?>
