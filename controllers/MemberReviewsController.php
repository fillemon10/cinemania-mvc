<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\MemberReview;
use app\core\OMDb;
use app\core\middlewares\MemberMiddleware;
use app\models\MemberReviewForm;

/**
 * Class MemberReviewsController
 */
class MemberReviewsController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new MemberMiddleware(['createreview']));
                $this->registerMiddleware(new MemberMiddleware(['managereview']));

    }
    
    public function reviews()
    {
        //hämtar alla published reviews
        $reviews = MemberReview::getAllPublishedReviews();

        //sätter en tom array
        $review_array = [];

        //för varje review i reviews
        foreach ($reviews as $review) {

            //skapa ett review objekt
            $review_object = new MemberReview();

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
        return $this->render('memberreviews/memberreviews', ['reviews' => $review_array, 'title' => 'Member Reviews']);
    }

    public function singleReview(Request $request)
    {
        $review = new Review();
        $slug = $request->getData()['r'];
        $review->loadReview($review->getReview($slug));
        $apikey = Application::$omdbAPIkey;
        $omdb = new OMDb(['plot' => 'full', 'apikey' => $apikey]);
        $movie = $omdb->get_by_id($review->imdb_id);

        $this->setLayout('single');

        return $this->render('memberreviews/single_review', ['review' => $review, 'movie' => $movie]);
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
        return $this->render('memberreviews/memberreviews', ['reviews' => $review_array, 'title' => 'Genre: ' . $genre]);
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
        return $this->render('memberreviews/memberreviews', ['reviews' => $review_array, 'title' => 'Type: ' . $type_name]);
    }

    public function manage(Request $request) {

    }
    public function create(Request $request) {
        $memberReview = new MemberReviewForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getData());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('memberreviews/create', [
            'model' => $memberReview,
        ]);
    }
}
