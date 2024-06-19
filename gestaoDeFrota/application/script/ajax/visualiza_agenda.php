<?php

require_once('../../../library/MySql.php'); // Conecta ao BD
require_once('../../../library/DataManipulation.php');
//
$data = new DataManipulation();
//	
if ($_GET['age_cod'] != '') {

	$sql = "SELECT * FROM agenda WHERE age_cod = " . $_GET['age_cod'];
	$result = $data->find('dynamic', $sql);

	$sql = "SELECT usu_nome FROM usuario WHERE usu_cod=".$result[0]['usu_cod'];
	$cliente = $data->find('dynamic', $sql);

	$aux_ini = explode(" ", $result[0]['age_hora_ini']);

	$data_ini = $aux_ini[0];
	$hora_ini = $aux_ini[1];

	$aux_fim = explode(" ", $result[0]['age_hora_fim']);

	$data_fim = $aux_fim[0];
	$hora_fim = $aux_fim[1];

	$sql = "SELECT vei_nome, vei_cod FROM veiculo WHERE vei_situacao = 1";
	$veiculo = $data->find('dynamic', $sql);

	$sql = "SELECT cid_nome, cid_cod FROM cidade WHERE cid_situacao = 1";
	$cidade = $data->find('dynamic', $sql);
}
?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
		<h4 class="modal-title"><?php echo $result[0]['age_titulo'] ?></h4>
	</div>
	<div class="modal-body">
		<form role="form" action="" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">

			<div class="row form-group">

				<div class="col-sm-2">
					<label class="control-label" for="data_ini">Data Início:</label>
					<input name="data_ini" type="date" class="form-control blockenter" value="<?php echo $data_ini ?>" id="data_ini" style="text-transform:uppercase;" disabled />
				</div>

				<div class="col-sm-2">
					<label class="control-label" for="age_hora_ini">Hora Início:</label>
					<input name="age_hora_ini" type="time" class="form-control blockenter" value="<?php echo $hora_ini ?>" id="age_hora_ini" style="text-transform:uppercase;" disabled />
				</div>

				<div class="col-sm-2">
					<label class="control-label" for="data_fim">Data Final:</label>
					<input name="data_ini" type="date" class="form-control blockenter" value="<?php echo $data_fim ?>" id="data_fim" style="text-transform:uppercase;" disabled />
				</div>

				<div class="col-sm-2">
					<label class="control-label" for="age_hora_fim">Hora Fim:</label>
					<input name="age_hora_fim" type="time" class="form-control blockenter" value="<?php echo $hora_fim ?>" id="age_hora_fim" style="text-transform:uppercase;" disabled />
				</div>

				<div class="col-sm-2">
					<label class="control-label" for="data_fim">Veículo:</label>
					<select name="vei_cod" type="text" class="form-control blockenter" id="vei_cod" disabled>
						<option value="" selected>--SELECIONE--</option>
						<?php
							for ($i = 0; $i < count($veiculo); $i++) {
								if ($result[0]['vei_cod'] == $veiculo[$i]['vei_cod']) {
									echo '<option value="' . $veiculo[$i]['vei_cod'] . '" selected>' . $veiculo[$i]['vei_nome'] . '</option>';
								}
							}
						?>
					</select>
				</div>

				<div class="col-sm-2">
					<label class="control-label" for="cid_cod">Cidade:</label>
					<select name="cid_cod" type="text" class="form-control blockenter" id="cid_cod" disabled>
						<option value="" selected>--SELECIONE--</option>
						<?php
							for ($i = 0; $i < count($cidade); $i++) {
								if ($result[0]['cid_cod'] == $cidade[$i]['cid_cod']) {
									echo '<option value="' . $cidade[$i]['cid_cod'] . '" selected>' . $cidade[$i]['cid_nome'] . '</option>';
								}
							}
						?>
					</select>
				</div>

			</div>
			<div class="row form-group">
				<div class="col-sm-8">
					<label for="age_titulo" class="control-label">Título:</label>
					<input name="age_titulo" type="text" class="form-control blockenter" value="<?php echo $result[0]['age_titulo'] ?>" id="age_titulo" style="text-transform: uppercase" disabled>
				</div>
				<div class="col-sm-4">
					<label for="usu_nome" class="control-label">Usuário:</label>
					<input name="usu_nome" type="text" class="form-control blockenter" value="<?php echo $cliente[0]['usu_nome'] ?>" id="age_titulo" style="text-transform: uppercase" disabled>
				</div>
			</div>


			<div class="row form-group">

				<div class="col-sm-12">
					<label for="age_descricao" class="control-label">Descrição:</label>
					<textarea name="age_descricao" type="text" class="form-control blockcenter" id="age_descricao" style="text-transform:uppercase; height: 200px;" disabled><?php echo $result[0]['age_descricao'] ?></textarea>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">

		<?php
			$hoje = strtotime(date('Y-m-d H:i:s'));
			$data_age = strtotime($data_fim);
			
			if($_GET['user'] == $result[0]['usu_cod']){	
				if($hoje < $data_age){
					echo '<button class="btn-success btn" onclick="editar('.$_GET['age_cod'].')"><i class="fa fa-pencil"></i> Editar</button>';
					echo '<button class="btn-danger btn" onclick="deleta('.$_GET['age_cod'] . ', \'' . $result[0]['age_titulo'] . '\''.');"><i class="fa fa-trash"></i> Excluir</button>';
				}
			} else{
				if($_GET['permission'] == 1){
					echo '<button class="btn-success btn" onclick="editar('.$_GET['age_cod'].')"><i class="fa fa-pencil"></i> Editar</button>';
					echo '<button class="btn-danger btn" onclick="deleta('.$_GET['age_cod'] . ', \'' . $result[0]['age_titulo'] . '\''.');"><i class="fa fa-trash"></i> Excluir</button>';
				}
			}
		?>
	</div>
