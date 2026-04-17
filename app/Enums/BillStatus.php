<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BillStatus: string implements HasLabel, HasColor
{
    case PENDING = 'pending';
    case PREPARE = 'prepare';
    case DELIVERING = 'delivering';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
    case EXPIRED = 'expired';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Chờ xác nhận',
            self::PREPARE => 'Đang chuẩn bị',
            self::DELIVERING => 'Đang giao',
            self::DELIVERED => 'Đã giao',
            self::CANCELLED => 'Đã hủy',
            self::EXPIRED => 'Hết hạn',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::PREPARE => 'info',
            self::DELIVERING => 'primary',
            self::DELIVERED => 'success',
            self::CANCELLED => 'danger',
            self::EXPIRED => 'gray',
        };
    }
}
