 <?php

use app\core\Application;

$this->title = "'" . $review->title_of . "' review: " . $review->title; ?>
 <section id="review" class="review-section mt-100 pt-20 pb-20">
     <div class="container  box-style review-container wow fadeInUp">
         <div class="single-review pb-15">
             <div class="row">
                 <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                     <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review->created_at)); ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $review->username ?></p>
                     <?php if (count((array)$review->genres) > 1) { ?>
                         <?php foreach ($review->genres as $key => $genre) { ?>
                             <a class="wow fadeInLeft mb-10 red" data-wow-delay=".6s" href="/genre?g=<?php echo strtolower($review->genres[$key]["genre"]) ?>"><?php echo $review->genres[$key]["genre"] ?></a>
                         <?php }
                        } else { ?>
                         <a class="wow fadeInLeft mb-10 red" data-wow-delay=".6s" href="/genre?g=<?php echo strtolower($review->genres[0]["genre"]) ?>"><?php echo $review->genres[0]["genre"] ?></a>
                     <?php } ?>
                     <h1 class="wow fadeInLeft" data-wow-delay=".2s"><?php echo "'" . $review->title_of . "' review: " . $review->title ?></h1>
                     <?php if ($review->type == 0) : ?>
                         <a class="mb-10 mt-10" href="/type?t=0"><span class="wow fadeInLeft" data-wow-delay=".2s">Movie</span></a>
                     <?php else : ?>
                         <a class="mb-10 mt-10" href="/type?t=1"><span class="wow fadeInLeft" data-wow-delay=".2s">TV/Streaming</span></a>
                     <?php endif ?>


                     <div class="wow fadeInLeft" data-wow-delay=".6s"><?php echo htmlspecialchars_decode($review->body) ?></div>
                     <p class="wow fadeInLeft mt-10" data-wow-delay=".6s"><strong>Plot: </strong><?php echo $movie['Plot'] ?></p>
                 </div>
                 <div class="col-xl-4 col-lg-4 col-md-4">
                     <div class=" box-style ratings mb-20 wow fadeInRight" data-wow-delay=".7s">
                         <div class="row">
                             <div class="col">
                                 <img class="rating-logo" src="/assets/img/logo/logo.svg" alt="cinemania-logo">
                             </div>
                             <div class="col">
                                 <h3 class="mb-0 text-right"><?php echo $review->{'our_rating'} ?>/10</h3>
                             </div>
                         </div>
                     </div>
                     <div class=" box-style ratings wow fadeInRight" data-wow-delay=".9s">
                         <div class="row">
                             <div class="col">
                                 <img src="/assets/img/logo/IMDb_logo.svg" height="48px" alt="IMDb-logo">
                             </div>
                             <div class="col">
                                 <h3 class="mb-0 text-right"><?php echo $movie['Ratings'][0]["Value"] ?></h3>
                             </div>
                         </div>
                     </div>

                     <img class=" box-style p-0 poster-img wow fadeInRight" data-wow-delay="1s" src="<?php echo $review->poster; ?>" alt="poster-<?php echo  str_replace(" ", "-", strtolower($review->{"title_of"})); ?>">
                 </div>
             </div>
         <?php include(Application::$ROOT_DIR . "/views/comments.php"); ?>
         </div>


     </div>
 </section>
