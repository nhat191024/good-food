<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum FilamentNavigationGroup implements HasLabel
{
    case CATEGORIES;
    case USER_MANAGEMENT;
    case BILLING;
    case SYSTEM;
    case SETTINGS;

    public function getLabel(): string
    {
        return match ($this) {
            self::USER_MANAGEMENT => "Người dùng",
            self::BILLING => "Hóa đơn",
            self::SETTINGS => "Cài đặt",
            self::CATEGORIES => "Danh mục",
            self::SYSTEM => "Hệ thống",
        };
    }
}
