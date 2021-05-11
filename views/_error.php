<?php

/** @var $exception \Exception */
$this->title = $exception->getCode();
?>
<section class="page-404-section pt-100 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-404-content text-center">
                    <h2 class=""><?php echo $exception->getCode() ?></h2>
                    <h4 class=" ">
                        <?php echo $exception->getMessage() ?>
                </div>
            </div>
        </div>
    </div>
</section>
