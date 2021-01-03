<?php

use app\core\Application;

$this->title = "Blog";
/** @var $posts \app\models\Post */


?>
<div class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <section class="review-section pt-50 pb-20">
                <?php foreach ($reviews as $key => $review) { ?>
                    <?php
                    $review = (array) $review;
                    ?>
                    <div class="container  box-style review-container ">
                        <div class="single-review all-published">
                            <div class="row">
                                <div class="col-xl-10 col-lg-9 col-md-8 section-title">
                                    <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review["created_at"])); ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $review["username"]  ?></p>
                                    <?php if (count($review["genre"]) > 1) {
                                        foreach ($review["genre"] as $key => $genre) { ?>
                                            <a class="font-weight-bold wow fadeInLeft mb-0 mt-10 red" data-wow-delay=".6s" href="/genre/<?php echo strtolower($review["genre"][$key][0]) ?>"><?php echo $review["genre"][$key][0] ?></a>
                                        <?php }
                                    } else { ?>
                                        <a class="font-weight-bold wow fadeInLeft red mb-0 mt-10" data-wow-delay=".6s" href="/genre/<?php echo strtolower($review["genre"][0][0]) ?>"><?php echo $review["genre"][0][0] ?></a>
                                    <?php } ?>
                                    <div class="row">
                                        <a class="mb-0" href="/blog?review-slug=<?php echo $review['slug']; ?>">
                                            <h2 class="wow fadeInLeft mt-10 mb-0" data-wow-delay=".2s"><?php echo "'" . $review["title_of"] . "' review: " . $review["title"] ?></h2>
                                        </a>
                                    </div>
                                    <?php if ($review["type"] == 0) : ?>
                                        <a class="mt-10" href="/type/movie"><span class="wow fadeInLeft" data-wow-delay=".2s">Movie</span></a>
                                    <?php else : ?>
                                        <a class="mt-10" href="/type/series"><span class="wow fadeInLeft" data-wow-delay=".2s">TV/Streaming</span></a>
                                    <?php endif ?>
                                    <div class="mb-10 wow fadeInLeft" data-wow-delay=".6s"><?php echo htmlspecialchars_decode($review['body_short']) ?></div>

                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 text-right">
                                    <a class="mb-0" href="/review/<?php echo $review['slug']; ?>">
                                        <img class=" box-style p-0 poster-img wow fadeInRight mb-0" data-wow-delay=".4s" src="<?php echo $review['poster']; ?>" alt="poster-<?php echo  str_replace(" ", "-", strtolower($review["title_of"])); ?>">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
            <section class="blog-section pt-50 pb-20">
                <?php foreach ($posts as $key => $post) : ?>
                    <?php $post = (array) $post ?>
                    <div class="container blog-container">
                        <div class="single-blog all-published box-style">
                            <div class="row">
                                <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                                    <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($post["created_at"])); ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $post["username"]  ?></p>
                                    <div class="row">
                                        <a class="mb-0" href="/blog?post-slug=<?php echo $post['slug']; ?>">
                                            <h2 class="mb-0 wow fadeInLeft" data-wow-delay=".2s"><?php echo $post['title'] ?></h2>
                                        </a>
                                    </div>
                                    <?php if (isset($post['topic'])) : ?>
                                        <a class="mb-0" href="/blog?topic=<?php echo $post['topic_id'] ?>"> <span class="wow fadeInLeft" data-wow-delay=".4s"> <?php echo $post['topic'] ?></span></a>
                                    <?php endif ?>
                                    <div class="mb-10 wow fadeInLeft" data-wow-delay=".6s"><?php echo htmlspecialchars_decode($post['body_short']) ?></div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                                    <a class="mb-0" href="/blog?post-slug=<?php echo $post['slug']; ?>">
                                        <img class=" box-style p-0 blog-img wow fadeInRight mb-0" data-wow-delay=".4s" src="<?php echo $post['image']; ?>" alt="post-image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> <?php endforeach ?>
            </section>

        </div>
    </div>
</div>
