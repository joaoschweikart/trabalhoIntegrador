<?php
require_once('../../library/vendor/autoload.php');
require_once('../../library/MySql.php');
require_once('../../library/DataManipulation.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$data = new DataManipulation();

$logoPath = file_get_contents('../images/logo-system.png');
$logoData = base64_encode($logoPath);
$logoTag = '<img src="data:image/png;base64,' . $logoData . '" width="200"/>';

$dompdf->setPaper('A4', 'landscape');

$usuario = $_POST['usuario'];

$where = '';

if($_POST['vei_cod']){
	$where = " AND v.vei_cod = ".$_POST['vei_cod'];
}

$data_ini = $_POST['data_ini'];	
$data_fim = $_POST['data_fim'];
$data_ini_formatada = date('Y/m/d', strtotime($data_ini)) . ' 00:00:00';
$data_fim_formatada = date('Y/m/d', strtotime($data_fim)) . ' 23:59:59';

$sql = "SELECT
			a.usu_cod,
			a.age_titulo,
			a.age_descricao,
			a.vei_cod,
			a.age_hora_ini,
			a.age_hora_fim,
			v.vei_nome,
			u.usu_nome
		FROM
			agenda a
			JOIN veiculo v ON (v.vei_cod = a.vei_cod)
			JOIN usuario u ON (u.usu_cod = a.usu_cod)
		WHERE
			age_hora_ini >='$data_ini_formatada'
			AND age_hora_fim <= '$data_fim_formatada'".$where;
$agendamento = $data->find('dynamic', $sql);

$html = '

<style>
table {
    font-size: 10px;
}
td {
    padding: 5px;
}
</style>

    <html>
        <head>
			<style>
				.assinatura {
					position: fixed;
					bottom: 0;
					left: 0;
					right: 0;
					text-align: center;
					margin-left: auto;
					margin-right: auto;
				}
			</style>
            <title>Relatatório de agendamentos</title>
        </head>
        <body style="font-family: Arial; font-size: 0.8em">
			<table style="margin-left: auto; margin-right: auto">
				<thead>
					<tr style="text-align: center">
						<th colspan="2" style="text-align: center;">
							' . $logoTag . '<br/>
						</th>
					</tr>
					<tr style="text-align: center">
						<th colspan="2" style="text-align: center; font-size: 1.2em; padding-top: 10px">
							Relatório de Atividades
						</th>
					</tr>
				</thead>
			</table>
			<h4>Emitido em: ' . date('d/m/Y') . ' | Por: ' . $usuario . '</h4>
				<table style="border-collapse: collapse; width: 100%; margin-top: 20px; margin-bottom: 20px;">
					<thead>
						<tr style="border: 1px solid black; padding: 8px; text-align: left;">
							<th>Data</th>
							<th>Veículo</th>
							<th>Funcionário</th>
							<th>Título do agendamento</th>
							<th>Descrição</th>
						</tr>
					</thead>
				<tbody>';
for ($i = 0; $i < count($agendamento); $i++) {
    $html .= '
					<tr>
						<td style="border: 1px solid black; width: 20%">' . $agendamento[$i]['age_hora_ini'] . ' até '.$agendamento[$i]['age_hora_fim'].'</td>
						<td style="border: 1px solid black; width: 10%">' . $agendamento[$i]['vei_nome'] . '</td>
						<td style="border: 1px solid black; width: 20%">' . $agendamento[$i]['usu_nome'] . '</td>
						<td style="border: 1px solid black; width: 10%;">' . $agendamento[$i]['age_titulo'] . '</td>
						<td style="border: 1px solid black; padding: 8px;">' . $agendamento[$i]['age_descricao'].'</td>
					</tr>';
}

$html .= '
</tbody>

</table>';
$dompdf->loadHtml($html);

// Renderiza o documento PDF
$dompdf->render();

// Exibe o documento PDF no navegador
$dompdf->stream('listagem-de-agendamentos.pdf', array('Attachment' => false));
