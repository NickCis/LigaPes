<?
require 'login.php' ;
if($_GET[agregar]) {
require 'config.php' ;
	if($_GET[empate]) {
	$fecha = date('d-m-Y') ;
	$ganador = $_GET[ganador] ;
	$perdedor = $_GET[perdedor] ;
	$goles = $_GET[golesG] ;
	mysql_query("insert into partidos (fecha,ganador,perdedor,golesG,golesP,ip,empate,creador) values ('$fecha','$ganador','$perdedor','$goles','$goles','$_SERVER[REMOTE_ADDR]','si','$_COOKIE[unick]')") ;
	$datosganador = mysql_query("select * from jugadores where jugador= '$ganador' ") ;
	$datosganador = mysql_fetch_array($datosganador) ;
	$ganadorpunt = $datosganador[puntos] + 1 ;
	$ganadorpart = $datosganador[patidos] + 1 ;
	$ganadorpartg = $datosganador[epartidos] + 1 ;
	$ganadorgolesF = $datosganador[golesF] + $goles ;
	$ganadorgolesE = $datosganador[golesE] + $goles ;
	mysql_query("UPDATE `a1910103_lpes2`.`jugadores` SET `puntos` = '$ganadorpunt', `patidos` = '$ganadorpart', `epartidos` = '$ganadorpartg', `golesF` = '$ganadorgolesF', `golesE` = '$ganadorgolesE' WHERE `jugadores`.`jugador` = '$ganador' ;");
	$datosperdedor = mysql_query("select * from jugadores where jugador= '$perdedor' ") ;
	$datosperdedor = mysql_fetch_array($datosperdedor) ;
	$perdedorpunt = $datosperdedor[puntos] + 1 ;
	$perdedorpart = $datosperdedor[patidos] + 1 ;
	$perdedorpartp = $datosperdedor[epartidos] + 1 ;
	$perdedorgolesF = $datosperdedor[golesF] + $goles ;
	$perdedorgolesE = $datosperdedor[golesE] + $goles ;
	mysql_query("UPDATE `a1910103_lpes2`.`jugadores` SET `puntos` = '$perdedorpunt', `patidos` = '$perdedorpart', `epartidos` = '$perdedorpartp', `golesF` = '$perdedorgolesF', `golesE` = '$perdedorgolesE' WHERE `jugadores`.`jugador` = '$perdedor' ;");
	echo 'echo 'var estado="si"' ;
	}
	else {	
	$fecha = date('d-m-Y') ;
	$ganador = $_GET[ganador] ;
	$perdedor = $_GET[perdedor] ;
	$golesG = $_GET[golesG] ;
	$golesP = $_GET[golesP] ;
	mysql_query("insert into partidos (fecha,ganador,perdedor,golesG,golesP,ip,empate,creador) values ('$fecha','$ganador','$perdedor','$golesG','$golesP','$_SERVER[REMOTE_ADDR]','no','$_COOKIE[unick]')") ;
	$datosganador = mysql_query("select * from jugadores where jugador= '$ganador' ") ;
	$datosganador = mysql_fetch_array($datosganador) ;
	$ganadorpunt = $datosganador[puntos] + 3 ;
	$ganadorpart = $datosganador[patidos] + 1 ;
	$ganadorpartg = $datosganador[gpartidos] + 1 ;
	$ganadorgolesF = $datosganador[golesF] + $golesG ;
	$ganadorgolesE = $datosganador[golesE] + $golesP ;
	mysql_query("UPDATE `a1910103_lpes2`.`jugadores` SET `puntos` = '$ganadorpunt', `patidos` = '$ganadorpart', `gpartidos` = '$ganadorpartg', `golesF` = '$ganadorgolesF', `golesE` = '$ganadorgolesE' WHERE `jugadores`.`jugador` = '$ganador' ;");
	$datosperdedor = mysql_query("select * from jugadores where jugador= '$perdedor' ") ;
	$datosperdedor = mysql_fetch_array($datosperdedor) ;
	$perdedorpart = $datosperdedor[patidos] + 1 ;
	$perdedorpartp = $datosperdedor[ppartidos] + 1 ;
	$perdedorgolesF = $datosperdedor[golesF] + $golesP ;
	$perdedorgolesE = $datosperdedor[golesE] + $golesG ;
	mysql_query("UPDATE `a1910103_lpes2`.`jugadores` SET `patidos` = '$perdedorpart', `ppartidos` = '$perdedorpartp', `golesF` = '$perdedorgolesF', `golesE` = '$perdedorgolesE' WHERE `jugadores`.`jugador` = '$perdedor' ;");
	echo 'echo 'var estado="si"' ;
	}
}
?>
