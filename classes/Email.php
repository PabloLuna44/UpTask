<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{


    public $email;
    public $nombre;
    public $token;


    public function __construct($email, $nombre, $token)
    {

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function SendConfirmation()
    {

        //Crear el objeto de email
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];


        $mail->setFrom('accounts@uptask.com');
        $mail->addAddress('accounts@uptask.com', 'Uptask.com');
        $mail->Subject = 'Confirmar tu cuenta';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';


        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> haz creado tu cuenta en App salon solo debes confirmarla presionanado el siguiente enlace</p>";
        $contenido .= "<p>Presiona Aqui:<a href='".$_ENV['APP_URL']."/verify?token=" . $this->token . "'>Confirma Tu Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta puedes ignarar este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        $mail->AltBody = 'Texto alternativo';


        //Enviar Email

        $mail->send();
    }


    public function recoverPassword()
    {


        //Crear el objeto de email
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];


        $mail->setFrom('accounts@uptask.com');
        $mail->addAddress('accounts@uptask.com', 'Uptask.com');
        $mail->Subject = 'Restablecer Password';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';


        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> haz solicitado la recuperacion de tu Password</p>";
        $contenido .= "<p>Presiona el siguiente enlace para recuperar tu password:<a href='".$_ENV['APP_URL']."/recover?token=" . $this->token . "'>Restablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste recuperar tu password puedes ignarar este mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        $mail->AltBody = 'Texto alternativo';


        //Enviar Email

        $mail->send();
    }
}