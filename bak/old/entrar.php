<?
require 'config.php' ;
function quitar($texto) {
	$texto = trim($texto) ;
	$texto = htmlspecialchars($texto) ;
	$texto = str_replace(chr(160),'',$texto) ;
	return $texto ;
}

if($_GET[js] && $_GET[nick] && $_GET[pass]) {
	$nick = quitar($_GET[nick]) ;
	$contrasena = md5(md5(quitar($_GET[pass]))) ;
	$con = mysql_query("select id,contrasena from jugadores where jugador='$nick'") ;
	$datos = mysql_fetch_assoc($con) ;
	if(mysql_num_rows($con)) {
		if($datos[contrasena] == $contrasena) {
			echo 'estado ="si"';
			$fecha = date('d-m-Y') ;
			mysql_query("insert into ip_jugadores (fecha,jugador,ip) values ('$fecha','$nick','$_SERVER[REMOTE_ADDR]')") ;
			setcookie('uid',$datos[id],time()+604800) ;
			setcookie('unick',$nick,time()+604800) ;
			setcookie('ucontrasena',$contrasena,time()+604800) ;
		}
		else {
			echo 'estado ="pass"' ;
		}
	}
	else {
		echo 'estado ="usuario"' ;
	}
}

if($_POST[nickname]) {
	$nick = quitar($_POST[nickname]) ;
	$contrasena = md5(md5(quitar($_POST[password]))) ;
	$con = mysql_query("select id,contrasena from jugadores where jugador='$nick'") ;
	$datos = mysql_fetch_assoc($con) ;
	if(mysql_num_rows($con)) {
		if($datos[contrasena] == $contrasena) {
			$fecha = date('d-m-Y') ;
			mysql_query("insert into ip_jugadores (fecha,jugador,ip) values ('$fecha','$nick','$_SERVER[REMOTE_ADDR]')") ;
			setcookie('uid',$datos[id],time()+604800) ;
			setcookie('unick',$nick,time()+604800) ;
			setcookie('ucontrasena',$contrasena,time()+604800) ;
			header("location: $_SERVER[HTTP_REFERER]") ;
		}
		else {
			echo 'La contraseña es incorrecta. Haz click <a href="javascript:history.back(-1)">aquí</a> para regresar.' ;
		}
	}
	else {
		echo 'El nick no existe. Haz click <a href="javascript:history.back(-1)">aquí</a> para regresar.' ;
	}
}
else{
if($_GET[js] && $_GET[nick] && $_GET[pass]) { }
else{ echo "asdasd"; }
}
?>