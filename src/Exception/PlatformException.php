<?php

namespace App\Exception;

use App\Exception\Constants\ExceptionCode;
use App\Exception\Constants\ExceptionType;
use Psr\Log\LogLevel;

trait PlatformException
{
    protected string $type;
    protected string $logLevel;
    protected array $errors;
    private string $originalMessage;

    public function __construct(?string $messageKey, array $errors=[], ?string $originalMessage='')
    {
        $message = $messageKey ?: (static::$defaultMessageKey ?? ExceptionType::UNKNOWN);
        $code = static::$defaultCode ?? ExceptionCode::UNKNOWN;

        parent::__construct($message, $code);

        $this->type = static::$defaultType ?? 'unknown';
        $this->logLevel = static::$defaultLogLevel ?? LogLevel::INFO;
        $this->errors = $errors;

        $this->originalMessage = $originalMessage;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getLogLevel(): string
    {
        return $this->logLevel;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function report()
    {}
}
