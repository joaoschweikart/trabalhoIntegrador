<?php

    $sql = 'SELECT * FROM veiculo WHERE vei_situacao = 1';
    $veiculo = $data->find('dynamic', $sql);
?>

<form role="form" action="application/relatorio/relatorio.php " target="_blank" id="MyForm" method="post" > 
    <input type="hidden" value="<?php echo $_SESSION['gestaoVeiculos_userName']?>" name="usuario"/>
    <input type="hidden" value="<?php echo $_SESSION['gestaoVeiculos_userId']?>" name="userId"/>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10 col-xs-9" >
            <h2><i class="fa fa-bar-chart"></i> Relatórios</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <strong>Solicitações</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2 col-xs-3" >            
            <button type="submit" class="btn btn-primary btn-block" style="position: relative; top: 30px; left: -15px; float: right;">
                <i class="fa fa-print" aria-hidden="true"></i><span class="hidden-xs"> Imprimir</span>
            </button>        
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Formulário de filtro</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row form-group">  
                    <div class="col-sm-6" >     
                        <label class="control-label">Veículo:</label>
                        <select name="vei_cod" id="vei_cod" class="form-control selectpicker" data-live-search="true" data-size="6">
                            <option value="" selected>--SELECIONE--</option>
                            <?php 
                                for ($i=0; $i< count($veiculo); $i++) { 
                                    echo '
                                        <option value="'.$veiculo[$i]['vei_cod'].'">'.$veiculo[$i]['vei_nome'].'</option>
                                    ';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label" for="data_ini">A partir de:</label>
                        <input name="data_ini" type="date" class="form-control blockenter" id="data_ini" style="text-transform:uppercase;" required/>
                    </div>

                    <div class="col-sm-3">
                        <label class="control-label" for="data_fim">Até:</label>
                        <input name="data_fim" type="date" class="form-control blockenter" id="data_fim" style="text-transform:uppercase;" required/>
                    </div>
                </div>
            </div>
</form>
</div> 
