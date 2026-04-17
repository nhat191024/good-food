<?php

namespace App\Enums;

enum BillStatus: string
{
    case PENDING = 'pending';
    case PREPARE = 'prepare';
    case DELIVERING = 'delivering';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
    case EXPIRED = 'expired';
}
