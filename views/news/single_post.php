<?php

/** @var $model \app\models\PostModel 
 * 
 * part($model, $element, $attribute, $class, $data)
 */

use app\core\news\Post;

$this->title = $post->{'title'};
?>

<section id="news" class="news-section mt-100 pt-30 pb-20">
    <div class="container  box-style news-container wow fadeInUp">
        <div class="single-news">
            <div class="row">
                <?php if (isset($post->published) == false) : ?>
                    <h2>Sorry... This post has not been published</h2>
                    <div class="col-4 mt-20">
                        <a href="/news" class="theme-btn readmore-btn"><i class="fas fa-arrow-left"></i>&#8192;Back to news</a>
                    </div>
                <?php else : ?>
                    <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                        <p class="wow fadeInDown" data-wow-delay=".8s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($post->{'created_at'})) ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $post->{'username'}  ?></p>
                        <h1 class="wow fadeInLeft" data-wow-delay=".2s"><?php echo $post->title ?></h1>
                        <?php if (isset($post->topic)) : ?>
                            <a class="mb-10 mt-10" href="/topic?t=<?php echo $post->topic_id  ?>"> <span class="wow fadeInLeft" data-wow-delay=".4s"> <?php echo $post->topic  ?></span></a>
                        <?php endif ?>
                        <div class="wow fadeInLeft" data-wow-delay=".6s"><?php echo htmlspecialchars_decode($post->body) ?></div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                        <img class=" box-style p-0 news-img wow fadeInRight" data-wow-delay=".4s" src="<?php echo $post->image ?>" alt="post-image">
                    </div>
            </div>
            <!-- ========================= comment-section start ========================= -->
            <?php// include("includes/comments.php") ?>
            <!-- ========================= comment-section end ========================= -->
        <?php endif ?>
        </div>
    </div>
</section>
