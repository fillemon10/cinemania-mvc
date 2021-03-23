<?php

/** @var $this \app\core\View */

use app\core\Application;

$user = Application::$app->user;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/animate.css" />
    <link rel="stylesheet" href="/assets/css/main.css" />
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <title><?php echo $titles ?> | Admin Cinemania</title>
    <meta name="description" content="" />
</head>
<?php include("includes/success_message.php"); ?>
<header class="header navbar-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="/admin/dashboard">
                        <img src="/assets/img/logo/logo_admin.svg" alt="Logo" /> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse sub-menu-bar justify-content-end" id="navbarSupportedContent">
                        <ul id="nav" class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="page-scroll dd-menu" href="javascript:void(0)">Manage Reviews</a>

                                <ul class="sub-menu">
                                    <li class="nav-item"><a href="/admin/create_review">Create Review</a></li>
                                    <li class="nav-item"><a href="/admin/reviews">Manage Reviews</a></li>
                                </ul>
                            <li class="nav-item">
                            </li>
                            <li class="nav-item">
                                <a class="page-scroll dd-menu" href="javascript:void(0)">Manage Blog</a>

                                <ul class="sub-menu">
                                    <li class="nav-item"><a href="/admin/create_post">Create Posts</a></li>
                                    <li class="nav-item"><a href="/admin/posts">Manage Posts</a></li>
                                    <li class="nav-item"><a href="/admin/topics">Manage Topics</a></li>
                                </ul>
                            <li class="nav-item">
                            </li>
                            <li class="nav-item">
                                <a href="/admin/users">Manage Users</a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/comments">Manage Comments</a>
                            </li>

                            <li class="nav-item">
                                <a class="page-scroll dd-menu" href="javascript:void(0)"><?php echo  $user->GetUsername()?></a>

                                <ul class="sub-menu">
                                    <li class="nav-item"> <a class="page-scroll" href="/myaccount"><i class="fas fa-cog dark-red"></i>&#8192;My Account</a></li>
                                    <li class="nav-item"> <a class="page-scroll" href="/"><i class="fas fa-arrow-circle-left dark-red"></i>&#8192;Back to Cinemania</a></li>
                                    <li class="nav-item"> <a class="page-scroll" href="/logout"><i class="fas fa-sign-out-alt dark-red"></i>&#8192;Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- navbar collapse -->
                </nav>
                <!-- navbar -->
            </div>
        </div>
    </div>
</header>
<section class="page-banner-section pt-30 pb-15 img-bg wow fadeInDown" data-wow-delay=".2s" style="background-image: url('/assets/img/bg/common-bg_admin.svg')">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="banner-content">
          <h2 class="text-white"><?php echo $this->title ?> </h2>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item wow fadeInLeft" data-wow-delay=".2s" aria-current="page"><a href="/dashboard">CineAdmin</a></li>
                <li class="breadcrumb-item active  wow fadeInLeft" data-wow-delay=".4s"" aria-current=" page"><?php echo $this->title ?> </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="<?php echo $this->title ?>-section pt-30">
    {{content}}
</section>

<?php include("includes/js.php"); ?>
