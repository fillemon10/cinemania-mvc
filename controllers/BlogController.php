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
        //hämtar alla published posts
        $posts = Post::getAllPublishedPost();

        //sätter en tom array
        $post_array = [];

        //för varje post i posts
        foreach ($posts as $post) {

            //skapa ett post objekt
            $post_object = new Post();

            //hämta slugen
            $slug = $post["slug"];

            //ladda posten
            $post_object->loadPost($post_object->getPost($slug));

            //lägg till posten i post_array
            array_push($post_array, $post_object);
        }

        //vänd på arrayen
        $post_array = array_reverse($post_array);

        //rendera viewn blog och för med parametrarna posts och title
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
