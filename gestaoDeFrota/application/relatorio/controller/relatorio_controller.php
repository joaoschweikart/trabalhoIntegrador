<?php
	$tela = explode('_', $_GET['acao']);

	switch ($tela[1]) {	

		case 'agendamento':
			require_once 'application/relatorio/view/lista.inc.php';
		break;
	}
?>