<?
#----------- Funciones ---------
#xfbml ($tipo,$vars,$in)
#xfbml_php ($user, $info) Ambas array o no array, devuelve array
#fbvars ($tipo)
#nombreliga(liga) -- Devulve nombre liga transformado a lindo (espacios y mayusculas) *** TERMINAR
#requirerango(liga,rango,usuario) -- Comprueba que el rango sea el espeficiado o mayor en rango y liga especifica. Devuelve TRUE si verdadero (usuario para saber si usuario esta en la liga)
#existeliga(liga) -- Comprueba si existe la liga donde nombre de liga es liga. Devuelve TRUE si existe
#invitacion(usuario,liga) -- Ver si tiene invitaciones el usuario (valor liga opcional). Devuelve TRUE si tiene, FALSE si no.
#mostrar_invitacion (usuario) -- Devuelve en Array (valor inicial 0), las ligas a las qe esta invitado el usuario. FALSE si no hay.
#form_invitacion (ligas,action) -- Crea Form qe muestra las invitaciones, donde ligas son los nombre de las ligas y action el action del form
# new_form_partido ($liga,$action,$style) $style = array -- inemp, ingana, golesgana, regana, inperd, golesperd, reperd, submit
# form_partido ($liga,$action,$div,$fbml,$ajax)
#form_liga ($action,$div)
#form_invite ($action,$texto,$liga,$textoliga,$div)
#ligas_usuario (usuario) -- Devuelve todas las ligas en las qe el usuario esta en Array! Devuelve FALSE si no esta en ninguna.
#amigosdiv(amigos,remover)
#miembrosliga(liga)
#partidos($liga,$muestra,$pag,$usuario)
#lista_partidos($titulo,$partidos,$divtodo,$divin,$h3,$ul,$li,$fbfecha)
#lista_partidos_menu($liga,$muestra,$pag,$usuario,$pagina,$div,$ul,$li)
#lista_ligas($muestra,$divfuera,$divtodo,$divin,$h3,$ul,$li,$fbfecha)
#barra_menu_ligas($div,$a)
#menu_ligas($divfuera,$divtodo,$divin,$h3,$ah3,$imgh3,$ul,$li,$astyle,$posthtml,$liga)
#partidosjug ($liga, $jugador)
#partidosG ($liga, $jugador, $oponente) Variable: Cantidad Partidos Ganados al Oponente
#partidosP ($liga, $jugador, $oponente) Variable: Cantidad Partidos Perdidos al Oponente (Alias de partidosG)
#partidosE ($liga, $jugador, $oponente) Variable: Cantidad Partidos empatatados al Oponentes
#difgoles ($jugador, $oponente) Variable: Diferencia de Goles
#tabla_jugador ($jugador,$liga,$divtodo,$tabla,$h3,$ah3,$divin,$ul,$li)
#tablas_jugadores ($liga,$divfuera,$litab,$divtodo,$tabla,$h3,$ah3,$divin,$ul,$li)
#jsusuarios ($liga) 
#promedio ($liga, $tipo, $jugador)
#grafico ($titulo,$variables,$color)
#grafico_liga ($liga) 
#lista_partidos_borrar($titulo,$partidos,$action,$style) syle = array (divtodo,divin,h3,ul,li,fbfecha,can-img)
#----------
function xfbml ($tipo,$vars,$in) {
	foreach ( $vars as $nvar => $var) {
		$retorno .= ' '. $nvar . '="' . $var . '"';
	}
	$retorno = "<fb:". $tipo . $retorno . ">";
	if (isset($in)) {
		$retorno .= $in;
	}
	$retorno .= "</fb:" . $tipo . ">";
	return $retorno;
}

function xfbml_php ($users, $infos) {
	global $facebook;
	if (! is_array($users) ) {
		$users = Array($users);
	}
	if (! is_array($infos) ) {
		$infos = explode(",",$infos);
	}
	return $facebook->api_client->users_getInfo($users,$infos);

}
function fbvars ($tipo) {
	if (! isset($tipo) ) {
		return false;
	}
	foreach($_REQUEST as $key => $value) {
		if (strpos($key,"fb_sig")!==false) {
			switch ($tipo) {
				case "POST":
					$fbvars.= $key . ": \"" . $value . "\", ";
					break;

				case "GET":
					if ($i!=0) $fbvars.= "&";
					$fbvars.= "$key=$value";
					$i++;
					break;

				case 'form':
					$fbvars.= "<input value='" . $value . "' type='hidden' name='" . $key . "'>";
					break;
				default:
					return false;
					break;
			}


			/*if( $tipo == "POST") {
				$fbvars.= $key . ": \"" . $value . "\", ";
			}
			else {
					if ($i!=0) $fbvars.= "&";
					$fbvars.= "$key=$value";
					$i++;
			}*/


		}
	}
	return $fbvars ;
}

