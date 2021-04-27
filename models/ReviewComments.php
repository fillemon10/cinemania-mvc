<?php

namespace app\models;


use app\core\db\DbModel;

/**
 * Class ReviewComments
 *
 */
class ReviewComments extends DbModel
{

    public static function tableName(): string
    {
        return 'review_comments';
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

    public function getComments($review_id)
    {
        return parent::findAll(['published' => '1', 'review_id' => $review_id]);
    }
    public function getUsername($user_id)
    {
        return User::findOne(['id' => $user_id]);
    }

}
