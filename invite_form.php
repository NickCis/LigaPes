<?php
require_once 'config.php';
require_once 'funciones.php';
if(isset($_GET['liga'])) { 
	if (! requiererango($_GET['liga'], '3', NULL)) {
		exit("Rango no suficiente");
	}
	$liga = $_GET['liga'];
}
else {
	$liga = NULL ;
}
?>
<?php 
$texto = "Crea ligas de Pro Evolution Soccer y compartelas con tus amigos!";
$textoliga = "Unete a la liga: " . $liga ;
echo form_invite($basepage . "/invite.php", $texto, $liga, $textoliga, NULL);
?>
