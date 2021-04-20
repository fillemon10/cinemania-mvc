<?php

namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\GoogleAuth;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\ForgotPassword;
use app\models\LoginForm;
use app\models\ResetPassword;
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
            if ($registerModel->validate() && $registerModel->sendVerify()) {
                if ($registerModel->save()) {
                    Application::$app->session->setFlash('success', 'Please check your inbox to verify your account');
                    $this->setLayout('home');
                    return $this->render('home');
                }
            }
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function verify(Request $request)
    {
        if (isset($request->getData()["t"])) {
            $token = $request->getData()["t"];
            $user = User::findOne(['verify_token' => $token]);
            if (!$user) {
                echo "This verification token does not exist.";
            } else {
                $user->verified = 1;
                $user->verify($token);
                Application::$app->session->setFlash('success', 'Your account is now verified, you can now login');
                Application::$app->response->redirect('/login');
            }
        }
        $this->setLayout('auth');

        return $this->render('verify');
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

    public function googleRegister()
    {
        echo '<pre>';
        var_dump(Application::$app->google_auth->auth());
        echo '</pre>';
        exit;
        Application::$app->google_auth->auth();

        return $this->render('google', []);
    }
    public function forgotPassword(Request $request)
    {
        $this->setLayout('auth');

        $forgotPassword = new ForgotPassword();
        if ($request->isPost()) {
            $forgotPassword->loadData($request->getData());
            if ($forgotPassword->validate() && $forgotPassword->sendEmail()) {
                if ($forgotPassword->save()) {
                    Application::$app->session->setFlash('success', 'Please check your inbox to recover your account');
                    return $this->render('forgot_password_sent');
                }
            }
        }

        return $this->render('forgot_password', [
            'model' => $forgotPassword,
        ]);
    }
    public function resetPassword(Request $request)
    {
        $model = new ResetPassword();
        $this->setLayout('auth');

        if ($request->isPost()) {
            $model->loadData($request->getData());
            if ($model->validate()) {
                $model->email = Application::$app->session->get("reset_email");
                $model->user_id = Application::$app->session->get("reset_user_id");

                $model->updatePassword();
                $model->setUsed($model->email);
                Application::$app->session->setFlash('success', 'Your password is now reset, you can now login');
                Application::$app->session->remove("reset_user_id");
                Application::$app->response->redirect('/login');
            }
            return $this->render('reset', [
                'model' => $model
            ]);
        }
        if (isset($request->getData()["t"])) {
            $token = $request->getData()["t"];

            $email = ForgotPassword::findOne(['token' => $token]);

            if ($email) {
                if ($email->used == 0) {
                    $user = User::findOne(['email' => $email->email]);
                    if ($user) {
                        Application::$app->session->set("reset_email", $user->email);
                        Application::$app->session->set("reset_user_id", $user->id);

                        return $this->render('reset', [
                            'model' => $model
                        ]);
                    }
                }
            }
        }


        return $this->render('reset_password');
    }
}
