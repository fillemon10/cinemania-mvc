<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Post;
use app\models\PostComments;

/**
 * Class NewsController
 */
class NewsController extends Controller
{
    public function news(Request $request)
    {
        if (isset($request->getData()["single"]) ?? NULL) {
            $post = new Post();
            $slug = $request->getData()['single'];
            $post->loadPost($post->getPost($slug));
            $this->setLayout('single');

            $comments = new PostComments($post->id);
            $commentsArray = $comments->getComments($post->id);

            foreach ($commentsArray as $key => $comment) {
                $comment_user = $comments->getUsername($comment["user_id"]);
                $commentsArray[$key]["username"] = $comment_user->username;
            }
            $commentModel = new PostComments($post->id);

            if ($request->isPost()) {
                $commentModel->loadData($request->getData());

                $commentModel->user_id = 1;
                if (!Application::$app->session->get("user")) {
                    Application::$app->session->setFlash('success', 'You have to login to comment');

                    Application::$app->response->redirect('/news?single=' . $post->slug);
                } else {
                    $commentModel->user_id = Application::$app->session->get("user");
                    if ($commentModel->validate() && $commentModel->save()) {
                        Application::$app->session->setFlash('success', 'Your comment is now under review and will be published soon');
                        Application::$app->response->redirect('/news?single=' . $post->slug);
                    }
                }
            }
            $commentsArray = array_reverse($commentsArray);

            return $this->render('news/single_post', ['post' => $post, 'comments' => $commentsArray, 'commentModel' => $commentModel]);
        } else if (isset($request->getData()["topic"]) ?? NULL) {
            $topic_id = $request->getData()["topic"];
            $posts = Post::getAllPublishedPostsByTopic($topic_id);
            $post_array = [];
            foreach ($posts as $post) {
                $post_object = new Post();
                $slug = $post["slug"];
                $post_object->loadPost($post_object->getPost($slug));
                $topic = $post_object->topic;
                array_push($post_array, $post_object);
            }
            $post_array = array_reverse($post_array);


            return $this->render('news/news', ['posts' => $post_array, 'title' => 'Topic: ' . $topic]);
        } else {
            //hämtar alla published posts
            $posts = Post::getAllPublishedPosts();
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
            //rendera viewn news och för med parametrarna posts och title
            return $this->render('news/news', ['posts' => $post_array, 'title' => 'News']);
        }
    }
}
