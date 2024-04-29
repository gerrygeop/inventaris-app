<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
// use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ItemStatus: string implements HasColor, HasLabel
{
    case Baru = 'Baru';
    case Bekas = 'Bekas';
    case Rusak = 'Rusak';
    case Baik = 'Baik';
    case Hilang = 'Hilang';
    case Perbaikan = 'Perbaikan';
    case Kadaluwarsa = 'Kadaluwarsa';

    public function getLabel(): string
    {
        return match ($this) {
            self::Baru => 'Baru',
            self::Bekas => 'Bekas',
            self::Rusak => 'Rusak',
            self::Baik => 'Baik',
            self::Hilang => 'Hilang',
            self::Perbaikan => 'Perlu Perbaikan',
            self::Kadaluwarsa => 'Kadaluwarsa',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Baru => 'info',
            self::Bekas, self::Hilang => 'warning',
            self::Rusak => 'danger',
            self::Baik => 'success',
            self::Perbaikan => 'info',
            self::Kadaluwarsa => 'danger',
        };
    }
}
