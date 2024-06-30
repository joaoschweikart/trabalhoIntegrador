<?php
    if ($_SESSION['gestaoVeiculos_userPermissao'] != 1 && $_SESSION['gestaoVeiculos_userPermissao'] != 2) {
        echo '<script>window.location="?module=index&acao=logout"</script>';
    }
	
	$sql = "SELECT * FROM agenda as a
			LEFT JOIN veiculo as v ON (a.vei_cod = v.vei_cod)";
	$event = $data->find('dynamic', $sql);
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
			echo 'toastr.success("Agendamento cadastrado com sucesso!", "Incluido!");';
			break;

		case 2:
			echo 'toastr.success("Agendamento atualizado com sucesso", "Atualizado!");';
			break;

		case 3:
			echo 'toastr.success("Agendamento excluido com sucesso", "Excluido!");';
			break;
	}

        for($i=0; $i<count($event); $i++){
            $dados .= '{
                id: '.$event[$i]['age_cod'].',
                title: "'.$event[$i]['age_titulo'].'",
                start: "'.$event[$i]['age_hora_ini'].'",
                end: "'.$event[$i]['age_hora_fim'].'",
                color: "'.$event[$i]['vei_cor'].'",
                usu_cod: "'.$_SESSION['gestaoVeiculos_userId'].'",
				dt_ini: "'.$event[$i]['age_hora_ini'].'",
				dt_fim: "'.$event[$i]['age_hora_fim'].'",
				v_dt_fim: "'.strtotime($event[$i]['age_hora_fim']).'",
				v_hoje: "'.strtotime(date('Y-m-d H:i:s')).'",
				permission: "'.$_SESSION['gestaoVeiculos_userPermissao'].'",
            },';
        }
    ?>
</script>

<div class="row wrapper border-bottom white-bg page-heading" onunload="reload()">
    <div class="col-lg-6">
        <h2>Agendamentos</h2>
    </div>
    <div class="col-lg-6" style="text-align:right;">
        <br />
		<a href="?module=agendamento&acao=novo" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus-sign"></span> Novo
		</a>
    </div>
</div>
<a data-toggle='modal' data-target='#visualiza_agenda' id="abre-popup"></a>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
		<div class="col-lg-2">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Veículos por cor</h5>
				</div>
				<div class="ibox-content">
					<div>
						<?php
						$sql = "SELECT * FROM veiculo";
						$veiculos = $data->find('dynamic', $sql);
						foreach($veiculos as $veiculo){
							echo '<div class="row" style="margin-bottom: 5px;">
								<div class="col-lg-2">
									<div style="background-color:'.$veiculo['vei_cor'].'; width: 20px; height: 20px; border-radius: 50%;"></div>
								</div>
								<div class="col-lg-10">
									'.$veiculo['vei_nome'].'
								</div>
							</div>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
        <div class="col-lg-10">
            <div id="calendar"></div>
        </div>
    </div>
    <br /><br />

	<div class="modal inmodal" id="visualiza_agenda" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
			<div class="modal-content animated bounceInRight">
				<div id="retorno_agenda"></div>
			</div>
		</div>
	</div>

	<script src="library/inspinia/js/plugins/fullcalendar/lang/pt-br.js"></script>
	
    <script>

		function reloadOpener() {
			window.opener.location.reload();
		}
		
        function envia() {
			document.forms['MyForm'].submit();
		}
		
		function editar(id){
			window.location.href= "?module=agendamento&acao=edita_agendamento&id="+id;
		}

		function presta_conta(id){
			window.location.href="?module=contas&acao=novo&id="+id 
		}
		
		function deleta(id, nome) {
			var url = "?module=agendamento&acao=excluir_agendamento";
			bootbox.confirm("Deseja realmente excluir este agendamento?", function(result){
				if(result==true){
					nextPage(url, id);	
				}
			});
		}
		
	$(document).ready(function() {		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			locale: 'pt-br',
			editable: false,
			eventLimit: true,
			events: [
				<?php echo $dados;	?>
			],
			eventRender: function(event, element) {
				if(event.v_dt_fim > event.v_hoje){
					element.data('editable', true);
				}else{
					element.data('editable', false);
				}
			},
			eventClick: function(calEvent, jsEvent, view) {
				var age_data_ini, age_data_fim, selectVeiculo;
				
				//DATA HORA Inicio
				var aux_data = calEvent.dt_ini.split(' ');
				age_data_ini = aux_data[0];
				age_hora_ini = aux_data[1];

				//DATA HORA CHEGADA
				var aux_data = calEvent.dt_fim.split(' ');
				age_data_fim = aux_data[0];
				age_hora_fim = aux_data[1];

				
				url = 'application/script/ajax/visualiza_agenda.php?age_cod='+calEvent.id+'&user='+calEvent.usu_cod+'&permission='+calEvent.permission;
				div = 'retorno_agenda';
				ajax(url, div);

				document.getElementById("abre-popup").click();
			},
			
			eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc) {
				var url = "?module=agendamento&acao=altera_data";

				bootbox.dialog({
					closeButton: false,
					title: "Alteração de data: " + event.title,
					message: '<form class="form-horizontal"> ' +
						'<input type="hidden" id="age_cod" name="age_cod" class="form-control" value="' + event.id + '" /> ' +

							'<div class="row form-group"> ' +
								'<div class="col-md-12" >' +
									'<span>Deseja mesmo alterar a data deste agendamento?</span>' +
								'</div>' +
							'</div>' +

							'<div class="row form-group"> ' +
								'<div class="col-md-6" >' +
									'<label class="control-label" for="age_data_ini">Data Inicial:</label>' +
									'<input type="text" readonly class="form-control" name="age_data_ini" id="age_data_ini" value="' + event.start.format('DD/MM/YYYY HH:mm:ss') + '" /> ' +
								'</div>' +
							
								'<div class="col-md-6" >' +
									'<label class="control-label" for="age_data_fim">Data Final:</label>' +
									'<input type="text" readonly class="form-control" name="age_data_fim" id="age_data_fim" value="' + event.end.format('DD/MM/YYYY HH:mm:ss') + '" /> ' +
								'</div>' +
							'</div>' +
						'</form>',
					buttons: {
						danger: {
							label: "Cancelar",
							className: "btn-default",
							callback: function() {
								nextPage('?module=agendamento&acao=lista', '');
							}
						},
						success: {
							label: "Confirmar",
							className: "btn-success",
							callback: function() {
								var age_cod = $('#age_cod').val();
								var age_data_ini = $('#age_data_ini').val();
								var age_data_fim = $('#age_data_fim').val();
								
								parametro = age_cod + ', ' + age_data_ini+ ', ' +age_data_fim;
								nextPage(url, parametro);
							}
						}
						
					}
				});
			}
		});
	});
    
    </script>