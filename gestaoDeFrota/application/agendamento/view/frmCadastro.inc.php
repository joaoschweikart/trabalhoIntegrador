<?php
    if ($_SESSION['gestaoVeiculos_userPermissao'] != 1 && ($_SESSION['gestaoVeiculos_userPermissao']) != 2) {
        echo '<script>window.location="?module=index&acao=logout"</script>';
        exit();
    }

    $sql = "SELECT vei_nome, vei_cod FROM veiculo WHERE vei_situacao = 1";
    $veiculo = $data->find('dynamic', $sql);

    $sql = "SELECT cid_nome, cid_cod FROM cidade WHERE cid_situacao = 1";
    $cidade = $data->find('dynamic', $sql);
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
                echo 'toastr.info("O veículo selecionado não estará disponível para a data selecionada", "Veículo indisponível!");';
                break;
        }
    ?>
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Agendamentos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="?module=agendamento&acao=lista">Veículos</a>
            </li>
            <li class="active">
                <strong>Novo agendamento de veículos</strong>
            </li>
        </ol>
    </div>

    <div class="col-lg-3 col-xs-4" style="text-align:right;">
        <br /><br />
        <button class="btn btn-primary" id="btn-envio" onclick="$('#MyForm').valid() ? enviar():'';" type="submit"><i class="fa fa-check"></i><span class="hidden-xs hidden-sm"> Salvar</span></button>
        <button class="btn btn-default" onclick="voltar();" type="button"><i class="fa fa-times"></i><span class="hidden-xs hidden-sm"> Cancelar</span></button>
    </div>
</div>
<div id="result_var"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Agendamento do veículo</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">

            <form role="form" action="?module=agendamento&acao=grava" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">

                <div class="row form-group">

                    <div class="col-sm-2">
                        <label class="control-label" for="data_ini">Data Início:</label>
                        <input name="data_ini" type="date" class="form-control blockenter" id="data_ini" style="text-transform:uppercase;" min="<?php echo date('Y-m-d', strtotime('-1 day')); ?>" onchange="dataMin(this.value)" required />
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label" for="age_hora_ini">Hora Início:</label>
                        <input name="age_hora_ini" type="time" class="form-control blockenter" id="age_hora_ini" style="text-transform:uppercase;" required />
                    </div>
                    
                    <div class="col-sm-2">
                        <label class="control-label" for="data_fim">Data Final:</label>
                        <input name="data_fim" type="date" class="form-control blockenter" id="data_fim" style="text-transform:uppercase;" min="" required />
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label" for="age_hora_fim">Hora Fim:</label>
                        <input name="age_hora_fim" type="time" class="form-control blockenter" id="age_hora_fim" style="text-transform:uppercase;" required />
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label" for="data_fim">Veículo:</label>
                        <select name="vei_cod" type="text" class="form-control blockenter" id="vei_cod" required>
                            <option value="" selected>--SELECIONE--</option>
                            <?php
                                for ($i = 0; $i < count($veiculo); $i++) {
                                    echo '<option value="' . $veiculo[$i]['vei_cod'] . '">' . $veiculo[$i]['vei_nome'] . '</option>';
                                }    
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label" for="cid_cod">Cidade:</label>
                        <select name="cid_cod" type="text" class="form-control blockenter" id="cid_cod" required>
                            <option value="" selected>--SELECIONE--</option>
                            <?php
                                for ($i = 0; $i < count($cidade); $i++) {
                                    echo '<option value="' . $cidade[$i]['cid_cod'] . '">' . $cidade[$i]['cid_nome'] . '</option>';
                                }    
                            ?>
                        </select>
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <label for="age_titulo" class="control-label">Título:</label>
                        <input name="age_titulo" type="text" class="form-control blockenter" id="age_titulo" style="text-transform: uppercase" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <label for="age_descricao" class="control-label">Descrição:</label>
                        <textarea name="age_descricao" type="text" class="form-control blockcenter" id="age_descricao" style="text-transform:uppercase; height: 200px;" required></textarea>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>

        function block_envio(val) {
            var botao = document.getElementById('btn-envio');
            if (val == "1") {
                botao.setAttribute('disabled', 'true');
            } else {
                botao.removeAttribute('disabled');
            }
        }

        function dataMin(data_ini) {
            var data_fim = document.getElementById('data_fim');
            data_fim.setAttribute("min", data_ini);
        }

        function enviar() {
            document.forms['MyForm'].submit();
        }

        function voltar() {
            window.location.href = '?module=agendamento&acao=lista';
        }

        $(document).ready(function() {
            $("#MyForm").validate({
                rules: {
                    cli_nome: {
                        required: true,
                        minlength: 3
                    },
                    cid_codigo: {
                        required: true
                    }
                }
            });
            $('#datetimepicker1').datetimepicker();
            $("#MyForm").submit(function(event) {
                document.forms['MyForm'].submit();
            });
        });
    </script>