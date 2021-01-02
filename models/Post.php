<?php

namespace app\models;

use app\core\db\DbModel;
use PDO;

class Post extends DbModel
{
    public string $id = "";
    public string $user_id = "";
    public string $title = "";
    public string $slug = "";
    public string $views = "";
    public string $image = "";
    public string $body = "";
    public string $published = "";
    public string $created_at = "";
    public string $username = "";
    public string $body_short = "";
    public string $topic = "";
    public string $topic_slug = "";


    public function setExternals()
    {
        $this->body_short = $this->setShortBody();
        $this->username = $this->setUsername();
        $topic_info = $this->setTopic();
        $this->topic = $topic_info['topic'];
        $this->topic_slug = $topic_info['slug'];
    }

    public function tableName(): string
    {
        return 'posts';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }

    public static function GetAllPublishedPosts()
    {
        $table_name = static::tableName();
        $statement = self::prepare("SELECT * FROM $table_name WHERE published='1'");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function setShortBody()
    {
        return $this->shortenString($this->body, 50);
    }

    public function setUsername()
    {
        $statement = self::prepare("SELECT username FROM users WHERE id=$this->user_id");
        $statement->execute();
        $username = $statement->fetchColumn();
        return $username;
    }

    public function setTopic()
    {
        $statement = self::prepare("SELECT * FROM topics WHERE id=(SELECT topic_id FROM post_topic WHERE post_id=$this->id) LIMIT 1");
        $statement->execute();
        $result = $statement->fetchObject();
        $topic = $result->{"name"};
        $topic_slug = $result->{"slug"};
        return ['topic' => $topic, 'slug' => $topic_slug];
    }
    /* * * * * * * * * * * *
    *  Gör string kortare, tar bort ord
    * * * * * * * * * * * * */
    public function shortenString($string, $words_returned)
    {
        $returned_string = $string;
        $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
        $string = str_replace("\n", " ", $string);
        $array = explode(" ", $string);
        if (count($array) <= $words_returned) {
            $returned_string = $string;
        } else {
            array_splice($array, $words_returned);
            $returned_string = implode(" ", $array) . "...";
        }
        return $returned_string;
    }
}
