<?php
    if(!isset($_SESSION) || $_SESSION['gestaoVeiculos_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    $sql = "SELECT age.age_hora_ini, cid.cid_nome, usu.usu_nome, vei.vei_nome FROM viagem vi
            JOIN agenda age ON vi.age_cod = age.age_cod
            JOIN veiculo vei ON age.vei_cod = vei.vei_cod
            JOIN cidade cid ON age.cid_cod = cid.cid_cod
            JOIN usuario usu ON age.usu_cod = usu.usu_cod
            WHERE vi.via_cod = ".$_POST['param_0'];
    $result = $data->find('dynamic', $sql);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Viagem</h2>
        <ol class="breadcrumb">
            <li>
                <a href="?module=viagem&acao=lista_cidade">Viagem</a>
            </li>
            <li class="active">
                <strong>Novo</strong>
            </li>
        </ol>
    </div>

    <div class="col-lg-3 col-xs-4" style="text-align:right;">
        <br /><br />
        <button class="btn btn-primary" onclick="$('#MyForm').valid() ? enviar():'';" type="submit"><i class="fa fa-check"></i><span class="hidden-xs hidden-sm"> Salvar</span></button>
        <button class="btn btn-default" onclick="voltar();" type="button"><i class="fa fa-times"></i><span class="hidden-xs hidden-sm"> Cancelar</span></button>
    </div>
</div>
<div id="result_var"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Formulário de Viagem</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">

            <form role="form" action="?module=viagem&acao=grava_viagem" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">

                <div class="row form-group">

                    <input type="hidden" name="via_cod" value="<?php echo $_POST['param_0']?>"/>

                    <div class="col-sm-2">
                        <label class="control-label" >Veículo:</label>
                        <input type="text" class="form-control" disabled readonly value="<?php echo $result[0]['vei_nome'] ?>"/>
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Funcionário:</label>
                        <input type="text" class="form-control" disabled readonly value="<?php echo $result[0]['usu_nome'] ?>"/>
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Data de início:</label>
                        <input type="text" class="form-control" disabled readonly value="<?php echo $result[0]['age_hora_ini'] ?>"/>
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label">Município</label>
                        <input type="text" class="form-control" disabled readonly value="<?php echo $result[0]['cid_nome'] ?>"/>
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label" for="via_km_inicial">KM Inicial do carro:</label>
                        <input name="via_km_inicial" type="text" class="form-control" id="via_km_inicial" required />
                    </div>

                    <div class="col-sm-2">
                        <label class="control-label" for="via_km_final">KM Final do carro:</label>
                        <input name="via_km_final" type="text" class="form-control" id="via_km_final" required />
                    </div>

                </div>

                <div class="row form-group">
                    <div class="col-sm-12">
                        <label class="control-label" for="via_gastos">Gastos da viagem:</label>
                        <textarea name="via_gastos" class="form-control blockenter" id="via_gastos"></textarea>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-sm-12">
                        <label class="control-label" for="via_observacoes">Observações:</label>
                        <textarea name="via_observacoes" class="form-control blockenter" id="via_observacoes"></textarea>
                    </div>
                </div>

            </form>

        </div>
    </div>


<script>
    function enviar() {
        document.forms['MyForm'].submit();
    }

    function voltar() {
        window.location.href = '?module=viagem&acao=lista_viagem';
    }

    $(document).ready(function() {
        $("#MyForm").submit(function(event) {
            document.forms['MyForm'].submit();
        });
    });
</script>