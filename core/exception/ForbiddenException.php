<?php


namespace app\core\exception;


use app\core\Application;

/**
 * Class ForbiddenException
 *
 */
class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access this page. You have to login. <br> <a href="/login" class="btn theme-btn mt-30">Login</a>';
    protected $code = 403;
}
