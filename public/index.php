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

use app\core\Application;


// require autoloadaren
require_once __DIR__ . '/../vendor/autoload.php';

//hämtar .env filen
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ],
    'google' => [
        'client_id' => $_ENV["GOOGLE_CLIENT_ID"],
        'secret' => $_ENV["GOOGLE_SECRET"],
        'uri' => $_ENV["GOOGLE_REDIRECT_URI"]

    ]
];

//skapar en instans av applikationen
$app = new Application(dirname(__DIR__), $config);

//event listener, ska fixa
$app->on(Application::EVENT_BEFORE_REQUEST, function () {
    // echo "Before request from second installation";
});

//alla routes på webbplatsen

//basic
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/about', [SiteController::class, 'about']);

//login
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/myaccount', [AuthController::class, 'myaccount']);

//google login
$app->router->get('/register/google', [AuthController::class, 'googleRegister']);

//news
$app->router->get('/news', [NewsController::class, 'news']);
$app->router->get('/news/post', [NewsController::class, 'singlePost']);
$app->router->get('/news/topic', [NewsController::class, 'topicFilter']);

//reviews
$app->router->get('/reviews', [ReviewsController::class, 'reviews']);
$app->router->get('/reviews/review', [ReviewsController::class, 'singleReview']);
$app->router->get('/reviews/genre', [ReviewsController::class, 'genreFilter']);
$app->router->get('/reviews/type', [ReviewsController::class, 'typeFilter']);

//admin
$app->router->get('/admin', [AdminController::class, 'dashboard']);
$app->router->get('/admin/users', [AdminController::class, 'users']);
$app->router->get('/admin/posts', [AdminController::class, 'posts']);
$app->router->get('/admin/reviews', [AdminController::class, 'reviews']);

//kör applikationen
$app->run();