//then to link, just use $fbvars to add on to the query string of any link



function nombreliga ($liga) {
	return $liga ;
}

function requiererango ($liga, $rango, $usuario) {
	if (!isset($usuario)) {
		global $user_id ;
		$usuario = $user_id ;
	}
	$query = "select rango from " . $liga . "_jugadores where jugador= '" . $usuario . "'" ;
	if ( $datos = mysql_query($query) ) { 
		$datosjug = mysql_fetch_array($datos) ;
		if ( $datosjug['rango'] >= $rango ) { 
			return TRUE ;
		}
		else {
			return FALSE ;
		}
	}
	else {
		return FALSE ;
	}
}

function existeliga ($liga) {
	$query = "select * from ligas where nombre= '" . $liga . "'" ;
	if ( $datos = mysql_query($query) ) {
		if ($datoslig = mysql_fetch_array($datos)) {
			if ( $datoslig[nombre] == $liga) {
				return TRUE ;
			}
			else {
				return FALSE ;
			}
		}
		else {
			return FALSE ;
		}
	}
	else {
		return FALSE ;
	}
}

function invitacion ($usuario,$liga) {
	$query = "select * from invitacion where jugador= '" . $usuario . "'" ;
	if (isset($liga)) {
		$query = $query . " AND liga='" . $liga . "'";
	}
	if ( $datos = mysql_query($query) ) {
		if ( $datosinvi = mysql_fetch_array($datos) ) {
			return TRUE ;	
		}
		else {
			return FALSE ;
		}
	}
	else {
		return FALSE ;
	}	
}

function mostrar_invitacion ($usuario) {
	$query = "select * from invitacion where jugador= '" . $usuario . "'" ;
	$datos = mysql_query($query);
	$a = 0;
	while (	$datosinvi = mysql_fetch_array($datos) ) {
		$retorno[$a] = $datosinvi['liga'] ;
	$a++ ;
	}
	if (isset($retorno)) {
		return $retorno ;
	}
	else {
		return FALSE ;
	}
}

function form_invitacion ($ligas,$action,$div) {
	$retorno = "
		<form action=\"" . $action ."\" method=\"POST\">" . fbvars('form') ;
	$a = 0 ;
	while ($a < sizeof($ligas)) {
		$retorno .= "<p>" . nombreliga($ligas[$a]) . "<input type=\"checkbox\" name=\"liga[]\" value=\"" . $ligas[$a] ."\" /></p>";
	$a++ ;
	}
	$retorno .= "<input type=\"submit\" /></form>";
	if(isset($div)) {
		$retorno = "<div " . $div . " >" . $retorno . "</div>";
	}
	return $retorno ;
}

function form_liga ($action,$div) {
	$retorno = "
		<fb:serverfbml> 
		<script type=\"text/fbml\">   
			<fb:fbml>
				<form name=\"nuevaliga\" id=\"nuevaliga\" action=\"" .  $action . "\" method=\"POST\">		
					Nombre Liga: 
					<input type=\"text\" name=\"nombre\" />
					<fb:captcha showalways=\"true\" />	
					<input type=\"submit\" name=\"Agregar Liga\" value=\"Agregar Liga\"/>	
				</form>
			</fb:fbml> 
		</script> 
		</fb:serverfbml>";
	if(isset($div)) {
		$retorno = "<div " . $div . " >" . $retorno . "</div>";
	}
	return $retorno ;
}

// ----
function new_form_partido ($liga,$action,$style) {
	$retorno .= "
		<form name=\"nuevopartido\" id=\"nuevopartido\" action=\"" . $action . "\" method=\"POST\">
			Empate:<input type=\"checkbox\" name=\"empate\" value=\"empate\" " . $style['inemp'] . "><br>
			Ganadores:
			<input id=\"ganador\" " . $style['ingana'] . "/>
			Goles Ganador: <input type=\"text\" name=\"golesG\" size=\"1\" " . $style['golesgana'] . "><br>
			<div id=\"ganador-result\" " . $style['regana'] . "></div>
			Perdedores		
			<input id=\"perdedor\" " . $style['inperd'] . "/>
			Goles Perdedor:<input type=\"text\" name=\"golesP\" size=\"1\" " . $style['golesperd'] . "><br>
			<div id=\"perdedor-result\" " . $style['reperd'] . "></div>" . fbvars('form') . "
			<input type=\"hidden\" value=\"" . $liga  . "\" name=\"liga\"/>
			<input type=\"submit\" name=\"agregar\" value=\"agregar\" " . $style['submit'] . ">
		</form>
		<img src='icons/accept.png' onload='var jugadores = " . jsusuarios($liga) . " autocomplete_select(\"ganador\",\"ganador-result\",\"ganador\",jugadores); autocomplete_select(\"perdedor\",\"perdedor-result\",\"perdedor\",jugadores)' />" ;
	if(isset($style['div'])) {
		$retorno = "<div " . $style['div'] . " >" . $retorno . "</div>";
	}
	return $retorno ;
}



