<?php

namespace app\models;


use app\core\db\DbModel;

/**
 * Class MemberReviewForm
 *
 */
class MemberReviewForm extends DbModel
{
    public int $id = 0;
    public int $user_id = 0;
    public int $published = 0;
    public string $imdb_id = '';
    public string $title = '';
    public string $title_of = '';
    public string $slug = '';
    public string $poster = '';
    public string $imdb_rating = '';
    public string $our_rating = '';
    public string $body = '';
    public string $created_at = '';
    public string $updated_at = '';
    public array $genres = [];
    public string $type = "";
    public string $username = "(deleted user)";

    public static function tableName(): string
    {
        return 'member_reviews';
    }

    public function labels(): array
    {
        return [
            'title' => 'Title Of Your Review',
            'imdb_id' => 'IMDb ID Of The Movie Or Series (Find the ID on IMDB: "http://www.imdb.com/title/<strong>tt0123456</strong>/)',
            'our_rating' => 'Your Rating Of The Movie Or Series',
            'body' => 'Review Text'

        ];
    }

    public function attributes(): array
    {
        return ['title', 'imdb_id', 'our_rating', 'body', 'poster', 'slug', 'user_id', "title_of"];
    }

    public function rules()
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'imdb_id' => [self::RULE_REQUIRED],
            'our_rating' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public static function getAllPublishedReviews()
    {
        return parent::findAll(['published' => '1']);
    }
    public static function getAllPublishedReviewByGenre($genre)
    {
        $statement = self::prepare("SELECT * FROM member_reviews WHERE id IN (SELECT review_id FROM review_genres WHERE genre=:genre GROUP BY review_id HAVING COUNT(1) = 1) AND published = 1");
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
    public function setGenres($genres)
    {
        foreach ($genres as $genre) {
            $statement = self::prepare("INSERT INTO member_review_genres (review_id, genre) VALUES (:review_id, :genre)");
            $statement->bindValue(':review_id', MemberReview::findOne(['slug' => $this->slug])->id);
            $statement->bindValue(':genre', $genre);
            $statement->execute();
        }
        return;
    }


    public function getGenre()
    {
        $statement = self::prepare("SELECT genre FROM `member_review_genres` WHERE review_id IN (SELECT review_id FROM member_review_genres WHERE review_id = :review_id)");
        $statement->bindValue(':review_id', $this->id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function loadReview($request)
    {
        parent::loadData($request);
        $this->genres = $this->getGenre();
        $this->username = $this->getUsername()->{"username"};
    }
}
