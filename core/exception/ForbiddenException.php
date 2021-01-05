<?php


namespace app\core\exception;


use app\core\Application;

/**
 * Class ForbiddenException
 *
 */
class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access this page';
    protected $code = 403;
}
