<?php

/** @var $model \app\models\MemberReviews 
 * 
 */

use app\core\form\Form;
use app\core\form\TextareaField;


$this->title = "Create Member Review" ?>
<div class="container mb-1o text-right">
</div>
<div class="container news-container">
    <div class="single-news all-published box-style ">

        <?php $form = Form::begin('', 'post') ?>
        <?php echo $form->field($model, 'title') ?>
        <?php echo $form->field($model, 'imdb_id') ?>
        <?php echo $form->field($model, 'our_rating') ?>
        <?php echo new TextareaField($model, 'body') ?>
        <div class="col text-right">
            <button type="submit" class="theme-btn mt-20 mb-20 wow fadeInUp " data-wow-delay="1.1s" name="login_btn">Create Review</button>
        </div>
    </div>
</div>
