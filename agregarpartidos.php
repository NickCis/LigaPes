<?php
require_once 'config.php';
require_once 'funciones.php';
require_once 'modules/agregarpartidos.php';
$agregar = agregarpartido() ;
switch ( $agregar ) {
	case 'error_1':
		echo('<div class="fberrorbox">No Estan todas las variables seteadas</div>');
	break;

	case 'error_2':
		echo('<div class="fberrorbox">Hay ganadores iguales</div>');
	break;

	case 'error_3':
		echo('<div class="fberrorbox"> Hay un perdedor igual a un ganador</div>');
	break;

	case 'error_4':
		echo('<div class="fberrorbox">Hay perdedores iguales</div>');
	break;

	case 'error_5':
		echo('<div class="fberrorbox">En empate la cant de goles es distinta</div>');
	break;

	case 'error_6':
		echo('<div class="fberrorbox">En victoria la cant de goles es igual</div>');
	break;

	case 'error_7':
		echo('<div class="fberrorbox">Hay Ganadores que no estan en la liga</div>');
	break;

	case 'error_8':
		echo('<div class="fberrorbox">Hay perdedores que no estan en la liga</div>');
	break;

	case 'error_9':
		echo('<div class="fberrorbox">Goles Perdedor mas altos que ganador</div>');
	break;

	case 'error_10':
		echo('<div class="fberrorbox">Valores de Goles No numericos</div>');
	break;

	case 'succes':
		$ganadores = $_POST['ganador'] ;

		if (is_array($ganadores) ) {
			$ganadores = xfbml_php($ganadores,'name');
			foreach ($ganadores as $ganadornum => $ganador) {
				$gana .= $ganador['name'] ;
				if ( $ganadornum == sizeof($ganadores) - 2 ) {
					$gana .= " y ";
				} else {
					if ( $ganadornum != sizeof($ganadores) - 1 ) {
						$gana .= ", ";
					}
				}				
			}
		}
		$perdedores = $_POST['perdedor'] ;	
		if (is_array($perdedores) ) {
			$perdedores = xfbml_php($perdedores,'name');
			foreach ($perdedores as $$perdedornum => $perdedor) {
				$perd .= $perdedor['name'] ;
				if ( $perdedornum == sizeof($perdedores) - 2 ) {
					$perd .= " y ";
				} else {
					if ( $perdedornum != sizeof($perdedores) - 1 ) {
						$perd .= ", ";
					}
				}				
			}
		}
		$golesG = $_POST['golesG'] ;
		$golesP = $_POST['golesP'] ;

		if ( $golesG == $golesP ) {
			$conjug = 'empat' ;
		} else {
			$conjug = 'gan' ; 
		}
		if (sizeof($ganadores) != 1) {
			$conjug .= 'aron' ;
		} else {
			$conjug .= 'ó';
		}

		$mensaje = "publishstream({ name: 'Partido en LigaPes!', caption: '" . nombreliga($_POST['liga']) . "', description: ('" . $gana . " " . $conjug ." " . $golesG . " a " . $golesP . " contra " . $perd . "'), href: '', media: [{'type': 'image', 'src': 'http://ligapes2009.site90.com/app/pes.jpg', 'href':'http://ligapes2009.site90.com/app/pes.jpg'}] },[{text: 'Crea tu liga', href: '". $basepage . "'}]);";
		echo("<div class=\"fbbluebox\"><img src=\"icons/accept.png\" onload=\"" . $mensaje . "\" /> Partido Cargado Correctamente</div>");
	break;

	default:
	echo($agregar);
	break;
}
?>
