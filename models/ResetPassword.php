<?php

namespace app\models;


use app\core\Application;
use app\core\db\DbModel;

/**
 * Class ResetPassword
 *
 */
class ResetPassword extends DbModel
{
    public string $password = '';
    public string $passwordConfirm = '';
    public string $email = '';
    public int $user_id = 0;



    public function rules()
    {
        return [
            'password' => [[self::RULE_REQUIRED], [self::RULE_MIN, 'min' => 8]],
            'passwordConfirm' => [[self::RULE_MATCH, 'match' => 'password']],

        ];
    }

    public function labels()
    {
        return [
            'password' => 'Password',
            'passwordConfirm' => 'Confirm Password'
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

    public function updatePassword()
    {
        $statement = self::prepare("UPDATE users SET password=:password WHERE id=:id");
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $statement->bindValue("password", $this->password);
        $statement->bindValue("id", $this->user_id);

        $statement->execute();
        
    }

    public function setUsed($email) {
        $statement = self::prepare("UPDATE forgot_password SET used=1 WHERE email=:email");

        $statement->bindValue("email", $email);

        $statement->execute();
    }


}
