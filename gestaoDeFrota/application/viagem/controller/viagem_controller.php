<?php

	$tela = explode('_', $_GET['acao']);

	switch ($tela[0]) {
		case 'lista':
			require_once 'application/viagem/view/lista.inc.php';
		break;

		case 'novo':
			require_once 'application/viagem/view/frmCadastro.inc.php';
		break;

		case 'edita':
			require_once 'application/viagem/view/frmEdicao.inc.php';
		break;	
	
		case 'deleta':
		case 'grava':
		case 'update':
		case 'ativar':
		case 'inativar':
		case 'altera':
		case 'excluir':
			require_once 'application/viagem/view/dataControls.inc.php';
		break;
	}
?>