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
 * Class SiteController
 *
 */
class SiteController extends Controller
{
    public function home()
    {
        $this->setLayout('home');

        return $this->render('home');
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function about()
    {
        return $this->render('about');
    }
}
