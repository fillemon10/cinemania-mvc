<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

/**
 * Class ReviewModel
 *
 */
class MemberReview extends DbModel
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
    public string $username = "";
    public string $role = "";


    public static function tableName(): string
    {
        return 'member_reviews';
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
    public static function getAllPublishedMemberReviewByGenre($genre)
    {
        $statement = self::prepare("SELECT * FROM member_reviews WHERE id IN (SELECT review_id FROM member_review_genres WHERE genre=:genre GROUP BY review_id HAVING COUNT(1) = 1) AND published = 1");
        $statement->bindValue(':genre', $genre);
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function getAllPublishedMemberReviewByType($type)
    {
        return parent::findAll(['published' => '1', 'type' => $type]);
    }

    public function getReview($slug)
    {
        return $this->findOne(['slug' => $slug, 'published' => 1]);
    }
    public function getAllReview($slug)
    {
        return $this->findOne(['slug' => $slug]);
    }
    public function getUsername()
    {
        return User::findOne(['id' => $this->user_id]);
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
        $this->username = $this->getUsername()->username;
        $this->role = User::getBadge($this->getUsername()->role);
    }

    public static function getAllPublishedMemberReviewsSearch($search)
    {
        $statement = self::prepare("SELECT * FROM member_reviews WHERE MATCH(title, title_of) AGAINST(:search IN NATURAL LANGUAGE MODE) AND published = 1");

        $statement->bindValue("search", $search);

        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getAllReviewsByUser()
    {
        return parent::findAll(['user_id' => Application::$app->session->get("user")]);
    }

}
