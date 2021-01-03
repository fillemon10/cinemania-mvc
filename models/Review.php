<?php

namespace app\models;

use app\core\db\DbModel;

class Review extends Post
{
    public string $id = "";
    public string $user_id = "";
    public string $imdb_id = "";
    public string $title_of = "";
    public string $our_rating = "";
    public string $title = "";
    public string $slug = "";
    public string $views = "";
    public string $poster = "";
    public string $body = "";
    public string $published = "";
    public string $created_at = "";
    public string $username = "";
    public string $body_short = "";
    public string $type = "";
    public array $genre = [];

    public function setExternals()
    {
        $this->body_short = $this->getShortBody();
        $this->username = $this->getUsername();
        $this->genre  = $this->getGenre();
    }

    public function tableName(): string
    {
        return 'reviews';
    }

    public function primaryKey(): string
    {
        return 'id';
    }


    public function getGenre()
    {
        $result = self::QueryAll("SELECT genre FROM review_genres WHERE review_id=$this->id");
        return $result;
    }
}
