<? # ----------------------------------- Funciones ------------------------
# numjugadores () -- Cantidad de jugadores que juegan
# jugadoresid () -- Array: Ids jugadores que juegan
# jugadoresno () -- Array: Nombre jugadores que juegan
# partidosG ($jugador, $oponente) -- Cantidad Partidos Ganados al Oponente                     
# partidosP ($jugador, $oponente) -- Cantidad Partidos Perdidos al Oponente                 
# partidosE ($jugador, $oponente)  -- Cantidad Partidos empatatados al Oponentes
# difgoles ($jugador, $oponente)  -- Diferencia de Goles
# tabla ($jugador) -- Tabla de x jugador
# upart ($num) -- Ultimos Partidos ( numero de partidos)
# tablatodo () -- tabla con toda la info de los jugadores
# function optionjuga() -- Options para form (solo interior) con todos los jugadores

function numjugadores () {
$datos = mysql_query("select * from jugadores where juega= 'si'");
$datos = mysql_num_rows($datos);
return $datos ;
}

function jugadoresid () {
$datos = mysql_query("select * from jugadores where juega= 'si'");
$datosjug = mysql_fetch_array($datos);
$a = 1 ;
while ( $datosjug ) {
	$jugid[$a] = $datosjug[id] ;
	$datosjug = mysql_fetch_array($datos);
	$a = $a + 1 ;
	}
return $jugid ;
}

function jugadoresnom () {
$datos = mysql_query("select * from jugadores where juega= 'si'");
$datosjug = mysql_fetch_array($datos);
$a = 1 ;
while ( $datosjug ) {
	$jugid[$a] = $datosjug[jugador] ;
	$datosjug = mysql_fetch_array($datos);
	$a = $a + 1 ;
	}
return $jugid ;
}

function partidosG ($jugador, $oponente) { #Variable: Cantidad Partidos Ganados al Oponente
$datos = mysql_query("select * from jugadores where id= '$jugador'");
$datos = mysql_fetch_array($datos);
$jugador = $datos[jugador];
$datos = mysql_query("select * from jugadores where id= '$oponente'");
$datos = mysql_fetch_array($datos);
$oponente = $datos[jugador];
$datosganados = mysql_query("select * from partidos where ganador= '$jugador' AND perdedor= '$oponente' AND empate= 'no'") ;
$numganados = mysql_num_rows($datosganados) ; 
return $numganados;
}

function partidosP ($jugador, $oponente) { #Variable: Cantidad Partidos Perdidos al Oponente
$datos = mysql_query("select * from jugadores where id= '$jugador'");
$datos = mysql_fetch_array($datos);
$jugador = $datos[jugador];
$datos = mysql_query("select * from jugadores where id= '$oponente'");
$datos = mysql_fetch_array($datos);
$oponente = $datos[jugador];
$datosperdidos = mysql_query("select * from partidos where ganador= '$oponente' AND perdedor= '$jugador' AND empate= 'no'") ;
$numperdidos = mysql_num_rows($datosperdidos) ; 
return $numperdidos;
}

function partidosE ($jugador, $oponente) { #Variable: Cantidad Partidos empatatados al Oponentes
$datos = mysql_query("select * from jugadores where id= '$jugador'");
$datos = mysql_fetch_array($datos);
$jugador = $datos[jugador];
$datos = mysql_query("select * from jugadores where id= '$oponente'");
$datos = mysql_fetch_array($datos);
$oponente = $datos[jugador];
$datosempate = mysql_query("select * from partidos where ganador= '$jugador' AND perdedor= '$oponente' AND empate= 'si'") ;
$numempate = mysql_num_rows($datosempate) ; 
$datosempate = mysql_query("select * from partidos where ganador= '$oponente' AND perdedor= '$jugador' AND empate= 'si'") ;
$numempate = $numempate + mysql_num_rows($datosempate) ;
return $numempate;
}

