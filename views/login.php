<?php

/** @var $model \app\models\LoginForm */

use app\core\Application;
use app\core\form\Form;

$this->title = "Login";

?>

<section class="form-section pt-40 pb-20 ">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-8 mx-auto">
                <div class="container box-style">
                    <div class="row">
                        <div class="container ">
                            <h2 class="mb-20">Login on Cinemania</h2>
                            <?php $form = Form::begin('', 'post') ?>
                            <?php echo $form->field($model, 'email')->emailField() ?>
                            <?php echo $form->field($model, 'password')->passwordField() ?>
                            <div class="row">
                                <div class="col">
                                    <p class=" mt-35">Not yet a member? <a class="red" href="/register">Sign up</a></p>
                                    <a class="red text-right  mt-10" href="/forgot_password">Forgotten Password?</a></p>

                                </div>
                                <div class="col text-right">
                                    <button type="submit" class="theme-btn mt-20 mb-20  " name="login_btn">Login</button>
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
