<?php

use app\core\Application;

if (Application::$app->session->getFlash('success')) : ?>
    <div class="alert alert-success success position-absolute " role="alert">
        <?php echo Application::$app->session->getFlash('success') ?>
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>

    </div>
<?php endif ?>
