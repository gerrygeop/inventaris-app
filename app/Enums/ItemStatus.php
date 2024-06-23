<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
// use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ItemStatus: string implements HasColor, HasLabel
{
    case Baru = 'Baru';
    case Rusak = 'Rusak';
    case Baik = 'Baik';
    case Perbaikan = 'Perbaikan';

    public function getLabel(): string
    {
        return match ($this) {
            self::Baru => 'Baru',
            self::Rusak => 'Rusak',
            self::Baik => 'Baik',
            self::Perbaikan => 'Perlu Perbaikan',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Baru => 'info',
            self::Rusak => 'danger',
            self::Baik => 'success',
            self::Perbaikan => 'info',
        };
    }
}