//---
function form_partido ($liga,$action,$div,$fbml,$ajax) {
	global $facebook, $basepage;
	$friends_get = 	$facebook->api_client->Friends_get() ;
	$retorno .= "
			
				<form name=\"nuevopartido\" id=\"nuevopartido\" action=\"" . $action . "\" method=\"POST\">				
					Empate:<input type=\"checkbox\" name=\"empate\" value=\"empate\"><br>
					Ganadores:
					<fb:multi-friend-input width=\"350px\" border_color=\"#8496ba\" exclude_ids=\"" . amigosdiv($friends_get,miembrosliga($liga)) . "\" include_me=\"TRUE\" name=\"ganador\"/>
					Goles Ganador: <input type=\"text\" name=\"golesG\" size=\"1\"><br>
					Perdedores:
					<fb:multi-friend-input width=\"350px\" border_color=\"#8496ba\" exclude_ids=\"" . amigosdiv($friends_get,miembrosliga($liga)) . "\" include_me=\"TRUE\" name=\"perdedor\"/>
					Goles Perdedor:<input type=\"text\" name=\"golesP\" size=\"1\"><br>
					<input id=\"liga\" type=\"hidden\" fb_protected=\"true\" value=\"" . $liga  . "\" name=\"liga\"/>
					<input type=\"submit\" name=\"agregar\" value=\"agregar\">
				</form>";
	if ($ajax) {
		$retorno .= " <script src=\"" . $basepage . "/js/pes-fbjs.js?v=1.393\"></script>" ;
	}
	if (!$fbml) {
	$retorno = "<fb:serverfbml><script type=\"text/fbml\"><fb:fbml>" . $retorno . "</fb:fbml></script></fb:serverfbml>";
	}
	if(isset($div)) {
		$retorno = "<div " . $div . " >" . $retorno . "</div>";
	}
	return $retorno ;
}



function form_invite ($action,$texto,$liga,$textoliga,$div) {
	$retorno = "
	<fb:serverFbml>
		<script type=\"text/fbml\"> 
			<fb:fbml>
				<fb:request-form 
					action=\"" . $action . "\" 
					method=\"GET\" 
					invite=\"true\" 
					type=\"Liga Pes\"
	                    		content=\"" . $texto ;
	if(isset($textoliga)) {
	$retorno .= " " .$textoliga ;
	}
	$retorno .= "				<fb:req-choice url='http://apps.facebook.com/ligapes" ;
	if (isset($liga)) {
		$retorno .= "/invite_add.php?liga=" . $liga ;
	}
	$retorno .= 				"' label='Unete a Liga Pes' />
					\" 
				> ";
	if(isset($liga)) {
		$retorno .= "<input id=\"liga\" type=\"hidden\" fb_protected=\"true\" value=\"" . $liga . "\" name=\"liga\"/>" ;
	}
	$retorno .= "			<fb:multi-friend-selector condensed=\"true\" width=\"300px\" ";
	if(isset($liga)) {
		$retorno .= " exclude_ids=\"" . implode(",",miembrosliga($liga)) . "\" ";
	}
	$retorno .= "				showborder=\"false\"
						actiontext=\"Invita a tus amigos a unirse a Liga Pes.\"/>
					<fb:request-form-submit />
				</fb:request-form>
			</fb:fbml> 
		</script>
	</fb:serverFbml>";
	if(isset($div)) {
		$retorno = "<div " . $div . " >" . $retorno . "</div>";
	}
	return $retorno ;
}

function ligas_usuario ($usuario) {
	$query = "select * from ligas WHERE jugadores LIKE '%$usuario%'" ;
	if ( $datos = mysql_query($query) ) {
		$a = 0 ;
		while (	$datoslig = mysql_fetch_array($datos) ) {
			$retorno[$a] = $datoslig['nombre'];
			$a++ ;
		}
	}
	if (isset($retorno)) {
		return $retorno ;
	}
	else {
		return FALSE ;
	}
}

