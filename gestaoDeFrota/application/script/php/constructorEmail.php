<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require('library/phpmailer/src/PHPMailer.php');
    require('library/phpmailer/src/SMTP.php');
    require('library/phpmailer/src/Exception.php');

		$mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;               
      $mail->Username   = 'joaobernardonschweikart@gmail.com'; 
      $mail->Password   = 'T8Lq.CjP8j@!2';             
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      
      $mail->Port       = 465; 
      $mail->CharSet = 'UTF-8';

      //Recipients
      $mail->setFrom('joaobernardonschweikart@gmail.com', 'SISTEMA DE GESTÃO DE VEÍCULOS');
        
?>