<?php

namespace app\core;

class Request
{
    public function getUrl()
    {
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($url, '?');
        if ($position === false) {
            return $url;
        }
        return substr($url, 0, $position);
    }
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
