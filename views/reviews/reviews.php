<?php

/** @var $model \app\models\Reviews 
 * 
 */
$this->title = "Reviews" ?>
<?php foreach ($reviews as $review) : ?>
    <div class="container news-container">
        <div class="single-news all-published box-style">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                    <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review->{"created_at"})); ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $review->{"username"}  ?></p>

                    <div class="row">
                        <a class="mb-0" href="/post/<?php echo $review->{"slug"}; ?>">
                            <h1 class="mb-0 wow fadeInLeft" data-wow-delay=".2s">'<?php echo $review->{"title_of"} ?>': <?php echo $review->{"title"} ?></h1>
                        </a>
                    </div>
                    <?php if (isset($review->{'topic'})) : ?>
                        <a class="mb-0" href="/topic/<?php echo $review->{"topic_id"} ?>"> <span class="wow fadeInLeft" data-wow-delay=".4s"> <?php echo $review->{'topic'} ?></span></a>
                    <?php endif ?>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                    <a class="mb-0" href="/post/<?php echo $review->{"slug"}; ?>">
                        <img class=" box-style p-0 wow fadeInRight mb-0" width="50%" data-wow-delay=".4s" src="<?php echo $review->{"poster"} ?>" alt="post-image">
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
