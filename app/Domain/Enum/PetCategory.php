<?php

declare(strict_types=1);

namespace App\Domain\Enum;

enum PetCategory: string
{
    case DOGS = 'dogs';
    case CATS = 'cats';
    case LIONS = 'lions';
    case HORSES = 'horses';
    case OTHERS = 'others';

    public static function allCategories(): array
    {
        return array_column(self::cases(), 'value');
    }
}
