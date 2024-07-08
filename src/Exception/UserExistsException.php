<?php

namespace App\Exception;

use App\Exception\Constants\ExceptionCode;
use App\Exception\Constants\ExceptionType;
use App\Exceptions\Contracts\IPlatformException;
use Psr\Log\LogLevel;

class UserExistsException extends \Exception implements IPlatformException
{
    use PlatformException;

    protected static string $defaultMessageKey = 'user_exists';
    protected static int $defaultCode = ExceptionCode::INVALID_OPERATION;
    protected static string $defaultType = ExceptionType::EXISTS;
    protected static string $defaultLogLevel = LogLevel::INFO;
}