<?php

namespace app\controllers;


use app\core\Controller;

/**
 * Class AboutController
 *
 */
class AboutController extends Controller
{
    public function index()
    {
        return $this->render('about');
    }
}
