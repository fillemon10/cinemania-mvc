<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Post;


class BlogController extends Controller
{
    public function blog()
    {
        $posts = Post::GetAllPublishedPosts();
        $posts_array = [];
        foreach ($posts as $post) {
            $post_object = new Post();
            $post_object->loadData($post);
            $post_object->setExternals();
            array_push($posts_array, $post_object);
        }
        return $this->render('blog', ['model' => $posts_array]);
    }
}
