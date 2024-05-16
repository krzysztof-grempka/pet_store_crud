<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum PetStatus: string
{
    case SOLD = 'sold';
    case PENDING = 'pending';
    case AVAILABLE = 'available';

    public static function allStatuses(): array
    {
        return array_column(self::cases(), 'value');
    }
}
