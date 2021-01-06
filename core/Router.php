<?php

namespace app\core;

use app\core\exception\NotFoundException;

/**
 * Class Router
 *
 */
class Router
{
    private Request $request;
    private Response $response;
    private array $routeMap = [];

    public function __construct(Request $request, Response $response)
    {
        //sätter request och respone till requestet och responset
        $this->request = $request;
        $this->response = $response;
    }

    //om requestet är get
    public function get(string $url, $callback)
    {
        //sätter route kartan till get / url / callback(controller och method, plus eventuell _$GET) 
        $this->routeMap['get'][$url] = $callback;
    }

    //om requestet är post
    public function post(string $url, $callback)
    {
        //sätter route kartan till post / url / callback(controller och method, plus eventuell _$GET) 
        $this->routeMap['post'][$url] = $callback;
    }

    public function resolve()
    {
        //methoden är post eller get, hämtar det från request
        $method = $this->request->getMethod();

        //hämtar urlen
        $url = $this->request->getUrl();

        //letar i route map efter rätt method och url och sätter sedan callback till en array av den routemap som hittas(callback)
        $callback = $this->routeMap[$method][$url] ?? false;

        //om callback är false
        if (!$callback) {
            //not found 404
            throw new NotFoundException();
        }

        //om callbacken är en string (ANVÄNDS INTE)
        if (is_string($callback)) {
            //visa viewn callback
            return $this->renderView($callback);
        }
        
        //om callbacken är en array (ANVÄNDS)
        if (is_array($callback)) {
            /**
             * @var $controller \app\core\Controller
             */
            //callback[0] är controllern som ska användas, skapar en ny instans av controllern som ska användas
            $controller = new $callback[0];

            //callback[1] är methoden (action) som ska användas i controllern.
            $controller->action = $callback[1];

            //sätter applikationens controller till controllern.
            Application::$app->controller = $controller;

            //hämtar middlewares om de finns (sidor som användaren inte får visa om det t.ex inte är inloggade)
            $middlewares = $controller->getMiddlewares();

            //för varje middleware
            foreach ($middlewares as $middleware) {

                //kör middlewaret
                $middleware->execute();
            }

            //sätter callback[0] till controller
            $callback[0] = $controller;
        }

        //return kalla på callbacken
        return call_user_func($callback, $this->request, $this->response);
    }

    //renderar view 
    public function renderView($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    //renderna bara view
    public function renderViewOnly($view, $params = [])
    {
        return Application::$app->view->renderViewOnly($view, $params);
    }
}
