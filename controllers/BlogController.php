<?php

namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\models\Post;

/**
 * Class BlogController
 */
class BlogController extends Controller
{
    public function blog()
    {
        $posts = Post::getAllPublishedPost();
        $post_array = [];
        foreach ($posts as $post) {
            $post_object = new Post();
            $slug = $post["slug"];
            $post_object->loadPost($post_object->getPost($slug));

            array_push($post_array, $post_object);
        }
        $post_array = array_reverse($post_array);
        return $this->render('blog', ['posts' => $post_array, 'title' => 'Blog']);
    }

    public function singlePost(Request $request)
    {
        $post = new Post();
        $slug = $request->getData()['slug'];
        $post->loadPost($post->getPost($slug));
        $this->setLayout('single');

        return $this->render('single_post', ['post' => $post]);
    }

    public function topicFilter(Request $request)
    {
        $topic_id = $request->getData()["topic_id"];
        $posts = Post::getAllPublishedPostByTopic($topic_id);
        $post_array = [];
        foreach ($posts as $post) {
            $post_object = new Post();
            $slug = $post["slug"];
            $post_object->loadPost($post_object->getPost($slug));
            array_push($post_array, $post_object);
        }
        $post_array = array_reverse($post_array);
        return $this->render('blog', ['posts' => $post_array, 'title' => 'Genre: ' . $topic_id]);
    }
}
