<?php

namespace App\Exception;

use App\Exception\Constants\ExceptionType;
use App\Exceptions\Contracts\IPlatformException;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response;

class UserExistsException extends \Exception implements IPlatformException
{
    use PlatformException;

    protected static string $defaultMessageKey = 'user_exists';
    protected static int $defaultCode = Response::HTTP_CONFLICT;
    protected static string $defaultType = ExceptionType::EXISTS;
    protected static string $defaultLogLevel = LogLevel::INFO;
}