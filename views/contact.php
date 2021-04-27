 <?php

    use app\core\Application;

    use app\core\form\Form;
    use app\core\form\TextareaField;


    $this->title = "Contact";

    ?>
 <section class="contact-section pt-10">
     <div class="container">
         <div class="row">
             <div class="col-xl-4">
                 <div class="contact-item-wrapper">
                     <div class="row">
                         <div class="col-12 col-md-6 col-xl-12">
                             <div class="contact-item">
                                 <div class="contact-icon">
                                     <i class="fas fa-phone-alt"></i>
                                 </div>
                                 <div class="contact-content">
                                     <h4>Contact</h4>
                                     <p>0724262038</p>
                                     <p>filip@sjolander.name</p>
                                 </div>
                             </div>
                         </div>
                         <div class="col-12 col-md-6 col-xl-12">
                             <div class="contact-item">
                                 <div class="contact-icon">
                                     <i class="fas fa-map-marked-alt"></i>
                                 </div>
                                 <div class="contact-content">
                                     <h4>Address</h4>
                                     <p>Kärnåsenvägen 5</p>
                                     <p>Hultafors, 517 96</p>
                                     <p>Sweden</p>
                                 </div>
                             </div>
                         </div>
                         <div class="col-12 col-md-6 col-xl-12">
                             <div class="contact-item">
                                 <div class="contact-icon">
                                     <i class="far fa-clock"></i>
                                 </div>
                                 <div class="contact-content">
                                     <h4>Shedule</h4>
                                     <p>Office time: 09:00 - 17:00</p>
                                     <p>Monday-Friday</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-8">
                 <div class="contact-form-wrapper pb-20">
                     <div class="row">
                         <div class="col-xl-10 col-lg-8 mx-auto">
                             <div class="section-title text-center mb-50">
                                 <span class="wow fadeInDown" data-wow-delay=".2s">Get in Touch</span>
                                 <h2 class="wow fadeInUp" data-wow-delay=".4s">Ready to Get Started</h2>
                                 <p class="wow fadeInUp" data-wow-delay=".6s">Do you have any question </p>
                             </div>
                         </div>
                     </div>
                     <?php $form = Form::begin('', 'post') ?>
                     <div class="row">
                         <div class="col-md-6">
                             <?php echo $form->field($model, 'name') ?>
                         </div>
                         <div class="col-md-6">
                             <?php echo $form->field($model, 'email')->emailField() ?>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <?php echo $form->field($model, 'phone') ?>
                         </div>
                         <div class="col-md-6">
                             <?php echo $form->field($model, 'subject') ?>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-12">
                             <?php echo new TextareaField($model, 'message') ?>
                         </div>
                     </div>
                     <div class="row mt-20 mb-0">
                         <div class="col-12">
                             <div class="button text-right">
                                 <button type="submit" class="theme-btn">Send Message</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <?php Form::end() ?>
             </div>
         </div>
     </div>
 </section>
 <!-- ========================= contact-section end ========================= -->

 <!-- ========================= map-section end ========================= -->
 <section class="map-section pt-30">
     <div class="map-container">
         <object style="border:0; height: 690px; width: 100%;" data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2132.1890210105207!2d12.732065116006867!3d57.696258381117495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x465007b77d195225%3A0x721832f89c4cb638!2zS8Okcm7DpXNlbnbDpGdlbiA1LCA1MTcgOTYgSHVsdGFmb3Jz!5e0!3m2!1sen!2sse!4v1613036215618"></object>
     </div>
     </div>
 </section>
 <!-- ========================= map-section end ========================= -->
