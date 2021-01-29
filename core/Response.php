<?php

namespace app\core;

/**
 * Class Response
 *
 */
class Response
{
    //sätt status code funktion
    public function statusCode(int $code)
    {
        //sätt http_response_code till code
        http_response_code($code);
    }

    //dirigera om funktion
    public function redirect($url)
    {
        header("Location: $url");
    }
}
