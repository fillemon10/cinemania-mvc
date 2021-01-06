<?php

/** @var $model \app\core\Model */

use app\core\form\Form;

$form = new Form();
?>

<h1>Register</h1>

<?php $form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'firstname') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
<button class="btn btn-success">Submit</button>
<?php Form::end() ?>
