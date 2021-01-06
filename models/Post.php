<?php

namespace app\models;


use app\core\db\DbModel;

/**
 * Class PostModel
 *
 */
class Post extends DbModel
{
    public int $id = 0;
    public int $user_id = 0;
    public int $published = 0;
    public string $title = '';
    public string $slug = '';
    public string $image = '';
    public string $body = '';
    public string $created_at = '';
    public string $updated_at = '';

    public static function tableName(): string
    {
        return 'posts';
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

    public static function getAllPublishedPost(){
        return parent::findAll(['published' => '1']);
    }
    public static function getAllPublishedPostByTopic($topic_id){
        
        $statement = self::prepare("SELECT * FROM posts WHERE id IN (SELECT post_id FROM post_topic WHERE topic_id=:topic_id GROUP BY post_id HAVING COUNT(1) = 1)");
        $statement->bindValue(':topic_id', $topic_id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getPost($slug){
        return $this->findOne(['slug' => $slug, 'published' => 1]);
    }

    public function getUsername()
    {
        return "test";
    }
}
