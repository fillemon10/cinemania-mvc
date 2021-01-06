<?php

/** @var $model \app\core\Model */

use app\core\form\Form;

$this->title = "Register";
$form = new Form();
?>

<section class="form-section pt-50 pb-20 wow fadeInUp" data-wow-delay=".8s">
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2 mx-auto"></div>
            <div class="col-xl-8 col-lg-8 col-md-8 mx-auto">
                <div class="container  box-style pt-15 pb-15">
                    <h2>Register on Cinemania</h2>
                    <?php $form = Form::begin('', 'post') ?>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <?php echo $form->field($model, 'username') ?>
                            <?php echo $form->field($model, 'email') ?>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <?php echo $form->field($model, 'password')->passwordField() ?>
                            <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
                            <button type="submit" class="theme-btn mt-20 mb-20 wow fadeInUp float-right" data-wow-delay="1.1s" name="reg_user">Register</button>
                        </div>
                        <?php Form::end() ?>

                    </div>
                    </form>
                    <div class="row">
                        <p class="wow fadeInUp text-right" data-wow-delay="1.3s">Already a member? <a class="red" href="/login"> Sign in</a></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 mx-auto"></div>
        </div>
    </div>
    </div>
</section>
