<?php

/** @var $model \app\models\MemberReviews 
 * 
 */

use app\core\form\Form;
use app\core\form\TextareaField;


$this->title = $title ?>
<div class="container mb-1o text-right">
</div>
<div class="container news-container">
    <div class="single-news all-published box-style ">

        <?php $form = Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'title') ?>
        <?php echo $form->field($model, 'imdb_id') ?>
        <?php echo $form->field($model, 'our_rating')->numberField("\" min=\"1\" max=\"10\"") ?>
        <?php echo new TextareaField($model, 'body') ?>
        <div class="col text-right">
            <button type="submit" class="theme-btn mt-20 mb-20  "><?php echo $button ?></button>
        </div>
        <?php Form::end() ?>

    </div>
</div>
