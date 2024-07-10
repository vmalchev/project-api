<?php

namespace App\Exception;

use App\Exception\Constants\ExceptionType;
use App\Exceptions\Contracts\IPlatformException;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response;

class ProjectNotFoundException extends \Exception implements IPlatformException
{
    use PlatformException;

    protected static string $defaultMessageKey = 'project_not_found';
    protected static int $defaultCode = Response::HTTP_NOT_FOUND;
    protected static string $defaultType = ExceptionType::NOT_FOUND;
    protected static string $defaultLogLevel = LogLevel::INFO;

}