function amigosdiv ($amigos,$remover) {
	$retorno .= implode(",",$amigos);
	if (isset($remover)) {
		foreach( $remover as $rem ) {
			$rem .= "," ;
			$retorno = str_replace("$rem","",$retorno) ;
		}
	}
	return $retorno ;
}

function miembrosliga ($liga) {
	$sql = "SELECT * FROM ligas WHERE nombre= '" . $liga . "'" ;
	$datos = mysql_query($sql);
	$datosjug = mysql_fetch_array($datos) ;
	$jugadores = explode("_",$datosjug['jugadores']) ;
	return $jugadores ;
}

function partidos($liga,$muestra,$pag,$usuario) {
	if (!$liga) {
		return NULL;
	}
	if (!isset($pag)) {
		$limit = 0;
	}
	else { 
		$limit = $muestra * $pag;
	}	
	$sqlt = "select * from " . $liga . "_partidos ORDER BY id DESC LIMIT $limit, $muestra";
	if (isset($usuario)) {
		$sqlt .= " WHERE ganador LIKE '%" . $usuario . "%' OR perdedor LIKE '%" . $usuario . "%'" ;
	}
	if ($datosT = mysql_query($sqlt) ) {
		$a = 0;
		while ($partidos = mysql_fetch_array($datosT)){
			$id[$a] =  $partidos['id'] ;
			$fechas[$a] =  $partidos['fecha'] ;
			$empate[$a] = $partidos['empate'] ;
			$ganadores[$a] = $partidos['ganador'] ;
			$golesG[$a] = $partidos['golesG'] ;
			$perdedores[$a] = $partidos['perdedor'] ;
			$golesP[$a] = $partidos['golesP'] ;
			$creador[$a] = $partidos['creador'] ;
			$a++ ;
		}
		$retorno['liga'] = $liga ;
		$retorno['id'] = $id ;
		$retorno['fechas'] = $fechas ;
		$retorno['empate'] = $empate ;
		$retorno['ganadores'] = $ganadores ;
		$retorno['golesG'] = $golesG ;
		$retorno['perdedores'] = $perdedores ;
		$retorno['golesP'] = $golesP ;
		$retorno['creador'] = $creador ;
	}
	else {
		$retorno = FALSE ;
	}
	return $retorno ;
}

function lista_partidos($titulo,$partidos,$divtodo,$divin,$h3,$ul,$li,$fbfecha) {
	global $user_id ;
	$retorno .= "<h3 " . $h3 . "><a href='#'>" . $titulo . "</a></h3>" ;
	if ( isset($partidos) ) {
		$retorno .= "<div " . $divin . " ><ul " . $ul . " >" ;
		$fechas = $partidos['fechas'] ;
		$empates = $partidos['empate'] ;
		$ganadores = $partidos['ganadores'] ;
		$perdedores = $partidos['perdedores'] ;
		$golesG = $partidos['golesG'] ;
		$golesP = $partidos['golesP'] ;
		$creadores = $partidos['creador'] ;
		$a = 0;
		while ($a < sizeof($fechas) ) {
			$ganador = explode("_","$ganadores[$a]");
			$empate = $empates[$a] ;
			$perdedor = explode("_","$perdedores[$a]");
			$golG = $golesG[$a] ;
			$golP = $golesP[$a] ;
			$fecha = $fechas[$a] ;
			$creador = $creadores[$a] ;
			$retorno .= "<li " . $li . " >";
			$g = 0 ;
			while($g < sizeof($ganador) ) {
				if (isset($ganador[$g])) {
					$retorno .= xfbml('name',Array('useyou' => 'false', 'uid' => $ganador[$g]),NULL);
				}
				$g++ ;
				if($g < sizeof($ganador)) {
					$gdos = $g + 1;
					if($gdos < sizeof($ganador)) {
					$retorno .= ", ";
					}
					else {
					$retorno .= " y ";
					}
				}
				else {
					$retorno .= " ";
				}
			}
			if ( sizeof($ganador) > 1 ) {
				$conjugacion = "aron" ;
			}
			else {
				$conjugacion = "&oacute" ;
			}
			if ($empate == 'si') {
				$retorno .= "empat" . $conjugacion . " contra " ;			
			}
			else {
				$retorno .= "gan" . $conjugacion . " contra " ;
			}
			$p = 0 ;

			while($p < sizeof($perdedor) ) {
				if (isset($perdedor[$p])) {
					$retorno .= xfbml('name',Array('useyou' => 'false', 'uid' => $perdedor[$p]),NULL);
				}
				$p++ ;
				if($p < sizeof($perdedor) ) {
					$pdos = $p + 1;
					if($pdos < sizeof($perdedor)) {
					$retorno .= ", ";
					}
					else {
					$retorno .= " y ";
					}
				}
				else {
					$retorno .= " ";
				}
			}
			$retorno .= $golG . " a " . $golP . '<div ' . $fbfecha . '><fb:serverFbml><script type="text/fbml"><fb:fbml><fb:date t="' . $fecha . '"/></fb:fbml></script></fb:serverFbml></div></li>';
			$a++ ;
		}
		$retorno .= "</ul></div>";		
	}
	if ( isset($divtodo)) {
		$retorno = "<div  ". $divtodo . " >" . $retorno . "</div>" ;
		$retorno = str_replace("\$titulo",$titulo,$retorno) ;
	}
	return $retorno ;
}

