<?php

use app\core\Application;

if (Application::$app->session->getFlash('success')) : ?>
    <div class="alert alert-success success position-absolute " role="alert">
        <?php echo Application::$app->session->getFlash('success') ?>
</div>
<?php endif ?>
