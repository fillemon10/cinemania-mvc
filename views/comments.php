<div class="row mt-20">
    <h3 class="mb-0">Comments</h3>
    <form class="box-style mb-10 pb-20 mt-10 wow fadeInUp" action="" method="POST">
        <h5 class=" wow fadeInLeft" data-wow-delay="0.5s">Leave a comment</h5>
        <div class=" form-group">
            <textarea class="form-control box-style wow fadeInLeft" data-wow-delay="0.5s" name="comment_<?php echo $review_or_post ?>_text" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 138px;"></textarea>
        </div>
        <button type="submit" class="theme-btn mt-10  wow fadeInLeft" data-wow-delay="0.5s" name="comment_<?php echo $review_or_post ?>_btn">Post Comment</button>
    </form>
    <?php foreach ($comments as $comment) { ?>
        <div class="container box-style comment mb-10 mt-10 wow fadeInDown " data-wow-delay=".1s">
            <div class=" row">
                <div class="col-xl-10 col-lg-10 col-md-10">
                    <div class="row">
                        <p class="comment-info wow fadeInDown " data-wow-delay=".1s">
                            <i class="p-mask fas fa-user comment-info"></i>&#8192;<?php echo $comment["username"];   ?>&#8192;&#8192;<i class="p-mask fas fa-calendar-alt comment-info"></i>&#8192;<?php echo date("F j, Y ", strtotime($comment["created_at"])); ?>
                        </p>
                    </div>
                    <p class="wow fadeInDown" data-wow-delay=".3s"><?php echo $comment['text'] ?></p>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2">
                    <button class="float-right reply-btn <?php echo $comment['id'] ?>">
                        <i class="fas fa-reply"></i>
                    </button>
                </div>
            </div>
            <div hidden class="container reply-form box-style mb-10 pb-15 pt-15" style="animation-name: fadeInUp;">
                <h5 class="mb-10">Leave a reply</h5>
                <div class="row">
                    <?php
                    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');

                    ?>
                    <form action="<?php echo $escaped_url  ?>&reply-<?php echo $review_or_post ?>=<?php echo $comment['id'] ?>" method="POST">
                        <div class="form-group">
                            <textarea class="form-control box-style" name="reply_<?php echo $review_or_post ?>_text" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 138px;"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-10"></div>
                            <div class="col-2">
                                <button type="submit" class="theme-btn mt-10 mb-10 post-reply float-right" name="reply_<?php echo $review_or_post ?>_btn">Reply</button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <?php
            foreach ($replies as $reply) { 
                if ($reply["comment_id"] == $comment["id"]) {?>
            
                <div class="row ">
                    <div class="col-xl-1 col-lg-1 col-md-1 pr-0 pl-0">
                    </div>
                    <div class="col-xl-11 col-lg-11 col-md-11 pl-0">
                        <div class="container box-style comment reply mt-10 mb-0 wow fadeInDown " data-wow-delay=".3s">
                            <div class="row">
                                <div class="col-xl-10 col-lg-10 col-md-10">
                                    <div class="row">
                                        <p class="wow fadeInDown comment-info" data-wow-delay=".1s">
                                            <i class="p-mask fas fa-user comment-info"></i>&#8192;<?php echo $reply["username"];   ?>&#8192;&#8192;<i class="p-mask fas fa-calendar-alt comment-info"></i>&#8192;<?php echo date("F j, Y ", strtotime($reply["created_at"])); ?>
                                        </p>
                                    </div>
                                    <p class="wow fadeInDown" data-wow-delay=".3s"><?php echo $reply['text'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }} ?>
        </div>
    <?php } ?>
</div>
<script src="/assets/js/reply.js"></script>
