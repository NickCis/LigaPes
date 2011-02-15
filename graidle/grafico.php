<?php
/*************
Variables requeridas
cantser => [numero] cantidad de series
nomser => [Array] Nombre de series
nomvar => [Array] (numerada desde 0) Nombres de columnas de cada serie
tit => [string] Titulo del grafico
ser1 => [Array] (numerada desde 0) valores de las serie
ser2 => [Array] (numerada desde 0) valores de las serie
serx => [Array] (numerada desde 0) valores de las serie
**************/
require_once("graidle.php");
if ( ! isset($_REQUEST['cantser']) || ! isset($_REQUEST['nomvar']) || ! isset($_REQUEST['nomser']) ) {
	exit('error_1');
}
if ( isset($_REQUEST['tit']) ) {
	$tit = $_REQUEST['tit'];
}
else {
	$tit = ' ';
}
$graidle=new graidle($tit);
$nomvar = $_REQUEST['nomvar'] ;
$z = 0;
while ( $z < sizeof($nomvar)) {
	$nvar = $nomvar[$z];
	$a = 0 ;
	while ( $a <= $_REQUEST['cantser'])
	{	
		$nomser = "ser" . $a ;
		if (is_array($_REQUEST[$nomser]) && isset($_REQUEST[$nomser]) ) {
			$serie = $_REQUEST[$nomser];
			if (isset($$nvar) ) {
				$$nvar = array_merge($$nvar, Array( $a => $serie[$z]));
			}
			else {
				$$nvar = Array( $a => $serie[$z]);
			}

		}
		$a++; 
	}
	$graidle -> setValue($$nvar,'b',$nvar);
	$z++;
}
/*
$a = 1 ;
while ( $a <= $_GET[num] ) {
	$var = "prom" . $a ;
	$b = $a - 1;
	$y0[$b] = $_GET[$var] ;
	$a = $a + 1 ;
	}
$a = 1 ;
while ( $a <= $_GET[num] ) {
	$var = "nom" . $a ;
	$b = $a - 1;
	$vlx[$b] = $_GET[$var] ;
	$a = $a + 1 ;
	}


$graidle -> setValue($y0,'b',$sname,$scolor);*/
# $graidle -> setXValue($vlx);

$graidle -> setXValue($_REQUEST['nomser']);
$graidle -> setBgCl("#fffff0");
$graidle -> setDivision (1);
$graidle -> setSecondaryAxis(1,0);
$graidle -> create();
$graidle -> carry();
?>
