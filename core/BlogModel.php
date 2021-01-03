<?php

namespace app\core;

use app\core\db\DbModel;
use app\models\Post;
use app\models\Review;
use app\models\User;

abstract class BlogModel extends DbModel
{
    abstract public function tableName(): string;

    abstract public function primaryKey(): string;

    public function getShortBody(): string
    {
        return $this->shortenString($this->body, 50);
    }

    public function getUsername(): string
    {
        $username = User::findOne(['id' => $this->user_id])->{'username'};
        return $username;
    }

    public function setExternals()
    {
        $this->body_short = $this->getShortBody();
        $this->username = $this->getUsername();
    }


    public static function GetPublishedBlogPosts(int $limit)
    {
        $posts = self::QueryAll("SELECT * FROM posts WHERE published='1' LIMIT $limit");
        $posts_array = [];
        foreach ($posts as $post) {
            $post_object = new Post();
            $post_object->loadData($post);
            $post_object->setExternals();
            array_push($posts_array, $post_object);
        }
        return $posts_array;
    }

    public static function GetPublishedBlogReviews($limit)
    {
        $reviews = self::QueryAll("SELECT * FROM reviews WHERE published='1' LIMIT $limit");
        $reviews_array = [];
        foreach ($reviews as $review) {
            $review_object = new Review();
            $review_object->loadData($review);
            $review_object->setExternals();
            array_push($reviews_array, $review_object);
        }
        return $reviews_array;
    }

    // Gör string kortare, tar bort ord
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
