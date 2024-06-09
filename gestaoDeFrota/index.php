<?php
	session_start();

	function meu_autoloader($nomeClasse) {
		
		// Caso não esteja atualizado um cookie, todos são atualizados com o valor atual da variável de sessão
		if(($_SESSION['gestaoVeiculos_userSession'] != $_COOKIE['gestaoVeiculos_userSession']) 	  ||
		($_SESSION['gestaoVeiculos_userId'] != $_COOKIE['gestaoVeiculos_userId'])	  ||
		($_SESSION['gestaoVeiculos_userName'] != $_COOKIE['gestaoVeiculos_userName']) ||
		($_SESSION['gestaoVeiculos_idSession'] != $_COOKIE['gestaoVeiculos_idSession']) || 
		($_SESSION['gestaoVeiculos_userPermissao'] != $_COOKIE['gestaoVeiculos_userPermissao']) || 
		($_SESSION['gestaoVeiculos_userEmail'] != $_COOKIE['gestaoVeiculos_userEmail'])){
			setcookie('gestaoVeiculos_userSession', $_SESSION['gestaoVeiculos_userSession'], $tempo_cookie);	
			setcookie('gestaoVeiculos_userId', $_SESSION['gestaoVeiculos_userId'], $tempo_cookie);	
			setcookie('gestaoVeiculos_userName', $_SESSION['gestaoVeiculos_userName'], $tempo_cookie);	
			setcookie('gestaoVeiculos_session', $_SESSION['gestaoVeiculos_session'], $tempo_cookie);	
			setcookie('gestaoVeiculos_idSession', $_SESSION['gestaoVeiculos_idSession'], $tempo_cookie);	
			setcookie('gestaoVeiculos_userPermissao', $_SESSION['gestaoVeiculos_userPermissao'], $tempo_cookie);	
			setcookie('gestaoVeiculos_userEmail', $_SESSION['gestaoVeiculos_userEmail'], $tempo_cookie);
			setcookie('gestaoVeiculos_userCliente', $_SESSION['gestaoVeiculos_userCliente'], $tempo_cookie);	
			setcookie('gestaoVeiculos_userFuncionario', $_SESSION['gestaoVeiculos_userFuncionario'], $tempo_cookie);
			setcookie('gestaoVeiculos_userSetor', $_SESSION['gestaoVeiculos_userSetor'], $tempo_cookie);	
		}

		if(!$_SESSION['gestaoVeiculos_userSession']){
		    // Para não perder sessão
		    $_SESSION['gestaoVeiculos_userId']         	= $_COOKIE['gestaoVeiculos_userId'];
			$_SESSION['gestaoVeiculos_userName']       	= $_COOKIE['gestaoVeiculos_userName'];
			$_SESSION['gestaoVeiculos_userSession']   	= $_COOKIE['gestaoVeiculos_userSession'];
			$_SESSION['gestaoVeiculos_userPermissao']  	= $_COOKIE['gestaoVeiculos_userPermissao'];
			$_SESSION['gestaoVeiculos_userEmail']  	   	= $_COOKIE['gestaoVeiculos_userEmail'];
			$_SESSION['gestaoVeiculos_idSession']      	= $_COOKIE['gestaoVeiculos_idSession'];
			$_SESSION['gestaoVeiculos_userCliente'] 		= $_COOKIE['gestaoVeiculos_userCliente'];
			$_SESSION['gestaoVeiculos_userFuncionario'] 	= $_COOKIE['gestaoVeiculos_userFuncionario'];
			$_SESSION['gestaoVeiculos_userSetor'] 		= $_COOKIE['gestaoVeiculos_userSetor'];
		}
		require_once 'library/'.implode('/',explode('_',$nomeClasse)).'.php';
	}

	spl_autoload_register('meu_autoloader');

	try {
	    $factory = new Command_Factory();
	    $factory->createCommand()->execute();
	} catch (Exception_Pagenotfound $ep) {
	    echo '<h1>ERRO 404 - Página não encontrada</h1>';
	} catch (Exception $e) {
	    echo '<h1>ERRO 500 - Erro na execução</h1>';
	}
?>