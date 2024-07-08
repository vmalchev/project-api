<?php

namespace App\Exception;

use App\Exception\Constants\ExceptionCode;
use App\Exception\Constants\ExceptionType;
use App\Exceptions\Contracts\IPlatformException;
use Psr\Log\LogLevel;

class TaskException extends \Exception implements IPlatformException
{
    use PlatformException;

    protected static string $defaultMessageKey = 'invalid_data';
    protected static int $defaultCode = ExceptionCode::INVALID_DATA;
    protected static string $defaultType = ExceptionType::VALIDATION;
    protected static string $defaultLogLevel = LogLevel::INFO;
}