<?php

/** @var $this \app\core\View */

use app\core\Application;

$user = Application::$app->user;

?>
<?php include("includes/head.php"); ?>
<?php include("includes/success_message.php"); ?>
<?php include("includes/navbar.php"); ?>
<?php include("includes/banner.php"); ?>
<div class="container">

    <section class="<?php echo $this->title ?>-section pt-30">
        {{content}}
    </section>
</div>
    <?php include("includes/footer.php"); ?>
    <?php include("includes/js.php"); ?>
