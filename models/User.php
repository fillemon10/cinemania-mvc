<?php

namespace app\models;


use app\core\DbModel;
use app\core\UserModel;

/**
 * Class Register
 *
 */
class User extends UserModel
{
    public int $id = 0;
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';
    public string $role = '';
    public string $created_at = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password'];
    }

    public function labels(): array
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'passwordConfirm' => 'Confirm Password'
        ];
    }

    public function rules()
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'passwordConfirm' => [[self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
        public function getRole(): string
    {
        return $this->role;
    }
        public function getCreated(): string
    {
        return $this->created_at;
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        return Application::$app->login($user);
    }
}
