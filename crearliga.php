<?php
/* Devolucion:
error: 
	1: Nombre muy largo. Maximo 30 caracteres
	2: Nombre de liga ya existe!
	3: Variables no seteadas
	4: Captcha error (no implementado)
succes: Se creo la liga correctamente.
*/
require_once 'config.php';
require_once 'funciones.php';
$facebook->validate_fb_params() ;

/*echo('<pre></br>');
print_r($_POST);
echo('</pre></br>');
if ($_POST['fb_sig_captcha_grade']!=1) {
	exit("error_4");
}*/

if(isset($_POST['nombre'])) {
	$nombreL = strtolower(str_replace(" ","_",$_POST['nombre']));
	if (strlen($nombreL) > 30 ) {
		exit('error_1');
	}
	$existeliga = existeliga($nombreL);
	if(!$existeliga) {
		if (isset($_POST['fb_sig_time'])) {
			$fecha = $_POST['fb_sig_time'] ;
		}
		else {
			$fecha = date('U') ;
		}
		mysql_query("insert into ligas (nombre,fecha,cantjug,jugadores,creador,estado) values ('$nombreL','$fecha','1','$user_id','$user_id','0')") ;
		$sqltj = "CREATE TABLE " . $nombreL ."_jugadores
		(
			id smallint(5) unsigned not null auto_increment, 
			fecha varchar(10) not null, 
			jugador varchar(20) not null, 
			puntos int(10) unsigned not null, 
			patidos int(10) unsigned not null, 
			gpartidos int(10) unsigned not null, 
			epartidos int(10) unsigned not null, 
			ppartidos int(10) unsigned not null, 
			golesF int(10) unsigned not null, 
			golesE int(10) unsigned not null, 
			rango smallint(1) not null,
			invitador varchar(20) not null,
			primary key (id), 
			key (jugador,rango) 
		);";
		mysql_query($sqltj);

		$sqltp = "CREATE TABLE " . $nombreL ."_partidos
		(
			id smallint(5) unsigned not null auto_increment, 
			fecha varchar(10) not null,
			ganador varchar(50) not null, 
			perdedor varchar(50) not null, 
			golesG int(10) unsigned not null, 
			golesP int(10) unsigned not null,
			empate varchar(2) not null, 
			ip varchar(15) not null,
			creador varchar(20) not null,
			primary key (id), 
			key (ganador,perdedor,empate) 
		);";
		mysql_query($sqltp);

	
		$sqlj = "insert into ". $nombreL ."_jugadores (fecha,jugador,puntos,patidos,gpartidos,epartidos,ppartidos,golesF,golesE,rango) values ('$fecha','$user_id','0','.0','0','0','0','0','0','9')" ;
		mysql_query($sqlj) ;
		
#		$pageredir = $basepage . "/invite_form.php?liga=" . $nombreL ;
#		header("location: $pageredir") ;
		echo('succes');
	}
	else {
	exit('error_2');
	}	
}
else {
	exit("error_3");
}
?> 
