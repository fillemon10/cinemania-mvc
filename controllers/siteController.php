<?php

namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\MemberReview;
use app\models\Review;
use app\models\Post;
use app\models\Search;
use app\models\ContactForm;



use app\models\User;

/**
 * Class SiteController
 *
 */
class SiteController extends Controller
{

    public function home()
    {
        $reviews = Review::getAllPublishedReviews();
        $review_array = [];
        foreach ($reviews as $review) {
            $review_object = new Review();
            $slug = $review["slug"];
            $review_object->loadReview($review_object->getReview($slug));
            array_push($review_array, $review_object);
        }
        $amout = count($review_array);
        shuffle($review_array);
        $review_array = array_slice($review_array, -4);

        $posts = Post::getAllPublishedPosts();
        $post_array = [];
        foreach ($posts as $post) {
            $post_object = new Post();
            $slug = $post["slug"];
            $post_object->loadPost($post_object->getPost($slug));
            array_push($post_array, $post_object);
        }
        $post_array = array_reverse($post_array);


        $this->setLayout('home');

        return $this->render('home', ['reviews' => $review_array, 'posts' => $post_array, 'amout' => $amout]);
    }

    public function contact(Request $request)
    {
        $contactForm = new ContactForm();
        if ($request->isPost()) {
            $contactForm->loadData($request->getData());
            if ($contactForm->validate() && $contactForm->sendEmail()) {
                Application::$app->session->setFlash('success', 'Message sent to Cinemania, we will respond in 48 hours');
                Application::$app->response->redirect('/contact');

            }
        }
        return $this->render('contact', ["model" => $contactForm]);
    }

    public function about()
    {
        return $this->render('about');
    }

    public function search(Request $request)
    {
        $search = $request->getData()["q"];
        $reviews = [];
        $posts = [];
        $member_reviews = [];


        $reviews = Review::getAllPublishedReviewsSearch($search);
        $posts = Post::getAllPublishedPostsSearch($search);
        $member_reviews = MemberReview::getAllPublishedMemberReviewsSearch($search);


        return $this->render('search', ['search' => $search, 'reviews' => $reviews, 'posts' => $posts, 'member_reviews' => $member_reviews]);
    }

    public function newsletter_verify(Request $request)
    {

        if (isset($request->getData()["t"])) {
            $token = $request->getData()["t"];
            $statement = Application::$app->db->prepare("UPDATE newsletter SET verified=1 WHERE verify_token=:token");

            $statement->bindValue("token", $token);

            if (!$statement->execute()) {
                echo "This verification token does not exist.";
            } else {
                Application::$app->session->setFlash('success', 'Your newsletter subscription is now verified');
                Application::$app->response->redirect('/');
            }
        }
        $this->setLayout('auth');

        return $this->render('message', ["title" => "Confirm newsletter", "message" => "Please, check your inbox to confirm your newsletter subscription."]);
    }
    public function premium()
    {
        return $this->render('premium');
    }
}
