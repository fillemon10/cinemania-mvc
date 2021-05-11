<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

/**
 * Class PostComments
 *
 */
class PostComments extends DbModel
{
    public string $text = "";
    public int $post_id = 0;
    public int $user_id = 0;

    public function __construct($post_id)
    {
        $this->post_id = $post_id;
    }

    public static function tableName(): string
    {
        return 'post_comments';
    }

    public function attributes(): array
    {
        return ["text", "post_id", "user_id"];
    }

    public function labels(): array
    {
        return ["text" => "Leave a Comment"];
    }

    public function rules()
    {
        return [
            'text' => [self::RULE_REQUIRED],
        ];
    }

    public function getComments($post_id)
    {
        return parent::findAll(['published' => '1', 'post_id' => $post_id]);
    }
    public function getUsername($user_id)
    {
        return User::findOne(['id' => $user_id]);
    }
}
