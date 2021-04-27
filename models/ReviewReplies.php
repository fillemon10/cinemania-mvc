<?php

namespace app\models;


use app\core\db\DbModel;

/**
 * Class ReviewReplies
 *
 */
class ReviewReplies extends DbModel
{

    public static function tableName(): string
    {
        return 'review_comment_replys';
    }

    public function attributes(): array
    {
        return [];
    }

    public function labels(): array
    {
        return [];
    }

    public function rules()
    {
        return [];
    }

    public function getComments($comment_id)
    {
        return parent::findAll(['published' => '1', 'comment_id' => $comment_id]);
    }
    public function getUsername($user_id)
    {
        return User::findOne(['id' => $user_id]);
    }

}