function lista_partidos_menu($liga,$muestra,$pag,$usuario,$pagina,$div,$ul,$li) {
	if (!$liga) {
		return NULL;
	}
	$sqlt = "select * from " . $liga . "_partidos ORDER BY id DESC ";
	if (isset($usuario)) {
		$sqlt .= " WHERE ganador LIKE '%" . $usuario . "%' OR perdedor LIKE '%" . $usuario . "%'" ;
	}
	$datosT = mysql_query($sqlt) ;
	$cantpartidos = mysql_num_rows($datosT);
	if ($cantpartidos > $muestra ) {
		$pagpartidos = $cantpartidos / $muestra ;
		$apag = 0;
		$bpag = 1;
		$retorno = "<ul " . $ul . ">";
		while ( $pagpartidos > 0 ) {
			$liin = " " . $bpag . " " ;
			if ( $apag != $pag ) {
				$liin = "<a " . $pagina . " >" . $liin . "</a>" ;
			}
			$retorno .= "<li " . $li . ">" . $liin .  "</li>" ;
			$retorno = str_replace("\$pag",$apag,$retorno) ;
			$apag++ ;
			$bpag++ ;
			$pagpartidos--;
		}
		$retorno .= "</ul>" ;
		if (isset($div)) {
			$retorno = "<div" . $div . ">" . $retorno . "</div>" ;
		}
	}
	else {
		$retorno = NULL ;
	}
	return $retorno ;
}
function lista_ligas($muestra,$divfuera,$divtodo,$divin,$h3,$ul,$li,$fbfecha) {
	global $user_id ;
	$ligas = ligas_usuario($user_id) ;
	$a = 0 ;
	while ( $a < sizeof($ligas) ) {
		$partidos = partidos($ligas[$a],$muestra,NULL,NULL) ;
		$retorno .= lista_partidos(nombreliga($ligas[$a]),$partidos,$divtodo,$divin,$h3,$ul,$li,$fbfecha);
		$a++ ;
	}
	if (isset($divfuera)) {
		$retorno = "<div " . $divfuera . " >" . $retorno . "</div>" ;
	}
	return $retorno ;
}

function barra_menu_ligas($div,$a) {
	global $user_id ;
	$ligas = ligas_usuario($user_id) ;
	foreach($ligas as $liga) {
		$retorno .= "<a " . $a . ">" . $liga . "</a>";
		$retorno = str_replace("\$liga",$liga,$retorno) ;

	}
	if (isset($div)) {
		$retorno = "<div " . $div . " >" . $retorno . "</div>";
	}
	return $retorno ;
}

