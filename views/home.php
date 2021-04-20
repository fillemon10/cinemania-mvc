<?php $this->title = "Home" ?>
<section id="home" class="hero-section">
    <div class="container">
        <div class="row w-50">
        </div>
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6">
                <div class="hero-content-wrapper">
                    <h2 class="mb-25 wow fadeInDown" data-wow-delay=".2s">Cinemania</h2>
                    <h1 class="mb-25 wow fadeInDown" data-wow-delay=".2s">Reviews Of <br>New And Old Movies</h1>
                    <p class="mb-35 wow fadeInLeft" data-wow-delay=".4s">
                        The #1 place to find good movies to watch
                    </p>
                    <a href="/reviews" class="theme-btn">Latests reviews</a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6">
                <div class="hero-img">
                    <div class="d-inline-block hero-img-right">
                        <?php if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) { ?>
                            <img src="https://res.cloudinary.com/daocxbh9k/image/upload/v1616534463/hero_wdbmad.webp" alt="projector" class="wow fadeInRight" data-wow-delay=".5s" />
                        <?php } else { ?>
                            <img src="https://res.cloudinary.com/daocxbh9k/image/upload/v1616534464/hero_ewnw87.png" alt="projector" class="wow fadeInRight" data-wow-delay=".5s" />
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================= hero-section end ========================= -->

<!-- ========================= recommendations-section start ========================= -->
<section class="feature-section pt-150">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
                <div class="section-title text-center mb-40">
                    <span class="wow fadeInDown" data-wow-delay=".2s">Recommendations</span>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Random Picks For You</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">
                        Read the review now, or watch the movie or series
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach ($reviews as $review) { ?>
                <div class="col mb-20 justify-content-center d-flex ">
                    <a class="mb-0" href="/review?r=<?php echo $review->slug; ?>">
                        <img class=" box-style p-0 wow fadeInRight mb-0 box-style" data-wow-delay=".4s" height=400px src="<?php echo $review->poster ?>" alt="post-image">
                        <p class="text-center"><?php echo $review->title_of ?></p>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- ========================= feature-section end ========================= -->

<!--========================= about-section start========================= -->
<section id="about" class="pt-40">
    <div class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-img-wrapper">
                        <div class="about-img position-relative d-inline-block wow fadeInLeft" data-wow-delay=".3s">
                            <?php if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) { ?>
                                <img src="https://res.cloudinary.com/daocxbh9k/image/upload/v1616534463/about_nb9zsn.webp" alt="cinema seats" class="wow fadeInLeft" data-wow-delay=".5s" />
                            <?php } else { ?>
                                <img src="https://res.cloudinary.com/daocxbh9k/image/upload/v1616534463/about_m06kgh.png" alt="cinema seats" class="wow fadeInLeft" data-wow-delay=".5s" />
                            <?php } ?>
                            <div class="about-experience">
                                <h3>We have the best reviews on the internet*</h3>
                                <p>*According to ourselves</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content-wrapper">
                        <div class="section-title">
                            <span class="wow fadeInUp" data-wow-delay=".2s">About Us</span>
                            <h2 class="mb-40 wow fadeInRight" data-wow-delay=".4s">Amazing review by amazing cinema
                                fanatics</h2>
                        </div>
                        <div class="about-content">
                            <p class="mb-45 wow fadeInUp" data-wow-delay=".6s">
                                We have crafted a community of real professional reviews and a user base of fans, who
                                also like to write reviews in our Member Reviews. Only avaible to logged in users. </p>
                            <div class="counter-up wow fadeInUp" data-wow-delay=".5s">
                                <div class="counter">
                                    <span id="secondo" class="countup count color-1" cup-end="30" cup-append="k">50+</span>
                                    <h4>Happy Users</h4>
                                    <p>Good reviews, so many great movies
                                    </p>
                                </div>
                                <div class="counter">
                                    <span id="secondo" class="countup count color-2" cup-end="42" cup-append="k"><?php echo $amout ?></span>
                                    <h4>Reviews Done</h4>
                                    <p>We have create <?php echo $amout ?> quality reviews
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--========================= about-section end========================= -->

<!-- ========================= news-section start ========================= -->
<section class="news-section pt-60">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
                <div class="section-title text-center mb-55">
                    <span class="wow fadeInDown" data-wow-delay=".2s">News</span>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">The Lastest News Posts</h2>
                    <p>We always report on all things cinema</p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach ($posts as $post) { ?>
                <div class="col mb-20">
                    <div class="justify-content-center d-flex box-style  mr-10">
                        <a class="mb-0" href="/post?p=<?php echo $post->slug; ?>">
                            <img class=" box-style p-0 wow fadeInRight mb-0" data-wow-delay=".4s" width="100%" height="300px" style="object-fit: cover;" src=" <?php echo $post->image ?>" alt="post-image">
                            <i class="p-mask fas fa-calendar-alt mt-20"></i>&#8192;<p style="display: inline;"><?php echo  date("F j, Y ", strtotime($post->created_at)); ?> </p>
                            <h5 class=""><?php echo $post->title ?></h5>
                            <p class="text-right mt-10"><i class="p-mask fas fa-user"></i>&#8192;<?php echo $post->{'username'}  ?></p>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
