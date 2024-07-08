<?php

namespace App\Exception\Constants;


class HTTPCodeResolver
{
    const ERROR_TYPE = [
        ExceptionType::UNKNOWN => 500,
        ExceptionType::DATABASE => 500,
        ExceptionType::VALIDATION => 422,
        ExceptionType::NOT_FOUND => 404,
        ExceptionType::EXISTS => 403,
    ];
}
