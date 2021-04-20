<?php

/** @var $model \app\models\LoginForm */

use app\core\Application;
use app\core\form\Form;

$this->title = "Forgot Password";

?>

<section class="form-section pt-40 pb-20 wow fadeInUp" data-wow-delay=".8s">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-8 mx-auto">
                <div class="container box-style">
                    <div class="row">
                        <div class="container ">
                            <h2 class="mb-20">Set new Password</h2>
                            <?php $form = Form::begin('', 'post') ?>
                            <?php echo $form->field($model, 'password')->passwordField() ?>
                            <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>

                            <div class="row">
                                <div class="col">

                                </div>
                                <div class="col text-right">
                                    <button type="submit" class="theme-btn mt-20 mb-20 wow fadeInUp " data-wow-delay="1.1s" name="login_btn">Change Password</button>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <?php Form::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
