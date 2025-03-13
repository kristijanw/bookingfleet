<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ExcursionStatus: string implements HasLabel, HasColor, HasIcon
{
    case Published = 'published';
    case Draft = 'draft';

    public function getLabel(): string
    {
        return match ($this) {
            self::Published => 'Published',
            self::Draft => 'Draft',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Published => 'success',
            self::Draft => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Published => 'heroicon-m-sparkles',
            self::Draft => 'heroicon-m-arrow-path',
        };
    }
}
