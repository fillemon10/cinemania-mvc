<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

/**
 * Class ReviewComments
 *
 */
class ReviewComments extends DbModel
{
    public string $text = "";
    public int $review_id = 0;
    public int $user_id = 0;
    public string $role = "";

    public function __construct($review_id)
    {
        $this->review_id = $review_id;
    }

    public static function tableName(): string
    {
        return 'review_comments';
    }

    public function attributes(): array
    {
        return ["text", "review_id", "user_id"];
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

    public function getComments($review_id)
    {
        return parent::findAll(['published' => '1', 'review_id' => $review_id]);
    }
    public function getUsername($user_id)
    {
        return User::findOne(['id' => $user_id]);
    }
}
