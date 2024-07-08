<?php

namespace App\Entity\Enum;

enum Status: string
{
    case Completed = "COMPLETED";
    case InProgress = "IN_PROGRESS";
    case OnHold = "ON_HOLD";
    case Approved = "APPROVED";
    case NotStarted = "NOT_STARTED";
    case Pending = "PENDING";

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