function difgoles ($jugador, $oponente) { #Variable: Diferencia de Goles
$datos = mysql_query("select * from jugadores where id= '$jugador'");
$datos = mysql_fetch_array($datos);
$jugador = $datos[jugador];
$datos = mysql_query("select * from jugadores where id= '$oponente'");
$datos = mysql_fetch_array($datos);
$oponente = $datos[jugador];
$golesjugador = 0;
$golesoponente = 0;
$datosganados = mysql_query("select * from partidos where ganador= '$jugador' AND perdedor= '$oponente' AND empate= 'no'") ;
while ( $datosgoles = mysql_fetch_array($datosganados) ) {
	$golesjugador = $golesjugador + $datosgoles[golesG];
	$golesoponente = $golesoponente + $datosgoles[golesP];
	}
$datosperdidos = mysql_query("select * from partidos where ganador= '$oponente' AND perdedor= '$jugador' AND empate= 'no'") ;
while ( $datosgoles = mysql_fetch_array($datosperdidos) ) {
	$golesjugador = $golesjugador + $datosgoles[golesP];
	$golesoponente = $golesoponente + $datosgoles[golesG];
	}
$difgoles = $golesjugador - $golesoponente; 
return $difgoles;
}

function tabla ($id) {
	$tabla = "<table class='tabla'><tr><th><p>Jugador</p></th><th><p>PG</p></th><th><p>PE</p></th><th><p>PP</p></th><th><p>Dif Goles</p></th></tr>" ;
	$numjug = numjugadores() ;
	$nopo = 1 ;
	$opo = jugadoresid() ;
	$nombre = jugadoresnom() ;
	while ( $nopo <= $numjug) {
		if ($nopo == $id) {$nopo = $nopo + 1 ; }
		$datos = mysql_query("select * from jugadores where id= '$opo[$nopo]'");
		$datos = mysql_fetch_array($datos);
		$partg = partidosG($id, $opo[$nopo]) ;
		$parte = partidosE($id, $opo[$nopo]) ;
		$partp = partidosP($id, $opo[$nopo]) ;
		$goles = difgoles($id, $opo[$nopo]) ;
		$tabla = $tabla . "<tr><td>$nombre[$nopo]</td><td>$partg</td><td>$parte</td><td>$partp</td><td>$goles</td></tr>" ;
		$nopo = $nopo + 1 ;
		if ($nopo == $id) {$nopo = $nopo + 1 ; }
	}
	$tabla = $tabla . "</table>" ;
	return $tabla ;
}

function upart ($num) {
	$tabla = "<table class='tabla'><tr><th>Fecha</th><th>Ganador</th><th>Perdedor</th></tr>" ;
	$datos = mysql_query("select * from partidos ORDER BY id DESC LIMIT 0, $num");
	while ($datosT = mysql_fetch_array($datos)) {
		$fecha = substr($datosT[fecha], 0, 5);  
		$tabla = $tabla . "<tr><td>" . $fecha . "</td><td>" . $datosT[ganador] . "(" . $datosT[golesG] . ")</td><td>" .  $datosT[perdedor] . "(" . $datosT[golesP] . ")</td></tr>";
	}
	$tabla = $tabla . "</table>" ;
	return $tabla ;
}

function tablatodo () {
	$tabla = "<table class='tabla'><tr><th>Jugador</th><th>Pts</th><th>PJ</th><th>PG</th><th>PE</th><th>PP</th><th>GF</th><th>GC</th><th>Dif</th></tr>" ;
	$datos = mysql_query("select * from jugadores where juega= 'si'");
	while ($datosT = mysql_fetch_array($datos)) {
		$difgoles = $datosT[golesF] - $datosT[golesE] ;
		$tabla = $tabla . "<tr><td>" . $datosT[jugador] . "</td><td>" . $datosT[puntos] . "</td><td>" .  $datosT[patidos] . "</td><td>" .  $datosT[gpartidos] . "</td><td>" .  $datosT[epartidos] . "</td><td>" .  $datosT[ppartidos] . "</td><td>" .  $datosT[golesF] . "</td><td>" .  $datosT[golesE] . "</td><td>" .  $difgoles . "</td></tr>";
	}
	$tabla = $tabla . "</table>" ;
	return $tabla ;
}
function optionjuga() {
	$optionjuga ;
	$datos = mysql_query("select * from jugadores where juega= 'si'");
	while ($datosT = mysql_fetch_array($datos)) {
		$optionjuga = $optionjuga . '<option value="' . $datosT[jugador] . '">' . $datosT[jugador] . '</option>';
	}
	return $optionjuga ;
}

# ------------------------------- Fin Funciones --------------------------
?>