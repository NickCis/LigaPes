<?
#Info Pagina
$basepage = "http://ligapes2009.site90.com/app"; # Link de la pagina donde se suben todos los archivos.

#Info Facebook
require_once 'facebook-platform/php/facebook.php';
$appapikey = 'e30aa3a25f0935fb174a310a4ca4b6e4'; # Apikey de facebook
$appsecret = '********************************'; # Apikey secreto de facebook
$appId = '347389864105'; # AppId de facebook
$facebook = new Facebook($appapikey, $appsecret);
if (!$_POST ) {
	$facebook->require_frame();
}
$user_id = $facebook->require_login();

#Info Base de datos
unset($config) ;
$config[1] = '***********' ; #Host Puede ser "localhost" aunque también una URL o una IP
$config[2] = '***********' ; # Usuario de la base de datos
$config[3] = '***********' ; # Contraseña de la base de datos
$config[4] = '***********' ; # Nombre de la base de datos
$conectar = @mysql_connect($config[1],$config[2],$config[3]) or exit('Datos de conexión incorrectos.') ;
mysql_select_db($config[4],$conectar) or exit('No existe la base de datos.') ;

?>
