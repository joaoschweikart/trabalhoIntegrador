<?php
    if(!isset($_SESSION) || $_SESSION['gestaoVeiculos_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    $sql = "SELECT vi.via_cod, age.age_cod, age.age_hora_ini, age.age_hora_fim, cid.cid_nome, usu.usu_nome, vei.vei_nome, vei.vei_placa FROM viagem vi
            JOIN agenda age ON vi.age_cod = age.age_cod
            JOIN veiculo vei ON age.vei_cod = vei.vei_cod
            JOIN cidade cid ON age.cid_cod = cid.cid_cod
            JOIN usuario usu ON age.usu_cod = usu.usu_cod
            WHERE vi.via_preenchido = 1";
    $s_preenc = $data->find('dynamic', $sql);

    $sql = "SELECT vi.via_cod, age.age_cod, age.age_hora_ini, age.age_hora_fim, cid.cid_nome, usu.usu_nome, vei.vei_nome, vei.vei_placa FROM viagem vi
            JOIN agenda age ON vi.age_cod = age.age_cod
            JOIN veiculo vei ON age.vei_cod = vei.vei_cod
            JOIN cidade cid ON age.cid_cod = cid.cid_cod
            JOIN usuario usu ON age.usu_cod = usu.usu_cod
            WHERE vi.via_preenchido = 0";
    $n_preenc = $data->find('dynamic', $sql);
    
?>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: "slideDown",
        timeOut: 5000
    };
    <?php
    switch ($_GET[ms]) {
        case 1:
            echo 'toastr.success("Informações da viagem cadastradas com sucesso!", "Sucesso!");';
            break;
    }
    ?>
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-xs-6">
        <h2>Viagem</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Viagens</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">
                        <i class="fa fa-thumbs-o-up"></i>Não-preenchidas (<?php echo count($n_preenc); ?>)</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">
                        <i class="fa fa-thumbs-o-down"></i>Preenchidas (<?php echo count($s_preenc); ?>)</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x: initial;">
                                <br class="hidden-md hidden-lg" />
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Cód. agend.</th>
                                            <th>Data</th>
                                            <th>Município</th>
                                            <th>Funcionário</th>
                                            <th>Veículo</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($n_preenc); $i++) {
                                            echo '
                                                <tr>
                                                    <td>' . $n_preenc[$i]['age_cod'] . '</td>
                                                    <td>' . $n_preenc[$i]['age_hora_ini'] . ' até ' . $n_preenc[$i]['age_hora_fim'] . ' </td>
                                                    <td>' . $n_preenc[$i]['cid_nome'] . '</td>
                                                    <td>' . $n_preenc[$i]['usu_nome'] . '</td>
                                                    <td>' . $n_preenc[$i]['vei_nome'] . ' - ' . $n_preenc[$i]['vei_placa'] . '</td>
                                                    <td>
                                                    <a href="#" onclick="nextPage(\'?module=viagem&acao=novo_viagem\', ' . $n_preenc[$i]['via_cod'] . ')">
                                                        <span class="fa-stack" title="Cadastrar informações da viagem">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                    </a>
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x: initial;">
                                <br class="hidden-md hidden-lg" />
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                        <th>Cód. do agendamento</th>
                                            <th>Data</th>
                                            <th>Município</th>
                                            <th>Funcionário</th>
                                            <th>Veículo</th>
                                            <th>...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            for ($i = 0; $i < count($s_preenc); $i++) {
                                                echo '
                                                    <tr>
                                                        <td>' . $s_preenc[$i]['age_cod'] . '</td>
                                                        <td>' . $s_preenc[$i]['age_hora_ini'] . ' até ' . $s_preenc[$i]['age_hora_fim'] . ' </td>
                                                        <td>' . $s_preenc[$i]['cid_nome'] . '</td>
                                                        <td>' . $s_preenc[$i]['usu_nome'] . '</td>
                                                        <td>' . $s_preenc[$i]['vei_nome'] . ' - ' . $s_preenc[$i]['vei_placa'] . '</td>
                                                        <td>
                                                        <a href="#" onclick="nextPage(\'?module=viagem&acao=edita_viagem\', ' . $s_preenc[$i]['via_cod'] . ')">
                                                            <span class="fa-stack" title="Visualizar informações da viagem">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                        </td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />

    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                "lengthMenu": [
                    [50, 150, 200, -1],
                    [50, 150, 200, "Todos"]
                ],
                "order": [
                    [0, "asc"]
                ]
            });
        });
    </script>