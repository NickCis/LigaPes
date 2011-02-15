<?php
require_once 'config.php';
require_once 'funciones.php';
if (!invitacion ($user_id,NULL)) {
	header("location: $basepage") ;		
}
?> 
<div id="respuesta_invitacion"></div>
<p>Has sido invitado a las siguientes ligas</p>
<?php
echo form_invitacion(mostrar_invitacion($user_id), $basepage . "/invite_accept.php\"  onsubmit=\"return submitForm(this, '" . $basepage . "/invite_accept.php', 'respuesta_invitacion') ",NULL) ;
?>
