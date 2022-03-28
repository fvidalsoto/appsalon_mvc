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

    public function enviarConfirmacion()
    {

        /* Crear el objeto de email */

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '94db6a9508e037';
        $mail->Password = 'f04650e6071249';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'APPSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        /* Set HTML attributes */
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre . ". </strong>. Has creado tu cuenta en la APPSalon, solo debes confirmarla en el siguiente enlace</p>";
        $contenido .= "<p> Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
        $contenido .= "<p> Si tu no solicitaste esta cuenta, ignora el mensaje</p>";
        $contenido .= "<html>";
        $mail->Body = $contenido;

        /* Enviar mail */
        $mail->send();
    }
    public function enviarInstrucciones()
    {

        /* Crear el objeto de email */

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '94db6a9508e037';
        $mail->Password = 'f04650e6071249';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'APPSalon.com');
        $mail->Subject = 'Reestablece tu password';

        /* Set HTML attributes */
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre . " </strong>. Has solicitado reestrablecer tu password</p>";
        $contenido .= "<p> Presiona aqui para hacerlo: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer cuenta</a></p>";
        $contenido .= "<p> Si tu no solicitaste esta cuenta, ignora el mensaje</p>";
        $contenido .= "<html>";
        $mail->Body = $contenido;

        /* Enviar mail */
        $mail->send();
    }
}
