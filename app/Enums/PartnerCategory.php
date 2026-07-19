<?php

namespace App\Enums;

enum PartnerCategory: string
{
    case Technical = 'Technical Partners';
    case Financial = 'Financial Partners';

    /**
     * @return list<string>
     */
    public static function labels(): array
    {
        return array_column(self::cases(), 'value');
    }
}
