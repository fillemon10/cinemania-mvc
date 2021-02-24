<?php

/** @var $model \app\models\LoginForm */

use app\core\Application;
use app\core\form\Form;

$this->title = "Login";

?>

<section class="form-section pt-50 pb-20 wow fadeInUp" data-wow-delay=".8s">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-2 mx-auto"></div>
            <div class="col-xl-6 col-lg-6 col-md-8 mx-auto">
                <div class="container  box-style pt-15 pb-15">
                    <div class="row">
                        <div class="container ">
                            <h2>Login on Cinemania</h2>
                            <a href="" class="btn btn-primary">Login with Google</a>
                            <?php $form = Form::begin('', 'post') ?>
                            <?php echo $form->field($model, 'email') ?>
                            <?php echo $form->field($model, 'password')->passwordField() ?>
                            <div class="row">
                                <div class="col">
                                    <p class="wow fadeInUp mt-35" data-wow-delay="1.3s">Not yet a member? <a class="red" href="/register">Sign up</a></p>
                                    <a class="red text-right wow fadeInUp mt-10" data-wow-delay="1.3s" href="/forgot_password">Forgotten Password?</a></p>

                                </div>
                                <div class="col">
                                    <button type="submit" class="theme-btn mt-20 mb-20 wow fadeInUp float-right" data-wow-delay="1.1s" name="login_btn">Login</button>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <?php Form::end() ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-2 mx-auto"></div>
        </div>
    </div>
</section>
