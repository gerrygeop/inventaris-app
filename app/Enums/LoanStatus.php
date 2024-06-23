<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
// use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum LoanStatus: string implements HasColor, HasLabel
{
    case Disetujui = 'Disetujui';
    case Ditolak = 'Ditolak';
    case Pending = 'Pending';
    case Dikembalikan = 'Dikembalikan';

    public function getLabel(): string
    {
        return match ($this) {
            self::Disetujui => 'Disetujui',
            self::Ditolak => 'Ditolak',
            self::Pending => 'Pending',
            self::Dikembalikan => 'Dikembalikan',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Disetujui => 'success',
            self::Ditolak => 'danger',
            self::Pending => 'warning',
            self::Dikembalikan => 'info',
        };
    }
}
