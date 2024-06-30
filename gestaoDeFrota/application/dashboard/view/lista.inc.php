<?php
    date_default_timezone_set('America/Sao_Paulo');

    $sql = "SELECT count(age_cod) as qtd FROM agenda WHERE age_hora_ini >= '".date('Y-m-01')."' AND age_hora_fim <= '".date('Y-m-t')."'";
    $total = $data->find('dynamic', $sql);

    $sql = "SELECT count(vei_cod) as qtd FROM veiculo WHERE vei_situacao = 1";
    $qtdVeiculo = $data->find('dynamic', $sql);

    $sql = "SELECT count(usu_cod) as qtd FROM usuario WHERE usu_situacao = 1";
    $qtdUsuarios = $data->find('dynamic', $sql);

    $sql = "SELECT
                v.vei_cod,
                COUNT(a.age_cod) as qtd_agendamentos
            FROM veiculo v
                LEFT JOIN agenda a ON v.vei_cod = a.vei_cod
                GROUP BY v.vei_cod
            ORDER BY qtd_agendamentos DESC;";
    $agendamentoPorVeiculo = $data->find('dynamic', $sql);    

    $sql = "SELECT * FROM veiculo WHERE vei_situacao = 1";
    $veiculos= $data->find('dynamic', $sql);

    $dataPoints = [];
    for($i = 0; $i < 4; $i++){
        $vei_cod = $veiculos[$i]['vei_cod'];
        $vei_nome = $veiculos[$i]['vei_nome'];
        $qtd_agendamentos = 0;

        foreach ($agendamentoPorVeiculo as $agendamento) {
            if ($agendamento['vei_cod'] == $vei_cod) {
                $qtd_agendamentos = $agendamento['qtd_agendamentos'];
                break;
            }
        }
        $percentagem = ($total[0]['qtd'] > 0) ? ($qtd_agendamentos / $total[0]['qtd']) * 100 : 0;
        $percentagem = number_format($percentagem, 2, '.', '');
        $dataPoints[] = [
            'label' => $vei_nome,
            'value' => $percentagem
        ];
    }
    $dataJSON = json_encode($dataPoints);

    switch ($_SESSION['gestaoVeiculos_userPermissao']) {
        case 1: 
            $nivel = "Administrador";
        break;
        case 2: 
            $nivel = "Funcionário"; 
        break;
    }
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-9">
        <h2>DriveGuard - <?php echo $nivel?></h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Início</strong>
                <div class="m-t-sm small">
                    Atualizado em <?php echo implode("/", array_reverse(explode("-", date('Y-m-d'))))." ".date('H:i:s')?>
                </div>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Agendamentos por Veículo</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="graficoVeiculos"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <a href="?module=cadastro&acao=lista_veiculo" style="padding: 5px; background-color: #17e636; border-radius: 5px; color: #fff">Veículos cadastrados</a>
                        </div>
                        <div class="ibox-content">
                            <h3 class="no-margins"><?php echo $qtdVeiculo[0]['qtd']; ?> veículos</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <a href="?module=agendamento&acao=lista" style="padding: 5px; background-color: #e39c02; border-radius: 5px; color: #fff">Total de agendamentos no mês</a>
                        </div>
                        <div class="ibox-content">
                            <h3 class="no-margins"><?php echo $total[0]['qtd']; ?> agendamentos neste mês</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <a href="?module=cadastro&acao=lista_usuario" style="padding: 5px; background-color: #0448AD; border-radius: 5px; color: #fff">Usuários cadastrados</a>
                        </div>
                        <div class="ibox-content">
                            <h3 class="no-margins"><?php echo $qtdUsuarios[0]['qtd']; ?> usuários</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2>Veículos mais utilizados</h2>
    <span>Veículos mais utilizados demandam de mais manutenção preventiva</span><br /><br />

    <div class="row">
        <div class="col-sm-12">
            <?php
                for($i = 0; $i < 4; $i++){
                    echo '
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>' . $veiculos[$i]["vei_nome"] . '<br>' . $agendamentoPorVeiculo[$i]['qtd_agendamentos'] . ' agendamentos</h5>
                            </div>
                            <div class="ibox-content">
                                <div style="position: relative; width: 100%; max-width: 300px; padding-bottom: 150px; background-color: #f0f0f0; overflow: hidden; margin: auto;">
                                    <img src="' . $veiculos[$i]['vei_img_url'] . '" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" />
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            ?>
        </div>
    </div>

<script>
    let dynamicData = <?php echo $dataJSON; ?>;
    
    document.addEventListener("DOMContentLoaded", function() {
        let ctx = document.getElementById('graficoVeiculos').getContext('2d');
        let meuGrafico = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: dynamicData.map(function(item) {
                    return item.label;
                }),
                datasets: [{
                    data: dynamicData.map(function(item) {
                        return item.value;
                    }),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#014A14'],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Porcentagem de Agendamentos por Veículo'
                }
            }
        });
    });
</script>