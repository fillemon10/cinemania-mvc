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
                                    <a class="page-scroll" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll dd-menu" href="/reviews">Reviews</a>

                                    <ul class="sub-menu">
                                        <li class="nav-item"><a href="/reviews/movies">Latests Movie</a></li>
                                        <li class="nav-item"><a href="/reviews/movies/best">Best Movies</a></li>
                                        <li class="nav-item"><a href="/reviews/series">Latests TV/Streaming</a></li>
                                        <li class="nav-item"><a href="/reviews/series/best">Best TV/Streaming</a></li>
                                        <li class="nav-item"><a href="/genres">Genres</a></li>
                                        <li class="nav-item"><a href="/reviews">All</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="/blog">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="/contact">Contact</a>
                                </li>                      <li class="nav-item">
                                <form action="search" class="search-form">
                                    <input name="search" type="text" placeholder="Search" />
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </li>
                                <?php if (Application::isGuest()) : ?>
                                    <li class="nav-item">
                                        <a class="page-scroll theme-btn login-btn" href="/login"><i class="fas fa-sign-in-alt"></i>&#8192;Login</a>
                                    </li>
                                <?php else : ?>
                                    <li class="nav-item">
                                        <a class="page-scroll dd-menu" href="javascript:void(0)"><?php echo $user->GetUsername() ?></a>

                                        <ul class="sub-menu">
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
