<?php

namespace App\Exception;

use App\Exception\Constants\ExceptionCode;
use App\Exception\Constants\ExceptionType;
use App\Exceptions\Contracts\IPlatformException;
use Psr\Log\LogLevel;

class ProjectTitleClientExistsException extends \Exception implements IPlatformException
{
    use PlatformException;
    protected static string $defaultMessageKey = 'project_title_client_exists';
    protected static int $defaultCode = ExceptionCode::INVALID_PARAMS;
    protected static string $defaultType = ExceptionType::VALIDATION;
    protected static string $defaultLogLevel = LogLevel::INFO;
}