function menu_ligas($divfuera,$divtodo,$divin,$h3,$ah3,$imgh3,$ul,$li,$astyle,$posthtml,$liga) {
	global $user_id;
	if (isset($liga)) {
		$ligas[0] = $liga ;
	}
	else {
		$ligas = ligas_usuario($user_id) ;
	}
	$a = 0 ;
	while ( $a < sizeof($ligas) ) {
		$menuligin = "<ul " . $ul . " >" ;
		$menuligin .= "<li " . $li . " ><a " . $astyle . " href=\"agregarpartidos_form.php?liga=" . $ligas[$a] . "\">Agregar Partidos</a></li>" ;
		$menuligin .= "<li " . $li . " ><a " . $astyle . " href=\"invite_form.php?liga=" . $ligas[$a] . "\">Invitar Jugadores</a></li>" ;
		#$menuligin .= "<li " . $li . " ><a " . $astyle . " href=\"liga_page.php?liga=" . $ligas[$a] . "\">Pagina Liga</a></li>" ;
		$menuligin .= "<li " . $li . " ><a " . $astyle . " href=\"liga_admin.php?liga=" . $ligas[$a] . "\">Administrar</a></li></ul>" ;
		if (isset($posthtml)) {
			$menuligin .= $posthtml ;
		}
		if (isset($divin)) {
			$menuligin = "<div " . $divin . " >" . $menuligin . "</div>";
		}
		if (isset($h3)) {
			$menuligtit = "<h3 " . $h3 . "><a href=\"#\" " . $ah3 . ">" ;
			if (isset($imgh3)) {
				$menuligtit .= "<img " . $imgh3 . ">" ;
			}
			$menuligin = $menuligtit . nombreliga($ligas[$a]) . "</a></h3>" . $menuligin ;
		}
		if (isset($divtodo)) {
			$menuligin = "<div " . $divtodo . " >" . $menuligin . "</div>" ;
		}
		$menulig .= $menuligin ;
		$menulig = str_replace("\$liga",$ligas[$a],$menulig) ;
		$a++ ;
	}
	if (isset($divfuera)) {
		$menulig = "<div " . $divfuera . " >" . $menulig . "</div>";
	}
	return $menulig ;
}

function partidosjug ($liga, $jugador) {
	$sql = "select * from " . $liga . "_partidos where ganador LIKE '%" . $jugador . "%' OR perdedor LIKE '%" . $jugador . "%' ";
	if ($datos = mysql_query($sql) ) {
		$jug = mysql_num_rows($datos) ; 
	}
	return $jug;
}
	
function partidosG ($liga, $jugador, $oponente) {
	$sql = "select * from " . $liga . "_partidos where empate= 'no'" ;
	if ($jugador) {
		$sql .= " AND ganador LIKE '%" . $jugador . "%'" ;
	}
	if ($oponente){
		$sql .=  "AND perdedor LIKE '%" . $oponente . "%' " ;
	}
	if ($datosganados = mysql_query($sql) ) {
		$numganados = mysql_num_rows($datosganados) ; 
	}
	return $numganados;
}

function partidosP ($liga, $jugador, $oponente) { 
	$retorno = partidosG($liga,$oponente,$jugador);
	return $retorno;
}

function partidosE ($liga, $jugador, $oponente) { 
	$sql = "select * from " . $liga . "_partidos where ganador LIKE '%" . $jugador . "%' AND empate= 'si'" ;
	if ($oponente){
		$sql .=  "AND perdedor LIKE '%" . $oponente . "%' " ;
	}
	if ( $datosempate = mysql_query($sql) ) {
		$numempate = mysql_num_rows($datosempate) ; 
	}
	$sql = "select * from " . $liga . "_partidos where perdedor LIKE '%" . $jugador . "%' AND empate= 'si'" ;
	if ($oponente){
		$sql .=  "AND ganador LIKE '%" . $oponente . "%'" ;
	}
	if ( $datosempate = mysql_query($sql) ) {
		$numempate = $numempate + mysql_num_rows($datosempate) ;
	}
	return $numempate;
}

function difgoles ($liga, $jugador, $oponente) {
	$golesjugador = 0;
	$golesoponente = 0;
	$sqlg = "select * from " . $liga . "_partidos where ganador LIKE '%" . $jugador . "%' AND empate= 'no'" ;
	if ( $oponente ) {
		$sqlg .=  " AND perdedor LIKE '%" . $oponente . "%' " ;
	}
	if ($datosganados = mysql_query($sqlg) ) {
		while ( $datosgoles = mysql_fetch_array($datosganados) ) {
			$golesjugador = $golesjugador + $datosgoles[golesG];
			$golesoponente = $golesoponente + $datosgoles[golesP];
			}
	}
	$sqlp = "select * from " . $liga . "_partidos where perdedor LIKE '%" . $jugador . "%' AND empate= 'no'" ;
	if ( $oponente ) {
		$sqlp .= "  AND ganador LIKE '%" . $oponente . "%'";
	}
	if ( $datosperdidos = mysql_query($sqlp) ) {
		while ( $datosgoles = mysql_fetch_array($datosperdidos) ) {
			$golesjugador = $golesjugador + $datosgoles[golesP];
			$golesoponente = $golesoponente + $datosgoles[golesG];
			}
	}
	$difgoles = $golesjugador - $golesoponente; 
	return $difgoles;
}

