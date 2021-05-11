<?php

use app\core\Application;

?>

<body>
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="/">
                            <img src="/assets/img/logo/logo.svg" alt="Logo" />
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar float-right" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="page-scroll" href="/">&nbsp;<i class="fas fa-home"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll dd-menu" href="/reviews">Reviews</a>
                                    <ul class="sub-menu">
                                        <li class="nav-item"><a href="/reviews?type=0">Latests Movie Reviews</a></li>
                                        <li class="nav-item"><a href="/reviews?type=1">Latests TV/Streaming Reviews</a></li>
                                        <li class="nav-item"><a href="/reviews?genre=drama">Drama Reviews</a></li>
                                        <li class="nav-item"><a href="/reviews?genre=action">Action Reviews</a></li>
                                        <li class="nav-item"><a href="/reviews?genre=thriller">Thriller Reviews</a></li>
                                        <li class="nav-item"><a href="/reviews">All Reviews</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll dd-menu" href="/news">News</a>
                                    <ul class="sub-menu">
                                        <li class="nav-item"><a href="/news?topic=5">Latests New Releases</a></li>
                                        <li class="nav-item"><a href="/news?topic=4">Latests Cinema Talk</a></li>
                                        <li class="nav-item"><a href="/news">All News</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="/memberreviews">Member Reviews</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/contact">Contact</a>
                                </li>

                                <li class="nav-item">
                                    <form action="search" class="search-form">
                                        <input name="q" type="text" placeholder="Search" />
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </form>
                                </li>
                                <?php if (Application::isGuest()) : ?>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="/login">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll theme-btn login-btn" href="/register">Register</a>
                                    </li>
                                <?php else : ?>
                                    <li class="nav-item">
                                        <a class="page-scroll dd-menu" href="javascript:void(0)"><?php echo $user->GetUsername() ?></a>

                                        <ul class="sub-menu">
                                            <?php if (!Application::isMember()) : ?>
                                                <li class="nav-item"> <a class="page-scroll" href="/admin"><i class="fas fa-tools dark-red"></i>&#8192;CineAdmin</a></li>
                                            <?php endif ?>
                                            <li class="nav-item"> <a class="page-scroll" href="/myaccount"><i class="fas fa-cog dark-red"></i>&#8192;My Account</a></li>
                                            <li class="nav-item"> <a class="page-scroll" href="/logout"><i class="fas fa-sign-out-alt dark-red"></i>&#8192;Logout</a></li>
                                        </ul>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                        <!-- navbar collapse -->
                    </nav>
                    <!-- navbar -->
                </div>
            </div>
        </div>
    </header>
