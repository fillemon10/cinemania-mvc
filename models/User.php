<?php

namespace app\models;


use app\core\DbModel;
use app\core\UserModel;
use app\core\Application;

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
    public string $verified = '';
    public string $verify_token = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password', 'verify_token'];
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
            'username' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 10]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'passwordConfirm' => [[self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function sendVerify()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 50; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $token = $randomString;
        $this->verify_token = $token;
        Application::$app->mail->send($this->email, "Verify your account with Cinemania", "Hello " . $this->username . "<br><br> Please confirm your email address by click this link: <br>http://cinemania.sjolander.name/register/verify?t=" . $token . "<br><br> Please contact filip@sjolander.name if you believe this is an error.");
        return true;
    }
    public function verify($token)
    {
        $statement = self::prepare("UPDATE users SET verified=1 WHERE verify_token=:token");

        $statement->bindValue("token", $token);

        $statement->execute();
    }

    public function updateEmail($email)
    {
        $statement = self::prepare("UPDATE users SET email=:email WHERE id=:id");

        $statement->bindValue("email", $email->newEmail);
        $statement->bindValue("id", $email->user_id);   

        $statement->execute();
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
    public function getVerified(): string
    {
        return $this->verified;
    }
    public function getVerifyToken(): string
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
    public static function getBadge($role){
        if ($role == "Admin") {
            return "<i class=\"fas fa-user-tie red\" title=\"Admin\"></i>";
        } else if ($role == "Author") {
            return "<i class=\"fas fa-user-edit text-info\" title=\"Author\"></i>";
        } else if ($role == "Moderator") {
            return "<i class=\"fas fa-user-cog text-success\" title=\"Moderator\"></i>";
        } else if ($role == "Premium") {
            return "<i class=\"fas fa-user premium-color\" title=\"Premium\"></i>";
        } else if ($role == "Premium+") {
            return "<i class=\"fas fa-user-plus premium-plus-color\" title=\"Premium+\"></i>";
        }  else {
            return "<i class=\"fas fa-user p-mask\" title=\"Member\"></i>";
        }
    }
}
