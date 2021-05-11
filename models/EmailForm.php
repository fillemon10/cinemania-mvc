<?php

namespace app\models;


use app\core\Application;
use app\core\db\DbModel;

/**
 * Class EmailForm
 *
 */
class EmailForm extends DbModel
{
    public string $currentEmail = '';
    public string $newEmail = '';
    public string $confirmNewEmail = '';
    public string $user_id = "";



    public function rules()
    {
        return [
            'currentEmail' => [[self::RULE_REQUIRED], self::RULE_EMAIL],
            'newEmail' => [[self::RULE_REQUIRED], self::RULE_EMAIL],
            'confirmNewEmail' => [[self::RULE_MATCH, 'match' => 'newEmail'], self::RULE_EMAIL, self::RULE_REQUIRED],

        ];
    }

    public function labels()
    {
        return [
            'currentEmail' => 'Current Email',
            'newEmail' => 'New Email',
            'confirmNewEmail' => 'Confirm New Email'

        ];
    }
    public static function tableName(): string
    {
        return 'new_email';
    }

    public function attributes(): array
    {
        return ['user_id', 'newEmail', 'currentEmail'];
    }
    public function findEmail()
    {
        $this->user_id = Application::$app->session->get("user");

        $user = User::findOne(['email' => $this->currentEmail, 'id' => $this->user_id]);

        if ($user) {
            $newEmail = User::findOne((["email" => $this->newEmail]));
            if ($newEmail) {
                $this->addError('newEmail', 'This email address is already used on another account');
                return false;
            } else {
                return true;
            }
        } else {
            $this->addError('currentEmail', 'This is not your current email address');
            return false;
        }
    }


    public function sendVerify()
    {
        $this->user_id = Application::$app->session->get("user");

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 50; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $token = $randomString;

        $user = User::findOne(['email' => $this->currentEmail, 'id' => $this->user_id]);

        Application::$app->mail->send($this->newEmail, "Verify your new email with Cinemania", "Hello " . $user->username . "<br><br> Please confirm your new email address by click this link: <br>http://cinemania.sjolander.name/myaccount/verify?t=" . $token . "<br><br>Your old email: ". $this->currentEmail . "<br>Your new email: " . $this->newEmail ." <br><br> Please contact filip@sjolander.name if you believe this is an error.");

        $statement = self::prepare("UPDATE users SET verified=0,verify_token=:token WHERE id=:id");
 
        $statement->bindValue("token", $token);

        $statement->bindValue("id", $this->user_id);

        $statement->execute();
        return parent::save();
    }

}
