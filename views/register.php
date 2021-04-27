<?php

/** @var $model \app\core\Model */

use app\core\form\Form;

$this->title = "Register";
$form = new Form();
?>
<section class="form-section pt-40 pb-20 wow fadeInUp" data-wow-delay=".8s">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-8 mx-auto">
                <div class="container  box-style">
                    <div class="row">
                        <div class="container">
                            <h2 class="mb-20">Register on Cinemania</h2>
                            <?php $form = Form::begin('', 'post') ?>
                            <?php echo $form->field($model, 'username') ?>
                            <?php echo $form->field($model, 'email')->emailField() ?>
                            <?php echo $form->field($model, 'password')->passwordField() ?>
                            <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
                            <div class="row">
                                <div class="col">
                                    <p class="wow fadeInUp text-left mt-35" data-wow-delay="1.3s">Already a member? <a
                                            class="red" href="/login"> Sign in</a></p>
                                </div>
                                <div class="col text-right">
                                    <button type="submit" class="theme-btn mt-20 mb-20 wow fadeInUp"
                                        data-wow-delay="1.1s" name="reg_user">Register</button>
                                </div>
                            </div>
                            <?php Form::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
