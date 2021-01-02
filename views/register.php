<?php

/** @var $model \app\models\User */

use \app\core\form\Form;

$this->title = "Register";

?>

<section class="form-section pt-50 pb-20 wow fadeInUp" data-wow-delay=".8s">
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-1  mx-auto"></div>
            <div class="col-xl-8 col-lg-8 col-md-10  mx-auto">
                <div class="container  box-style pt-15 pb-15">
                    <div class="row">
                        <div class="container">
                            <h2 class="mb-10 mt-10">Register on Cinemania</h2>
                            <?php $form = Form::begin('', "post") ?>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <?php echo $form->field($model, 'username') ?>
                                    <?php echo $form->field($model, 'email') ?>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <?php echo $form->field($model, 'password')->passwordField() ?>
                                    <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
                                </div>
                            </div>
                            <button type="submit" class="theme-btn mt-20 mb-20 wow fadeInUp float-right">Submit</button>
                            <?php Form::end() ?>
                        </div>
                        <div class="row">
                            <p class="wow fadeInUp" data-wow-delay="1.3s">Already a member? <a class="red" href="/login"> Sign in</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-1 mx-auto"></div>
        </div>
    </div>
</section>
