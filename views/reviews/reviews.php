<?php

/** @var $model \app\models\Reviews 
 * 
 */

$this->title = $title ?>
<?php foreach ($reviews as $review) : ?>
    <div class="container news-container">
            <div class="single-news all-published box-style">
                <div class="row">
                    <div class="col-xl-10 col-lg-8 col-md-8 section-title">
                        <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review->created_at)); ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $review->username  ?></p>
                        <?php if (count((array)$review->genres) > 1) { ?>
                            <?php foreach ($review->genres as $key => $genre) { ?>
                                <a class="wow fadeInLeft mb-10 red" data-wow-delay=".6s" href="/genre?g=<?php echo strtolower($review->genres[$key]["genre"]) ?>"><?php echo $review->genres[$key]["genre"] ?></a>
                            <?php }
                        } else { ?>
                            <a class="wow fadeInLeft mb-10 red" data-wow-delay=".6s" href="/genre?g=<?php echo strtolower($review->genres[0]["genre"]) ?>"><?php echo $review->genres[0]["genre"] ?></a>
                        <?php } ?>
                        <div class="row">
                            <a class="mb-0" href="/review?r=<?php echo $review->slug; ?>">
                                <h1 class="mb-0 wow fadeInLeft" data-wow-delay=".2s">'<?php echo $review->title_of ?>':
                                    <?php echo $review->title ?></h1>
                            </a>
                        </div>
                        <?php if ($review->type == 0) : ?>
                            <a class="mb-10 mt-10" href="/type?t=0"><span class="wow fadeInLeft" data-wow-delay=".2s">Movie</span></a>
                        <?php else : ?>
                            <a class="mb-10 mt-10" href="/type?t=1"><span class="wow fadeInLeft" data-wow-delay=".2s">TV/Streaming</span></a>
                        <?php endif ?>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 text-right">
                        <a class="mb-0" href="/review?r=<?php echo $review->slug; ?>">
                            <img class=" box-style p-0 wow fadeInRight mb-0" width=100% data-wow-delay=".4s" src="<?php echo $review->poster ?>" alt="post-image">
                        </a>
                    </div>
                </div>
            </div>
            
    </div>
<?php endforeach ?>
