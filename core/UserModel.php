<?php

namespace app\core;

use app\core\db\DbModel;

/**
 * Class UserModel
 *
 */
abstract class UserModel extends DbModel
{
    abstract public function getUsername(): string;
    abstract public function getEmail(): string;

}