function tabla_jugador ($jugador,$liga,$divtodo,$tabla,$h3,$ah3,$divin,$ul,$li) {
	global $user_id ;
	if ( requiererango($liga, 1, $jugador) ) {
		$retorno = "<table " . $tabla . "><tr><th>Jugador</th><th>PG</th><th>PE</th><th>PP</th><th>Dif Goles</th></tr>" ;
		$oponentes = miembrosliga($liga) ;
		foreach ($oponentes as $oponente ) {
			if ( $jugador !== $oponente  ) {
				$partg = partidosG($liga, $jugador, $oponente) ;
				$parte = partidosE($liga, $jugador, $oponente) ;
				$partp = partidosP($liga, $jugador, $oponente) ;
				$goles = difgoles($liga, $jugador, $oponente) ;
				$retorno .= "<tr><td>" . xfbml('name',Array('useyou' => 'false', 'uid' => $oponente),NULL) . "</td><td>$partg</td><td>$parte</td><td>$partp</td><td>$goles</td></tr>" ;

			}
		}
		$retorno .= "</table>" ;
		if ( isset($divin)) {
			$retorno = "<div ". $divin . ">" . $retorno . "</div>" ;
		}
		$retorno = "<h3 " . $h3 . "><a " . $ah3 . ">" . xfbml('name',Array('useyou' => 'false', 'uid' => $jugador),NULL) . "</a></h3>" . $retorno ;
		if (isset($divtodo)) {
			$retorno = "<div " . $divtodo . " >" . $retorno . "</div>";
		}
	}
	else {
		$retorno = NULL ;
	}
	return $retorno ;	
}

function tablas_jugadores ($liga,$divfuera,$ultab,$litab,$divtodo,$tabla,$h3,$ah3,$divin,$ul,$li) {
	$jugadores = miembrosliga($liga) ;

	foreach ($jugadores as $jugador ) {
		$adentro = tabla_jugador ($jugador,$liga,$divtodo,$tabla,$h3,$ah3,$divin,$ul,$li) ;
		if ( isset($litab) && $adentro) {
			$adentro = "<li " . $litab . " >" . $adentro . "</li>";
		}
		$retorno .= $adentro;
	}
	if ( isset($ultab)) {
		$retorno = "<ul " . $ultab . " >" . $retorno . "</ul>";
	}
	if ( isset($divfuera)) {
		$retorno = "<div " . $divfuera . " >" . $retorno . "</div>";
	}
	return $retorno ;
}

function jsusuarios ($liga) {
	global $facebook;	
	$jugadores = $facebook->api_client->users_getInfo(miembrosliga($liga),Array('name','pic_square'));
	foreach ($jugadores as $jugador) {
		$retorno .= " { value: \"" . $jugador['uid'] . "\", label: \"" . $jugador['name'] . "\",	icon: \"" . $jugador['pic_square'] . "\" }," ;
	}
	$retorno = " [ " . $retorno . "];" ;
	return $retorno ;
}

function promedio ($liga, $tipo, $jugador) {
	$partidostot = partidosjug ($liga, $jugador) ;
	if ( $partidostot == 0) {
		return 0 ;
	}	
	switch ( $tipo ) {
		case 'gol':
			$retorno = difgoles($liga, $jugador, null) / $partidostot ;
		break;
	
		case 'punto':
			$retorno = partidosG($liga, $jugador, null) * 3 +  partidosE($liga, $jugador, null) ;
			$retorno = $retorno / $partidostot ;
		break;

		default:
		$retorno = 'function promedio: error tipo' . $tipo ;
		break;
	}
	return $retorno;
}
	

function grafico ($titulo,$variables,$color) {
	global $basepage;
	if (! is_array($variables) || ! isset($variables['cantser']) || ! isset($variables['nomser']) || ! isset($variables['nomvar']) ) {
		return "** Grafico: Variables no seteadas **" ;
	}
	$ser = 1;
	while ( $variables['cantser'] >= $ser ) {
		if ( ! isset($variables['ser' . $ser]) ) {
			return "** Grafico: Variables (series) no seteadas **" ;
		}
		$ser++;
	}
	$retorno = "<img src=\"" . $basepage . "/graidle/grafico.php?";
	foreach ($variables as $nvar => $var) {
		if (is_array($var) ) {
			foreach ($var as $innvar => $invar) {
				$retorno .= $nvar . "[]=" . $invar . "&";
			}
		}
		else {
			$retorno .= $nvar . "=" . $var . "&" ;
		}
	}
	$retorno .= "\" />";
	return $retorno ;	
}

