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
    public function reviews(Request $request)
    {

        if (isset($request->getData()["type"]) ?? NULL) {
            $reviews = Review::getAllPublishedReviewByType($request->getData()["type"]);
            $review_array = [];
            foreach ($reviews as $review) {
                $review_object = new Review();
                $slug = $review["slug"];
                $review_object->loadReview($review_object->getReview($slug));
                array_push($review_array, $review_object);
            }
            $review_array = array_reverse($review_array);

            if ($request->getData()["type"] == 0) {
                $type_name = "Movie";
            } else {
                $type_name = "TV/Streaming";
            }
            return $this->render('reviews/reviews', ['reviews' => $review_array, 'title' => 'Type: ' . $type_name]);
        } else  if (isset($request->getData()["single"]) ?? NULL) {
            $review = new Review();

            $review->loadReview($review->getReview($request->getData()["single"]));

            $apikey = Application::$omdbAPIkey;
            $omdb = new OMDb(['plot' => 'full', 'apikey' => $apikey]);
            $movie = $omdb->get_by_id($review->imdb_id);

            $comments = new ReviewComments($review->id);
            $commentsArray = $comments->getComments($review->id);

            foreach ($commentsArray as $key => $comment) {
                $comment_user = $comments->getUsername($comment["user_id"]);
                $commentsArray[$key]["username"] = $comment_user->username;
            }
            $commentModel = new ReviewComments($review->id);

            if ($request->isPost()) {
                $commentModel->loadData($request->getData());

                $commentModel->user_id = 1;
                if (!Application::$app->session->get("user")) {
                    Application::$app->session->setFlash('success', 'You have to login to comment');

                    Application::$app->response->redirect('/reviews?single=' . $review->slug);
                } else {
                    $commentModel->user_id = Application::$app->session->get("user");
                    if ($commentModel->validate() && $commentModel->save()) {
                        Application::$app->session->setFlash('success', 'Your comment is now under review and will be published soon');
                        Application::$app->response->redirect('/reviews?single=' . $review->slug);
                    }
                }
            }
            $commentsArray = array_reverse($commentsArray);

            $this->setLayout('single');

            return $this->render('reviews/single_review', ['review' => $review, 'movie' => $movie, 'comments' => $commentsArray, 'commentModel' => $commentModel]);
        } else if (isset($request->getData()["genre"]) ?? NULL) {
            $reviews = Review::getAllPublishedReviewByGenre($request->getData()["genre"]);
            $review_array = [];
            foreach ($reviews as $review) {
                $review_object = new Review();
                $slug = $review["slug"];
                $review_object->loadReview($review_object->getReview($slug));
                array_push($review_array, $review_object);
            }
            $review_array = array_reverse($review_array);

            return $this->render('reviews/reviews', ['reviews' => $review_array, 'title' => 'Genre: ' . ucwords($request->getData()["genre"])]);
        } else {
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
    }
}
