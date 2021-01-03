    <section id="review" class="review-section mt-100 pt-20 pb-20">
        <div class="container  box-style review-container wow fadeInUp">
            <div class="single-review pb-15">
                <div class="row">
                    <?php if (isset($review['published']) == false) : ?>
                        <h2>Sorry... This review has not been published</h2>
                        <div class="col-4 mt-20">
                            <a href="/reviews" class="theme-btn readmore-btn"><i class="fas fa-arrow-left"></i>&#8192;Back to review</a>
                        </div>
                    <?php else : ?>
                        <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                            <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review["created_at"])); ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $review["username"]  ?></p>
                            <?php
                            if (count($review["genre"]) > 1) {
                                foreach ($review["genre"] as $key => $genre) { ?>
                                    <a class="wow fadeInLeft mb-10 red" data-wow-delay=".6s" href="/genre/<?php echo strtolower($review["genre"][$key][0]) ?>"><?php echo $review["genre"][$key][0] ?></a>
                                <?php }
                            } else { ?>
                                <a class="wow fadeInLeft mb-10 red" data-wow-delay=".6s" href="/genre/<?php echo strtolower($review["genre"][0][0]) ?>"><?php echo $review["genre"][0][0] ?></a>
                            <?php } ?>
                            <h1 class="wow fadeInLeft" data-wow-delay=".2s"><?php echo "'" . $review["title_of"] . "' review: " . $review["title"] ?></h1>
                            <?php if ($review["type"] == 0) : ?>
                                <a class="mb-10 mt-10" href="/type/movie"><span class="wow fadeInLeft" data-wow-delay=".2s">Movie</span></a>
                            <?php else : ?>
                                <a class="mb-10 mt-10" href="/type/series"><span class="wow fadeInLeft" data-wow-delay=".2s">TV/Streaming</span></a>
                            <?php endif ?>


                            <div class="wow fadeInLeft" data-wow-delay=".6s"><?php echo htmlspecialchars_decode($review['body']) ?></div>
                            <p class="wow fadeInLeft mt-10" data-wow-delay=".6s"><strong>Plot: </strong><?php echo $review['plot'] ?></p>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class=" box-style ratings mb-20 wow fadeInRight" data-wow-delay=".7s">
                                <div class="row">
                                    <div class="col">
                                        <img class="rating-logo" src="/assets/img/logo/logo.svg" alt="cinemania-logo">
                                    </div>
                                    <div class="col">
                                        <h3 class="mb-0 text-right"><?php echo $review['our_rating'] ?>/10</h3>
                                    </div>
                                </div>
                            </div>
                            <div class=" box-style ratings wow fadeInRight" data-wow-delay=".9s">
                                <div class="row">
                                    <div class="col">
                                        <img src="/assets/img/logo/IMDb_logo.svg" height="48px" alt="IMDb-logo">
                                    </div>
                                    <div class="col">
                                        <h3 class="mb-0 text-right"><?php echo $review['imdb_rating'] ?></h3>
                                    </div>
                                </div>
                            </div>

                            <img class=" box-style p-0 poster-img wow fadeInRight" data-wow-delay="1s" src="<?php echo $review['poster']; ?>" alt="poster-<?php echo  str_replace(" ", "-", strtolower($review["title_of"])); ?>">
                        </div>
                </div>
                <!-- ========================= comment-section start ========================= -->
                <?php include("includes/comments.php") ?>
                <!-- ========================= comment-section end ========================= -->
            <?php endif ?>
            </div>
        </div>
    </section>
