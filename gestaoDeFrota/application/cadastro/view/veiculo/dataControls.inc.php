<?php
switch ($_GET['acao']) {

	case 'grava_veiculo':
		$aux['vei_nome']    = addslashes(mb_strtoupper($_POST['vei_nome'], 'UTF-8'));
		$aux['vei_placa']      = addslashes(mb_strtoupper($_POST['vei_placa'], 'UTF-8'));
		$aux['vei_cor']		= $_POST['vei_cor'];

		if (isset($_FILES['vei_img_url']) && $_FILES['vei_img_url']['error'] == UPLOAD_ERR_OK) {
			$uploadDir = 'uploads/'; // Diretório onde o arquivo será salvo
			$uploadFile = $uploadDir . basename($_FILES['vei_img_url']['name']);
	
			if (move_uploaded_file($_FILES['vei_img_url']['tmp_name'], $uploadFile)) {
				$aux['vei_img_url'] = $uploadFile; // Caminho do arquivo salvo
			} else {
				// Lidar com o erro, se o upload falhar
				echo 'Erro ao fazer upload do arquivo.';
				exit;
			}
		} else {
			// Lidar com o caso em que nenhum arquivo foi enviado
			echo 'Nenhum arquivo enviado ou ocorreu um erro no upload.';
			exit;
		}

		$data->tabela = 'veiculo';
		$data->add($aux);

		echo '<script>window.location = "?module=cadastro&acao=lista_veiculo&ms=1";</script>';
	break;


	case 'update_veiculo':
		$aux['vei_cod']		= $_POST['vei_cod'];
		$aux['vei_nome']    = addslashes(mb_strtoupper($_POST['vei_nome'], 'UTF-8'));
		$aux['vei_placa']   = addslashes(mb_strtoupper($_POST['vei_placa'], 'UTF-8'));
		$aux['vei_cor']		= $_POST['vei_cor'];

		if (isset($_FILES['vei_img_url']) && $_FILES['vei_img_url']['error'] == UPLOAD_ERR_OK) {
			$uploadDir = 'uploads/'; // Diretório onde o arquivo será salvo
			$uploadFile = $uploadDir . basename($_FILES['vei_img_url']['name']);
	
			if (move_uploaded_file($_FILES['vei_img_url']['tmp_name'], $uploadFile)) {
				$aux['vei_img_url'] = $uploadFile; // Caminho do arquivo salvo
			} else {
				// Lidar com o erro, se o upload falhar
				echo 'Erro ao fazer upload do arquivo.';
				exit;
			}
		} else {
			// Lidar com o caso em que nenhum arquivo foi enviado
			echo 'Nenhum arquivo enviado ou ocorreu um erro no upload.';
			exit;
		}

		$data->tabela = 'veiculo';
		$data->update($aux);

		echo '<script>window.location = "?module=cadastro&acao=lista_veiculo&ms=2";</script>';
	break;

	case 'inativar_veiculo':
		$sql = 'UPDATE veiculo SET vei_situacao = 0 WHERE vei_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo'<script>window.location = "?module=cadastro&acao=lista_veiculo&ms=5"</script>';
	break;

	case 'ativar_veiculo':
		$sql = 'UPDATE veiculo SET vei_situacao = 1 WHERE vei_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo'<script>window.location = "?module=cadastro&acao=lista_veiculo&ms=5"</script>';
	break;
}
