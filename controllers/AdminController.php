<?php

namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

/**
 * Class AdminController
 *
 */
class AdminController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['admin']));
    }
    public function dashboard()
    {
        $this->setLayout('admin');

        return $this->render('admin/dashboard');
    }

    public function users()
    {
        $this->setLayout('admin');

        return $this->render('admin/users');
    }
    public function posts()
    {
        $this->setLayout('admin');

        return $this->render('admin/posts');
    }
    public function reviews()
    {
        $this->setLayout('admin');

        return $this->render('admin/reviews');
    }
}
