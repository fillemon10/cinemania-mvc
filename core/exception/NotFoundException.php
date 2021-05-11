<?php

namespace app\core\exception;


/**
 * Class NotFoundException
 *
 */
class NotFoundException extends \Exception
{
    protected $message = 'Page not found.  <br> <a href="/" class="btn theme-btn mt-30">Back to Home</a>';
    protected $code = 404; 
}
