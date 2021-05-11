<?php

/** @var $model \app\models\PostModel 
 * 
 * part($model, $element, $attribute, $class, $data)
 */

use app\core\Application;
use app\core\form\Form;
use app\core\form\TextareaField;
use app\core\news\Post;

$this->title = $post->{'title'};
?>

<section id="news" class="news-section mt-100 pt-30 pb-20">
    <div class="container  box-style news-container ">
        <div class="single-news">
            <div class="row mb-10">
                <?php if (isset($post->published) == false) : ?>
                    <h2>Sorry... This post has not been published</h2>
                    <div class="col-4 mt-20">
                        <a href="/news" class="theme-btn readmore-btn"><i class="fas fa-arrow-left"></i>&#8192;Back to news</a>
                    </div>
                <?php else : ?>
                    <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                        <p class=""><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($post->{'created_at'})) ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $post->{'username'}  ?></p>
                        <h1 class=""><?php echo $post->title ?></h1>
                        <?php if (isset($post->topic)) : ?>
                            <a class="mb-10 mt-10" href="/news?topic=<?php echo $post->topic_id  ?>"> <span class=""> <?php echo $post->topic  ?></span></a>
                        <?php endif ?>
                        <div class=""><?php echo htmlspecialchars_decode($post->body) ?></div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                        <img class=" box-style p-0 news-img " src="<?php echo $post->image ?>" alt="post-image">
                    </div>
            </div>
            <div class="row box-style mt-20">
                <?php $form = Form::begin('', 'post') ?>
                <?php echo new TextareaField($commentModel, 'text')  ?>
                <div class="row">
                    <div class="col text-right">
                        <button type="submit" class="theme-btn mt-20 mb-20  " name="comment">Comment</button>
                    </div>
                </div>
                <div class="row">
                </div>
                <?php Form::end() ?>
            </div>
            <?php include(Application::$ROOT_DIR . "/views/comments.php"); ?>
        <?php endif ?>
        </div>
    </div>
</section>
