<?php $this->title = "Home" ?>
<section id="home" class="hero-section">
  <div class="container">
    <div class="row w-50">
    </div>
    <div class="row align-items-center">
      <div class="col-xl-5 col-lg-6">
        <div class="hero-content-wrapper">
          <h2 class="mb-25 wow fadeInDown" data-wow-delay=".2s">Cinemania</h2>
          <?php if (isset($_SESSION['user']['username'])) { ?>
            <h1 class="mb-25 wow fadeInDown" data-wow-delay=".2s">Welcome to Cinemania, <?php echo $_SESSION['user']['username'] ?>!</h1>
            <p class="mb-35 wow fadeInLeft" data-wow-delay=".4s">
              What will you watch today?
            </p>
            <a href="/reviews" class="theme-btn">Latests reviews</a>
        </div>
      <?php } else { ?>
        <h1 class="mb-25 wow fadeInDown" data-wow-delay=".2s">Reviews Of <br>New And Old Movies</h1>
        <p class="mb-35 wow fadeInLeft" data-wow-delay=".4s">
          The #1 place to find good movies to watch
        </p>
        <a href="/reviews" class="theme-btn">Latests reviews</a>
      </div>
    <?php } ?>
    </div>
    <div class="col-xl-7 col-lg-6">
      <div class="hero-img">
        <div class="d-inline-block hero-img-right">
          <?php if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) { ?>
            <img src="https://res.cloudinary.com/daocxbh9k/image/upload/v1609332071/hero-img_tyib9b.webp" alt="projector" class="wow fadeInRight" data-wow-delay=".5s" />
          <?php } else { ?>
            <img src="https://res.cloudinary.com/daocxbh9k/image/upload/v1609332071/hero-img_elulau.png" alt="projector" class="wow fadeInRight" data-wow-delay=".5s" />
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
        <div class="section-title text-center mb-55">
          <span class="wow fadeInDown" data-wow-delay=".2s">Recommendations</span>
          <h2 class="wow fadeInUp" data-wow-delay=".4s">Our Top Picks</h2>
          <p class="wow fadeInUp" data-wow-delay=".6s">
            The authors at Cinemania have hand picked these recommendations
          </p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class=" box-style text-center">
          <p>Movie 1</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class=" box-style text-center">
          <p>Movie 2</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class=" box-style text-center">
          <p>Movie 3</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ========================= feature-section end ========================= -->

<!--========================= about-section start========================= -->
<section id="about" class="pt-100">
  <div class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-lg-6">
          <div class="about-img-wrapper">
            <div class="about-img position-relative d-inline-block wow fadeInLeft" data-wow-delay=".3s">
              <?php if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) { ?>
                <img src="https://res.cloudinary.com/daocxbh9k/image/upload/v1609332077/about-img_wmzk3b.webp" alt="cinema seats" class="wow fadeInLeft" data-wow-delay=".5s" />
              <?php } else { ?>
                <img src="https://res.cloudinary.com/daocxbh9k/image/upload/v1609332077/about-img_a5umkh.png" alt="cinema seats" class="wow fadeInLeft" data-wow-delay=".5s" />
              <?php } ?>
              <div class="about-experience">
                <h3>5 Year Of Working Experience</h3>
                <p>We Crafted an aweso design library that is robust and intuitive to use.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6">
          <div class="about-content-wrapper">
            <div class="section-title">
              <span class="wow fadeInUp" data-wow-delay=".2s">About Us</span>
              <h2 class="mb-40 wow fadeInRight" data-wow-delay=".4s">Built-With Boostrap 5, a New Experiance</h2>
            </div>
            <div class="about-content">
              <p class="mb-45 wow fadeInUp" data-wow-delay=".6s">
                We Crafted an awesome design library that is robust and intuitive to use. No matter you're building
                a business presentation websit or a complex web application our design
              </p>
              <div class="counter-up wow fadeInUp" data-wow-delay=".5s">
                <div class="counter">
                  <span id="secondo" class="countup count color-1" cup-end="30" cup-append="k">10</span>
                  <h4>Happy Client</h4>
                  <p>
                    We Crafted an awesome design <br class="d-none d-md-block d-lg-none d-xl-block" />
                    library that is robust and
                  </p>
                </div>
                <div class="counter">
                  <span id="secondo" class="countup count color-2" cup-end="42" cup-append="k">5</span>
                  <h4>Project Done</h4>
                  <p>
                    We Crafted an awesome design <br class="d-none d-md-block d-lg-none d-xl-block" />
                    library that is robust and
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

<!-- ========================= blog-section start ========================= -->
<section id="blog" class="blog-section pt-130 pb-80">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
        <div class="section-title text-center mb-55">
          <span class="wow fadeInDown" data-wow-delay=".2s">Blog</span>
          <h2 class="wow fadeInUp" data-wow-delay=".4s">The Latests Blog Posts</h2>
          <p class="wow fadeInUp" data-wow-delay=".6s">
            At vero eos et accusamus et iusto odio dignissimos ducimus quiblanditiis praesentium
          </p>
        </div>
      </div>
    </div>
    <div class="row ">
  <!--    <?php// for ($i = 0; $i < 3; $i++) : ?>
        <div class="col-lg-4 col-md-8 col-xl-4 blog-col-index">
          <div class="container  box-style blog-container wow fadeInup" data-wow-delay=".2s">
            <div class="single-blog all-published blog-index-post">
              <img class="blog-img wow fadeInRight mb-10" data-wow-delay=".4s" src="<?php //echo $posts[$i]['image']; ?>" alt="post-image">
              <h3 class="wow fadeInLeft" data-wow-delay=".2s"><?php// echo $posts[$i]['title'] ?></h3>
              <?php// if (isset($posts[$i]['topic']['name'])) : ?>
                <div class="row">
                  <a class="mb-10" href="/topic/<?php //$posts[$i]['topic']['id'] ?>"> <span class="wow fadeInLeft red" data-wow-delay=".4s"> <?php //echo $posts[$i]['topic']['name'] ?></span></a>
                </div>
              <?php //endif ?>
              <p class="wow fadeInLeft" data-wow-delay=".6s"><?php //echo //shorten_string($posts[$i]['body'], 20) ?></p>
              <div class="row mt-10 blog-btn-index">
                <div class="col-xl-8 col-lg-8 col-md-8">
                  <a href="/post/<?php //echo $posts[$i]['slug']; ?>" class="theme-btn readmore-btn wow fadeInUp" data-wow-delay=".8s">Read more</a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                  <p class="wow fadeInUp" data-wow-delay=".8s"><?php //echo date("F j, Y ", strtotime($posts[$i]["created_at"])); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php //endfor ?> ->>
    </div>
</section>
<!-- ========================= blog-section end ========================= -->
