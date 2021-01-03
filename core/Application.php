<?php

namespace app\core;

use app\core\db\Database;
use app\core\db\DbModel;

class Application
{
    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    protected array $eventListeners;

    public static string $ROOT_DIR;

    public string $layout = "main";
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public static Application $app;
    public ?Controller $controller = null;
    public ?UserModel $user;
    public View $view;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->db = new Database($config['db']);

        $userId = Application::$app->session->get('user');
        if ($userId) {
            $key = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$key => $userId]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {

            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', ['exception' => $e]);
        }
    }

    public function getController(): \app\core\Controller
    {
        return $this->controller;
    }
    public function setController(\app\core\Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primary_key = $user->primaryKey();
        $value = $user->{$primary_key};
        Application::$app->session->set('user', $value);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function triggerEvent($event_name)
    {
        $callbacks = $this->eventListeners[$event_name] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }

    public function on($event_name, $callback)
    {
        $this->eventListeners[$event_name][] = $callback;
    }
}
