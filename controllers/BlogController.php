<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Post;


class BlogController extends Controller
{
    public function blog(Request $request)
    {
        //kollar om post_slug är satt       
        if (isset($request->getData()["post-slug"])) {
            $post_slug = $request->getData()["post-slug"];
            //skapa objekt av klassen blog
            $post = new Post();
            //hitta blog posten där slug = post_slug
            $post = $post->findOne(['slug' => $post_slug]);
            //hämtar username och topic osv.
            $post->setExternals();
            //konverterar till array
            $post = (array)$post;
            //sätter layouten till single
            $this->setLayout('single');
            // renderar single_post.php med parametern post (objektet $post, som är en Post)
            return $this->render('blog/single_post', ['post' => $post]);
        }
        //kollar om topic är satt
        if (isset($request->getData()["topic"])) {
            $topic = $request->getData()["topic"];
            //hämtar alla posts med en topic id
            $posts = Post::GetAllPublishedPostsByTopic($topic);
            $topic_name = $posts[0]->{"topic"};
            // renderar blog.php med parametern posts (en array av Posts) som har rätt topic id
            return $this->render('blog/blog_topic', ['posts' => $posts, 'topic' => $topic_name]);
        }
        //hämtar alla posts som är published
        $posts = Post::GetAllPublishedPosts();
        // renderar blog.php med parametern posts (en array av Posts)
        return $this->render('blog/blog', ['posts' => $posts]);
    }
}
