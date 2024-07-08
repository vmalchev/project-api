<?php

namespace App\Exception;

use App\Exceptions\Contracts\IPlatformException;

class AuthException extends \Exception implements IPlatformException
{
    use PlatformException;
}