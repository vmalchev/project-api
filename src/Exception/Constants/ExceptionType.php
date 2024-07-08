<?php

namespace App\Exception\Constants;

class ExceptionType
{
    const UNKNOWN = 'UNKNOWN_ERROR';
    const DATABASE = 'DATABASE_ERROR';
    const VALIDATION = 'VALIDATION_ERROR';
    const NOT_FOUND = 'NOT_FOUND_ERROR';
    const EXISTS = 'EXISTS_ERROR';
}
