<?php

/** @var $model \app\models\PostModel 
 * 
 */
$this->title = "News" ?>
<?php foreach ($posts as $post) : ?>
    <div class="container news-container">
        <div class="single-news all-published box-style">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                    <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($post->{"created_at"})); ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $post->{"username"}  ?></p>

                    <div class="row">
                        <a class="mb-0" href="/post/<?php echo $post->{"slug"}; ?>">
                            <h2 class="mb-0 wow fadeInLeft" data-wow-delay=".2s"><?php echo $post->{"title"} ?></h2>
                        </a>
                    </div>
                    <?php if (isset($post->{'topic'})) : ?>
                        <a class="mb-0" href="/topic/<?php echo $post->{"topic_id"} ?>"> <span class="wow fadeInLeft" data-wow-delay=".4s"> <?php echo $post->{'topic'} ?></span></a>
                    <?php endif ?>
                    <div class="mb-10 wow fadeInLeft" data-wow-delay=".6s"><?php echo htmlspecialchars_decode($post->{"body"}) ?></div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                    <a class="mb-0" href="/post/<?php echo $post->{"slug"}; ?>">
                        <img class=" box-style p-0 news-img wow fadeInRight mb-0" data-wow-delay=".4s" src="<?php echo $post->{"image"} ?>" alt="post-image">
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
