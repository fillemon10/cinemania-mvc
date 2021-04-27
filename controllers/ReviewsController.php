<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Review;
use app\core\OMDb;
use app\models\ReviewComments;
use app\models\ReviewReplies;

/**
 * Class ReviewsController
 */
class ReviewsController extends Controller
{
    public function reviews()
    {
        //hämtar alla published reviews
        $reviews = Review::getAllPublishedReviews();

        //sätter en tom array
        $review_array = [];

        //för varje review i reviews
        foreach ($reviews as $review) {

            //skapa ett review objekt
            $review_object = new Review();

            //hämta slugen
            $slug = $review["slug"];

            //ladda reviewen
            $review_object->loadReview($review_object->getReview($slug));

            //lägg till reviewen i review_array
            array_push($review_array, $review_object);
        }

        //vänd på arrayen
        $review_array = array_reverse($review_array);

        //rendera viewn reviews och för med parametrarna reviews och title
        return $this->render('reviews/reviews', ['reviews' => $review_array, 'title' => 'Reviews']);
    }

    public function singleReview(Request $request)
    {
        $review = new Review();
        $slug = $request->getData()['r'];
        $review->loadReview($review->getReview($slug));
        $apikey = Application::$omdbAPIkey;
        $omdb = new OMDb(['plot' => 'full', 'apikey' => $apikey]);
        $movie = $omdb->get_by_id($review->imdb_id);
        $comments = new ReviewComments();
        $commentsArray = $comments->getComments($review->id);
        

        foreach ($commentsArray as $key => $comment ) {
            $comment_user = $comments->getUsername($comment["user_id"]);
            $commentsArray[$key]["username"] = $comment_user->username;
        }
        foreach ($commentsArray as $key => $replies) {

            $replies = new ReviewReplies();

            $repliesArray = $replies->getComments($commentsArray[$key]["id"]);

            foreach ($repliesArray as $key => $reply) {
                $comment_user = $replies->getUsername($reply["user_id"]);
                $repliesArray[$key]["username"] = $comment_user->username;
            }
        }

        $this->setLayout('single');

        return $this->render('reviews/single_review', ['review' => $review, 'movie' => $movie, 'comments' => $commentsArray, 'replies' => $repliesArray]);
    }

    public function genreFilter(Request $request)
    {
        $genre = $request->getData()["g"];
        $reviews = Review::getAllPublishedReviewByGenre($genre);
        $review_array = [];
        foreach ($reviews as $review) {
            $review_object = new Review();
            $slug = $review["slug"];
            $review_object->loadReview($review_object->getReview($slug));
            array_push($review_array, $review_object);
        }
        $review_array = array_reverse($review_array);

        return $this->render('reviews/reviews', ['reviews' => $review_array, 'title' => 'Genre: ' . ucwords($genre)]);
    }
    public function typeFilter(Request $request)
    {
        $type = $request->getData()["t"];
        $reviews = Review::getAllPublishedReviewByType($type);
        $review_array = [];
        foreach ($reviews as $review) {
            $review_object = new Review();
            $slug = $review["slug"];
            $review_object->loadReview($review_object->getReview($slug));
            array_push($review_array, $review_object);
        }
        $review_array = array_reverse($review_array);

        if ($type == 0) {
            $type_name = "Movie";
        } else {
            $type_name = "TV/Streaming";
        }
        return $this->render('reviews/reviews', ['reviews' => $review_array, 'title' => 'Type: ' . $type_name]);
    }
}
