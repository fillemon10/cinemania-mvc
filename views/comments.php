<div class="row mt-10">
    <?php foreach ($comments as $comment) {?>
    
        <div class="container box-style comment mb-10 mt-10  ">
            <div class=" row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="row">
                        <p class="comment-info  ">
                            <i class="p-mask fas fa-user comment-info"></i>&#8192;<?php echo $comment["username"];   ?>&#8192;&#8192;<i class="p-mask fas fa-calendar-alt comment-info"></i>&#8192;<?php echo date("F j, Y ", strtotime($comment["created_at"])); ?>
                        </p>
                    </div>
                    <p class=""><?php echo $comment['text'] ?></p>
                </div>

            </div>
        </div>
    <?php } ?>
</div>
