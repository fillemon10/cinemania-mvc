<?php

/**
 * index.php
 * alla request går igenom denna fil
 */

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\controllers\BlogController;
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
        'url' => $_ENV["GOOGLE_REDIRECT_URI"]

    ]
];

//skapar en instans av applikationen
$app = new Application(dirname(__DIR__), $config);

//event listener, ska fixa
$app->on(Application::EVENT_BEFORE_REQUEST, function(){
   // echo "Before request from second installation";
});

//alla routes på webbplatsen
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/about', [SiteController::class, 'about']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);

$app->router->get('/blog', [BlogController::class, 'blog']);
$app->router->get('/blog/post', [BlogController::class, 'singlePost']);
$app->router->get('/blog/topic', [BlogController::class, 'topicFilter']);

//kör applikationen
$app->run();
