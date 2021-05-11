 <?php

    use app\core\Application;
    use app\core\form\Form;
    use app\core\form\TextareaField;

    $this->title = "'" . $review->title_of . "' review: " . $review->title; ?>
 <section id="review" class="review-section mt-100 pt-20 pb-20">
     <div class="container  box-style review-container ">
         <div class="single-review pb-15">
             <div class="row">
                 <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                     <p class=""><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review->created_at)); ?>&#8192;&#8192;<i class="p-mask fas fa-user"></i>&#8192;<?php echo $review->username ?></p>
                     <?php if (count((array)$review->genres) > 1) { ?>
                         <?php foreach ($review->genres as $key => $genre) { ?>
                             <a class=" mb-10 red" href="/reviews?genre=<?php echo strtolower($review->genres[$key]["genre"]) ?>"><?php echo $review->genres[$key]["genre"] ?></a>
                         <?php }
                        } else { ?>
                         <a class=" mb-10 red" href="/reviews?genre=<?php echo strtolower($review->genres[0]["genre"]) ?>"><?php echo $review->genres[0]["genre"] ?></a>
                     <?php } ?>
                     <h1 class=""><?php echo "'" . $review->title_of . "' review: " . $review->title ?></h1>
                     <?php if ($review->type == 0) : ?>
                         <a class="mb-10 mt-10" href="/reviews?type=0"><span class="">Movie</span></a>
                     <?php else : ?>
                         <a class="mb-10 mt-10" href="/reviews?type=1"><span class="">TV/Streaming</span></a>
                     <?php endif ?>


                     <p class=""><?php echo $review->body ?></p>
                     <p class=" mt-10"><strong>Plot: </strong><?php echo $movie['Plot'] ?></p>
                 </div>
                 <div class="col-xl-4 col-lg-4 col-md-4">
                     <div class=" box-style ratings mb-20 ">
                         <div class="row">
                             <div class="col">
                                 <img class="rating-logo" src="/assets/img/logo/logo.svg" alt="cinemania-logo">
                             </div>
                             <div class="col">
                                 <h3 class="mb-0 text-right"><?php echo $review->{'our_rating'} ?>/10</h3>
                             </div>
                         </div>
                     </div>
                     <div class=" box-style ratings ">
                         <div class="row">
                             <div class="col">
                                 <img src="/assets/img/logo/IMDb_logo.svg" height="48px" alt="IMDb-logo">
                             </div>
                             <div class="col">
                                 <h3 class="mb-0 text-right"><?php echo $movie['Ratings'][0]["Value"] ?></h3>
                             </div>
                         </div>
                     </div>

                     <img class=" box-style p-0 poster-img " src="<?php echo $review->poster; ?>" alt="poster-<?php echo  str_replace(" ", "-", strtolower($review->{"title_of"})); ?>">
                 </div>
             </div>
             <div class="row box-style">
                 <?php $form = Form::begin('', 'post') ?>
                 <?php echo new TextareaField($commentModel, 'text')  ?>
                 <div class="row">
                     <div class="col text-right">
                         <button type="submit" class="theme-btn mt-20 mb-20  " name="comment">Comment</button>
                     </div>
                 </div>
                 <div class="row">
                 </div>
                 <?php Form::end() ?>
             </div>
             <?php include(Application::$ROOT_DIR . "/views/comments.php"); ?>
         </div>


     </div>
 </section>
