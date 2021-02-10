<?php

namespace app\models;


use app\core\db\DbModel;

/**
 * Class ReviewModel
 *
 */
class Review extends DbModel
{
    public int $id = 0;
    public int $user_id = 0;
    public int $published = 0;
    public string $title = '';
    public string $title_of = '';
    public string $slug = '';
    public string $poster = '';
    public string $imdb_rating = '';
    public string $our_rating = '';
    public string $body = '';
    public string $created_at = '';
    public string $updated_at = '';
    public string $genres = "";
    public string $type = "";
    public string $username = "";

    public static function tableName(): string
    {
        return 'reviews';
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

    public static function getAllPublishedReviews()
    {
        return parent::findAll(['published' => '1']);
    }
    public static function getAllPublishedReviewByGenre($genre)
    {
        $statement = self::prepare("SELECT * FROM reviews WHERE id IN (SELECT review_id FROM review_genres WHERE genre=:genre GROUP BY review_id HAVING COUNT(1) = 1)");
        $statement->bindValue(':genre', $genre);
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function getAllPublishedReviewByType($type)
    {
        return parent::findAll(['published' => '1', 'type' => $type]);
    }

    public function getReview($slug)
    {
        return $this->findOne(['slug' => $slug, 'published' => 1]);
    }

    public function getUsername()
    {
        return User::findOne(['id' => $this->user_id]);
    }

    public function getGenre()
    {
        $statement = self::prepare("SELECT * FROM review_genres WHERE id=(SELECT genre FROM review_genres WHERE review_id=:review_id)");
        $statement->bindValue(':review_id', $this->id);
        $statement->execute();
        return $statement->fetchObject();
    }

    public function loadReview($request)
    {
        parent::loadData($request);
        $this->username = $this->getUsername()->{"username"};
    }
}
