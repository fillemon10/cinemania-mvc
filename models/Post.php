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
    public string $topic = "";
    public string $topic_id = "";
    public string $username = "(deleted user)";
    public string $short_body = "";


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

    public static function getAllPublishedPosts()
    {
        return parent::findAll(['published' => '1']);
    }
    public static function getAllPublishedPostsByTopic($topic_id)
    {
        $statement = self::prepare("SELECT * FROM posts WHERE id IN (SELECT post_id FROM post_topic WHERE topic_id=:topic_id GROUP BY post_id HAVING COUNT(1) = 1)");
        $statement->bindValue(':topic_id', $topic_id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getPost($slug)
    {
        return $this->findOne(['slug' => $slug, 'published' => 1]);
    }

    public function getUsername()
    {
        return User::findOne(['id' => $this->user_id]);
    }

    public function getTopic()
    {
        $statement = self::prepare("SELECT * FROM topics WHERE id=(SELECT topic_id FROM post_topic WHERE post_id=:post_id) LIMIT 1");
        $statement->bindValue(':post_id', $this->id);
        $statement->execute();
        return $statement->fetchObject();
    }

    public function loadPost($request)
    {
        parent::loadData($request);
        $this->username = $this->getUsername()->{"username"};
        $this->topic = $this->getTopic()->{'name'};
        $this->topic_id = $this->getTopic()->{'id'};
        $this->short_body = $this->shorten_string($this->body, 40);
    }

    public function shorten_string($string, $wordsreturned)
    {
        $retval = $string;
        $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
        $string = str_replace("\n", " ", $string);
        $array = explode(" ", $string);
        if (count($array) <= $wordsreturned) {
            $retval = $string;
        } else {
            array_splice($array, $wordsreturned);
            $retval = implode(" ", $array) . "...";
        }
        return $retval;
    }

    public static function getAllPublishedPostsSearch($search)
    {
        $statement = self::prepare("SELECT * FROM posts WHERE MATCH(title) AGAINST(:search IN NATURAL LANGUAGE MODE) AND published = 1");

        $statement->bindValue("search", $search);

        $statement->execute();

        return $statement->fetchAll();
    }
}
