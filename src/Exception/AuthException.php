<?php

namespace App\Exception;

use App\Exceptions\Contracts\IPlatformException;
use Symfony\Component\HttpFoundation\Response;

class AuthException extends \Exception implements IPlatformException
{
    use PlatformException;

    protected static string $defaultMessageKey = 'auth_exception';
    protected static int $defaultCode = Response::HTTP_UNAUTHORIZED;
}