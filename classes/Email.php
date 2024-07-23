<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
     
         $mail->setFrom('ca.sevilla@rfaf.es');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

        $contenido = '<html><body>'; // Abre el cuerpo del HTML
        $contenido .= "<p>¡Hola<strong> " . $this->nombre .  "</strong>!<br><br>Se ha registrado tu cuenta en CA-Delegación Sevilla. Ahora, es necesario confirmarla</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";         
        $contenido .= "<p>Si no esperas que se creara una cuenta aquí, puedes ignorar este mensaje.</p>";
        $contenido .= "<p>Un saludo,</p>";
        $contenido .= "<p>CA - Delegación de Sevilla</p>";
        $contenido .= '</body></html>'; // Cierra el cuerpo y el HTML
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();

    }

    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        // $mail->Password = $_ENV['EMAIL_PASS'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('ca.sevilla@rfaf.es');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'REESTABLECER CONTRASEÑA';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html><body>'; // Abre el cuerpo del HTML
        $contenido .= "<p>¡Hola<strong> " . $this->nombre .  "</strong>!<br><br>Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar este mensaje.</p>";
        $contenido .= "<p>Un saludo,</p>";
        $contenido .= "<p>CA - Delegación de Sevilla</p>";
        $contenido .= '</body></html>'; // Cierra el cuerpo y el HTML
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}