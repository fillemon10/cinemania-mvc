<?php

namespace app\core;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/**
 * Class Mail
 * skapar mail tjänst
 *
 */
class Mail
{
    public $mail;

    public function __construct($mailConfig)
    {
        $this->mail = new PHPMailer(true);
        //Server settings
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       =  $mailConfig['host'] ?? '';                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = $mailConfig['user'] ?? '';                     //SMTP username
        $this->mail->Password   = $mailConfig['password'] ?? '';                                //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $this->mail->Port       = 587;
        $this->mail->setFrom($mailConfig['user'] ?? '', 'Cinemania');
    }

    public function send($email, $subject, $body)
    {
        $this->mail->addAddress($email);
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;

        try {
            $this->mail->send();
            echo "Message has been sent successfully";
        } catch (Exception $e) {
            echo "Mailer Error: " . $this->mail->ErrorInfo;
        }
    }
}
