<?php

namespace app\models;


use app\core\Application;
use app\core\Model;

/**
 * Class ContactForm
 *
 */
class ContactForm extends Model
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $subject = '';
    public string $message = '';


    public function rules()
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'phone' => [self::RULE_REQUIRED],
            'subject' => [self::RULE_REQUIRED],
            'message' => [self::RULE_REQUIRED],

        ];
    }

    public function labels()
    {
        return [
            'email' => 'Your Email address',
            'name' => 'Your Name',
            'phone' => 'Your Phone number',
            'subject' => 'Subject',
            'message' => 'Type Message'

        ];
    }

    public function sendEmail()
    {
        Application::$app->mail->send("filip.sjolander@gmail.com", 'Contact Cinemania: ' . $this->subject, "Name: " . $this->name . "<br>Email: " . $this->email . "<br>Phone: " . $this->phone . "<br>Subject: " . $this->subject . "<br><br>Message: " . $this->message . "<br><br>Sent: " . date("Y-m-d H:i:s"));
        return true;
    }
}
