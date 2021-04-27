<?php

namespace app\models;


use app\core\Application;
use app\core\db\DbModel;

/**
 * Class ForgotPassword
 *
 */
class ForgotPassword extends DbModel
{
    public string $email = '';

    public static function tableName(): string
    {
        return 'forgot_password';
    }

    public function attributes(): array
    {
        return ['email', 'token', 'used'];
    }


    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED],
        ];
    }

    public function labels()
    {
        return [
            'email' => 'Your Email address'
        ];
    }

    public function sendEmail()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 50; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $token = $randomString;
        $this->token = $token;
        Application::$app->mail->send($this->email, "Reset your Cinemania password", "Hello " . $user->username . "<br><br> Reset your password by click this link: <br>http://cinemania.sjolander.name/reset?t=" . $token . "<br><br> Please contact filip@sjolander.name if you believe this is an error.");

        return true;
    }

    public function save()
    {
        return parent::save();
    }
}
