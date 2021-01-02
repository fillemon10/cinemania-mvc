<?php

/** @var $this \app\core\View */

use app\core\Application;

$user = Application::$app->user;

?>
<?php include("includes/head.php"); ?>
<?php include("includes/navbar.php"); ?>
<?php include("includes/banner.php"); ?>

<section class="<?php echo $this->title ?>-section pb-20">
    <div class="container">
        <?php include("includes/success_message.php"); ?>
    </div>
    {{content}}
</section>

<?php include("includes/subscribe.php"); ?>
<?php include("includes/footer.php"); ?>
<?php include("includes/js.php"); ?>
