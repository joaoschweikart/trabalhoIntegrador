<?php
	class IndexCommand implements Command {
   
		public function execute() {
			if($_GET['acao'] == 'logout'){
				require_once 'application/index/logout.inc.php';
			}		

			$randon = md5(uniqid(time()));
			$_SESSION['gestaoVeiculos_idSession'] = $randon;
			
			$online = 0;			
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Veículos</title>
    <link rel="icon" type="image/png" href="application/images/icon.png">
    <link href="library/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="library/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="library/inspinia/css/animate.css" rel="stylesheet">
    <link href="library/inspinia/css/style.css" rel="stylesheet">
    <script src="library/inspinia/js/jquery-2.1.1.js"></script>
    <script src="library/inspinia/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #004aad;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #f0f0f0;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }

        .login-container img {
            width: 250px;
            margin-bottom: 20px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #004aad;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="application/images/logo-system.png">
        <form role="form" action="?module=index&action=valida_senha" method="POST">
            <input type="hidden" name="gestaoVeiculos_idSession" value="<?php echo $randon;?>" />
            <input type="text" name="usuario" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Enviar</button>
            <?php if($_GET['erro']){ ?>
                <p style="position:relative; color:#F00; margin-top: 10px;">Usuário ou senha inválidos</p>
            <?php } ?>
        </form>
    </div>
</body>

</html>
		
<?php
		}
	}
?>