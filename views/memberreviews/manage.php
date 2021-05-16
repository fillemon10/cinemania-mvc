<?php

/** @var $model \app\models\MemberReviews 
 * 
 */

$this->title = $title ?>
<a href="/memberreviews/create" class="theme-btn mb-20" style="margin-right: 10px;">Create Member Review</a>

<?php if (count($reviews) == 0) {
    echo "<h1>You have not made any posts</h1>";
} else {
    foreach ($reviews as $review) : ?>
        <div class="container box-style">
            <div class="container news-container">
                <div class="single-news all-published box-style ">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                            <p class=""><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review->created_at)); ?>&#8192;&#8192;<?php echo $review->role ?>&#8192;<?php echo $review->username ?></p>
                            <?php if (count((array)$review->genres) > 1) { ?>
                                <?php foreach ($review->genres as $key => $genre) { ?>
                                    <a class=" mb-10 red" href="/memberreviews?genre=<?php echo strtolower($review->genres[$key]["genre"]) ?>"><?php echo $review->genres[$key]["genre"] ?></a>
                                <?php }
                            } else { ?>
                                <a class=" mb-10 red" href="/memberreviews?genre=<?php echo strtolower($review->genres[0]["genre"]) ?>"><?php echo $review->genres[0]["genre"] ?></a>
                            <?php } ?>
                            <div class="row">
                                    <h1 class="mb-0 ">'<?php echo $review->title_of ?>':
                                        <?php echo $review->title ?></h1>
                            </div>
                            <?php if ($review->type == 0) : ?>
                                <a class="mb-10 mt-10" href="/memberreviews?type=0"><span class="">Movie</span></a>
                            <?php else : ?>
                                <a class="mb-10 mt-10" href="/memberreviews?type=1"><span class="">TV/Streaming</span></a>
                            <?php endif ?>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                            <a class="mb-0" href="/memberreviews?single=<?php echo $review->slug; ?>">
                                <img class=" box-style p-0  mb-0" width="50%" src="<?php echo $review->poster ?>" alt="post-image">
                            </a>
                        </div>

                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-7 col-md-12 mx-auto">
                            <?php if ($review->published == 0) { ?>
                                <h4>Status: <strong class="text-danger">NOT PUBLISHED</strong></h4>
                            <?php } else { ?>
                                <h4>Status: <strong class="text-success">PUBLISHED</strong></h4>
                            <?php } ?>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-12 mx-auto text-right mt-10">
                            <div class="col"> <a class="theme-btn" href="/memberreviews/manage/edit?r=<?php echo $review->id ?>"><i class="fas fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach;
} ?>
