<?
if ($_GET[requiere]) {
require 'config.php';
require 'funciones.php';
}

/* Muestra todos los partidos, con lista al final para pasar de paginas, pag (get) = que pagina */
$muestra = 15; /*numero de titulos que muestra por pagina*/
/*Default, muestra titulos*/

if (!isset($_GET[pag])){

$limit = 0;}

Else { $pag = $_GET[pag] - 1;

$limit = $muestra * $pag;}			

$datosT = mysql_query("select * from partidos ORDER BY id DESC LIMIT $limit, $muestra");
$tablamostrar = "<table class='tabla'><tr><th>Fecha</th><th>Ganador</th><th>Goles</th><th>Goles</th><th>Perdedor</th><th>Agregado por</th></tr>";
	while ($noticia = mysql_fetch_array($datosT)){
	$tablamostrar = $tablamostrar . "<tr><td>" . $noticia[fecha] . "</td><td>" . $noticia[ganador] . "</td><td>" . $noticia[golesG] . "</td><td>" . $noticia[golesP] . "</td><td>" . $noticia[perdedor] . "</td><td>" . $noticia[creador] . "</td></tr>";	
	}
$tablamostrar = $tablamostrar . "</table>";
$listamostrar = "<ul><li style='float:left; list-style:none;'><a href='" . $_Server[php_self] . "?pag=1'>1</a></li>";
$listamostrarjs = "<ul><li style='float:left; list-style:none;'><a href='javascript: mostrartabla(1)'>1</a></li>";
$sabersihaymas = mysql_query("select * from partidos");
$num = mysql_num_rows($sabersihaymas);
$division = $num / $muestra; 
$numpag = 2;
$division--;
while ($division > 0 ){
	 $listamostrar = $listamostrar . "<li style='float:left; list-style:none; margin-left: 5px;'><a href='" .  $_Server[php_self] . "?pag=" . $numpag . "'>" . $numpag . "</a></li>";
	 $listamostrarjs = $listamostrarjs . "<li style='float:left; list-style:none; margin-left: 5px;'><a href='javascript: mostrartabla(" . $numpag . ")'>" . $numpag . "</a></li>";
	 $numpag++;
	 $division--; 
}
$listamostrar = $listamostrar . "</ul>";
$listamostrarjs = $listamostrarjs . "</ul>";
if ($_GET[js]) {
echo 'tablajs ="' . $tablamostrar . $listamostrarjs . '";' ;
}
else {
echo $tablamostrar ;
if (!$_GET[lista]) { echo $listamostrar ; } 
}
?>