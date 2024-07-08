<?php

namespace App\DTO\Validator;


use DateInterval;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class DateIntervalValidator
{
    public static function validate(mixed $value, ExecutionContextInterface $context, mixed $payload): void
    {
        try {
            (new DateInterval($value));
        } catch (\Throwable $exception) {
            $context->buildViolation('Expected a valid ISO 8601 duration.')->addViolation();
        }
    }
}