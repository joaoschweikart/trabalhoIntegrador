<?php
switch ($_GET['acao']) {

	case 'grava_viagem':
		$aux['via_cod']         = $_POST['via_cod'];
		$aux['via_km_inicial']  = $_POST['via_km_inicial'];
		$aux['via_km_final']    = $_POST['via_km_final'];
		$aux['via_gastos']      = addslashes(mb_strtoupper($_POST['via_gastos'], 'UTF-8'));
		$aux['via_observacoes'] = addslashes(mb_strtoupper($_POST['via_observacoes'], 'UTF-8'));
		$aux['via_preenchido'] = 1;

		$data->tabela = 'viagem';
		$data->update($aux);

		echo '<script>window.location = "?module=viagem&acao=lista_viagem&ms=1";</script>';
	break;
}
