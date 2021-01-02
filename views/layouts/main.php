<?php

/** @var $this \app\core\View */

use app\core\Application;

$user = Application::$app->user;

?>
<?php include("includes/head.php"); ?>
<?php include("includes/navbar.php"); ?>
<?php include("includes/banner.php"); ?>

<section class="<?php echo $this->title ?>-section pt-50 pb-20">
    <?php include("includes/success_message.php"); ?>
    {{content}}
</section>

<?php include("includes/subscribe.php"); ?>
<?php include("includes/footer.php"); ?>
<?php include("includes/js.php"); ?>
