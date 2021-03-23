<?php

namespace app\core;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Class Mail
 * skapar mail tjänst
 *
 */
class Mail
{
    public $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        //From email address and name
        $this->mail->From = "filip@sjolander.name";
        $this->mail->FromName = "Filip Sjölander";
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
