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
                    <p class=""><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review->created_at)); ?>&#8192;&#8192;<?php echo $review->role ?>&#8192;<?php echo $review->username ?></p>
                    <?php if (count((array)$review->genres) > 1) { ?>
                        <?php foreach ($review->genres as $key => $genre) { ?>
                            <a class=" mb-10 red" href="/reviews?genre=<?php echo strtolower($review->genres[$key]["genre"]) ?>"><?php echo $review->genres[$key]["genre"] ?></a>
                        <?php }
                    } else { ?>
                        <a class=" mb-10 red" href="/reviews?genre=<?php echo strtolower($review->genres[0]["genre"]) ?>"><?php echo $review->genres[0]["genre"] ?></a>
                    <?php } ?>
                    <div class="row">
                        <a class="mb-0" href="/reviews?single=<?php echo $review->slug; ?>">
                            <h1 class="mb-0 ">'<?php echo $review->title_of ?>':
                                <?php echo $review->title ?></h1>
                        </a>
                    </div>
                    <?php if ($review->type == 0) : ?>
                        <a class="mb-10 mt-10" href="/reviews?type=0"><span class="">Movie</span></a>
                    <?php else : ?>
                        <a class="mb-10 mt-10" href="/reviews?type=1"><span class="">TV/Streaming</span></a>
                    <?php endif ?>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4 text-right">
                    <a class="mb-0" href="/reviews?single=<?php echo $review->slug; ?>">
                        <img class=" box-style p-0  mb-0 w-100 lazyload" loading="lazy" data-src="<?php echo $review->poster ?>" alt="post-image">
                    </a>
                </div>
            </div>
        </div>

    </div>
<?php endforeach ?>
