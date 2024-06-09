<?php
class Login{	
	var $table;
	
	function validateUser($params, $session){
		if(!isset($_SESSION)){
			session_start();
    	}
		$db = new MySql();
		
		$i = 0;
		foreach($params as $key => $valor){
			if($i == 0){
				$conditions = $key." = '".$valor."'";
				$i++;
			}else{
				$conditions .= " AND ".$key." = '".$valor."'";
			}  
		}
		$sql = "SELECT * FROM ".$this->table." WHERE usu_situacao = 1 AND ".$conditions;
		$result = $db->executeQuery($sql,false);

		if ($db->countLines($result) > 0){
			for ($i=0;$i<$db->countLines($result);$i++){
				$_SESSION['gestaoVeiculos_userId'] 			= $db->result($result, $i,'usu_cod');
				$_SESSION['gestaoVeiculos_userName'] 		= $db->result($result, $i,'usu_nome');	
				$_SESSION['gestaoVeiculos_userEmail'] 		= $db->result($result, $i,'usu_email');									
				$_SESSION['gestaoVeiculos_userPermissao'] 	= $db->result($result, $i,'upe_cod');
				$_SESSION['gestaoVeiculos_userCliente'] 		= $db->result($result, $i,'cli_cod');
				$_SESSION['gestaoVeiculos_userFuncionario']  = $db->result($result, $i,'fun_cod');
				$_SESSION['gestaoVeiculos_userSetor']  		= $db->result($result, $i,'set_cod');
				$_SESSION['gestaoVeiculos_userSession'] 		= $session;

				$retorno['login'] 	 = 'Logado';
				$retorno['nome'] 	 = $db->result($result, $i,'usu_nome');
				$retorno['mensagem'] = "Logado com Sucesso";

				
				// Cria um cookie com o usu�rio
				$tempo_cookie = strtotime("+2 day", time());
				setcookie('gestaoVeiculos_userId', $_SESSION['gestaoVeiculos_userId'], $tempo_cookie, "/");			
				setcookie('gestaoVeiculos_userName', $_SESSION['gestaoVeiculos_userName'], $tempo_cookie, "/");			
				setcookie('gestaoVeiculos_userEmail', $_SESSION['gestaoVeiculos_userEmail'], $tempo_cookie, "/");
				setcookie('gestaoVeiculos_userPermissao', $_SESSION['gestaoVeiculos_userPermissao'], $tempo_cookie, "/");
				setcookie('gestaoVeiculos_userCliente', $_SESSION['gestaoVeiculos_userCliente'], $tempo_cookie, "/");
				setcookie('gestaoVeiculos_userFuncionario', $_SESSION['gestaoVeiculos_userFuncionario'], $tempo_cookie, "/");
				setcookie('gestaoVeiculos_userSetor', $_SESSION['gestaoVeiculos_userSetor'], $tempo_cookie, "/");
				setcookie('gestaoVeiculos_userSession', $_SESSION['gestaoVeiculos_userSession'], $tempo_cookie, "/");				
				setcookie('gestaoVeiculos_idSession', $_SESSION['gestaoVeiculos_idSession'], $tempo_cookie, "/");	
			}
		}else{
			$retorno['login'] 	 = "falha";
			$retorno['mensagem'] = "Senha e/ou login invalido";				
		}
		return $retorno;			
	}

	function logout(){
		unset($_SESSION);
		session_destroy();

	}
	
	function getLogin(){
		if ((isset($_SESSION['gestaoVeiculos_idSession']))&&($_SESSION['gestaoVeiculos_idSession'] == $_SESSION['gestaoVeiculos_userSession'])){
			$retorno['logged'] = "yes";
		}else{
			$retorno['logged'] = "no";
		}
		return $retorno;			
	}	
}

?>