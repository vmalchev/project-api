<?php

namespace App\Exception;

use App\Exception\Constants\ExceptionType;
use App\Exceptions\Contracts\IPlatformException;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response;

class TaskNameProjectExistsException extends \Exception implements IPlatformException
{
    use PlatformException;
    protected static string $defaultMessageKey = 'task_name_project_exists';
    protected static int $defaultCode = Response::HTTP_CONFLICT;
    protected static string $defaultType = ExceptionType::EXISTS;
    protected static string $defaultLogLevel = LogLevel::INFO;
}