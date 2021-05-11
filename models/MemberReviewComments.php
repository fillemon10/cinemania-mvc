<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

/**
 * Class MemberReviewComments
 *
 */
class MemberReviewComments extends DbModel
{
    public string $text = "";
    public int $memberReview_id = 0;
    public int $user_id = 0;

    public function __construct($memberReview_id)
    {
        $this->memberReview_id = $memberReview_id;
    }

    public static function tableName(): string
    {
        return 'member_review_comment';
    }

    public function attributes(): array
    {
        return ["text", "memberReview_id", "user_id"];
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

    public function getComments($memberReview_id)
    {
        return parent::findAll(['published' => '1', 'memberReview_id' => $memberReview_id]);
    }
    public function getUsername($user_id)
    {
        return User::findOne(['id' => $user_id]);
    }
}
