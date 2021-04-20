 <?php $this->title = "Search: " . $search  ?>

 <div class="container">
     <h1>Reviews</h1>
     <?php if (count($reviews) == 0) {
            echo "<p class='mb-20'>No Reviews match your search query</p>";
        } else { ?>
         <?php foreach ($reviews as $review) : ?>
             <div class="container news-container">
                 <div class="single-news all-published box-style">
                     <div class="row">
                         <div class="col-xl-10 col-lg-8 col-md-8 section-title">
                             <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review["created_at"])); ?>/p>

                             <div class="row">
                                 <a class="mb-0" href="/review?r=<?php echo $review["slug"]; ?>">
                                     <h1 class="mb-0 wow fadeInLeft" data-wow-delay=".2s"> '<?php echo $review["title_of"] ?>':
                                         <?php echo $review["title"] ?></h1>
                                 </a>
                             </div>
                             <?php if ($review["type"] == 0) : ?>
                                 <a class="mb-10 mt-10" href="/type?t=0"><span class="wow fadeInLeft" data-wow-delay=".2s">Movie</span></a>
                             <?php else : ?>
                                 <a class="mb-10 mt-10" href="/type?t=1"><span class="wow fadeInLeft" data-wow-delay=".2s">TV/Streaming</span></a>
                             <?php endif ?>
                         </div>
                         <div class="col-xl-2 col-lg-4 col-md-4 text-right">
                             <a class="mb-0" href="/review?r=<?php echo $review["slug"]; ?>">
                                 <img class=" box-style p-0 wow fadeInRight mb-0" width=100% data-wow-delay=".4s" src="<?php echo $review["poster"] ?>" alt="post-image">
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
         <?php endforeach ?>
     <?php } ?>
     <h1>News Posts</h1>
     <?php if (count($posts) == 0) {
            echo "<p class='mb-20'>No News Posts match your search query</p>";
        } else { ?>
         <?php foreach ($posts as $post) : ?>
             <div class="container news-container">
                 <div class="single-news all-published box-style">
                     <div class="row">
                         <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                             <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($post["created_at"])); ?></p>

                             <div class="row">
                                 <a class="mb-0" href="/post?p=<?php echo $post["slug"]; ?>">
                                     <h2 class="mb-0 wow fadeInLeft" data-wow-delay=".2s"><?php echo $post["title"] ?></h2>
                                 </a>
                             </div>
                             <?php if (isset($post["topic"])) : ?>
                                 <a class="mb-0" href="/topic?t=<?php echo $post["topic_id"] ?>"> <span class="wow fadeInLeft" data-wow-delay=".4s"> <?php echo $post["topic"] ?></span></a>
                             <?php endif ?>
                         </div>
                         <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                             <a class="mb-0" href="/post?p=<?php echo $post["slug"]; ?>">
                                 <img class=" box-style p-0 news-img wow fadeInRight mb-0" width=10 data-wow-delay=".4s" src="<?php echo $post["image"] ?>" alt="post-image">
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
         <?php endforeach ?>
     <?php } ?>
     <h1>Member Reviews</h1>
     <?php if (count($member_reviews) == 0) {
            echo "<p class='mb-20'>No Member Reviews match your search query</p>";
        } else { ?>
         <?php foreach ($member_reviews as $review) : ?>
             <div class="container news-container">
                 <div class="single-news all-published box-style ">
                     <div class="row">
                         <div class="col-xl-8 col-lg-8 col-md-8 section-title">
                             <p class="wow fadeInDown" data-wow-delay=".4s"><i class="p-mask fas fa-calendar-alt"></i>&#8192;<?php echo date("F j, Y ", strtotime($review["created_at"])); ?></p>
                             <div class="row">
                                 <a class="mb-0 " href="/memberreview?r=<?php echo $review["slug"]; ?>">
                                     <h1 class="mb-0 wow fadeInLeft" data-wow-delay=".2s">'<?php echo $review["title_of"] ?>':
                                         <?php echo $review["title"] ?></h1>
                                 </a>
                             </div>
                             <?php if ($review["type"] == 0) : ?>
                                 <a class="mb-10 mt-10" href="/membertype?t=0"><span class="wow fadeInLeft" data-wow-delay=".2s">Movie</span></a>
                             <?php else : ?>
                                 <a class="mb-10 mt-10" href="/membertype?t=1"><span class="wow fadeInLeft" data-wow-delay=".2s">TV/Streaming</span></a>
                             <?php endif ?>
                         </div>
                         <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                             <a class="mb-0" href="/memberreview?r=<?php echo $review["slug"]; ?>">
                                 <img class=" box-style p-0 wow fadeInRight mb-0" width="50%" data-wow-delay=".4s" src="<?php echo $review["poster"] ?>" alt="post-image">
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
         <?php endforeach  ?>
     <?php } ?>
 </div>
