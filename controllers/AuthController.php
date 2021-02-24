<?php

namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\GoogleAuth;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

/**
 * AuthController Class
 */
class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['myaccount']));
    }

    public function login(Request $request)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getData());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm,
        ]);
    }

    public function register(Request $request)
    {
        $registerModel = new User();
        if ($request->isPost()) {
            $registerModel->loadData($request->getData());
            if ($registerModel->validate() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
                return 'Show success page';
            }
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function myaccount()
    {
        return $this->render('myaccount');
    }

    public function googleRegister() {
        echo '<pre>';
        var_dump(Application::$app->google_auth->auth());
        echo '</pre>';
        exit;
        Application::$app->google_auth->auth();
        
        return $this->render('google', [
        ]);
    }
}
