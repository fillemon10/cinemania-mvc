<?php

namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AdminMiddleware;
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
        //bara admin, author och moderator får komma åt de här sidorna.
        $this->registerMiddleware(new AdminMiddleware(['dashboard']));
        $this->registerMiddleware(new AdminMiddleware(['users']));
        $this->registerMiddleware(new AdminMiddleware(['posts']));
        $this->registerMiddleware(new AdminMiddleware(['reviews']));


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