function grafico_liga ($liga) {
	global $facebook ;
	$jugadores = miembrosliga($liga);
#	$grafico['cantser'] = sizeof($jugadores);
	$grafico['cantser'] = 2;
#	$grafico['nomvar'] = Array ( 0 => 'Goles', 1 => 'Puntos');
	$grafico['nomser'] = Array ( 0 => 'Goles', 1 => 'Puntos');
	$nomjugadores = $facebook->api_client->users_getInfo(miembrosliga($liga),Array('name'));
	foreach ($nomjugadores as $numnomjug => $nomjugador) {
		$nomjug[] = $nomjugador['name'];
		$grafico['ser1'][] = promedio($liga, 'gol', $jugadores[$numnomjug]);
		$grafico['ser2'][] = promedio($liga, 'punto', $jugadores[$numnomjug]);
	}
#	$grafico['nomser'] = $nomjug ;
	$grafico['nomvar'] = $nomjug ;
/*	$r = 1;
	while ( $grafico['cantser'] >= $r ) {
		$jug = $r - 1;
		$grafico['ser' . $r ] = Array ( 'Goles' => promedio($liga, 'gol', $jugadores[$jug]) , 'Puntos'=> promedio ($liga, 'punto', $jugadores[$jug]) );
		$r++;
	}*/
	return grafico(null, $grafico, null) ;
}

function lista_partidos_borrar($titulo,$partidos,$action,$style) {
	global $user_id ;
	$retorno .= "<h3 " . $style['h3'] . "><a href='#'>" . $titulo . "- Borrar Partidos</a></h3>" ;
	if ( isset($partidos) ) {
		$retorno .= "<div " . $style['divin'] . " ><ul " . $style['ul'] . " >" ;
		$liga = $partidos['liga'];
		$ids = $partidos['id'];
		$fechas = $partidos['fechas'] ;
		$empates = $partidos['empate'] ;
		$ganadores = $partidos['ganadores'] ;
		$perdedores = $partidos['perdedores'] ;
		$golesG = $partidos['golesG'] ;
		$golesP = $partidos['golesP'] ;
		$creadores = $partidos['creador'] ;
		$a = 0;
		while ($a < sizeof($fechas) ) {
			$id = $ids[$a] ;
			$ganador = explode("_","$ganadores[$a]");
			$empate = $empates[$a] ;
			$perdedor = explode("_","$perdedores[$a]");
			$golG = $golesG[$a] ;
			$golP = $golesP[$a] ;
			$fecha = date('\E\l l, d \d\e F \d\e Y \a \l\a\s G:H ',$fechas[$a]) ;
			$creador = $creadores[$a] ;
			$retorno .= "<li " . $style['li'] . " >";
			$g = 0 ;
			while($g < sizeof($ganador) ) {
				if (isset($ganador[$g])) {
					$retorno .= xfbml('name',Array('useyou' => 'false', 'uid' => $ganador[$g]),NULL);
				}
				$g++ ;
				if($g < sizeof($ganador)) {
					$gdos = $g + 1;
					if($gdos < sizeof($ganador)) {
					$retorno .= ", ";
					}
					else {
					$retorno .= " y ";
					}
				}
				else {
					$retorno .= " ";
				}
			}
			if ( sizeof($ganador) > 1 ) {
				$conjugacion = "aron" ;
			}
			else {
				$conjugacion = "&oacute" ;
			}
			if ($empate == 'si') {
				$retorno .= "empat" . $conjugacion . " contra " ;			
			}
			else {
				$retorno .= "gan" . $conjugacion . " contra " ;
			}
			$p = 0 ;

			while($p < sizeof($perdedor) ) {
				if (isset($perdedor[$p])) {
					$retorno .= xfbml('name',Array('useyou' => 'false', 'uid' => $perdedor[$p]),NULL);
				}
				$p++ ;
				if($p < sizeof($perdedor) ) {
					$pdos = $p + 1;
					if($pdos < sizeof($perdedor)) {
					$retorno .= ", ";
					}
					else {
					$retorno .= " y ";
					}
				}
				else {
					$retorno .= " ";
				}
			}
			$retorno .= $golG . " a " . $golP . " <a href=\"" . $action . "?liga=" . $liga . "&partidoid=" . $id . "\"><img src=\"" . $style['can-img'] . "\"></a><div " . $style['fbfecha'] . ">" . $fecha . "</div></li>";
			$a++ ;
		}
		$retorno .= "</ul></div>";		
	}
	if ( isset($style['divtodo'])) {
		$retorno = "<div  ". $style['divtodo'] . " >" . $retorno . "</div>" ;
		$retorno = str_replace("\$titulo",$titulo,$retorno) ;
	}
	return $retorno ;
}


?>
