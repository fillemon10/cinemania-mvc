<?php

namespace app\core\exception;


/**
 * Class NotFoundException
 *
 */
class NotFoundException extends \Exception
{
    protected $message = 'Page not found';
    protected $code = 404;
}
