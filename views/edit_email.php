<?php

/** @var $model \app\models\LoginForm */

use app\core\Application;
use app\core\form\Form;

$this->title = "Edit Email";

?>

<?php

/** @var $this \app\core\View */


$user = Application::$app->user;

?>

<section class="myaccount-section pb-10 pb-20">
    <div class="container  box-style pt-15">
        <div class="row">
            <div class="col-2">
                <ul>
                    <li>
                        <a class="red mt-10" href="/myaccount">Edit Account</a>
                    </li>
                    <li>
                        <a class="red mt-10" href="/myaccount/email_pref">Email Preferences</a>
                    </li>
                    <li>
                        <a class="red mt-10" href="/myaccount/contributions">View Contributions</a>
                    </li>
                    <li>
                        <a class="red mt-10" href="/myaccount/delete">Delete Account</a>
                    </li>
                </ul>
            </div>
            <div class="col-10">
                <h3 class="mb-20 mt-10">Set new Email</h3>
                <?php $form = Form::begin('', 'post') ?>
                <?php echo $form->field($model, 'currentEmail')->emailField() ?>
                <?php echo $form->field($model, 'newEmail')->emailField() ?>
                <?php echo $form->field($model, 'confirmNewEmail')->emailField() ?>

                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col text-right">
                        <button type="submit" class="theme-btn mt-20 mb-10  " name="login_btn">Change Email</button>
                    </div>
                </div>
                <div class="row">
                </div>
                <?php Form::end() ?>
            </div>
        </div>
    </div>
</section>
