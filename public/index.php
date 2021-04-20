<?php

/**
 * index.php
 * alla request går igenom denna fil
 */

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\controllers\NewsController;
use app\controllers\ReviewsController;
use app\controllers\AdminController;
use app\controllers\MemberReviewsController;


use app\core\Application;


// require autoloadaren
require_once __DIR__ . '/../vendor/autoload.php';

//hämtar .env filen
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$dotenv->load();
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ],
    'mail' => [
        'host' => $_ENV['MAIL_HOST'],
        'user' => $_ENV['MAIL_USERNAME'],
        'password' => $_ENV['MAIL_PASSWORD']
    ],
    'google' => [
        'client_id' => $_ENV["GOOGLE_CLIENT_ID"],
        'secret' => $_ENV["GOOGLE_SECRET"],
        'uri' => $_ENV["GOOGLE_REDIRECT_URI"]

    ],
    'omdb' => $_ENV["OMDB_APIKEY"]
];

//skapar en instans av applikationen
$app = new Application(dirname(__DIR__), $config);


//alla routes på webbplatsen

//basic
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/about', [SiteController::class, 'about']);

//login
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/register/verify', [AuthController::class, 'verify']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/myaccount', [AuthController::class, 'myaccount']);
$app->router->get('/forgot_password', [AuthController::class, 'forgotPassword']);
$app->router->post('/forgot_password', [AuthController::class, 'forgotPassword']);
$app->router->get('/reset', [AuthController::class, 'resetPassword']);
$app->router->post('/reset', [AuthController::class, 'resetPassword']);





//google login
$app->router->get('/register/google', [AuthController::class, 'googleRegister']);

//news
$app->router->get('/news', [NewsController::class, 'news']);
$app->router->get('/post', [NewsController::class, 'singlePost']);
$app->router->get('/topic', [NewsController::class, 'topicFilter']);

//reviews
$app->router->get('/reviews', [ReviewsController::class, 'reviews']);
$app->router->get('/review', [ReviewsController::class, 'singleReview']);
$app->router->get('/genre', [ReviewsController::class, 'genreFilter']);
$app->router->get('/type', [ReviewsController::class, 'typeFilter']);

//admin
$app->router->get('/admin', [AdminController::class, 'dashboard']);
$app->router->get('/admin/users', [AdminController::class, 'users']);
$app->router->get('/admin/posts', [AdminController::class, 'posts']);
$app->router->get('/admin/reviews', [AdminController::class, 'reviews']);

//Member Reviews
$app->router->get('/memberreviews', [MemberReviewsController::class, 'reviews']);
$app->router->get('/memberreviews/manage', [MemberReviewsController::class, 'manage']);
$app->router->get('/memberreviews/create', [MemberReviewsController::class, 'create']);
$app->router->post('/memberreviews/create', [MemberReviewsController::class, 'create']);


//search
$app->router->get('/search', [SiteController::class, 'search']);

//verify newsletter
$app->router->get('/newsletter-confirm', [SiteController::class, 'newsletter_verify']);

//kör applikationen
$app->run();
