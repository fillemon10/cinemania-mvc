<?php

namespace app\models;


use app\core\Application;
use app\core\db\DbModel;

/**
 * Class PasswordForm
 *
 */
class PasswordForm extends DbModel
{
    public string $currentPassword = '';
    public string $newPassword = '';
    public string $confirmNewPassword = '';



    public function rules()
    {
        return [
            'currentPassword' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'newPassword' => [[self::RULE_REQUIRED]],
            'confirmNewPassword' => [[self::RULE_MATCH, 'match' => 'newPassword'], self::RULE_REQUIRED],

        ];
    }

    public function labels()
    {
        return [
            'currentPassword' => 'Current Password',
            'newPassword' => 'New Password',
            'confirmNewPassword' => 'Confirm New Password'

        ];
    }
    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['password'];
    }
    public function findPassword()
    {
        $user = User::findOne(['id' => Application::$app->session->get("user")]);
        

        if (!password_verify($this->currentPassword, $user->password)) {
            $this->addError('currentPassword', 'This is not your current password');
            return false;

        } else {
            return true;
        }
    }


    public function updatePassword()
    {
        $statement = self::prepare("UPDATE users SET password=:password, verified=0 WHERE id=:id");

        $this->newPassword = password_hash($this->newPassword, PASSWORD_DEFAULT);

        $statement->bindValue("password", $this->newPassword);
        $statement->bindValue("id", Application::$app->session->get("user"));

        $statement->execute();
    }
}
