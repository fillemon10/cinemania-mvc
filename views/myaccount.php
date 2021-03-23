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
                        <a class="red mt-10" href="/myaccount/edit">Edit Account</a>
                    </li>
                    <li>
                        <a class="red mt-10" href="/myaccount/email">Email Preferences</a>
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
                <h3 class="mt-10">Edit Account</h3>
                <ul>
                    <li>
                        <div class="mt-20 mb-20 row">
                            <div class="col-9">
                                <p>Username:</p>
                                <p><?php echo $user->getUsername() ?></p>
                            </div>
                            <div class="col-3">
                                <a href="javascript:void(0)" class="theme-btn float-right">Edit</a>
                            </div>
                        </div>
                        <hr>
                    </li>
                    <li>

                        <div class="mt-20 mb-20 row">
                            <div class="col-9">
                                <p>Email:</p>
                                <p><?php echo $user->getEmail() ?></p>
                            </div>
                            <div class="col-3">
                                <a href="javascript:void(0)" class="theme-btn float-right">Edit</a>
                            </div>
                        </div>
                        <hr>
                    </li>
                    <li>
                        <div class="mt-20 mb-20 row">
                            <div class="col-9">
                                <p>Password:</p>
                                <p>**********</p>
                            </div>
                            <div class="col-3">
                                <a href="javascript:void(0)" class="theme-btn float-right">Edit</a>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-20 mb-20 row">
                            <div class="col-9">
                                <p>Role:</p>
                                <p><?php echo $user->getRole() ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-20 mb-20 row">
                            <div class="col-9">
                                <p>Account created at:</p>
                                <p><?php echo $user->getCreated() ?></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>