<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case CUSTOMER = 'customer';
    case RESTAURANT_OWNER = 'restaurant_owner';
    case SHIPPER = 'shipper';
}
