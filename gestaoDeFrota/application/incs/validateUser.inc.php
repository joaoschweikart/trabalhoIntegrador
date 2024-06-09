<?php
	require_once 'library/DataManipulation.php';
	$data  = new DataManipulation();

	$userConfig['id'] = $_SESSION['gestaoVeiculos_userId'];
	$sql = "SELECT *
			FROM usuario
			WHERE usu_cod = '".$userConfig['id']."'";
	$paramsUsers = $data->find('dynamic',$sql);
?>
