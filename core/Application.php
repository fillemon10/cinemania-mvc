<?php

namespace app\core;

use app\core\db\Database;
use app\models\User;

/**
 * Class Application
 *
 */
class Application
{
    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    protected array $eventListeners = [];

    public static Application $app;
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public View $view;
    public ?UserModel $user;
    public GoogleAuth $google_auth;
    public static string $omdbAPIkey;

    public function __construct($rootDir, $config)
    {
        //sätter user till null
        $this->user = null;

        self::$ROOT_DIR = $rootDir;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);

        //skapar PDO connection
        $this->db = new Database($config['db']);

        //omdb Api Key
        self::$omdbAPIkey = $config['omdb'];


        //$this->google_auth = new GoogleAuth($config['google']);

        $this->session = new Session();
        $this->view = new View();

        //hämtar user id från session user
        $userId = Application::$app->session->get('user');

        //om user id är satt
        if ($userId) {
            //sätter user till user där id är session user (se rad 79-80 för förklaring)
            $this->user = User::findOne(['id' => $userId]);
        }

    }

    //kollar om personen är guest eller inloggad
    public static function isGuest()
    {
        //return true om user inte är satt
        return !self::$app->user;
    }

    //inloggings funktionen
    public function login(UserModel $user)
    {
        //sätter applikationens user till UserModel user
        $this->user = $user;

        //hämtar primary key för user (id)
        $primaryKey = $user->primaryKey();

        //sätter value till user id
        $value = $user->{$primaryKey};

        /** lägger till $_SESSION['user'] till value (id)
        *   jag sätter inte hela UserModel till sessionen för att om personen är inloggad på flera maskiner och 
        *   ändrar email eller lösenord så uppdateras det på båda maskinerna då bara användarens id alltid är samma
        */
        Application::$app->session->set('user', $value);

        return true;
    }

    //om användaren loggar ut
    public function logout()
    {
        //sätter applikationens användare till null
        $this->user = null;

        //tar bort user från session
        self::$app->session->remove('user');
    }

    //vid varje request körs denna, se public/index.php
    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);

        // försök att resolva urlen som användaren skrivit
        try {
            echo $this->router->resolve();
        } 
        //annars kasta error
        catch (\Exception $e) {
            echo $this->router->renderView('_error', [
                'exception' => $e,
            ]);
        }
    }

    public function triggerEvent($eventName)
    {
        $callbacks = $this->eventListeners[$eventName] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }

    public function on($eventName, $callback)
    {
        $this->eventListeners[$eventName][] = $callback;
    }
}
