<?php

namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\EmailForm;
use app\models\PasswordForm;
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
        //gör allt med myaccount att göra, otillgängligt för personer som inte har loggar in.
        $this->registerMiddleware(new AuthMiddleware(['myaccount']));
        $this->registerMiddleware(new AuthMiddleware(['editEmail']));
        $this->registerMiddleware(new AuthMiddleware(['editPassword']));
        $this->registerMiddleware(new AuthMiddleware(['emailPref']));
        $this->registerMiddleware(new AuthMiddleware(['contributions']));
        $this->registerMiddleware(new AuthMiddleware(['deleteAccount']));
    }

    //login funktionen
    public function login(Request $request)
    {
        $loginForm = new LoginForm();

        //när någon försöker logga in
        if ($request->isPost()) {
            $loginForm->loadData($request->getData());

            //validerar utifrån reglerna i LoginForm modellen. och sedan försöker logga in.
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->session->setFlash('success', 'You are now logged in');
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

        //om någon försöker registera sig
        if ($request->isPost()) {
            $registerModel->loadData($request->getData());

            //validerar utifrån reglerna i User modellen. och sedan skicka ett verifierings mail.
            if ($registerModel->validate() && $registerModel->sendVerify()) {

                //sparar användaren i databasen
                if ($registerModel->save()) {
                    Application::$app->session->setFlash('success', 'Please check your inbox to verify your account');
                    $this->setLayout('auth');
                    return $this->render('message', ["title" => "Verify account", "message" => "Please, check your inbox to verify your account."]);
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
        $this->setLayout('auth');

        //kollar om $_GET['t'] är satt, om den är satt så är det verifierings tokenen.
        if (isset($request->getData()["t"])) {
            $token = $request->getData()["t"];

            //letar efter användaren med den toknen
            $user = User::findOne(['verify_token' => $token]);
            if (!$user) {
                return $this->render('message', ["title" => "Verify account", "message" => "This verification token does not exist."]);
            } else {
                $user->verified = 1;
                $user->verify($token);
                Application::$app->session->setFlash('success', 'Your account is now verified, you can now login');
                Application::$app->response->redirect('/login');
            }
        }

        return $this->render('message', ["title" => "Verify account", "message" => "Please, check your inbox to verify your account."]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function myaccount()
    {
        $this->setLayout('onlybanner');

        return $this->render('myaccount');
    }
    public function myaccountDelete()
    {
        $this->setLayout('onlybanner');

        return $this->render('delete');
    }
    public function myaccountPref()
    {
        $this->setLayout('onlybanner');

        return $this->render('pref');
    }
    public function myaccountCon()
    {
        $this->setLayout('onlybanner');

        return $this->render('contributions');
    }

    public function forgotPassword(Request $request)
    {
        $this->setLayout('auth');

        $forgotPassword = new ForgotPassword();

        //om någon skickar förfrågan att få nytt lösenord
        if ($request->isPost()) {
            $forgotPassword->loadData($request->getData());

            //validera datan och skicka email för att ändra lösenord.
            if ($forgotPassword->validate() && $forgotPassword->sendEmail()) {
                $forgotPassword->used = 0;
                if ($forgotPassword->save()) {
                    Application::$app->session->setFlash('success', 'Please, check your inbox to recover your account');
                    return $this->render('message', ["title" => "Verify account", "message" => "Please, check your inbox to recover your account."]);
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

        //om någon skickat in nya lösenord
        if ($request->isPost()) {
            $model->loadData($request->getData());
            if ($model->validate()) {
                $model->email = Application::$app->session->get("reset_email");
                $model->user_id = Application::$app->session->get("reset_user_id");

                $model->updatePassword();

                //så tokenen inte går att använda igen
                $model->setUsed($model->email);
                Application::$app->session->setFlash('success', 'Your password is now reset, you can now login');
                Application::$app->session->remove("reset_user_id");
                Application::$app->response->redirect('/login');
            }
            return $this->render('reset', [
                'model' => $model
            ]);
        }

        //om man skrivit in en token i ?t=
        if (isset($request->getData()["t"])) {
            $token = $request->getData()["t"];

            $email = ForgotPassword::findOne(['token' => $token]);

            //om tokenen hittas
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
                } else {
                    return $this->render('message', ["title" => "Forgot Password", "message" => "Reset token already used."]);
                }
            }
        }


        return $this->render('reset_password');
    }


    //  KAN FÖRBÄTTRAS: 
    /*
        GÅR ATT BYTA TILL VILKEN ADDRESS MAN VILL.
        KAN LÅSA UT EN ANVÄNDARE OCKSÅ
    */

    public function editEmail(Request $request)
    {
        $emailForm = new EmailForm();

        //om någon vill ändra email
        if ($request->isPost()) {
            $emailForm->loadData($request->getData());
            //validera datan och hitta emailen
            if ($emailForm->validate() && $emailForm->findEmail()) {
                $emailForm->sendVerify();
                Application::$app->session->remove("user");

                Application::$app->session->setFlash('success', 'Please, check your inbox to verify your new email.');

                Application::$app->response->redirect('/myaccount/verify');
                return;
            }
        }
        $this->setLayout('onlybanner');
        return $this->render('edit_email', [
            'model' => $emailForm,
        ]);
    }

    public function editPassword(Request $request)
    {
        $passwordForm = new PasswordForm();
        
        //om någon vill ändra sitt lösenord
        if ($request->isPost()) {
            $passwordForm->loadData($request->getData());

            if ($passwordForm->validate() && $passwordForm->findPassword()) {
                $passwordForm->updatePassword();
                Application::$app->session->setFlash('success', 'Your password is now changed.');

                Application::$app->response->redirect('/myaccount');
                return;
            }
        }
        $this->setLayout('onlybanner');
        return $this->render('edit_password', [
            'model' => $passwordForm,
        ]);
    }
    public function myaccountVerify(Request $request)
    {
        //om tokenen är satt
        if (isset($request->getData()["t"])) {
            $token = $request->getData()["t"];
            $user = User::findOne(['verify_token' => $token]);
            if (!$user) {
                return $this->render('message', ["title" => "Verify account", "message" => "This verification token does not exist."]);
            } else {
                $user->verified = 1;
                $user->verify($token);
                $email = EmailForm::findOne(["currentEmail" => $user->email]);
                $user->updateEmail($email);
                Application::$app->session->setFlash('success', 'Your new email is now verified. Please login with your new email');
                Application::$app->response->redirect('/login');
            }
        }
        $this->setLayout('auth');
        return $this->render('message', ["title" => "Verify email", "message" => "Please, check your inbox to verify your new email."]);
    }
}
