<?php
	switch($_GET['acao']){ 
		
        case 'grava':

			$periodo_ini = $_POST['data_ini'] . ' ' . $_POST['age_hora_ini'].':00';
			$periodo_fin = $_POST['data_fim'] . ' ' . $_POST['age_hora_fim'].':00';

			$sql = "SELECT vei_cod FROM agenda WHERE age_hora_ini BETWEEN '".$periodo_ini."' AND '".$periodo_fin."' OR
					age_hora_fim BETWEEN '".$periodo_ini."' AND '".$periodo_fin."' AND vei_cod = ".$_POST['vei_cod'];
			$conflito = $data->find('dynamic',$sql);
			
			if(count($conflito) > 0){ // conflito na data
				echo '<script>window.location = "?module=agendamento&acao=novo&ms=1";</script>';
				break;
			}

			$data_ini = $_POST['data_ini'];
			$age_hora_ini = $_POST['age_hora_ini'];
			$aux['age_hora_ini'] = date('Y-m-d H:i:s', strtotime("$data_ini $age_hora_ini"));

			$data_fim = $_POST['data_fim'];
			$age_hora_fim = $_POST['age_hora_fim'];
			$aux['age_hora_fim'] = date('Y-m-d H:i:s', strtotime("$data_fim $age_hora_fim"));

			$aux['usu_cod']    			= $_SESSION['gestaoVeiculos_userId'];
			$aux['age_titulo']    		= addslashes(mb_strtoupper($_POST['age_titulo'], 'UTF-8'));
			$aux['age_descricao']		= addslashes(mb_strtoupper($_POST['age_descricao'], 'UTF-8'));
			$aux['vei_cod']				= $_POST['vei_cod'];
			$aux['cid_cod']				= $_POST['cid_cod'];

			$data->tabela = 'agenda';
			$data->add($aux);

			$data->tabela = 'viagem';
			
			$sql = 'SELECT MAX(age_cod) as age_cod FROM agenda';
			$result = $data->find('dynamic', $sql);

			$aux2['age_cod'] = $result[0]['age_cod'];
			$aux2['via_preenchido'] = 0;
			$data->add($aux2);

			echo '<script>window.location = "?module=agendamento&acao=lista&ms=1";</script>';
			break;

		case 'altera_data':	
			$aux['age_cod']			= $_POST['param_0'];
			$dt = explode(" ",trim($_POST['param_1']));
			$aux['age_hora_ini'] 	= implode("-", array_reverse(explode("/", $dt[0]))).' '.$dt[1];
			$dt = explode(" ",trim($_POST['param_2']));
			$aux['age_hora_fim']	= implode("-", array_reverse(explode("/", $dt[0]))).' '.$dt[1];
			
			$data->tabela = 'agenda';
			$data->update($aux);

			echo '<script>window.location = "?module=agendamento&acao=lista&ms=2";</script>';
		break;
		
		case 'excluir_agendamento':

			$sql='DELETE FROM viagem WHERE age_cod = '.$_POST['param_0'];
			$data->executaSQL($sql);

			$sql='DELETE FROM agenda WHERE age_cod = '.$_POST['param_0'];
			$data->executaSQL($sql);
			
			echo '<script>window.location = "?module=agendamento&acao=lista&ms=3";</script>';
			break;
		
		case 'update_agendamento':
			$aux['age_cod'] = $_POST['age_cod'];

			$data_ini = $_POST['data_ini'];
			$age_hora_ini = $_POST['age_hora_ini'];
			$aux['age_hora_ini'] = date('Y-m-d H:i:s', strtotime("$data_ini $age_hora_ini"));

			$data_fim = $_POST['data_fim'];
			$age_hora_fim = $_POST['age_hora_fim'];
			$aux['age_hora_fim'] = date('Y-m-d H:i:s', strtotime("$data_fim $age_hora_fim"));
			
			$aux['age_titulo']    		= addslashes(mb_strtoupper($_POST['age_titulo'], 'UTF-8'));
			$aux['age_descricao']		= addslashes(mb_strtoupper($_POST['age_descricao'], 'UTF-8'));
			$aux['vei_cod']				= $_POST['vei_cod'];
			$aux['cid_cod']				= $_POST['cid_cod'];

			$data->tabela = 'agenda';
			$data->update($aux);

			echo '<script>window.location = "?module=agendamento&acao=lista&ms=2"</script>';
    }