<?php

namespace app\core\middlewares;


use app\core\Application;
use app\core\exception\ForbiddenException;

/**
 * Class MemberMiddleware
 *
 */
class MemberMiddleware extends BaseMiddleware
{
    protected array $actions = [];

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                Application::$app->session->setFlash('success', 'You have to login to access this page');
                Application::$app->response->redirect('/login');
            }
        }
    }
}
