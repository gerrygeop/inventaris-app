<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
// use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum LoanStatus: string implements HasColor, HasLabel
{
    case Dipinjam = 'Dipinjam';
    case Dikembalikan = 'Dikembalikan';
    case Rusak = 'Rusak';

    public function getLabel(): string
    {
        return match ($this) {
            self::Dipinjam => 'Dipinjam',
            self::Dikembalikan => 'Dikembalikan',
            self::Rusak => 'Rusak',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Dipinjam => 'info',
            self::Dikembalikan => 'success',
            self::Rusak => 'danger',
        };
    }
}
