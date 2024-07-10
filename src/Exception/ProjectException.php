<?php

namespace App\Exception;


use App\Exception\Constants\ExceptionType;
use App\Exceptions\Contracts\IPlatformException;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Response;

class ProjectException extends \Exception implements IPlatformException
{
    use PlatformException;

    protected static string $defaultMessageKey = 'invalid_project_data';
    protected static int $defaultCode = Response::HTTP_UNPROCESSABLE_ENTITY;
    protected static string $defaultType = ExceptionType::VALIDATION;
    protected static string $defaultLogLevel = LogLevel::INFO;

}