<?php

namespace App\Exception;

use App\Exception\Constants\ExceptionCode;
use App\Exception\Constants\ExceptionType;
use App\Exceptions\Contracts\IPlatformException;
use Psr\Log\LogLevel;

class TaskNotFoundException extends \Exception implements IPlatformException
{
    use PlatformException;

    protected static string $defaultMessageKey = 'task_not_found';
    protected static int $defaultCode = ExceptionCode::INVALID_DATA;
    protected static string $defaultType = ExceptionType::NOT_FOUND;
    protected static string $defaultLogLevel = LogLevel::INFO;
}