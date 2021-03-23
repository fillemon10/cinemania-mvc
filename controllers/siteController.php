<?php

namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\Review;
use app\models\Post;
use app\models\Search;


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

    public function contact()
    {
        return $this->render('contact');
    }

    public function about()
    {
        return $this->render('about');
    }

    public function search(Request $request)
    {
        $query = $request->getData()["q"];

        return $this->render('search', ['search' => $search]);

    }
}
