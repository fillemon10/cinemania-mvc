<?php

/** @var $this \app\core\View */

$this->title = "My Account";

use \app\core\Application;

$user = Application::$app->user;

?>

<section class="myaccount-section pb-10 pb-20">
    <div class="container  box-style pt-15">
        <div class="row">
            <div class="col-2">
                <ul>
                    <li>
                        <a class="red mt-10" href="/myaccount">Edit Account</a>
                    </li>
                    <li>
                        <a class="red mt-10" href="/myaccount/email_pref">Email Preferences</a>
                    </li>
                    <li>
                        <a class="red mt-10" href="/myaccount/contributions">View Contributions</a>
                    </li>
                    <li>
                        <a class="red mt-10" href="/myaccount/delete">Delete Account</a>
                    </li>
                </ul>
            </div>
            <div class="col-10">
                <h3 class="mt-10 mb-10">Delete Account</h3>
                <h5 class="mb-20">Please Contact us to remove your account</h5>
                <a href="/contact/" class="theme-btn">Contact</a>
            </div>
        </div>
    </div>
</section>
