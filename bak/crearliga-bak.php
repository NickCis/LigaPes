<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head></head> 
<body>
<script src="http://static.ak.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"> 
</script> 
<?php
require_once 'config.php';
require_once 'funciones.php';
if(isset($_GET['nombre'])) {
	$nombreL = strtolower(str_replace(" ","_",$_GET['nombre']));
	$existeliga = existeliga($nombreL);
	if(!$existeliga) {
		$fecha = date('d-m-Y') ;
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
			primary key (id), 
			key (jugador,rango) 
		);";
		mysql_query($sqltj);

		$sqltp = "CREATE TABLE " . $nombreL ."_partidos
		(
			id smallint(5) unsigned not null auto_increment, 
			fecha varchar(10) not null,
			ganador varchar(20) not null, 
			perdedor varchar(20) not null, 
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
		
		$pageredir = $basepage . "/invite.php?liga=" . $nombreL ;
		header("location: $pageredir") ;
	}
	else {
	echo "Nombre de liga: " . $nombreL . " ya existe!";
	}	
}
?> 
<p>Hola <fb:name uid="<?php echo $user_id ?>" useyou="false"></fb:name>!</p>
Crear partidos
<form action="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER[PHP_SELF] ;?>" method="get">
Nombre Liga: <input type="text" name="nombre" />
<input type="submit" />
</form>
<a href="<?php echo $basepage ; ?>">Click Aqui para volver al inicio</a>
<script type="text/javascript">  
FB.init("<?php echo $appapikey ?>", "xd_receiver.htm"); 
</script> 
</body>
</html>



