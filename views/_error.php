<?php

/** @var $exception \Exception */
$this->title = $exception->getCode();
?>
<section class="page-404-section pt-130 pb-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-404-content text-center">
                    <h3><?php echo $exception->getCode() ?> - <?php echo $exception->getMessage() ?></h3>
                    <?php if ($exception->getCode() === 404) :  ?>
                        <h4 class="mb-40">
                            <?php
                            echo $_SERVER['REQUEST_URI'];
                            ?> does not exist, sorry.</h4>
                    <?php endif ?>
                    <a href="/" class="mt-20 theme-btn">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</section>
