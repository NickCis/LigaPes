<?
require 'config.php' ;
if(!$_COOKIE[uid]) {exit('<p><b>Esta sección es sólo para usuari@s registrad@s.</b>') ; }
if(!$_COOKIE[unick]) {exit('<p><b>Esta sección es sólo para usuari@s registrad@s.</b>') ; }
if(!$_COOKIE[ucontrasena]) {exit('<p><b>Esta sección es sólo para usuari@s registrad@s.</b>') ; }
$datoslogin = mysql_query("select * FROM jugadores WHERE id= $_COOKIE[uid]");
$datoslogin = mysql_fetch_array($datoslogin);
if($_COOKIE[unick] != $datoslogin[jugador]) {exit('<p><b>Esta sección es sólo para usuari@s registrad@s.</b>') ; }
if($_COOKIE[ucontrasena] != $datoslogin[jcontrasena]) {exit('<p><b>Esta sección es sólo para usuari@s registrad@s.</b>') ; }
if($datoslogin[juega] != si) {exit('<p><b>Usuario Baneado</b>') ; }
?>