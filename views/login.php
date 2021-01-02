<?php

/** @var $model \app\models\User */
$this->title = "Login";

use \app\core\form\Form;
?>

<section class="form-section pt-50 pb-20 wow fadeInUp" data-wow-delay=".8s">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-2 mx-auto"></div>
            <div class="col-xl-6 col-lg-6 col-md-8 mx-auto">
                <div class="container  box-style pt-15 pb-15">
                    <div class="row">
                        <div class="container">
                            <h2 class="mb-10 mt-10">Login on Cinemania</h2>
                            <?php $form = Form::begin('', "post") ?>
                            <?php echo $form->field($model, 'email') ?>
                            <?php echo $form->field($model, 'password')->passwordField() ?>
                            <button type="submit" class="theme-btn mt-20 mb-20 wow fadeInUp float-right">Login</button>
                            <?php Form::end() ?>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <p class="wow fadeInUp" data-wow-delay="1.3s">Not yet a member? <a class="red" href="/register">Sign up</a></p>

                            </div>
                            <div class="col-5">
                                <a class="red text-right wow fadeInUp float-right" data-wow-delay="1.3s" href="/forgot_password">Forgotten Password?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-2 mx-auto"></div>
        </div>
    </div>
</section>
