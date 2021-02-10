<?php

namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\models\Review;

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
        $slug = $request->getData()['slug'];
        $review->loadReview($review->getReview($slug));
        $this->setLayout('single');

        return $this->render('reviews/single_review', ['review' => $review]);
    }

    public function genreFilter(Request $request)
    {
        $topic_id = $request->getData()["topic_id"];
        $reviews = Review::getAllPublishedReviewsByGenre($topic_id);
        $review_array = [];
        foreach ($reviews as $review) {
            $review_object = new Review();
            $slug = $review["slug"];
            $review_object->loadReview($review_object->getReview($slug));
            array_push($review_array, $review_object);
        }
        $review_array = array_reverse($review_array);
        return $this->render('reviews/reviews', ['reviews' => $review_array, 'title' => 'Genre: ' . $genre]);
    }
    public function typeFilter(Request $request)
    {
        $topic_id = $request->getData()["topic_id"];
        $reviews = Review::getAllPublishedReviewsByType($topic_id);
        $review_array = [];
        foreach ($reviews as $review) {
            $review_object = new Review();
            $slug = $review["slug"];
            $review_object->loadReview($review_object->getReview($slug));
            array_push($review_array, $review_object);
        }
        $review_array = array_reverse($review_array);
        return $this->render('reviews/reviews', ['reviews' => $review_array, 'title' => 'Type: ' . $type]);
    }
}
