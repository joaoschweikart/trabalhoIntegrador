<?php
	$tela = explode('_', $_GET['acao']);

	switch ($tela[1]) {	
		case 'atividade':
			require_once 'application/relatorio/view/atividade/lista.inc.php';
		break;
	}
?>