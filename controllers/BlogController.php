<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Blog;
use app\models\Topic;

class BlogController extends Controller
{
    public function blog()
    {
        $posts = Blog::GetAllPublishedPosts();
        $posts_array = [];
        foreach ($posts as $post) {
            $post_object = new Blog();
            $post_object->loadData($post);
            $post_object->setExternals();
            array_push($posts_array, $post_object);
        }
        return $this->render('blog', ['model' => $posts_array]);
    }
    public function topic()
    {   
        $posts = Blog::GetAllPublishedPostsByTopic($topic_id);
        $posts_array = [];
        foreach ($posts as $post) {
            $post_object = new Blog();
            $post_object->loadData($post);
            $post_object->setExternals();
            array_push($posts_array, $post_object);
        }
        return $this->render('blog_topic', ['model' => $posts_array]);
    }
    public function getAllTopics() {
        $topics = Blog::GetAllTopics();
    }
}
