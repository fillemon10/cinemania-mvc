<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\BlogModel;
use app\models\Review;
use app\models\Post;
use app\models\SingleReview;

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
            //konverterar till array
            $post = (array)$post;
            //sätter layouten till single
            $this->setLayout('single');
            // renderar single_post.php med parametern post (objektet $post, som är en Post)
            return $this->render('blog/single_post', ['post' => $post]);
        }
        //kollar om post_slug är satt       
        if (isset($request->getData()["review-slug"])) {
            $review_slug = $request->getData()["review-slug"];
            //skapa objekt av klassen blog
            $review = new SingleReview();
            //hitta blog posten där slug = post_slug
            $review = $review->findOne(['slug' => $review_slug]);
            $review->getGenre();
            $review->getOMDbData();
            //konverterar till array
            $review = (array)$review;
            //sätter layouten till single
            $this->setLayout('single');
            // renderar single_post.php med parametern post (objektet $post, som är en Post)
            return $this->render('blog/single_review', ['review' => $review]);
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
        $posts = Post::GetPublishedBlogPosts(6);
        $limit = count($posts);
        $reviews = Review::GetPublishedBlogReviews($limit);
        // renderar blog.php med parametern posts (en array av Posts)
        return $this->render('blog/blog', ['posts' => $posts, 'reviews' => $reviews]);
    }
}
