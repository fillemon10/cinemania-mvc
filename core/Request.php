<?php

namespace app\core;


/**
 * Class Request
 *
 */
class Request
{
    //hämtar methoden
    public function getMethod()
    {
        //returnerar method som används
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getUrl()
    {
        //urlen
        $path = $_SERVER['REQUEST_URI'];

        //letar efter ? i urlen
        $position = strpos($path, '?');

        //om ? finns i urlen
        if ($position !== false) {
            //ta bort ? och allt efter
            $path = substr($path, 0, $position);
        }

        //return urlen
        return $path;
    }

    //kolla om requestet är get
    public function isGet()
    {
        //return true om det är get
        return $this->getMethod() === 'get';
    }

    //kolla om requestet är post
    public function isPost()
    {
        //return true om det är post
        return $this->getMethod() === 'post';
    }

    //hämtar datan från post och get requests
    public function getData()
    {
        $data = [];

        //om det är ett get request
        if ($this->isGet()) {

            //för varje get (t.ex. ?topic=1&genre=action)
            foreach ($_GET as $key => $value) {

                //filtera datan i en associative array
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        //om det är ett post request
        if ($this->isPost()) {

            //för varje post
            foreach ($_POST as $key => $value) {

                //filtera datan i en associative array
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        //return arrayen av data
        return $data;
    }
}
