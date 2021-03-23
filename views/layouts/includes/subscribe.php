<?php

use \app\core\Application;


if (isset($_POST['subs-email'])) {
    $email = $_POST['subs-email'];
    $statement = Application::$app->db->prepare("INSERT INTO newsletter (email) VALUES (:email)");
    $statement->bindValue(':email', $email);
    $statement->execute();
    Application::$app->session->setFlash('success', 'Thanks for registering to the newsletter!');
    Application::$app->response->redirect("#");
}
?>

<section class="subscribe-section pt-70 pb-70 img-bg" style="background-image: url('/assets/img/bg/common-bg.svg')">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="section-title mb-30">
                    <span class="text-white wow fadeInDown" data-wow-delay=".2s">Subscribe</span>
                    <h2 class="text-white mb-40 wow fadeInUp" data-wow-delay=".4s">Subscribe To Our Newsletter</h2>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <form action="" method="POST" class="subscribe-form wow fadeInRight" data-wow-delay=".4s">
                    <input type="text" name="subs-email" id="subs-email" placeholder="Your Email" />
                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>
