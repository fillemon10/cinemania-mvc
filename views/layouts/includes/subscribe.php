<?php

use \app\core\Application;


if (isset($_POST['subs-email'])) {
    $email = $_POST['subs-email'];

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 50; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $token = $randomString;
    $statement = Application::$app->db->prepare("INSERT INTO newsletter (email, verify_token) VALUES (:email, :token)");
    $statement->bindValue(':email', $email);
    $statement->bindValue(':token', $token);
    $statement->execute();
    Application::$app->mail->send($email, "Confirm your subscription to Cinemania Newsletter", "Hello " . $email . "<br><br> Please confirm your subscription to the Cinemania Newsletter with this link: https://cinemania.sjolander.name/newsletter-confirm?t=" . $token . "<br><br> Please contact filip@sjolander.name if you believe this is an error.");
    Application::$app->session->setFlash('success', 'Please check your inbox to confirm your subscription to Cinemania Newsletter!');
    Application::$app->response->redirect("/newsletter-confirm");
}
?>
<div class="container pb-40">
    <section class="subscribe-section pt-70 pb-70 img-bg" style="background-image: url('/assets/img/bg/common-bg.svg')">
        <div class=" container subscribe-container">
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
</div>
