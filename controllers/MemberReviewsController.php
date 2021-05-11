<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\MemberReview;
use app\core\OMDb;
use app\core\middlewares\MemberMiddleware;
use app\models\MemberReviewComments;
use app\models\MemberReviewForm;

/**
 * Class MemberReviewsController
 */
class MemberReviewsController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new MemberMiddleware(['create']));
        $this->registerMiddleware(new MemberMiddleware(['manage']));
    }

    public function reviews(Request $request)
    {
        if (isset($request->getData()["single"]) ?? NULL) {
            $review = new MemberReview();
            $slug = $request->getData()["single"];
            $review->loadReview($review->getReview($slug));
            $apikey = Application::$omdbAPIkey;
            $omdb = new OMDb(['plot' => 'full', 'apikey' => $apikey]);
            $movie = $omdb->get_by_id($review->imdb_id);
            $this->setLayout('single');

            $comments = new MemberReviewComments($review->id);
            $commentsArray = $comments->getComments($review->id);

            foreach ($commentsArray as $key => $comment) {
                $comment_user = $comments->getUsername($comment["user_id"]);
                $commentsArray[$key]["username"] = $comment_user->username;
            }
            $commentModel = new MemberReviewComments($review->id);

            if ($request->isPost()) {
                $commentModel->loadData($request->getData());

                $commentModel->user_id = 1;
                if (!Application::$app->session->get("user")) {
                    Application::$app->session->setFlash('success', 'You have to login to comment');

                    Application::$app->response->redirect('/memberreviews?single=' . $review->slug);
                } else {
                    $commentModel->user_id = Application::$app->session->get("user");
                    if ($commentModel->validate() && $commentModel->save()) {
                        Application::$app->session->setFlash('success', 'Your comment is now under review and will be published soon');
                        Application::$app->response->redirect('/memberreviews?single=' . $review->slug);
                    }
                }
            }
            $commentsArray = array_reverse($commentsArray);

            return $this->render('reviews/single_review', ['review' => $review, 'movie' => $movie, 'comments' => $commentsArray, 'commentModel' => $commentModel]);
        } else if (isset($request->getData()["genre"]) ?? NULL) {
            $genre = $request->getData()["genre"];
            $reviews = MemberReview::getAllPublishedMemberReviewByGenre($genre);
            $review_array = [];
            foreach ($reviews as $review) {
                $review_object = new MemberReview();
                $slug = $review["slug"];
                $review_object->loadReview($review_object->getReview($slug));
                array_push($review_array, $review_object);
            }
            $review_array = array_reverse($review_array);
            return $this->render('memberreviews/memberreviews', ['reviews' => $review_array, 'title' => 'Genre: ' . ucfirst($genre)]);
        } else if (isset($request->getData()["type"]) ?? NULL) {
            $type = $request->getData()["type"];
            $reviews = MemberReview::getAllPublishedMemberReviewByType($type);
            $review_array = [];
            foreach ($reviews as $review) {
                $review_object = new MemberReview();
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
        } else {
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
    }

    public function manage(Request $request)
    {
        $AllReviewsByUser = MemberReview::getAllReviewsByUser();
        $review_array = [];
        foreach ($AllReviewsByUser as $review) {
            $review_object = new MemberReview();
            $slug = $review["slug"];
            $review_object->loadReview($review_object->getAllReview($slug));
            array_push($review_array, $review_object);
        }
        $review_array = array_reverse($review_array);
        $this->setLayout('onlybanner');
        return $this->render('memberreviews/manage', ['reviews' => $review_array, 'title' => 'Your Member Reviews']);
    }

    public function edit(Request $request)
    {
        $memberReview = new MemberReviewForm();

        if ($request->isPost()) {
            $memberReview->loadData($request->getData());
            $memberReview->id = Application::$app->session->get("review_id");
            if ($memberReview->validate()) {
                $apikey = Application::$omdbAPIkey;
                $omdb = new OMDb(['plot' => 'full', 'apikey' => $apikey]);
                $movie = $omdb->get_by_id($memberReview->imdb_id);
                $memberReview->title_of = $movie["Title"];
                $memberReview->poster = $movie["Poster"];
                $memberReview->user_id = Application::$app->session->get('user');
                $memberReview->poster = $movie["Poster"];
                $memberReview->slug = MemberReviewsController::slugify($memberReview->title);
                $memberReview->type = $movie["Type"];
                $memberReview->updateMemberReview();
                $memberReview->removeGenres();
                $memberReview->setGenres($movie["Genre"], Application::$app->session->get("review_id"));
                Application::$app->session->setFlash('success', 'Your review is now updated');
                Application::$app->response->redirect('/memberreviews/manage');
                return;
            }
        } else {
            $review_id = $request->getData()['r'];
            $memberReview->loadData(MemberReview::findOne(["id" => $review_id, "user_id" => Application::$app->session->get("user")]));
            Application::$app->session->set("review_id", $review_id);
        }
        return $this->render('memberreviews/create', [
            'model' => $memberReview, 'title' => 'Edit Member Review', 'button' => "Edit Review",
        ]);
    }

    public function delete()
    {
        $review_id = $request->getData()['r'];
    }

    public function create(Request $request)
    {
        $memberReview = new MemberReviewForm();
        if ($request->isPost()) {
            $memberReview->loadData($request->getData());
            if ($memberReview->validate()) {
                $apikey = Application::$omdbAPIkey;
                $omdb = new OMDb(['plot' => 'full', 'apikey' => $apikey]);
                $movie = $omdb->get_by_id($memberReview->imdb_id);
                $memberReview->title_of = $movie["Title"];
                $memberReview->poster = $movie["Poster"];
                $memberReview->user_id = Application::$app->session->get('user');
                $memberReview->poster = $movie["Poster"];
                $memberReview->type = $movie["Type"];
                $memberReview->slug = MemberReviewsController::slugify($memberReview->title);
                if ($memberReview->save()) {
                    $memberReview->setGenres($movie["Genre"], MemberReview::findOne(["slug" => $memberReview->slug])->id);
                    Application::$app->session->setFlash('success', 'Your review is now created');
                    Application::$app->response->redirect('/memberreviews/manage');
                    return;
                }
            }
        }
        $this->setLayout('onlybanner');
        return $this->render('memberreviews/create', [
            'model' => $memberReview,
            'title' => 'Create Member Review', 'button' => "Create Review"
        ]);
    }
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
