<?php

namespace app\models;

use app\core\db\DbModel;

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
    public string $topic_id = "";

    public function setExternals()
    {
        $this->body_short = $this->getShortBody();
        $this->username = $this->getUsername();
        $topic_info = $this->getTopic();
        $this->topic_id = $topic_info['id'];
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
        $posts = self::findAll(['published' => '1']) ?? false;
        $posts_array = [];
        foreach ($posts as $post) {
            $post_object = new Post();
            $post_object->loadData($post);
            $post_object->setExternals();
            array_push($posts_array, $post_object);
        }
        return $posts_array;
    }

    public function getShortBody(): string
    {
        return $this->shortenString($this->body, 50);
    }

    public function getUsername(): string
    {
        $username = User::findOne(['id' => $this->user_id])->{'username'};
        return $username;
    }

    public function getPost()
    {
        return self::findOne(['post-slug' => $this->slug]);
    }

    public function getTopic()
    {
        $result = $this->QueryOne("SELECT * FROM topics WHERE id=(SELECT topic_id FROM post_topic WHERE post_id=$this->id) LIMIT 1");
        $topic_id = $result->{"id"};
        $topic = $result->{"name"};
        $topic_slug = $result->{"slug"};
        return ['topic' => $topic, 'slug' => $topic_slug, 'id' => $topic_id];
    }

    public function getAllTopics()
    {
        return parent::QueryAll("SELECT * FROM topics");;
    }

    public static function GetAllPublishedPostsByTopic($topic_id)
    {
        //skapa en array
        $posts = parent::QueryAll("SELECT * FROM posts WHERE id IN (SELECT post_id FROM post_topic pt WHERE topic_id=$topic_id GROUP BY post_id HAVING COUNT(1) = 1)");

        $posts_array = [];
        //för varje post som med en topic id
        foreach ($posts as $post) {
            //skapa new
            $post_object = new Post();
            $post_object->loadData($post);
            $post_object->setExternals();
            array_push($posts_array, $post_object);
        }
        return $posts_array;
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
