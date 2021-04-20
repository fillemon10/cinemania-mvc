 <?php $this->title = "About "; ?>
 <!-- ========================= feature-section start ========================= -->
 <section class="feature-section pt-40">
     <div class="container">
         <div class="row">
             <div class="col-xl-6 col-lg-7 col-md-9 mx-auto">
                 <div class="section-title text-center mb-55">
                     <span class="wow fadeInDown" data-wow-delay=".2s">Feature</span>
                     <h2 class="wow fadeInUp" data-wow-delay=".4s">Why Chose Us?</h2>
                     <p class="wow fadeInUp" data-wow-delay=".6s">We are expert in cinema and reviews.</p>
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-lg-4 col-md-6">
                 <div class="feature-box box-style">
                     <div class="feature-icon box-icon-style">
                         <i class="far fa-star"></i>
                     </div>
                     <div class="box-content-style feature-content">
                         <h4>High Quality Reviews</h4>
                         <p>We have the best reviews in the business. You will see when you read them.</p>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6">
                 <div class="feature-box box-style">
                     <div class="feature-icon box-icon-style">
                         <i class="fas fa-user-friends"></i>
                     </div>
                     <div class="box-content-style feature-content">
                         <h4>Community of Reviews</h4>
                         <p>We have created a large community of movie lovers. Good fanbase.</p>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4 col-md-6">
                 <div class="feature-box box-style">
                     <div class="feature-icon box-icon-style">
                         <i class="far fa-newspaper"></i>
                     </div>
                     <div class="box-content-style feature-content">
                         <h4>Real-time news update</h4>
                         <p>We cover all news cinema and film. We have corrosponders all over the industry.</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- ========================= feature-section end ========================= -->



 <!--========================= about-section start========================= -->
 <section id="about" class="pt-40 mb-150 mt-100">
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
                             
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!--========================= about-section end========================= -->
